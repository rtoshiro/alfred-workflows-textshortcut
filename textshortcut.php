<?php
require_once('workflows.php');

class TextShortcut
{
  public $workflows;
  public $pattern;

  public function __construct()
  {
    $this->workflows = new Workflows();
    $this->pattern = '/[\\\(\)\/ ]/i';
  }

  public function command($cmd = null)
  {
    if ($cmd == null) return '';

    $cmd = preg_replace($this->pattern, '_', $cmd);
    return $cmd;
  }

  // Retorna a string, se for para ler
  public function parse($snippet_type = 'ts', $query = null)
  {
    $result = null;
    $elements = explode(' ', $query);
    if (count($elements) > 0)
    {
      $cmd = $elements[0];
      if ($cmd == 'del' && count($elements) > 1)
      {
        // Retira o 'del'
        $elements = array_splice($elements, 1);
        $cmd = implode($elements);
        if (isset($cmd))
        {
          $cmd = $this->command($cmd);
          if (!empty($cmd))
          {
            // Apaga o arquivo
            $filePath = $this->workflows->data() . '/' . $cmd . '.' . $snippet_type;
            unlink($filePath);
          }
          return '';
        }
      }
      if ($cmd == 'add' && count($elements) > 1)
      {
        // Retira o 'add'
        $elements = array_splice($elements, 1);
        $cmd = implode($elements);
        if (isset($cmd))
        {
          $cmd = $this->command($cmd);
          if (!empty($cmd))
          {
            // Escreve o arquivo com o nome do comando
            $text = shell_exec('osascript get_from_clipboard.scpt ' . $cmd);

            $text = preg_replace('/.*\n\n/', '', $text);

            $this->workflows->write($text, $cmd . '.' . $snippet_type);
          }
          return '';
        }
      }
      else
      {
        $cmd = implode($elements);
        $cmd = $this->command($cmd);
        $result = $this->workflows->read($cmd . '.' . $snippet_type);
      }

      if (isset($result))
        return $result;

      return '';
    }

    return '';
  }
}
?>

<?php
require_once('textshortcut.php');
require_once('workflows.php');

$t = new TextShortcut();
$w = new Workflows();
$data = $w->data();

$has_one = false;
$filter_by = $argv[1];
$query = $argv[2];
$titles = array(
  'ts' => 'Text Shortcut',
  'tc' => 'Text Command'
);

$elements = explode(' ', $query);
if (count($elements) > 0)
{
  $cmd = $elements[0];
  if ($cmd == 'add')
  {
    $cmd = str_replace('add ', '', $query);
    if ($cmd == 'add') $cmd = '[command]';
    $w->result( md5('add'), $query, 'Adding New ' . $titles[$filter_by], $filter_by . ' add ' . $cmd, 'NotLoaded.icns', 'yes', $filter_by . ' add ' . $cmd );
    $has_one=true;
  }
  else if ($cmd == 'del')
  {
    if ($handle = opendir($data))
    {
      while (false !== ($entry = readdir($handle)))
      {
        $basename = str_replace('.' . $filter_by, '', $entry);
        if (!empty($basename))
        {
          $ext = end(explode('.', $entry));
          $cmd = str_replace('del ', '', $query);

          if ($ext == $filter_by && substr($entry, 0, 1) != '.' && (empty($cmd) || (strpos($basename, $cmd) === 0)))
          {
            $w->result( md5($basename), 'del ' . $basename, 'Removing ' .  $basename, $filter_by . ' del ' . $basename, 'ToolbarDeleteIcon.icns', 'yes', 'del ' . $basename );
            $has_one = true;
          }

        }
      }
      closedir($handle);
    }
  }
  else
  {
    if ($handle = opendir($data))
    {
      while (false !== ($entry = readdir($handle)))
      {
        $basename = str_replace('.' . $filter_by, '', $entry);
        $ext = end(explode('.', $entry));
        if ($ext == $filter_by && substr($entry, 0, 1) != '.' && (empty($query) || (strpos($basename, $query) === 0)))
        {
          $w->result( md5($basename), $basename, $titles[$filter_by] . ': ' . $basename,  $filter_by . ' ' . $basename, 'ClippingText.icns', 'yes', $basename );
          $has_one= true;
        }
      }
      closedir($handle);
    }
  }

  if (!$has_one)
  {
    $w->result( '', '', $titles[$filter_by] . ' Not Found', '', 'ClippingText.icns', 'yes', '' );
  }
}


echo $w->toxml();

?>

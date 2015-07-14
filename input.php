<?php
require_once('workflows.php');
require_once('textshortcut.php');

$t = new TextShortcut();
$snippet_type = $argv[1];
$query = $argv[2];

$result = $t->parse($snippet_type, $query);
if (empty($result))
  die;

if ($snippet_type == 'ts') {
  echo $result;
} else {
  $result = preg_replace( "/\r|\n/", "; ", $result );
  $result = trim($result);
  echo ($result);
}
?>

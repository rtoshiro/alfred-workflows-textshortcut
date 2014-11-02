<?php
require_once('workflows.php');
require_once('textshortcut.php');

$t = new TextShortcut();
$query = $argv[1];
$result = $t->parse($query);
if (empty($result))
  die;
echo $result;
?>


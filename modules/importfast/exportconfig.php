<?php

include(dirname(__FILE__).'/../../config/config.inc.php');

if (Tools::getValue('token') != sha1(_COOKIE_KEY_.'importfast') || !Tools::getValue('supplierId'))
  die('Invalid parameters');
$supplierId = Tools::getValue('supplierId');
$supplier = new Supplier($supplierId);


$file = Tools::getValue('file');
if ($file) {
  $file = $_GET['file'];
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="'.basename($file).'"');
  header('Cache-Control: private, max-age=0, must-revalidate');
  print file_get_contents($file);
  return;
}


header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename="config_'.$supplierId.'.xml"');
header('Cache-Control: private, max-age=0, must-revalidate');


$rows = Db::getInstance()->ExecuteS('SELECT * FROM `'.
  _DB_PREFIX_.'importfast` WHERE `supplierId` = '.$supplierId);

print '<?xml version="1.0" encoding="UTF-8"?>'."\n";
print "<rows>\n";
foreach ($rows as $row) {
  print "  <row>\n";
  array_shift($row);
  foreach ($row as $k => $v) {
    if ($v != '')
      printf("    <%s>%s</%s>\n", $k, pSQL(htmlspecialchars($v, ENT_QUOTES)), $k);
  }
  print "  </row>\n";
}
print "</rows>\n";

?>

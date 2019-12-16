<?php

// You should place this file in your admin directory

define('_PS_ADMIN_DIR_', getcwd());
include(dirname(__FILE__).'/../config/config.inc.php');
include(_PS_MODULE_DIR_.'/importfast/importfast.php');
ini_set('max_execution_time', 1000);
ini_set('display_errors', 1);
error_reporting(E_ALL);


// Before you can import you must set the correct values for the 4 settings below
$url = 'http://www.example.com/dropship_feed.php?email=myemail@mail.com';
$prodFileName = 'AllProducts.csv';
// $catFileName = 'Categories.csv';
$confSupplierId = 3;
$supplierId = 3;
$fileFormat = 'CSV';

$cookie->id_lang = intval(Configuration::get('PS_LANG_DEFAULT'));
$resume = Tools::getValue('resume');
$_POST['prodFileName'] = $prodFileName;
// $_POST['catFileName'] = $catFileName;
$_POST['supplierId'] = $supplierId;
$_POST['confSupplierId'] = $confSupplierId;
$_POST['fileFormat'] = $fileFormat;
$_POST['importType'] = 0; // Use 1 for price/qty update
$startTime = microtime(true);
if ($resume == 0)
  copy($url, 'import/'.$prodFileName);
printf("<p>Copied file in %.3f seconds</p>\n", microtime(true) - $startTime);
$importFast = new ImportFast();
$importFast->setFields();
$importFast->import($resume == 1);

print "<p>";
if (($importFast->getErrors())) {
  print "<h2>Errors</h2>";
  foreach ($importFast->getErrors() as $error)
    printf("<b>%s</b><br>\n", $error);
  print "<hr /><br />";
}
foreach ((array)$importFast->_status as $status)
  printf("%s<br>\n", $status);
print "</p>";


?>

<?php

include(dirname(__FILE__).'/../../config/config.inc.php');

// define('_PS_BASE_URL_', Tools::getShopDomain(true));
// define('_PS_BASE_URL_SSL_', Tools::getShopDomainSsl(true));

$maxTime = 30;
$startTime = microtime(true);
print '<pre>';
if (_PS_VERSION_ >= "1.5.0.0")
  $sql = 'SELECT ma.`id_product`, ma.`id_product_attribute`, sa.`quantity`
    FROM `'._DB_PREFIX_.'mailalert_customer_oos` ma
    JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = ma.`id_product`
    JOIN `'._DB_PREFIX_.'stock_available` sa
      ON sa.`id_product` = ma.`id_product`
      AND sa.`id_product_attribute` = ma.`id_product_attribute`
    WHERE ma.`id_product_attribute` = 0
      AND p.`active` = 1
      AND sa.`quantity` > 0';
else
  $sql = 'SELECT ma.`id_product`, ma.`id_product_attribute`, p.`quantity`
    FROM `'._DB_PREFIX_.'mailalert_customer_oos` ma
    JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = ma.`id_product`
    WHERE ma.`id_product_attribute` = 0
      AND p.`active` = 1 AND p.`quantity` > 0';
$rows = Db::getInstance()->ExecuteS($sql);
printf("%d updated products found\n", count($rows));
foreach ($rows as $row) {
  if (_PS_VERSION_ >= "1.5.0.0")
    Hook::exec('actionUpdateQuantity', $row, NULL);
  else
    Module::hookExec('updateQuantity', array('product' => $row['id_product']));
  if (microtime(true) - $startTime > $maxTime)
    break;
}

if (_PS_VERSION_ >= "1.5.0.0")
  $sql = 'SELECT ma.`id_product`, ma.`id_product_attribute`, sa.`quantity`
    FROM `'._DB_PREFIX_.'mailalert_customer_oos` ma
    JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = ma.`id_product`
    JOIN `'._DB_PREFIX_.'stock_available` sa
      ON sa.`id_product` = ma.`id_product`
      AND sa.`id_product_attribute` = ma.`id_product_attribute`
    WHERE ma.`id_product_attribute` > 0
      AND p.`active` = 1
      AND sa.`quantity` > 0';
else
  $sql = 'SELECT ma.`id_product`, ma.`id_product_attribute`, pa.`quantity`
    FROM `'._DB_PREFIX_.'mailalert_customer_oos` ma
    JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = ma.`id_product`
    JOIN `'._DB_PREFIX_.'product_attribute` pa
      ON pa.`id_product` = ma.`id_product`
      AND pa.`id_product_attribute` = ma.`id_product_attribute`
    WHERE p.`active` = 1 AND pa.`quantity` > 0';
$rows = Db::getInstance()->ExecuteS($sql);
printf("%d updated product attributes found\n", count($rows));
foreach ($rows as $row) {
  if (_PS_VERSION_ >= "1.5.0.0")
    Hook::exec('actionUpdateQuantity', $row, NULL);
  else
    Module::hookExec('updateProductAttribute',
	array('id_product_attribute' => $row['id_product_attribute']));
  if (microtime(true) - $startTime > $maxTime)
    break;
}
print '</pre>';

?>

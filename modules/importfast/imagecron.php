<?php

if (strpos($_SERVER['REQUEST_URI'], '/modules/importfast/') !== false)
  include(dirname(__FILE__).'/../../config/config.inc.php');
else
  include(dirname(__FILE__).'/config/config.inc.php');
include_once(_PS_ROOT_DIR_.'/classes/Link.php');


function GetImages() 
{
  error_reporting(E_ALL);
  ini_set("display_errors", 1); 
  $id_product = 0;
  $link = new Link();
  $maxTime = ini_get('max_execution_time'); 
  // ini_set('max_execution_time', 300); 
  $maxTime = 30;
  $startTime = microtime(true);
  $resizedCount = 0;
  $rows = Db::getInstance()->ExecuteS('
    SELECT i.`id_product`, i.`id_image`, i.`url`
    FROM `'._DB_PREFIX_.'image` i
    WHERE i.`img_upd` = \'0000-00-00 00:00:00\'');
  $missingCount = count($rows);
  for ($i = 0; $i < $missingCount; $i++) {
    list($id_product, $id_image, $url) = array_values($rows[$i]);
    $link->resizedCount = 0;
    $link->getImageLink('', $id_image);
    $resizedCount += $link->resizedCount;
    $img_upd = date('Y-m-d H:i:s');
    if ($i + 1 == $missingCount || $rows[$i + 1]['id_product'] != $id_product) {
      Db::getInstance()->Execute('
	UPDATE `'._DB_PREFIX_.'image` i
	LEFT JOIN `'._DB_PREFIX_.'product` p
	ON p.`id_product` = i.`id_product`
	SET i.`img_upd` = \''.$img_upd.'\'
	WHERE p.`id_product` = '.$id_product);
    }
    $prevId = $id_product;
    if (microtime(true) - $startTime > $maxTime)
      break;
  }
  return array($resizedCount, $missingCount, microtime(true) - $startTime);
}


ini_set('display_errors', 'on');
list($resizedCount, $missingCount, $duration) = GetImages();
printf("<p>Resized %d/%d images in %.3f seconds</p>\n",
    $resizedCount, $missingCount, $duration);


?>

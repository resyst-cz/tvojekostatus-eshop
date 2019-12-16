<?php


/*
 * $Date: 2017/04/13 06:56:41 $
 * Written by Kjeld Borch Egevang
 * E-mail: kjeld@mail4us.dk
 */

if (!defined('_PS_VERSION_'))
	exit;

if (stream_resolve_include_path(_PS_MODULE_DIR_.'importfast/update.php'))
  include(_PS_MODULE_DIR_.'importfast/update.php');
if (stream_resolve_include_path(_PS_MODULE_DIR_.'importfast/customer_function.php'))
  include(_PS_MODULE_DIR_.'importfast/customer_function.php');


class importfast_utf8encode_filter extends php_user_filter
{
  function filter($in, $out, &$consumed, $closing)
  {
    while ($bucket = stream_bucket_make_writeable($in)) {
      // $bucket->data = iconv('Windows-1252', 'UTF-8', $bucket->data);
      $bucket->data = utf8_encode($bucket->data);
      $consumed += $bucket->datalen;
      stream_bucket_append($out, $bucket);
    }
    return PSFS_PASS_ON;
  }
}


class importfast_backslash_filter extends php_user_filter
{
  function filter($in, $out, &$consumed, $closing)
  {
    while ($bucket = stream_bucket_make_writeable($in)) {
      $bucket->data = str_replace('\\', '&#92;', $bucket->data);
      $consumed += $bucket->datalen;
      stream_bucket_append($out, $bucket);
    }
    return PSFS_PASS_ON;
  }
}


class ImportFast extends Module
{
  public static $currentIndex;

  public function __construct()
  {
    $this->v13 = _PS_VERSION_ >= "1.3.0.0";
    $this->v14 = _PS_VERSION_ >= "1.4.0.0";
    $this->v15 = _PS_VERSION_ >= "1.5.0.0";
    $this->v16 = _PS_VERSION_ >= "1.6.0.0";
    $this->v161 = _PS_VERSION_ >= "1.6.1.0";
    $this->v17 = _PS_VERSION_ >= "1.7.0.0";
    $this->phpold = version_compare(PHP_VERSION, '5.4.7') <= 0;
    $this->name = 'importfast';
    if ($this->v14)
      $this->tab = 'quick_bulk_update';
    else
      $this->tab = 'Admin';
    $this->author = 'Kjeld Borch Egevang';
    $this->tabClassName = 'AdminImportFast';
    $this->tabParentName = 'AdminTools';
    $this->version = '4.2.21';

    parent::__construct();

    /* The parent construct is required for translations */
    $this->page = basename(__FILE__, '.php');
    $this->description = $this->l('Import products fast. This is achieved by resizing images on demand and/or via a cronjob.');
    $this->displayName = $this->l('Import fast');
    $this->confirmUninstall = $this->l('Are you sure you want to delete your details ?');
    if ($this->v15)
      self::$currentIndex = $_SERVER['SCRIPT_NAME'].(($controller = Tools::getValue('controller')) ? '?controller='.$controller: '');
    else {
      global $currentIndex;
      self::$currentIndex = $currentIndex;
    }
    if ($this->v15 && !$this->v17) {
      return;
    }
    switch (_PS_VERSION_) {
    case "1.2.4.0":
    case "1.2.5.0":
      $this->linkFileName = _PS_MODULE_DIR_.'importfast/Link12.php';
      $this->classFileName = _PS_CLASS_DIR_.'Link.php';
      break;
    case "1.3.0.10":
    case "1.3.1.1":
    case "1.3.2.3":
    case "1.3.3.0":
    case "1.3.4.0":
    case "1.3.5.0":
    case "1.3.6.0":
    case "1.3.7.0":
      $this->linkFileName = _PS_MODULE_DIR_.'importfast/Link13.php';
      $this->classFileName = _PS_CLASS_DIR_.'Link.php';
      break;
    case "1.4.0.17":
    case "1.4.1.0":
    case "1.4.2.5":
    case "1.4.3":
    case "1.4.3.0":
    case "1.4.4.0":
    case "1.4.4.1":
    case "1.4.5.1":
    case "1.4.6.1":
    case "1.4.6.2":
    case "1.4.7.0":
    case "1.4.7.2":
    case "1.4.7.3":
    case "1.4.8.2":
    case "1.4.8.3":
    case "1.4.9.0":
    case "1.4.10.0":
    case "1.4.11.0":
      $this->linkFileName = _PS_MODULE_DIR_.'importfast/Link14.php';
      $this->classFileName = _PS_ROOT_DIR_.'/override/classes/Link.php';
      $this->useOverride = true;
      break;
    case "1.5.0.13":
    case "1.5.0.15":
    case "1.5.0.17":
    case "1.5.1.0":
    case "1.5.2.0":
    case "1.5.3.0":
    case "1.5.3.1":
    case "1.5.4.0":
    case "1.5.4.1":
    case "1.5.5.0":
    case "1.5.6.0":
    case "1.5.6.1":
    case "1.5.6.2":
      $this->linkFileName = _PS_MODULE_DIR_.'importfast/Link15.php';
      $this->classFileName = _PS_ROOT_DIR_.'/override/classes/Link.php';
      $this->useOverride = true;
      break;
    default:
      $this->linkFileName = NULL;
      $this->errorMessage = 
	$this->l('ImportFast module does not work with this version of PrestaShop').
	sprintf(" (%s). ", _PS_VERSION_).
	$this->l('Please e-mail kjeld@mail4us.dk for an update.');
      $this->description .= '<div class="error">'.$this->errorMessage.'</div>';
      return;
    }
    if (file_exists(_PS_MODULE_DIR_.'importfast/customer_Link.php'))
      $this->linkFileName = _PS_MODULE_DIR_.'importfast/customer_Link.php';
    $newFile = file_get_contents($this->linkFileName);
    $curFile = file_get_contents($this->classFileName);
    if (strcmp($curFile, $newFile) != 0) {
      copy($this->linkFileName, $this->classFileName);
      if ($this->v15) {
	// Index file may be wrong
	unlink(_PS_ROOT_DIR_.'/cache/class_index.php');
      }
      $curFile = file_get_contents($this->classFileName);
      if (strcmp($curFile, $newFile) != 0) {
	$this->errorMessage =
	  $this->l('Module is not installed correctly. Please copy: <br />').' '.
	  '<b>'.substr($this->linkFileName, strlen(_PS_ROOT_DIR_) + 1).'</b>'
	  .' '.$this->l('to').' '.
	  '<b>'.substr($this->classFileName, strlen(_PS_ROOT_DIR_) + 1).'</b>';
      }
    }
    else
      $this->linkFileCopied = true;
  }

  public function install()
  {
    if (!$this->v15 || $this->v17) {
      if (!$this->linkFileName)
	return false;
      if ($this->useOverride) {
	copy($this->linkFileName, $this->classFileName);
      }
      else {
	$savFileName = _PS_MODULE_DIR_.'importfast/Link_saved.php';
	copy($this->classFileName, $savFileName) &&
	  copy($this->linkFileName, $this->classFileName);
      }
    }
    $srcLogoName = _PS_MODULE_DIR_.'importfast/logo.gif';
    $dstLogoName = _PS_IMG_DIR_.'t/AdminImportFast.gif';
    copy($srcLogoName, $dstLogoName);
    $id_tab = Tab::getIdFromClassName($this->tabClassName);
    if (!$id_tab) {
      $tab = new Tab();
      $tab->class_name = $this->tabClassName;
      $tab->id_parent = Tab::getIdFromClassName($this->tabParentName);
      $tab->module = $this->name;
      $languages = Language::getLanguages();
      foreach ($languages as $language)
	$tab->name[$language['id_lang']] = $this->displayName;
      $tab->add();
    }
    $res = $this->Execute('
      CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'importfast` (
	`supplierId` int(10) NOT NULL,
	`type` char(2) NOT NULL,
	`ext_field` varchar(100) NOT NULL,
	`int_primary` varchar(100) NOT NULL,
	`int_secondary` varchar(100) NOT NULL,
	`int_lang` varchar(100) NOT NULL,
	`int_feature` varchar(100) NOT NULL,
	PRIMARY KEY (`supplierId`, `type`, `ext_field`)
      ) DEFAULT CHARSET=utf8');
    if (!$res) {
      printf("<p>%s</p>", Db::getInstance()->getMsgError());
      return false;
    }
    return parent::install();
  }

  public function uninstall()
  {
    $id_tab = Tab::getIdFromClassName($this->tabClassName);
    if ($id_tab) {
      $tab = new Tab($id_tab);
      $tab->delete();
    }
    if ($this->v15 && !$this->v17) {
      if ($this->useOverride) {
	unlink($this->classFileName);
      }
      else {
	if (isset($this->linkFileCopied)) {
	  $savFileName = _PS_MODULE_DIR_.'importfast/Link_saved.php';
	  copy($savFileName, $this->classFileName);
	}
      }
    }
    $query = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'importfast`';
    $this->Execute($query);
    return parent::uninstall();
  }

  public function displayMain()
  {
    $impfDebug = Tools::getValue('impfDebug');
    if ($this->v15 && !$this->v17) {
      if (!is_writable($this->adminPath)) {
	$this->errorMessage =
	  $this->l('Directory').' '.$this->adminPath.' '.
	  $this->l('is not writable');
      }
      if (!method_exists('Link', 'overrideVersion7')) {
	$srcFile = _PS_MODULE_DIR_.'importfast/override/classes/Link.php';
	$dstFile = _PS_ROOT_DIR_.'/override/classes/Link.php';
	if (Tools::isSubmit('submitCopyLink')) {
	  copy($srcFile, $dstFile);
	  $this->printWarning(sprintf('Copied %s to %s', $srcFile, $dstFile).
	    '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">'.
	    '<input type="submit" name="submitContinue" value="'.$this->l('Continue').'" class="button" />'.
	    '</form>');
	  unlink(_PS_ROOT_DIR_.'/cache/class_index.php');
	  return;
	}
	if (is_writable($dstFile)) {
	  $this->errorMessage =
	    $this->l('Module is not installed correctly. Click button to copy:').'<br />'.
	    '<b>modules/importfast/override/classes/Link.php</b>'.' '.
	    $this->l('to').' '.
	    '<b>override/classes/Link.php</b>'.
	    '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">'.
	    '<input type="submit" name="submitCopyLink" value="'.$this->l('Copy').'" class="button" />'.
	    '</form>';
	}
	else {
	  $this->errorMessage =
	    $this->l('Module is not installed correctly. Please copy:').'<br />'.
	    '<b>modules/importfast/override/classes/Link.php</b>'.' '.
	    $this->l('to').' '.
	    '<b>override/classes/Link.php</b><br />'.
	    $this->l('You may also have to delete').' '.
	    '<b>cache/class_index.php</b>';
	}
      }
      else if (!method_exists('Image', 'overrideVersion5')) {
	$srcFile = _PS_MODULE_DIR_.'importfast/override/classes/Image.php';
	$dstFile = _PS_ROOT_DIR_.'/override/classes/Image.php';
	if (Tools::isSubmit('submitCopyImage')) {
	  copy($srcFile, $dstFile);
	  $this->printWarning(sprintf('Copied %s to %s', $srcFile, $dstFile).
	    '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">'.
	    '<input type="submit" name="submitContinue" value="'.$this->l('Continue').'" class="button" />'.
	    '</form>');
	  unlink(_PS_ROOT_DIR_.'/cache/class_index.php');
	  return;
	}
	if (is_writable($dstFile)) {
	  $this->errorMessage =
	    $this->l('Module is not installed correctly. Click button to copy:').'<br />'.
	    '<b>modules/importfast/override/classes/Image.php</b>'.' '.
	    $this->l('to').' '.
	    '<b>override/classes/Image.php</b><br />'.
	    '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">'.
	    '<input type="submit" name="submitCopyImage" value="'.$this->l('Copy').'" class="button" />'.
	    '</form>';
	}
	else {
	  $this->errorMessage =
	    $this->l('Module is not installed correctly. Please copy:').'<br />'.
	    '<b>modules/importfast/override/classes/Image.php</b>'.' '.
	    $this->l('to').' '.
	    '<b>override/classes/Image.php</b><br />'.
	    $this->l('You may also have to delete').' '.
	    '<b>cache/class_index.php</b>';
	}
      }
    }
    if (isset($this->errorMessage)) {
      $this->printWarning($this->errorMessage);
      return;
    }
    if (Tools::getValue('noSupplier') == 1) {
      $this->_errors[] = $this->l('You must select a supplier');
    }
    if (Tools::isSubmit('submitLoadConfig') && $this->loadConfig() == true)
      return;
    if (Tools::isSubmit('submitLoadProd') && $this->loadProd() == true)
      return;
    if (Tools::isSubmit('submitCatSetup') && $this->displayCatSetup() == true)
      return;
    if (Tools::isSubmit('submitProdSetup') && $this->displayProdSetup() == true)
      return;
    if (Tools::isSubmit('submitNukeConfirm') && $this->deleteConfirm() == true)
      return;
    if (Tools::isSubmit('submitCatSave')) {
      $this->saveCatSetup();
    }
    elseif (Tools::isSubmit('submitProdSave')) {
      $this->saveProdSetup();
    }
    elseif (Tools::isSubmit('submitImport')) {
      $this->import(false);
    }
    elseif (Tools::isSubmit('submitResume')) {
      $this->import(true);
    }
    elseif (Tools::isSubmit('submitDelImages')) {
      $this->deleteImages();
    }
    elseif (Tools::isSubmit('submitDelRhino')) {
      $this->deleteImages(false, 0, true);
    }
    elseif (Tools::isSubmit('submitDelProducts')) {
      $this->deleteProducts();
    }
    elseif (Tools::isSubmit('submitDelOldProducts')) {
      $this->deleteProducts(true);
    }
    elseif (Tools::isSubmit('submitDelCategories')) {
      $this->deleteCategories();
    }
    elseif (Tools::isSubmit('nukeAll')) {
      $this->nukeAll();
    }
    elseif (Tools::isSubmit('uploadFile')) {
      if ($this->uploadFile() == false)
	return $this->loadConfig();
    }
    elseif (Tools::isSubmit('uploadProdFile')) {
      $this->uploadProdFile();
    }
    if (empty($_FILES) && empty($_POST) && isset($_SERVER['REQUEST_METHOD']) &&
      strtolower($_SERVER['REQUEST_METHOD']) == 'post')
    {
      $postMax = ini_get('post_max_size');
      $this->_errors[] = $this->l('Upload failed. File size must be less than').' '.$postMax;
    }
    if(isset($this->_warnings)) {
      $text = '<h3>'.$this->l('Warnings').'</h3>';
      $this->printWarning($text, $this->_warnings);
    }
    if ($this->_errors && sizeof($this->_errors) > 0) {
      $text = '<h3>'.$this->l('Errors').'</h3>';
      $this->printError($text, $this->_errors);
    }
    if (class_exists('ImportFastUpdate', false)) {
      $update = new ImportFastUpdate();
      if (Tools::getValue('updatedFlag'))
	$this->printWarning($this->l('Module updated'));
      if (Tools::isSubmit('submitUpdate')) {
	$update->updateModule($this); // Will redirect on success
	$text = '<h3>'.$this->l('Errors').'</h3>';
	$this->printError($text, $update->errors);
      }
      if ($update->newVersionAvailable()) {
	$this->printWarning('<h3>'.$this->l('Update').'</h3>'.
	    $this->l('New version available.').'
	    <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
	    <input type="submit" name="submitUpdate" value="'.$this->l('Update').'" class="button" />
	    </form>');
      }
    }
    $this->displayForm();
  }

  public function printWarning($text, $warnings = array())
  {
    if ($this->v16)
      print '<div class="bootstrap"><div class="alert alert-warning">';
    else
      print '<div class="warning warn">';
    print $text;
    if ($warnings) {
      print '<ol>';
      foreach ($warnings as $warning)
	print '<li>'.$warning.'</li>';
      print '</ol>';
    }
    if ($this->v16)
      print "</div></div>\n";
    else
      print "</div>\n";
  }

  public function printError($text, $errors = array())
  {
    if ($this->v16)
      print '<div class="bootstrap"><div class="alert alert-danger">';
    else
      print '<div class="alert error">';
    print $text;
    if ($errors) {
      print '<ol>';
      foreach ($errors as $error)
	print '<li>'.$error.'</li>';
      print '</ol>';
    }
    if ($this->v16)
      print "</div></div>\n";
    else
      print "</div>\n";
  }

  public function dump($var, $name = NULL, $html = false)
  {
    if (empty($this->cronFlag))
      print "<pre>";
    if ($name)
      print "$name:\n";
    if ($html)
      $var = str_replace(array('&','>','<','"'),
	  array('&amp;','&gt;','&lt;','&quot;'), $var);
    print_r($var);
    if (empty($this->cronFlag))
      print "</pre>";
    else
      print "\n\n";
  }

  private function getModuleUrl()
  {
    if ($this->v14)
      return Tools::getShopDomainSsl(true).$this->_path;
    elseif ($this->v13)
      return Tools::getHttpHost(true).$this->_path;
    else
      return $this->_path;
  }

  function endswith($haystack, $needle){
    return strrpos($haystack, $needle) === strlen($haystack) - strlen($needle);
  }

  public function getErrors()
  {
    return $this->_errors;
  } 

  public function setFields($dir = 'import')
  {
    $timeNow = date('Y-m-d H:i:s');
    if (empty($this->adminPath)) {
      if ($this->v14)
	$this->adminPath = realpath(_PS_ADMIN_DIR_.'/'.$dir).DIRECTORY_SEPARATOR;
      else
	$this->adminPath = realpath(PS_ADMIN_DIR.'/'.$dir).DIRECTORY_SEPARATOR;
    }
    $this->psFields1a = array(
	'N/A' => $this->l('N/A'),
	'valid' => $this->l('Valid'),
	'active' => $this->l('Active'),
	'supplier_reference' => $this->l('Supplier reference'),
	'supplier_ref_expr' => $this->l('Supplier ref. expr.'),
	'quantity' => $this->l('Quantity'),
	'name' => $this->l('Name'),
	'_url_pre' => 'url pre-burner',
	'category' => $this->l('Category'),
	'id_category' => $this->l('Category ID'),
	'sub_category' => $this->l('Sub-category'),
	'sub_sub_category' => $this->l('Sub-sub-category'),
	'sub_sub_sub_category' => $this->l('Sub-sub-sub-category'),
	'url' => $this->l('URL'),
	'url1' => $this->l('URL1'),
	'url2' => $this->l('URL2'),
	'url3' => $this->l('URL3'),
	'url4' => $this->l('URL4'),
	'moq' => $this->l('MOQ'),
	'price' => $this->l('Price'),
	'id_tax' => $this->l('Tax rate'),
	'id_tax_rules_group' => $this->l('Tax rate'),
	'price_tax' => $this->l('Price incl. tax'),
	'wholesale_price' => $this->l('Wholesale price'),
	'on_sale' => $this->l('On sale'),
	'show_price' => $this->l('Show price'));
    $this->psFields1_13 = array(
	'reduction_price' => $this->l('Reduction price'),
	'reduction_percent' => $this->l('Reduction percent'),
	'reduction_from' => $this->l('Reduction from'),
	'reduction_to' => $this->l('Reduction to'),
	'reduction_amount' => $this->l('Reduction amount'));
    $this->psFields1_14 = array(
	'reduced_price' => $this->l('Reduced price'),
	'specific_price' => $this->l('Specific price'),
	'specific_quantity' => $this->l('Specific quantity'),
	'specific_type' => $this->l('Specific reduction type'),
	'specific_value' => $this->l('Specific reduction value'),
	'specific_from' => $this->l('Specific reduction from'),
	'specific_to' => $this->l('Specific reduction to'),
	'additional_shipping_cost' => $this->l('Additional shipping cost'),
	'online_only' => $this->l('Online only'),
	'upc' => $this->l('UPC'),
	'minimal_quantity' => $this->l('Minimal quantity'),
	'unity' => $this->l('Unity'),
	'unit_price_ratio' => $this->l('Unit price ratio'),
	'condition' => $this->l('Condition'),
	'width' => $this->l('Width'),
	'height' => $this->l('Height'),
	'depth' => $this->l('Depth'));
    $this->psFields1b = array(
	'reference' => $this->l('Reference'),
	'manufacturer' => $this->l('Manufacturer'),
	'ean13' => $this->l('EAN13'),
	'ecotax' => $this->l('Eco tax'),
	'ecotax vat' => $this->l('Eco tax +VAT'),
	'weight' => $this->l('Weight'),
	'description_short' => $this->l('Short description'),
	'description' => $this->l('Long description'),
	'description_test' => $this->l('Short or long description'),
	'link_rewrite' => $this->l('Link rewrite'),
	'feature' => $this->l('Feature'),
	'out_of_stock' => $this->l('Allow out of stock ordering'),
	'attribute_quantity' => $this->l('Attribute quantity'),
	'attribute_group' => $this->l('Attribute group'),
	'attribute_group_comb' => $this->l('Attribute group comb.'),
	'attribute_name' => $this->l('Attribute name'),
	'attribute_value' => $this->l('Attribute value'),
	'attribute_value_adj' => $this->l('Attribute value +adj.'),
	'attribute_value_amp' => $this->l('Attribute value amp.'),
	'attribute_price_adjust' => $this->l('Attribute price adjust'),
	'attribute_weight_adjust' => $this->l('Attribute weight adjust'),
	'attribute_ref' => $this->l('Attribute reference'),
	'attribute_supplier_ref' => $this->l('Attribute supplier ref.'),
	'attribute_ean13' => $this->l('Attribute EAN13'),
	'attribute_upc' => $this->l('Attribute UPC'),
	'attribute_image' => $this->l('Attribute image URL'),
	'attribute_group_dash' => $this->l('Attribute group dash'),
	'attribute_value_dash' => $this->l('Attribute value dash'),
	'attribute_default' => $this->l('Attribute default'),
	'attribute_enabled' => $this->l('Attribute enabled'),
	'property' => $this->l('Property'),
	'available_now' => $this->l('Available now'),
	'available_later' => $this->l('Available later'),
	'location' => $this->l('Location'),
	'accessories' => $this->l('Accessories'),
	'product_field' => $this->l('Customer field'),
	'discount_qty_pct' => $this->l('Discount qty/pct'),
	'tags' => $this->l('Tags'),
	'meta_description' => $this->l('Meta description'),
	'meta_keywords' => $this->l('Meta keywords'),
	'meta_title' => $this->l('Meta title'));
    if ($this->v14) {
      // 1.4 or later
      $this->psFields1 = array_merge($this->psFields1a,
	  $this->psFields1_14, $this->psFields1b);
      unset($this->psFields1['id_tax']);
    }
    else {
      // Before 1.4
      $this->psFields1 = array_merge($this->psFields1a,
	  $this->psFields1_13, $this->psFields1b);
      unset($this->psFields1['id_tax_rules_group']);
    }
    $this->psFields2 = array(
	'N/A' => $this->l('N/A'),
	'category 2nd' => $this->l('Category'),
	'sub_category' => $this->l('Sub-category'),
	'sub_sub_category' => $this->l('Sub-sub-category'),
	'sub_sub_sub_category' => $this->l('Sub-sub-sub-category'),
	'sub_category alpha' => $this->l('Sub-category alpha'),
	'description extra' => $this->l('Description extra'),
	'description_short append' => $this->l('Append to short description'),
	'description append' => $this->l('Append to long description'),
	'price_add' => $this->l('Add to price'),
	'reference 2nd' => $this->l('Reference'),
	'attribute_supplier_ref 2nd' => $this->l('Attribute supplier ref.'),
	'ean13 2nd' => $this->l('EAN13'),
	'tags 2nd' => $this->l('Tags'),
	'image_jpg' => $this->l('Image has this ID (.jpg)'),
	'image_gif' => $this->l('Image has this ID (.gif)'),
	'image' => $this->l('Image has this ID'),
	'manufacturer' => $this->l('Manufacturer'),
	'on_sale' => $this->l('On sale'));
    $this->defaultValues = array(
	'id_category_default' => $this->v15 ? 2 : 1,
	'active' => 1,
	'price' => 0,
	'weight' => 0,
	'on_sale' => 0,
	'show_price' => 1,
	'out_of_stock' => 2);
    $this->langFields = array(
	'name',
	'id_category',
	'category',
	'category 2nd',
	'manufacturer',
	'description',
	'description_short',
	'description_test',
	'link_rewrite',
	'sub_category',
	'sub_sub_category',
	'sub_sub_sub_category',
	'sub_category alpha',
	'description extra',
	'description append',
	'description_short append',
	'feature',
	'available_now',
	'available_later',
	'tags',
	'tags 2nd',
	'meta_description',
	'meta_keywords',
	'meta_title',
	'attribute_group');
    $this->catFields = array(
	'N/A' => $this->l('N/A'),
	'old_name' => $this->l('Old name'),
	'old_name_expr' => $this->l('Old name expr.'),
	'new_name' => $this->l('New name'),
	'parent' => $this->l('Parent')
      );
    $this->catLangFields = array('alias');
    // Meta tags
    $this->metaTypes = array('meta_description', 'meta_keywords', 'meta_title');
    $this->metaFields = array(
      $this->l('Shop name') => 'shop_name',
      $this->l('Name') => 'name',
      $this->l('Reference') => 'reference',
      $this->l('Supplier reference') => 'supplier_reference',
      $this->l('Manufacturer') => 'manufacturer',
      $this->l('Category') => 'category',
      $this->l('Features') => 'features',
      $this->l('Short description') => 'description_short',
      $this->l('Long description') => 'description'
    );
    $this->replaceTables = array(
      'image',
      'image_lang',
      'image_shop',
      'specific_price',
      'accessory',
      'feature',
      'feature_lang',
      'feature_value',
      'feature_value_lang',
      'feature_product',
      'product_tag'
    );
    $this->preserveTables = array(
      'category_lang',
      'tag'
    );
    $this->updateTables = array(
      'product',
      'product_lang',
      'product_shop',
      'product_supplier',
      'stock_available',
      'product_attribute',
      'product_attribute_shop',
      'tag'
    );
    ini_set('display_errors', 1);
    error_reporting(E_ALL | E_STRICT);
    ini_set('max_execution_time', 1000);
    $limit = ini_get('memory_limit');
    if (substr($limit, -1, 1) == 'M' && substr($limit, 0, -1) < 256)
      ini_set('memory_limit', '256M');
  }

  public function getMaxId($name)
  {
    $query = 'SELECT MAX(id_'.$name.') AS id FROM `'._DB_PREFIX_.$name.'`';
    $res = Db::getInstance()->getRow($query);
    if (!$res) {
      printf("<p>%s</p>", $query);
      printf("<p>%s</p>", Db::getInstance()->getMsgError());
    }
    if (empty($res['id']))
      return 1;
    return $res['id'];
  }

  public function query($sql)
  {
    if (isset($this->dbFp))
      fprintf($this->dbFp, "%s\n", $sql);
    if ($this->v15)
      return Db::getInstance()->query($sql);
    else
      return $this->Execute($sql);
  }

  public function Execute($sql)
  {
    if (isset($this->dbFp))
      fprintf($this->dbFp, "%s\n", $sql);
    $res = Db::getInstance()->Execute($sql);
    if (!$res)
      $this->noCommit = true;
    return $res;
  }

  public function ExecuteS($sql, $array = true)
  {
    if (isset($this->dbFp))
      fprintf($this->dbFp, "%s\n", $sql);
    return Db::getInstance()->ExecuteS($sql, $array);
  }

  public function stream_get_line($fp, $length, $endTag, &$eof)
  {
    if (!isset($this->utf16)) {
      $line = fread($fp, 2);
      if ($line == chr(0xFE).chr(0xFF))
	$this->utf16 = "UTF-16BE";
      elseif ($line == chr(0xFF).chr(0xFE))
	$this->utf16 = "UTF-16LE";
      else {
	$this->utf16 = false;
	rewind($fp);
      }
      if ($this->utf16) {
	$endTag16 = mb_convert_encoding($endTag, $this->utf16, "UTF-8");
	$line = stream_get_line($fp, 0x100000, $endTag16);
	$line = mb_convert_encoding($line, "UTF-8", $this->utf16);
	$line = preg_replace('/"UTF-16"/', '"UTF-8" ', $line);
      }
    }
    else {
      if ($this->utf16) {
	fread($fp, 1);
	$endTag16 = mb_convert_encoding($endTag, $this->utf16, "UTF-8");
	$line = stream_get_line($fp, 0x100000, $endTag16);
	$line = mb_convert_encoding($line, "UTF-8", $this->utf16);
      }
    }
    if ($this->utf16 == false) {
      // Come here normally
      $line = stream_get_line($fp, 0x100000, $endTag);
      if (strlen($line) == 0x100000) {
	// Read even more
	$line .= stream_get_line($fp, 0x1000000, $endTag);
      }
      $pos = strpos($line, $endTag);
      if ($pos !== false) {
	// PHP bug
	print phpversion()."\n";
	die('PHP bug');
      }
    }
    $eof = feof($fp);
    if (!$eof)
      $line .= $endTag;
    // $this->dump($line, 'LINE', true);
    if (function_exists('importfast_xml_filter'))
      importfast_xml_filter($this, $line);
    return $line;
  }


  public function deleteList($name, $field, &$entries, $cond = '')
  {
    $count = 0;
    if ($entries) {
      $delList = implode(",", array_keys($entries));
      if (in_array($name, $this->preserveTables) ||
	  $this->importType == 1 && !in_array($name, $this->replaceTables))
      {
	if (!in_array($name, $this->updateTables)
	    && !in_array($name, $this->preserveTables))
	  return 0;
	$query = 'SELECT * FROM `'._DB_PREFIX_.$name.'` WHERE `'.$field.'` IN ('.$delList.')'.$cond;
	$this->savedRows = array_merge($this->savedRows, $this->ExecuteS($query));
      }
      $query = 'DELETE FROM `'._DB_PREFIX_.$name.'` WHERE `'.$field.'` IN ('.$delList.')'.$cond;
      $res = $this->Execute($query);
      $count = Db::getInstance()->Affected_Rows();
      if (!$res) {
	printf("<p>%s</p>", $query);
	printf("<p>%s</p>", Db::getInstance()->getMsgError());
      }
    }
    return $count;
  }

  public function deleteListIn($name, $field, $nameIn, $fieldIn, &$entries)
  {
    $count = 0;
    if ($entries) {
      $delList = implode(",", array_keys($entries));
      if (in_array($name, $this->preserveTables) ||
	$this->importType == 1 && !in_array($name, $this->replaceTables))
      {
	if (!in_array($name, $this->updateTables)
	    && !in_array($name, $this->preserveTables))
	  return 0;
	$query = 'SELECT * FROM `'._DB_PREFIX_.$name.'`
	  WHERE `'.$field.'`
	  IN (SELECT `'.$field.'` FROM `'._DB_PREFIX_.$nameIn.'`
	  WHERE `'.$fieldIn.'` IN ('.$delList.'))';
	$this->savedRows = array_merge($this->savedRows, $this->ExecuteS($query));
      }
      $query = 'DELETE FROM `'._DB_PREFIX_.$name.'`
	WHERE `'.$field.'`
	IN (SELECT `'.$field.'` FROM `'._DB_PREFIX_.$nameIn.'`
	WHERE `'.$fieldIn.'` IN ('.$delList.'))';
      $res = $this->Execute($query);
      $count = Db::getInstance()->Affected_Rows();
      if (!$res) {
	printf("<p>%s</p>", $query);
	printf("<p>count %d</p>", $count);
	printf("<p>%s</p>", Db::getInstance()->getMsgError());
      }
    }
    return $count;
  }

  public function deactivateList($name, $field, &$entries, $cond = '')
  {
    $count = 0;
    if ($entries) {
      $daList = implode(",", array_keys($entries));
      $query = 'UPDATE `'._DB_PREFIX_.$name.'`
	SET `active` = 0, `date_upd` = '.$this->quote(date('Y-m-d H:i:s')).'
	WHERE `'.$field.'` IN ('.$daList.')'.$cond;
      $res = $this->Execute($query);
      $count += Db::getInstance()->Affected_Rows();
      if (!$res) {
	printf("<p>%s</p>", $query);
	printf("<p>%s</p>", Db::getInstance()->getMsgError());
      }
    }
    return $count;
  }

  public function mergeRecords($name, &$keys, &$entries)
  {
    if ($this->v15)
      $primaryKeyTable = array(
	'category_lang' => array('id_category', 'id_shop', 'id_lang'),
	'product' => array('id_product'),
	'product_lang' => array('id_product', 'id_shop', 'id_lang'),
	'product_shop' => array('id_product', 'id_shop'),
	'product_supplier' => array('id_product_supplier'),
	'stock_available' =>
	array('id_product', 'id_product_attribute', 'id_shop'),
	'product_attribute' => array('id_product_attribute'),
	'product_attribute_shop' => array('id_product_attribute', 'id_shop'),
	'tag' => array('id_tag', 'id_lang')
      );
    else
      $primaryKeyTable = array(
	'category_lang' => array('id_category', 'id_lang'),
	'product' => array('id_product'),
	'product_lang' => array('id_product', 'id_lang'),
	'product_supplier' => array('id_product_supplier'),
	'product_attribute' => array('id_product_attribute'),
	'tag' => array('id_tag', 'id_lang')
      );
    $primaryKeys = $primaryKeyTable[$name];
    $keyIndexes = array();
    foreach ($primaryKeys as $primaryKey) {
      $index = array_search($primaryKey, $keys);
      if ($index !== false)
	$keyIndexes[] = $index;
    }
    $savedRows = array();
    foreach ($this->savedRows as $savedRow) {
      if (empty($savedKeys))
	$savedKeys = array_keys($savedRow);
      $id = '';
      foreach ($primaryKeys as $primaryKey)
	$id .= $savedRow[$primaryKey].',';
      foreach ($savedRow as $k => &$v) {
	if ($v == 0 && $k == 'cache_default_attribute')
	  $v = 0;
	if ($this->v16 && $v == 0 && $k == 'default_on')
	  $v = "\000";
	else
	  $v = pSQL($v, true);
      }
      $savedRows[$id] = $savedRow;
    }
    $this->savedRows = array();
    $preserveFlag = in_array($name, $this->preserveTables);
    // $this->dump($savedRows, 'before '.$name);
    foreach ($entries as $entry) {
      $values = $this->ungroup($entry);
      $id = '';
      foreach ($keyIndexes as $keyIndex)
	$id .= $values[$keyIndex].',';
      if (empty($savedRows[$id])) {
	if ($preserveFlag) {
	  if (isset($savedKeys)) {
	    foreach ($savedKeys as $key)
	      $savedRows[$id][$key] = '';
	  }
	  for ($j = 0; $j < count($keys); $j++) {
	    $key = $keys[$j];
	    $savedRows[$id][$key] = $values[$j];
	  }
	}
	continue;
      }
      for ($j = 0; $j < count($keys); $j++) {
	$key = $keys[$j];
	if (isset($values[$j]) && $values[$j] !== '')
	  $savedRows[$id][$key] = $values[$j];
	else {
	  if (!isset($savedRows[$id][$key]))
	    $savedRows[$id][$key] = '';
	}
      }
      if ($name == 'product' && $savedRows[$id]['active'] == 2)
	$savedRows[$id]['active'] = 1;
    }
    // $this->dump($savedRows, 'after '.$name);
    $entries = array();
    foreach ($savedRows as $row) {
      $entries[] = $this->group(array_values($row));
    }
    if (isset($savedKeys))
      $keys = $savedKeys;
  }

  public function insertRecords($name, &$keyStr, &$valStr, $ignore)
  {
    if (!$valStr)
      return;
    $valStr = str_replace("'\000'", 'NULL', $valStr);
    $query = sprintf('INSERT '.$ignore.' INTO `%s%s` %s VALUES %s',
      _DB_PREFIX_, $name, $keyStr, $valStr);
    // $this->dump($query);
    $res = $this->Execute($query);
    if (!$res) {
      printf("<p>%s</p>", $query);
      printf("<p>%s</p>", Db::getInstance()->getMsgError());
    }
  }

  public function updateDatabase($name, &$entries, $keyEntry, $ignore = '')
  {
    if (!defined('IMPF_SQL_QUERY_LEN'))
      define('IMPF_SQL_QUERY_LEN', 100000);
    if ($this->importType == 1 &&
	!in_array($name, $this->replaceTables) &&
	!in_array($name, $this->updateTables))
      return 0;
    if (isset($keyEntry[$this->defLang]) &&
	is_array($keyEntry[$this->defLang]))
      $keyEntry = $keyEntry[$this->defLang];
    $keys = array_keys($keyEntry);
    if (in_array($name, $this->preserveTables) ||
	$this->importType == 1 && !in_array($name, $this->replaceTables))
      $this->mergeRecords($name, $keys, $entries);
    $keyStr = $this->group($keys, 'backquote');
    if (count($entries) > 0) {
      $valStr = implode(',', $entries);
      if (strlen($valStr) > IMPF_SQL_QUERY_LEN) {
	// Oh my, string too long
	$len = 0;
	foreach ($entries as $entry) {
	  if ($len == 0) {
	    $valStr = $entry;
	    $len = strlen($entry);
	  }
	  else {
	    $valStr .= ','.$entry;
	    $len += strlen($entry) + 1;
	  }
	  if ($len > IMPF_SQL_QUERY_LEN) {
	    $this->insertRecords($name, $keyStr, $valStr, $ignore);
	    $len = 0;
	    $valStr = '';
	  }
	}
      }
    }
    $this->insertRecords($name, $keyStr, $valStr, $ignore);
    $entries = array();
  }

  public function updateValue($name, &$entries, $keyEntry)
  {
    $refs = array();
    $whenThen = array();
    foreach ($entries as $entry) {
      $values = $this->ungroup($entry);
      $ref = $values[0];
      $val = $values[1];
      $refs[] = $ref;
      $whenThen[] = 'WHEN "'.$ref.'" THEN '.$val;
    }
    if ($whenThen) {
      $refs = $this->group($refs);
      $whenThen = implode("\n", $whenThen);
      $keys = array_keys($keyEntry);
      $query = 'UPDATE `'._DB_PREFIX_.$name.'`
	SET `'.$keys[1].'` = CASE `'.$keys[0].'`
	'.$whenThen.' END
	WHERE `'.$keys[0].'` IN '.$refs;
      $this->Execute($query);
    }
  }

  public function makeShopDesc($name)
  {
    $rowShopDesc = array();
    $description =
      $this->ExecuteS('DESCRIBE `'._DB_PREFIX_.$name.'`');
    foreach ($description as $k => $v)
      $rowShopDesc[] = $v['Field'];
    return $rowShopDesc;
  }

  public function makeShopFields($rowShopDesc, $row, &$rowShop, &$rowShops, $defField = false)
  {
    foreach ($rowShopDesc as $desc) {
      if (isset($row[$desc]))
	$rowShop[$desc] = $row[$desc];
    }
    if ($defField)
      $rowShop[$defField] = 0;
    foreach ($this->shopIds as $shopId) {
      if (in_array('id_stock_available', $rowShopDesc) &&
	  $this->shareStock[$shopId])
	$rowShop['id_shop'] = 0;
      else
	$rowShop['id_shop'] = $shopId;
      if (in_array('id_shop_group', $rowShopDesc)) {
	if ($this->shareStock[$shopId])
	  $rowShop['id_shop_group'] = $this->shopGroupIds[$shopId];
	else
	  // Must use 0 index for 1.6.0.7 and later
	  $rowShop['id_shop_group'] = 0;
      }
      $rowShops[] = $this->group($rowShop);
    }
  }

  public function link_rewrite($str)
  {
    if (function_exists('importfast_link_rewrite'))
      return importfast_link_rewrite($str);
    $str = iconv("UTF-8", "ASCII//TRANSLIT//IGNORE", $str);
    $str = str_replace(' ', '-', $str);
    $str = preg_replace('/[^A-Za-z0-9-]/', '', $str);
    return strtolower($str);
  }

  public function categoryUpdate()
  {
    global $smarty;

    if ($this->v14) {
      $categoryObj = new Category(1); // Root/Home category
      Category::regenerateEntireNtree();
      if ($this->v15) {
	Hook::exec('categoryUpdate', array('category' => $categoryObj));
	Tools::clearCache($smarty);
      }
      else
	Module::hookExec('categoryUpdate', array('category' => $categoryObj));
    }
  }

  function tagAttrAssign($xmlAttrTag, $attrValue, $endTag)
  {
    switch ($xmlAttrTag) {
    case $this->attributeNameTag:
      $this->attributeGroupName = $attrValue;
      break;
    case $this->attributeQuantityTag:
      $this->attrLater['quantity'] = $attrValue;
      break;
    case $this->attributePriceAdjustTag:
      if ($attrValue) {
	$tk = $this->attributeGroupName;
	$this->attrLater['priceAdj'] = array($tk => $attrValue);
      }
      break;
    case $this->attributeWeightAdjustTag:
      if ($attrValue) {
	$tk = $this->attributeGroupName;
	$this->attrLater['weightAdj'] = array($tk => $attrValue);
      }
      break;
    case $this->attributeRefTag:
      $this->attrLater['ref'] = $attrValue;
      break;
    case $this->attributeSupRefTag:
      $this->attrLater['supRef'] = $attrValue;
      break;
    case $this->attributeImage:
      $this->attrLater['url'] = $attrValue;
      break;
    case $this->attributeEan13Tag:
      $this->attrLater['ean13'] = $attrValue;
      break;
    case $this->attributeUpcTag:
      $this->attrLater['upc'] = $attrValue;
      break;
    case $this->attributeEnabledTag:
      if ($attrValue == 'false' || $attrValue == '0') {
	unset($this->attrLater);
      }
      break;
    case $this->attributeGroupTag:
      // There must always be an attribute group configured.
      // If XML file has no attribute group
      // attributeGroupTag must be configured as attribute group.
      if (!$endTag) {
	$this->attributeGroupName = $attrValue;
	break;
      }
      // Continue here when attribute is complete
      if (empty($this->attrLater))
	break;
      if ($this->attributeCombFlag && $this->attributeGroupName) {
	$tk = $this->attributeGroupName;
	if (count($this->attributes) == 0) {
	  // Just assign
	}
	elseif (isset($this->attributes[0]['values'][$tk])) {
	  // Must add to existing groups
	  $value0 = $this->attributes[0]['values'][$tk];
	  $attrSize = count($this->attributes);
	  if ($attrSize >= 2000) {
	    $this->attrBig = $attrSize;
	    $this->attrLater = array();
	    break;
	  }
	  for ($i = 0; $i < $attrSize; $i++) {
	    // Clone first set
	    $av = $this->attributes[$i];
	    if ($av['values'][$tk] == $value0) {
	      $av['values'][$tk] = $this->attrLater['values'][$tk];
	      if (isset($this->attrLater['priceAdj'][$tk]))
		$av['priceAdj'][$tk] = $this->attrLater['priceAdj'][$tk];
	      if (isset($this->attrLater['weightAdj'][$tk]))
		$av['weightAdj'][$tk] = $this->attrLater['weightAdj'][$tk];
	      $this->attributes[] = $av;
	    }
	  }
	  $this->attrLater = array();
	  break;
	}
	else {
	  foreach ($this->attributes as $ak => $av) {
	    $this->attributes[$ak]['values'][$tk] =
	      $this->attrLater['values'][$tk];
	    if (isset($this->attrLater['priceAdj'][$tk]))
	      $this->attributes[$ak]['priceAdj'][$tk] =
		$this->attrLater['priceAdj'][$tk];
	    if (isset($this->attrLater['weightAdj'][$tk]))
	      $this->attributes[$ak]['weightAdj'][$tk] =
		$this->attrLater['weightAdj'][$tk];
	  }
	  $this->attrLater = array();
	  break;
	}
      }
      $this->attributes[] = $this->attrLater;
      $this->attrLater = array();
      break;
    default:
      // Look for attribute value tag
      $tk = array_search($xmlAttrTag, $this->attributeValueTags);
      if ($tk === false)
	break;
      if ($this->attributeGroupName)
	$tk = $this->attributeGroupName;
      $priceAdj = 0;
      $weightAdj = 0;
      if (isset($this->attributeAdjFlag)) {
	$v = explode('|', $attrValue);
	if (count($v) >= 3) {
	  if ($v[1] == '-')
	    $v[2] = -$v[2];
	  $attrValue = $v[0];
	  $priceAdj = $v[2];
	}
      }
      // Use name for index if possible
      $this->attrLater['values'][$tk] = $attrValue;
      if ($priceAdj)
	$this->attrLater['priceAdj'][$tk] = $priceAdj;
      if ($weightAdj)
	$this->attrLater['weightAdj'][$tk] = $weightAdj;
      break;
    }
  }

  function tagStart($parser, $name, $attrs)
  {
    /*
    if ($this->foundItem && $name == $this->itemTag)
      die('PHP error in stream_get_line at '.$name);
     */
    array_push($this->xmlTag, $name);
    $node = array();
    // $node['name'] = $this->xmlTag;
    $xmlTag = implode('|', $this->xmlTag);
    // $this->xmlNames[$xmlTag] = '';
    if ($xmlTag == $this->attributeGroupTag) {
      // $this->attributeGroupName = 0;
      if (empty($this->attributeAdjFlag)) {
	$this->attrLater =
	  array('values' => array(), 'priceAdj' => array(),
	    'weightAdj' => array(), 'quantity' => NULL);
      }
    }
    if ($attrs) {
      $node['attr'] = array();
      foreach ($attrs as $k => $attr) {
	$node['attr'][$k] = $attr;
	$xmlAttrTag = $xmlTag.'|'.$k;
	if (!isset($this->xmlNames[$xmlAttrTag]))
	  $this->xmlNames[$xmlAttrTag] = $attr;
	$this->tagAttrAssign($xmlAttrTag, $attr, false);
      }
    }
    $node['value'] = '';
    $node['nodes'] = array();
    array_push($this->xmlData, $node);
  }

  function prodTagStartCustomer($parser, $name, $attrs) {
    $this->tagStart($parser, $name, $attrs);
    importfast_prod_tagStart($this, $name, $attrs);
  }

  function tagContent($parser, $value) {
    $lastNode = count($this->xmlData);
    if ($lastNode == 0)
      return;
    $this->xmlData[$lastNode - 1]['value'] .= $value;
  }

  function prodTagContentCustomer($parser, $value) {
    $value = importfast_prod_tagContent($this, $value);
    $this->tagContent($parser, $value);
  }

  function catTagContentCustomer($parser, $value) {
    $value = importfast_cat_tagContent($this, $value);
    $this->tagContent($parser, $value);
  }

  function tagEnd($parser, $name) {
    $xmlTag = implode('|', $this->xmlTag);
    array_pop($this->xmlTag);
    if ($name == $this->itemTag && !in_array($this->itemTag, $this->xmlTag)) {
      $this->foundItem = true;
      return;
    }
    $node = array_pop($this->xmlData);
    $node['name'] = $xmlTag;
    $lastNode = count($this->xmlData);
    if ($lastNode == 0)
      return;
    array_push($this->xmlData[$lastNode - 1]['nodes'], $node);
    if (empty($this->xmlNames[$xmlTag])) {
      $this->xmlNames[$xmlTag] = $node['value'];
      $this->xmlNodes[$xmlTag] = &$node;
    }
    $this->tagAttrAssign($xmlTag, $node['value'], true);
  }

  function prodTagEndCustomer($parser, $name) {
    $this->tagEnd($parser, $name);
    importfast_prod_tagEnd($this, $name);
  }

  function quote($str)
  {
    return "'".$str."'";
  }

  function backquote($str)
  {
    return "`".$str."`";
  }

  function quoteEscape($str)
  {
    return "'".pSQL($str, true)."'";
  }

  function group($entries, $quote = "quote")
  {
    return '('.implode(",", array_map(array($this, $quote), $entries)).')';
  }

  function ungroup($str, $quote = "quote")
  {
    return explode($this->$quote(','), substr($str, 2, -2));
  }

  function truncate($str, $len)
  {
    $str = str_replace('\"', '"', $str);
    $str = preg_replace('/\s+?(\S+)?$/', '', substr($str, 0, $len + 1));
    return str_replace('"', '\"', $str);
  }

  function mytrim($str)
  {
    if ($this->htmlMode)
      $str = html_entity_decode($str, ENT_QUOTES | ENT_XHTML, 'UTF-8');
      // $str = htmlspecialchars_decode($str);
    return trim($str);
  }

  function getDecVal($str)
  {
    if ($this->decimalComma)
      return str_replace(',', '.', str_replace('.', '', $str));
    else
      return str_replace(',', '', $str);
  }

  function convertToPic($url, $urlPrefix, $fieldName = NULL, $urlAppend = NULL)
  {
    $pic = $url;
    if ($fieldName == 'image_jpg') {
      $pic = $pic.'.jpg';
    }
    elseif ($fieldName == 'image_gif') {
      $pic = $pic.'.gif';
    }
    elseif ($fieldName == 'image') {
      $pic = $pic;
    }
    elseif ($fieldName) {
      $ua = explode(':', $urlAppend[$fieldName]);
      if (count($ua) == 3 && strlen($ua[0]) == 0)
	$pic = str_replace($ua[1], $ua[2], $pic);
      else
	$pic = $urlAppend[$fieldName].$pic;
    }
    $pic = str_replace(' ', '%20', $urlPrefix.$pic);
    return pSQL($pic);
  }

  function tagTransStart($parser, $name, $attrs)
  {
    if ($attrs) {
      foreach ($attrs as $k => $attr) {
	array_push($this->xmlAttrTag, $name.'|'.$k.'|'.$attr);
	break;
      }
    }
  }

  function aliasExprMatch(&$categoryAliasesExpr, &$name)
  {
    foreach ($categoryAliasesExpr as $regExp => $newName) {
      $name = preg_replace($regExp, $newName, $name, 1, $count);
      if ($count > 0)
	return true;
    }
    return false;
  }

  function tagTransContent($parser, $value)
  {
    $value = trim($value);
    if ($value) {
      $xmlTag = implode('|', $this->xmlAttrTag);
      if (strpos($xmlTag, '_locale_name_') === false || strpos($xmlTag, '_nl_NL') !== false)
	$this->xmlTranslations[$xmlTag] = $value;
    }
  }

  function tagTransEnd($parser, $name)
  {
    array_pop($this->xmlAttrTag);
  }

  function readTransFile($fileName, &$xmlData)
  {
    $fp = @fopen($fileName, "r");
    if (!$fp) {
      $this->_errors[] = $this->l('Could not open').' '.$fileName.' '.$this->l('for reading');
      return false;
    }
    $this->xmlTag = array();
    $this->xmlAttrTag = array();
    $this->xmlTranslations = array();
    $parser = xml_parser_create();
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, false);
    xml_set_object($parser, $this);
    xml_set_element_handler($parser, 'tagTransStart', 'tagTransEnd');
    xml_set_character_data_handler($parser, 'tagTransContent');
    while ($line = fgets($fp, 65536)) {
      if (strpos($line, '<locale ') !== false && strpos($line, $this->xmlLocale) === false)
	continue;
      if (!xml_parse($parser, $line, feof($fp))) {
	$this->_errors[] = $this->l('XML parsing failed at line').
	  sprintf(" %d: ", xml_get_current_line_number($parser)).
	  xml_error_string(xml_get_error_code($parser));
	return false;
      }
    }
    xml_parser_free($parser);
    fclose($fp);
    unset($this->utf16);
    return true;
  }

  function entryText($entries, $itemText = NULL)
  {
    $txt = str_replace(' ', '&nbsp;', sprintf("<code>%6d</code>", $entries));
    if ($entries == 1) {
      if ($itemText)
	return $txt.' '.$itemText.' ';
      else
	return $txt.' '.$this->l('entry').' ';
    }
    else {
      if ($itemText)
	return $txt.' '.$itemText.'s ';
      else
	return $txt.' '.$this->l('entries').' ';
    }
  }

  function getRootCategories()
  {
    $rootCategories = array(1 => 1);
    if ($this->v15) {
      $topCategory = Category::getTopCategory();
      $rootCategories[$topCategory->id] = $topCategory->id;
      $rows = Category::getRootCategories(NULL, false);
      foreach ($rows as $row)
	$rootCategories[$row['id_category']] = $row['id_category'];
    }
    return $rootCategories;
  }

  public function loadConfig()
  {
    $txt = $this->l('Load configuration');
    $fileFormat = Tools::getValue('fileFormat');
    $importType = Tools::getValue('importType');
    $supplierId = Tools::getValue('supplierId');
    $catFileName = Tools::getValue('catFileName');
    $prodFileName = Tools::getValue('prodFileName');
    $transFileName = Tools::getValue('transFileName');
    $supplier = new Supplier($supplierId);

    if ($supplierId == 0) {
      $this->_errors[] = $this->l('You must select a supplier');
      return false;
    }

    print '
      <fieldset>
      <legend><img src="../img/t/AdminImportFast.gif" />'.$txt.'</legend>
      <form id="preview_import" action="'.self::$currentIndex.'&amp;token='.$this->token.'"
      style="display: inline; clear: both;" method="post" enctype="multipart/form-data">';
    print '
      <label>Supplier</label>
      <div class="margin-form">
      <input value="'.$supplier->name.' ['.$supplier->id.']" type="text" disabled="disabled" size="30" />
      </div>';
    print '
      <label class="clear">'.$this->l('Select a config file').' </label>
      <div class="margin-form">
      <input name="file" type="file" />
      </div>';

    print '<div class="space margin-form">
      <input type="hidden" name="supplierId" value="'.$supplierId.'" />
      <input type="hidden" name="catFileName" value="'.$catFileName.'" />
      <input type="hidden" name="prodFileName" value="'.$prodFileName.'" />
      <input type="hidden" name="transFileName" value="'.$transFileName.'" />
      <input type="hidden" name="fileFormat" value="'.$fileFormat.'" />
      <input type="hidden" name="importType" value="'.$importType.'" />
      <input type="submit" name="uploadFile" value="'.$this->l('Upload').'" class="button" />
      <input type="submit" name="submitCancel" value="'.$this->l('Cancel').'" class="button" />
      </div>
      </form>
      </fieldset>';
    return true;
  }

  public function loadProd()
  {
    $txt = $this->l('Load configuration');
    $fileFormat = Tools::getValue('fileFormat');
    $importType = Tools::getValue('importType');
    $supplierId = Tools::getValue('supplierId');
    $catFileName = Tools::getValue('catFileName');
    $prodFileName = Tools::getValue('prodFileName');
    $transFileName = Tools::getValue('transFileName');
    $supplier = new Supplier($supplierId);

    print '
      <fieldset>
      <legend><img src="../img/t/AdminImportFast.gif" />'.$txt.'</legend>
      <form id="preview_import" action="'.self::$currentIndex.'&amp;token='.$this->token.'"
      style="display: inline; clear: both;" method="post" enctype="multipart/form-data">';
    print '
      <label class="clear">'.$this->l('Select'.' '.$fileFormat.' '.'file').' </label>
      <div class="margin-form">
      <input name="file" type="file" />
      </div>';
    print $this->l('Files may have been compressed with GZIP (suffix .gz).');

    print '<div class="space margin-form">
      <input type="hidden" name="supplierId" value="'.$supplierId.'" />
      <input type="hidden" name="catFileName" value="'.$catFileName.'" />
      <input type="hidden" name="prodFileName" value="'.$prodFileName.'" />
      <input type="hidden" name="transFileName" value="'.$transFileName.'" />
      <input type="hidden" name="fileFormat" value="'.$fileFormat.'" />
      <input type="hidden" name="importType" value="'.$importType.'" />
      <input type="submit" name="uploadProdFile" value="'.$this->l('Upload').'" class="button" />
      <input type="submit" name="submitCancel" value="'.$this->l('Cancel').'" class="button" />
      </div>
      </form>
      </fieldset>';
    return true;
  }

  public function uploadFile()
  {
    if (isset($_FILES['file'])
      && empty($_FILES['file']['error'])
      && file_exists($_FILES['file']['tmp_name']))
    {
      $supplierId = Tools::getValue('supplierId');
      $xml = simplexml_load_file($_FILES['file']['tmp_name']);
      $query = 'DELETE FROM `'._DB_PREFIX_.'importfast`
	WHERE `supplierId` = '.$supplierId;
      $this->Execute($query);
      print '
	<div class="conf confirm">
	<img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />
	'.$this->l('Upload successful').'
	</div>';
      $vals = array();
      $fields = array('supplierId',
	'type',
	'ext_field',
	'int_primary',
	'int_secondary',
	'int_lang',
	'int_feature');
      foreach ($xml as $node) {
	$val = array();
	foreach ($fields as $field) {
	  if ($field == 'supplierId')
	    $val[] = $supplierId;
	  elseif (isset($node->$field))
	    $val[] = $node->$field;
	  else
	    $val[] = '';
	}
	$vals[] = $this->group($val);
      }
      $query = 'INSERT INTO `'._DB_PREFIX_.'importfast` '.
	$this->group($fields, 'backquote').' VALUES '.
	implode(',', $vals);
      $res = $this->Execute($query);
      if (!$res) {
	$this->_errors[] = Db::getInstance()->getMsgError();
      }
    }
    else {
      $this->_errors[] = $this->l('Upload failed');
    }
    if ($this->_errors) {
      $text = '<h3>'.$this->l('Errors').'</h3>';
      $this->printError($text, $this->_errors);
      return false;
    }
    return true;
  }

  public function uploadProdFile()
  {
    $fileFormat = Tools::getValue('fileFormat');
    $compSuffix = substr($_FILES['file']['name'], -3);
    if ($compSuffix == '.gz') {
      $suffix = substr($_FILES['file']['name'], -7, 4);
      $fileName = substr($_FILES['file']['name'], 0, -3);
    }
    else {
      $compSuffix = '';
      $suffix = substr($_FILES['file']['name'], -4);
      $fileName = $_FILES['file']['name'];
    }
    if ($fileFormat == 'XML' && $suffix != '.xml' ||
      $fileFormat == 'CSV' && $suffix != '.csv' && $suffix != '.txt' && $suffix != '.tab')
    {
      $this->_errors[] = $this->l('Invalid file type');
      return false;
    }
    if (isset($_FILES['file'])
      && $_FILES['file']['error'] == UPLOAD_ERR_OK
      && file_exists($_FILES['file']['tmp_name']))
    {
      if ($compSuffix) {
	$gfp = gzopen($_FILES['file']['tmp_name'], "rb");
	$fp = fopen($this->adminPath.$fileName, "wb");
	$res = $gfp && $fp;
	while (!gzeof($gfp)) {
	  $data = gzread($gfp, 0x100000);
	  fwrite($fp, $data);
	}
	gzclose($gfp);
	fclose($fp);
      }
      else
	$res = copy($_FILES['file']['tmp_name'], $this->adminPath.$fileName);
      if ($res)
	printf("<p class='conf'>%s</p>",
	  $fileName.' '.$this->l('uploaded successfully'));
      else
	$this->_errors[] = $this->l('Copy failed');
    }
    else {
      $this->_errors[] = $this->l('Upload failed');
    }
    if ($this->_errors) {
      $text = '<h3>'.$this->l('Errors').'</h3>';
      $this->printError($text, $this->_errors);
      return false;
    }
    return true;
  }

  public function import($resume)
  {
    global $cookie;

    // apd_set_pprof_trace();
    ini_set('auto_detect_line_endings',true);
    $startTime = microtime(true);
    if ($resume) {
      $startEntry = intval(Tools::getValue('startEntry'));
      $lowQuantity = intval(Tools::getValue('lowQuantity'));
      $notValid = intval(Tools::getValue('notValid'));
      $badSupRef = intval(Tools::getValue('badSupRef'));
      $noPictures = intval(Tools::getValue('noPictures'));
      $noCategory = intval(Tools::getValue('noCategory'));
      $noAlias = intval(Tools::getValue('noAlias'));
      $duplicateProduct = intval(Tools::getValue('duplicateProduct'));
      $existingProduct = intval(Tools::getValue('existingProduct'));
      $attributeProduct = intval(Tools::getValue('attributeProduct'));
      $notActive = intval(Tools::getValue('notActive'));
      $addedProduct = intval(Tools::getValue('addedProduct'));
      $updatedProduct = intval(Tools::getValue('updatedProduct'));
      $deletedProducts = intval(Tools::getValue('deletedProducts'));
    }
    else {
      $startEntry = 0;
      $lowQuantity = 0;
      $notValid = 0;
      $badSupRef = 0;
      $noPictures = 0;
      $noCategory = 0;
      $noAlias = 0;
      $duplicateProduct = 0;
      $existingProduct = 0;
      $attributeProduct = 0;
      $notActive = 0;
      $addedProduct = 0;
      $updatedProduct = 0;
      $deletedProducts = 0;
    }
    $timeNow = date('Y-m-d H:i:s');
    $time0 = "0000-00-00 00:00:00";
    $prodFileName = $this->adminPath.Tools::getValue('prodFileName');
    $transFileName = $this->adminPath.Tools::getValue('transFileName');
    $supplierId = $cookie->supplierId = Tools::getValue('supplierId');
    $confSupplierId = Tools::getValue('confSupplierId', $supplierId);
    $fileFormat = Tools::getValue('fileFormat');
    $this->importType = Tools::getValue('importType');
    $urlField = false;
    $updField = false;
    $imgField = false;
    $mustStop = 0;
    $duplicateList = array();
    $notfoundList = array();
    $catSubs = array("0-9", "A-D", "E-H", "I-L", "M-P", "Q-T", "U-Z");
    $catSubs = array("0-9", "A-C", "D-F", "G-I", "J-L", "M-O", "P-R", "S-U", "V-Z");
    $defLang = intval(Configuration::get('PS_LANG_DEFAULT'));
    $defCurrency = Configuration::get('PS_CURRENCY_DEFAULT');
    $shopName = Configuration::get('PS_SHOP_NAME');
    $langs = array($defLang);
    $attrMap = array();
    $featMap = array();
    $prodFieldMap = array();
    $extraDataMap = array();
    $newFeature = array();
    $urlAppend = array();
    $this->defLang = $defLang;
    $this->savedRows = array();
    $this->attributeGroupTag = '';
    $this->attributeGroupName = 0;
    $this->attributeNameTag = '';
    $this->attributeValueTags = array();
    $this->attributeQuantityTag = '';
    $this->attributePriceAdjustTag = '';
    $this->attributeWeightAdjustTag = '';
    $this->attributeRefTag = '';
    $this->attributeSupRefTag = '';
    $this->attributeEan13Tag = '';
    $this->attributeUpcTag = '';
    $this->attributeImage = '';
    $this->attributeEnabledTag = '';
    $attributeGroups = array();
    $productList = array();
    $attributeList = array();
    $imgSubIndexes = array();
    $existedList = array();
    if ($supplierId == 0) {
      $this->_errors[] = $this->l('You must select a supplier');
      return;
    }
    if (Tools::getValue('db_log')) {
      $dbLogFile = 'db_log_'.$supplierId.'.txt';
      if (Tools::getValue('db_log') == 2)
	$dbFp = fopen($dbLogFile, 'a');
      else
	$dbFp = fopen($dbLogFile, 'w');
      if ($dbFp) {
	$this->dbFp = $dbFp;
	fprintf($this->dbFp, "Timestamp: %s\n", date('Y-m-d H:i:s'));
      }
    }
    foreach (Language::getLanguages() as $lang) {
      if ($lang['active'] && $lang['id_lang'] != $defLang)
	$langs[] = $lang['id_lang'];
    }
    $this->Execute('START TRANSACTION');
    $description =
      $this->ExecuteS('DESCRIBE `'._DB_PREFIX_.'image`');
    foreach ($description as $k => $v) {
      if ($v['Field'] == 'url')
	$urlField = true;
      if ($v['Field'] == 'date_upd')
	$updField = true;
      if ($v['Field'] == 'img_upd')
	$imgField = true;
    }
    if (!$urlField) {
      $this->Execute('ALTER TABLE `'._DB_PREFIX_.'image` '.
	  'ADD `url` TEXT');
      $this->_status[] = $this->l('Added URL column to image table');
    }
    if ($updField) {
      $this->Execute('ALTER TABLE `'._DB_PREFIX_.'image` '.
	  'CHANGE `date_upd` `img_upd` DATETIME NOT NULL');
      $this->_status[] = $this->l('Renamed img_upd column to date_upd in image table');
      $imgField = true;
    }
    if (!$imgField) {
      $this->Execute('ALTER TABLE `'._DB_PREFIX_.'image` '.
	  'ADD `img_upd` DATETIME NOT NULL');
      $this->_status[] = $this->l('Added img_upd column to image table');
    }
    if ($fileFormat == 'XML') {
      $this->_status[] = $this->l('File is XML format');
      if ($this->phpold) {
	$this->_errors[] =
	  $this->l('PHP version is deprecated').
	  ' ('.PHP_VERSION.'). '.
	  $this->l('Version must be later than 5.4.7.');
	return;
      }
    }
    else
      $this->_status[] = $this->l('File is CSV format');
    $supplier_reference_length = 1000;
    $description =
      $this->ExecuteS('DESCRIBE `'._DB_PREFIX_.'product`');
    foreach ($description as $k => $v) {
      if ($v['Field'] == 'supplier_reference')
      {
	$t = explode('(', $v['Type']);
	if ($t[0] == 'varchar' && (int)$t[1] < $supplier_reference_length)
	  $supplier_reference_length = (int)$t[1];
	break;
      }
    }
    $description =
      $this->ExecuteS('DESCRIBE `'._DB_PREFIX_.'product_supplier`');
    foreach ((array)$description as $k => $v) {
      if ($v['Field'] == 'product_supplier_reference')
      {
	$t = explode('(', $v['Type']);
	if ($t[0] == 'varchar' && (int)$t[1] < $supplier_reference_length)
	  $supplier_reference_length = (int)$t[1];
	break;
      }
    }

    if ($this->importType == 0) {
      $result = $this->ExecuteS('SELECT * FROM `'.
	_DB_PREFIX_.'importfast` WHERE `supplierId` = '.$confSupplierId.'
	AND `type` IN ("s", "x", "c")');
    }
    else {
      $result = $this->ExecuteS('SELECT * FROM `'.
	_DB_PREFIX_.'importfast` WHERE `supplierId` = '.$confSupplierId.'
	AND `type` IN ("s1", "x1", "c1")');
    }
    if (!$result) {
      $this->_errors[] = $this->l('Import not configured');
      return;
    }
    $fieldMap = array();
    $langMap = array();
    $setup = array();
    $metaTypes = array();
    foreach ((array)$result as $f) {
      if ($f['type'] == 's' || $f['type'] == 's1') {
	if ($this->importType == 0 && $f['type'] == 's' ||
	    $this->importType == 1 && $f['type'] == 's1')
	{
	  if (substr($f['ext_field'], 0, 5) == "meta_") {
	    $m = explode('-', $f['ext_field']);
	    $metaTypes[$m[0]][$m[1]] = true;
	    $setup[$m[0]][$m[1]] = $f['int_primary'];
	  }
	  else
	    $setup[$f['ext_field']] = $f['int_primary'];
	}
      }
      else {
	$fieldMap[$f['int_primary']] = $f['ext_field'];
	$fieldMap[$f['int_secondary']] = $f['ext_field'];
	if (in_array($f['int_primary'], $this->langFields)) {
	  if ($f['int_lang'])
	    $langMap[$f['int_primary']][$f['int_lang']] = $f['ext_field'];
	  else
	    $langMap[$f['int_primary']][$defLang] = $f['ext_field'];
	}
	if (in_array($f['int_secondary'], $this->langFields)) {
	  if ($f['int_lang'])
	    $langMap[$f['int_secondary']][$f['int_lang']] = $f['ext_field'];
	  else
	    $langMap[$f['int_secondary']][$defLang] = $f['ext_field'];
	}
	if ($f['int_primary'] == 'feature')
	  $featMap[$f['ext_field']] = $f['int_feature'];
	elseif ($f['int_primary'] == 'product_field')
	  $prodFieldMap[$f['ext_field']] = $f['int_feature'];
	elseif ($f['int_primary'] == 'attribute_value' ||
	  $f['int_primary'] == 'attribute_value_dash' ||
	  $f['int_primary'] == 'attribute_value_adj' ||
	  $f['int_primary'] == 'attribute_value_amp')
	{
	  $attrMap[$f['ext_field']] = $f['int_feature'];
	  if ($f['int_feature'])
	    $k = $f['int_feature'];
	  else
	    list($k) = array_slice(explode('|', $f['ext_field']), -1);
	  $this->attributeValueTags[$k] = $f['ext_field'];
	  if ($f['int_primary'] == 'attribute_value_adj')
	    $this->attributeAdjFlag = true;
	}
	else
	  $extraDataMap[$f['ext_field']] = $f['int_feature'];
	if (substr($f['int_primary'], 0, 3) == 'url') {
	  $urlAppend[$f['int_primary']] = $f['int_feature'];
	  $lastUrl = $f['int_primary'];
	}
	if (substr($f['int_primary'], 0, 5) == 'image')
	  $lastUrl = $f['int_primary'];
      }
    }
    $row = Db::getInstance()->getRow('SELECT * FROM `'.
      _DB_PREFIX_.'importfast` WHERE `supplierId` = '.$confSupplierId.'
      AND `ext_field` = "skipNoAlias"
      AND `type` = "g"');
    $demandAlias = $row && $row['int_primary'];
    if ($resume) {
      if (empty($setup['resume'])) {
	$this->_status = array($this->l('No more to import'));
	return;
      }
      $startEntry = $setup['resume'];
    }
    // Fix ordering
    foreach ($metaTypes as $k => $v) {
      $val = array();
      foreach ($this->metaFields as $m) {
	if (isset($v[$m]))
	  $val[] = $m;
      }
      $metaTypes[$k] = $val;
    }
    foreach ($langs as $lang) {
      foreach ($langMap as $fieldName => $langm) {
	if (!isset($langm[$lang])) {
	  if (isset($langm[$defLang]))
	    $langMap[$fieldName][$lang] = $langm[$defLang];
	  else
	    $langMap[$fieldName][$lang] = $fieldMap[$fieldName];
	}
      }
    }
    if (isset($fieldMap['category 2nd'])) {
      $fieldMap['category'] = $fieldMap['category 2nd'];
      $fieldMap['sub_category'] = $fieldMap['category 2nd'];
      $langMap['category'] = $langMap['category 2nd'];
      $langMap['sub_category'] = $langMap['category 2nd'];
      unset($fieldMap['category 2nd']);
    }
    if (!$fieldMap) {
      $this->_errors[] = $this->l('Import not configured for').' '.$fileFormat;
      return;
    }
    if (!isset($fieldMap['supplier_reference']) && !isset($fieldMap['supplier_ref_expr'])) {
      $this->_errors[] = $this->l('Supplier reference not configured');
      return;
    }
    if ($this->importType == 0 && !isset($fieldMap['name'])) {
      $this->_errors[] = $this->l('Name not configured');
      return;
    }
    $tagFlag = isset($fieldMap['tags']) || isset($fieldMap['tags 2nd']);
    $attrDefFlag = isset($fieldMap['attribute_default']);
    $minQuantity = $setup['minQuantity'];
    $pickingFee = $setup['pickingFee'];
    $defaultQuantity = $setup['defaultQuantity'];
    $defaultCategory = $setup['defaultCategory'];
    $priceRange1 = $setup['priceRange1'];
    $priceRange2 = $setup['priceRange2'];
    $priceRange3 = $setup['priceRange3'];
    $priceProfit1 = $setup['priceProfit1'];
    $priceProfit2 = $setup['priceProfit2'];
    $priceProfit3 = $setup['priceProfit3'];
    $priceProfit4 = $setup['priceProfit4'];
    $maxExecution = $setup['maxExecution'];
    $categorySep = $setup['categorySep'];
    $subCategorySep = $setup['subCategorySep'];
    $categoryPrefix = $setup['categoryPrefix'];
    $imageSep = $setup['imageSep'];
    $urlPrefix = $setup['urlPrefix'];
    $supplierUrl = $setup['supplierUrl'];
    $descRegExp1 = $setup['descRegExp1'];
    $descReplace1 = $setup['descReplace1'];
    $descRegExp2 = $setup['descRegExp2'];
    $descReplace2 = $setup['descReplace2'];
    $taxId = $setup['taxId'];
    $impCurrency = $setup['impCurrency'];
    $deleteOld = $setup['deleteOld'];
    $disableProducts = $setup['disableProducts'];
    $zeroProducts = $setup['zeroProducts'];
    $demandPicture = $setup['demandPicture'];
    $onlyNew = $setup['onlyNew'];
    $this->decimalComma = $setup['decimalComma'];
    $featureColon = $setup['featureColon'] ? ':' : '';
    $keepBackslash = $setup['keepBackslash'];
    $categoryLeaf = $setup['categoryLeaf'];
    $categoriesPersistent = $setup['categoriesPersistent'];
    $demandPrice = $setup['demandPrice'];
    $demandWeight = $setup['demandWeight'];
    $demandProduct = $setup['demandProduct'];
    $demandCategory = $setup['demandCategory'];
    $this->htmlMode = $setup['htmlMode'];
    $skipFirstItem = $setup['skipFirstItem'];
    $skipFirstLines = $setup['skipFirstLines'];
    $this->iso8859 = $setup['iso8859'];
    $productEndTag = $setup['productEndTag'];
    $this->xmlLocale = $setup['xmlLocale'];
    $this->itemSep = $setup['itemSep'];
    if ($this->itemSep == "tab")
      $this->itemSep = "\t";
    $this->enclosure = $setup['enclosure'];
    $attributeValueFlag = false;
    if ($this->xmlLocale == 'nl_BE')
      $this->xmlLocale == 'nl_NL';
    if ($this->importType == 0 && !isset($fieldMap['id_category']) && !isset($fieldMap['category'])) {
      $fieldMap['category'] = '';
      foreach ($langs as $lang)
	$langMap['category'][$lang] = '';
    }
    if (isset($fieldMap['id_category']) && isset($fieldMap['category'])) {
      // Already mapped
      unset($fieldMap['id_category']);
    }
    $this->attributeCombFlag = false;
    if (isset($fieldMap['attribute_group']))
      $this->attributeGroupTag = $fieldMap['attribute_group'];
    if (isset($fieldMap['attribute_name']))
      $this->attributeNameTag = $fieldMap['attribute_name'];
    if (isset($fieldMap['attribute_group_comb'])) {
      $this->attributeGroupTag = $fieldMap['attribute_group_comb'];
      $this->attributeCombFlag = true;
    }
    if (isset($fieldMap['attribute_value_amp'])) {
      $fieldMap['attribute_group'] = $fieldMap['attribute_value_amp'];
      $attributeValueFlag = true;
      $this->attributeCombFlag = true;
    }
    if (isset($fieldMap['attribute_group_dash']))
      $this->attributeGroupTag = $fieldMap['attribute_group_dash'];
    if (isset($fieldMap['attribute_quantity']))
      $this->attributeQuantityTag = $fieldMap['attribute_quantity'];
    if (isset($fieldMap['attribute_price_adjust']))
      $this->attributePriceAdjustTag = $fieldMap['attribute_price_adjust'];
    if (isset($fieldMap['attribute_weight_adjust']))
      $this->attributeWeightAdjustTag = $fieldMap['attribute_weight_adjust'];
    if (isset($fieldMap['attribute_ref'])) $this->attributeRefTag = $fieldMap['attribute_ref'];
    if (isset($fieldMap['attribute_supplier_ref']))
      $this->attributeSupRefTag = $fieldMap['attribute_supplier_ref'];
    if (isset($fieldMap['attribute_ean13']))
      $this->attributeEan13Tag = $fieldMap['attribute_ean13'];
    if (isset($fieldMap['attribute_upc']))
      $this->attributeUpcTag = $fieldMap['attribute_upc'];
    if (isset($fieldMap['attribute_image']))
      $this->attributeImage = $fieldMap['attribute_image'];
    if (isset($fieldMap['attribute_enabled']))
      $this->attributeEnabledTag = $fieldMap['attribute_enabled'];
    if (isset($fieldMap['attribute_value']) &&
      !isset($fieldMap['attribute_group']) &&
      !isset($fieldMap['attribute_group_comb']))
    {
      $fieldMap['attribute_group'] = $fieldMap['attribute_value'];
      $attributeValueFlag = true;
    }
    $accessoryFlag = isset($fieldMap['accessories']);

    if ($this->v15) {
      $productShopDesc = $this->makeShopDesc('product_shop');
      $productAttributeShopDesc = $this->makeShopDesc('product_attribute_shop');
      $imageShopDesc = $this->makeShopDesc('image_shop');
      $categoryShopDesc = $this->makeShopDesc('category_shop');
      $attributeShopDesc = $this->makeShopDesc('attribute_shop');
      $attributeGroupShopDesc = $this->makeShopDesc('attribute_group_shop');
      $featureShopDesc = $this->makeShopDesc('feature_shop');
      $manufacturerShopDesc = $this->makeShopDesc('manufacturer_shop');
      $stockAvailableDesc = $this->makeShopDesc('stock_available');
      $this->shopIds = Shop::getContextListShopID();
      $this->shopIdDefault = reset($this->shopIds); // Get first element
      foreach ($this->shopIds as $shopId) {
	$shop = new Shop($shopId);
	$this->shopGroupIds[$shopId] = $shop->id_shop_group;
	$shopGroup = new ShopGroup($shop->id_shop_group);
	$this->shareStock[$shopId] =  $shopGroup->share_stock;
	unset($shop);
	unset($shopGroup);
      }
    }
    else {
      // For specific prices
      $this->shopIds = array(-1);
    }

    // Get translation file if any
    $transData = array();
    if (strpos(strtolower($transFileName), ".xml") !== false) {
      if (!$this->readTransFile($transFileName, $transData))
	return;
    }

    // Delete old deactivated products
    if ($deleteOld && $resume == false)
      $deletedProducts = self::deleteProducts(true, $deleteOld);

    // Get existing products
    if ($this->v15) {
      $res = $this->query('SELECT p.`id_product`, `id_image`, `date_add`,
	  `product_supplier_reference` AS supplier_reference,
	  `id_category_default`
	  FROM `'._DB_PREFIX_.'product` p
	  LEFT JOIN `'._DB_PREFIX_.'product_supplier` ps
	  ON p.`id_product` = ps.`id_product`
	  LEFT JOIN `'._DB_PREFIX_.'image` i
	  ON p.`id_product` = i.`id_product`
	  WHERE ps.`id_supplier` = '.$supplierId.'
	  AND `id_product_attribute` = 0
	  ORDER BY p.`id_product`, `id_image`');
    }
    else {
      $res = $this->query('SELECT p.`id_product`, `id_image`, `date_add`,
	  `supplier_reference`, `id_category_default`
	  FROM `'._DB_PREFIX_.'product` p
	  LEFT JOIN `'._DB_PREFIX_.'image` i
	  ON p.`id_product` = i.`id_product`
	  WHERE `id_supplier` = '.$supplierId.'
	  ORDER BY p.`id_product`, `id_image`');
    }
    while ($row = Db::getInstance()->nextRow($res)) {
      if (empty($productList[$row['supplier_reference']]))
	$productList[$row['supplier_reference']] = implode('|',
	  array($row['date_add'], $row['id_product'], $row['id_category_default'], '0', $row['id_image']));
      else
	$productList[$row['supplier_reference']] .= '|'.$row['id_image'];
    }
    if ((isset($fieldMap['attribute_supplier_ref']) ||
	  isset($fieldMap['attribute_supplier_ref 2nd'])) &&
	!isset($fieldMap['attribute_group']) && 
	!isset($fieldMap['attribute_name']) && 
	!isset($fieldMap['attribute_value']))
    {
      // Price/qty update based on supplier reference
      if ($this->v15) {
	$res = $this->query('SELECT pa.`id_product_attribute`,
	    `product_supplier_reference` AS supplier_reference,
	    p.`price`, p.`weight`
	    FROM `'._DB_PREFIX_.'product` p
	    LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
	    ON p.`id_product` = pa.`id_product`
	    LEFT JOIN `'._DB_PREFIX_.'product_supplier` ps
	    ON pa.`id_product_attribute` = ps.`id_product_attribute`
	    WHERE ps.`id_supplier` = '.$supplierId.'
	    AND pa.`id_product_attribute` != 0');
      }
      else {
	$res = $this->query('SELECT pa.`id_product_attribute`,
	    pa.`supplier_reference`,
	    p.`price`, p.`weight`
	    FROM `'._DB_PREFIX_.'product` p
	    LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
	    ON p.`id_product` = pa.`id_product`
	    WHERE `id_supplier` = '.$supplierId.'
	    AND `id_product_attribute` != 0');
      }
      while ($row = Db::getInstance()->nextRow($res)) {
	$attributeList[$row['supplier_reference']] =
	  $row['id_product_attribute'].'|'.
	  $row['price'].'|'.
	  $row['weight'];
      }
    }
    // Free some memory
    unset($res);

    if ($fileFormat == 'XML')
      $this->fp = $fp = @fopen($prodFileName, "rb");
    else
      $this->fp = $fp = @fopen($prodFileName, "rt");
    if (!$fp) {
      $this->_errors[] = $this->l('Could not open').' '.$prodFileName.' '.$this->l('for reading');
      return;
    }

    if ($resume == false) {
      // Mark active products for import
      $this->Execute('UPDATE `'._DB_PREFIX_.'product`
	SET `active` = 2
	WHERE `active` = 1 AND `id_supplier` = '.$supplierId);
    }

    $this->_status[] = $this->l('Starting at entry:'.' '.($startEntry + 1));
    $entryCount = 0;
    if ($this->v15) {
      $defaultShop = new Shop($this->shopIdDefault);
      $homeCategoryId = $defaultShop->id_category;
      $rootCategories = $this->getRootCategories();
      $defLevelDepth = 2;  // Default level depth
    }
    else {
      $homeCategoryId = 1; // Root category
      $rootCategories = array(1 => 1);
      $defLevelDepth = 1;  // Default level depth
    }
    $manId = array();
    $tagId = array();
    $newManId = array();
    $productDelete = array();
    $attributeDelete = array();
    $attributeGroupDelete = array();
    $product = array();
    $products = array();
    $productLangs = array();
    $productShop = array();
    $productShops = array();
    $productSupplier = array();
    $productSuppliers = array();
    $stockAvailable = array();
    $stockAvailables = array();
    $attrStockAvailable = array();
    $attrStockAvailables = array();
    $specificPrice = array();
    $specificPrices = array();
    $newSpecificPrices = array();
    $manufacturers = array();
    $manufacturerLangs = array();
    $manufacturerShop = array();
    $manufacturerShops = array();
    $productTag = array();
    $productTags = array();
    $tagLang = array();
    $tagLangs = array();
    $categoryProducts = array();
    $productAttributes = array();
    $productAttributeDelete = array();
    $productAttributeCombinations = array();
    $productAttributeShop = array();
    $productAttributeShops = array();
    $attributeShop = array();
    $attributeShops = array();
    $attributeGroupShop = array();
    $attributeGroupShops = array();
    $category = array();
    $categoryGroup = array();
    $categoryLang = array();
    $categoryShop = array();
    $categories = array();
    $categoryGroups = array();
    $categoryLangs = array();
    $categoryShops = array();
    $image = array();
    $images = array();
    $imageLang = array();
    $imageLangs = array();
    $imageDelete = array();
    $manufacturer = array();
    $manufacturerLang = array();
    $categoryProduct = array();
    $catId = array();
    $catPosition = array();
    $catActive = array();
    $catPositionId = array();
    $newCatId = array();
    $catSubId = array();
    $newCatSubId = array();
    $categoryObj = new Category($homeCategoryId);
    $catName = array();
    $catSubName = array();
    $productAttribute = array();
    $productAttributeCombination = array();
    $productAttributeImage = array();
    $productAttributeImages = array();
    $discountQuantity = array();
    $discountQuantities = array();
    $featId = array();
    $newFeatId = array();
    $featValId = array();
    $newFeatValId = array();
    $featureProduct = array();
    $featureProductDelete = array();
    $feature = array();
    $featureLang = array();
    $featureShop = array();
    $features = array();
    $featureLangs = array();
    $featureShops = array();
    $featureValue = array();
    $featureValues = array();
    $featureValueLang = array();
    $featureValueLangs = array();
    $accessory = array();
    $accessories = array();
    foreach ($langs as $lang) {
      foreach ($categoryObj->name as $name) {
	$catId[$name] = $homeCategoryId;
	$catName[$homeCategoryId][$lang] = $homeCategoryId;
      }
      $catId[$categoryObj->id] = $categoryObj->id;
      $catName[$categoryObj->id][$lang] = $categoryObj->id;
    }
    $taxRates = array();
    if ($this->v14) {
      if ($this->v15)
	$countryId = Context::getContext()->country->id;
      else
	$countryId = Country::getDefaultCountryId();
      $rows = $this->ExecuteS('SELECT *
	FROM `'._DB_PREFIX_.'tax` t
	LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr USING (`id_tax`)
	LEFT JOIN `'._DB_PREFIX_.'tax_rules_group` trg USING (`id_tax_rules_group`)
	WHERE t.`active` = 1 AND trg.`active` = 1');
      foreach ((array)$rows as $row) {
	$taxRate = $row['rate'];
	$taxRates[$taxRate] = $row['id_tax_rules_group'];
      }
      $taxRate = 0;
      $rows = $this->ExecuteS('SELECT *
	FROM `'._DB_PREFIX_.'tax` t
	LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr USING (`id_tax`)
	LEFT JOIN `'._DB_PREFIX_.'tax_rules_group` trg USING (`id_tax_rules_group`)
	WHERE t.`active` = 1 AND trg.`active` = 1 AND tr.`id_tax_rules_group` = '.$taxId);
      foreach ((array)$rows as $row) {
	$taxRate = $row['rate'];
	$taxRates[$taxRate] = $row['id_tax_rules_group'];
      }
    }
    else {
      $taxObj = new Tax($taxId);
      $taxRate = $taxObj->rate;
    }
    $currency = new Currency(Currency::getIdByIsoCode($impCurrency));
    if ($currency->id)
      $conversionRate = $currency->conversion_rate;
    else
      $conversionRate = 1;

    // Initialize global IDs
    $idProduct = self::getMaxId('product');
    $idImage = self::getMaxId('image');
    $idCategory = self::getMaxId('category');
    $idManufacturer = self::getMaxId('manufacturer');
    $idFeature = self::getMaxId('feature');
    $idFeatureVal = self::getMaxId('feature_value');
    $idProductAttribute = self::getMaxId('product_attribute');
    $idTag = self::getMaxId('tag');
    if ($this->v15)
      $idProductSupplier = self::getMaxId('product_supplier');
    if ($this->v14)
      $idSpecificPrice = self::getMaxId('specific_price');
    else
      $idDiscountQuantity = self::getMaxId('discount_quantity');

    // Get existing categories
    if ($this->v15)
      $rows = $this->ExecuteS('SELECT c.`id_category`, c.`active`,
	  c.`id_parent`, c.`level_depth`, cs.`position`, cl.`name`, cl.`id_lang`
	  FROM `'.  _DB_PREFIX_.'category` c
	  LEFT JOIN `'._DB_PREFIX_.'category_lang` cl
	  USING (`id_category`)
	  LEFT JOIN `'._DB_PREFIX_.'category_shop` cs
	  USING (`id_category`)
	  WHERE cs.`id_shop` IN '.$this->group($this->shopIds).'
	  ORDER BY cs.`position`');
    else
      $rows = $this->ExecuteS('SELECT c.`id_category`, c.`active`,
	  c.`id_parent`, c.`level_depth`, c.`position`, cl.`name`, cl.`id_lang`
	  FROM `'.  _DB_PREFIX_.'category` c
	  LEFT JOIN `'._DB_PREFIX_.'category_lang` cl
	  USING (`id_category`)
	  ORDER BY c.`position`');
    foreach ($rows as $row) {
      $name = trim($row['name']);
      $id_category = intval($row['id_category']);
      $catPosition[$id_category] = $row['position'];
      if (!$demandProduct)
	$catActive[$id_category] = $row['active'];
      if (isset($rootCategories[$row['id_parent']])) {
	$catId[$name] = $id_category;
	$catName[$id_category][$row['id_lang']] = ' '.$name;
	$catPositionId[$row['id_parent']] = $row['position'];
      }
      else {
	$catSubId[$row['id_parent'].$subCategorySep.$name] = $id_category;
	$catSubName[$id_category][$row['id_lang']] = ' '.$name;
	$catSubLevel[$id_category] = $row['level_depth'];
	$catPositionId[$homeCategoryId] = $row['position'];
      }
    }
    // Check for numeric default category
    $catSuperList = explode($categorySep, $defaultCategory);
    if (isset($catName[$catSuperList[0]][$defLang]) ||
	  isset($catSubName[$catSuperList[0]][$defLang]))
    {
      unset($fieldMap['category']);
      $fieldMap['id_category'] = '';
      foreach ($langs as $lang)
	$langMap['id_category'][$lang] = '';
    }
    $currentCategory = $defaultCategory;

    // Get existing manufacturers
    $rows = $this->ExecuteS('SELECT `id_manufacturer`, `name` FROM `'.
      _DB_PREFIX_.'manufacturer`');
    foreach ($rows as $row) {
      $manId[$row['name']] = $row['id_manufacturer'];
    }

    // Get existing tags
    $rows = $this->ExecuteS('SELECT *
	FROM `'._DB_PREFIX_.'tag`');
    foreach ($rows as $row) {
      $tagId[$row['name']][$row['id_lang']] = $row['id_tag'];
    }

    // Get existing features
    $rows = $this->ExecuteS('SELECT `id_feature`, `name` FROM `'.
      _DB_PREFIX_.'feature_lang`');
    // Currently no multi-language support
    foreach ($rows as $row) {
      $featId[$row['name']] = $row['id_feature'];
    }
    // Get existing feature values
    $rows = $this->ExecuteS('SELECT f.`id_feature`, f.`id_feature_value`, `value` FROM `'.
      _DB_PREFIX_.'feature_value` f, `'._DB_PREFIX_.'feature_value_lang` fl WHERE
      f.`id_feature_value` = fl.`id_feature_value`');
    // Currently no multi-language support
    foreach ($rows as $row) {
      $featValId[$row['id_feature']][$row['value']] = $row['id_feature_value'];
    }

    // Get existing attribute values
    $ags = AttributeGroup::getAttributesGroups($defLang);
    foreach ($ags as $ag) {
      $attributeGroups[$ag['name']] = $ag['id_attribute_group'];
    }
    $attributes = array();
    $as = Attribute::getAttributes($defLang);
    foreach ($as as $a) {
      $attributes[$a['id_attribute_group']][$a['name']] = $a['id_attribute'];
    }

    // Get existing product_attribute IDs
    $rows = $this->ExecuteS(
	'SELECT `id_product`, `id_product_attribute`, `id_attribute`
	FROM '._DB_PREFIX_.'product_attribute
	LEFT JOIN '._DB_PREFIX_.'product_attribute_combination
	USING (`id_product_attribute`)
	ORDER BY `id_product`, `id_product_attribute`, `id_attribute`', false);
    $pcombs = array();
    while ($row = Db::getInstance()->nextRow($rows)) {
      $pcombs[$row['id_product']][$row['id_product_attribute']][] = $row['id_attribute'];
    }
    $productAttributeIds = array();
    foreach ($pcombs as $pid => $pcomb) {
      foreach ($pcomb as $paid => $pa) {
	$productAttributeIds[$pid.','.implode(',', $pa)] = $paid;
      }
    }
    unset($pcombs);
    $newProductAttributeIds = array();

    // Get category aliases (if any)
    if ($this->readCategoriesFile($categoryAliases, $categoryAliasesExpr, $subCategorySep) == false)
      return false;
    $subCategoryAliasFlag = true;
    foreach ($categoryAliases as $catV) {
      if (strpos($catV, $subCategorySep) !== false) {
	$subCategoryAliasFlag = false;
	break;
      }
    }
    $this->itemTag = $setup['productTag'];

    // Get groups
    $rows = Group::getGroups($defLang);
    $priceGroups = array();
    foreach ($rows as $row) {
      $priceGroups[] = $row['id_group'];
    }

    if ($fileFormat == 'XML') {
      $parser = xml_parser_create();
      xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, false);
      xml_set_object($parser, $this);
      if (function_exists('importfast_prod_tagStart'))
	xml_set_element_handler($parser, 'prodTagStartCustomer', 'prodTagEndCustomer');
      elseif (function_exists('importfast_prod_tagEnd'))
	xml_set_element_handler($parser, 'tagStart', 'prodTagEndCustomer');
      else
	xml_set_element_handler($parser, 'tagStart', 'tagEnd');
      if (function_exists('importfast_prod_tagContent'))
	xml_set_character_data_handler($parser, 'prodTagContentCustomer');
      else
	xml_set_character_data_handler($parser, 'tagContent');
      $this->xmlTag = array();
      $this->xmlData = array();
      $this->foundItem = NULL;
      $firstItemParsed = false;
    }
    else {
      if ($this->iso8859) {
	stream_filter_register("utf8encode", "importfast_utf8encode_filter");
	stream_filter_prepend($fp, "utf8encode");
	$this->iso8859 = 2;
      }
      if ($keepBackslash) {
	stream_filter_register("backslash", "importfast_backslash_filter");
	stream_filter_prepend($fp, "backslash");
      }
      $firstItemParsed = true;
    }
    if ($skipFirstLines) {
      for ($i = 0; $i < $skipFirstLines; $i++)
	fgets($fp, 0x100000);
    }
    $fieldNames = array_merge($this->psFields1, $this->psFields2);
    if (isset($fieldMap['sub_category']) && $fieldMap['category'] == $fieldMap['sub_category'] ||
      isset($fieldMap['sub_category alpha']) && $fieldMap['category'] == $fieldMap['sub_category alpha'])
    {
      // Categories and sub-categories in same field
      $categoryMode = 1;
    }
    else {
      // Categories and sub-categories in different fields
      $categoryMode = 0;
    }
    $imageFlag = false;
    $imageMaps = array('url', 'url1', 'url2', 'url3', 'url4', 'image_gif', 'image_jpg', 'image', 'attribute_image');
    foreach ($imageMaps as $imageMap) {
      if (isset($fieldMap[$imageMap]))
	$imageFlag = true;
    }
    $specificMaps = array('specific_price', 'specific_type', 'specific_value',
	'specific_quantity', 'specific_from', 'specific_to',
	'reduced_price', 'discount_qty_pct');
    $specificFlag = false;
    foreach ($specificMaps as $specificMap) {
      if (isset($fieldMap[$specificMap]))
	$specificFlag = true;
    }
    $featureFlag = false;
    if (isset($fieldMap['feature']) || isset($fieldMap['property']))
      $featureFlag = true;
    $f = NULL;
    if ($productEndTag)
      $endTag = '</'.$this->itemTag.'>';
    else
      $endTag = '>';
    do {
      if ($fileFormat == 'XML') {
	// function import() read contents
	$line = $this->stream_get_line($fp, 0x100000, $endTag, $eof);
	if ($this->iso8859)
	  $line = utf8_encode($line);
	if ($this->foundItem === NULL) {
	  // New product entry
	  $this->xmlNames = array();
	  $this->attributes = array();
	  $this->attrRefVal = NULL;
	  $this->attrSupRefVal = NULL;
	  $this->attrEan13Val = NULL;
	  $this->xmlNodes = array();
	  $this->xmlData = array();
	  $this->foundItem = false;
	}
	if ($line) {
	  if (!xml_parse($parser, $line, $eof)) {
	    $this->_errors[] = $this->l('XML parsing failed at line').
	      sprintf(" %d: ", xml_get_current_line_number($parser)).
	      xml_error_string(xml_get_error_code($parser));
	    if (isset($product['id_product'])) {
	      $lasterr = count($this->_errors) - 1;
	      $this->_errors[$lasterr] .= "<br />".$this->l('Previous supplier reference').' '.
		$product['supplier_reference'];
	    }
	    // Roll back active value
	    $this->Execute('UPDATE `'._DB_PREFIX_.'product`
	      SET `active` = 1
	      WHERE `active` = 2 AND `id_supplier` = '.$supplierId);
	    return;
	  }
	  if (!$this->foundItem) {
	    $f = true;
	    continue;
	  }
	  $this->foundItem = NULL;
	  $entryCount++;
	  if ($entryCount <= $startEntry) {
	    $f = true;
	    continue;
	  }
	  if ($skipFirstItem && $firstItemParsed == false) {
	    $firstItemParsed = true;
	    continue;
	  }
	  $f = $this->xmlNames;
	}
	else {
	  // EOF
	  $f = NULL;
	}
      }
      else {
	$f = fgetcsv($fp, 0, $this->itemSep, $this->enclosure);
	if ($f) {
	  if ($entryCount++ < $startEntry)
	    continue;
	  if ($skipFirstItem && $entryCount == 1)
	    continue;
	  if (count($f) == 1)
	    continue;
	}
	if (function_exists('importfast_prod_csv'))
	  importfast_prod_csv($f, $this);
      }

      if ($f) {
	$skipItem = false;
	$dupItem = false;
	$passiveItem = false;
	$productLang = array();
	$alphaCat = array();
	$this->attrImageIds = array();
	foreach ($langs as $lang) {
	  $productLang[$lang] = array('id_product' => NULL, 'id_lang' => $lang);
	}
	$product = array('id_product' => 0);
	if ($this->importType == 0) {
	  if ($this->v14)
	    $product['id_tax_rules_group'] = $taxId;
	  else
	    $product['id_tax'] = $taxId;
	  $product['quantity'] = $defaultQuantity;
	}
	$product['id_supplier'] = $supplierId;
	$product['date_upd'] = $timeNow;
	if ($this->v15)
	  $product['available_date'] = $time0;
	$moq = 1;
	$manName = '';

	foreach ($fieldNames as $fieldName => $fieldLangName) {
	  if (isset($this->defaultValues[$fieldName]))
	    $product[$fieldName] = $this->defaultValues[$fieldName];
	  if (!isset($fieldMap[$fieldName])) {
	    if ($this->importType == 1)
	      unset($product[$fieldName]);
	    continue;
	  }
	  $fkey = $fieldMap[$fieldName];
	  if (!isset($f[$fkey]))
	    $f[$fkey] = '';
	  $fval = $this->mytrim($f[$fkey]);
	  switch ($fieldName) {
	  case 'active':
	    if (strlen($extraDataMap[$fkey])) {
	      if ($extraDataMap[$fkey] == $fval)
		$product[$fieldName] = 1;
	      else {
		$product[$fieldName] = 0;
		$passiveItem = true;
	      }
	    }
	    else {
	      if (strtoupper($fval) == 'Y' || $fval != 0)
		$product[$fieldName] = 1;
	      else {
		$product[$fieldName] = 0;
		$passiveItem = true;
	      }
	    }
	    break;
	  case 'valid':
	    if (strlen($extraDataMap[$fkey])) {
	      if ($extraDataMap[$fkey] == $fval)
		$product['active'] = 1;
	      else {
		$product['active'] = 0;
		$notValid++;
		$skipItem = true;
		unset($curProductEntry);
	      }
	    }
	    else {
	      if (strtoupper($fval) == 'N' || !$fval) {
		$product['active'] = 0;
		$notValid++;
		$skipItem = true;
		unset($curProductEntry);
	      }
	      else
		$product['active'] = 1;
	    }
	    break;
	  case 'on_sale':
	  case 'show_price':
	  case 'online_only':
	    if (strtoupper($fval) == 'N' || $fval == 0)
	      $product[$fieldName] = 0;
	    else
	      $product[$fieldName] = 1;
	    break;
	  case 'quantity':
	    $product[$fieldName] = intval($fval);
	    if ($minQuantity && $fval < $minQuantity) {
	      $lowQuantity++;
	      $skipItem = true;
	    }
	    break;
	  case 'minimal_quantity':
	    $product[$fieldName] = intval($fval);
	    break;
	  case 'supplier_reference':
	  case 'supplier_ref_expr':
	    $categoryDefaultId = 0;
	    $productRefCnt = 0;
	    if ($skipItem == true) {
	      $product[$fieldName] = '';
	      if (empty($product['date_add']) && $this->importType == 0)
		$product['date_add'] = $timeNow;
	      break;
	    }
	    if ($fieldName == 'supplier_ref_expr') {
	      $regExp = $extraDataMap[$fkey];
	      if (@preg_match($regExp, $fval, $matches) && isset($matches[1]))
		$fval = $matches[1];
	      if (!$fval && $product['supplier_reference'])
		break;
	    }
	    $fval = strip_tags($fval);
	    $emptySupRef = empty($fval);
	    if (strlen($fval) > $supplier_reference_length)
	      $this->_errors[] =
		Tools::displayError('Supplier reference too long').': '.$fval;
	    $product['supplier_reference'] = pSQL($fval);
	    $curProductEntry = &$productList[$fval];
	    $imgSubIndex = &$imgSubIndexes[$fval];
	    if (!isset($imgSubIndex)) {
	      $imgSubIndexes[$fval] = 0;
	      $imgSubIndex = &$imgSubIndexes[$fval];
	    }
	    $addedFlag = 0;
	    if (microtime(true) - $startTime > $maxExecution)
	      $mustStop = 2;
	    if (isset($curProductEntry)) {
	      $productVals = explode('|', $curProductEntry);
	      $productImgList = array_slice($productVals, 4);
	      if ($this->importType == 0)
		$product['date_add'] = $productVals[0];
	      $product['id_product'] = $productVals[1];
	      $productRefCnt = ++$productVals[3];
	      $curProductEntry = implode('|', $productVals);
	      if ($onlyNew && $product['date_add'] != $timeNow) {
		$existingProduct++;
		$existedList[] = $product['id_product'];
		$skipItem = true;
		break;
	      }
	      if ($productRefCnt > 1) {
		if (!$attributeList) {
		  $duplicateProduct++;
		  $duplicateList[] = $fval;
		}
		$dupItem = true;
		$skipItem = true;
		$mustStop = 0;
		break;
	      }
	      $defaultOnWasSet = false;
	      if ($categoriesPersistent)
		$categoryDefaultId = $productVals[2];
	      if ($mustStop == 0)
		$productDelete[$product['id_product']] = true;
	    }
	    else {
	      if ($this->importType == 1) {
		if ($fval) {
		  if (empty($attributeList) || empty($attributeList[$fval]))
		    $notfoundList[] = $fval;
		}
		$skipItem = true;
		break;
	      }
	      $defaultOnWasSet = false;
	      unset($productImgList);
	      $product['date_add'] = $timeNow;
	      $product['id_product'] = ++$idProduct;
	      $addedFlag = 1;
	      // date_add, id_product, id_category_default, refCount
	      $productList[$fval] = implode('|', array($product['date_add'], $product['id_product'], '0', '1'));
	    }
	    if ($mustStop) {
	      $skipItem = true;
	      $entryCount--;
	    }
	    if ($fileFormat == 'CSV')
	      $this->attributes = array();
	    break;
	  case 'reduction_price':
	  case 'additional_shipping_cost':
	  case 'unit_price_ratio':
	    $product[$fieldName] = sprintf("%f", $this->getDecVal($fval) /
		$conversionRate);
	    break;
	  case 'reduction_percent':
	  case 'width':
	  case 'height':
	  case 'depth':
	  case 'out_of_stock':
	    $product[$fieldName] = sprintf("%f", $this->getDecVal($fval));
	    break;
	  case 'reduction_from':
	  case 'reduction_to':
	    if ($fval)
	      $product[$fieldName] = $fval;
	    else
	      $product[$fieldName] = $timeNow;
	    break;
	  case 'reduction_amount':
	    if (!$fval) {
	      $product['reduction_price'] = 0;
	      break;
	    }
	    $newPrice = $this->getDecVal($fval);
	    $oldPrice = $f[$fieldMap['wholesale_price']];
	    $product['reduction_price'] = ($oldPrice - $newPrice) /
	      $conversionRate * $moq * (100 + $priceProfit) / 100 *
	      (100 + $taxRate) / 100;
	    break;
	  case 'specific_price':
	    $newPrice = $this->getDecVal($fval) / $conversionRate * $moq;
	    if (isset($product['wholesale_price'])) {
	      if (isset($fieldMap['price'])) {
		$wholeSalePrice = $product['wholesale_price'];
		$newPrice = $wholeSalePrice +
		  ($newPrice - $wholeSalePrice) * $priceProfit / 100;
	      }
	      else {
		$newPrice += $newPrice * $priceProfit / 100;
	      }
	    }
	    $specificPrice['price'] = $newPrice;
	    break;
	  case 'specific_type':
	    $specificPrice['reduction_type'] = $fval;
	    break;
	  case 'specific_value':
	    if ($specificPrice['reduction_type'] == 'percentage')
	      $specificPrice['reduction'] =  $this->getDecVal($fval) / 100;
	    else {
	      $specificPrice['reduction'] = $this->getDecVal($fval) /
		$conversionRate * $moq;
	      if (isset($product['wholesale_price']))
		$specificPrice['reduction'] *= $priceProfit / 100;
	    }
	    break;
	  case 'specific_quantity':
	    $specificPrice['from_quantity'] = intval($fval);
	    break;
	  case 'specific_from':
	    if ($fval)
	      $specificPrice['from'] = $fval;
	    else
	      $specificPrice['from'] = $timeNow;
	    break;
	  case 'specific_to':
	    if ($fval)
	      $specificPrice['to'] = $fval;
	    else
	      $specificPrice['to'] = $timeNow;
	    break;
	  case 'weight':
	    if (isset($this->xmlNodes[$fkey]['attr']['quantity']) &&
	      isset($this->xmlNodes[$fkey]['attr']['weight']))
	    {
	      $attr = $this->xmlNodes[$fkey]['attr'];
	      $quantity = intval($attr['quantity']);
	      $fval = $this->getDecVal($attr['weight']);
	      if ($quantity)
		$fval /= $quantity;
	    }
	    else
	      $fval = $this->getDecVal($fval);
	    $product[$fieldName] = sprintf("%f", $fval * $moq);
	    if ($demandWeight && !$fval) {
	      $product['active'] = 0;
	      $product['date_upd'] = $timeNow;
	      $passiveItem = true;
	    }
	    break;
	  case 'reduced_price':
	    if (!$fval || $dupItem)
	      break;
	    $newPrice = $this->getDecVal($fval) / $conversionRate * $moq;
	    if (isset($product['wholesale_price'])) {
	      if (isset($fieldMap['price'])) {
		$wholeSalePrice = $product['wholesale_price'];
		$newPrice = $wholeSalePrice +
		  ($newPrice - $wholeSalePrice) * $priceProfit / 100;
	      }
	      else {
		$newPrice += $newPrice * $priceProfit / 100;
	      }
	    }
	    $oldPrice = $product['price'];
	    if ($oldPrice > $newPrice) {
	      $specificPrice['price'] = $product['price'];
	      $specificPrice['reduction_type'] = 'amount';
	      $specificPrice['from_quantity'] = 1;
	      $specificPrice['reduction'] =
		($oldPrice - $newPrice) / 100 * (100 + $taxRate);
	    }
	    break;
	  case 'ecotax':
	  case 'ecotax vat':
	    if (isset($this->xmlNodes[$fkey]['nodes'][0]['attr']['PricePerPiece']))
	    {
	      foreach ($this->xmlNodes[$fkey]['nodes'] as $node)
		$fval += $this->getDecVal($node['attr']['PricePerPiece']) /
		$conversionRate * $moq;
	    }
	    else
	      $fval = $this->getDecVal($fval) / $conversionRate;
	    if ($fieldName == 'ecotax vat')
	      $fval += $fval * $taxRate / 100;
	    $product['ecotax'] = sprintf("%f", $fval);
	    break;
	  case 'price':
	    $priceProfit = 0;
	    $product[$fieldName] = sprintf("%f", $this->getDecVal($fval) /
		$conversionRate);
	    break;
	  case 'price_tax':
	    $priceProfit = 0;
	    $product['price'] = sprintf("%f", $this->getDecVal($fval) /
		$conversionRate * 100 / (100 + $taxRate));
	    break;
	  case 'wholesale_price':
	    $fval = $this->getDecVal($fval) / $conversionRate * $moq;
	    if ($fval < $priceRange1)
	      $priceProfit = $priceProfit1;
	    elseif ($fval < $priceRange2)
	      $priceProfit = $priceProfit2;
	    elseif ($fval < $priceRange3)
	      $priceProfit = $priceProfit3;
	    else
	      $priceProfit = $priceProfit4;
	    $tax = 0;
	    if (isset($fieldMap['price_add']) &&
	      isset($this->xmlNodes[$fieldMap['price_add']]['nodes'][0]['attr']['PricePerPiece']))
	    {
	      foreach ($this->xmlNodes[$fieldMap['price_add']]['nodes'] as $node)
		$tax += $node['attr']['PricePerPiece'] * $moq;
	    }
	    $product['wholesale_price'] = sprintf("%f", $fval + $tax);
	    if (empty($product['price']))
	      $fval += $fval * $priceProfit / 100;
	    else
	      $fval += ($product['price'] - $fval) * $priceProfit / 100;
	    $product['price'] = $fval + $tax;
	    break;
	  case 'id_tax':
	  case 'id_tax_rules_group':
	    // Find id_tax corresponding to given values for product tax
	    if (empty($fval))
	      break;
	    $fval = number_format($this->getDecVal($fval), 3);
	    $taxRate = $fval;
	    if (isset($taxRates[$fval])) {
	      $product[$fieldName] = intval($taxRates[$fval]);
	      break;
	    }
	    if ($this->v14) {
	      // Can't do much with unknown taxes in 1.4
	      $this->_errors[] = Tools::displayError('Unknown tax rate').' '.$fval;
	      break;
	    }
	    $id_tax = intval(Tax::getTaxIdByRate(floatval($fval)));
	    if ($id_tax) {
	      $taxRates[$fval] = $id_tax;
	      $product[$fieldName] = intval($id_tax);
	      break;
	    }
	    $tax = new Tax();
	    $tax->rate = floatval($fval);
	    $tax->name[$defLang] = $fval;
	    if (($fieldError = $tax->validateFields(false, true)) !== true ||
	      ($langFieldError = $tax->validateFieldsLang(false, true)) !== true ||
	      !$tax->add())
	    {
	      $this->_errors[] = 'TAX '.$tax->name[$defLang].' '.Tools::displayError('cannot be saved');
	      $this->_errors[] = ($fieldError !== true ? $fieldError : '').
		($langFieldError !== true ? $langFieldError : '').mysql_error();
	      break;
	    }
	    $taxRates[$fval] = $tax->id;
	    $product[$fieldName] = intval($tax->id);
	    break;
	  case 'reference':
	  case 'reference 2nd':
	  case 'ean13':
	  case 'ean13 2nd':
	  case 'location':
	  case 'upc':
	  case 'unity':
	  case 'condition':
	    $n = explode(' ', $fieldName);
	    $fval = strip_tags($fval);
	    $product[$n[0]] = pSQL($fval);
	    break;
	  case 'description':
	  case 'description_short':
	    foreach ($langs as $lang) {
	      $fkey = $langMap[$fieldName][$lang];
	      if (!isset($f[$fkey]))
		continue;
	      $fval = $this->mytrim($f[$fkey]);
	      if ($descRegExp1)
		$fval = preg_replace($descRegExp1, $descReplace1, $fval);
	      if ($descRegExp2)
		$fval = preg_replace($descRegExp2, $descReplace2, $fval);
	      $fval = str_replace("\r\r", '<br />', $fval);
	      $fval = str_replace("\r", '<br />', $fval);
	      $productLang[$lang][$fieldName] = pSQL($fval, true);
	      // $this->dump(htmlspecialchars($fval));
	    }
	    break;
	  case 'description_test':
	    foreach ($langs as $lang) {
	      $fkey = $langMap[$fieldName][$lang];
	      if (!isset($f[$fkey]))
		continue;
	      $fval = $this->mytrim($f[$fkey]);
	      $fval = str_replace("\r\r", '<br />', $fval);
	      $fval = str_replace("\r", '<br />', $fval);
	      $fval = pSQL($fval, true);
	      if (empty($productLang[$lang]['description_short'])) {
		$productLang[$lang]['description_short'] = $fval;
		$productLang[$lang]['description'] = '';
	      }
	      else
		$productLang[$lang]['description'] = $fval;
	    }
	    break;
	  case 'description extra':
	    foreach ($langs as $lang) {
	      $fkey = $langMap[$fieldName][$lang];
	      if (!isset($f[$fkey]))
		continue;
	      $fval = $this->mytrim($f[$fkey]);
	      $n = explode(' ', $fieldName);
	      $productLang[$lang][$n[0]] = pSQL($fval, true);
	    }
	    break;
	  case 'link_rewrite':
	    foreach ($langs as $lang) {
	      $fkey = $langMap[$fieldName][$lang];
	      if (!isset($f[$fkey]))
		continue;
	      $fval = $this->mytrim($f[$fkey]);
	      $productLang[$lang][$fieldName] = pSQL($fval);
	    }
	    break;
	  case 'name':
	    foreach ($langs as $lang) {
	      $fkey = $langMap[$fieldName][$lang];
	      if (!isset($f[$fkey])) {
		$productLang[$lang][$fieldName] = '';
		continue;
	      }
	      $fval = $this->mytrim($f[$fkey]);
	      $fval = str_replace(array('<', '>', ';', '=', '#', '{', '}'),
		  array('＜', '＞', '；', '＝', '＃', '｛', '｝'), $fval);
	      $productLang[$lang][$fieldName] = pSQL($fval);
	    }
	    break;
	  case 'description append':
	  case 'description_short append':
	    foreach ($langs as $lang) {
	      $fkey = $langMap[$fieldName][$lang];
	      if (!isset($f[$fkey]))
		continue;
	      $fval = $this->mytrim($f[$fkey]);
	      if ($descRegExp1)
		$fval = preg_replace($descRegExp1, $descReplace1, $fval);
	      if ($descRegExp2)
		$fval = preg_replace($descRegExp2, $descReplace2, $fval);
	      $fval = str_replace("\r\r", '<br />', $fval);
	      $fval = str_replace("\r", '<br />', $fval);
	      $n = explode(' ', $fieldName);
	      if (empty($productLang[$lang][$n[0]]))
		$productLang[$lang][$n[0]] = '';
	      $productLang[$lang][$n[0]] .= '<br />'.pSQL($fval, true);
	    }
	    break;
	  case 'tags':
	  case 'tags 2nd':
	    if ($skipItem || !$fval)
	      break;
	    $tagLangNames = array();
	    foreach ($langs as $lang) {
	      $fkey = $langMap[$fieldName][$lang];
	      if (!isset($f[$fkey]))
		continue;
	      $fval = $this->mytrim($f[$fkey]);
	      $i = 0;
	      foreach (explode(',', $fval) as $tagName) {
		$tagLangNames[$i++][$lang] = pSQL($tagName);
	      }
	    }
	    foreach ($tagLangNames as $tagNameLang) {
	      foreach ($tagNameLang as $lang => $tagName) {
		if (isset($tagId[$tagName][$lang])) {
		  $id = $tagId[$tagName][$lang];
		}
		else {
		  $id = ++$idTag;
		  $tagId[$tagName][$lang] = $id;
		  $tagLang = array(
		      'id_tag' => $id,
		      'id_lang' => $lang,
		      'name' => $tagNameLang[$lang]
		      );
		  $tagLangs[] = $this->group($tagLang);
		}
		$productTag = array(
		    'id_product' => $product['id_product'],
		    'id_tag' => $id
		    );
		$productTags[] = $this->group($productTag);
	      }
	    }
	    break;
	  case '_url_pre':
	    if (!$demandPicture)
	      break;
	    if ($skipItem == true && !($dupItem == true && $this->attributes))
	      break;
	    if (isset($this->xmlNodes[$fkey]) && !empty($this->xmlNodes[$fkey]['nodes'])) {
	      $n = array();
	      foreach ($this->xmlNodes[$fkey]['nodes'] as $node) {
		if (isset($node['attr']['type']) && $node['attr']['type'] == 4)
		  continue;
		if (strlen($node['value']) > 10 || substr($node['value'], -4, 1) ==  '.')
		  $n[] = $node['value'];
	      }
	    }
	    else {
	      $n = explode($imageSep, $fval);
	    }
	    foreach ($n as $url) {
	      if (empty($url) || $url == 'null' || $fieldName{0} == 'u' && strlen($url) <= 10 && substr($url, -4, 1) != '.') {
		  if ($fieldName == $lastUrl && $imgSubIndex == 0) {
		    $noPictures++;
		    $skipItem = true;
		  }
		break;
	      }
	    }
	    break;
	  case 'url':
	  case 'url1':
	  case 'url2':
	  case 'url3':
	  case 'url4':
	  case 'image_gif':
	  case 'image_jpg':
	  case 'image':
	    if ($skipItem == true && !($dupItem == true && $this->attributes))
	      break;
	    if (isset($this->xmlNodes[$fkey]) && !empty($this->xmlNodes[$fkey]['nodes'])) {
	      $n = array();
	      foreach ($this->xmlNodes[$fkey]['nodes'] as $node) {
		if (isset($node['attr']['type']) && $node['attr']['type'] == 4)
		  continue;
		if (strlen($node['value']) > 10 || substr($node['value'], -4, 1) ==  '.')
		  $n[] = $node['value'];
	      }
	    }
	    else {
	      $n = explode($imageSep, $fval);
	    }
	    foreach ($n as $url) {
	      if (empty($url) || $url == 'null' || $fieldName{0} == 'u' && strlen($url) <= 10 && substr($url, -4, 1) != '.') {
		// $image['cover'] = 0;
		break;
	      }
	      $pic = $this->convertToPic($url,
		  $urlPrefix, $fieldName, $urlAppend);
	      if (!empty($productImgList[$imgSubIndex])) // Image ID known
		$imageId = $productImgList[$imgSubIndex];
	      else
		$imageId = ++$idImage;
	      $image = array(
		'id_image' => $imageId,
		'id_product' => $product['id_product'],
		'position' => 1 + $imgSubIndex,
		'url' => $pic,
		'img_upd' => $time0,
		'cover' => $imgSubIndex == 0 ? 1 : "\000");
	      foreach ($langs as $lang) {
		$imageLang[$lang] = array(
		    'id_image' => $imageId,
		    'id_lang' => $lang);
		$imageLangs[] = $this->group($imageLang[$lang]);
	      }
	      $images[] = $this->group($image);
	      $imageDelete[$imageId] = true;
	      if ($this->v15)
		$this->makeShopFields($imageShopDesc, $image, $imageShop, $imageShops);
	      if (!in_array($imageId, $this->attrImageIds))
		$this->attrImageIds[] = $imageId;
	      $imgSubIndex++;
	    }
	    break;
	  case 'moq':
	    if ($skipItem == true)
	      break;
	    if (isset($fieldMap['reduction_amount']) &&
	      isset($this->xmlNodes[$fieldMap['reduction_amount']]['attr']['moq']))
	      $fval = $this->xmlNodes[$fieldMap['reduction_amount']]['attr']['moq'];
	    $moq = intval($fval);
	    if ($extraDataMap[$fkey])
	      $newFeature[$extraDataMap[$fkey].$featureColon] = $moq;
	    break;
	  case 'manufacturer':
	    if ($skipItem == true) {
	      $product['id_manufacturer'] = 0;
	      break;
	    }
	    $manName = $this->mytrim($fval);
	    if (!isset($manId[$manName]))
	      $manId[$manName] = $newManId[$manName] = ++$idManufacturer;
	    $manufacturerId = $manId[$manName];
	    $product['id_manufacturer'] = intval($manufacturerId);
	    break;
	  case 'sub_category alpha':
	    if (!$fval)
	      break;
	    if ($skipItem == true || $emptySupRef)
	      break;
	    foreach ($langs as $lang) {
	      $fkey = $langMap[$fieldName][$lang];
	      if (!isset($f[$fkey]))
		continue;
	      $fval = $this->mytrim($f[$fkey]);
	      if (!preg_match('/[[:alnum:]]/', $fval, $matches))
		break;
	      $name = '';
	      foreach ($catSubs as $catSub) {
		if (preg_match('/['.$catSub.']/', $matches[0]))
		  $name = $catSub;
	      }
	      if (!$name)
		break;
	      $alphaCat[$lang] = $name;
	    }
	    // fall trough for 'sub_category alpha'
	  case 'sub_category':
	    // Sub category
	    if ($skipItem == true || $emptySupRef ||
		!$fval && $fileFormat == 'CSV')
	      break;
	    $defCatId = array();
	    foreach ($langs as $lang) {
	      $defCatIndex = 0;
	      $categoryId = $product['id_category_default'];
	      $productId = $product['id_product'];
	      $fkey = $langMap[$fieldName][$lang];
	      if (!isset($f[$fkey]))
		continue;
	      if (!empty($this->xmlNodes[$fkey]) && !empty($this->xmlNodes[$fkey]['nodes'][0]['nodes'])) {
		$catSuperList = array();
		foreach ($this->xmlNodes[$fkey]['nodes'] as $k => $innerNodes) {
		  foreach ($innerNodes['nodes'] as $innerNode) {
		    $name = $innerNode['value'];
		    if (empty($catSuperList[$k])) {
		      if ($categoryAliases && isset($categoryAliases[$name]))
			$name = $categoryAliases[$name];
		      elseif ($categoryAliasesExpr && $this->aliasExprMatch($categoryAliasesExpr, $name))
			;
		      elseif ($demandAlias) {
			$noAlias++;
			$skipItem = true;
			break;
		      }
		      $name = trim($name, $subCategorySep);
		      if ($categoryPrefix)
			$name = $categoryPrefix.$name;
		      $catSuperList[$k] = explode($subCategorySep, $name);
		    }
		    else
		      $catSuperList[$k][] = $name;
		  }
		  if ($subCategoryAliasFlag && $categoryAliases) {
		    foreach ($catSuperList[$k] as $catK => $catV) {
		      if (isset($categoryAliases[$catV]))
			$catSuperList[$k][$catK] = $categoryAliases[$catV];
		    }
		  }
		}
		if ($skipItem)
		  break;
	      }
	      else {
		if (!empty($this->xmlNodes[$fkey]['nodes'])) {
		  $catSuperList = array();
		  foreach ($this->xmlNodes[$fkey]['nodes'] as $innerNode)
		    $catSuperList[] = $innerNode['value'];
		}
		else {
		  $fval = $this->mytrim($f[$fkey]);
		  if (!$fval)
		    $fval = $currentCategory;
		  else
		    $currentCategory = $fval;
		  $catSuperList = explode($categorySep, $fval);
		}
		for ($i = 0; $i < count($catSuperList); $i++) {
		  $name = $catSuperList[$i];
		  if ($categoryAliases && isset($categoryAliases[$name]))
		    $name = $categoryAliases[$name];
		  elseif ($categoryAliasesExpr)
		    $this->aliasExprMatch($categoryAliasesExpr, $name);
		  $name = trim($name, $subCategorySep);
		  if ($categoryPrefix)
		    $name = $categoryPrefix.$name;
		  $catSuperList[$i] = explode($subCategorySep, $name);
		  if (isset($langMap['sub_sub_category'][$lang]) &&
		    isset($f[$langMap['sub_sub_category'][$lang]]))
		  {
		    $str = $this->mytrim($f[$langMap['sub_sub_category'][$lang]]);
		    $catSuperList[$i][] = $str;
		    if (isset($langMap['sub_sub_sub_category'][$lang]) &&
		      isset($f[$langMap['sub_sub_sub_category'][$lang]]))
		    {
		      $str = $this->mytrim($f[$langMap['sub_sub_sub_category'][$lang]]);
		      $catSuperList[$i][] = $str;
		    }
		  }
		  if ($subCategoryAliasFlag && $categoryAliases) {
		    foreach ($catSuperList[$i] as $catK => $catV) {
		      if (isset($categoryAliases[$catV]))
			$catSuperList[$i][$catK] = $categoryAliases[$catV];
		    }
		  }
		}
	      }
	      foreach (array_reverse($catSuperList) as $subCatList) {
		if (isset($alphaCat[$lang]))
		  array_unshift($subCatList, $alphaCat[$lang]);
		if ($categoryMode == 1) {
		  $name = array_shift($subCatList);
		  $name = $this->mytrim($name);
		  if ($name) {
		    if ($lang == $defLang)
		      $defCatId[$defCatIndex] = $catId[$name];
		    $categoryId = $defCatId[$defCatIndex++];
		  }
		}
		$level = $defLevelDepth;
		foreach ($subCatList as $name) {
		  $name = $this->mytrim($name);
		  if ($name) {
		    if ($lang == $defLang) {
		      if ($categoryLeaf) {
			// Remove parent (or root) entry
			$currentLeaf = $categoryId.','.$productId;
			unset($categoryProducts[$currentLeaf]);
		      }
		      $c = $categoryId.$subCategorySep.$name;
		      if (!isset($catSubId[$c]))
			$catSubId[$c] = $newCatSubId[$c] = ++$idCategory;

		      $defCatId[$defCatIndex] = $categoryId = $catSubId[$c];
		      $catSubLevel[$categoryId] = ++$level;
		      if (isset($catSubPos[$c]))
			$catSubPos[$c]++;
		      else
			$catSubPos[$c] = 1;
		      $categoryProduct = array(
			'id_category' => $categoryId,
			'id_product' => $productId,
			'position' => $catSubPos[$c]);
		      if ($categoryLeaf) {
			// Point to new leaf
			$product['id_category_default'] = $categoryId;
		      }
		      $categoryProducts[$categoryId.','.$productId] =
			$this->group($categoryProduct);
		    }
		    $categoryId = $defCatId[$defCatIndex++];
		    $catSubName[$categoryId][$lang] = $name;
		  }
		}
	      }
	    }
	    $product['id_category_default'] = $categoryId;
	    break;
	  case 'category':
	  case 'id_category':
	    if ($skipItem == true || $emptySupRef) {
	      $product['id_category_default'] = $homeCategoryId;
	      break;
	    }
	    $defCatId = array();
	    foreach ($langs as $lang) {
	      $defCatIndex = 0;
	      $fkey = $langMap[$fieldName][$lang];
	      if (!isset($f[$fkey]))
		continue;
	      if (!empty($this->xmlNodes[$fkey]) && !empty($this->xmlNodes[$fkey]['nodes'][0]['nodes'])) {
		$catSuperList = array();
		foreach ($this->xmlNodes[$fkey]['nodes'] as $k => $innerNodes) {
		  foreach ($innerNodes['nodes'] as $innerNode) {
		    $name = $innerNode['value'];
		    if (empty($catSuperList[$k])) {
		      if ($categoryAliases && isset($categoryAliases[$name]))
			$name = $categoryAliases[$name];
		      elseif ($categoryAliasesExpr && $this->aliasExprMatch($categoryAliasesExpr, $name))
			;
		      elseif ($demandAlias) {
			$noAlias++;
			$skipItem = true;
			break;
		      }
		      $name = trim($name, $subCategorySep);
		      $catSuperList[$k] = explode($subCategorySep, $name);
		    }
		    else
		      $catSuperList[$k][] = $name;
		  }
		}
		if ($skipItem == true) {
		  $product['id_category_default'] = $homeCategoryId;
		  break;
		}
	      }
	      else {
		$fval = $this->mytrim($f[$fkey]);
		if (!$fval) {
		  if ($fileFormat == 'XML' && !isset($this->xmlNodes[$fkey]))
		    $fval = $currentCategory;
		  else {
		    $fval = $defaultCategory;
		    if (!$fval) {
		      $skipItem = true;
		      $noCategory++;
		      break;
		    }
		  }
		}
		else
		  $currentCategory = $fval;
		if (!empty($this->xmlNodes[$fkey]['nodes'])) {
		  $catSuperList = array();
		  foreach ($this->xmlNodes[$fkey]['nodes'] as $innerNode)
		    $catSuperList[] = $innerNode['value'];
		}
		else
		  $catSuperList = explode($categorySep, $fval);
		for ($i = 0; $i < count($catSuperList); $i++) {
		  $name = $catSuperList[$i];
		  if ($categoryAliases && isset($categoryAliases[$name]))
		    $name = $categoryAliases[$name];
		  elseif ($categoryAliasesExpr && $this->aliasExprMatch($categoryAliasesExpr, $name))
		  ;
		  elseif ($demandAlias) {
		    $noAlias++;
		    $skipItem = true;
		    break;
		  }
		  $name = trim($name, $subCategorySep);
		  if ($categoryPrefix)
		    $name = $categoryPrefix.$name;
		  $catSuperList[$i] = explode($subCategorySep, $name);
		}
		if ($skipItem == true) {
		  $product['id_category_default'] = $homeCategoryId;
		  break;
		}
	      }
	      foreach (array_reverse($catSuperList) as $catList) {
		foreach ($catList as $name) {
		  $name = $this->mytrim($name);
		  if (!$name)
		    continue;
		  if ($lang == $defLang) {
		    if (!isset($catId[$name]) && !isset($catSubId[$name])) {
		      if ($fieldName == 'category')
			$catId[$name] = $newCatId[$name] = ++$idCategory;
		      else {
			// Used id_category directly
			$categoryId = intval($name);
			if (isset($catName[$categoryId][$lang])) {
			  $name = $catName[$categoryId][$lang];
			  $catId[$name] = $categoryId;
			}
			elseif (isset($catSubName[$categoryId][$lang])) {
			  $name = $catSubName[$categoryId][$lang];
			  $catId[$name] = $categoryId;
			}
			else
			  $catId[$name] = $newCatId[$name] = $categoryId;
		      }
		    }
		    $defCatId[$defCatIndex] = $categoryId = $catId[$name];
		    /*
		    if ($fieldName == 'category')
		      $newCatId[$name] = $categoryId;
		      */
		    if (isset($catPos[$name]))
		      $catPos[$name]++;
		    else
		      $catPos[$name] = 1;
		    if (empty($product['id_category_default']) ||
			$categoryId != $homeCategoryId)
		    {
		      $product['id_category_default'] = $categoryId;
		    }
		    $productId = $product['id_product'];
		    $categoryProduct = array(
		      'id_category' => $categoryId,
		      'id_product' => $productId,
		      'position' => $catPos[$name]);
		    $categoryProducts[$categoryId.','.$productId] =
		      $this->group($categoryProduct);
		  }
		  $categoryId = $defCatId[$defCatIndex++];
		  $catName[$categoryId][$lang] = $name;
		  if ($categoryMode == 1)
		    break;
		}
	      }
	    }
	    break;
	  case 'feature':
	    if ($skipItem == true)
	      break;
	    foreach ($featMap as $fkey => $name) {
	      if (empty($f[$fkey]))
		continue;
	      $fval = $this->mytrim($f[$fkey]);
	      if ($name && $fval)
		$newFeature[$name.$featureColon] = $fval;
	      else {
		foreach (explode(',', $fval) as $ft) {
		  $v = explode(':', $ft);
		  if (count($v) == 2)
		    $newFeature[$v[0].$featureColon] = $v[1];
		}
	      }
	    }
	    break;
	  case 'property':
	    $locale = 'locale|name|'.$this->xmlLocale;
	    if ($skipItem == true)
	      break;
	    if (empty($this->xmlNodes[$fkey]['nodes']))
	      break;

	    foreach ($this->xmlNodes[$fkey]['nodes'] as $nodes) {
	      if (isset($nodes['attr'])) {
		$attrs = $nodes['attr'];
		$key = key($attrs);
		if (empty($this->xmlLocale) &&
		    isset($attrs[$key]) && isset($nodes['value']))
		{
		  $newFeature[trim($attrs[$key], ' :').$featureColon] = $nodes['value'];
		}
		else {
		  $kname = 'property|id|'.$attrs['id'].'|'.$locale;
		  if (isset($this->xmlTranslations[$kname])) {
		    $key = $this->xmlTranslations[$kname];
		    $values = array();
		    $keys = array(
		      'valueID' => array('value|id', '', $locale),
		      'multiplierID' => array('multiplier|id', ''),
		      'unitID' => array('unit|id', '', $locale));
		    foreach($keys as $k => $v) {
		      if (isset($attrs[$k])) {
			$v[1] = $attrs[$k];
			$vname = implode('|', $v);
			if (!empty($this->xmlTranslations[$vname]) &&
			  $this->xmlTranslations[$vname] != '(none)')
			  $values[] = $this->xmlTranslations[$vname];
		      }
		    }
		    if ($values)
		      $newFeature[$key.$featureColon] = implode(' ', $values);
		  }
		}
	      }
	      else {
		$key = $nodes['nodes'][0]['value'];
		$value = $nodes['nodes'][1]['value'];
		$newFeature[trim($key, ' :').$featureColon] = $value;
	      }
	    }
	    break;
	  case 'attribute_supplier_ref':
	  case 'attribute_supplier_ref 2nd':
	    if (empty($fval) || empty($attributeList[$fval]))
	      break;
	    list($id, $price, $weight) = explode('|', $attributeList[$fval]);
	    $productAttribute = array('id_product_attribute' => $id);
	    $productAttributeDelete[$id] = true;
	    // Adjust price
	    if (isset($fieldMap['attribute_price_adjust'])) {
	      $fkey = $fieldMap['attribute_price_adjust'];
	      $productAttribute['price'] = 0;
	      if (isset($f[$fkey]))
		$productAttribute['price'] +=
		  $this->getDecVal($f[$fkey]) / $conversionRate;
	    }
	    elseif (isset($fieldMap['price']))
	      $productAttribute['price'] = $product['price'] - $price;
	    // Adjust weight
	    if (isset($fieldMap['attribute_weight_adjust'])) {
	      $fkey = $fieldMap['attribute_weight_adjust'];
	      $productAttribute['weight'] = 0;
	      if (isset($f[$fkey]))
		$productAttribute['weight'] += $this->getDecVal($f[$fkey]);
	    }
	    elseif (isset($fieldMap['weight']))
	      $productAttribute['weight'] = $weight - $product['weight'];
	    // Set quantity
	    if (isset($fieldMap['quantity']))
	      $productAttribute['quantity'] = $product['quantity'];
	    $productAttributes[] = $this->group($productAttribute);
	    if ($this->v15) {
	      $this->makeShopFields($productAttributeShopDesc,
		  $productAttribute, $productAttributeShop,
		  $productAttributeShops);
	      if (isset($product['out_of_stock']))
		$attrStockAvailable['out_of_stock'] =
		  $product['out_of_stock'];
	      $this->makeShopFields($stockAvailableDesc,
		  $productAttribute, $attrStockAvailable,
		  $attrStockAvailables);
	    }
	    break;
	  case 'attribute_quantity':
	    if ($fileFormat == 'CSV' && !empty($fval))
	      $product['quantity'] = $fval;
	    break;
	  case 'attribute_group':
	  case 'attribute_group_comb':
	  case 'attribute_group_dash':
	    if (isset($this->attrBig)) {
	      $this->_warnings[] = $this->l('Too many combinations for').' '.
	      $product['supplier_reference'].' ('.$this->attrBig.')';
	      unset($this->attrBig);
	      break;
	    }
	    if (empty($product['supplier_reference']))
	      break;
	    if ($skipItem == true && !$dupItem)
	      break;
	    $dash = $fieldName == 'attribute_group_dash';
	    if (!$dupItem) {
	      $attrPrice = @$product['price'];
	      $attrWeight = @$product['weight'];
	      $dupRef = $product['supplier_reference'];
	      if (isset($fieldMap['attribute_supplier_ref'])) {
		$fkey = $fieldMap['attribute_supplier_ref'];
		if (empty($f[$fkey]) || !$this->mytrim($f[$fkey])) {
		  break;
		}
	      }
	      if (isset($fieldMap['attribute_ref'])) {
		$fkey = $fieldMap['attribute_ref'];
		if (empty($f[$fkey]) || !$this->mytrim($f[$fkey])) {
		  break;
		}
	      }
	    }
	    else {
	      if ($dupRef != $product['supplier_reference']) {
		// $dupRef = 0;
		// $attrPrice = 0;
		// $attrWeight = 0;
		$attrPrice = $product['price'];
		$attrWeight = $product['weight'];
		$dupRef = $product['supplier_reference'];
		$defaultOnWasSet = false;
	      }
	      if (empty($product['price']))
	       	$product['price'] = $attrPrice;
	      if (empty($product['weight']))
		$product['weight'] = $attrWeight;
	    }
	    if ($fileFormat == 'CSV') {
	      if (empty($product['price']))
		$priceAdj = 0;
	      else
		$priceAdj = $product['price'] - $attrPrice;
	      if (isset($fieldMap['attribute_price_adjust'])) {
		$fkey = $fieldMap['attribute_price_adjust'];
		if (isset($f[$fkey]))
		  $priceAdj += $this->getDecVal($f[$fkey]) / $conversionRate;
	      }
	      if (empty($product['weight']))
		$weightAdj = 0;
	      else
		$weightAdj = $product['weight'] - $attrWeight;
	      if (isset($fieldMap['attribute_weight_adjust'])) {
		$fkey = $fieldMap['attribute_weight_adjust'];
		if (isset($f[$fkey]))
		  $weightAdj += $this->getDecVal($f[$fkey]);
	      }
	      $attr =
		array('values' => array(),
		  'priceAdj' => array($priceAdj),
		  'weightAdj' => array($weightAdj),
		  'quantity' => $product['quantity']);
	      if (isset($fieldMap['attribute_ref'])) {
		$fkey = $fieldMap['attribute_ref'];
		if (isset($f[$fkey]))
		  $attr['ref'] = $this->mytrim($f[$fkey]);
	      }
	      if (isset($fieldMap['attribute_supplier_ref'])) {
		$fkey = $fieldMap['attribute_supplier_ref'];
		if (isset($f[$fkey]))
		  $attr['supRef'] = $this->mytrim($f[$fkey]);
	      }
	      if (isset($fieldMap['attribute_ean13'])) {
		$fkey = $fieldMap['attribute_ean13'];
		if (isset($f[$fkey]))
		  $attr['ean13'] = $this->mytrim($f[$fkey]);
	      }
	      if (isset($fieldMap['attribute_upc'])) {
		$fkey = $fieldMap['attribute_upc'];
		if (isset($f[$fkey]))
		  $attr['upc'] = $this->mytrim($f[$fkey]);
	      }
	      if (isset($fieldMap['attribute_default'])) {
		$fkey = $fieldMap['attribute_default'];
		if (isset($f[$fkey])) {
		  if (strtoupper($f[$fkey]) == 'N' || !$f[$fkey])
		    $attr['defaultOn'] = 0;
		  else
		    $attr['defaultOn'] = 1;
		}
	      }
	      if (isset($fieldMap['minimal_quantity'])) {
		$fkey = $fieldMap['minimal_quantity'];
		if (isset($f[$fkey]))
		  $attr['minQuant'] = $this->mytrim($f[$fkey]);
		else
		  $attr['minQuant'] = 0;
	      }
	      if ($attributeValueFlag) {
		$ndx = 0;
		foreach ($attrMap as $fkey => $name) {
		  if (empty($f[$fkey]) || !$name)
		    continue;
		  $fval = $this->mytrim($f[$fkey]);
		  if ($fval)
		    foreach ($langs as $lang)
		      $attr['values'][$ndx][$lang] = array($name, $fval);
		  $ndx++;
		}
	      }
	      else {
		foreach ($langs as $lang) {
		  $fkey = $langMap[$fieldName][$lang];
		  if (!isset($f[$fkey]))
		    continue;
		  $fval = $this->mytrim($f[$fkey]);
		  $groups = explode(',', $fval);
		  $ndx = 0;
		  foreach ($groups as $group) {
		    $v = explode(':', $group);
		    if (count($v) == 2)
		      $attr['values'][$ndx][$lang] = array($v[0], $v[1]);
		    $ndx++;
		  }
		}
	      }
	      $this->attributes = array($attr);
	      if ($this->attributeCombFlag) {
		$this->attributes = array();
		$newAttr = $attr;
		foreach ($attr['values'] as $tk => $tv) {
		  list($name, $value) = $tv[$defLang];
		  $fvals = explode('&', $value);
		  foreach ($fvals as $fval) {
		    $attrValue = array();
		    foreach ($langs as $lang)
		      $attrValue[$lang] = array($name, $fval);
		    if (count($this->attributes) == 0) {
		      $newAttr['values'] = array($tk => $attrValue);
		      $this->attributes[] = $newAttr;
		    }
		    elseif (isset($this->attributes[0]['values'][$tk])) {
		      // Must add to existing groups
		      $tmpAttr = $this->attributes;
		      foreach ($tmpAttr as $av) {
			// Clone first set
			if ($av['values'][$tk] == $this->attributes[0]['values'][$tk]) {
			  $newAttr['values'] = array($tk => $attrValue);
			  $this->attributes[] = $newAttr;
			}
		      }
		    }
		    else {
		      foreach ($this->attributes as $ak => $av) {
			$this->attributes[$ak]['values'][$tk] = $attrValue;
			$this->attributes[$ak]['priceAdj'][$tk] = $attr['priceAdj'];
			$this->attributes[$ak]['weightAdj'][$tk] = $attr['weightAdj'];
		      }
		    }
		  }
		}
	      }
	    }
	    if ($fileFormat == 'XML') {
	      // XML
	      if (!empty($this->attrLater)) {
		$this->attributes[] = $this->attrLater;
		$this->attrLater = array();
	      }
	    }
	    foreach ($this->attributes as $attr) {
	      if (empty($attr['values']))
		continue;
	      if ($fileFormat == 'XML') {
		// Convert values
		$values = $attr['values'];
		$attr['values'] = array();
		$ndx = 0;
		foreach ($values as $k => $v) {
		  foreach ($langs as $lang)
		    $attr['values'][$ndx][$lang] = array($k, $v);
		  $ndx++;
		}
	      }
	      $newProductAttributeImages = array();
	      $newProductAttributes = array();
	      $newProductSuppliers = array();
	      $newProductAttributeCombinations = array();
	      $idList = array();
	      if (!isset($attr['quantity']) || $attr['quantity'] === NULL)
		$attr['quantity'] = $product['quantity'];
	      if ($this->v14)
		$priceAdj = array_sum($attr['priceAdj']);
	      else
		$priceAdj = array_sum($attr['priceAdj']) * (100 + $taxRate) / 100;
	      $weightAdj = array_sum($attr['weightAdj']);

	      /*
	      if ($dupItem) {
		$priceAdj = $product['price'] - $attrPrice;
		$weightAdj = $product['weight'] - $attrWeight;
	      }
	      */
	      $productAttribute = array(
		  'id_product_attribute' => 0,
		  'id_product' => $product['id_product'],
		  'price' => $priceAdj,
		  'weight' => $weightAdj,
		  'quantity' => $attr['quantity']);
	      if ($this->v15)
		$productAttribute['available_date'] = $time0;
	      if (isset($attr['url'])) {
		$pic = $this->convertToPic($attr['url'], $urlPrefix);
		if (!empty($productImgList[$imgSubIndex])) // Image ID known
		  $imageId = $productImgList[$imgSubIndex];
		else
		  $imageId = ++$idImage;
		$image = array(
		  'id_image' => $imageId,
		  'id_product' => $product['id_product'],
		  'position' => 1 + $imgSubIndex,
		  'url' => $pic,
		  'img_upd' => $time0,
		  'cover' => $imgSubIndex == 0 ? 1 : "\000");
		foreach ($langs as $lang) {
		  $imageLang[$lang] = array(
		      'id_image' => $imageId,
		      'id_lang' => $lang);
		  $imageLangs[] = $this->group($imageLang[$lang]);
		}
		$images[] = $this->group($image);
		if ($this->v15)
		  $this->makeShopFields($imageShopDesc, $image, $imageShop, $imageShops);
		$imageDelete[$imageId] = true;
		$productAttributeImage = array(
		    'id_product_attribute' => 0,
		    'id_image' => $imageId);
		$newProductAttributeImages[] = $productAttributeImage;
		$imgSubIndex++;
	      }
	      foreach ($this->attrImageIds as $attrImageId) {
		if ($attrImageId) {
		  $productAttributeImage = array(
		    'id_product_attribute' => 0,
		    'id_image' => $attrImageId);
		  $newProductAttributeImages[] = $productAttributeImage;
		}
	      }
	      if ($this->v161)
		$zero = "\000";
	      else
		$zero = 0;
	      if (isset($attr['ref']))
		$productAttribute['reference'] = $attr['ref'];
	      if (isset($attr['supRef']))
		$productAttribute['supplier_reference'] = $attr['supRef'];
	      if (isset($attr['ean13']))
		$productAttribute['ean13'] = $attr['ean13'];
	      if (isset($attr['upc']))
		$productAttribute['upc'] = $attr['upc'];
	      if (isset($attr['minQuant']))
		$productAttribute['minimal_quantity'] = $attr['minQuant'];
	      if ($attrDefFlag) {
		if (isset($attr['defaultOn']))
		  $productAttribute['default_on'] = $attr['defaultOn'];
		else
		  $productAttribute['default_on'] = 1;
	      }
	      else {
		if ($productRefCnt > 1)
		  $productAttribute['default_on'] = $zero;
		else
		  $productAttribute['default_on'] = 1;
	      }
	      if ($defaultOnWasSet)
		$productAttribute['default_on'] = $zero;
	      elseif ($productAttribute['default_on'] == 1)
		$defaultOnWasSet = true;
	      $newProductAttributes[] = $productAttribute;
	      if ($this->v15) {
		$idProductSupplier++;
		$productSupplier = array(
		  'id_product_supplier' => $idProductSupplier,
		  'id_product' => $product['id_product'],
		  'id_product_attribute' => 0,
		  'id_supplier' => $product['id_supplier'],
		  'id_currency' => $defCurrency,
		  'product_supplier_reference' => isset($attr['supRef']) ? $attr['supRef'] : $product['supplier_reference'],
		  'product_supplier_price_te' => isset($product['wholesale_price']) ? $product['wholesale_price'] : 0
		);
		$newProductSuppliers[] = $productSupplier;
	      }
	      foreach ($attr['values'] as $groupLangName) {
		list($groupName, $name) = $groupLangName[$defLang];
		if (!$name)
		  continue;
		if ($dash) {
		  foreach ($langs as $lang) {
		    $groupLangName[$lang] = array_merge(
		      array_slice(explode('-', $groupLangName[$lang][0]), -1),
		      array_slice(explode('-', $groupLangName[$lang][1]), -1)
		    );
		  }
		  list($groupName, $name) = $groupLangName[$defLang];
		}
		if ($groupName[0] == ':' && @preg_match('/:([^:]*):(.*)/', $groupName, $matches)) {
		  $groupName = $matches[1];
		  if (@preg_match($matches[2], $name, $matches) && isset($matches[1]))
		    $name = $matches[1];
		    foreach ($langs as $lang)
		      $groupLangName[$lang] = array($groupName, $name);
		}
		if (empty($attributeGroups[$groupName])) {
		  $attributeGroup = new AttributeGroup();
		  foreach ($langs as $lang) {
		    $attributeGroup->name[$lang] = $groupLangName[$lang][0];
		    $attributeGroup->public_name[$lang] = $groupLangName[$lang][0];
		  }
		  if ($this->v15)
		    $attributeGroup->group_type = 'select';
		  $attributeGroup->add();
		  $attributeGroups[$groupName] = $attributeGroup->id;
		  if ($this->v15) {
		    $attributeGroupShop = array('id_attribute_group' => $attributeGroup->id);
		    $this->makeShopFields($attributeGroupShopDesc, $attributeGroupShop, $attributeGroupShop, $attributeGroupShops);
		    $attributeGroupDelete[$attributeGroup->id] = true;
		  }
		}
		$attributeGroupId = $attributeGroups[$groupName];
		if (empty($attributes[$attributeGroupId][$name])) {
		  $attributeObj = new Attribute();
		  $attributeObj->id_attribute_group = $attributeGroupId;
		  foreach ($langs as $lang) {
		    $attributeObj->name[$lang] = Tools::substr($groupLangName[$lang][1], 0, 64);
		  }
		  $attributeObj->add();
		  $attributes[$attributeGroupId][$name] = $attributeObj->id;
		  if ($this->v15) {
		    $attributeShop = array('id_attribute' => $attributeObj->id);
		    $this->makeShopFields($attributeShopDesc, $attributeShop, $attributeShop, $attributeShops);
		    $attributeDelete[$attributeObj->id] = true;
		  }
		}
		$attributeId = $attributes[$attributeGroupId][$name];
		$productAttributeCombination = array(
		  'id_attribute' => $attributeId,
		  'id_product_attribute' => 0);
		$idList[] = $attributeId;
		$newProductAttributeCombinations[] =
		  $productAttributeCombination;
	      }
	      sort($idList);
	      $idStr = $product['id_product'].','.implode(',', $idList);
	      if (isset($productAttributeIds[$idStr])) {
		$id = $productAttributeIds[$idStr];
		// print "Reuse $idStr=".$id."<br>\n";
	      }
	      else {
		$id = ++$idProductAttribute;
		// print "New $idStr=".$id."<br>\n";
		$productAttributeIds[$idStr] = $id;
	      }
	      if (isset($newProductAttributeIds[$idStr]))
		continue; // Combination already exists
	      else
		$newProductAttributeIds[$idStr] = $id;
	      foreach ($newProductAttributeImages as $productAttributeImage) {
		$productAttributeImage['id_product_attribute'] = $id;
		$productAttributeImages[] = $this->group($productAttributeImage);
	      }
	      foreach ($newProductAttributes as $productAttribute) {
		$productAttribute['id_product_attribute'] = $id;
		$productAttributeDelete[$id] = true;
		$productAttributes[] = $this->group($productAttribute);
		if ($this->v15) {
		  $this->makeShopFields($productAttributeShopDesc,
		      $productAttribute, $productAttributeShop,
		      $productAttributeShops);
		  if (isset($product['out_of_stock']))
		    $attrStockAvailable['out_of_stock'] =
		      $product['out_of_stock'];
		  $this->makeShopFields($stockAvailableDesc,
		      $productAttribute, $attrStockAvailable,
		      $attrStockAvailables);
		}
	      }
	      if ($this->v15) {
		foreach ($newProductSuppliers as $productSupplier) {
		  $productSupplier['id_product_attribute'] = $id;
		  $productSuppliers[] = $this->group($productSupplier);
		}
	      }
	      foreach ($newProductAttributeCombinations as
		  $productAttributeCombination)
	      {
		$productAttributeCombination['id_product_attribute'] = $id;
		$productAttributeCombinations[] =
		  $this->group($productAttributeCombination);
	      }
	    }
	    if (!$this->v14 &&
	      !empty($attr['values']) &&
	      $product['quantity'] == 0)
	    {
	      $product['quantity'] = 1; // Fix for 1.3.7.0 problem
	    }
	    if ($dupItem) {
	      if (!$attributeList) {
		array_pop($duplicateList);
		$duplicateProduct--;
	      }
	      $attributeProduct++;
	    }
	    break;
	  case 'product_field':
	    foreach ($prodFieldMap as $fkey => $fieldName) {
	      $fval = $this->mytrim($f[$fkey]);
	      $dm = explode(':', $fieldName);
	      if (count($dm) == 2 && $dm[0] == 4) {
		$fieldName = $dm[1];
		$fval = '';
		$fkey = $fieldMap['url'];
		if (isset($this->xmlNodes[$fkey]) &&
		    !empty($this->xmlNodes[$fkey]['nodes']))
		{
		  foreach ($this->xmlNodes[$fkey]['nodes'] as $node) {
		    if (isset($node['attr']['type']) &&
			$node['attr']['type'] == 4)
		    {
		      $fval = $node['value'];
		    }
		  }
		}
	      }
	      $product[$fieldName] = pSQL($fval);
	    }
	    break;
	  case 'discount_qty_pct':
	    if ($dupItem)
	      break;
	    foreach (explode(',', $fval) as $qtyPct) {
	      $qp = explode(':', $qtyPct);
	      if (count($qp) == 1)
		$qp = array(1, $qp[0]);
	      if ($this->v14) {
		$specificPrice['reduction_type'] = 'percentage';
		$specificPrice['from_quantity'] = intval($qp[0]);
		$specificPrice['reduction'] = floatval($qp[1]) / 100;
		if ($this->v15)
		  $specificPrice['price'] = -1;
		else
		  $specificPrice['price'] = 0;
		$newSpecificPrices[] = $specificPrice;
	      }
	      else {
		$discountQuantity = array(
		    'id_discount_quantity' => ++$idDiscountQuantity,
		    'id_discount_type' => 1,
		    'id_product' => $product['id_product'],
		    'id_product_attribute' => 0,
		    'quantity' => intval($qp[0]),
		    'value' => floatval($qp[1]));
		$discountQuantities[] = $this->group($discountQuantity);
	      }
	    }
	    break;
	  case 'available_now':
	  case 'available_later':
	  case 'meta_description':
	  case 'meta_keywords':
	  case 'meta_title':
	    foreach ($langs as $lang) {
	      $fkey = $langMap[$fieldName][$lang];
	      if (!isset($f[$fkey]))
		continue;
	      $fval = $this->mytrim($f[$fkey]);
	      $productLang[$lang][$fieldName] = pSQL($fval);
	    }
	    break;
	  case 'accessories':
	    if ($dupItem)
	      break;
	    $accList = explode('|', $fval);
	    foreach ($accList as $acc) {
	      $fval = $this->mytrim($acc);
	      if ($fval && isset($productList[$fval])) {
		$pl = explode('|', $productList[$fval]);
		$accessory = array(
		  'id_product_1' => $product['id_product'],
		  'id_product_2' => $pl[1]
		);
		$accessories[] = $this->group($accessory);
	      }
	      else {
		$al = explode(':', $fval);
		if (count($al) == 2) {
		  list($accSupplier, $accRef) = $al;
		  if (empty($productAccList[$accSupplier])) {
		    $productAccList[$accSupplier] = array();
		    if ($this->v15) {
		      $rows = $this->ExecuteS('
			  SELECT `id_product`,
			  `product_supplier_reference` AS supplier_reference
			  FROM `'._DB_PREFIX_.'product_supplier`
			  LEFT JOIN `'._DB_PREFIX_.'supplier` USING (`id_supplier`)
			  WHERE `name` = "'.$accSupplier.'"');
		    }
		    else {
		      $rows = $this->ExecuteS('SELECT `id_product`, `supplier_reference`
			  FROM `'._DB_PREFIX_.'product`
			  LEFT JOIN `'._DB_PREFIX_.'supplier` USING (`id_supplier`)
			  WHERE `name` = "'.$accSupplier.'"');
		    }
		    if ($rows) {
		      foreach ($rows as $row)
			$productAccList[$accSupplier][$row['supplier_reference']] = $row['id_product'];
		    }
		  }
		  if (isset($productAccList[$accSupplier][$accRef])) {
		    $accessory = array(
		      'id_product_1' => $product['id_product'],
		      'id_product_2' => $productAccList[$accSupplier][$accRef]
		    );
		    $accessories[] = $this->group($accessory);
		  }
		}
	      }
	    }
	    break;
	  }
	}
	if (!$skipItem && !$product['supplier_reference']) {
	  // Get out of here
	  $skipItem = true;
	  $badSupRef++;
	  if ($fileFormat == 'CSV') {
	    $f = array();
	    $this->_warnings[] = $this->l('Exiting: Invalid record at entry').sprintf(" %d", $entryCount);
	  }
	}
	if ($categoryDefaultId)
	  $product['id_category_default'] = $categoryDefaultId;

	if (isset($product['price']) && $product['price'] > 0) {
	  $product['price'] += $pickingFee;
	}
	elseif ($demandPrice) {
	  $product['active'] = 0;
	  $product['date_upd'] = $timeNow;
	  $passiveItem = true;
	}

	if (function_exists('importfast_prod_specific'))
	  importfast_prod_specific($this, $f, $conversionRate, $product, $specificPrice);
	if (!$skipItem && $specificPrice &&
	    (!empty($specificPrice['price']) ||
	     !empty($specificPrice['reduction'])))
	{
	  if (!$newSpecificPrices)
	    $newSpecificPrices = array($specificPrice);
	  foreach ($this->shopIds as $shopId) {
	    foreach ($newSpecificPrices as $specificPrice) {
	      $specificPrice['id_specific_price'] = ++$idSpecificPrice;
	      $specificPrice['id_product'] = $product['id_product'];
	      if ($this->v15) {
		$specificPrice['id_shop'] = $shopId;
		$specificPrice['id_shop_group'] = $this->shopGroupIds[$shopId];
	      }
	      if ($specificPrice['reduction_type'] == 'amount') {
		$specificPrice['id_currency'] = $defCurrency;
		foreach (Currency::getCurrencies() as $row) {
		  $newSpecificPrice = $specificPrice;
		  $newSpecificPrice['price'] *= $row['conversion_rate'];
		  $newSpecificPrice['reduction'] *= $row['conversion_rate'];
		  $newSpecificPrice['id_specific_price'] = ++$idSpecificPrice;
		  $newSpecificPrice['id_currency'] = $row['id_currency'];
		  $specificPrices[] = $this->group($newSpecificPrice);
		}
	      }
	      else {
		$specificPrices[] = $this->group($specificPrice);
	      }
	    }
	  }
	  $specificPrice['price'] = $specificPrice['reduction'] = 0; // Invalidate for next entry
	  $newSpecificPrices = array();
	}

	if ($newManId) {
	  foreach ($newManId as $name => $manufacturerId) {
	    $manufacturer['id_manufacturer'] = $manufacturerId;
	    $manufacturer['name'] = pSQL($name);
	    $manufacturer['date_add'] = $manufacturer['date_upd'] = $timeNow;
	    if ($this->v14)
	      $manufacturer['active'] = 1;
	    $manufacturers[] = $this->group($manufacturer);
	    if ($this->v15)
	      $this->makeShopFields($manufacturerShopDesc, $manufacturer, $manufacturerShop, $manufacturerShops);
	    foreach ($langs as $lang) {
	      $manufacturerLang[$lang] = array(
		'id_manufacturer' => $manufacturerId,
		'id_lang' => $lang);
	      $manufacturerLangs[] = $this->group($manufacturerLang[$lang]);
	    }
	  }
	  $newManId = array();
	}

	if ($newCatId) {
	  foreach ($newCatId as $defName => $categoryId) {
	    if (isset($rootCategories[$categoryId]))
	      continue;
	    if (isset($categories[$categoryId]))
	      continue;
	    foreach ($langs as $lang) {
	      if ($lang == $defLang) {
		$category['id_category'] = $categoryId;
		$category['id_parent'] = $homeCategoryId;
		$category['level_depth'] = $defLevelDepth;
		if (!isset($catActive[$categoryId]))
		  $catActive[$categoryId] = 1;
		$category['active'] = $catActive[$categoryId];
		$category['date_add'] = $category['date_upd'] = $timeNow;
		if (isset($catPosition[$categoryId]))
		  $catPositionId[$homeCategoryId] = $catPosition[$categoryId];
		if (empty($catPositionId[$homeCategoryId]))
		  $catPositionId[$homeCategoryId] = 1;
		$category['position'] = $catPositionId[$homeCategoryId]++;
		$categories[$categoryId] = $this->group($category);
		if ($this->v15) {
		  $this->makeShopFields($categoryShopDesc, $category, $categoryShop, $categoryShops);
		}
		$categoryGroup['id_category'] = $categoryId;
		foreach ($priceGroups as $id_group) {
		  $categoryGroup['id_group'] = $id_group;
		  $categoryGroups[] = $this->group($categoryGroup);
		}
	      }
	      $name = $catName[$categoryId][$lang];
	      $categoryLang['id_category'] = $categoryId;
	      $categoryLang['id_lang'] = $lang;
	      if ($this->v14)
		$categoryLang['name'] = pSQL($name);
	      else {
		// Prepend space. Otherwise e.g. for "3.5 xxx"
		// the number "3." will be used for sorting
		$categoryLang['name'] = ' '.pSQL($name);
	      }
	      $categoryLang['description'] = '';
	      $categoryLang['link_rewrite'] = self::link_rewrite($name);
	      if ($this->v15) {
		foreach ($this->shopIds as $shopId) {
		  $categoryLang['id_shop'] = $shopId;
		  $categoryLangs[] = $this->group($categoryLang);
		}
	      }
	      else
		$categoryLangs[] = $this->group($categoryLang);
	    }
	  }
	  $newCatId = array();
	}

	if ($newCatSubId) {
	  foreach ($newCatSubId as $c => $categoryId) {
	    if (isset($categories[$categoryId]))
	      continue;
	    $v = explode($subCategorySep, $c);
	    $parentId = $v[0];
	    foreach ($langs as $lang) {
	      if ($lang == $defLang) {
		$category['date_add'] = $category['date_upd'] = $timeNow;
		$category['id_category'] = $categoryId;
		$category['id_parent'] = $parentId;
		$category['level_depth'] = $catSubLevel[$categoryId];
		if (!isset($catActive[$categoryId]))
		  $catActive[$categoryId] = 1;
		$category['active'] = $catActive[$categoryId];
		if (isset($catPosition[$categoryId]))
		  $catPositionId[$parentId] = $catPosition[$categoryId];
		if (empty($catPositionId[$parentId]))
		  $catPositionId[$parentId] = 1;
		$category['position'] = $catPositionId[$parentId]++;
		$categories[$categoryId] = $this->group($category);
		if ($this->v15) {
		  $this->makeShopFields($categoryShopDesc, $category, $categoryShop, $categoryShops);
		}
		$categoryGroup['id_category'] = $categoryId;
		foreach ($priceGroups as $id_group) {
		  $categoryGroup['id_group'] = $id_group;
		  $categoryGroups[] = $this->group($categoryGroup);
		}
	      }
	      $name = $catSubName[$categoryId][$lang];
	      $categoryLang['id_category'] = $categoryId;
	      $categoryLang['id_lang'] = $lang;
	      if ($this->v14)
		$categoryLang['name'] = pSQL($name);
	      else {
		// Prepend space. Otherwise e.g. for "3.5 xxx"
		// the number "3." will be used for sorting
		$categoryLang['name'] = ' '.pSQL($name);
	      }
	      $categoryLang['description'] = '';
	      if (empty($rootCategories[$parentId])) {
		if (isset($catSubName[$parentId][$lang]))
		  $name = $catSubName[$parentId][$lang].' '.$name;
		elseif (isset($catName[$parentId][$lang]))
		  $name = $catName[$parentId][$lang].' '.$name;
	      }
	      $categoryLang['link_rewrite'] = self::link_rewrite($name);
	      if ($this->v15) {
		foreach ($this->shopIds as $shopId) {
		  $categoryLang['id_shop'] = $shopId;
		  $categoryLangs[] = $this->group($categoryLang);
		}
	      }
	      else
		$categoryLangs[] = $this->group($categoryLang);
	    }
	  }
	  $newCatSubId = array();
	}

	foreach ($langs as $lang) {
	  foreach ($metaTypes as $t => $v) {
	    if ($t == 'meta_keywords')
	      $jc = ', ';
	    else
	      $jc = ' ';
	    if (empty($productLang[$lang][$t]))
	      $productLang[$lang][$t] = '';
	    foreach ($v as $m) {
	      switch ($m) {
	      case 'shop_name':
		$metaVal = pSQL($shopName);
		break;
	      case 'name':
		$metaValRef = &$productLang[$lang][$m];
		if (empty($metaValRef))
		  $metaVal = '';
		else
		  $metaVal = $metaValRef;
		break;
	      case 'reference':
	      case 'supplier_reference':
		$metaValRef = &$product[$m];
		if (empty($metaValRef))
		  $metaVal = '';
		else
		  $metaVal = pSQL($metaValRef);
		break;
	      case 'manufacturer':
		$metaVal = pSQL($manName);
		break;
	      case 'category':
		$metaValRef = &$catName[$product['id_category_default']][$lang];
		if (empty($metaValRef))
		  $metaValRef = &$catSubName[$product['id_category_default']][$lang];
		if (empty($metaValRef))
		  $metaVal = '';
		else
		  $metaVal = pSQL($metaValRef);
		break;
	      case 'features':
		$metaVal = array();
		foreach ($newFeature as $name => $fval) {
		  $metaVal[] = pSQL($name.$fval);
		}
		$metaVal = implode($jc, $metaVal);
		break;
	      case 'description_short':
	      case 'description':
		$metaValRef = &$productLang[$lang][$m];
		if (!empty($metaValRef) && $setup[$t][$m]) {
		  $metaVal = strip_tags(str_replace('\n', ' ', $metaValRef));
		  $metaVal = str_replace("\\'", "'", $metaVal);
		  $metaVal = $this->truncate($metaVal, $setup[$t][$m]);
		  $metaVal = str_replace("'", "\\'", $metaVal);
		}
		else
		  $metaVal = '';
		break;
	      }
	      if ($metaVal) {
		if ($productLang[$lang][$t])
		  $productLang[$lang][$t] .= $jc.$metaVal;
		else
		  $productLang[$lang][$t] .= $metaVal;
	      }
	    }
	  }
	  $productLang[$lang]['id_product'] = $product['id_product'];
	  $productLang[$lang]['id_lang'] = $lang;
	  if ($this->v15) {
	    $productLang[$lang]['id_shop'] = 0;
	    $product['id_shop_default'] = $this->shopIdDefault;
	  }
	  if (isset($productLang[$lang]['name']) && empty($productLang[$lang]['link_rewrite'])) {
	    $name = $productLang[$lang]['name'];
	    $productLang[$lang]['link_rewrite'] = self::link_rewrite($name);
	  }
	  if ($skipItem == false) {
	    if ($this->v15) {
	      foreach ($this->shopIds as $shopId) {
		$productLang[$lang]['id_shop'] = $shopId;
		$productLangs[] = $this->group($productLang[$lang]);
	      }
	    }
	    else
	      $productLangs[] = $this->group($productLang[$lang]);
	  }
	}

	if ($newFeature) {
	  foreach ($newFeature as $name => $fval) {
	    if (!isset($featId[$name]))
	      $featId[$name] = $newFeatId[$name] = ++$idFeature;
	    $featureId = $featId[$name];
	    if (empty($fval))
	      continue;
	    if (!isset($featValId[$featureId][$fval]))
	      $featValId[$featureId][$fval] = $newFeatValId[$featureId][$fval] = ++$idFeatureVal;
	    $featureValId = $featValId[$featureId][$fval];
	    $featureProduct = array(
	      'id_feature' => $featureId,
	      'id_product' => $product['id_product'],
	      'id_feature_value' => $featureValId);
	    $featureProducts[] = $this->group($featureProduct);
	  }
	  $newFeature = array();
	}

	if ($newFeatId) {
	  foreach ($newFeatId as $name => $featureId) {
	    foreach ($langs as $lang) {
	      if ($lang == $defLang) {
		$feature['id_feature'] = $featureId;
		$features[] = $this->group($feature);
		if ($this->v15)
		  $this->makeShopFields($featureShopDesc, $feature, $featureShop, $featureShops);
	      }
	      $featureLang['id_feature'] = $featureId;
	      $featureLang['id_lang'] = $lang;
	      $featureLang['name'] = pSQL($name);
	      $featureLangs[] = $this->group($featureLang);
	    }
	  }
	  $newFeatId = array();
	}

	if ($newFeatValId) {
	  foreach ($newFeatValId as $featureId => $featVal) {
	    foreach ($featVal as $value => $featureValId) {
	      foreach ($langs as $lang) {
		if ($lang == $defLang) {
		  $featureValue['id_feature_value'] = $featureValId;
		  $featureValue['id_feature'] = $featureId;
		  if ($this->v14)
		    $featureValue['custom'] = 0;
		  $featureValues[] = $this->group($featureValue);
		}
		$featureValueLang['id_feature_value'] = $featureValId;
		$featureValueLang['id_lang'] = $lang;
		$featureValueLang['value'] = pSQL($value);
		$featureValueLangs[] = $this->group($featureValueLang);
	      }
	    }
	  }
	  $newFeatValId = array();
	}

	if ($skipItem == false) {
	  $products[] = $this->group($product);
	  if (count($products) >= 100)
	    $mustStop = 1;
	  if ($this->v15) {
	    $this->makeShopFields($productShopDesc, $product, $productShop, $productShops);
	    $this->makeShopFields($stockAvailableDesc, $product, $stockAvailable, $stockAvailables, 'id_product_attribute');
	    $idProductSupplier++;
	    $productSupplier = array(
	      'id_product_supplier' => $idProductSupplier,
	      'id_product' => $product['id_product'],
	      'id_product_attribute' => 0,
	      'id_supplier' => $product['id_supplier'],
	      'id_currency' => $defCurrency,
	      'product_supplier_reference' => $product['supplier_reference'],
	      'product_supplier_price_te' => isset($product['wholesale_price']) ? $product['wholesale_price'] : 0
	    );
	    $productSuppliers[] = $this->group($productSupplier);
	  }
	  if ($passiveItem)
	    $notActive++;
	  elseif ($addedFlag)
	    $addedProduct++;
	  else
	    $updatedProduct++;
	}
	else {
	  if ($this->importType == 0 && isset($curProductEntry)) {
	    // Decrement refcount
	    $productVals = explode('|', $curProductEntry);
	    --$productVals[3];
	    $curProductEntry = implode('|', $productVals);
	  }
	}
      }
      if ($this->importType == 1 && count($productDelete) >= 100)
	$mustStop = 1;
      if ($mustStop || !$f) {
	$this->savedRows = array();
	self::deleteList('product', 'id_product', $productDelete);
	self::updateDatabase('product', $products, $product);
	self::deleteList('product_lang', 'id_product', $productDelete);
	self::updateDatabase('product_lang', $productLangs, $productLang);
	if ($this->v15) {
	  $shopCond = ' AND `id_shop` IN '.$this->group($this->shopIds);
	  self::deleteList('product_shop', 'id_product', $productDelete, $shopCond);
	  self::updateDatabase('product_shop', $productShops, $productShop);
	  self::deleteList('product_supplier', 'id_product', $productDelete);
	  self::updateDatabase('product_supplier', $productSuppliers, $productSupplier);
	  self::deleteList('stock_available', 'id_product', $productDelete,
	      ' AND `id_product_attribute` != 0');
	  self::updateDatabase('stock_available', $attrStockAvailables, $attrStockAvailable, 'IGNORE');
	  self::deleteList('stock_available', 'id_product', $productDelete,
	      ' AND `id_product_attribute` = 0');
	  self::updateDatabase('stock_available', $stockAvailables, $stockAvailable, 'IGNORE');
	  self::deleteList('attribute_shop', 'id_attribute', $attributeDelete);
	  $attributeDelete = array();
	  self::updateDatabase('attribute_shop', $attributeShops, $attributeShop);
	  self::deleteList('attribute_group_shop', 'id_attribute_group', $attributeGroupDelete);
	  $attributeGroupDelete = array();
	  self::updateDatabase('attribute_group_shop', $attributeGroupShops, $attributeGroupShop);
	}
	if ($categoriesPersistent) {
	  $cps = array();
	  foreach ($categoryProducts as $key => $cp) {
	    list($categoryId, $productId, $position) = explode("','", $cp);
	    if (empty($productDelete[$productId]))
	      $cps[$key] = $cp;
	  }
	  $categoryProducts = $cps;
	}
	else
	  self::deleteList('category_product', 'id_product', $productDelete,
	    ' AND `id_category` NOT IN '.$this->group($rootCategories));
	$homeProducts = array();
	foreach ($categoryProducts as $cp) {
	  // TBD ungroup
	  list($categoryId, $productId, $position) =
	    explode("','", trim($cp, "'()"));
	  if ($categoryId == $homeCategoryId)
	    $homeProducts[$productId] = true;
	}
	self::deleteList('category_product', 'id_product', $homeProducts);
	self::updateDatabase('category_product', $categoryProducts, $categoryProduct);
	if ($imageFlag) {
	  self::deleteList('image', 'id_product', $productDelete);
	  self::updateDatabase('image', $images, $image);
	}
	if ($featureFlag || $this->importType == 0) {
	  self::deleteList('feature_product', 'id_product', $productDelete);
	  self::updateDatabase('feature_product', $featureProducts, $featureProduct);
	}
	if ($tagFlag) {
	  self::deleteList('product_tag', 'id_product', $productDelete);
	  self::updateDatabase('product_tag', $productTags, $productTag);
	  self::updateDatabase('tag', $tagLangs, $tagLang);
	}
	if ($specificFlag) {
	  if ($this->v14) {
	    self::deleteList('specific_price', 'id_product', $productDelete);
	    self::updateDatabase('specific_price', $specificPrices, $specificPrice);
	  }
	  else {
	    self::deleteList('discount_quantity', 'id_product', $productDelete);
	    self::updateDatabase('discount_quantity', $discountQuantities, $discountQuantity);
	  }
	}
	self::deleteListIn('product_attribute_combination', 'id_product_attribute',
	  'product_attribute', 'id_product', $productDelete);
	self::updateDatabase('product_attribute_combination', $productAttributeCombinations, $productAttributeCombination);
	self::deleteListIn('product_attribute_image', 'id_product_attribute',
	  'product_attribute', 'id_product', $productDelete);
	self::updateDatabase('product_attribute_image', $productAttributeImages, $productAttributeImage);
	if ($this->v15) {
	  if ($this->importType == 0)
	    self::deleteListIn('product_attribute_shop', 'id_product_attribute',
		'product_attribute', 'id_product', $productDelete);
	  else
	    self::deleteList('product_attribute_shop', 'id_product_attribute',
		$productAttributeDelete);
	  self::updateDatabase('product_attribute_shop', $productAttributeShops, $productAttributeShop);
	}
	if ($this->importType == 0)
	  self::deleteList('product_attribute', 'id_product', $productDelete);
	else
	  self::deleteList('product_attribute', 'id_product_attribute', $productAttributeDelete);
	if ($this->v15 && $this->importType == 1 && count($productAttribute) == 2) {
	  self::updateValue('stock_available', $productAttributes, $productAttribute);
	}
	self::updateDatabase('product_attribute', $productAttributes, $productAttribute);
	if ($this->importType == 0 || $accessoryFlag)
	  self::deleteList('accessory', 'id_product_1', $productDelete);
	self::updateDatabase('accessory', $accessories, $accessory);
	self::deleteList('image_lang', 'id_image', $imageDelete);
	self::updateDatabase('image_lang', $imageLangs, $imageLang);
	if ($this->v15 && $imageDelete) {
	  self::deleteList('image_shop', 'id_image', $imageDelete);
	  self::updateDatabase('image_shop', $imageShops, $imageShop);
	}
	$productDelete = array();
	$imageDelete = array();
	self::updateDatabase('manufacturer', $manufacturers, $manufacturer);
	self::updateDatabase('manufacturer_lang', $manufacturerLangs, $manufacturerLang);
	if ($this->v15)
	  self::updateDatabase('manufacturer_shop', $manufacturerShops, $manufacturerShop);
	if ($existedList) {
	  $this->Execute('UPDATE `'._DB_PREFIX_.'product`
	    SET `active` = 1
	    WHERE `active` != 0 AND `id_product` IN '.$this->group($existedList));
	  $existedList = array();
	}
	if ($mustStop == 2) {
	  $this->_warnings[] = $this->l('Max. time exceeded. Resume again to finish.');
	  $this->runAgain = true;
	  $this->counters = array(
	    'startEntry' => $entryCount,
	    'lowQuantity' => $lowQuantity,
	    'notValid' => $notValid,
	    'badSupRef' => $badSupRef,
	    'noPictures' => $noPictures,
	    'noCategory' => $noCategory,
	    'noAlias' => $noAlias,
	    'duplicateProduct' => $duplicateProduct,
	    'existingProduct' => $existingProduct,
	    'attributeProduct' => $attributeProduct,
	    'notActive' => $notActive,
	    'addedProduct' => $addedProduct,
	    'updatedProduct' => $updatedProduct,
	    'deletedProducts' => $deletedProducts
	  );
	  break;
	}
      }
      $mustStop = 0;
    } while ($f);

    self::deleteList('category_group', 'id_category', $categories);
    self::updateDatabase('category_group', $categoryGroups, $categoryGroup);
    if ($this->v15)
      $shopCond = ' AND `id_shop` IN '.$this->group($this->shopIds);
    else
      $shopCond = '';
    self::deleteList('category_lang', 'id_category', $categories, $shopCond);
    self::updateDatabase('category_lang', $categoryLangs, $categoryLang);
    if ($this->v15) {
      self::deleteList('category_shop', 'id_category', $categories, $shopCond);
      self::updateDatabase('category_shop', $categoryShops, $categoryShop);
    }
    self::deleteList('category', 'id_category', $categories);
    self::updateDatabase('category', $categories, $category);

    self::updateDatabase('feature', $features, $feature);
    self::updateDatabase('feature_lang', $featureLangs, $featureLang);
    self::updateDatabase('feature_value', $featureValues, $featureValue);
    self::updateDatabase('feature_value_lang', $featureValueLangs, $featureValueLang);
    if ($this->v15)
      self::updateDatabase('feature_shop', $featureShops, $featureShop);

    // Roll back if SQL statement failed
    if (isset($this->noCommit)) {
      $this->_status[] =
	'-----------------'.$this->l('Not committed!').'-----------------';
      $this->Execute('ROLLBACK');
      unset($this->runAgain);
    }
    else {
      $this->Execute('COMMIT');
    }

    // Free some memory
    unset($productList);
    $deactivatedProducts = 0;
    $zeroedProducts = 0;
    if (empty($this->runAgain)) {
      // Afterburner
      if ($existedList) {
	$this->Execute('UPDATE `'._DB_PREFIX_.'product`
	  SET `active` = 1
	  WHERE `active` != 0 AND `id_product` IN '.$this->group($existedList));
	$existedList = array();
      }
      if ($zeroProducts) {
	$this->Execute('UPDATE `'._DB_PREFIX_.'product`
	  SET `quantity` = 0
	  WHERE `active` = 2 AND `quantity` != 0 AND `id_supplier` = '.$supplierId);
	$zeroedProducts += Db::getInstance()->Affected_Rows();
	$this->Execute('UPDATE `'._DB_PREFIX_.'product_attribute`
	  SET `quantity` = 0
	  WHERE `quantity` != 0 AND `id_product` IN (
	    SELECT `id_product`
	    FROM `'. _DB_PREFIX_.'product`
	    WHERE `active` = 2 AND `id_supplier` = '.$supplierId.')');
	$zeroedProducts += Db::getInstance()->Affected_Rows();
	if ($this->v15) {
	  $this->Execute('UPDATE `'._DB_PREFIX_.'stock_available`
	    SET `quantity` = 0
	    WHERE `quantity` != 0 AND `id_product` IN (
	      SELECT `id_product`
	      FROM `'. _DB_PREFIX_.'product`
	      WHERE `active` = 2 AND `id_supplier` = '.$supplierId.')');
	}
      }
      if ($disableProducts) {
	if ($this->v15) {
	  $this->Execute('UPDATE `'._DB_PREFIX_.'product_shop`
	    SET `active` = 0, `redirect_type` = "404"
	    WHERE `active` != 0 AND `id_product` IN (
	      SELECT `id_product`
	      FROM `'. _DB_PREFIX_.'product`
	      WHERE `active` = 2 AND `id_supplier` = '.$supplierId.')'.
	      $shopCond);
	}
	$this->Execute('UPDATE `'._DB_PREFIX_.'product`
	  SET `active` = 0
	  WHERE `active` = 2 AND `id_supplier` = '.$supplierId);
	$deactivatedProducts += Db::getInstance()->Affected_Rows();
      }
      if ($demandProduct) {
	$this->deactivateCategories();
      }
      if ($demandCategory) {
	$deactivatedProducts += $this->deactivateProducts();
      }
      // Roll back active value
      $this->Execute('UPDATE `'._DB_PREFIX_.'product`
	SET `active` = 1
	WHERE `active` = 2 AND `id_supplier` = '.$supplierId);
      if ($this->v15) {
	// Update stock_available sums
	$query = '
	  UPDATE `'._DB_PREFIX_.'stock_available` AS sa1
	  JOIN (
	      SELECT `id_product`, SUM(quantity) AS sum_quantity
	      FROM `'._DB_PREFIX_.'stock_available`
	      WHERE `id_product_attribute` != 0 GROUP BY `id_product`) AS sa2
	  ON sa1.`id_product` = sa2.`id_product`
	  SET sa1.`quantity` = sa2.`sum_quantity`
	  WHERE `id_product_attribute` = 0';
	$this->Execute($query);
      }
      if ($this->v15) {
	// Copy product title to image legend
	$query = '
	  UPDATE `'._DB_PREFIX_.'image_lang` il
	  LEFT JOIN `'._DB_PREFIX_.'image` i
	  ON i.`id_image` = il.`id_image`
	  LEFT JOIN `'._DB_PREFIX_.'product_supplier` ps
	  ON i.`id_product` = ps.`id_product`
	  LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
	  ON i.`id_product` = pl.`id_product`
	  SET il.`legend` = pl.`name`
	  WHERE il.`id_lang` = pl.`id_lang`
	  AND ps.`id_supplier` = '.$supplierId;
	$this->Execute($query);
      }
      $this->categoryUpdate();
    }
    if ($this->importType == 1)
      $addedProduct = 0;
    $this->_status[] = $this->l('Run time:').sprintf(" %.3f ", microtime(true) - $startTime).$this->l('seconds');
    if ($skipFirstLines)
      $this->_status[] = $this->entryText($skipFirstLines, $this->l('line')).$this->l('skipped');
    if ($skipFirstItem)
      $this->_status[] = $this->entryText($skipFirstItem ? 1 : 0).$this->l('first item; skipped');
    if ($badSupRef)
      $this->_status[] = $this->entryText($badSupRef).$this->l('invalid supplier reference');
    if ($minQuantity)
      $this->_status[] = $this->entryText($lowQuantity).$this->l('with low quantity; skipped');
    if ($demandPicture)
      $this->_status[] = $this->entryText($noPictures).$this->l('with no picture; skipped');
    $this->_status[] = $this->entryText($noCategory).$this->l('with no category; skipped');
    if ($demandAlias)
      $this->_status[] = $this->entryText($noAlias).$this->l('with no category alias; skipped');
    $this->_status[] = $this->entryText($duplicateProduct).$this->l('with duplicate product ID');
    if ($onlyNew)
      $this->_status[] = $this->entryText($existingProduct).$this->l('existed already');
    $this->_status[] = $this->entryText($attributeProduct).$this->l('specifying attributes');
    $this->_status[] = $this->entryText($notValid).$this->l('not valid');
    $this->_status[] = $this->entryText($notActive).$this->l('not active');
    $this->_status[] = $this->entryText($addedProduct).$this->l('added');
    $this->_status[] = $this->entryText($updatedProduct).$this->l('updated');
    $this->_status[] = $this->entryText($entryCount).$this->l('read from file');
    $this->_status[] = '<hr />';
    $this->_status[] = $this->entryText($deletedProducts).$this->l('deactivated and old; deleted');
    $this->_status[] = $this->entryText($deactivatedProducts).$this->l('deactivated');
    $this->_status[] = $this->entryText($zeroedProducts).$this->l('set to zero quantity');
    $query = 'DELETE FROM `'._DB_PREFIX_.'importfast`
      WHERE `supplierId` = '.$confSupplierId.'
      AND `type` LIKE \'s%\' AND `ext_field` = \'resume\'';
    $this->Execute($query);
    if (isset($this->runAgain)) {
      $this->_status[] = $this->l('Must resume from entry').' '.($entryCount + 1);
      if ($this->importType == 0) {
	$query = 'INSERT INTO `'._DB_PREFIX_.'importfast`
	  (`supplierId`, `type`, `ext_field`, `int_primary`)
	  VALUES ('.$confSupplierId.', \'s\', \'resume\', '.$entryCount.')';
      }
      else {
	$query = 'INSERT INTO `'._DB_PREFIX_.'importfast`
	  (`supplierId`, `type`, `ext_field`, `int_primary`)
	  VALUES ('.$confSupplierId.', \'s1\', \'resume\', '.$entryCount.')';
      }
      $this->Execute($query);
    }
    $this->duplicateList = $duplicateList;
    $this->notfoundList = $notfoundList;
    if (empty($this->runAgain)) {
      if ($this->v15) {
	Configuration::updateGlobalValue('PS_SPECIFIC_PRICE_FEATURE_ACTIVE',
	  SpecificPrice::isCurrentlyUsed('specific_price'));
      }
      if (function_exists('importfast_afterburner'))
	importfast_afterburner($this);
    }
  }

  public function readCategoriesFile(&$aliases, &$aliasesExpr, $subCategorySep)
  {
    global $cookie;

    $timeNow = date('Y-m-d H:i:s');
    $aliases = array();
    $tmpAliases = array();
    $aliasesExpr = array();
    $supplierId = $cookie->supplierId = Tools::getValue('supplierId');
    $confSupplierId = Tools::getValue('confSupplierId', $supplierId);
    $fileFormat = Tools::getValue('fileFormat');
    $catFileName = Tools::getValue('catFileName');
    if (empty ($catFileName) || $catFileName == 'None')
      return true;
    $catFileName = $this->adminPath.$catFileName;
    $this->defLang = $defLang = intval(Configuration::get('PS_LANG_DEFAULT'));
    $langs = array($defLang);
    $result = $this->ExecuteS('SELECT * FROM `'.
      _DB_PREFIX_.'importfast` WHERE `supplierId` = '.$confSupplierId.'
      AND `type` IN ("g", "y", "d")');
    if (!$result) {
      $this->_errors[] = $this->l('Import not configured');
      return false;
    }
    $setup = array();
    foreach ((array)$result as $f) {
      if ($f['type'] == 'g') {
	$setup[$f['ext_field']] = $f['int_primary'];
      }
      else {
	$fieldMap[$f['int_primary']] = $f['ext_field'];
	$fieldMap[$f['int_secondary']] = $f['ext_field'];
	if (in_array($f['int_primary'], $this->langFields)) {
	  if ($f['int_lang'])
	    $langMap[$f['int_primary']][$f['int_lang']] = $f['ext_field'];
	  else
	    $langMap[$f['int_primary']][$defLang] = $f['ext_field'];
	}
      }
    }
    /*
    foreach ($langs as $lang) {
      foreach ($langMap as $fieldName => $langm) {
	if (!isset($langm[$lang])) {
	  if (isset($langm[$defLang]))
	    $langMap[$fieldName][$lang] = $langm[$defLang];
	  else
	    $langMap[$fieldName][$lang] = $fieldMap[$fieldName];
	}
      }
    }
     */
    if (empty($setup['enclosure'])) {
      $this->_errors[] = $this->l('Category aliases not configured');
      return false;
    }
    $this->htmlMode = $setup['htmlMode'];
    $skipFirstItem = $setup['skipFirstItem'];
    $this->iso8859 = $setup['iso8859'];
    $categoryEndTag = $setup['categoryEndTag'];
    $this->itemTag = $setup['categoryTag'];
    $itemSep = $setup['itemSep'];
    $enclosure = $setup['enclosure'];
    if ($itemSep == "tab")
      $itemSep = "\t";
    $fp = @fopen($catFileName, "r");
    if (!$fp) {
      $this->_errors[] = $this->l('Could not open').' '.$catFileName.' '.$this->l('for reading');
      return false;
    }
    $entryCount = 0;

    if ($fileFormat == 'XML') {
      $parser = xml_parser_create();
      xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, false);
      xml_set_object($parser, $this);
      xml_set_element_handler($parser, 'tagStart', 'tagEnd');
      if (function_exists('importfast_cat_tagContent'))
	xml_set_character_data_handler($parser, 'catTagContentCustomer');
      else
	xml_set_character_data_handler($parser, 'tagContent');
      $this->xmlTag = array();
      $this->xmlData = array();
      $this->foundItem = false;
      $firstItemParsed = false;
    }
    else {
      if ($this->iso8859) {
	stream_filter_register("utf8encode", "importfast_utf8encode_filter");
	stream_filter_prepend($fp, "utf8encode");
	$this->iso8859 = 2;
      }
      $firstItemParsed = true;
    }

    $f = NULL;
    $parents = array();
    if ($categoryEndTag)
      $endTag = '</'.$this->itemTag.'>';
    else
      $endTag = '>';
    do {
      if ($fileFormat == 'XML') {
	// function readCategoriesFile() read contents
	$line = $this->stream_get_line($fp, 0x100000, $endTag, $eof);
	if ($this->iso8859)
	  $line = utf8_encode($line);
	$this->xmlNames = array();
	$this->attributes = array();
	$this->attrRefVal = NULL;
	$this->attrSupRefVal = NULL;
	$this->attrEan13Val = NULL;
	$this->xmlNodes = array();
	$this->xmlData = array();
	if ($line) {
	  if (!xml_parse($parser, $line, $eof)) {
	    $this->_errors[] = $this->l('XML parsing failed at line').
	      sprintf(" %d: ", xml_get_current_line_number($parser)).
	      xml_error_string(xml_get_error_code($parser));
	    if (isset($alias['old_name'])) {
	      $lasterr = count($this->_errors) - 1;
	      $this->_errors[$lasterr] .= "<br />".$this->l('Previous category name').' '.
		$alias['old_name'];
	    }
	    if (isset($alias['old_name_expr'])) {
	      $lasterr = count($this->_errors) - 1;
	      $this->_errors[$lasterr] .= "<br />".$this->l('Previous category name').' '.
		$alias['old_name_expr'];
	    }
	    return false;
	  }
	  if (!$this->foundItem) {
	    $f = true;
	    continue;
	  }
	  $this->foundItem = false;
	  $entryCount++;
	  if ($skipFirstItem && $firstItemParsed == false) {
	    $firstItemParsed = true;
	    continue;
	  }
	  $f = $this->xmlNames;
	}
	else {
	  // EOF
	  $f = NULL;
	}
      }
      else {
	$f = fgetcsv($fp, 0, $itemSep, $enclosure);
	$entryCount++;
	if ($f) {
	  if ($skipFirstItem && $entryCount == 1)
	    continue;
	  if (count($f) == 1)
	    continue;
	}
	if (function_exists('importfast_cat_csv'))
	  importfast_cat_csv($f);
      }
      $fieldNames = $this->catFields;

      if ($f) {
	$alias = array();
	foreach ($fieldNames as $fieldName => $fieldLangName) {
	  if (isset($this->defaultValues[$fieldName]))
	    $alias[$fieldName] = $this->defaultValues[$fieldName];
	  if (!isset($fieldMap[$fieldName]))
	    continue;
	  $fkey = $fieldMap[$fieldName];
	  if (!isset($f[$fkey]))
	    $f[$fkey] = '';
	  $fval = $this->mytrim($f[$fkey]);
	  if (!$fval)
	    continue;
	  switch ($fieldName) {
	  case 'old_name':
	  case 'old_name_expr':
	  case 'new_name':
	  case 'parent':
	    $alias[$fieldName] = $fval;
	    break;
	  }
	}
	if (!empty($alias['old_name']) && !empty($alias['new_name']))
	  $tmpAliases[$alias['old_name']] = $alias['new_name'];
	if (!empty($alias['old_name_expr']) && !empty($alias['new_name']))
	  $aliasesExpr[$alias['old_name_expr']] = $alias['new_name'];
	if (!empty($alias['parent']) && !empty($alias['old_name']))
	  $parents[$alias['old_name']] = $alias['parent'];
      }
    } while ($f);
    if ($fileFormat == 'XML')
      xml_parser_free($parser);
    fclose($fp);
    unset($this->utf16);
    foreach ($tmpAliases as $oldName => $newName) {
      $aliases[$oldName] = $newName;
      $parent = $oldName;
      while (isset($parents[$parent])) {
	$parent = $parents[$parent];
	if (empty($tmpAliases[$parent]))
	  break;
	$aliases[$oldName] =
	  $tmpAliases[$parent].$subCategorySep.$aliases[$oldName];
      }
    }
    return true;
  }

  public function displayCatSetup()
  {
    global $cookie;

    ini_set('auto_detect_line_endings',true);
    $supplierId = $cookie->supplierId = Tools::getValue('supplierId');
    $fileFormat = Tools::getValue('fileFormat');
    $importType = Tools::getValue('importType');
    $catFileName = Tools::getValue('catFileName');
    if ($supplierId == 0) {
      $this->_errors[] = $this->l('You must select a supplier');
      return false;
    }
    if ($catFileName == 'None') {
      $this->_errors[] = $this->l('No categories file selected');
      return false;
    }
    $catFileName = $this->adminPath.$catFileName;
    $this->_status[] = "Opening $catFileName";
    if ($fileFormat == 'XML')
      $fp = @fopen($catFileName, "rb");
    else
      $fp = @fopen($catFileName, "rt");
    if (!$fp) {
      $this->_errors[] = $this->l('Could not open').' '.$catFileName.' '.
	$this->l('for reading');
      return false;
    }
    if ($fileFormat == 'XML') {
      $this->_status[] = $this->l('File is XML format');
    }
    else {
      $this->_status[] = $this->l('File is CSV format');
    }
    $entryCount = 0;

    if ($fileFormat == 'XML') {
      $parser = xml_parser_create();
      xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, false);
      xml_set_object($parser, $this);
      xml_set_element_handler($parser, 'tagStart', 'tagEnd');
      if (function_exists('importfast_cat_tagContent'))
	xml_set_character_data_handler($parser, 'catTagContentCustomer');
      else
	xml_set_character_data_handler($parser, 'tagContent');
      $this->xmlTag = array();
      $this->xmlData = array();
      $this->xmlNames = array();
      $this->xmlNodes = array();
      $this->foundItem = false;
      $this->attributeGroupTag = '';
      $this->attributeNameTag = '';
      $this->attributeValueTags = array();
      $this->attributeQuantityTag = '';
      $this->attributePriceAdjustTag = '';
      $this->attributeWeightAdjustTag = '';
      $this->attributeRefTag = '';
      $this->attributeSupRefTag = '';
      $this->attributeEan13Tag = '';
      $this->attributeUpcTag = '';
      $this->attributeImage = '';
      $this->attributeEnabledTag = '';
    }

    $result = $this->ExecuteS('SELECT * FROM `'.
      _DB_PREFIX_.'importfast` WHERE `supplierId` = '.$supplierId.'
      AND `type` IN ("g", "y", "d")');
    $fieldMap = array();
    $setup = array(
      'itemSep' => '',
      'enclosure' => '"',
      'categoryTag' => 'CATEGORY',
      'htmlMode' => 0,
      'skipNoAlias' => 0,
      'skipFirstItem' => 0,
      'iso8859' => 0);
    foreach ((array)$result as $f) {
      if ($f['type'] == 'g')
	$setup[$f['ext_field']] = $f['int_primary'];
      else
	$fieldMap[$f['ext_field']] = array($f['int_primary'], $f['int_secondary'], $f['int_lang'], $f['int_feature']);
    }
    $this->itemSep = $setup['itemSep'];
    $this->enclosure = $setup['enclosure'];
    $this->itemTag = $setup['categoryTag'];
    $htmlMode = $this->htmlMode = $setup['htmlMode'];
    $skipNoAlias = $setup['skipNoAlias'];
    $skipFirstItem = $setup['skipFirstItem'];
    $iso8859 = $this->iso8859 = $setup['iso8859'];
    $allTags = array();
    $categoryEndTag = 0;
    if ($this->itemSep == "tab")
      $this->itemSep = "\t";

    $this->itemsParsed = 0;
    $endTag = '</'.$this->itemTag.'>';
    // Category: Detect tags for XML files and separator for CSV files
    if ($fileFormat == 'XML') {
      while (true) {
	// function displayCatSetup() collect tags
	$line = $this->stream_get_line($fp, 0x100000, NULL, $eof);
	if (strpos($line, $endTag) !== false)
	  $categoryEndTag = 1;
	if (preg_match_all('-<([\w]+)[^>]*>-', $line, $matches)) {
	  foreach ($matches[1] as $match)
	    $xmlTags[$match] = true;
	}
	if ($eof)
	  break;
      }
      if (empty($xmlTags)) {
	$this->_errors[] = $this->l('Not a valid XML file:').' '.Tools::getValue('catFileName');
	return false;
      }
      if (empty($xmlTags[$this->itemTag])) {
	$preferredTags = array('Category', 'Group');
	foreach ($preferredTags as $p) {
	  $lp = strtolower($p);
	  $up = strtoupper($p);
	  if (isset($xmlTags[$p])) {
	    $categoryEndTag = 1;
	    $this->itemTag = $p;
	  }
	  elseif (isset($xmlTags[$lp])) {
	    $categoryEndTag = 1;
	    $this->itemTag = $lp;
	  }
	  elseif (isset($xmlTags[$up])) {
	    $categoryEndTag = 1;
	    $this->itemTag = $up;
	  }
	}
      }
    }
    else {
      if ($this->iso8859) {
	stream_filter_register("utf8encode", "importfast_utf8encode_filter");
	stream_filter_prepend($fp, "utf8encode");
	$this->iso8859 = 2;
      }
      $itemSeps = array(";", ",", "\t", "|", "^", "~", "@", "#");
      $enclosures = array('"', '~');
      $fList = array();
      $line = fgets($fp, 4096);
      if ($line) {
	if ($this->itemSep == '') {
	  for ($i = 0; $i < strlen($line); $i++) {
	    $key = array_search($line[$i], $itemSeps);
	    if ($key !== false) {
	      $this->itemSep = $itemSeps[$key];
	      break;
	    }
	  }
	}
	for ($i = 0; $i < strlen($line); $i++) {
	  $key = array_search($line[$i], $enclosures);
	  if ($key !== false) {
	    $this->enclosure = $enclosures[$key];
	    break;
	  }
	}
      }
      if ($this->itemSep == '') {
	$this->_errors[] = $this->l('Not a valid CSV file:').' '.Tools::getValue('catFileName');
	return false;
      }
    }
    rewind($fp);
    $this->foundItem = false;
    unset($this->utf16);
    if ($categoryEndTag)
      $endTag = '</'.$this->itemTag.'>';
    else
      $endTag = '>';
    if (!defined('IMPF_CAT_SCAN_COUNT'))
      define('IMPF_CAT_SCAN_COUNT', 1000);
    while ($entryCount < IMPF_CAT_SCAN_COUNT) {
      if ($fileFormat == 'XML') {
	$this->xmlData = array();
	$this->xmlNames = array();
	$this->xmlNodes = array();
	// function displayCatSetup() read contents
	$line = $this->stream_get_line($fp, 0x100000, $endTag, $eof);
	if ($this->iso8859)
	  $line = utf8_encode($line);
	// $line = str_replace('"Windows-1250"', '"UTF-8"', $line); // Hack
	// $line = fgets($fp, 65536);
	if (!$line)
	  break;
	if (!xml_parse($parser, $line, $eof)) {
	  $this->_errors[] = $this->l('XML parsing failed at line').
	    sprintf(" %d: ", xml_get_current_line_number($parser)).
	    xml_error_string(xml_get_error_code($parser));
	    break;
	}
	if (!$this->foundItem)
	  continue;
	$this->foundItem = false;
	$entryCount++;
	if ($skipFirstItem && $this->itemsParsed == 0) {
	  $this->foundItem = false;
	  continue;
	}
	foreach ($this->xmlNames as $k => $v) {
	  if (empty($fList[$entryCount & 1][$k]) || trim($v) > $fList[$entryCount & 1][$k]) {
	    $fList[$entryCount & 1][$k] = trim($v);
	    if (empty($fList[0][$k]))
	      $fList[0][$k] = trim($v);
	  }
	}
	$this->itemsParsed++;
      }
      else {
	$fList[] = fgetcsv($fp, 0, $this->itemSep, $this->enclosure);
	if (!$fList)
	  break;
	if (function_exists('importfast_cat_csv')) {
	  $cnt = count($fList);
	  importfast_cat_csv($fList[$cnt - 1]);
	}
	$this->itemsParsed++;
	if ($entryCount++ > 2)
	  break;
      }
    }
    $fList[] = array();
    print '
      <script type="text/javascript">
function FieldSel(obj)
{
  if (obj.value == "feature" ||
    obj.value == "active" ||
    obj.value == "valid" ||
    obj.value == "moq" ||
    obj.value == "product_field" ||
    obj.value == "attribute_value" ||
    obj.value == "attribute_value_amp" ||
    obj.value.substr(0,3) == "url")
    obj.nextSibling.style.display="block";
  else
    obj.nextSibling.style.display="none";
  }
      </script>
	';
    if ($fileFormat == 'XML')
      $txt = $this->l('Setup mapping of fields in XML file');
    else
      $txt = $this->l('Setup mapping of fields in CSV file');
    print '
      <fieldset>
      <legend><img src="../img/t/AdminImportFast.gif" />'.$txt.'</legend>
      <form id="preview_import" action="'.self::$currentIndex.'&amp;token='.$this->token.'"
      style="display: inline; clear: both;" method="post" enctype="multipart/form-data">';
    if ($fileFormat == 'XML') {
      print '
	<label title="'.$this->l('The tag used to separate categories.').'">'.
	$this->l('Category tag').'</label>
	<div class="margin-form"><select name="categoryTag">';
      foreach (array_keys($xmlTags) as $tag) {
	if ($tag == $this->itemTag)
	  $selected = " selected='selected'";
	else
	  $selected = "";
	print '<option value="'.$tag.'"'.$selected.'>'.$tag.'</option>
	  ';
      }
      print '</select></div>';
    }
    else {
      print '
	<label title="'.$this->l('The character used to separate fields.').'">'.
	$this->l('Delimiter').'</label>
	<div class="margin-form"><select name="itemSep">';
      foreach ($itemSeps as $sep) {
	if ($sep == $this->itemSep)
	  $selected = " selected='selected'";
	else
	  $selected = "";
	if ($sep == "\t")
	  $sep = 'tab';
	print '<option value="'.$sep.'"'.$selected.'>'.$sep.'</option>
	  ';
      }
      print '</select></div>';
    }
    if ($skipNoAlias)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('Skip products with no category alias').'</label>
      <div class="margin-form">
      <input name="skipNoAlias" id="skipNoAlias" type="checkbox" '.$checked.' />
      </div>';
    print '<table class="table"><tr>';
    if ($htmlMode)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('Strings are HTML encoded').'</label>
      <div class="margin-form">
      <input name="htmlMode" id="htmlMode" type="checkbox" '.$checked.' />
      </div>';
    if ($iso8859)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('ISO-8859-1 encoded').'</label>
      <div class="margin-form">
      <input name="iso8859" id="iso8859" type="checkbox" '.$checked.' />
      </div>';
    if ($skipFirstItem)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('Skip first item').'</label>
      <div class="margin-form">
      <input name="skipFirstItem" id="skipFirstItem" type="checkbox" '.$checked.' />
      </div>';
    print '<table class="table"><tr>';
    if ($fileFormat == 'XML')
      print '<th>'.$this->l('XML field').'</th>';
    else
      print '<th>'.$this->l('CSV field').'</th>';
    print '<th>'.$this->l('Mapping').'</th>';
    print '<th>'.$this->l('Language').'</th>';
    print '<th>'.$this->l('Contents').'</th>';
    print '<th>'.$this->l('Contents').'</th></tr>
      ';
    ksort($fList[0]);
    $rowNo = 0;
    foreach ($fList[0] as $k => $v) {
      if (!isset($fieldMap[$k]))
	$fieldMap[$k] = array('N/A','N/A','N/A','');
      print '<tr>';
      list($ktag) = array_slice(explode('|', $k), -1);
      $indent = count(explode('|', $k)) - 1;
      $style = sprintf('padding-left: %dpt;', $indent * 5);
      print '<td style="'.$style.'" title="'.$k.'">'.$ktag.'</td>';
      print '<td>
	<input type="hidden" name="field0_'.$rowNo.'" value="'.$k.'" />
	<select name="field1_'.$rowNo.'">';
      foreach ($this->catFields as $pk => $pv) {
	if ($fieldMap[$k][0] == $pk)
	  $selected = " selected='selected'";
	else
	  $selected = "";
	print '<option value="'.$pk.'"'.$selected.'>'.$pv.'</option>
	  ';
      }
      print '</select>';
      print "</td>\n";

      print '<td><select name="field2_'.$rowNo.'">';
      $lang = array('active' => 1, 'id_lang' => 0, 'name' => $this->l('N/A'));
      $langs = array_merge(array($lang), Language::getLanguages());
      foreach ($langs as $lang) {
	if ($lang['active']) {
	  if ($fieldMap[$k][2] == $lang['id_lang'])
	    $selected = " selected='selected'";
	  else
	    $selected = "";
	  print '<option value="'.$lang['id_lang'].'"'.$selected.'>'.$lang['name'].'</option>
	    ';
	}
      }
      print "</select></td>\n";

      $fval = $this->mytrim($fList[0][$k]);
      print '<td>'.$fval.'</td>';
      if (empty($fList[1][$k]))
	$fList[1][$k] = '';
      $fval = $this->mytrim($fList[1][$k]);
      print '<td>'.$fval.'</td>';
      print '</tr>
	';
      $rowNo++;
    }
    // Get without path
    $catFileName = Tools::getValue('catFileName');
    print '</table>';

    print'
      <div class="space margin-form">
      <input type="hidden" name="supplierId" value="'.$supplierId.'" />
      <input type="hidden" name="catFileName" value="'.$catFileName.'" />
      <input type="hidden" name="fileFormat" value="'.$fileFormat.'" />
      <input type="hidden" name="importType" value="'.$importType.'" />
      <input type="hidden" name="enclosure" value="'.htmlspecialchars($this->enclosure).'" />
      <input type="hidden" name="categoryEndTag" value="'.$categoryEndTag.'" />
      <input type="submit" name="submitCatSave" value="'.$this->l('Save').'" class="button" />
      <input type="submit" name="submitCancel" value="'.$this->l('Cancel').'" class="button" />
      </div>
      </form>
      </fieldset>';
    return true;
  }

  public function displayProdSetup()
  {
    global $cookie;

    ini_set('auto_detect_line_endings',true);
    $supplierId = $cookie->supplierId = Tools::getValue('supplierId');
    $fileFormat = Tools::getValue('fileFormat');
    $importType = Tools::getValue('importType');
    $transFileName = $this->adminPath.Tools::getValue('transFileName');
    $prodFileName = $this->adminPath.Tools::getValue('prodFileName');
    if ($supplierId == 0) {
      $this->_errors[] = $this->l('You must select a supplier');
      return false;
    }
    $this->_status[] = "Opening $prodFileName";
    if ($fileFormat == 'XML')
      $this->fp = $fp = @fopen($prodFileName, "rb");
    else
      $this->fp = $fp = @fopen($prodFileName, "rt");
    if (!$fp) {
      $this->_errors[] = $this->l('Could not open').' '.$prodFileName.' '.
	$this->l('for reading');
      return false;
    }
    if ($fileFormat == 'XML') {
      $this->_status[] = $this->l('File is XML format');
    }
    else {
      $this->_status[] = $this->l('File is CSV format');
    }
    $entryCount = 0;

    if ($fileFormat == 'XML') {
      $parser = xml_parser_create();
      xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, false);
      xml_set_object($parser, $this);
      if (function_exists('importfast_prod_tagStart'))
	xml_set_element_handler($parser, 'prodTagStartCustomer', 'prodTagEndCustomer');
      elseif (function_exists('importfast_prod_tagEnd'))
	xml_set_element_handler($parser, 'tagStart', 'prodTagEndCustomer');
      else
	xml_set_element_handler($parser, 'tagStart', 'tagEnd');
      if (function_exists('importfast_prod_tagContent'))
	xml_set_character_data_handler($parser, 'prodTagContentCustomer');
      else
	xml_set_character_data_handler($parser, 'tagContent');
      $this->xmlTag = array();
      $this->xmlData = array();
      $this->xmlNames = array();
      $this->xmlNodes = array();
      $this->foundItem = false;
      $this->attributeGroupTag = '';
      $this->attributeNameTag = '';
      $this->attributeValueTags = array();
      $this->attributeQuantityTag = '';
      $this->attributePriceAdjustTag = '';
      $this->attributeWeightAdjustTag = '';
      $this->attributeRefTag = '';
      $this->attributeSupRefTag = '';
      $this->attributeEan13Tag = '';
      $this->attributeUpcTag = '';
      $this->attributeImage = '';
      $this->attributeEnabledTag = '';
    }

    if ($importType == 0) {
      $result = $this->ExecuteS('SELECT * FROM `'.
	_DB_PREFIX_.'importfast` WHERE `supplierId` = '.$supplierId.'
	AND `type` IN ("s", "x", "c")');
    }
    else {
      $result = $this->ExecuteS('SELECT * FROM `'.
	_DB_PREFIX_.'importfast` WHERE `supplierId` = '.$supplierId.'
	AND `type` IN ("s1", "x1", "c1")');
    }
    $fieldMap = array();
    $setup = array(
      'minQuantity' => 0,
      'pickingFee' => 0,
      'defaultQuantity' => 100,
      'defaultCategory' => 'Uncategorized',
      'priceRange1' => 10,
      'priceRange2' => 100,
      'priceRange3' => 1000,
      'priceRange4' => 10000,
      'priceProfit1' => 100,
      'priceProfit2' => 100,
      'priceProfit3' => 100,
      'priceProfit4' => 100,
      'maxExecution' => 25,
      'itemSep' => '',
      'enclosure' => '"',
      'productTag' => 'PRODUCT',
      'categorySep' => ',',
      'subCategorySep' => '|',
      'categoryPrefix' => '',
      'imageSep' => ',',
      'urlPrefix' => '',
      'supplierUrl' => '',
      'descRegExp1' => '',
      'descReplace1' => '',
      'descRegExp2' => '',
      'descReplace2' => '',
      'taxId' => 0,
      'impCurrency' => 0,
      'deleteOld' => 0,
      'disableProducts' => 0,
      'zeroProducts' => 0,
      'demandPicture' => 0,
      'useCopy' => 0,
      'onlyNew' => 0,
      'decimalComma' => -1,
      'featureColon' => 1,
      'keepBackslash' => 0,
      'categoryLeaf' => 0,
      'categoriesPersistent' => 0,
      'demandPrice' => 0,
      'demandWeight' => 0,
      'demandProduct' => 0,
      'demandCategory' => 0,
      'htmlMode' => 0,
      'skipFirstItem' => 0,
      'skipFirstLines' => 0,
      'iso8859' => 0);
    foreach ((array)$result as $f) {
      if ($f['type'][0] == 's')
	$setup[$f['ext_field']] = $f['int_primary'];
      else
	$fieldMap[$f['ext_field']] = array($f['int_primary'], $f['int_secondary'], $f['int_lang'], $f['int_feature']);
    }
    $minQuantity = $setup['minQuantity'];
    $pickingFee = $setup['pickingFee'];
    $defaultQuantity = $setup['defaultQuantity'];
    $defaultCategory = $setup['defaultCategory'];
    $priceRange1 = $setup['priceRange1'];
    $priceRange2 = $setup['priceRange2'];
    $priceRange3 = $setup['priceRange3'];
    $priceProfit1 = $setup['priceProfit1'];
    $priceProfit2 = $setup['priceProfit2'];
    $priceProfit3 = $setup['priceProfit3'];
    $priceProfit4 = $setup['priceProfit4'];
    $maxExecution = $setup['maxExecution'];
    $this->itemSep = $setup['itemSep'];
    $this->enclosure = $setup['enclosure'];
    $this->itemTag = $setup['productTag'];
    $categorySep = $setup['categorySep'];
    $subCategorySep = $setup['subCategorySep'];
    $categoryPrefix = $setup['categoryPrefix'];
    $imageSep = $setup['imageSep'];
    $urlPrefix = $setup['urlPrefix'];
    $supplierUrl = $setup['supplierUrl'];
    $descRegExp1 = $setup['descRegExp1'];
    $descReplace1 = $setup['descReplace1'];
    $descRegExp2 = $setup['descRegExp2'];
    $descReplace2 = $setup['descReplace2'];
    $taxId = $setup['taxId'];
    $impCurrency = $setup['impCurrency'];
    $deleteOld = $setup['deleteOld'];
    $disableProducts = $setup['disableProducts'];
    $zeroProducts = $setup['zeroProducts'];
    $demandPicture = $setup['demandPicture'];
    $useCopy = $setup['useCopy'];
    $onlyNew = $setup['onlyNew'];
    $decimalComma = $setup['decimalComma'];
    $featureColon = $setup['featureColon'];
    $keepBackslash = $setup['keepBackslash'];
    $categoryLeaf = $setup['categoryLeaf'];
    $categoriesPersistent = $setup['categoriesPersistent'];
    $demandPrice = $setup['demandPrice'];
    $demandWeight = $setup['demandWeight'];
    $demandProduct = $setup['demandProduct'];
    $demandCategory = $setup['demandCategory'];
    $htmlMode = $this->htmlMode = $setup['htmlMode'];
    $skipFirstItem = $setup['skipFirstItem'];
    $skipFirstLines = $setup['skipFirstLines'];
    $iso8859 = $this->iso8859 = $setup['iso8859'];
    $allTags = array();
    $productEndTag = 0;
    $xmlLocale = '';

    if ($this->itemSep == "tab")
      $this->itemSep = "\t";
    if ($decimalComma == -1) {
      $decimalComma = 0;
      // New or old configuration, convert '_' to '|'
      foreach ($fieldMap as $k => $v) {
	$k = str_replace('_', '|', $k);
	$fieldMap[$k] = $v;
      }
    }

    $this->itemsParsed = 0;
    $endTag = '</'.$this->itemTag.'>';
    // Product: Detect tags for XML files and separator for CSV files
    if ($fileFormat == 'XML') {
      while (true) {
	// function displayProdSetup() collect tags
	$line = $this->stream_get_line($fp, 0x100000, NULL, $eof);
	if (strpos($line, $endTag) !== false)
	  $productEndTag = 1;
	if (preg_match_all('/<([\w]+)[^>]*>/', $line, $matches)) {
	  foreach ($matches[1] as $match) {
	    $xmlTags[$match] = true;
	  }
	}
	if ($eof)
	  break;
      }
      if (empty($xmlTags)) {
	$this->_errors[] = $this->l('Not a valid XML file:').' '.Tools::getValue('prodFileName');
	return false;
      }
      if (empty($xmlTags[$this->itemTag])) {
	$preferredTags = array('Item', 'Product', 'ProductInfo', 'ShopItem', 'Article');
	foreach ($preferredTags as $p) {
	  $lp = strtolower($p);
	  $up = strtoupper($p);
	  if (isset($xmlTags[$p])) {
	    $productEndTag = 1;
	    $this->itemTag = $p;
	  }
	  elseif (isset($xmlTags[$lp])) {
	    $productEndTag = 1;
	    $this->itemTag = $lp;
	  }
	  elseif (isset($xmlTags[$up])) {
	    $productEndTag = 1;
	    $this->itemTag = $up;
	  }
	}
      }
    }
    else {
      if ($this->iso8859) {
	stream_filter_register("utf8encode", "importfast_utf8encode_filter");
	stream_filter_prepend($fp, "utf8encode");
	$this->iso8859 = 2;
      }
      if ($keepBackslash) {
	stream_filter_register("backslash", "importfast_backslash_filter");
	stream_filter_prepend($fp, "backslash");
      }
      $itemSeps = array(";", ",", "\t", "|", "^", "~", "@", "#");
      $enclosures = array('"', '~');
      $fList = array();
      $line = fgets($fp, 4096);
      if ($line) {
	if ($this->itemSep == '') {
	  for ($i = 0; $i < strlen($line); $i++) {
	    $key = array_search($line[$i], $itemSeps);
	    if ($key !== false) {
	      $this->itemSep = $itemSeps[$key];
	      break;
	    }
	  }
	}
	for ($i = 0; $i < strlen($line); $i++) {
	  $key = array_search($line[$i], $enclosures);
	  if ($key !== false) {
	    $this->enclosure = $enclosures[$key];
	    break;
	  }
	}
      }
      if ($this->itemSep == '') {
	$this->_errors[] = $this->l('Not a valid CSV file:').' '.Tools::getValue('prodFileName');
	return false;
      }
    }
    rewind($fp);
    unset($this->utf16);
    if ($skipFirstLines) {
      for ($i = 0; $i < $skipFirstLines; $i++)
	fgets($fp, 0x100000);
    }
    $this->foundItem = NULL;
    if ($productEndTag)
      $endTag = '</'.$this->itemTag.'>';
    else
      $endTag = '>';
    if (!defined('IMPF_PROD_SCAN_COUNT'))
      define('IMPF_PROD_SCAN_COUNT', 1000);
    while ($entryCount < IMPF_PROD_SCAN_COUNT) {
      if ($fileFormat == 'XML') {
	if ($this->foundItem === NULL) {
	  // New product entry
	  $this->xmlData = array();
	  $this->xmlNames = array();
	  $this->xmlNodes = array();
	  $this->foundItem = false;
	}
	// function displayProdSetup() read contents
	$line = $this->stream_get_line($fp, 0x100000, $endTag, $eof);
	if ($this->iso8859)
	  $line = utf8_encode($line);
	if (!$line)
	  break;
	if (!xml_parse($parser, $line, $eof)) {
	  $this->_errors[] = $this->l('XML parsing failed at line').
	    sprintf(" %d: ", xml_get_current_line_number($parser)).
	    xml_error_string(xml_get_error_code($parser));
	    break;
	}
	if (!$this->foundItem)
	  continue;
	$this->foundItem = NULL;
	$entryCount++;
	if ($skipFirstItem && $this->itemsParsed == 0)
	  continue;
	foreach ($this->xmlNames as $k => $v) {
	  if (empty($fList[$entryCount & 1][$k]) || trim($v) > $fList[$entryCount & 1][$k]) {
	    $fList[$entryCount & 1][$k] = trim($v);
	    if (empty($fList[0][$k]))
	      $fList[0][$k] = trim($v);
	  }
	}
	if (isset($this->xmlNames['nedisCatalogue|headerInfo|locale']))
	  $xmlLocale = $this->xmlNames['nedisCatalogue|headerInfo|locale'];
	$this->itemsParsed++;
      }
      else {
	$fList[] = fgetcsv($fp, 0, $this->itemSep, $this->enclosure);
	if (!$fList)
	  break;
	if (function_exists('importfast_prod_csv')) {
	  $cnt = count($fList);
	  importfast_prod_csv($fList[$cnt - 1], $this);
	}
	$this->itemsParsed++;
	if ($entryCount++ > 2)
	  break;
      }
    }
    $fList[] = array();
    print '
      <script type="text/javascript">
      function FieldSel(obj)
      {
	if (obj.value == "feature" ||
	  obj.value == "active" ||
	  obj.value == "valid" ||
	  obj.value == "moq" ||
	  obj.value == "product_field" ||
	  obj.value == "attribute_value" ||
	  obj.value == "attribute_value_amp" ||
	  obj.value == "supplier_ref_expr" ||
	  obj.value.substr(0,3) == "url")
	  obj.nextSibling.style.display="block";
	else
	  obj.nextSibling.style.display="none";
      }
      </script>
	';
    if ($fileFormat == 'XML')
      $txt = $this->l('Setup mapping of fields in XML file');
    else
      $txt = $this->l('Setup mapping of fields in CSV file');
    print '
      <fieldset>
      <legend><img src="../img/t/AdminImportFast.gif" />'.$txt.'</legend>
      <form id="preview_import" action="'.self::$currentIndex.'&amp;token='.$this->token.'"
      style="display: inline; clear: both;" method="post" enctype="multipart/form-data">';
    print '
      <label title="'.$this->l('Quantity must be at least this value. Otherwise the product is not imported.').'">'.
      $this->l('Quantity at least').'</label>
      <div class="margin-form">
      <input name="minQuantity" id="minQuantity" type="text" size="4" value="'.$minQuantity.'" />
      </div>';
    print '
      <label title="'.$this->l('A fee added to each product.').'">'.
      $this->l('Picking fee').'</label>
      <div class="margin-form">
      <input name="pickingFee" id="pickingFee" type="text" size="4" value="'.$pickingFee.'" />
      </div>';
    print '
      <label title="'.$this->l('The quantity used if not provided in the data file.').'">'.
      $this->l('Default quantity').'</label>
      <div class="margin-form">
      <input name="defaultQuantity" id="defaultQuantity" type="text" size="4" value="'.$defaultQuantity.'" />
      </div>';
    print '
      <label title="'.$this->l('Price ranges for the profit percentages listed below.').'">'.
      $this->l('Price range for profit percent').'</label>
      <div class="margin-form">
      0 -
      <input name="priceRange1" id="priceRange1" type="text" size="4" value="'.$priceRange1.'" />
      -
      <input name="priceRange2" id="priceRange2" type="text" size="4" value="'.$priceRange2.'" />
      -
      <input name="priceRange3" id="priceRange3" type="text" size="4" value="'.$priceRange3.'" />
      - &#8734;
      </div>
      <label title="'.$this->l('The price is calculated as the "Wholesale price" plus the desired profit expressed as a percentage of the difference between "Price" and "Wholesale price".').'">'.
      $this->l('Profit percent').'</label>
      <div class="margin-form">
      <input name="priceProfit1" id="priceProfit1" type="text" size="4" value="'.$priceProfit1.'" />
      &nbsp;
      <input name="priceProfit2" id="priceProfit2" type="text" size="4" value="'.$priceProfit2.'" />
      &nbsp;
      <input name="priceProfit3" id="priceProfit3" type="text" size="4" value="'.$priceProfit3.'" />
      &nbsp;
      <input name="priceProfit4" id="priceProfit4" type="text" size="4" value="'.$priceProfit4.'" />
      </div>';
    print '
      <label title="'.$this->l('Maximum execution time. If more time is spent you will have to resume the import.').'">'.
      $this->l('Max. execution time').'</label>
      <div class="margin-form">
      <input name="maxExecution" id="maxExecution" type="text" size="4" value="'.$maxExecution.'" />
      </div>';
    if ($fileFormat == 'XML') {
      print '
	<label title="'.$this->l('The tag used to separate products.').'">'.
	$this->l('Product tag').'</label>
	<div class="margin-form"><select name="productTag">';
      foreach (array_keys($xmlTags) as $tag) {
	if ($tag === $this->itemTag) {
	  $selected = " selected='selected'";
	}
	else
	  $selected = "";
	print '<option value="'.$tag.'"'.$selected.'>'.$tag.'</option>
	  ';
      }
      print '</select></div>';
    }
    else {
      print '
	<label title="'.$this->l('The character used to separate fields.').'">'.
	$this->l('Delimiter').'</label>
	<div class="margin-form"><select name="itemSep">';
      foreach ($itemSeps as $sep) {
	if ($sep == $this->itemSep)
	  $selected = " selected='selected'";
	else
	  $selected = "";
	if ($sep == "\t")
	  $sep = 'tab';
	print '<option value="'.$sep.'"'.$selected.'>'.$sep.'</option>
	  ';
      }
      print '</select></div>';
    }
    print '
      <label title="'.$this->l('If no category is specified this category is used.').'">'.
      $this->l('Default category').'</label>
      <div class="margin-form">
      <input name="defaultCategory" id="defaultCategory" type="text" value="'.$defaultCategory.'" />
      </div>';
    print '
      <label title="'.$this->l('Categories are typically separated by "," or "|".').'">'.
      $this->l('Category separator').'</label>
      <div class="margin-form">
      <input name="categorySep" id="categorySep" type="text" value="'.$categorySep.'" />
      </div>';
    print '
      <label title="'.$this->l('Sub-categories are typically separated by "," or "|".').'">'.
      $this->l('Sub-category separator').'</label>
      <div class="margin-form">
      <input name="subCategorySep" id="subCategorySep" type="text" value="'.$subCategorySep.'" />
      </div>';
    print '
      <label title="'.$this->l('Prefix the category name. Combined with the sub-category separator this allows you to move the entire category tree.').'">'.
      $this->l('Category prefix').'</label>
      <div class="margin-form">
      <input name="categoryPrefix" id="categoryPrefix" type="text" value="'.$categoryPrefix.'" />
      </div>';
    print '
      <label title="'.$this->l('Multiple images may be separated by "," or "|".').'">'.
      $this->l('Image separator').'</label>
      <div class="margin-form">
      <input name="imageSep" id="imageSep" type="text" value="'.$imageSep.'" />
      </div>';
    print '
      <label title="'.$this->l('This prefix is prepended to the URL. The prefix could be something like: "http://wholeseller.host/images" or').
      ' &quot;'._PS_ROOT_DIR_.'/images&quot;.">'.
      $this->l('URL prefix').'</label>
      <div class="margin-form">
      <input name="urlPrefix" id="urlPrefix" type="text" size="80" value="'.$urlPrefix.'" />
      </div>';
    print '
      <label title="'.$this->l('A regular expression that can be used for short and long descriptions.').'">'.
      $this->l('Description replace expression 1').'</label>
      <div class="margin-form">
      <input name="descRegExp1" id="descRegExp1" type="text" size="45" value="'.htmlspecialchars($descRegExp1, ENT_QUOTES).'" />
      <input name="descReplace1" id="descReplace1" type="text" size="30" value="'.htmlspecialchars($descReplace1, ENT_QUOTES).'" />
      </div>';
    print '
      <label title="'.$this->l('A regular expression that can be used for short and long descriptions.').'">'.
      $this->l('Description replace expression 2').'</label>
      <div class="margin-form">
      <input name="descRegExp2" id="descRegExp2" type="text" size="45" value="'.htmlspecialchars($descRegExp2, ENT_QUOTES).'" />
      <input name="descReplace2" id="descReplace2" type="text" size="30" value="'.htmlspecialchars($descReplace2, ENT_QUOTES).'" />
      </div>';
    $this->defLang = $defLang = intval(Configuration::get('PS_LANG_DEFAULT'));
    $taxes = array(0 => $this->l('N/A'));
    if ($this->v14) {
      $rows = TaxRulesGroup::getTaxRulesGroups();
      foreach ($rows as $row)
	$taxes[$row['id_tax_rules_group']] = $row['name'];
    }
    else {
      $rows = Tax::getTaxes($defLang);
      foreach ($rows as $row)
	$taxes[$row['id_tax']] = $row['name'];
    }
    print '
      <label title="'.$this->l('Tax used if not specified in file.').'">'.
      $this->l('Default tax').'</label>';
    print '
      <div class="margin-form">
      <select name="taxId">';
    foreach ($taxes as $k => $tax) {
      if ($k == $taxId)
	$selected = " selected='selected'";
      else
	$selected = "";
      print '<option value="'.$k.'"'.$selected.'>'.$tax.'</option>
	';
    }
    print '</select></div>';
    print '
      <label title="'.$this->l('Currency imported. Prices are adjusted to the default currency.').'">'.
      $this->l('Currency').'</label>';
    print '
      <div class="margin-form">
      <select name="impCurrency">';
    foreach (Currency::getCurrencies(false, 0) as $row) {
      if ($row['iso_code'] == $impCurrency)
	$selected = " selected='selected'";
      else
	$selected = "";
      print '<option value="'.$row['iso_code'].'"'.$selected.'>'.$row['iso_code'].'</option>
	';
    }
    print '</select></div>';
    print '
      <label>'.$this->l('Delete products deactivated for more days than').'</label>
      <div class="margin-form">
      <input name="deleteOld" id="deleteOld" type="text" size="3" value="'.$deleteOld.'" />
      '.$this->l('zero means keep').'
      </div>';
    if ($disableProducts)
      $checked = "checked";
    else
      $checked = "";
    print '<br />
      <label>'.$this->l('Deactivate no-longer existing products').'</label>
      <div class="margin-form">
      <input name="disableProducts" id="disableProducts" type="checkbox" '.$checked.' />
      </div>';
    if ($demandPrice)
      $checked = "checked";
    else
      $checked = "";
    print '<br />
      <label>'.$this->l('Deactivate free products').'</label>
      <div class="margin-form">
      <input name="demandPrice" id="demandPrice" type="checkbox" '.$checked.' />
      </div>';
    if ($demandWeight)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('Deactivate zero weight products').'</label>
      <div class="margin-form">
      <input name="demandWeight" id="demandWeight" type="checkbox" '.$checked.' />
      </div>';
    if ($demandProduct)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('Deactivate categories with no active products').'</label>
      <div class="margin-form">
      <input name="demandProduct" id="demandProduct" type="checkbox" '.$checked.' />
      </div>';
    if ($demandCategory)
      $checked = "checked";
    else
      $checked = "";
    print '<br />
      <label>'.$this->l('Deactivate products in deactivated categories').'</label>
      <div class="margin-form">
      <input name="demandCategory" id="demandCategory" type="checkbox" '.$checked.' />
      </div>';
    if ($zeroProducts)
      $checked = "checked";
    else
      $checked = "";
    print '<br>
      <label>'.$this->l('Set quantity to zero for no-longer existing products').'</label>
      <div class="margin-form">
      <input name="zeroProducts" id="zeroProducts" type="checkbox" '.$checked.' />
      </div>';
    if ($demandPicture)
      $checked = "checked";
    else
      $checked = "";
    print '<br />
      <label>'.$this->l('Ignore products with no picture').'</label>
      <div class="margin-form">
      <input name="demandPicture" id="demandPicture" type="checkbox" '.$checked.' />
      </div>';
    if ($useCopy)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('Use copy() instead of cURL to get images').'</label>
      <div class="margin-form">
      <input name="useCopy" id="useCopy" type="checkbox" '.$checked.' />
      </div>';
    if ($onlyNew)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('Only import new products').'</label>
      <div class="margin-form">
      <input name="onlyNew" id="onlyNew" type="checkbox" '.$checked.' />
      </div>';
    if ($decimalComma)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('Comma as decimal separator').'</label>
      <div class="margin-form">
      <input name="decimalComma" id="decimalComma" type="checkbox" '.$checked.' />
      </div>';
    if ($featureColon)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('Append colon to feature names').'</label>
      <div class="margin-form">
      <input name="featureColon" id="featureColon" type="checkbox" '.$checked.' />
      </div>';
    if ($fileFormat == 'CSV') {
      if ($keepBackslash)
	$checked = "checked";
      else
	$checked = "";
      print '
	<label>'.$this->l('Preserve backslashes').'</label>
	<div class="margin-form">
	<input name="keepBackslash" id="keepBackslash" type="checkbox" '.$checked.' />
	</div>';
    }
    if ($categoryLeaf)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('Products in category leaves').'</label>
      <div class="margin-form">
      <input name="categoryLeaf" id="categoryLeaf" type="checkbox" '.$checked.' />
      </div>';
    if ($categoriesPersistent)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('Products remain in categories').'</label>
      <div class="margin-form">
      <input name="categoriesPersistent" id="categoriesPersistent" type="checkbox" '.$checked.' />
      </div>';
    if ($htmlMode)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('Strings are HTML encoded').'</label>
      <div class="margin-form">
      <input name="htmlMode" id="htmlMode" type="checkbox" '.$checked.' />
      </div>';
    if ($iso8859)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('ISO-8859-1 encoded').'</label>
      <div class="margin-form">
      <input name="iso8859" id="iso8859" type="checkbox" '.$checked.' />
      </div>';
    if ($skipFirstItem)
      $checked = "checked";
    else
      $checked = "";
    print '
      <label>'.$this->l('Skip first item').'</label>
      <div class="margin-form">
      <input name="skipFirstItem" id="skipFirstItem" type="checkbox" '.$checked.' />
      </div>';
    if (defined('IMPF_SKIP_LINES')) {
      print '
	<label title="'.$this->l('Number of lines to skip.').'">'.
	$this->l('Skip first lines').'</label>
	<div class="margin-form">
	<input name="skipFirstLines" id="skipFirstLines" type="text" value="'.$skipFirstLines.'" />
	</div>';
    }
    print '<table class="table"><tr>';
    if ($fileFormat == 'XML')
      print '<th>'.$this->l('XML field').'</th>';
    else
      print '<th>'.$this->l('CSV field').'</th>';
    print '<th>'.$this->l('Primary').'</th>';
    print '<th>'.$this->l('Secondary').'</th>';
    print '<th>'.$this->l('Language').'</th>';
    print '<th>'.$this->l('Contents').'</th>';
    print '<th>'.$this->l('Contents').'</th></tr>
      ';
    ksort($fList[0]);
    $rowNo = 0;
    foreach ($fList[0] as $k => $v) {
      if (!isset($fieldMap[$k]))
	$fieldMap[$k] = array('N/A','N/A','N/A','');
      print '<tr>';
      list($ktag) = array_slice(explode('|', $k), -1);
      $indent = count(explode('|', $k)) - 1;
      $style = sprintf('padding-left: %dpt;', $indent * 5);
      print '<td style="'.$style.'" title="'.$k.'">'.$ktag.'</td>';
      print '<td>
	<input type="hidden" name="field0_'.$rowNo.'" value="'.$k.'" />
	<select name="field1_'.$rowNo.'" onchange=FieldSel(this)>';
      foreach ($this->psFields1 as $pk => $pv) {
	if ($pk[0] == '_')
	  continue;
	if ($fieldMap[$k][0] == $pk)
	  $selected = " selected='selected'";
	else
	  $selected = "";
	print '<option value="'.$pk.'"'.$selected.'>'.$pv.'</option>
	  ';
      }
      print '</select>';
      if ($fieldMap[$k][0] == 'feature' ||
	$fieldMap[$k][0] == 'active' ||
	$fieldMap[$k][0] == 'valid' ||
	$fieldMap[$k][0] == 'moq' ||
	$fieldMap[$k][0] == 'product_field' ||
	$fieldMap[$k][0] == 'attribute_value' ||
	$fieldMap[$k][0] == 'attribute_value_amp' ||
	$fieldMap[$k][0] == 'supplier_ref_expr' ||
	substr($fieldMap[$k][0], 0, 3) == 'url')
	$style = 'style="display:block;"';
      else
	$style = 'style="display:none;"';
      print '<input name="field2_'.$rowNo.'" type="text" size="18" value="'.$fieldMap[$k][3].'" '.$style.' />';
      print "</td>\n";

      print '<td><select name="field3_'.$rowNo.'">';
      foreach ($this->psFields2 as $pk => $pv) {
	if ($xmlLocale == '' && $pk == 'price_add') // Only for Nedis
	  continue;
	if ($importType == 0 && $pk == 'attribute_supplier ref 2nd')
	  continue;
	if ($fieldMap[$k][1] == $pk)
	  $selected = " selected='selected'";
	else
	  $selected = "";
	print '<option value="'.$pk.'"'.$selected.'>'.$pv.'</option>
	  ';
      }
      print "</select></td>\n";

      print '<td><select name="field4_'.$rowNo.'">';
      $lang = array('active' => 1, 'id_lang' => 0, 'name' => $this->l('N/A'));
      $langs = array_merge(array($lang), Language::getLanguages());
      foreach ($langs as $lang) {
	if ($lang['active']) {
	  if ($fieldMap[$k][2] == $lang['id_lang'])
	    $selected = " selected='selected'";
	  else
	    $selected = "";
	  print '<option value="'.$lang['id_lang'].'"'.$selected.'>'.$lang['name'].'</option>
	    ';
	}
      }
      print "</select></td>\n";

      $fval = $this->mytrim($fList[0][$k]);
      // $fval = preg_replace('/<table .*/s', ' ', $fval);
      // $fval = preg_replace('/<[^>]*>/s', ' ', $fval);
      print '<td>'.htmlspecialchars($fval).'</td>';
      if (empty($fList[1][$k]))
	$fList[1][$k] = '';
      $fval = $this->mytrim($fList[1][$k]);
      // $fval = preg_replace('/<table .*/s', ' ', $fval);
      // $fval = preg_replace('/<[^>]*>/s', ' ', $fval);
      print '<td>'.htmlspecialchars($fval).'</td>';
      print '</tr>
	';
      $rowNo++;
    }
    // Get without path
    $catFileName = Tools::getValue('catFileName');
    $prodFileName = Tools::getValue('prodFileName');
    $transFileName = Tools::getValue('transFileName');
    print '</table>';

    print '<br /><br /><table class="table">';
    printf('<tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th></tr>', 'HTML meta tags', 'Description', 'Keywords', 'Title');
    foreach ($this->metaFields as $k => $v) {
      printf('<tr><th>%s</th>', $k);
      foreach ($this->metaTypes as $t) {
	$name = $t.'-'.$v;
	if (isset($setup[$name]))
	  $checked = "checked";
	else
	  $checked = "";
	if (substr($v, 0, 4) == 'desc') {
	  if (empty($setup[$name]))
	    $setup[$name] = 0;
	  printf('<td align="center"><input name="%s" id="%s" type="text" size="2" value="%d" /></td>', $name, $name, $setup[$name]);
	}
	else
	  printf('<td align="center"><input name="%s" id="%s" %s type="checkbox" /></td>', $name, $name, $checked);
      }
      print '</tr>
	';
    }
    print '</table>';

    $importToken = md5('importfast'._COOKIE_KEY_);

    $importUrl = $this->getModuleUrl().'importfast_cron.php';
    $importUrl .= '?token='.$importToken;
    $importUrl .= '&amp;supplierId='.$supplierId;
    $importUrl .= '&amp;adminPath='.$this->adminPath;
    $importUrl .= '&amp;importType='.$importType;
    if ($this->v15) {
      switch (Shop::getContext()) {
	case Shop::CONTEXT_SHOP:
	  $importUrl .= '&amp;shop='.Shop::getContextShopID();
	  break;
	case Shop::CONTEXT_GROUP:
	  $importUrl .= '&amp;group='.Shop::getContextShopGroupID();
	  break;
	case Shop::CONTEXT_ALL:
	  $importUrl .= '&amp;all=1';
	  break;
      }
    }
    if ($importType)
      $importUrl .= '&amp;importType='.$importType;
    print '
      <br />
      <label title="'.$this->l('Specify the URL you use to get an updated version of your CSV/XML file').'">'.
      $this->l('URL for updated').' '.$fileFormat.' '.$this->l('file from supplier').'</label>
      <div class="margin-form">
      <input name="supplierUrl" id="supplierUrl" type="text" size="80" value="'.$supplierUrl.'" />
      </div>
      <label style="font-weight:normal"><u><a href="'.$importUrl.'" target="_blank">'.$this->l('Import link for cron job.').'</a></u></label>
      <br />';

    print'
      <div class="space margin-form">
      <input type="hidden" name="supplierId" value="'.$supplierId.'" />
      <input type="hidden" name="catFileName" value="'.$catFileName.'" />
      <input type="hidden" name="prodFileName" value="'.$prodFileName.'" />
      <input type="hidden" name="transFileName" value="'.$transFileName.'" />
      <input type="hidden" name="fileFormat" value="'.$fileFormat.'" />
      <input type="hidden" name="importType" value="'.$importType.'" />
      <input type="hidden" name="enclosure" value="'.htmlspecialchars($this->enclosure).'" />
      <input type="hidden" name="productEndTag" value="'.$productEndTag.'" />
      <input type="hidden" name="xmlLocale" value="'.$xmlLocale.'" />
      <input type="submit" name="submitProdSave" value="'.$this->l('Save').'" class="button" />
      <input type="submit" name="submitCancel" value="'.$this->l('Cancel').'" class="button" />
      </div>
      </form>
      </fieldset>';
    return true;
  }

  public function displayForm()
  {
    global $cookie;

    $description =
      $this->ExecuteS('DESCRIBE `'._DB_PREFIX_.'importfast`');
    foreach ($description as $k => $v) {
      if ($v['Field'] == 'type' && $v['Type'] == 'char(1)') {
	$this->Execute('ALTER TABLE `'._DB_PREFIX_.'importfast` '.
	    'MODIFY `type` char(2)');
	$this->_status[] = $this->l('Updated importfast table structure');
      }
    }
    $supplierId = Tools::getValue('supplierId');
    if (!$supplierId && isset($cookie->supplierId))
      $supplierId = $cookie->supplierId;
    $defLang = intval(Configuration::get('PS_LANG_DEFAULT'));
    $rows = $this->ExecuteS('SELECT * FROM `'._DB_PREFIX_.'importfast`');
    $uploadFile = Tools::getValue('uploadFile');
    if (empty($uploadFile)) {
      $fileFormat = Tools::getValue('fileFormat');
      $importType = Tools::getValue('importType');
      $catFileName = Tools::getValue('catFileName');
      $prodFileName = Tools::getValue('prodFileName');
      $transFileName = Tools::getValue('transFileName');
    }
    else {
      $importType = 0;
    }
    $impfDebug = Tools::getValue('impfDebug');
    foreach((array)$rows as $row) {
      if (($row['type'] == 's' || $row['type'] == 'g') && $row['supplierId'] == $supplierId) {
	if ($row['ext_field'] == 'fileFormat' && empty($fileFormat))
	  $fileFormat = $row['int_primary'];
	elseif ($row['ext_field'] == 'transFileName' && empty($transFileName))
	  $transFileName = $row['int_primary'];
	elseif ($row['ext_field'] == 'catFileName' && empty($catFileName))
	  $catFileName = $row['int_primary'];
	elseif ($row['ext_field'] == 'prodFileName' && empty($prodFileName))
	  $prodFileName = $row['int_primary'];
      }
    }
    print '
      <fieldset>
      <legend><img src="../img/t/AdminImportFast.gif" />'.$this->l('Import CSV or XML file').'</legend>';
    if (isset($this->_status)) {
      foreach ($this->_status as $status) {
	printf("<p>%s</p>\n", $status);
      }
      print "<hr />";
    }
    print '
      <script type="text/javascript">
      function ShowList(elem)
      {
	$(elem).next().toggle();
      }
    </script>';
    if (!empty($this->duplicateList)) {
      print '<h3 onClick="ShowList(this)">'.$this->l('Some entries duplicated (click to view)').'</h3>';
      print '<div style="display:none">';
      print implode('<br />', $this->duplicateList);
      print "</div><hr />";
    }
    if (!empty($this->notfoundList)) {
      print '<h3 onClick="ShowList(this)">'.$this->l('Some entries not found (click to view)').'</h3>';
      print '<div style="display:none">';
      print implode('<br />', $this->notfoundList);
      print "</div><hr />";
    }
    print '
      <form id="preview_import" action="'.self::$currentIndex.'&amp;token='.$this->token.'" style="display: inline; clear: both;" method="post" enctype="multipart/form-data">
      <div class="form">
      '.$this->l('Import products and categories fast. The mapping of the fields from the XML or CSV file must be setup before importing.').'
      </div>
      <label style="font-weight:normal"><u><a href="'.$this->getModuleUrl().'ImportFast.pdf" target="_blank">'.$this->l('Get manual in PDF format.').'</a></u></label>
      <br /><br />';
    print '
      <script type="text/javascript">
      function SupplierSel(obj)
      {
	fileFormat = new Array();
	transFileName = new Array();
	catFileName = new Array();
	prodFileName = new Array();';
	foreach($rows as $row) {
	  if ($row['type'] == 's' || $row['type'] == 'g') {
	    if ($row['ext_field'] == 'fileFormat')
	      printf("
		  fileFormat[%d] = '%s';", $row['supplierId'],
		  addslashes($row['int_primary']));
	    elseif ($row['ext_field'] == 'transFileName')
	      printf("
		  transFileName[%d] = '%s';", $row['supplierId'],
		  addslashes($row['int_primary']));
	    elseif ($row['ext_field'] == 'catFileName')
	      printf("
		  catFileName[%d] = '%s';", $row['supplierId'],
		  addslashes($row['int_primary']));
	    elseif ($row['ext_field'] == 'prodFileName')
	      printf("
		  prodFileName[%d] = '%s';", $row['supplierId'],
		  addslashes($row['int_primary']));
	  }
	}
	print '
	  obj.form.catFileName.value = "None";
	obj.form.fileFormat.value = fileFormat[obj.value];
	obj.form.importType.value = 0;
	obj.form.transFileName.value = transFileName[obj.value];
	obj.form.catFileName.value = catFileName[obj.value];
	obj.form.prodFileName.value = prodFileName[obj.value];
    }

  function ImportTypeSel(obj)
  {
    prodFileName0 = new Array();
    prodFileName1 = new Array();
    fileFormat0 = new Array();
    fileFormat1 = new Array();';
    foreach($rows as $row) {
      if ($row['type'] == 's') {
	if ($row['ext_field'] == 'prodFileName')
	  printf("
	      prodFileName0[%d] = '%s';", $row['supplierId'],
	      addslashes($row['int_primary']));
	if ($row['ext_field'] == 'fileFormat')
	  printf("
	      fileFormat0[%d] = '%s';", $row['supplierId'], $row['int_primary']);
      }
      if ($row['type'] == 's1') {
	if ($row['ext_field'] == 'prodFileName')
	  printf("
	      prodFileName1[%d] = '%s';", $row['supplierId'],
	      addslashes($row['int_primary']));
	if ($row['ext_field'] == 'fileFormat')
	  printf("
	      fileFormat1[%d] = '%s';", $row['supplierId'], $row['int_primary']);
      }
    }
    print '
      supplierId = $("#supplierId").val();
    if (obj.value == 0) {
      $("#prodFileName").val(prodFileName0[supplierId]);
      $("#fileFormat").val(fileFormat0[supplierId]);
    }
    else {
      $("#prodFileName").val(prodFileName1[supplierId]);
      $("#fileFormat").val(fileFormat1[supplierId]);
    }
  }
  </script>';
  if ($impfDebug)
    $ordering = 'ORDER BY `id_supplier`';
  else
    $ordering = 'ORDER BY `name`';
  if ($this->v14)
    $rows = $this->ExecuteS('SELECT `id_supplier`, `name`
	FROM `'._DB_PREFIX_.'supplier`
	LEFT JOIN `'._DB_PREFIX_.'supplier_lang` USING (`id_supplier`)
	WHERE `id_lang` = '.$defLang.' AND `active` = 1 '.$ordering);
  else
    $rows = $this->ExecuteS('SELECT `id_supplier`, `name`
	FROM `'._DB_PREFIX_.'supplier`
	LEFT JOIN `'._DB_PREFIX_.'supplier_lang` USING (`id_supplier`)
	WHERE `id_lang` = '.$defLang.' '.$ordering);
  $suppliers = array(0 => $this->l('N/A'));
  foreach ($rows as $row) {
    if ($impfDebug)
      $suppliers[$row['id_supplier']] = $row['id_supplier'].' '.$row['name'];
    else
      $suppliers[$row['id_supplier']] = $row['name'];
  }
  print '
    <label class="clear">'.$this->l('Supplier').'</label>';
  print '
    <div class="margin-form">
    <select id="supplierId" name="supplierId" onchange=SupplierSel(this)>';
  foreach ($suppliers as $k => $supplier) {
    if ($k == $supplierId)
      $selected = " selected='selected'";
    else
      $selected = "";
    print '<option value="'.$k.'"'.$selected.'>'.$supplier.'</option>
      ';
  }
  print '</select></div>';
  $options = array('CSV', 'XML');
  print '
    <label class="clear">'.$this->l('File format').'</label>
    <div class="margin-form">
    <select name="fileFormat" id="fileFormat">';
  foreach ($options as $option) {
    if ($option == $fileFormat)
      $selected = " selected='selected'";
    else
      $selected = "";
    print '<option value="'.$option.'"'.$selected.'>'.$option.'</option>
      ';
  }
  if (defined('IMPF_HIDE_UPLOAD'))
    $hidden = 'style="display:none;"';
  else
    $hidden = '';
  print '</select>
    <input '.$hidden.' type="submit" name="submitLoadProd" value="'.$this->l('Upload').'" class="button" />
    </div>';
  $options = array($this->l('Product'), $this->l('Price/qty update'));
  print '
    <label class="clear">'.$this->l('Import type').'</label>
    <div class="margin-form">
    <select name="importType" onchange=ImportTypeSel(this)>';
  foreach ($options as $key => $option) {
    if ($key == $importType)
      $selected = " selected='selected'";
    else
      $selected = "";
    print '<option value="'.$key.'"'.$selected.'>'.$option.'</option>
      ';
  }
  print '</select></div>';
  $transFiles = array();
  foreach (scandir($this->adminPath) as $transFile) {
    if (strpos($transFile, "translations") !== false) {
      $transFiles[] = $transFile;
    }
  }
  if ($transFiles)
    $hidden = '';
  else
    $hidden = 'style="display:none;"';
  print '
    <label class="clear" '.$hidden.'>'.$this->l('Select your XML translation file:').' </label>
    <div class="margin-form" '.$hidden.'>
    <select name="transFileName">';
  array_unshift($transFiles, $this->l('N/A'));
  foreach ($transFiles as $fileName) {
    if ($fileName == $transFileName)
      $selected = " selected='selected'";
    else
      $selected = "";
    print '<option value="'.$fileName.'"'.$selected.'>'.$fileName.'</option>
      ';
  }
  print '</select>
    </div>';
  print '
    <label class="clear">'.$this->l('Select your categories file').' </label>
    <div class="margin-form">
    <select name="catFileName">';

  $catFiles = array();
  foreach (scandir($this->adminPath) as $catFile) {
    if (strpos($catFile, "translations") === false &&
	(strpos(strtolower($catFile), ".xml") !== false ||
	 strpos(strtolower($catFile), ".csv") !== false ||
	 strpos(strtolower($catFile), ".txt") !== false ||
	 strpos(strtolower($catFile), ".tab") !== false))
    {
      $catFiles[] = $catFile;
    }
  }
  array_unshift($catFiles, $this->l('N/A'));
  $first = true;
  foreach ($catFiles as $fileName) {
    if ($fileName == $catFileName)
      $selected = " selected='selected'";
    else
      $selected = "";
    if ($first)
      print '<option value="None"'.$selected.'>'.$fileName.'</option>'."\n";
    else
      print '<option value="'.$fileName.'"'.$selected.'>'.$fileName.'</option>'."\n";
    $first = false;
  }
  print '</select>
    <input type="submit" name="submitCatSetup" value="'.$this->l('Setup').'" class="button" />
    </div>';
  print '
    <label class="clear" onClick="ProdSelFile()">'.$this->l('Select your products file').' </label>
    <div class="margin-form">
    <select id="prodFileName" name="prodFileName">';
  foreach (scandir($this->adminPath) as $fileName) {
    if (strpos($fileName, "translations") === false &&
	(strpos(strtolower($fileName), ".xml") !== false ||
	 strpos(strtolower($fileName), ".csv") !== false ||
	 strpos(strtolower($fileName), ".txt") !== false ||
	 strpos(strtolower($fileName), ".tab") !== false))
    {
      if ($fileName == $prodFileName)
	$selected = " selected='selected'";
      else
	$selected = "";
      print '<option value="'.$fileName.'"'.$selected.'>'.$fileName.'</option>
	';
    }
  }
  print '</select>
    <input type="submit" name="submitProdSetup" value="'.$this->l('Setup').'" class="button" />
    </div>';
  print '
    <label class="clear">'.$this->l('All images from supplier on disk').' </label>
    <div class="margin-form">
    <input type="submit" name="submitDelImages" value="'.$this->l('Delete').'" class="button" />
    </div>';
  print '
    <label class="clear">'.$this->l('Rhino images on disk (no image)').' </label>
    <div class="margin-form">
    <input type="submit" name="submitDelRhino" value="'.$this->l('Delete').'" class="button" />
    </div>';
  print '
    <label class="clear">'.$this->l('All products from supplier').' </label>
    <div class="margin-form">
    <input type="submit" name="submitDelProducts" value="'.$this->l('Delete').'" class="button" />
    </div>';
  print '
    <label class="clear">'.$this->l('All deactivated products from supplier').' </label>
    <div class="margin-form">
    <input type="submit" name="submitDelOldProducts" value="'.$this->l('Delete').'" class="button" />
    </div>';
  print '
    <label class="clear">'.$this->l('All empty categories').' </label>
    <div class="margin-form">
    <input type="submit" name="submitDelCategories" value="'.$this->l('Delete').'" class="button" />
    </div>';
  if ($this->v15 &&
    Shop::isFeatureActive() &&
    Shop::getContext() != Shop::CONTEXT_ALL)
    $disabled = 'disabled="disabled"';
  else
    $disabled = '';
  print '
    <label class="clear">'.$this->l('All products, categories and images').' </label>
    <div class="margin-form">
    <input type="submit" '.$disabled.' name="submitNukeConfirm" value="'.$this->l('Nuke').'" class="button" />
    </div>';
    print '
      <script type="text/javascript">
      function ProdSelFile()
      {
	supplierId = $("#supplierId").val();
	exportUrl = "'.$this->getModuleUrl().'exportconfig.php?supplierId=" +
	  supplierId + "&token='.sha1(_COOKIE_KEY_.'importfast').'&file=" +
	  "'.urlencode($this->adminPath).'" + $("#prodFileName").val();
	window.location = exportUrl;
      }
      function DoSave()
      {
	supplierId = $("#supplierId").val();
	exportUrl = "'.$this->getModuleUrl().'exportconfig.php?supplierId=" +
	  supplierId + "&token='.sha1(_COOKIE_KEY_.'importfast').'";
	if (supplierId == 0) {
	  $("#noSupplier").val(1);
	  $("form").submit();
	}
	else
	  window.location = exportUrl;
      }
      </script>';
    print '
      <label class="clear">'.$this->l('Configuration').' </label>
      <div class="margin-form">
      <input type="button" name="submitSaveConfig" value="'.$this->l('Save').'" class="button"
      onClick="DoSave()" />
      <input type="submit" name="submitLoadConfig" value="'.$this->l('Load').'" class="button" />
      <input type="hidden" id="noSupplier" name="noSupplier" value="0" />
      </div>';
    print '
      <label style="font-weight:normal"><u><a href="'.$this->getModuleUrl().'imagecron.php" target="_blank">'.$this->l('Download missing images').'</a></u></label>';
    print '<div class="space margin-form">';
    // print '<input type="hidden" name="XDEBUG_PROFILE" value="1" />';
    if (isset($this->runAgain)) {
      foreach ($this->counters as $k =>$v) {
	print '
	  <input type="hidden" name="'.$k.'" value="'.$v.'" />';
      }
      print '
	<input type="submit" name="submitResume" value="'.$this->l('Resume').'" class="button" />';
    }
    print '
      <input type="submit" name="submitImport" value="'.$this->l('Import').'" class="button" />
      </div>
      </form>
      </fieldset>';
  }

  public function saveCatSetup()
  {
    $fileFormat = Tools::getValue('fileFormat');
    $itemSep = Tools::getValue('itemSep');
    $enclosure = htmlspecialchars_decode(Tools::getValue('enclosure'));
    $supplierId = Tools::getValue('supplierId');
    $htmlMode = Tools::getValue('htmlMode');
    $skipNoAlias = Tools::getValue('skipNoAlias');
    $skipFirstItem = Tools::getValue('skipFirstItem');
    $iso8859 = Tools::getValue('iso8859');
    $categoryTag = Tools::getValue('categoryTag');
    $categoryEndTag = Tools::getValue('categoryEndTag');
    $catFileName = Tools::getValue('catFileName');
    $transFileName = Tools::getValue('transFileName');
    if ($fileFormat == 'XML')
      $type = "y";
    else
      $type = "d";
    $this->Execute('DELETE FROM `'._DB_PREFIX_.'importfast`
      WHERE `supplierId` = '.$supplierId.'
      AND `type` IN ("g", "y", "d")');
    $vars = array(
	'itemSep' => $itemSep,
	'enclosure' => $enclosure,
	'categoryTag' => $categoryTag,
	'categoryEndTag' => $categoryEndTag,
	'htmlMode' => $htmlMode,
	'skipNoAlias' => $skipNoAlias,
	'skipFirstItem' => $skipFirstItem,
	'iso8859' => $iso8859,
	'catFileName' => pSQL($catFileName));
    foreach ($vars as $k => $v) {
      $vals[] = sprintf("('%d', '%s', '%s', '%s', '', '', '')",
	  $supplierId, 'g', $k, $v);
    }
    $feature = '';
    $secondary = '';
    foreach ($_POST as $k => $v) {
      if (substr($k, 0, 7) == "field0_") {
	$key = $v;
      }
      elseif (substr($k, 0, 7) == "field1_") {
	$primary = $v;
      }
      elseif (substr($k, 0, 7) == "field2_") {
	$lang = $v;
	$vals[] = sprintf("('%d', '%s', '%s', '%s', '%s', '%s', '%s')",
	    $supplierId, $type, $key, $primary, $secondary, $lang, $feature);
      }
    }
    $vals = implode(",", $vals);
    $query = 'INSERT INTO `'._DB_PREFIX_.'importfast` '.
      '(`supplierId`, `type`, `ext_field`, `int_primary`, `int_secondary`, `int_lang`, `int_feature`) '.
      'VALUES '.$vals;
    $res = $this->Execute($query);
    if (!$res) {
      printf("<p>%s</p>", $query);
      printf("<p>%s</p>", Db::getInstance()->getMsgError());
    }
  }

  public function saveProdSetup()
  {
    $fileFormat = Tools::getValue('fileFormat');
    $importType = Tools::getValue('importType');
    $itemSep = Tools::getValue('itemSep');
    $enclosure = htmlspecialchars_decode(Tools::getValue('enclosure'));
    $minQuantity = Tools::getValue('minQuantity');
    $pickingFee = Tools::getValue('pickingFee');
    $defaultQuantity = Tools::getValue('defaultQuantity');
    $defaultCategory = Tools::getValue('defaultCategory');
    $priceRange1 = Tools::getValue('priceRange1');
    $priceRange2 = Tools::getValue('priceRange2');
    $priceRange3 = Tools::getValue('priceRange3');
    $priceProfit1 = Tools::getValue('priceProfit1');
    $priceProfit2 = Tools::getValue('priceProfit2');
    $priceProfit3 = Tools::getValue('priceProfit3');
    $priceProfit4 = Tools::getValue('priceProfit4');
    $maxExecution = Tools::getValue('maxExecution');
    $productTag = Tools::getValue('productTag');
    $categorySep = $_POST['categorySep'];
    $subCategorySep = $_POST['subCategorySep'];
    $categoryPrefix = pSQL($_POST['categoryPrefix'], true);
    $imageSep = $_POST['imageSep'];
    $urlPrefix = Tools::getValue('urlPrefix');
    $supplierUrl = Tools::getValue('supplierUrl');
    $descRegExp1 = pSQL($_POST['descRegExp1'], true);
    $descReplace1 = pSQL($_POST['descReplace1'], true);
    $descRegExp2 = pSQL($_POST['descRegExp2'], true);
    $descReplace2 = pSQL($_POST['descReplace2'], true);
    $taxId = Tools::getValue('taxId');
    $impCurrency = Tools::getValue('impCurrency');
    $supplierId = Tools::getValue('supplierId');
    $deleteOld = intval(Tools::getValue('deleteOld'));
    $disableProducts = Tools::getValue('disableProducts');
    $zeroProducts = Tools::getValue('zeroProducts');
    $demandPicture = Tools::getValue('demandPicture');
    $useCopy = Tools::getValue('useCopy');
    $onlyNew = Tools::getValue('onlyNew');
    $decimalComma = Tools::getValue('decimalComma');
    $featureColon = Tools::getValue('featureColon');
    $keepBackslash = Tools::getValue('keepBackslash');
    $categoryLeaf = Tools::getValue('categoryLeaf');
    $categoriesPersistent = Tools::getValue('categoriesPersistent');
    $demandPrice = Tools::getValue('demandPrice');
    $demandWeight = Tools::getValue('demandWeight');
    $demandProduct = Tools::getValue('demandProduct');
    $demandCategory = Tools::getValue('demandCategory');
    $htmlMode = Tools::getValue('htmlMode');
    $skipFirstItem = Tools::getValue('skipFirstItem');
    $skipFirstLines = Tools::getValue('skipFirstLines');
    $iso8859 = Tools::getValue('iso8859');
    $productEndTag = Tools::getValue('productEndTag');
    $xmlLocale = Tools::getValue('xmlLocale');
    $prodFileName = Tools::getValue('prodFileName');
    $transFileName = Tools::getValue('transFileName');
    if ($categorySep == '\\')
      $categorySep = '\\\\';
    if (!$categorySep)
      $categorySep = ',';
    if ($subCategorySep == '\\')
      $subCategorySep = '\\\\';
    if (!$subCategorySep)
      $subCategorySep = ',';
    if ($imageSep == '\\')
      $imageSep = '\\\\';
    if (!$imageSep)
      $imageSep = ',';
    if ($importType == 0) {
      if ($fileFormat == 'XML')
	$type = "x";
      else
	$type = "c";
      $this->Execute('DELETE FROM `'._DB_PREFIX_.'importfast`
	WHERE `supplierId` = '.$supplierId.'
	AND `type` IN ("s", "x", "c")');
      $setupType = 's';
    }
    else {
      if ($fileFormat == 'XML')
	$type = "x1";
      else
	$type = "c1";
      $this->Execute('DELETE FROM `'._DB_PREFIX_.'importfast`
	WHERE `supplierId` = '.$supplierId.'
	AND `type` IN ("s1", "x1", "c1")');
      $setupType = 's1';
    }
    $this->Execute('DELETE FROM `'._DB_PREFIX_.'importfast`
      WHERE `supplierId` = '.$supplierId.'
      AND `ext_field` = "catFileName"
      AND `type` = "g"');
    $vars = array(
	'fileFormat' => $fileFormat,
	'itemSep' => $itemSep,
	'enclosure' => $enclosure,
	'minQuantity' => intval($minQuantity),
	'pickingFee' => intval($pickingFee),
	'defaultQuantity' => intval($defaultQuantity),
	'defaultCategory' => $defaultCategory,
	'priceRange1' => floatval($priceRange1),
	'priceRange2' => floatval($priceRange2),
	'priceRange3' => floatval($priceRange3),
	'priceProfit1' => floatval($priceProfit1),
	'priceProfit2' => floatval($priceProfit2),
	'priceProfit3' => floatval($priceProfit3),
	'priceProfit4' => floatval($priceProfit4),
	'maxExecution' => intval($maxExecution),
	'productTag' => $productTag,
	'categorySep' => $categorySep,
	'subCategorySep' => $subCategorySep,
	'categoryPrefix' => $categoryPrefix,
	'imageSep' => $imageSep,
	'urlPrefix' => $urlPrefix,
	'supplierUrl' => $supplierUrl,
	'descRegExp1' => $descRegExp1,
	'descReplace1' => $descReplace1,
	'descRegExp2' => $descRegExp2,
	'descReplace2' => $descReplace2,
	'taxId' => $taxId,
	'impCurrency' => $impCurrency,
	'supplierId' => $supplierId,
	'deleteOld' => $deleteOld,
	'disableProducts' => $disableProducts,
	'zeroProducts' => $zeroProducts,
	'demandPicture' => $demandPicture,
	'useCopy' => $useCopy,
	'onlyNew' => $onlyNew,
	'decimalComma' => $decimalComma,
	'featureColon' => $featureColon,
	'keepBackslash' => $keepBackslash,
	'categoryLeaf' => $categoryLeaf,
	'categoriesPersistent' => $categoriesPersistent,
	'demandPrice' => $demandPrice,
	'demandWeight' => $demandWeight,
	'demandProduct' => $demandProduct,
	'demandCategory' => $demandCategory,
	'htmlMode' => $htmlMode,
	'skipFirstItem' => $skipFirstItem,
	'skipFirstLines' => $skipFirstLines,
	'iso8859' => $iso8859,
	'productEndTag' => $productEndTag,
	'xmlLocale' => $xmlLocale,
	'prodFileName' => pSQL($prodFileName),
	'transFileName' => pSQL($transFileName));
    foreach ($vars as $k => $v) {
      $vals[] = sprintf("('%d', '%s', '%s', '%s', '', '', '')",
	  $supplierId, $setupType, $k, $v);
    }
    $vals[] = sprintf("('%d', '%s', '%s', '%s', '', '', '')",
      $supplierId, 'g', 'catFileName', Tools::getValue('catFileName'));
    foreach ($_POST as $k => $v) {
      if (substr($k, 0, 7) == "field0_") {
	$key = $v;
      }
      elseif (substr($k, 0, 7) == "field1_") {
	$primary = $v;
      }
      elseif (substr($k, 0, 7) == "field2_") {
	$feature = str_replace('\\', '\\\\', $v);
      }
      elseif (substr($k, 0, 7) == "field3_") {
	$secondary = $v;
      }
      elseif (substr($k, 0, 7) == "field4_") {
	$lang = $v;
	$vals[] = sprintf("('%d', '%s', '%s', '%s', '%s', '%s', '%s')",
	    $supplierId, $type, $key, $primary, $secondary, $lang, $feature);
      }
      elseif (substr($k, 0, 5) == "meta_") {
	$vals[] = sprintf("('%d', '%s', '%s', '%s', '', '', '')",
	    $supplierId, $setupType, $k, $v);
      }
    }
    $vals = implode(",", $vals);
    $query = 'INSERT INTO `'._DB_PREFIX_.'importfast` '.
      '(`supplierId`, `type`, `ext_field`, `int_primary`, `int_secondary`, `int_lang`, `int_feature`) '.
      'VALUES '.$vals;
    // $this->dump($query);
    $res = $this->Execute($query);
    if (!$res) {
      printf("<p>%s</p>", $query);
      printf("<p>%s</p>", Db::getInstance()->getMsgError());
    }
  }

  public function deleteDepend($table, $dtable, $field1 = NULL, $field2 = NULL)
  {
    if ($field1 == NULL)
      $field1 = 'id_'.$dtable;
    if ($field2 == NULL)
      $field2 = 'id_'.$dtable;
    $res = $this->Execute('DELETE FROM `'._DB_PREFIX_.$table.'`
      WHERE `'.$field1.'` NOT IN (SELECT `'.$field2.'`
      FROM `'._DB_PREFIX_.$dtable.'`)');
    if (!$res)
      $this->_status[] = Db::getInstance()->getMsgError();
    return Db::getInstance()->Affected_Rows();
  }

  public function getImageName($id_product, $id_image, $type = NULL)
  {
    if (Configuration::get('PS_LEGACY_IMAGES') !== '0') {
      $imagePath = _PS_PROD_IMG_DIR_.$id_product.'-'.$id_image;
    }
    else {
      $imagePath = _PS_PROD_IMG_DIR_.Image::getImgFolderStatic($id_image).$id_image;
    }
    return $imagePath.($type ? '-'.$type : '').'.jpg';
  }

  public function deleteImages($old = false, $age = 0, $rhino = false)
  {
    global $cookie;

    $time0 = "0000-00-00 00:00:00";
    if ($rhino) {
      $tmpfile = tempnam(_PS_TMP_IMG_DIR_, 'ps_import_noimage');
      if ($this->v15)
	ImageManager::resize(_PS_MODULE_DIR_.'/importfast/noimage.jpg',
	    $tmpfile);
      else
	imageResize(_PS_MODULE_DIR_.'/importfast/noimage.jpg', $tmpfile);
      $rhinoData = file_get_contents($tmpfile);
      unlink($tmpfile);
    }
    $supplierId = $cookie->supplierId = Tools::getValue('supplierId');
    if ($supplierId == 0) {
      $this->_errors[] = $this->l('You must select a supplier');
      return false;
    }
    $imageTypes = ImageType::getImagesTypes('products');
    $total = 0;
    $count = 0;
    if ($old) {
      $where = ' AND `active` = 0
	AND `date_upd` < DATE_SUB('.$this->quote(date('Y-m-d H:i:s')).', INTERVAL '.$age.' DAY)';
    }
    else
      $where = '';
    $res = $this->query('SELECT p.`id_product`, `id_image` FROM `'.
      _DB_PREFIX_.'product` p LEFT JOIN `'._DB_PREFIX_.'image` i ON p.`id_product` = i.`id_product` '.
      'WHERE `id_supplier` = '.$supplierId.$where.' ORDER BY p.`id_product`, `id_image`');
    while ($row = Db::getInstance()->nextRow($res)) {
      $total += count($imageTypes) + 1;
      $fileName = self::getImageName($row['id_product'], $row['id_image']);
      @unlink(_PS_TMP_IMG_DIR_.'product_mini_'.$row['id_product'].'.jpg');
      if ($rhino) {
	if (@filesize($fileName) != strlen($rhinoData) ||
	  strcmp($rhinoData, file_get_contents($fileName)) != 0)
	  continue;
      }
      if (@unlink($fileName))
	$count++;
      foreach ($imageTypes AS $k => $imageType) {
	$fileName = self::getImageName($row['id_product'], $row['id_image'], $imageType['name']);
	if (@unlink($fileName))
	  $count++;
      }
    }
    $res = $this->Execute('UPDATE `'._DB_PREFIX_.'product` p
      LEFT JOIN `'._DB_PREFIX_.'image` i ON p.`id_product` = i.`id_product`
      SET i.`img_upd` = '.$this->quote($time0).'
      WHERE `id_supplier` = '.$supplierId.$where);
    if ($age == 0)
      $this->_status[] = sprintf("%s %d/%d %s", $this->l('Deleted'), $count, $total, $this->l('images'));
  }

  public function deleteProducts($old = false, $age = 0)
  {
    global $cookie;

    $supplierId = $cookie->supplierId = Tools::getValue('supplierId');
    if ($supplierId == 0) {
      $this->_errors[] = $this->l('You must select a supplier');
      return false;
    }
    self::deleteImages($old, $age);
    $table = 'product';
    if ($old) {
      $where = ' AND `active` = 0
	AND `date_upd` < DATE_SUB('.$this->quote(date('Y-m-d H:i:s')).', INTERVAL '.$age.' DAY)';
    }
    else
      $where = '';
    $res = $this->Execute('DELETE FROM `'.
      _DB_PREFIX_.$table.'` WHERE `id_supplier` = '.$supplierId.$where);
    $productCount = Db::getInstance()->Affected_Rows();
    if ($age == 0)
      $this->_status[] = sprintf("%s %d %s %s %s %s", $this->l('Deleted'), $productCount,
	$productCount == 1 ? $this->l('entry') : $this->l('entries'),
	$this->l('from'), $table, $this->l('table'));
    $tables = array(
      array('attribute_impact',              'product',           NULL,              NULL),
      array('category_product',              'product',           NULL,              NULL),
      array('image',                         'product',           NULL,              NULL),
      array('image_lang',                    'image',             NULL,              NULL),
      array('product_lang',                  'product',           NULL,              NULL),
      array('product_attribute',             'product',           NULL,              NULL),
      array('product_attribute_combination', 'product_attribute', NULL,              NULL),
      array('product_attribute_image',       'product_attribute', NULL,              NULL),
      array('feature_product',               'product',           NULL,              NULL),
      array('feature',                       'feature_product',   'id_feature',      'id_feature'),
      array('feature_lang',                  'feature',           NULL,              NULL),
      array('feature_value',                 'feature',           NULL,              NULL),
      array('feature_value_lang',            'feature_value',     NULL,              NULL),
      array('manufacturer',                  'product',           'id_manufacturer', 'id_manufacturer'),
      array('manufacturer_lang',             'manufacturer',      NULL,              NULL),
      array('accessory',                     'product',           'id_product_1',    NULL),
      array('product_tag',                   'product',           NULL,              NULL),
      array('tag',                           'product_tag',       'id_tag',             'id_tag')
    );
    if ($this->v14)
      $tables[] = array('specific_price', 'product', NULL, NULL);
    else
      $tables[] = array('discount_quantity', 'product', NULL, NULL);
    if ($this->v15) {
      $tables[] = array('product_shop', 'product', NULL, NULL);
      $tables[] = array('product_supplier', 'product', NULL, NULL);
      $tables[] = array('stock_available', 'product', NULL, NULL);
      $tables[] = array('product_attribute_shop', 'product_attribute', NULL, NULL);
      $tables[] = array('feature_shop', 'feature_product', 'id_feature', 'id_feature');
      $tables[] = array('manufacturer_shop', 'manufacturer', NULL, NULL);
      $tables[] = array('image_shop', 'image', NULL, NULL);
    }
    foreach ($tables as $table) {
      $count = self::deleteDepend($table[0], $table[1], $table[2], $table[3]);
      if ($age == 0)
	$this->_status[] = sprintf("%s %d %s %s %s %s", $this->l('Deleted'), $count,
	  $count == 1 ? $this->l('entry') : $this->l('entries'),
	  $this->l('from'), $table[0], $this->l('table'));
    }
    return $productCount;
  }

  public function deleteCategories()
  {
    // Get existing categories
    $res = $this->query('SELECT `id_category`, `id_parent`
      FROM `'. _DB_PREFIX_.'category`');
    $categories = array();
    $active = array();
    $referenced = $this->getRootCategories();
    $unreferenced = array();
    $this->importType = 0;
    while ($row = Db::getInstance()->nextRow($res)) {
      $categories[$row['id_category']] = $row['id_parent'];
    }
    // Get existing active products
    $res = $this->query('SELECT DISTINCT id_category FROM (
      SELECT `id_category`, p.`id_product`, active
      FROM `'. _DB_PREFIX_.'product` p
      LEFT JOIN `'. _DB_PREFIX_.'category_product` cp
      ON p.`id_product` = cp.`id_product`) AS c');
    while ($row = Db::getInstance()->nextRow($res)) {
      for ($categoryId = $row['id_category'];
	$categoryId != 0;
	$categoryId = $categories[$categoryId])
      {
	$referenced[$categoryId] = true;
      }
    }
    unset($rows);
    foreach (array_keys($categories) as $categoryId) {
      if (!isset($referenced[$categoryId]))
	$unreferenced[$categoryId] = true;
    }
    $table = 'category';
    $count = self::deleteList($table, 'id_category', $unreferenced);
    $this->_status[] = sprintf("%s %d %s %s %s %s", $this->l('Deleted'), $count,
      $count == 1 ? $this->l('entry') : $this->l('entries'),
      $this->l('from'), $table, $this->l('table'));

    $tables = array('category_lang', 'category_group');
    if ($this->v15) {
      $tables[] = 'category_shop';
      $tables[] = 'group_reduction';
      $tables[] = 'scene_category';
    }
    foreach ($tables as $table) {
      $count = self::deleteDepend($table, 'category');
      $this->_status[] = sprintf("%s %d %s %s %s %s", $this->l('Deleted'),
	  $count,
	  $count == 1 ? $this->l('entry') : $this->l('entries'),
	  $this->l('from'), $table, $this->l('table'));
    }

    $this->categoryUpdate();
  }

  public function deactivateCategories()
  {
    // Get existing categories
    $res = $this->query('SELECT `id_category`, `id_parent`
      FROM `'. _DB_PREFIX_.'category`');
    $parents = array();
    $active = array();
    $referenced = $this->getRootCategories();
    $unreferenced = array();
    while ($row = Db::getInstance()->nextRow($res)) {
      $parents[$row['id_category']] = $row['id_parent'];
    }
    // Get existing active products
    $res = $this->query('SELECT DISTINCT id_category FROM (
      SELECT `id_category`, p.`id_product`, active
      FROM `'. _DB_PREFIX_.'product` p
      LEFT JOIN `'. _DB_PREFIX_.'category_product` cp
      ON p.`id_product` = cp.`id_product` WHERE active = 1) AS c');
    while ($row = Db::getInstance()->nextRow($res)) {
      for ($categoryId = $row['id_category'];
	$categoryId != 0;
	$categoryId = $parents[$categoryId])
      {
	$referenced[$categoryId] = true;
      }
    }
    unset($rows);
    foreach (array_keys($parents) as $categoryId) {
      if (!isset($referenced[$categoryId]))
	$unreferenced[$categoryId] = true;
    }
    return self::deactivateList('category', 'id_category', $unreferenced);
  }

  public function deactivateProducts()
  {
    // Get existing categories
    $count = 0;
    $res = $this->query('SELECT `id_category`, `id_parent`, `active`
      FROM `'. _DB_PREFIX_.'category`');
    $categories = array();
    $activeList = array();
    $unreferenced = array();
    while ($row = Db::getInstance()->nextRow($res)) {
      if ($row['active'] == 1) {
	$activeList[$row['id_category']] = true;
	$categories[$row['id_category']] = $row['id_parent'];
      }
    }
    // Deactivate children if parent is not active
    foreach (array_keys($categories) as $startId) {
      for ($categoryId = $startId; $categoryId != 0; $categoryId = $categories[$categoryId]) {
	if (empty($activeList[$categoryId])) {
	  unset($activeList[$startId]);
	  break;
	}
      }
    }
    if ($activeList) {
      $aList = implode(",", array_keys($activeList));
      if ($this->v15) {
	$query = 'UPDATE `'._DB_PREFIX_.'product_shop`
	  SET `active` = 0, `redirect_type` = "404"
	  WHERE `active` = 1 AND `id_product` NOT IN (
	      SELECT DISTINCT `id_product`
	      FROM `'. _DB_PREFIX_.'category_product`
	      WHERE `id_category` IN ('.$aList.'))';
	$res = $this->Execute($query);
      }
      $query = 'UPDATE `'._DB_PREFIX_.'product`
	SET `active` = 0
	WHERE `active` = 1 AND `id_product` NOT IN (
	  SELECT DISTINCT `id_product`
	  FROM `'. _DB_PREFIX_.'category_product`
	  WHERE `id_category` IN ('.$aList.'))';
      $res = $this->Execute($query);
      $count += Db::getInstance()->Affected_Rows();
    }
    return $count;
  }

  public function deleteConfirm()
  {
    $tables = array(
      'product'                       => NULL,
      'product_lang'                  => NULL,
      'feature_product'               => NULL,
      'category_product'              => NULL,
      'attachment'                    => NULL,
      'attachment_lang'               => NULL,
      'attribute'                     => NULL,
      'attribute_lang'                => NULL,
      'attribute_group'               => NULL,
      'attribute_group_lang'          => NULL,
      'attribute_impact'              => NULL,
      'product_attribute'             => NULL,
      'product_attribute_combination' => NULL,
      'product_attribute_image'       => NULL,
      'image'                         => NULL,
      'image_lang'                    => NULL,
      'feature'                       => NULL,
      'feature_lang'                  => NULL,
      'feature_value'                 => NULL,
      'feature_value_lang'            => NULL,
      'manufacturer'                  => NULL,
      'manufacturer_lang'             => NULL,
      'accessory'                     => NULL,
      'tag'                           => NULL,
      'product_tag'                   => NULL,
      'category'                      => 'id_category',
      'category_lang'                 => 'id_category',
      'category_group'                => 'id_category'
    );
    if ($this->v14)
      $tables['specific_price'] = NULL;
    else
      $tables['discount_quantity'] = NULL;
    if ($this->v15) {
      $tables['product_shop'] = NULL;
      $tables['product_supplier'] = NULL;
      $tables['attribute_shop'] = NULL;
      $tables['attribute_group_shop'] = NULL;
      $tables['product_attribute_shop'] = NULL;
      $tables['image_shop'] = NULL;
      $tables['feature_shop'] = NULL;
      $tables['manufacturer_shop'] = NULL;
      $tables['category_shop'] = 'id_category';
      $tables['stock_available'] = NULL;
    }
    $txt = $this->l('Delete all image files and tables');
    print '
      <fieldset>
      <legend><img src="../img/t/AdminImportFast.gif" />'.$txt.'</legend>
      <form id="preview_import" action="'.self::$currentIndex.'&amp;token='.$this->token.'"
      style="display: inline; clear: both;" method="post" enctype="multipart/form-data">';
    print '
      <label>image files</label>
      <div class="margin-form">
      <input name="imageFiles" id="imageFiles" checked type="checkbox" />
      </div>';
    foreach ($tables as $table => $field) {
      print '
	<label>'.$table.'</label>
	<div class="margin-form">
	<input name="'.$table.'-'.$field.'" checked type="checkbox" />
	</div>';
    }
    $fileFormat = Tools::getValue('fileFormat');
    $importType = Tools::getValue('importType');
    $supplierId = Tools::getValue('supplierId');
    $catFileName = Tools::getValue('catFileName');
    $prodFileName = Tools::getValue('prodFileName');
    $transFileName = Tools::getValue('transFileName');
    print '<div class="space margin-form">
      <input type="hidden" name="supplierId" value="'.$supplierId.'" />
      <input type="hidden" name="catFileName" value="'.$catFileName.'" />
      <input type="hidden" name="prodFileName" value="'.$prodFileName.'" />
      <input type="hidden" name="transFileName" value="'.$transFileName.'" />
      <input type="hidden" name="fileFormat" value="'.$fileFormat.'" />
      <input type="hidden" name="importType" value="'.$importType.'" />
      <input type="submit" name="nukeAll" value="'.$this->l('Delete').'" class="button" />
      <input type="submit" name="submitCancel" value="'.$this->l('Cancel').'" class="button" />
      </div>
      </form>
      </fieldset>';
    return true;
  }

  public function deleteImgDir($dir, &$count)
  {
    $res = opendir($dir);
    if (!$res)
      die("Can't open image directory");
    while (false !== ($file = readdir($res))) {
      if (ctype_digit(substr($file, 0, 1)) ||
	$file == 'index.php' && $dir != _PS_PROD_IMG_DIR_)
      {
	if (is_dir($dir.$file)) {
	  self::deleteImgDir($dir.$file.'/', $count);
	  rmdir($dir.$file);
	}
	else {
	  if (unlink($dir.$file))
	    $count++;
	  else
	    die("Unlink $file failed");
	}
      }
    }
    closedir($res);
  }

  public function deleteTmpImg()
  {
    $dir = _PS_TMP_IMG_DIR_;
    $res = opendir($dir);
    if (!$res)
      die("Can't open tmp image directory");
    while (false !== ($file = readdir($res))) {
      if (substr($file, 0, 13) == 'product_mini_')
	@unlink(_PS_TMP_IMG_DIR_.$file);
    }
    closedir($res);
  }

  public function nukeAll()
  {
    $rootCategories = $this->getRootCategories();
    if (Tools::getValue('imageFiles')) {
      $count = 0;
      self::deleteImgDir(_PS_PROD_IMG_DIR_, $count);
      self::deleteTmpImg();
      $this->_status[] = sprintf("<p>%s %d %s.</p>", $this->l('Removed'), $count, $this->l('images'));
    }
    $tables = array();
    foreach ($_POST as $k => $p) {
      $p = explode('-', $k);
      if (count($p) == 2)
	$tables[$p[0]] = $p[1];
    }

    foreach ($tables as $table => $field) {
      if ($field)
	$res = $this->Execute('DELETE FROM `'._DB_PREFIX_.$table.'`
	  WHERE '.$field.' NOT IN '.$this->group($rootCategories));
      else
	$res = $this->Execute('DELETE FROM `'._DB_PREFIX_.$table.'`');
      $count = Db::getInstance()->Affected_Rows();
      $this->_status[] = sprintf("%s %d %s %s %s %s", $this->l('Deleted'), $count,
	$count == 1 ? $this->l('entry') : $this->l('entries'),
	$this->l('from'), $table, $this->l('table'));
    }
    $this->categoryUpdate();
  }

  public function cron_import($supplierId, $prodFileName, $fileFormat,
      $resume, $catFileName)
  {
    $_POST['prodFileName'] = $prodFileName;
    $_POST['catFileName'] = $catFileName;
    $_POST['supplierId'] = $supplierId;
    $_POST['fileFormat'] = $fileFormat;
    $_POST['importType'] = Tools::getValue('importType');
    $this->setFields();
    $this->cronFlag = 1;
    $this->import($resume >= 1);
    if (($this->getErrors())) {
      print $this->l('Errors')."\n";
      foreach ($this->getErrors() as $error)
	printf("%s\n", $error);
      print "-------------------------------------\n";
    }
    foreach ((array)$this->_status as $status)
      printf("%s\n", str_replace('&nbsp;', ' ', strip_tags($status)));
  }

  public function cron()
  {
    global $cookie;

    header("Content-Type:text/plain");
    $cookie = new Cookie('ps');
    $importToken = md5('importfast'._COOKIE_KEY_);
    $supplierId = Tools::getValue('supplierId');
    $confSupplierId = Tools::getValue('confSupplierId', $supplierId);
    $importType = Tools::getValue('importType');
    if (!$supplierId) {
      print $this->l('Supplier ID not set');
      return;
    }
    $token = Tools::getValue('token');
    if ($token != $importToken) {
      print $this->l('Bad token');
      return;
    }
    $this->adminPath = Tools::getValue('adminPath');
    if (!$this->adminPath) {
      print $this->l('Import directory not set');
      return;
    }
    $sql = 'SELECT *
      FROM `'._DB_PREFIX_.'importfast`
      WHERE `supplierId` = '.$confSupplierId;
    if ($importType == 1)
      $sql .= ' AND `type` = "s1"';
    else
      $sql .= ' AND `type` = "s"';
    $rows = $this->ExecuteS($sql);
    $configData = array();
    foreach($rows as $row)
      $configData[$row['ext_field']] = $row['int_primary'];
    $sql = 'SELECT *
      FROM `'._DB_PREFIX_.'importfast`
      WHERE `supplierId` = '.$confSupplierId.'
      AND `ext_field` = "catFileName"
      AND `type` = "g"';
    $rows = $this->ExecuteS($sql);
    foreach($rows as $row)
      $configData[$row['ext_field']] = $row['int_primary'];
    $prodFileName = $configData['prodFileName'];
    $catFileName = $configData['catFileName'];
    $fileFormat = $configData['fileFormat'];
    $supplierUrl = $configData['supplierUrl'];
    $resume = Tools::getValue('resume');
    $shopId = Tools::getValue('shop');
    $groupId = Tools::getValue('group');
    $allShops = Tools::getValue('all');
    $copyFlag = Tools::getValue('copyFlag', 1);
    $importFlag = Tools::getValue('importFlag', 1);
    if ($shopId)
      Shop::setContext(Shop::CONTEXT_SHOP, $shopId);
    if ($groupId)
      Shop::setContext(Shop::CONTEXT_GROUP, $groupId);
    if ($allShops)
      Shop::setContext(Shop::CONTEXT_ALL);
    if (function_exists('importfast_cron')) {
      importfast_cron($this, $supplierId, $prodFileName, $fileFormat,
	  $resume, $catFileName);
      return;
    }
    if ($supplierUrl && $resume == 0 && $copyFlag) {
      $startTime = microtime(true);
      if (copy($supplierUrl, $this->adminPath.$prodFileName)) {
	printf($this->l('Copied file %s in %.3f seconds')."\n\n",
	    $prodFileName, microtime(true) - $startTime);
      }
      else {
	$errors = error_get_last();
	printf($this->l('Could not copy file %s to %s'), $supplierUrl, $prodFileName);
	printf(', copy error: %s, %s', $errors['type'], $errors['message']);
	return;
      }
    }
    if ($importFlag) {
      $this->cron_import($supplierId, $prodFileName, $fileFormat,
	  $resume, $catFileName);
    }
  }

}

?>

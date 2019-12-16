<?php

if (!defined('_PS_VERSION_'))
	exit;


if (_PS_VERSION_ >= "1.5.0.0")
{
	class ImportfastUpdateExtract extends AdminModulesController
	{
		function doExtract($file)
		{
			parent::extractArchive($file, true);
		}
	}
}
else
{
	include_once('tabs/AdminModules.php');
	class ImportfastUpdateExtract extends AdminModules
	{
		function doExtract($file)
		{
			parent::extractArchive($file);
			// Only come here if unpacking failed
			$this->errors = $this->_errors;
		}
	}
}


class ImportfastUpdate
{
	public function newVersionAvailable()
	{
		return true || Tools::getValue('swUpdForce');
	}

	public static function file_get_contents($url)
	{
		if (_PS_VERSION_ >= "1.4.0.0")
			return Tools::file_get_contents($url);
		else
			return file_get_contents($url);
	}

	public static function getData($url, $version = '')
	{
		$fields = array(
				'shopname' => Configuration::get('PS_SHOP_NAME'),
				'shopurl' => $_SERVER['HTTP_HOST'],
				'shopversion' => _PS_VERSION_,
				'email' => Configuration::get('PS_SHOP_EMAIL'),
				'version' => $version
				);
		$url .= '&'.http_build_query($fields);
		return self::file_get_contents($url);
	}

	public function updateModule($obj)
	{
		$data = self::getData('https://prestashop.butikki.dk/en/module/softwareupdate/check?key=f98f3a1d2e36a7a1af3d9887e88e4a41cde9283f-7c3dfd3dfa796c30a1cc7d6a3acff3ba7b3e08c2&full=1', $obj->version);
		if (strlen($data) > 5)
		{
			$tmpFile = tempnam(_PS_MODULE_DIR_, 'ps_softwareupdate');
			$tmpFile .= '.tgz';
			file_put_contents($tmpFile, $data);
			$extractObj = new ImportfastUpdateExtract();
			$extractObj->token = Tools::getValue('token');
			$extractObj->doExtract($tmpFile);
			$this->errors = $extractObj->errors;
		}
		else
			$this->errors[] = 'Update error. Contact kjeld@mail4us.dk for help.';
	}
}

?>

<?php

class Link extends LinkCore
{
	public function overrideVersion7()
	{
		return true;
	}

	public function copy_url($url, $file, $useCopy = false)
	{
		if ($this->debug && $useCopy) {
			print "useCopy<br />\n";
		}
		if ($useCopy ||
				substr($url, 0, 7) != 'http:/'.'/' &&
				substr($url, 0, 8) != 'https:/'.'/' ||
				!function_exists('curl_init'))
		{
			$retVal = @copy($url, $file);
			if ($this->debug) {
				printf("image size=%d<br />\n", getimagesize($file));
			}
			return $retVal;
		}
		global $importfast_ch;
		if (empty($importfast_ch))
			$importfast_ch = curl_init();
		curl_setopt($importfast_ch, CURLOPT_URL, $url);
		curl_setopt($importfast_ch, CURLOPT_HEADER, 0);   
		curl_setopt($importfast_ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($importfast_ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($importfast_ch, CURLOPT_TIMEOUT, 3000);
		curl_setopt($importfast_ch, CURLOPT_USERAGENT, 'User-Agent=Mozilla/5.0 (Windows NT 5.1; rv:8.0) Gecko/20100101 Firefox/8.0');
		// curl_setopt($importfast_ch, CURLOPT_FOLLOWLOCATION, true);
		$result = curl_exec($importfast_ch);
		if (!$result) {
			if ($this->debug)
				printf("cURL: %s<br />\n", curl_error($importfast_ch));
			$status = curl_getinfo($importfast_ch);
			if($status['http_code'] == 301 ||
					$status['http_code'] == 302)
			{
				if ($this->debug)
					printf("redirect: %s<br />\n", $url);
				$url = $status['redirect_url'];
				curl_setopt($importfast_ch, CURLOPT_URL, $url);
				$result = curl_exec($importfast_ch);
			}
		}
		if (!$result)
			return false;
		$handle = fopen($file, 'wb');
		if (!$handle) {
			if ($this->debug)
				print "open failed: $file<br />\n";
			return false;
		}
		if (fwrite($handle, $result) === FALSE) {
			if ($this->debug)
				print "write failed: $file<br />\n";
			return false;
		}
		fclose($handle);
		if ($this->debug) {
			printf("image size=%d<br />\n", getimagesize($file));
		}
		return true;
	}

	public function copyImg($id_image, $imagePath)
	{
		$this->debug = Tools::getValue('impfDebug');
		$row = Db::getInstance()->getRow('
			SELECT DISTINCT i.`id_product`, i.`url`, f.`int_primary`
			FROM `'._DB_PREFIX_.'image` i
			LEFT JOIN `'._DB_PREFIX_.'product_supplier` ps
			ON (i.`id_product` = ps.`id_product`)
			LEFT JOIN `'._DB_PREFIX_.'importfast` f
			ON (ps.`id_supplier` = f.`supplierId`)
			WHERE i.`id_image` = '.intval($id_image).'
			AND f.`type` = "s"
			AND f.`ext_field` = "useCopy"');
		if (!$row) {
			if ($this->debug)
				print "row not found<br />\n";
			return false;
		}
		$url = $row['url'];
		if ($this->debug)
			print "url=$url<br />\n";
		$id_product = $row['id_product'];
		$useCopy = $row['int_primary'];
		if (empty($url) || $url{0} == ' ')
			return false;
		$tmpfile = tempnam(_PS_TMP_IMG_DIR_, 'ps_import'.$id_image);
		if (!is_dir(dirname($imagePath)))
			mkdir(dirname($imagePath), 0777, true);
		if ($this->debug) {
			if (!is_dir(dirname($imagePath)))
				printf("directory %s not created<br />\n", dirname($imagePath));
		}

		if (self::copy_url($url, $tmpfile, $useCopy) &&
			getimagesize($tmpfile) ||
			copy(_PS_MODULE_DIR_.'/importfast/noimage.jpg', $tmpfile))
		{
			$imagesTypes = ImageType::getImagesTypes('products');
			foreach ($imagesTypes AS $k => $imageType)
				ImageManager::resize($tmpfile,
					$imagePath.'-'.stripslashes($imageType['name']).'.jpg',
					$imageType['width'], $imageType['height']);
			ImageManager::resize($tmpfile, $imagePath.'.jpg');
			Hook::exec('watermark', array('id_image' => $id_image, 'id_product' => $id_product));
		}
		else
		{
			unlink($tmpfile);
			return false;
		}
		unlink($tmpfile);
		return true;
	}

	public function linkImg($imagePath_main, $imagePath)
	{
		$dir = dirname($imagePath_main);
		if (!is_dir(dirname($imagePath)))
			mkdir(dirname($imagePath), 0777, true);
		$res = opendir($dir);
		if (!$res)
			return false;
		link($imagePath_main.'.jpg', $imagePath.'.jpg');
		while (($file = readdir($res)) !== false) {
			$p = explode('-', $file);
			if (count($p) == 2)
				link($imagePath_main.'-'.$p[1], $imagePath.'-'.$p[1]);
		}
		closedir($res);
		return true;
	}

	public function getImageLink($name, $ids, $type = NULL)
	{
		$this->debug = Tools::getValue('impfDebug');
		$this->resizedCount = 0;
		$split_ids = explode('-', $ids);
		$id_image = (isset($split_ids[1]) ? $split_ids[1] : $split_ids[0]);
		if (Configuration::get('PS_LEGACY_IMAGES') !== '0') {
			$imagePath = _PS_PROD_IMG_DIR_.$ids;
			// Copy image file for ImportFast module
			if (!file_exists($imagePath.'.jpg') &&
				self::copyImg($id_image, $imagePath))
					$this->resizedCount++;
			return parent::getImageLink($name, $ids, $type);
		}
		$row = Db::getInstance()->getRow('
			SELECT `id_image`
			FROM `'._DB_PREFIX_.'image`
			WHERE `url` IN
			(SELECT `url`
			 FROM `'._DB_PREFIX_.'image`
			 WHERE `id_image` = '.intval($id_image).'
			 AND `url` > "")');
		if ($row) {
			if ($this->debug)
				printf("id %s -> %s<br />\n", $id_image, $row['id_image']);
			$id_image_main = $row['id_image'];
		}
		else {
			if ($this->debug)
				printf("id %s<br />\n", $id_image);
			$id_image_main = $id_image;
		}
		$imagePath = _PS_PROD_IMG_DIR_.Image::getImgFolderStatic($id_image).$id_image;
		$imagePath_main = _PS_PROD_IMG_DIR_.Image::getImgFolderStatic($id_image_main).$id_image_main;
		// Copy image file for ImportFast module
		if (!file_exists($imagePath_main.'.jpg') &&
			self::copyImg($id_image_main, $imagePath_main))
				$this->resizedCount++;
		// Link image file for ImportFast module
		if ($imagePath_main != $imagePath &&
			!file_exists($imagePath.'.jpg') &&
			self::linkImg($imagePath_main, $imagePath))
				$this->resizedCount++;
		return parent::getImageLink($name, $ids, $type);
	}
}

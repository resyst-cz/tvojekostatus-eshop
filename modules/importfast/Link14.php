<?php

include_once(dirname(__FILE__).'/../../images.inc.php');

class Link extends LinkCore
{
	public function copy_url($url, $file)
	{
		if (substr($url, 0, 7) != 'http://' || !function_exists('curl_init'))
			return @copy($url, $file);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);   
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3000);
		curl_setopt($ch, CURLOPT_USERAGENT, 'User-Agent=Mozilla/5.0 (Windows NT 5.1; rv:8.0) Gecko/20100101 Firefox/8.0');
		// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		$result = curl_exec($ch);
		curl_close($ch);
		$handle = fopen($file, 'wb');
		if (!$handle) {
			return false;
		}
		if (fwrite($handle, $result) === FALSE) {
			return false;
		}
		fclose($handle);
		return true;
	}

	public function copyImg($id_image, $imagePath)
	{
		$row = Db::getInstance()->getRow('
			SELECT `id_product`, `url`
			FROM `'._DB_PREFIX_.'image`
			WHERE `id_image` = '.intval($id_image));
		if (!$row)
			return;
		$url = $row['url'];
		$id_product = $row['id_product'];
		if (empty($url) || $url{0} == ' ')
			return;
		$tmpfile = tempnam(_PS_TMP_IMG_DIR_, 'ps_import'.$id_product);
		if (!is_dir(dirname($imagePath)))
			mkdir(dirname($imagePath), 0777, true);

		if (self::copy_url($url, $tmpfile) && getimagesize($tmpfile) ||
			copy(_PS_MODULE_DIR_.'/importfast/noimage.jpg', $tmpfile))
		{
			$imagesTypes = ImageType::getImagesTypes('products');
			foreach ($imagesTypes AS $k => $imageType)
				imageResize($tmpfile,
					$imagePath.'-'.stripslashes($imageType['name']).'.jpg',
					$imageType['width'], $imageType['height']);
			imageResize($tmpfile, $imagePath.'.jpg');
			Module::hookExec('watermark', array('id_image' => $id_image, 'id_product' => $id_product));
		}
		else
		{
			unlink($tmpfile);
			return false;
		}
		unlink($tmpfile);
		return true;
	}	

	public function getImageLink($name, $ids, $type = NULL)
	{
		$split_ids = explode('-', $ids);
		$id_image = (isset($split_ids[1]) ? $split_ids[1] : $split_ids[0]);
		if (Configuration::get('PS_LEGACY_IMAGES') !== '0') {
			$imagePath = _PS_PROD_IMG_DIR_.$ids;
		}
		else {
			$imagePath = _PS_PROD_IMG_DIR_.Image::getImgFolderStatic($id_image).$id_image;
		}
		if (!file_exists($imagePath.'.jpg'))
			// Copy image file for ImportFast module
			self::copyImg($id_image, $imagePath);
		return parent::getImageLink($name, $ids, $type);
	}
}

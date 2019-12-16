<?php

class Image extends ImageCore
{
	public function overrideVersion5()
	{
	  return true;
	}

	public function __construct($id = null, $id_lang = null)
	{
		parent::__construct($id, $id_lang);
		$oldFolder = $this->folder;
		$imagePath = _PS_PROD_IMG_DIR_.$this->getExistingImgPath();
		$this->folder = $oldFolder;
		if (!file_exists($imagePath.'.jpg')) {
			$link = new Link();
			$link->copyImg($id, $imagePath);
		}
	}
}

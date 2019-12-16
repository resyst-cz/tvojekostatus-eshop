<?php


include(_PS_MODULE_DIR_.'importfast/importfast.php');
if (_PS_VERSION_ >= "1.5.0.0")
  include(_PS_MODULE_DIR_.'importfast/AdminImportFastController.php');


class AdminImportFast extends AdminTab
{
  public function __construct()
  {
    if (_PS_VERSION_ >= "1.5.0.0") {
      new AdminImportFastController();
      $this->multishop_context = -1;
      $this->multishop_context_group = true;
    }
    $this->importfast = new ImportFast;
    $this->importfast->setFields();
    return parent::__construct();
  }

  public function display()
  {
    $this->importfast->token = $this->token;
    $this->importfast->displayMain();
  }

}

?>

<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/importfast.php');

$importFast = new ImportFast();
$importFast->cron();

?>

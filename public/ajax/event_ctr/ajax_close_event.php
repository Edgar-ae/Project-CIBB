<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/app/config/config.php');
require_once(URL_PROJECT.'/app/controller/ctr_querys_event.php');
$rpt=CTR_QUERYS_EVENT::ctr_close_event();
echo json_encode($rpt);
?>
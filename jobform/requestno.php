<?php 
require '../controller/RequestController.php';
$controller = new RequestController();

if (isset($_GET['req']) && $_GET['req'] == "requesting_no") {
	$controller->reqno();
}
if (isset($_GET['req']) && isset($_GET['status']) && $_GET['status'] == "cancelation") {
	$controller->reqnocancel($_GET['req']);
}
?>
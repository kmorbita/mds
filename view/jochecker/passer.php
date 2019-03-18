<?php 
require("../../controller/JocheckerController.php");
$controller = new JocheckerController();
if (isset($_POST['joblistid'])) {
	$id = $_POST['joblistid'];
	$res = $controller->view_job($id);
	// echo $res;
	// echo $id;
}
if (isset($_POST['changepass']) == "true") {
	$res = $controller->changepass();
	echo $res;
}
// get jobs
if (isset($_POST['joblist']) == "true") {
	$res = $controller->joborderlist();
	echo json_encode($res);
}
if (isset($_GET['msg']) && $_GET['msg'] == "logout") {
	$user = $_GET['user'];
	$role = $_GET['role'];
	$controller->getLogout($user,$role);
}
?>
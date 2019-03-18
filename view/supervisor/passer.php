<?php 
require("../../controller/SupervisorController.php");
$controller = new SupervisorController();
if (isset($_POST['joblistid'])) {
	$id = $_POST['joblistid'];
	$res = $controller->view_job($id);
	// echo $res;
	// echo $id;
}
if (isset($_GET['msg']) && $_GET['msg'] == "logout") {
	$user = $_GET['user'];
	$role = $_GET['role'];
	$controller->getLogout($user,$role);
}
// change password
if (isset($_POST['changepass']) == "true") {
	$res = $controller->changepass();
	echo $res;
}
// assign foreman to joborder request
if (isset($_POST['assign_foreman']) == "true") {
	$assign = $controller->assign_foreman();
	if ($assign == "assigned") {
		echo "assigned";
	}else {
		echo "error";
	}
}
// activate job request
if (isset($_POST['activate_req']) == "true") {
	$res = $controller->activate_req();
	echo $res;
}
// cancel job request
if (isset($_POST['cancel_req']) == "true") {
	$res = $controller->cancel_req();
	echo $res;
}
// cancel job request
if (isset($_POST['stop_req']) == "true") {
	$res = $controller->stop_req();
	echo $res;
}
// info job request
// if (isset($_POST['info'])) {
// 	$id = $_POST['info'];
// 	$res = $controller->info_req($id);
// 	echo json_encode($res);
// }
// get jobs
if (isset($_POST['joblist']) == "true") {
	$res = $controller->joborderlist();
	echo json_encode($res);
}
// search job
if (isset($_POST['search_data'])) {
	$res = $controller->search_data();
	echo json_encode($res);
}
// status submit
if (isset($_POST['submit_status']) == "true") {
	$res = $controller->submit_status();
	echo $res;
}
// job activity
if (isset($_POST['job_activity'])) {
	$id = $_POST['job_activity'];
	$res = $controller->activity($id);
	echo json_encode($res);
}
// all operator
if (isset($_POST['all_operator'])) {
	$id = $_POST['all_operator'];
	$res = $controller->all_operator($id);
	echo json_encode($res);
}
// all gang
if (isset($_POST['all_gang'])) {
	$id = $_POST['all_gang'];
	$res = $controller->all_gang($id);
	echo json_encode($res);
}
// personnel activity
if (isset($_POST['personnel_activity'])) {
	$id = $_POST['personnel_activity'];
	$res = $controller->personnel_activity($id);
	echo json_encode($res);
}
// personnel activity
if (isset($_POST['operator_activity'])) {
	$id = $_POST['operator_activity'];
	$res = $controller->operator_activity($id);
	echo json_encode($res);
}
if (isset($_POST['operator_act'])) {
	$id = $_POST['emp_id'];
	$res = $controller->operator_act($id);
	echo json_encode($res);
}
if (isset($_POST['personnel_act'])) {
	$id = $_POST['emp_id'];
	$res = $controller->personnel_act($id);
	echo json_encode($res);
}
if (isset($_POST['equipment_act'])) {
	$id = $_POST['equipment_act'];
	$res = $controller->equipment_act($id);
	echo json_encode($res);
}
?>
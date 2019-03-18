<?php 
require("../../controller/MaintenanceController.php");
$controller = new MaintenanceController();
// change password
if (isset($_POST['changepass']) == "true") {
	$res = $controller->changepass();
	echo $res;
}
// submot job order request from jo clerk
if (isset($_POST['submit']) == "true") {
	$msg = $controller->insert();
	echo $msg;
}
// delete joclerk form tblcargocommodities->delete from html table
if (isset($_POST['del_comm'])) {
	$id = $_POST['del_comm'];
	$del = $controller->del_comm($id);
	if ($del == true) {
		echo true;
	}else{
		echo false;
	}
}
// delete joclerk form tblequipreq->delete from html table
if (isset($_POST['del_eqpt'])) {
	$id = $_POST['del_eqpt'];
	$del = $controller->del_eqpt($id);
	echo $del;
}
// delete joclerk form tblmanpowerreq->delete from html table
if (isset($_POST['del_mp'])) {
	$id = $_POST['del_mp'];
	$del = $controller->del_mp($id);
	echo $del;
}
// edit joclerk job form request, tbljobcargocommodities-> add
if (isset($_POST['edit_comm']) == "true") {
	$msg = $controller->insert_comm();
	if ($msg == true) {
		echo true;
	}else{
		echo false;
	}
}
// edit joclerk job form request, tblequipreq-> add
if (isset($_POST['edit_eqpt']) == "true") {
	$msg = $controller->insert_eqpt();
	echo $msg;
}
// edit joclerk job form request, tblmanpowerreq-> add
if (isset($_POST['edit_mp']) == "true") {
	$msg = $controller->insert_mp();
	if ($msg == true) {
		echo true;
	}else{
		echo false;
	}
}
// edit joclerk job form request, requestor & cargo details-> update
if (isset($_POST['edit_req_cargo']) == "true") {
	$id = $_POST['requestno'];
	$msg = $controller->update_all();
	if ($msg == true) {
		echo true;
	}else{
		echo false;
	}
}
if (isset($_POST['joblistid'])) {
	$id = $_POST['joblistid'];
	$res = $controller->view_job($id);
	// echo $res;
	// echo $id;
}
if (isset($_POST['joblist']) == "true") {
	$res = $controller->joborderlist();
	echo json_encode($res);
}
if (isset($_GET['msg']) && $_GET['msg'] == "logout") {
	$user = $_GET['user'];
	$role = $_GET['role'];
	$controller->getLogout($user,$role);
}
if (isset($_POST['cancel_req'])) {
	$id = $_POST['cancel_req'];
	$res = $controller->cancel_req();
	echo $res;
}
if (isset($_POST['job_code'])) {
	$desc = $_POST['job_code'];
	$res = $controller->job_code_location($desc);
	echo $res;
}
// submit equipment
if (isset($_POST['eqpt_submit']) == "true") {
	$res = $controller->insert_eqpt();
	if ($res == "inserted") {
		echo "inserted";
	}else {
		echo "error";
	}
}
// update equipment
if (isset($_POST['eqpt_update']) == "true") {
	$res = $controller->update_eqpt();
	if ($res == "updated") {
		echo "updated";
	}else {
		echo "error";
	}
}
// delete equipment
if (isset($_POST['eqpt_del']) == "true") {
	$id = $_POST['id'];
	$res = $controller->eqpt_del($id);
	if ($res == "deleted") {
		echo "deleted";
	}else {
		echo "error";
	}
}
 ?>
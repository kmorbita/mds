<?php 
require("../../controller/TimekeeperController.php");
$controller = new TimekeeperController();
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
if (isset($_POST['emp_submit']) == "true") {
	$res = $controller->insertEmp();
	if ($res == "true") {
		echo "true";
	}else if ($res == "emp_id") {
		echo "emp_id";
	}else if ($res == "name") {
		echo "name";
	}else{
		echo false;
	}
}
if (isset($_POST['emp_update']) == "true") {
	$id = $_POST['mp_id_edit'];
	$res = $controller->update_emp($id);
	echo $res;
}

if (isset($_POST['emp_del']) == "true") {
	$id = $_POST['id'];
	$res = $controller->del_emp($id);
	if ($res) {
		echo true;
	}else if ($res == "existed") {
		echo true;
	}else{
		echo false;
	}
}
// check if date is already filled in
if (isset($_POST['date'])) {
	$date = $_POST['date'];
	$res = $controller->checkdate($date);
	if ($res == true) {
		echo "true";
	}else{
		echo "false";
	}
}
// edit attendance
if (isset($_POST['checked_attendance']) == "true") {
	$res = $controller->submit_attendance();
	if ($res == "updated") {
		echo "updated";
	}else if($res == "inserted"){
		echo "inserted";
	}else{
		return false;
	}
}
// submit new attendance
if (isset($_POST['add_new_attendance']) == "true") {
	$res = $controller->submit_new_attendance();
	if ($res == "existing") {
		echo "existing";
	}else if($res == "inserted"){
		echo "inserted";
	}else{
		return false;
	}
}
// change password
if (isset($_POST['changepass']) == "true") {
	$res = $controller->changepass();
	echo $res;
}
// submit new operator
// if (isset($_POST['optr_submit']) == "true") {
// 	$res = $controller->insert_optr();
// 	if ($res == "taken") {
// 		echo "taken";
// 	}else if ($res == "inserted") {
// 		echo "inserted";
// 	}else {
// 		echo "error";
// 	}
// }
// edit operator
// if (isset($_POST['optr_edit']) == "true") {
// 	$id = $_POST['id'];
// 	$res = $controller->edit_optr($id);
// 		echo json_encode($res);
// }
// // operator update
// if (isset($_POST['optr_update']) == "true") {
// 	$res = $controller->update_optr();
// 	if ($res == "updated") {
// 		echo "updated";
// 	}else if ($res == "existed") {
// 		echo "existed";
// 	}else {
// 		echo "error";
// 	}
// }
// // delete opertor
// if (isset($_POST['optr_del']) == "true") {
// 	$id = $_POST['id'];
// 	$res = $controller->delete_optr($id);
// 	if ($res == "deleted") {
// 		echo "deleted";
// 	}else {
// 		echo "error";
// 	}
// }
// submit equipment operator
if (isset($_POST['eo_submit']) == "true") {
	$res = $controller->submit_eo();
	if ($res == "inserted") {
		echo "inserted";
	}if ($res == "existed") {
		echo "existed";
	}else {
		echo "error";
	}
}
// edit equipment operator
if (isset($_POST['eo_update'])) {
	$res = $controller->update_eo();
	// if ($res == "updated") {
	// 	echo "updated";
	// }if ($res == "existed") {
	// 	echo "existed";
	// }else {
	// 	echo "error";
	// }
	echo $res;
}
// delete equipment operator
if (isset($_POST['eo_del']) == "true") {
	$id = $_POST['id'];
	$res = $controller->delete_eo($id);
	echo $res;
}
// manpower given req
if (isset($_POST['manpower_id'])) {
	$id = $_POST['manpower_id'];
	$res = $controller->mp_req($id);
	echo json_encode($res);
}
// request equipment operator
if (isset($_POST['equipment_id'])) {
	$res = $controller->toAssigned_optr();
	echo json_encode($res);
}
// add manpower personel to the request
if (isset($_POST['add_emp']) == "true") {
	$res = $controller->add_emp();
	echo $res;
}
// add manpower personel to the request
if (isset($_POST['add_emp_optr']) == "true") {
	$res = $controller->add_emp_optr();
	echo $res;
}
// reply 
if (isset($_POST['view_id'])) {
	$id = $_POST['view_id'];
	$res = $controller->view_message($id);
	echo $res;
}
// count new messages
if (isset($_POST['new_message']) == "true") {
	$id = $_POST['role'];
	$res = $controller->count_message($id);
	echo $res;
}
// reply message
if (isset($_POST['reply_msg']) == "true") {
	$id = $_POST['msg_id'];
	$res = $controller->reply_msg($id);
	echo $res;
}

// get messages
if (isset($_POST['role_msg'])) {
	$id = $_POST['role_msg'];
	$res = $controller->messages($id);
	echo json_encode($res);
}
// unassign employee
if (isset($_POST['assign'])) {
	$id = $_POST['assign'];
	$res = $controller->unassign($id);
	echo $res;
}
// adding new task
if (isset($_POST['submit_task']) == "true") {
	$res = $controller->new_task();
	echo $res;
}
// delete task
if (isset($_POST['del_task'])) {
	$id = $_POST['del_task'];
	$res = $controller->del_task($id);
	echo $res;
}
// update task
if (isset($_POST['update_task'])) {
	$id = $_POST['task_id'];
	$res = $controller->update_task($id);
	echo $res;
}
// delete messages
if (isset($_POST['delete_msg']) == "true") {
	$res = $controller->delete_msg();
	echo $res;
}
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
// delete msg
if (isset($_POST['del_msg'])) {
	$id = $_POST['del_msg'];
	$res = $controller->del_msg($id);
	echo $res;
}
// present
if (isset($_POST['present'])) {
	$id = $_POST['present'];
	$res = $controller->present($id);
	echo $res;
}
// no present
if (isset($_POST['no_present'])) {
	$id = $_POST['no_present'];
	$res = $controller->no_present($id);
	echo $res;
}
// personnel dispatch operator
if (isset($_POST['eqpt_dispatch'])) {
	$id = $_POST['eqpt_dispatch'];
	$res = $controller->eqpt_dispatch($id);
	echo $res;
}
// personnel dispatch operator
if (isset($_POST['eqpt_relieve'])) {
	$id = $_POST['eqpt_relieve'];
	$res = $controller->eqpt_relieve($id);
	echo $res;
}
// personnel dispatch operator
if (isset($_POST['eqpt_reject'])) {
	$id = $_POST['eqpt_reject'];
	$res = $controller->eqpt_reject($id);
	echo $res;
}
// personnel dispatch operator
if (isset($_POST['per_dispatch'])) {
	$id = $_POST['per_dispatch'];
	$res = $controller->per_dispatch($id);
	echo $res;
}
// personnel dispatch operator
if (isset($_POST['per_relieve'])) {
	$id = $_POST['per_relieve'];
	$res = $controller->per_relieve($id);
	echo $res;
}
// personnel dispatch operator
if (isset($_POST['per_reject'])) {
	$id = $_POST['per_reject'];
	$res = $controller->per_reject($id);
	echo $res;
}
// clear personnel job status
if (isset($_POST['clear_stat'])) {
	$id = $_POST['clear_stat'];
	$res = $controller->clear_stat($id);
	echo $res;
}
// employee assigned list
// if (isset($_POST['emp_assigned_list'])) {
// 	$res = $controller->employees_present();
// 	echo json_encode($res);
// }
// employee list relieve
if (isset($_POST['list_relieve'])) {
	$id = $_POST['list_relieve'];
	$res = $controller->list_relieve($id);
	echo $res;
}
if (isset($_POST['list_reject'])) {
	$id = $_POST['list_reject'];
	$res = $controller->list_reject($id);
	echo $res;
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
if (isset($_POST['relieve'])) {
	$id = $_POST['relieve'];
	$res = $controller->relieve($id);
	echo $res;
}
if (isset($_POST['reject'])) {
	$id = $_POST['reject'];
	$res = $controller->reject($id);
	echo $res;
}
if (isset($_POST['attendance_save'])) {
	$res = $controller->attendance_save();
	echo $res;
}
if (isset($_POST['update_attendance'])) {
	$res = $controller->update_attendance();
	echo $res;
}
if (isset($_POST['is_available'])) {
	$res = $controller->is_available();
	echo $res;
}
if (isset($_POST['del_attendance'])) {
	$res = $controller->del_attendance();
	echo $res;
}
if (isset($_POST['del_all_attendance'])) {
	$id = $_POST['del_all_attendance'];
	$res = $controller->del_all_attendance($id);
	echo $res;
}
if (isset($_POST['close_attendance'])) {
	$id = $_POST['close_attendance'];
	$res = $controller->close_attendance($id);
	echo $res;
}
?>

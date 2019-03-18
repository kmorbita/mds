<?php 
require("../../controller/SuperadminController.php");
$controller = new SuperadminController();
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
if (isset($_POST['mp_submit']) == "true") {
	$res = $controller->insertMp();
	if ($res == true) {
		echo true;
	}else{
		echo false;
	}
	// echo true;
}
if (isset($_POST['mp_del']) == "true") {
	$id = $_POST['id'];
	$res = $controller->del_mp($id);
	if ($res) {
		echo true;
	}else{
		echo false;
	}
}
if (isset($_POST['mp_edit']) == "true") {
	$id = $_POST['id'];
	$res = $controller->edit_mp($id);
	echo json_encode($res);
}
if (isset($_POST['mp_update']) == "true") {
	$id = $_POST['id_edit'];
	$res = $controller->update_mp($id);
	if ($res) {
		echo true;
	}else{
		echo false;
	}
}
// submit new user
if (isset($_POST['user_submit']) == "true") {
	$res = $controller->insertUser();
	echo $res;
}
if (isset($_POST['user_update']) == "true") {
	$id = $_POST['user_id'];
	$res = $controller->update_user($id);
	echo $res;
}
// user delete
if (isset($_POST['user_del']) == "true") {
	$id = $_POST['id'];
	$res = $controller->del_user($id);
	if ($res) {
		echo true;
	}else{
		echo false;
	}
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
// edit equipment
if (isset($_POST['eqpt_edit']) == "true") {
	$id = $_POST['id'];
	$res = $controller->edit_eqpt($id);
	echo json_encode($res);
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
// delete job request
if (isset($_POST['del_job'])) {
	$id = $_POST['del_job'];
	$res = $controller->del_job($id);
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
// manpower given req
if (isset($_POST['manpower_id'])) {
	$id = $_POST['manpower_id'];
	$res = $controller->mp_req($id);
	echo json_encode($res);
}
// request equipment operator
if (isset($_POST['equipment_id'])) {
	$id = $_POST['equipment_id'];
	$res = $controller->toAssigned_optr($id);
	echo json_encode($res);
}
// work startkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk
if (isset($_POST['per_work_start'])) {
	$id = $_POST['per_work_start'];
	$res = $controller->per_work_start($id);
	echo $res;
}
// work pause
if (isset($_POST['per_work_pause'])) {
	$id = $_POST['per_work_pause'];
	$res = $controller->per_work_pause($id);
	echo $res;
}
// work stop
if (isset($_POST['per_work_stop'])) {
	$id = $_POST['per_work_stop'];
	$res = $controller->per_work_stop($id);
	echo $res;
}
// work continue
if (isset($_POST['per_work_continue'])) {
	$id = $_POST['per_work_continue'];
	$res = $controller->per_work_continue($id);
	echo $res;
}
// work completed
if (isset($_POST['per_work_complete'])) {
	$id = $_POST['per_work_complete'];
	$res = $controller->per_work_complete($id);
	echo $res;
}
// add personnel task
if (isset($_POST['per_delete'])) {
	$id = $_POST['per_delete'];
	$res = $controller->per_delete($id);
	echo $res;
}
// work start
if (isset($_POST['optr_work_start'])) {
	$id = $_POST['optr_work_start'];
	$res = $controller->optr_work_start($id);
	echo $res;
}
// work pause
if (isset($_POST['optr_work_pause'])) {
	$id = $_POST['optr_work_pause'];
	$res = $controller->optr_work_pause($id);
	echo $res;
}
// work stop
if (isset($_POST['optr_work_stop'])) {
	$id = $_POST['optr_work_stop'];
	$res = $controller->optr_work_stop($id);
	echo $res;
}
// work continue
if (isset($_POST['optr_work_continue'])) {
	$id = $_POST['optr_work_continue'];
	$res = $controller->optr_work_continue($id);
	echo $res;
}
// work completed
if (isset($_POST['optr_work_complete'])) {
	$id = $_POST['optr_work_complete'];
	$res = $controller->optr_work_complete($id);
	echo $res;
}
// add personnel task
if (isset($_POST['optr_delete'])) {
	$id = $_POST['optr_delete'];
	$res = $controller->optr_delete($id);
	echo $res;
}
// add personnel task
if (isset($_POST['add_personnel_task']) == "true") {
	$res = $controller->add_personnel_task();
	echo $res;
}
// add personnel task
if (isset($_POST['add_operator_task']) == "true") {
	$res = $controller->add_operator_task();
	echo $res;
}
// relieved personnel
if (isset($_POST['optr_relieve'])) {
	$id = $_POST['optr_relieve'];
	$res = $controller->optr_relieve($id);
	echo $res;
}
if (isset($_POST['optr_reject'])) {
	$id = $_POST['optr_reject'];
	$res = $controller->optr_reject($id);
	echo $res;
}
if (isset($_POST['per_relieve'])) {
	$id = $_POST['per_relieve'];
	$res = $controller->per_relieve($id);
	echo $res;
}
if (isset($_POST['per_reject'])) {
	$id = $_POST['per_reject'];
	$res = $controller->per_reject($id);
	echo $res;
}
// task activity per job request timestamp
if (isset($_POST['per_task_work']) == "true") {
	$res = $controller->to_per_task_work();
	echo $res;
}
if (isset($_POST['per_task_stop']) == "true") {
	$res = $controller->to_per_task_stop();
	echo $res;
}
if (isset($_POST['per_task_complete']) == "true") {
	$res = $controller->to_per_task_complete();
	echo $res;
}
if (isset($_POST['per_task_resume']) == "true") {
	$res = $controller->to_per_task_resume();
	echo $res;
}
if (isset($_POST['per_task_pause']) == "true") {
	$res = $controller->to_per_task_pause();
	echo $res;
}
if (isset($_POST['optr_task_work']) == "true") {
	$res = $controller->to_optr_task_work();
	echo $res;
}
if (isset($_POST['optr_task_pause']) == "true") {
	$res = $controller->to_optr_task_pause();
	echo $res;
}
if (isset($_POST['optr_task_stop']) == "true") {
	$res = $controller->to_optr_task_stop();
	echo $res;
}
if (isset($_POST['optr_task_complete']) == "true") {
	$res = $controller->to_optr_task_complete();
	echo $res;
}
if (isset($_POST['optr_task_resume']) == "true") {
	$res = $controller->to_optr_task_resume();
	echo $res;
}
// add task in activity
if (isset($_POST['add_personnel']) == "true") {
	$res = $controller->add_personnel();
	echo $res;
}
if (isset($_POST['add_operator']) == "true") {
	$res = $controller->add_operator();
	echo $res;
}
// delete task
if (isset($_POST['del_task'])) {
	$id = $_POST['del_task'];
	$res = $controller->del_task($id);
	echo $res;
}
// adding new task
if (isset($_POST['submit_task']) == "true") {
	$res = $controller->new_task();
	echo $res;
}
// update task
if (isset($_POST['update_task'])) {
	$id = $_POST['task_id'];
	$res = $controller->update_task($id);
	echo $res;
}
// newsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss
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
if (isset($_POST['del_mp2'])) {
	$id = $_POST['del_mp2'];
	$del = $controller->del_mp2($id);
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
	$msg = $controller->insert_eqpt2();
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
if (isset($_POST['job_activty_edit'])) {
	$id = $_POST['job_activty_edit'];
	$res = $controller->job_activty_edit($id);
	echo json_encode($res);
}
// update job activity
if (isset($_POST['job_activty_update']) == "true") {
	$res = $controller->job_activty_update();
	echo $res;
}
// personnel activity
// if (isset($_POST['personnel_activity'])) {
// 	$id = $_POST['personnel_activity'];
// 	$res = $controller->personnel_activity($id);
// 	echo json_encode($res);
// }
// personnel activity
// if (isset($_POST['operator_activity'])) {
// 	$id = $_POST['operator_activity'];
// 	$res = $controller->operator_activity($id);
// 	echo json_encode($res);
// }
if (isset($_POST['edit_box'])) {
	$id = $_POST['edit_box'];
	$res = $controller->edit_box($id);
	echo json_encode($res);
}
if (isset($_POST['edit_weight'])) {
	$id = $_POST['edit_weight'];
	$res = $controller->edit_weight($id);
	echo json_encode($res);
}
// operator activity 
if (isset($_POST['edit_optr_activity'])) {
	$id = $_POST['edit_optr_activity'];
	$res = $controller->edit_optr_activity($id);
	echo json_encode($res);
}
// personnel activity
if (isset($_POST['edit_per_activity'])) {
	$id = $_POST['edit_per_activity'];
	$res = $controller->edit_per_activity($id);
	echo json_encode($res);
}
// operator activity
if (isset($_POST['update_optr_activity'])) {
	$res = $controller->update_optr_activity();
	echo $res;
}
// personnel activity
if (isset($_POST['update_per_activity'])) {
	$res = $controller->update_per_activity();
	echo $res;
}
// status submit
if (isset($_POST['submit_status']) == "true") {
	$res = $controller->submit_status();
	echo $res;
}


if (isset($_POST['per_task_del'])) {
	$id = $_POST['per_task_del'];
	$res = $controller->per_task_del($id);
	echo $res;
}
if (isset($_POST['eqpt_task_del'])) {
	$id = $_POST['eqpt_task_del'];
	$res = $controller->eqpt_task_del($id);
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
// assign foreman to joborder request
if (isset($_POST['assign_foreman']) == "true") {
	$assign = $controller->assign_foreman();
	if ($assign == "assigned") {
		echo "assigned";
	}else {
		echo "error";
	}
}
if (isset($_POST['del_log'])) {
	$id = $_POST['del_log'];
	$res = $controller->del_log($id);
	echo $res;
}
if (isset($_POST['job_code'])) {
	$desc = $_POST['job_code'];
	$res = $controller->job_code_location($desc);
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
if (isset($_POST['edit_job_time'])) {
	$id = $_POST['edit_job_time'];
	$res = $controller->edit_job_time($id);
	echo json_encode($res);
}
if (isset($_POST['delete_job_time'])) {
	$id = $_POST['delete_job_time'];
	$res = $controller->delete_job_time($id);
	echo $res;
}
if (isset($_POST['update_job_timestamp'])) {
	$res = $controller->update_job_timestamp();
	echo $res;
}
if (isset($_POST['edit_job_per_time'])) {
	$id = $_POST['edit_job_per_time'];
	$res = $controller->edit_job_per_time($id);
	echo json_encode($res);
}
if (isset($_POST['edit_job_optr_time'])) {
	$id = $_POST['edit_job_optr_time'];
	$res = $controller->edit_job_optr_time($id);
	echo json_encode($res);
}
if (isset($_POST['update_job_per_timestamp'])) {
	$res = $controller->update_job_per_timestamp();
	echo $res;
}
if (isset($_POST['update_eqpt_timestamp'])) {
	$res = $controller->update_eqpt_timestamp();
	echo $res;
}
if (isset($_POST['update_job_optr_timestamp'])) {
	$res = $controller->update_job_optr_timestamp();
	echo $res;
}
if (isset($_POST['delete_job_per_time'])) {
	$id = $_POST['delete_job_per_time'];
	$res = $controller->delete_job_per_time($id);
	echo $res;
}
if (isset($_POST['delete_job_optr_time'])) {
	$id = $_POST['delete_job_optr_time'];
	$res = $controller->delete_job_optr_time($id);
	echo $res;
}
if (isset($_POST['edit_per_task_time'])) {
	$id = $_POST['edit_per_task_time'];
	$res = $controller->edit_per_task_time($id);
	echo json_encode($res);
}
if (isset($_POST['edit_optr_task_time'])) {
	$id = $_POST['edit_optr_task_time'];
	$res = $controller->edit_optr_task_time($id);
	echo json_encode($res);
}
if (isset($_POST['update_per_task_timestamp'])) {
	$res = $controller->update_per_task_timestamp();
	echo $res;
}
if (isset($_POST['update_optr_task_timestamp'])) {
	$res = $controller->update_optr_task_timestamp();
	echo $res;
}
if (isset($_POST['delete_per_task_time'])) {
	$id = $_POST['delete_per_task_time'];
	$res = $controller->delete_per_task_time($id);
	echo $res;
}
if (isset($_POST['delete_optr_task_time'])) {
	$id = $_POST['delete_optr_task_time'];
	$res = $controller->delete_optr_task_time($id);
	echo $res;
}
if (isset($_POST['insert_job_timestamp'])) {
	$res = $controller->insert_job_timestamp();
	echo $res;
}
if (isset($_POST['insert_optr_timestamp'])) {
	$res = $controller->insert_optr_timestamp();
	echo $res;
}
if (isset($_POST['insert_eqpt_timestamp'])) {
	$res = $controller->insert_eqpt_timestamp();
	echo $res;
}
if (isset($_POST['insert_per_timestamp'])) {
	$res = $controller->insert_per_timestamp();
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
if (isset($_POST['del_giv_eqpt'])) {
	$id = $_POST['del_giv_eqpt'];
	$res = $controller->del_giv_eqpt($id);
	echo ($res);
}
if (isset($_POST['del_giv_mp'])) {
	$id = $_POST['del_giv_mp'];
	$res = $controller->del_giv_mp($id);
	echo ($res);
}
if (isset($_POST['eq_work'])) {
	$id = $_POST['id'];
	$res = $controller->eq_work($id);
	echo $res;
}
if (isset($_POST['eq_pause'])) {
	$id = $_POST['id'];
	$res = $controller->eq_pause($id);
	echo $res;
}
if (isset($_POST['eq_stop'])) {
	$id = $_POST['id'];
	$res = $controller->eq_stop($id);
	echo $res;
}
if (isset($_POST['eq_complete'])) {
	$id = $_POST['id'];
	$res = $controller->eq_complete($id);
	echo $res;
}
if (isset($_POST['eq_resume'])) {
	$id = $_POST['id'];
	$res = $controller->eq_resume($id);
	echo $res;
}
if (isset($_POST['equipment_act'])) {
	$id = $_POST['equipment_act'];
	$res = $controller->equipment_act($id);
	echo json_encode($res);
}
if (isset($_POST['edit_equip_time'])) {
	$id = $_POST['edit_equip_time'];
	$res = $controller->edit_equip_time($id);
	echo json_encode($res);
}
if (isset($_POST['delete_equip_time'])) {
	$id = $_POST['delete_equip_time'];
	$res = $controller->delete_equip_time($id);
	echo $res;
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
if (isset($_POST['update_box'])) {
	$res = $controller->update_box();
	echo $res;
}
if (isset($_POST['submit_box'])) {
	$res = $controller->submit_box();
	echo $res;
}
if (isset($_POST['update_weight'])) {
	$res = $controller->update_weight();
	echo $res;
}
if (isset($_POST['submit_weight'])) {
	$res = $controller->submit_weight();
	echo $res;
}
if (isset($_POST['del_box'])) {
	$id = $_POST['del_box'];
	$res = $controller->del_box($id);
	echo $res;
}
if (isset($_POST['del_weight'])) {
	$id = $_POST['del_weight'];
	$res = $controller->del_weight($id);
	echo $res;
}
if (isset($_POST['add_equipment'])) {
	$res = $controller->add_equipment();
	echo $res;
}
if (isset($_POST['eq_relieve'])) {
	$res = $controller->eq_relieve();
	echo $res;
}
if (isset($_POST['eq_delete'])) {
	$id = $_POST['eq_delete'];
	$res = $controller->eq_delete($id);
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
if (isset($_POST['open_attendance'])) {
	$id = $_POST['open_attendance'];
	$res = $controller->open_attendance($id);
	echo $res;
}
if (isset($_POST['submit_eqpt_type'])) {
	$res = $controller->submit_eqpt_type();
	echo $res;
}
if (isset($_POST['update_eqpt_type'])) {
	$res = $controller->toupdate_eqpt_type();
	echo $res;
}
if (isset($_POST['edit_type'])) {
	$id = $_POST['edit_type'];
	$res = $controller->edit_type($id);
	echo json_encode($res);
}
if (isset($_POST['del_type'])) {
	$id = $_POST['del_type'];
	$res = $controller->del_type($id);
	echo $res;
}


if (isset($_POST['fill_eqpt_needed'])) {
	$res = $controller->fill_eqpt_needed();
	echo json_encode($res);
}
if (isset($_POST['add_equipment_needed'])) {
	$res = $controller->add_equipment_needed();
	echo $res;
}

?>
<?php 
require("../../controller/ForemanController.php");
$controller = new ForemanController();
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
// foreman work an job request
if (isset($_POST['working_id'])) {
	$id = $_POST['working_id'];
	$res = $controller->working($id);
	echo $res;
}
// foreman work an job request
// if (isset($_POST['stop_id'])) {
// 	$id = $_POST['stop_id'];
// 	$res = $controller->stop($id);
// 	echo $res;
// }

// notify timekeeper in equipments
if (isset($_POST['notify_eq_given']) == "true") {
	$res = $controller->notify_eq_given();
	echo $res;
}
// view reply 
if (isset($_POST['view_id'])) {
	$id = $_POST['view_id'];
	$res = $controller->view_message($id);
	echo $res;
}
// count new messages
if (isset($_POST['new_message']) == "true") {
	$user = $_POST['username'];
	$res = $controller->count_message($user);
	echo $res;
}
// get new message
if (isset($_POST['username_session'])) {
	$user = $_POST['username_session'];
	$res = $controller->messages($user);
	echo json_encode($res);
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
// get jobs
if (isset($_POST['joblist'])) {
	$id = $_POST['joblist'];
	$res = $controller->joborderlist($id);
	echo json_encode($res);
}
// search job
// if (isset($_POST['working_jobs'])) {
// 	$id = $_POST['user_id'];
// 	$res = $controller->working_jobs($id);
// 	echo json_encode($res);
// }
if (isset($_POST['working_jobs2'])) {
	$id = $_POST['user_id'];
	$res = $controller->working_jobs($id);
	echo json_encode($res);
}
// delete msg
if (isset($_POST['del_msg'])) {
	$id = $_POST['del_msg'];
	$res = $controller->del_msg($id);
	echo $res;
}
// work start
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
if (isset($_POST['add_personnel_task']) == "true") {
	$res = $controller->add_personnel_task();
	echo $res;
}
// add personnel task
if (isset($_POST['add_operator_task']) == "true") {
	$res = $controller->add_operator_task();
	echo $res;
}
// add personnel task
if (isset($_POST['optr_delete'])) {
	$id = $_POST['optr_delete'];
	$res = $controller->optr_delete($id);
	echo $res;
}
// add personnel task
if (isset($_POST['per_delete'])) {
	$id = $_POST['per_delete'];
	$res = $controller->per_delete($id);
	echo $res;
}
// cancel req
if (isset($_POST['cancel_req'])) {
	$res = $controller->cancel_req();
	echo $res;
}
// stop req
if (isset($_POST['stop_req'])) {
	$res = $controller->stop_req();
	echo $res;
}
// resume_req req
if (isset($_POST['resume_req'])) {
	$res = $controller->resume_req();
	echo $res;
}
// pause_req req
if (isset($_POST['pause_req'])) {
	$res = $controller->pause_req();
	echo $res;
}
// complete req
if (isset($_POST['complete_req']) == "true") {
	$res = $controller->complete_req();
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
// status submit
if (isset($_POST['submit_status']) == "true") {
	$res = $controller->submit_status();
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
// // personnel dispatch operator
// if (isset($_POST['per_relieve'])) {
// 	$id = $_POST['per_relieve'];
// 	$res = $controller->per_relieve($id);
// 	echo $res;
// }
// personnel dispatch operator
// if (isset($_POST['per_reject'])) {
// 	$id = $_POST['per_reject'];
// 	$res = $controller->per_reject($id);
// 	echo $res;
// }
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
if (isset($_POST['optr_task_pause']) == "true") {
	$res = $controller->to_optr_task_pause();
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
if (isset($_POST['job_status'])) {
	$id = $_POST['job_status'];
	$res = $controller->tojob_status($id);
	echo $res;
}
if (isset($_POST['select_job'])) {
	$id = $_POST['user_id'];
	$res = $controller->select_job($id);
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
if (isset($_POST['per_task_act'])) {
	$req = $_POST['req'];
	$task = $_POST['task'];
	$res = $controller->per_task_act($req,$task);
	echo json_encode($res);
}
if (isset($_POST['optr_task_act'])) {
	$req = $_POST['req'];
	$task = $_POST['task'];
	$res = $controller->optr_task_act($req,$task);
	echo json_encode($res);
}
if (isset($_POST['per_task'])) {
	$id = $_POST['per_task'];
	$res = $controller->personnel_table_task($id);
	echo json_encode($res);
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
if (isset($_POST['emp_update']) == "true") {
	$id = $_POST['mp_id_edit'];
	$res = $controller->update_emp($id);
	echo $res;
}
// new
if (isset($_POST['add_equipment'])) {
	$res = $controller->add_equipment();
	echo $res;
}
if (isset($_POST['eq_delete'])) {
	$id = $_POST['eq_delete'];
	$res = $controller->eq_delete($id);
	echo $res;
}
if (isset($_POST['eq_relieve'])) {
	$res = $controller->eq_relieve();
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
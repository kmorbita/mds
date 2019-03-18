<?php 
require_once("../../model/ForemanModel.php");
class ForemanController
{
	protected $data;

	public function __construct()
	{
		$this->data = new ForemanModel();
	}
	public function joborderlist($id)
	{
		$res = $this->data->get_Job_order_list($id);
		return $res;
	}
	public function view_job($id)
	{
		$res = $this->data->get_job_to_view($id);
		return $res;
	}
	public function getLogout($user,$role)
	{
		$res = $this->data->Logout($user,$role);
		if ($res == true) {
			header("Location: ../../index.php");
		}
	}
	public function current_pass($username,$id)
	{
		$res = $this->data->getcurrent_pass($username,$id);
		return $res;
	}
	public function changepass()
	{
		$res = $this->data->toChangepass();
		return $res;
	}
	public function working($id)
	{
		$res = $this->data->toWork($id);
		return $res;
	}
	public function activity($id)
	{
		$res = $this->data->toActivity($id);
		return $res;
	}
	public function personnel($id)
	{
		$res = $this->data->toPersonnel($id);
		return $res;
	}
		// public function equipment_given($id)
		// {
		// 	$res = $this->data->equipment_given($id);
		// 	return $res;
		// }
	public function all_operator($id)
	{
		$res = $this->data->all_operator($id);
		return $res;
	}
	public function all_gang($id)
	{
		$res = $this->data->all_gang($id);
		return $res;
	}
	public function notify_eq_given()
	{
		$res = $this->data->toNotify_eq_given();
		return $res;
	}
	public function messages($msg)
	{
		$res = $this->data->getMessages($msg);
		return $res;
	}
	public function view_message($id)
	{
		$res = $this->data->toViewmessages($id);
		return $res;
	}
	public function count_message($user)
	{
		$res = $this->data->toCount_message($user);
		return $res;
	}
	// public function personnel_task($id)
	// {
	// 	$res = $this->data->getPersonnel_task($id);
	// 	return $res;
	// }
	// public function equipment_task($id)
	// {
	// 	$res = $this->data->getequipment_task($id);
	// 	return $res;
	// }
	public function add_personnel()
	{
		$res = $this->data->toAdd_personnel();
		return $res;
	}
	public function add_operator()
	{
		$res = $this->data->toAdd_operator();
		return $res;
	}
	// public function personnel_task_data($id)
	// {
	// 	$res = $this->data->getpersonnel_task_data($id);
	// 	return $res;
	// }
	// public function equipment_task_data($id)
	// {
	// 	$res = $this->data->getequipment_task_data($id);
	// 	return $res;
	// }
	public function working_jobs($id)
	{
		$res = $this->data->toworking_jobs($id);
		return $res;
	}
	public function del_msg($id)
	{
		$res = $this->data->toDel_msg($id);
		return $res;
	}
	// public function personnel_table_task($id)
	// {
	// 	$res = $this->data->personnel_table_task($id);
	// 	return $res;
	// }
	// public function equipment_table_task($id)
	// {
	// 	$res = $this->data->equipment_table_task($id);
	// 	return $res;
	// }
	public function per_work_start($id)
	{
		$res = $this->data->per_work_start($id);
		return $res;
	}
	public function per_work_pause($id)
	{
		$res = $this->data->per_work_pause($id);
		return $res;
	}
	public function per_work_stop($id)
	{
		$res = $this->data->per_work_stop($id);
		return $res;
	}
	public function per_work_continue($id)
	{
		$res = $this->data->per_work_continue($id);
		return $res;
	}
	public function per_work_complete($id)
	{
		$res = $this->data->per_work_complete($id);
		return $res;
	}
	public function optr_work_start($id)
	{
		$res = $this->data->optr_work_start($id);
		return $res;
	}
	public function optr_work_pause($id)
	{
		$res = $this->data->optr_work_pause($id);
		return $res;
	}
	public function optr_work_stop($id)
	{
		$res = $this->data->optr_work_stop($id);
		return $res;
	}
	public function optr_work_continue($id)
	{
		$res = $this->data->optr_work_continue($id);
		return $res;
	}
	public function optr_work_complete($id)
	{
		$res = $this->data->optr_work_complete($id);
		return $res;
	}
	public function add_personnel_task()
	{
		$res = $this->data->toAdd_personnel_task();
		return $res;
	}
	public function add_operator_task()
	{
		$res = $this->data->toAdd_operator_task();
		return $res;
	}
	public function personnel_task_added($id)
	{
		$res = $this->data->toPersonnel_task_added($id);
		return $res;
	}
	public function operator_task_added($id)
	{
		$res = $this->data->toOperator_task_added($id);
		return $res;
	}
	public function optr_delete($id)
	{
		$res = $this->data->toOptr_delete($id);
		return $res;
	}
	public function per_delete($id)
	{
		$res = $this->data->toPer_delete($id);
		return $res;
	}
	public function cancel_req()
	{
		$res = $this->data->toCancel_req();
		return $res;
	}
	public function stop_req()
	{
		$res = $this->data->toStop_req();
		return $res;
	}
	public function complete_req()
	{
		$res = $this->data->toComplete_req();
		return $res;
	}
	public function optr_relieve($id)
	{
		$res = $this->data->toOptr_relieve($id);
		return $res;
	}
	public function optr_reject($id)
	{
		$res = $this->data->toOptr_reject($id);
		return $res;
	}
		// public function per_relieve($id)
		// {
		// 	$res = $this->data->toPer_relieve($id);
		// 	return $res;
		// }
		// public function per_reject($id)
		// {
		// 	$res = $this->data->toPer_reject($id);
		// 	return $res;
		// }
	public function job_description($id)
	{
		$res = $this->data->getJob_description($id);
		return $res;
	}
	public function job_status($id)
	{
		$res = $this->data->getJob_status($id);
		return $res;
	}
	public function assigned_emp()
	{
		$res = $this->data->getAssigned_emp();
		return $res;
	}
	public function resume_req()
	{
		$res = $this->data->toResume_req();
		return $res;
	}
	public function pause_req()
	{
		$res = $this->data->toPause_req();
		return $res;
	}
	public function submit_status()
	{
		$res = $this->data->toSubmit_status();
		return $res;
	}
	public function job_equipment($id)
	{
		$res = $this->data->get_job_equipment($id);
		return $res;
	}
	public function job_manpower($id)
	{
		$res = $this->data->get_job_manpower($id);
		return $res;
	}
	public function manpower_given($id)
	{
		$res = $this->data->toManpower_given($id);
		return $res;
	}
	public function equipment_given($id)
	{
		$res = $this->data->equipment_given($id);
		return $res;
	}
		// ssssssssssssssssssssss
	public function add_emp()
	{
		$res = $this->data->toAdd_emp();
		return $res;
	}
	public function add_emp_optr()
	{
		$res = $this->data->toAdd_emp_optr();
		return $res;
	}
	public function mp_req($id)
	{
		$res = $this->data->get_mp_req($id);
		return $res;
	}
	public function toAssigned_optr($id)
	{
		$res = $this->data->toAssigned_optr($id);
		return $res;
	}
	public function eqpt_dispatch($id)
	{
		$res = $this->data->toEqpt_dispatch($id);
		return $res;
	}
	public function eqpt_relieve($id)
	{
		$res = $this->data->toEqpt_relieve($id);
		return $res;
	}
	public function eqpt_reject($id)
	{
		$res = $this->data->toEqpt_reject($id);
		return $res;
	}
	public function per_dispatch($id)
	{
		$res = $this->data->toPer_dispatch($id);
		return $res;
	}
	public function per_relieve($id)
	{
		$res = $this->data->toPer_relieve($id);
		return $res;
	}
	public function per_reject($id)
	{
		$res = $this->data->toPer_reject($id);
		return $res;
	}
	// public function task($id)
	// {
	// 	$res = $this->data->getTask($id);
	// 	return $res;
	// }
	// public function new_task()
	// {
	// 	$res = $this->data->insert_task();
	// 	return $res;
	// }
	// public function del_task($id)
	// {
	// 	$res = $this->data->delete_task($id);
	// 	return $res;
	// }
	// public function edit_task($id)
	// {
	// 	$res = $this->data->toEdit_task($id);
	// 	return $res;
	// }
	// public function update_task($id)
	// {
	// 	$res = $this->data->toUpdate_task($id);
	// 	return $res;
	// }
		// task activity per job request 
	// public function to_per_task_work()
	// {
	// 	$res = $this->data->to_per_task_work();
	// 	return $res;
	// }
	// public function to_per_task_stop()
	// {
	// 	$res = $this->data->to_per_task_stop();
	// 	return $res;
	// }
	// public function to_per_task_complete()
	// {
	// 	$res = $this->data->to_per_task_complete();
	// 	return $res;
	// }
	// public function to_per_task_resume()
	// {
	// 	$res = $this->data->to_per_task_resume();
	// 	return $res;
	// }
	// public function to_per_task_pause()
	// {
	// 	$res = $this->data->to_per_task_pause();
	// 	return $res;
	// }


	// public function to_optr_task_work()
	// {
	// 	$res = $this->data->to_optr_task_work();
	// 	return $res;
	// }
	// public function to_optr_task_stop()
	// {
	// 	$res = $this->data->to_optr_task_stop();
	// 	return $res;
	// }
	// public function to_optr_task_complete()
	// {
	// 	$res = $this->data->to_optr_task_complete();
	// 	return $res;
	// }
	// public function to_optr_task_resume()
	// {
	// 	$res = $this->data->to_optr_task_resume();
	// 	return $res;
	// }
	// public function to_optr_task_pause()
	// {
	// 	$res = $this->data->to_optr_task_pause();
	// 	return $res;
	// }
	public function manpower()
	{
		$res = $this->data->get_manpower();
		return $res;
	}
	// public function per_task_del($id)
	// {
	// 	$res = $this->data->to_per_task_del($id);
	// 	return $res;
	// }
	// public function eqpt_task_del($id)
	// {
	// 	$res = $this->data->to_eqpt_task_del($id);
	// 	return $res;
	// }
	public function tojob_status($id)
	{
		$res = $this->data->job_status($id);
		return $res;
	}
	public function select_job($id)
	{
		$res = $this->data->toselect_job($id);
		return $res;
	}
	public function job_timestamp($id)
	{
		$res = $this->data->tojob_timestamp($id);
		return $res;
	}
	public function operator_act($id)
	{
		$res = $this->data->tooperator_act($id);
		return $res;
	}
	public function personnel_act($id)
	{
		$res = $this->data->topersonnel_act($id);
		return $res;
	}
	public function equipment_act($id)
	{
		$res = $this->data->toequipment_act($id);
		return $res;
	}
	// public function job_per_task($id)
	// {
	// 	$res = $this->data->toJob_per_task($id);
	// 	return $res;
	// }
	// public function job_optr_task($id)
	// {
	// 	$res = $this->data->toJob_optr_task($id);
	// 	return $res;
	// }
	// public function per_task_act($req,$task)
	// {
	// 	$res = $this->data->toper_task_act($req,$task);
	// 	return $res;
	// }
	// public function optr_task_act($req,$task)
	// {
	// 	$res = $this->data->tooptr_task_act($req,$task);
	// 	return $res;
	// }
	public function del_giv_eqpt($id)
	{
		$res = $this->data->todel_giv_eqpt($id);
		return $res;
	}
	public function del_giv_mp($id)
	{
		$res = $this->data->todel_giv_mp($id);
		return $res;
	}
	public function job_eqpt_list($id)
	{
		$res = $this->data->tojob_eqpt_list($id);
		return $res;
	}
	public function eq_work($id)
	{
		$res = $this->data->toeq_work($id);
		return $res;
	}
	public function eq_pause($id)
	{
		$res = $this->data->toeq_pause($id);
		return $res;
	}
	public function eq_stop($id)
	{
		$res = $this->data->toeq_stop($id);
		return $res;
	}
	public function eq_complete($id)
	{
		$res = $this->data->toeq_complete($id);
		return $res;
	}
	public function eq_resume($id)
	{
		$res = $this->data->toeq_resume($id);
		return $res;
	}
	public function job_equipment_expo($id)
	{
		$res = $this->data->tojob_equipment($id);
		return $res;
	}
	public function employees()
	{
		$res = $this->data->getEmployees();
		return $res;
	}
	public function edit_emp($id)
	{
		$res = $this->data->toEdit_emp($id);
		return $res;
	}
	public function update_emp($id)
	{
		$res = $this->data->toUpdate_emp($id);
		return $res;
	}
	public function equipment_list()
	{
		$res = $this->data->get_equipment_list();
		return $res;
	}
	public function add_equipment()
	{
		$res = $this->data->toadd_equipment();
		return $res;
	}
	public function eq_relieve()
	{
		$res = $this->data->toeq_relieve();
		return $res;
	}
	public function eq_delete($id)
	{
		$res = $this->data->toeq_delete($id);
		return $res;
	}
	public function equipment_needed_list($id)
	{
		$res = $this->data->toequipment_needed_list($id);
		return $res;
	}
	public function fill_eqpt_needed()
	{
		$res = $this->data->tofill_eqpt_needed();
		return $res;
	}
	public function add_equipment_needed()
	{
		$res = $this->data->toadd_equipment_needed();
		return $res;
	}
}



?>
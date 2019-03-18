<?php 
require_once("../../model/SuperadminModel.php");
class SuperadminController
{
	protected $data;

	public function __construct()
	{
		$this->data = new SuperadminModel();
	}
	public function joborderlist()
	{
		$res = $this->data->get_Job_order_list();
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
	public function insertMp()
	{
		$res = $this->data->toInsertmp();
		return $res;
	}
	public function manpower()
	{
		$res = $this->data->getManpower();
		return $res;
	}
	public function del_mp($id)
	{
		$res = $this->data->toDel_mp($id);
		return $res;
	}
	public function edit_mp($id)
	{
		$res = $this->data->toEdit_mp($id);
		return $res;
	}
	public function update_mp($id)
	{
		$res = $this->data->toUpdate_mp($id);
		return $res;
	}
	public function users()
	{
		$res = $this->data->getusers();
		return $res;
	}
	public function role()
	{
		$res = $this->data->getRole();
		return $res;
	}
	public function insertUser()
	{
		$res = $this->data->toInsertuser();
		return $res;
	}
	public function edit_user($id)
	{
		$res = $this->data->toEdit_user($id);
		return $res;
	}
	public function update_user($id)
	{
		$res = $this->data->toUpdate_user($id);
		return $res;
	}
	public function del_user($id)
	{
		$res = $this->data->toDel_user($id);
		return $res;
	}
	public function get_attendance($date)
	{
		$res = $this->data->toGet_attendance($date);
		return $res;
	}
	public function equipment()
	{
		$res = $this->data->get_equipment();
		return $res;
	}
	public function equipment2()
	{
		$res = $this->data->get_equipment2();
		return $res;
	}
	public function equipment_list()
	{
		$res = $this->data->get_equipment_list();
		return $res;
	}
	public function insert_eqpt()
	{
		$res = $this->data->toInsert_eqpt();
		return $res;
	}
	public function edit_eqpt($id)
	{
		$res = $this->data->toEdit_eqpt($id);
		return $res;
	}
	public function update_eqpt()
	{
		$res = $this->data->toUpdate_eqpt();
		return $res;
	}
	public function eqpt_del($id)
	{
		$res = $this->data->toEqpt_del($id);
		return $res;
	}
	public function del_job($id)
	{
		$res = $this->data->toDel_job($id);
		return $res;
	}
	public function search_data()
	{
		$res = $this->data->toSearch_data();
		return $res;
	}
	public function job_status($id)
	{
		$res = $this->data->getJob_status($id);
		return $res;
	}
	public function personnel($id)
	{
		$res = $this->data->toPersonnel($id);
		return $res;
	}
	public function equipment_given($id)
	{
		$res = $this->data->equipment_given($id);
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
	// public function task($id)
	// {
	// 	$res = $this->data->getTask($id);
	// 	return $res;
	// }
	public function job_description($id)
	{
		$res = $this->data->getJob_description($id);
		return $res;
	}
	public function activity($id)
	{
		$res = $this->data->toActivity($id);
		return $res;
	}
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
		// llllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllllll
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
	public function per_delete($id)
	{
		$res = $this->data->toPer_delete($id);
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
	public function optr_delete($id)
	{
		$res = $this->data->toOptr_delete($id);
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
	// public function to_optr_task_pause()
	// {
	// 	$res = $this->data->to_optr_task_pause();
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
	// public function add_personnel()
	// {
	// 	$res = $this->data->toAdd_personnel();
	// 	return $res;
	// }
	// public function add_operator()
	// {
	// 	$res = $this->data->toAdd_operator();
	// 	return $res;
	// }
	// public function del_task($id)
	// {
	// 	$res = $this->data->delete_task($id);
	// 	return $res;
	// }
	// public function new_task()
	// {
	// 	$res = $this->data->insert_task();
	// 	return $res;
	// }
	// public function update_task($id)
	// {
	// 	$res = $this->data->toUpdate_task($id);
	// 	return $res;
	// }
	public function insert()
	{
		$insert = $this->data->toInsert();
		return $insert;
	}
	public function del_eqpt($id)
	{
		$res = $this->data->delete_eqpt($id);
		return $res;
	}
	public function del_mp2($id)
	{
		$res = $this->data->delete_mp($id);
		return $res;
	}
		// edit ,submit new commodity
	public function insert_comm()
	{
		$res = $this->data->toInsert_comm();
		if ($res == true) {
			return true;
		}else{
			return false;
		}
	}
		// edit ,submit new equipment
	public function insert_eqpt2()
	{
		$res = $this->data->toInsert_eqpt2();
		return $res;
	}
	public function insert_mp()
	{
		$res = $this->data->toInsert_mp();
		if ($res == true) {
			return true;
		}else{
			return false;
		}
	}
	public function update_all()
	{
		$res = $this->data->toUpdate_all();
		if ($res == true) {
			return true;
		}else{
			return false;
		}
	}
	public function reqno()
	{
		$reqno = $this->data->toReqno();
		return $reqno;
	}
	public function job_activty_edit($id)
	{
		$res = $this->data->get_job_activty_edit($id);
		return $res;
	}
	public function job_activty_update()
	{
		$res = $this->data->job_activty_update();
		return $res;
	}
	// public function personnel_activity($id)
	// {
	// 	$res = $this->data->toPersonnel_activity($id);
	// 	return $res;
	// }
	// public function operator_activity($id)
	// {
	// 	$res = $this->data->toOperator_activity($id);
	// 	return $res;
	// }
	public function edit_optr_activity($id)
	{
		$res = $this->data->to_edit_optr_activity($id);
		return $res;
	}
	public function edit_per_activity($id)
	{
		$res = $this->data->to_edit_per_activity($id);
		return $res;
	}
	public function update_optr_activity()
	{
		$res = $this->data->to_update_optr_activity();
		return $res;
	}
	public function update_per_activity()
	{
		$res = $this->data->to_update_per_activity();
		return $res;
	}
	public function submit_status()
	{
		$res = $this->data->toSubmit_status();
		return $res;
	}
	public function edit($id)
	{
		$res = $this->data->toEdit($id);
		return $res;
	}
	public function editcargo($id)
	{
		$res = $this->data->toEditcargo($id);
		return $res;
	}
	public function editcomm($id)
	{
		$res = $this->data->toEditcomm($id);
		return $res;
	}
	public function editeqpt($id)
	{
		$res = $this->data->toEditeqpt($id);
		return $res;
	}
	public function editmp($id)
	{
		$res = $this->data->toEditmp($id);
		return $res;
	}
	public function del_comm($id)
	{
		$res = $this->data->delete_comm($id);
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
	public function present($id)
	{
		$res = $this->data->toPresent($id);
		return $res;
	}
	public function no_present($id)
	{
		$res = $this->data->toNo_present($id);
		return $res;
	}
	public function del_emp($id)
	{
		$res = $this->data->toDel_emp($id);
		return $res;
	}
	public function insertEmp()
	{
		$res = $this->data->toInsertEmp();
		return $res;
	}
	public function update_emp($id)
	{
		$res = $this->data->toUpdate_emp($id);
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
	public function foreman()
	{
		$res = $this->data->getForeman();
		return $res;
	}
	public function assign_foreman()
	{
		$res = $this->data->toAssign_foreman();
		return $res;
	}
	public function job_toexpo($id)
	{
		$res = $this->data->toJob_toexpo($id);
		return $res;
	}
	public function job_per_act_toexpo($id)
	{
		$res = $this->data->toJob_per_act_toexpo($id);
		return $res;
	}
	public function job_optr_act_toexpo($id)
	{
		$res = $this->data->toJob_optr_act_toexpo($id);
		return $res;
	}
	// public function job_per_task_toexpo($id)
	// {
	// 	$res = $this->data->toJob_per_task_toexpo($id);
	// 	return $res;
	// }
	// public function job_optr_task_toexpo($id)
	// {
	// 	$res = $this->data->toJob_optr_task_toexpo($id);
	// 	return $res;
	// }
	public function job_per_req_toexpo($id)
	{
		$res = $this->data->toJob_per_req_toexpo($id);
		return $res;
	}
	public function job_optr_req_toexpo($id)
	{
		$res = $this->data->toJob_optr_req_toexpo($id);
		return $res;
	}
	public function job_per_req_giv_toexpo($id)
	{
		$res = $this->data->toJob_per_req_giv_toexpo($id);
		return $res;
	}
	public function job_optr_req_giv_toexpo($id)
	{
		$res = $this->data->toJob_optr_req_giv_toexpo($id);
		return $res;
	}
	public function user_log()
	{
		$res = $this->data->get_user_log();
		return $res;
	}
	public function del_log($id)
	{
		$res = $this->data->to_del_log($id);
		return $res;
	}
	public function job_code()
	{
		$res = $this->data->to_job_code();
		return $res;
	}
	public function job_code_location($desc)
	{
		$res = $this->data->job_code_location($desc);
		return $res;
	}
	public function eqpt_list($id)
	{
		$res = $this->data->eqpt_list($id);
		return $res;
	}
	public function units()
	{
		$res = $this->data->get_units();
		return $res;
	}
	public function job_timestamp($id)
	{
		$res = $this->data->tojob_timestamp($id);
		return $res;
	}
	public function operator_act($req,$emp_id)
	{
		$res = $this->data->tooperator_act($req,$emp_id);
		return $res;
	}
	public function personnel_act($req,$emp_id)
	{
		$res = $this->data->topersonnel_act($req,$emp_id);
		return $res;
	}
	public function delete_job_time($id)
	{
		$res = $this->data->todelete_job_time($id);
		return $res;
	}
	public function edit_job_time($id)
	{
		$res = $this->data->toedit_job_time($id);
		return $res;
	}
	public function update_job_timestamp()
	{
		$res = $this->data->toupdate_job_timestamp();
		return $res;
	}
	public function personnel_info($req,$emp_id)
	{
		$res = $this->data->topersonnel_info($req,$emp_id);
		return $res;
	}
	public function operator_info($req,$emp_id)
	{
		$res = $this->data->tooperator_info($req,$emp_id);
		return $res;
	}
	public function edit_job_per_time($id)
	{
		$res = $this->data->toedit_job_per_time($id);
		return $res;
	}
	public function edit_job_optr_time($id)
	{
		$res = $this->data->toedit_job_optr_time($id);
		return $res;
	}
	public function update_job_per_timestamp()
	{
		$res = $this->data->toupdate_job_per_timestamp();
		return $res;
	}
	public function update_job_optr_timestamp()
	{
		$res = $this->data->toupdate_job_optr_timestamp();
		return $res;
	}
	public function delete_job_per_time($id)
	{
		$res = $this->data->todelete_job_per_time($id);
		return $res;
	}
	public function delete_job_optr_time($id)
	{
		$res = $this->data->todelete_job_optr_time($id);
		return $res;
	}
	public function job_per_act_toexpo_timestamp($id,$emp_id)
	{
		$res = $this->data->tojob_per_act_toexpo_timestamp($id,$emp_id);
		return $res;
	}
	public function job_optr_act_toexpo_timestamp($id,$emp_id)
	{
		$res = $this->data->tojob_optr_act_toexpo_timestamp($id,$emp_id);
		return $res;
	}
	// public function per_task_time($id,$task)
	// {
	// 	$res = $this->data->toper_task_time($id,$task);
	// 	return $res;
	// }
	// public function optr_task_time($id,$task)
	// {
	// 	$res = $this->data->tooptr_task_time($id,$task);
	// 	return $res;
	// }
	// public function personnel_task_details($id,$task)
	// {
	// 	$res = $this->data->get_personnel_task_details($id,$task);
	// 	return $res;
	// }
	// public function operator_task_details($id,$task)
	// {
	// 	$res = $this->data->get_operator_task_details($id,$task);
	// 	return $res;
	// }
	// public function edit_per_task_time($id)
	// {
	// 	$res = $this->data->get_details_per_task_time($id);
	// 	return $res;
	// }
	// public function edit_optr_task_time($id)
	// {
	// 	$res = $this->data->get_details_optr_task_time($id);
	// 	return $res;
	// }
	// public function update_per_task_timestamp()
	// {
	// 	$res = $this->data->to_update_per_task_timestamp();
	// 	return $res;
	// }
	// public function update_optr_task_timestamp()
	// {
	// 	$res = $this->data->to_update_optr_task_timestamp();
	// 	return $res;
	// }
	// public function delete_per_task_time($id)
	// {
	// 	$res = $this->data->to_delete_per_task_time($id);
	// 	return $res;
	// }
	// public function delete_optr_task_time($id)
	// {
	// 	$res = $this->data->to_delete_optr_task_time($id);
	// 	return $res;
	// }
	public function insert_job_timestamp()
	{
		$res = $this->data->to_insert_job_timestamp();
		return $res;
	}
	public function insert_optr_timestamp()
	{
		$res = $this->data->to_insert_optr_timestamp();
		return $res;
	}
	public function insert_eqpt_timestamp()
	{
		$res = $this->data->to_insert_eqpt_timestamp();
		return $res;
	}
	public function insert_per_timestamp()
	{
		$res = $this->data->to_insert_per_timestamp();
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
	public function job_toexpo_time($id)
	{
		$res = $this->data->tojob_toexpo_time($id);
		return $res;
	}
	public function dispatched_mp()
	{
		$res = $this->data->todispatched_mp();
		return $res;
	}
	public function dispatched_optr()
	{
		$res = $this->data->todispatched_optr();
		return $res;
	}
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
	public function equip_timestamp($id,$eq)
	{
		$res = $this->data->toequip_timestamp($id,$eq);
		return $res;
	}
	public function equipment_act($id)
	{
		$res = $this->data->toequipment_act($id);
		return $res;
	}
	public function getEquipment($code)
	{
		$res = $this->data->togetEquipment($code);
		return $res;
	}
	public function getEquip_timestamp($req,$code)
	{
		$res = $this->data->togetEquip_timestamp($req,$code);
		return $res;
	}
	public function delete_equip_time($id)
	{
		$res = $this->data->todelete_equip_time($id);
		return $res;
	}
	public function edit_equip_time($id)
	{
		$res = $this->data->toedit_equip_time($id);
		return $res;
	}
	public function update_eqpt_timestamp()
	{
		$res = $this->data->toupdate_eqpt_timestamp();
		return $res;
	}
	public function relieve($id)
	{
		$res = $this->data->torelieve($id);
		return $res;
	}
	public function reject($id)
	{
		$res = $this->data->toreject($id);
		return $res;
	}
	public function edit_equipment($id)
	{
		$res = $this->data->toedit_equipment($id);
		return $res;
	}
	public function truck_type()
	{
		$res = $this->data->totruck_type();
		return $res;
	}
	public function box_type()
	{
		$res = $this->data->box_type();
		return $res;
	}
	public function weight_per_box()
	{
		$res = $this->data->weight_per_box();
		return $res;
	}
	public function edit_box($id)
	{
		$res = $this->data->toedit_box($id);
		return $res;
	}
	public function edit_weight($id)
	{
		$res = $this->data->toedit_weight($id);
		return $res;
	}
	public function update_box()
	{
		$res = $this->data->toupdate_box();
		return $res;
	}
	public function submit_box()
	{
		$res = $this->data->tosubmit_box();
		return $res;
	}
	public function update_weight()
	{
		$res = $this->data->toupdate_weight();
		return $res;
	}
	public function submit_weight()
	{
		$res = $this->data->tosubmit_weight();
		return $res;
	}
	public function del_box($id)
	{
		$res = $this->data->todel_box($id);
		return $res;
	}
	public function del_weight($id)
	{
		$res = $this->data->todel_weight($id);
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
	public function attendance_type()
	{
		$res = $this->data->toattendance_type();
		return $res;
	}
	public function attendance_save()
	{
		$res = $this->data->toattendance_save();
		return $res;
	}
	public function attendance_date()
	{
		$res = $this->data->toattendance_date();
		return $res;
	}
	public function edit_attendance($id)
	{
		$res = $this->data->toedit_attendance($id);
		return $res;
	}
	public function update_attendance()
	{
		$res = $this->data->toupdate_attendance();
		return $res;
	}
	public function get_date($id)
	{
		$res = $this->data->toget_date($id);
		return $res;
	}
	public function is_available()
	{
		$res = $this->data->get_is_available();
		return $res;
	}
	public function del_attendance()
	{
		$res = $this->data->get_del_attendance();
		return $res;
	}
	public function employee_attendance($id)
	{
		$res = $this->data->toemployee_attendance($id);
		return $res;
	}
	public function del_all_attendance($id)
	{
		$res = $this->data->todel_all_attendance($id);
		return $res;
	}
	public function close_attendance($id)
	{
		$res = $this->data->toclose_attendance($id);
		return $res;
	}
	public function open_attendance($id)
	{
		$res = $this->data->toopen_attendance($id);
		return $res;
	}
	public function job_carrier($id)
	{
		$res = $this->data->tojob_carrier($id);
		return $res;
	}
	public function job_comm($id)
	{
		$res = $this->data->tojob_comm($id);
		return $res;
	}
	public function equipment_type()
	{
		$res = $this->data->get_equipment_type();
		return $res;
	}
	public function submit_eqpt_type()
	{
		$res = $this->data->tosubmit_eqpt_type();
		return $res;
	}
	public function edit_type($id)
	{
		$res = $this->data->toedit_type($id);
		return $res;
	}
	public function toupdate_eqpt_type()
	{
		$res = $this->data->toupdate_eqpt_type();
		return $res;
	}
	public function del_type($id)
	{
		$res = $this->data->todel_type($id);
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
	public function personnel_timestamp()
	{
		$res = $this->data->topersonnel_timestamp();
		return $res;
	}
	public function operator_timestamp()
	{
		$res = $this->data->tooperator_timestamp();
		return $res;
	}
	public function equipment_timestamp()
	{
		$res = $this->data->toequipment_timestamp();
		return $res;
	}
	public function job_equipment_needed($id)
	{
		$res = $this->data->tojob_equipment_needed($id);
		return $res;
	}
	public function upload()
	{
		if ($_POST) {
		$res = $this->data->toupload();
		return $res;
		}
	}

}



?>
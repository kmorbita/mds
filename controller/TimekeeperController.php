<?php 
require_once("../../model/TimekeeperModel.php");
class TimekeeperController
{
	protected $data;

	public function __construct()
	{
		$this->data = new TimekeeperModel();
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
	public function manpower()
	{
		$res = $this->data->get_manpower();
		return $res;
	}
	public function insertEmp()
	{
		$res = $this->data->toInsertEmp();
		return $res;
	}
	public function employees()
	{
		$res = $this->data->getEmployees();
		return $res;
	}
	public function edit_mp($id)
	{
		$res = $this->data->toEdit_mp($id);
		return $res;
	}
	public function update_emp($id)
	{
		$res = $this->data->toUpdate_emp($id);
		return $res;
	}
	public function del_emp($id)
	{
		$res = $this->data->toDel_emp($id);
		return $res;
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
	public function add_new_attendance()
	{
		$res = $this->data->toAdd_new_attendance();
		return $res;
	}
	public function equipment()
	{
		$res = $this->data->get_equipment();
		return $res;
	}
	public function mp_req($id)
	{
		$res = $this->data->get_mp_req($id);
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
	public function add_emp()
	{
		$res = $this->data->toAdd_emp();
		return $res;
	}
	public function manpower_given($id)
	{
		$res = $this->data->toManpower_given($id);
		return $res;
	}
	public function toAssigned_optr()
	{
		$res = $this->data->toAssigned_optr();
		return $res;
	}
	public function add_emp_optr()
	{
		$res = $this->data->toAdd_emp_optr();
		return $res;
	}
	public function equipment_given($id)
	{
		$res = $this->data->equipment_given($id);
		return $res;
	}
	public function assigned_emp()
	{
		$res = $this->data->toAssigned_emp();
		return $res;
	}
	public function messages($id)
	{
		$res = $this->data->getMessages($id);
		return $res;
	}
	public function view_message($id)
	{
		$res = $this->data->toViewmessages($id);
		return $res;
	}
	public function count_message($id)
	{
		$res = $this->data->toCount_message($id);
		return $res;
	}
	public function reply_msg($id)
	{
		$res = $this->data->toReply_msg($id);
		return $res;
	}
	public function unassign($id)
	{
		$res = $this->data->toUnassign($id);
		return $res;
	}
	public function task($id)
	{
		$res = $this->data->getTask($id);
		return $res;
	}
	public function new_task()
	{
		$res = $this->data->insert_task();
		return $res;
	}
	public function del_task($id)
	{
		$res = $this->data->delete_task($id);
		return $res;
	}
	public function edit_task($id)
	{
		$res = $this->data->toEdit_task($id);
		return $res;
	}
	public function update_task($id)
	{
		$res = $this->data->toUpdate_task($id);
		return $res;
	}
	public function search_data()
	{
		$res = $this->data->toSearch_data();
		return $res;
	}
	public function del_msg($id)
	{
		$res = $this->data->toDel_msg($id);
		return $res;
	}
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
	public function employees_present()
	{
		$res = $this->data->toEmployees_present();
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
	public function clear_stat($id)
	{
		$res = $this->data->toClear_stat($id);
		return $res;
	}
	public function job_status($id)
	{
		$res = $this->data->getJob_status($id);
		return $res;
	}
	public function list_relieve($id)
	{
		$res = $this->data->toList_relieve($id);
		return $res;
	}
	public function list_reject($id)
	{
		$res = $this->data->toList_reject($id);
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
	public function activity($id)
	{
		$res = $this->data->toActivity($id);
		return $res;
	}
	public function job_timestamp($id)
	{
		$res = $this->data->tojob_timestamp($id);
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
	public function job_equipment_expo($id)
	{
		$res = $this->data->tojob_equipment($id);
		return $res;
	}
	public function equipment_act($id)
	{
		$res = $this->data->toequipment_act($id);
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
	public function upload()
	{
		if ($_POST) {
		$res = $this->data->toupload();
		return $res;
		}
	}
}
?>
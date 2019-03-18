<?php 
require_once("../../model/JoclerkModel.php");
class JoclerkController
{
	protected $data;

	public function __construct()
	{
		$this->data = new JoclerkModel();
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
	public function reqno()
	{
		$reqno = $this->data->toReqno();
		return $reqno;
	}
	public function reqnocancel($id)
	{
		$cancel = $this->data->reqnoTocancel($id);
		if ($cancel == true) {
			header("Location: ../joclerk/index.php?page=joborderlist");
		}else{
			header("Location: ../joclerk/index.php?page=joborderlist");
		}
	}
	public function insert()
	{
		$insert = $this->data->toInsert();
		return $insert;
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
		// edit ,submit new manpower
	public function insert_mp()
	{
		$res = $this->data->toInsert_mp();
		if ($res == true) {
			return true;
		}else{
			return false;
		}
	}
		// edit ,submit new equipment
	public function insert_eqpt()
	{
		$res = $this->data->toInsert_eqpt();
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
		// update ,requestor & cargo details
	public function update_all()
	{
		$res = $this->data->toUpdate_all();
		if ($res == true) {
			return true;
		}else{
			return false;
		}
	}
	public function del_mp($id)
	{
		$res = $this->data->delete_mp($id);
		return $res;
	}
	public function del_comm($id)
	{
		$res = $this->data->delete_comm($id);
		return $res;
	}
	public function del_eqpt($id)
	{
		$res = $this->data->delete_eqpt($id);
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
	public function manpower()
	{
		$res = $this->data->get_manpower();
		return $res;
	}
	public function equipment()
	{
		$res = $this->data->get_equipment();
		return $res;
	}
	public function search_data()
	{
		$res = $this->data->toSearch_data();
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
	public function cancel_req($id)
	{
		$res = $this->data->to_cancel_req($id);
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
	public function units()
	{
		$res = $this->data->get_units();
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
	public function remove_id($id)
	{
		$res = $this->data->toremove_id($id);
		return $res;
	}
	public function job_toexpo_time($id)
	{
		$res = $this->data->tojob_toexpo_time($id);
		return $res;
	}
	public function job_equipment($id)
	{
		$res = $this->data->tojob_equipment($id);
		return $res;
	}
	public function equip_timestamp($id,$eq)
	{
		$res = $this->data->toequip_timestamp($id,$eq);
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
	public function job_equipment_expo($id)
	{
		$res = $this->data->tojob_equipment($id);
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
	public function job_equipment_needed($id)
	{
		$res = $this->data->tojob_equipment_needed($id);
		return $res;
	}
}



?>
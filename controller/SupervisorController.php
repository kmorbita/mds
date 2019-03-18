<?php 
require_once("../../model/SupervisorModel.php");
class SupervisorController
{
	protected $data;

	public function __construct()
	{
		$this->data = new SupervisorModel();
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
	public function activate_req()
	{
		$res = $this->data->toActivate_req();
		return $res;
	}
		// public function cancel_req()
		// {
		// 	$res = $this->data->toCancel_req();
		// 	return $res;
		// }
		// public function stop_req()
		// {
		// 	$res = $this->data->toStop_req();
		// 	return $res;
		// }
		// public function info_req($id)
		// {
		// 	$res = $this->data->getInfo_req($id);
		// 	return $res;
		// }
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
	public function equipment_given($id)
	{
		$res = $this->data->equipment_given($id);
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
	public function search_data()
	{
		$res = $this->data->toSearch_data();
		return $res;
	}
	public function personnel_activity($id)
	{
		$res = $this->data->toPersonnel_activity($id);
		return $res;
	}
	public function operator_activity($id)
	{
		$res = $this->data->toOperator_activity($id);
		return $res;
	}
	public function submit_status()
	{
		$res = $this->data->toSubmit_status();
		return $res;
	}
	public function job_status($id)
	{
		$res = $this->data->getJob_status($id);
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
}



?>
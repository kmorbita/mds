<?php 
require_once("../../model/JocheckerModel.php");
class JocheckerController
{
	protected $data;

	public function __construct()
	{
		$this->data = new JocheckerModel();
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
	public function changepass()
	{
		$res = $this->data->toChangepass();
		return $res;
	}
	public function equipment()
	{
		$res = $this->data->get_equipment();
		return $res;
	}
	public function manpower()
	{
		$res = $this->data->get_manpower();
		return $res;
	}
	public function job_code()
	{
		$res = $this->data->to_job_code();
		return $res;
	}
	public function current_pass($username,$id)
	{
		$res = $this->data->getcurrent_pass($username,$id);
		return $res;
	}
	public function getLogout($user,$role)
	{
		$res = $this->data->Logout($user,$role);
		if ($res == true) {
			header("Location: ../../index.php");
		}
	}
}
?>
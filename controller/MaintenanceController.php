<?php 
require_once("../../model/MaintenanceModel.php");
class MaintenanceController
{
	protected $data;

	public function __construct()
	{
		$this->data = new MaintenanceModel();
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
	public function equipment2()
	{
		$res = $this->data->get_equipment2();
		return $res;
	}
	public function current_pass($username,$id)
	{
		$res = $this->data->getcurrent_pass($username,$id);
		return $res;
	}
	public function edit_equipment($id)
	{
		$res = $this->data->toedit_equipment($id);
		return $res;
	}
	public function manpower()
	{
		$res = $this->data->getManpower();
		return $res;
	}
	public function equipment_type()
	{
		$res = $this->data->get_equipment_type();
		return $res;
	}
	public function insert_eqpt()
	{
		$res = $this->data->toInsert_eqpt();
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
	public function getLogout($user,$role)
	{
		$res = $this->data->Logout($user,$role);
		if ($res == true) {
			header("Location: ../../index.php");
		}
	}
}


?>
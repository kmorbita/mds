<?php 
require_once("../../model/ClientModel.php");
class ClientController
{
	protected $data;

	public function __construct()
	{
		$this->data = new ClientModel();
	}
	public function changepass()
	{
		$res = $this->data->toChangepass();
		return $res;
	}
	public function insert()
	{
		$insert = $this->data->toInsert();
		return $insert;
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
	public function del_mp($id)
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
	public function insert_eqpt()
	{
		$res = $this->data->toInsert_eqpt();
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
	public function update_all()
	{
		$res = $this->data->toUpdate_all();
		if ($res == true) {
			return true;
		}else{
			return false;
		}
	}
	public function view_job($id)
	{
		$res = $this->data->get_job_to_view($id);
		return $res;
	}
	public function joborderlist()
	{
		$res = $this->data->get_Job_order_list();
		return $res;
	}
	public function current_pass($username,$id)
	{
		$res = $this->data->getcurrent_pass($username,$id);
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
	public function edit($id)
	{
		$res = $this->data->toEdit($id);
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
	public function editcargo($id)
	{
		$res = $this->data->toEditcargo($id);
		return $res;
	}
	public function reqno()
	{
		$reqno = $this->data->toReqno();
		return $reqno;
	}
	public function getLogout($user,$role)
	{
		$res = $this->data->Logout($user,$role);
		if ($res == true) {
			header("Location: ../../index.php");
		}
	}
	public function cancel_req()
	{
		$res = $this->data->toCancel_req();
		return $reqno;
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
}


?>
<?php 

class MaintenanceModel
{
	private $db;
	private $id;

	public function __construct()
	{
		require_once("../../assets/connect.php");
		$this->db = Connect::dbconnect();
		$this->data = array();
		$this->data_mp = array();
		$this->comm = array();
		$this->eqpt = array();
		$this->mp = array();
		$this->data_equip = array();
		$this->job_code = array();
		$this->units_arr = array();
		$this->data_equip2 = array();
		$this->data_equip = array();
		$this->data_mp = array();
		$this->equipment_type = array();
	}
	public function get_equipment2()
	{
		$res = $this->db->query("SELECT t.eqpt_type,e.reason,e.status,e.id,e.eqpt_code,e.eqpt_name,m.mp_name FROM tblequipment e,tblmanpower m ,tblequipment_type t where e.mp_id=m.id and t.id=e.eqpt_type");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_equip2[] = $row;
		}
		return $this->data_equip2;
	}
	public function get_equipment()
	{
		$res = $this->db->query("SELECT e.status,e.id,e.eqpt_code,e.eqpt_name,m.mp_name FROM tblequipment e,tblmanpower m where e.mp_id=m.id and e.status='Active'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_equip[] = $row;
		}
		return $this->data_equip;
	}
	public function getcurrent_pass($user,$id)
	{
		$res = $this->db->query("SELECT * FROM tblusers where username='$user' and id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function toedit_equipment($id)
	{
		$res = $this->db->query("SELECT * FROM tblequipment where id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function getManpower()
	{
		$manpower = $this->db->query("SELECT * FROM tblmanpower");
		while ($row = $manpower->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_mp[] = $row;
		}
		return $this->data_mp;

	}
	public function get_equipment_type()
	{
		$res = $this->db->query("SELECT * FROM tblequipment_type");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->equipment_type[] = $row;
		}
		return $this->equipment_type;
	}
	public function toInsert_eqpt()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("INSERT INTO tblequipment(eqpt_code,eqpt_name,mp_id,encoded_by,created_at,status,reason,eqpt_type)values('".$_POST['eqpt_code']."','".$_POST['eqpt_name']."','".$_POST['eqpt_deg']."','".$_POST['user']."','".$Ctime."','".$_POST['status']."','".$_POST['reason']."','".$_POST['eqpt_type']."')");
		$check = $this->db->query("SELECT * FROM tblequipment where eqpt_code = '".$_POST['eqpt_code']."' and eqpt_name = '".$_POST['eqpt_name']."'");
		if ($check->rowCount() > 0) {
			return "inserted";
		}else{
			return "error";
		}
	}
	public function toUpdate_eqpt()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("UPDATE tblequipment set eqpt_code='".$_POST['eqpt_code_edit']."',eqpt_name='".$_POST['eqpt_name_edit']."',mp_id='".$_POST['eqpt_deg_edit']."',eqpt_type='".$_POST['eqpt_type_edit']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',status='".$_POST['status']."',reason='".$_POST['reason']."' where id='".$_POST['id_edit']."'");
		$check = $this->db->query("SELECT * FROM tblequipment where eqpt_code = '".$_POST['eqpt_code_edit']."' and eqpt_name = '".$_POST['eqpt_name_edit']."'");
		if ($check->rowCount() > 0) {
			return "updated";
		}else{
			return "error";
		}
	}
	public function toEqpt_del($id)
	{
		$res = $this->db->query("DELETE FROM tblequipment where id='$id'");
		$check = $this->db->query("SELECT * FROM tblequipment where id='$id'");
		if ($check->rowCount() > 0) {
			return "error";
		}else{
			return "deleted";
		}
	}
	public function toChangepass()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$curr_password = $_POST['curr_password'];
		$new_password = $_POST['new_password'];
		$renew_password = $_POST['renew_password'];
		$user_id = $_POST['user_id'];
		$new = strlen($new_password);
		$retype = strlen($renew_password);
		$check = $this->db->query("SELECT * FROM tblusers where original_pass = '".$_POST['curr_password']."' and id='".$_POST['user_id']."'");
		if (empty($curr_password) || empty($new_password) || empty($renew_password) || empty($user_id)) {
			return "blank";
		}else if ($new < 5 || $new > 15) {
			if ($new < 5) {
				return "min_new_pass_len";
			}
			if ($new > 15) {
				return "max_new_pass_len";
			}
		}else if ($new_password != $renew_password) {
			return "no_match";
		}else if (!preg_match("/^[a-zA-Z ]*$/",$new_password)) {
			return "new_pass";
		}else if (!preg_match("/^[a-zA-Z ]*$/",$renew_password)) {
			return "retype";
		}else if ($check->rowCount() <= 0) {
			return "invalid";
		}else{
			$temp_pass = sha1($_POST['renew_password']);
			$temp_pass = md5($temp_pass);
			$res = $this->db->query("UPDATE tblusers set password='".$temp_pass."', original_pass='".$_POST['renew_password']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['user_id']."'");
			$check_pass = $this->db->query("SELECT * FROM tblusers where password='".$temp_pass."' and original_pass='".$_POST['renew_password']."' and id='".$_POST['user_id']."'");
			if ($check_pass->rowCount() > 0) {
				return "updated";
			}else{
				return "error";
			}
		}
	}
	public function Logout($user,$role)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$insert = $this->db->query("INSERT INTO tbluserlogs(type,username,role,date)values('Logout','".$user."','".$role."','".$Ctime."')");
		session_start();
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		unset($_SESSION['name']);
		unset($_SESSION['role']);
		$bol = session_destroy();
		if ($bol == true) {
			return true;
		}else{
			return false;
		}
	}
}
?>
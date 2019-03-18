<?php 

class JocheckerModel
{
	private $db;
	private $id;

	public function __construct()
	{
		require_once("../../assets/connect.php");
		$this->db = Connect::dbconnect();
		$this->data = array();
		$this->data_equip = array();
		$this->data_mp = array();
		$this->job_code = array();
	}
	
	public function get_Job_order_list()
	{
		$jobs = $this->db->query("SELECT * FROM tbljoborderrequest ORDER BY id DESC");
		while ($row = $jobs->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data[] = $row;
		}
		return $this->data;
	}
	public function to_job_code()
	{
		$res = $this->db->query("SELECT * FROM tbljobcode");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->job_code[] = $row;
		}
		return $this->job_code;
	}
	public function get_job_to_view($id)
	{
		$res1 = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id'");
		$row1 = $res1->fetch(PDO::FETCH_ASSOC);
		$res2 = $this->db->query("SELECT * FROM tbljobcargocarrier where request_no='$id'");
		$row2 = $res2->fetch(PDO::FETCH_ASSOC);
		$res3 = $this->db->query("SELECT b.type as box,w.weight,c.request_no,c.shipper,c.commodity,c.qty,c.destination,u.type FROM tbljobcargocommodities c,tblunits u,tblbox_type b,tblweight_per_box w where c.unit=u.id and c.box=b.id and c.weight=w.id and c.request_no='$id'");
		$res4 = $this->db->query("SELECT eq.eqpt_type,eqpt.no_eqpt,eqpt.id,eqpt.no_optr FROM tblequipment_needed eqpt,tblequipment_type eq where eqpt.eqpt_type=eq.id and eqpt.request_no='$id'");
		$res5 = $this->db->query("SELECT mp.mp_name,mp_req.nos FROM tblmanpowerreq mp_req,tblmanpower mp where mp_req.mp_code=mp.id and mp_req.request_no='$id'");
		$res6 = $this->db->query("SELECT emp.fname,emp.id,emp.mname,emp.lname,mp.mp_name FROM tblgivenmanpower_req mp1,tblemployee emp,tblmanpower mp where mp1.emp_id=emp.emp_id and emp.mp_id=mp.id and mp1.request_no='$id'");
		$res7 = $this->db->query("SELECT emp.fname,emp.id,emp.mname,emp.lname,eqpt2.eqpt_name FROM tblgivenequipment_req eqpt1,tblemployee emp,tblequipment eqpt2 where eqpt1.optr_id=emp.emp_id and eqpt1.eqpt_id=eqpt2.id and eqpt1.request_no='$id'");
		$msg="";
		$msg.='	<section class="panel">
		<header class="panel-heading">
		<h2 class="panel-title">Requestor</h2>
		</header>
		<div class="panel-body">
		<div class="modal-wrapper">
		<div class="modal-text">
		<div class="row">
		<div class="col-md-6">
		<div class="form-group">
		<label>REQUESTOR: </label>
		<u><span>'.$row1['requestor'].'</span></u>
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
		<label>REQUEST NO: </label>
		<u><span>'.$row1['request_no'].'</span></u>
		</div>
		</div>
		</div>

		<div class="row">
		<div class="col-md-6">
		<div class="form-group">
		<label>ADDRESS: </label>
		<u><span>'.$row1['address'].'</span></u>
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
		<label>REQUEST DATE: </label>
		<u><span>'.$row1['requestdate'].'</span></u>
		</div>
		</div>
		</div>

		<div class="row">
		<div class="col-md-6">
		<div class="form-group">
		<label>JOB CODE: </label>
		<u><span>'.$row1['jobcode'].'</span></u>
		</div>
		</div>

		</div>

		<div class="row">
		<div class="col-md-12">
		<div class="form-group">
		<label>DESCRIPTION: </label>
		<u><span>'.$row1['jobdescription'].'</span></u>
		</div>
		</div>
		</div>

		<div class="row">
		<div class="col-md-6">
		<div class="form-group">
		<label>JOB DATE: </label>
		<u><span>'.$row1['jobdate'].'</span></u>
		</div>
		</div>
		<div class="col-md-6">
		<div class="form-group">
		<label>JOB LOCATION: </label>
		<u><span>'.$row1['joblocation'].'</span></u>
		</div>
		</div>
		</div>

		<div class="row">
		<div class="col-md-6">
		<div class="form-group">
		<label>EST:</label>
		<u><span>'.$row1['est'].'</span></u>
		</div>
		</div>
		</div>

		</div>
		</div>
		</div>
		</section>
		<section class="panel">
		<header class="panel-heading">
		<h2 class="panel-title">Cargo Details</h2>
		</header>
		<div class="panel-body">
		<div class="modal-wrapper">
		<div class="modal-text">
		<div class="col-md-4">
		<center>CARRIER</center>
		<div class="form-group">
		<label>VESSEL: </label>
		<u><span>'.$row2['vessel'].'</span></u>
		</div>
		<div class="form-group">
		<label>VOYAGE: </label>
		<u><span>'.$row2['voyage'].'</span></u>
		</div>
		<div class="form-group">
		<label>VAN#: </label>
		<u><span>'.$row2['van_no'].'</span></u>
		</div>
		<div class="form-group">
		<label>TRUCK#: </label>
		<u><span>'.$row2['truck_no'].'</span></u>
		</div>
		<div class="form-group">
		<label>HATCH#: </label>
		<u><span>'.$row2['hatch_no'].'</span></u>
		</div>
		<div class="form-group">
		<label>DECK#: </label>
		<u><span>'.$row2['deck_no'].'</span></u>
		</div>
		<div class="form-group">
		<label>TRUCK TYPE: </label>
		<u><span>'.$row2['trk_type'].'</span></u>
		</div>
		</div>
		<div class="col-md-7">
		<center>COMMODITIES</center>
		<table class="table table-striped">
		<thead>
		<tr>
		<th>Shipper</th>
		<th>Commodity</th>
		<th>Qty</th>
		<th>Unit</th>
		<th>Destination</th>
		<th>Box Type</th>
		<th>Weight Per Box</th>
		</tr>
		</thead>
		<tbody>';
		while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
		{
			$msg .='<tr>
			<td>'.$row['shipper'].'</td>
			<td>'.$row['commodity'].'</td>
			<td>'.$row['qty'].'</td>
			<td>'.$row['type'].'</td>
			<td>'.$row['destination'].'</td>
			<td>'.$row['box'].'</td>
			<td>'.$row['weight'].'</td>
			</tr>';
		}
		$msg.='</tbody>
		</table>
		</div>
		</div>
		</div>
		</div>
		</section>
		<section class="panel">
		<header class="panel-heading">
		<h2 class="panel-title">Requesting for</h2>
		</header>
		<div class="panel-body">
		<div class="modal-wrapper">
		<div class="modal-text">
		<div class="col-md-6">
		<h5>EQUIPMENTS</h5>
		<table class="table table-striped">
		<thead>
		<tr>
		<th>Equipment Code</th>
		<th>No. of Equipment</th>
		<th>W/ Operator</th>
		</tr>
		</thead>
		<tbody>';
		while ($row = $res4->fetch(PDO::FETCH_ASSOC)) 
		{
			if ($row['no_optr'] == "1") {
				$row['no_optr'] = "YES";
			}else{
				$row['no_optr'] = "NO";
			}
			$msg.='<tr>
			<td>'.$row['eqpt_type'].'</td>
			<td>'.$row['no_eqpt'].'</td>
			<td>'.$row['no_optr'].'</td>
			</tr>';
		}
		$msg.='</tbody>
		</table>
		</div>
		<div class="col-md-6">
		<h5>MANPOWER</h5>
		<table class="table table-striped">
		<thead>
		<tr>
		<th>Manpower Code</th>
		<th>NOS</th>
		</tr>
		</thead>
		<tbody>';
		while ($row = $res5->fetch(PDO::FETCH_ASSOC)) 
		{
			$msg.='<tr>
			<td>'.$row['mp_name'].'</td>
			<td>'.$row['nos'].'</td>
			</tr>';
		}
		$msg.='</tbody>
		</table>
		</div>
		<div class="col-md-6">
		<h5>EQUIPMENTS GIVEN</h5>
		<table class="table table-striped">
		<table class="table table-striped">
		<thead>
		<tr>
		<th>No#</th>
		<th>Personnel</th>
		<th>Equipment</th>
		</tr>
		</thead>
		<tbody>';
		$i=1;
		while ($row = $res7->fetch(PDO::FETCH_ASSOC)) 
		{
			$msg.='<tr>
			<td>'.$i.'</td>
			<td>'.$row['fname'].' '.$row['mname'].' '.$row['lname'].'</td>
			<td>'.$row['eqpt_name'].'</td>
			</tr>';
			$i++;
		}
		$msg.='</table>
		</div>
		<div class="col-md-6">
		<h5>MANPOWER GIVEN</h5>
		<table class="table table-striped">
		<thead>
		<tr>
		<th>No#</th>
		<th>Name</th>
		<th>Manpower Code</th>
		</tr>
		</thead>
		<tbody>';
		$i=1;
		while ($row = $res6->fetch(PDO::FETCH_ASSOC)) 
		{
			$msg.='<tr>
			<td>'.$i .'</td>
			<td>'.$row['fname']."".$row['mname']."".$row['lname'] .'</td>
			<td>'.$row['mp_name'] .'</td>
			</tr>';
			$i++;
		}
		$msg.='</tbody>
		</table>
		</div>
		</div>
		</div>
		</div>
		</section>
		</div>';

		// return $msg;
		echo $msg;
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
	public function get_equipment()
	{
		$res = $this->db->query("SELECT * FROM tblequipment");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_equip[] = $row;
		}
		return $this->data_equip;
	}
	public function get_manpower()
	{
		$res = $this->db->query("SELECT * FROM tblmanpower");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_mp[] = $row;
		}
		return $this->data_mp;
	}
	public function getcurrent_pass($user,$id)
	{
		$res = $this->db->query("SELECT * FROM tblusers where username='$user' and id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
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
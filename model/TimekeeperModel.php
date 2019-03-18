<?php 

class TimekeeperModel
{
	private $db;
	private $id;

	public function __construct()
	{
		require_once("../../assets/connect.php");
		$this->db = Connect::dbconnect();
		$this->data = array();
		$this->data_mp = array();
		$this->data_emp = array();
		$this->data_checkEmp = array();
		$this->data_att = array();
		$this->data_getatt = array();
		$this->data_new_att = array();
		$this->data_equip = array();
		$this->data_optr = array();
		$this->data_eqpt_optr = array();
		$this->data_mp_req = array();
		$this->data_mpgiv = array();
		$this->data_eqptgiv = array();
		$this->to_assigned_optr = array();
		$this->to_assigned_eqpt = array();
		$this->assigned_emp = array();
		$this->data_jobmp = array();
		$this->data_jobeqpt = array();
		$this->messages = array();
		$this->task = array();
		$this->search_job = array();
		$this->emp_present = array();
		$this->dispatched_mp = array();
		$this->dispatched_optr = array();
		$this->data_activity = array();
		$this->timestamps = array();
		$this->per_added_task = array();
		$this->optr_added_task = array();
		$this->operator_act = array();
		$this->personnel_act = array();
		$this->job_equipment = array();
		$this->equipment_act = array();
		$this->attendance_type = array();
		$this->employee_attendance = array();
		$this->attendance_date = array();
		$this->personnel_timestamp = array();
		$this->operator_timestamp = array();
		$this->equipment_timestamp = array();
	}
	
	public function get_Job_order_list()
	{
		$jobs = $this->db->query("SELECT * FROM tbljoborderrequest where status!='queued' ORDER BY id DESC");
		while ($row = $jobs->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data[] = $row;
		}
		return $this->data;
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
	public function get_manpower()
	{
		$res = $this->db->query("SELECT * FROM tblmanpower");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_mp[] = $row;
		}
		return $this->data_mp;
	}
	public function toInsertEmp()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$check_id = $this->db->query("SELECT * FROM tblemployee where emp_id='".$_POST['mp_id']."'");
		$check_name = $this->db->query("SELECT * FROM tblemployee where fname='".$_POST['mp_fname']."' and mname='".$_POST['mp_mname']."' and lname='".$_POST['mp_lname']."'");
		if ($check_id->rowCount() > 0) {
			$msg = "emp_id";
			return $msg;
		}
		else if ($check_name->rowCount() > 0) {
			$msg = "name";
			return $msg;
		}else{
			$res = $this->db->query("INSERT INTO tblemployee (emp_id,fname,mname,lname,mp_id,status,is_assigned,encoded_by,created_at,employment_status)values('".$_POST['mp_id']."','".$_POST['mp_fname']."','".$_POST['mp_mname']."','".$_POST['mp_lname']."','".$_POST['mp_code']."','".$_POST['mp_stat']."','0','".$_POST['username']."','".$Ctime."','".$_POST['emp_stat']."')");
			$msg = "true";
			return $msg;
		}
	}
	public function getEmployees()
	{
		$res = $this->db->query("SELECT mp.mp_code,emp.created_at,emp.job_stat,emp.employment_status,emp.request_no,emp.emp_id,emp.fname,emp.is_assigned,emp.mname,emp.lname,mp.mp_name as manpower,emp.status,emp.is_present FROM tblemployee emp,tblmanpower mp where emp.mp_id=mp.id");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_emp[] = $row;
		}
		return $this->data_emp;
	}
	public function toEdit_mp($id)
	{
		$res = $this->db->query("SELECT * FROM tblemployee where emp_id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function toUpdate_emp($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$id = $_POST['mp_id_edit'];
		$res = $this->db->query("UPDATE tblemployee set fname='".$_POST['mp_fname_edit']."',mname='".$_POST['mp_mname_edit']."',lname='".$_POST['mp_lname_edit']."',mp_id='".$_POST['mp_code_edit']."',status='".$_POST['mp_stat_edit']."',is_assigned='".$_POST['mp_isassigned_edit']."',job_stat='".$_POST['mp_jobstat_edit']."',request_no='".$_POST['mp_reques_no_edit']."',updated_by='".$_POST['username']."',updated_at='".$Ctime."',employment_status='".$_POST['emp_stat_edit']."' where emp_id='$id'");
		$check = $this->db->query("SELECT * FROM tblemployee where fname='".$_POST['mp_fname_edit']."' and mname='".$_POST['mp_mname_edit']."' and lname='".$_POST['mp_lname_edit']."' and mp_id='".$_POST['mp_code_edit']."' and status='".$_POST['mp_stat_edit']."' and employment_status='".$_POST['emp_stat_edit']."'");
		if ($check->rowCount() > 0) {
			return "updated";
		}else {
			return "error";
		}
		return $res;
	}
	public function toDel_emp($id)
	{
		$res = $this->db->query("DELETE FROM tblemployee where emp_id='$id'");
		return $res;
	}
	public function getcurrent_pass($user,$id)
	{
		$res = $this->db->query("SELECT * FROM tblusers where username='$user' and id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
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
	public function toAdd_new_attendance()
	{
		$jobs = $this->db->query("SELECT emp.emp_id,emp.fname,emp.mname,emp.lname,mp.mp_name FROM tblemployee emp, tblmanpower mp where emp.mp_id=mp.id");
		while ($row = $jobs->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_new_att[] = $row;
		}
		return $this->data_new_att;
	}
	public function get_equipment()
	{
		$res = $this->db->query("SELECT t.eqpt_type,e.reason,e.status,e.id,e.eqpt_code,e.eqpt_name,m.mp_name FROM tblequipment e,tblmanpower m ,tblequipment_type t where e.mp_id=m.id and t.id=e.eqpt_type");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_equip[] = $row;
		}
		return $this->data_equip;
	}
	public function get_mp_req($id)
	{
		
		$res = $this->db->query("SELECT mp_req.mp_code,emp.fname,emp.id,emp.mname,emp.lname,emp.status,emp.emp_id,mp_req.nos FROM tblemployee emp,tblmanpowerreq mp_req where mp_req.mp_code=emp.mp_id and is_present='1' and mp_req.id='$id' and emp.status='Active' and emp.job_stat='' and emp.is_assigned='0'");
		// $row = $res->fetch(PDO::FETCH_ASSOC);
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_mp_req[] = $row;
		}
		return $this->data_mp_req;
	}
	public function get_job_equipment($id)
	{
		$res = $this->db->query("SELECT er.id,er.eq_code,eq.eqpt_name,er.no_optr,er.no_eqpt FROM tblequipreq er,tblequipment eq where er.eq_code=eq.id and er.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_jobeqpt[] = $row;
		}
		return $this->data_jobeqpt;
	}
	public function get_job_manpower($id)
	{
		$res = $this->db->query("SELECT mp1.id,mp1.mp_code,mp1.request_no,mp2.mp_name,mp1.nos FROM tblmanpowerreq mp1,tblmanpower mp2 where mp1.mp_code=mp2.id and request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_jobmp[] = $row;
		}
		return $this->data_jobmp;
	}
	public function toAdd_emp()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$get_emp_id = $this->db->query("SELECT * FROM tblemployee where id='".$_POST['id']."'");
		$row = $get_emp_id->fetch(PDO::FETCH_ASSOC);
		$emp_id = $row['emp_id'];
		$check = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['req_no']."' and emp_id='".$emp_id."'");
		if ($check->rowCount() > 0) {
			return "existed";
		}else{
			$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['req_no']."' and mp_code='".$_POST['mp_code']."'");
			if ($check2->rowCount() == $_POST['nos']) {
				return "exceeded";
			}else{
				$res = $this->db->query("INSERT INTO tblgivenmanpower_req (request_no,emp_id,mp_code,encoded_by,created_at)values('".$_POST['req_no']."','".$emp_id."','".$_POST['mp_code']."','".$_POST['username']."','".$Ctime."')");
				$update = $this->db->query("UPDATE tblemployee set is_assigned='1',request_no='".$_POST['req_no']."' where emp_id='$emp_id'");
				$check3 = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['req_no']."' and emp_id='".$emp_id."'");
				if ($check3->rowCount() > 0) {
					return "inserted";
				}else{
					return "error";
				}
			}
		}
	}
	public function toManpower_given($id)
	{
		$res = $this->db->query("SELECT emp.fname,emp.emp_id,emp.id,emp.mname,emp.lname,mp1.status,mp.mp_name FROM tblgivenmanpower_req mp1,tblemployee emp,tblmanpower mp where mp1.emp_id=emp.emp_id and emp.mp_id=mp.id and mp1.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_mpgiv[] = $row;
		}
		return $this->data_mpgiv;
	}
	public function toAssigned_optr()
	{
		$res = $this->db->query("SELECT emp.emp_id,emp.id,emp.fname,emp.mname,emp.lname FROM tblemployee emp,tblmanpower mp where emp.mp_id=mp.id and mp.mp_code='operator' and emp.status='Active' and emp.job_stat='' and emp.is_assigned='0'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->to_assigned_optr[] = $row;
		}
		return $this->to_assigned_optr;
	}
	public function toAdd_emp_optr()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$get_id = $this->db->query("SELECT * FROM tblemployee where id='".$_POST['id']."'");
		$row = $get_id->fetch(PDO::FETCH_ASSOC);
		$emp_id = $row['emp_id'];
		$check = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['req_no']."' and optr_id='".$emp_id."'");
		if ($check->rowCount() >0) {
			return "existed";
		}else{
			$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['req_no']."'");
			if ($check2->rowCount() == $_POST['no_eq']) {
				return "exceeded";
			}else{
				$res = $this->db->query("INSERT INTO tblgivenequipment_req (request_no,eqpt_id,optr_id,encoded_by,created_at)values('".$_POST['req_no']."','".$_POST['eqpt_id']."','".$emp_id."','".$_POST['username']."','".$Ctime."')");
				$update = $this->db->query("UPDATE tblemployee set is_assigned='1',request_no='".$_POST['req_no']."' where emp_id='$emp_id'");
				$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['req_no']."' and optr_id='".$emp_id."' and eqpt_id='".$_POST['eqpt_id']."'");
				if ($check2->rowCount() >0) {
					return "inserted";
				}else{
					return "error";
				}
			}
		}
	}
	public function equipment_given($id)
	{
		$res = $this->db->query("SELECT emp.fname,emp.emp_id,emp.id,emp.mname,emp.lname,eqpt1.status,eqpt2.eqpt_name FROM tblgivenequipment_req eqpt1,tblemployee emp,tblequipment eqpt2 where eqpt1.optr_id=emp.emp_id and eqpt1.eqpt_id=eqpt2.id and eqpt1.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_eqptgiv[] = $row;
		}
		return $this->data_eqptgiv;
	}
	public function toAssigned_emp()
	{
		$res = $this->db->query("SELECT emp.fname,emp.mname,emp.lname,emp.emp_id,job.request_no,job.jobdescription,job.jobdate,emp.is_present,emp.is_assigned FROM tblemployee emp LEFT JOIN tbljoborderrequest job on emp.request_no=job.request_no where emp.is_present='1'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->assigned_emp[] = $row;
		}
		return $this->assigned_emp;
	}
	public function getMessages($id)
	{
		$res = $this->db->query("SELECT n.from_name,n.status,n.message_content,n.date_sent,n.date_response,n.is_replied,n.id,n.is_response_seen,n.is_replied,n.response,j.status as job_stat FROM tblnotify n,tbljoborderrequest j where n.request_no=j.request_no and n.to_user_role='$id' ORDER BY id DESC");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->messages[] = $row;
		}
		return $this->messages;
	}
	public function toViewmessages($id)
	{
		$res = $this->db->query("SELECT * FROM tblnotify where id='$id'");
		$res2 = $this->db->query("UPDATE tblnotify set status='seen' where id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row['message_content'];
	}
	public function toCount_message($id)
	{
		$res = $this->db->query("SELECT * FROM tblnotify where status='not seen' and to_user_role='$id'");
		$count = $res->rowCount();
		return $count;
	}
	public function toReply_msg($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("UPDATE tblnotify set response='".$_POST['msg_content']."',is_replied='1',date_response='".$Ctime."' where id='$id'");
		$check = $this->db->query("SELECT * FROM tblnotify where response='".$_POST['msg_content']."' and id='$id'");
		if ($check->rowCount() >0) {
			return "sent";
		}else {
			return "error";
		}
	}
	public function toUnassign($id)
	{
		$res = $this->db->query("UPDATE tblemployee set is_assigned='0',request_no='' where emp_id='$id'");
		$check = $this->db->query("SELECT * FROM tblemployee where is_assigned='0' and request_no='' and emp_id='$id'");
		$del = $this->db->query("DELETE FROM tblgivenmanpower_req where emp_id = '$id'");
		$del2 = $this->db->query("DELETE FROM tblgivenequipment_req where optr_id = '$id'");
		$del_check = $this->db->query("SELECT * FROM tblgivenequipment_req where optr_id='$id'");
		$del_check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where emp_id='$id'");
		if ($check->rowCount() > 0 && $del_check->rowCount() <= 0 && $del_check2->rowCount() <= 0) {
			return "true";
		}else {
			return "error";
		}
	}
	public function getTask($id)
	{
		$res = $this->db->query("SELECT * FROM tbltasks where request_no = '$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->task[] = $row;
		}
		return $this->task;
	}
	public function insert_task()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("INSERT INTO tbltasks (request_no,task,task_for,encoded_by,created_at)values('".$_POST['task_id']."','".$_POST['task']."','".$_POST['task_for']."','".$_POST['username']."','".$Ctime."')");
		$check = $this->db->query("SELECT * FROM tbltasks where request_no = '".$_POST['task_id']."' and task='".$_POST['task']."' and task_for='".$_POST['task_for']."'");
		if ($check->rowCount() >0) {
			return "true";
		}else {
			return "error";
		}
	}
	public function delete_task($id)
	{
		$res = $this->db->query("DELETE FROM tbltasks where id='$id'");
		$check = $this->db->query("SELECT * FROM tbloptr where id='$id'");
		if ($check->rowCount() > 0) {
			return "error";
		}else{
			return "deleted";
		}
	}
	public function toEdit_task($id)
	{
		$res = $this->db->query("SELECT * FROM tbltasks where id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function toUpdate_task($id)
	{
		$timezone  = +7;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("UPDATE tbltasks set task='".$_POST['task']."',task_for='".$_POST['task_for']."',updated_by='".$_POST['username']."',updated_at='".$Ctime."' where id='$id'");
		$check = $this->db->query("SELECT * FROM tbltasks where task='".$_POST['task']."' and task_for='".$_POST['task_for']."' and id='$id'");
		if ($check->rowCount() > 0) {
			return "updated";
		}else{
			return "error";
		}
	}
	public function toSearch_data()
	{
		$jobs = $this->db->query("SELECT * FROM tbljoborderrequest where request_no LIKE '".$_POST['search_data']."%' and status!='queued'");
		while ($row = $jobs->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->search_job[] = $row;
		}
		return $this->search_job;
	}
	public function toDel_msg($id)
	{
		$res = $this->db->query("DELETE FROM tblnotify where id='$id'");
		$check = $this->db->query("SELECT * FROM tblnotify where id='$id'");
		if ($check->rowCount() >0) {
			return "error";
		}else {
			return "deleted";
		}
	}
	public function toPresent($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("UPDATE tblemployee set is_present='1',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
		$update = $this->db->query("UPDATE tblusers set account_stat='Active',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where user_id='".$id."'");
		$check = $this->db->query("SELECT * FROM tblemployee where emp_id='$id' and is_present='1'");
		if ($check->rowCount() > 0) {
			return "present";
		}else {
			return "error";
		}
	}
	public function toNo_present($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("UPDATE tblemployee set is_present='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
		$update = $this->db->query("UPDATE tblusers set account_stat='Inactive',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where user_id='".$id."'");
		$check = $this->db->query("SELECT * FROM tblemployee where emp_id='$id' and is_present='0'");
		if ($check->rowCount() > 0) {
			return "no_present";
		}else {
			return "error";
		}
	}
	public function toEmployees_present()
	{
		$res = $this->db->query("SELECT emp.fname,emp.mname,emp.lname,emp.emp_id,emp.is_present,emp.job_stat,mp.mp_name FROM tblemployee emp,tblmanpower mp where emp.mp_id=mp.id and emp.is_present='1'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->emp_present[] = $row;
		}
		return $this->emp_present;
	}
	public function toEqpt_dispatch($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Dispatched' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenequipment_req set status='Dispatched',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where optr_id='$id' and request_no='".$_POST['req']."'");
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Dispatched' and emp_id='$id'");
		$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Dispatched' and optr_id='$id' and request_no='".$_POST['req']."'");
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "dispatched";
		}else {
			return "error";
		}
	}
	public function toEqpt_relieve($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$notes = "Relieved by ".$_POST['user']."(Timekeeper)";
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Relieved',is_assigned='0' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenequipment_req set status='Relieved' where optr_id='$id' and request_no='".$_POST['req']."'");
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Relieved' and emp_id='$id'");
		$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Relieved' and optr_id='$id' and request_no='".$_POST['req']."'");
		$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and emp_id='$id'");
		while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row1['emp_id'];
			$update = $this->db->query("UPDATE tblpersonnel_activity set status='Stopped',work_stopped='".$Ctime."',remarks='Relieved', notes='".$notes."', reason='".$_POST['notes']."' where emp_id='".$emp_id."'");
		}
		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id'");
		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row2['emp_id'];
			$update = $this->db->query("UPDATE tbloperator_activity set status='Stopped',work_stopped='".$Ctime."',remarks='Relieved', notes='".$notes."', reason='".$_POST['notes']."' where emp_id='".$emp_id."'");
		}
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "relieved";
		}else {
			return "error";
		}
	}
	public function toEqpt_reject($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$notes = "Rejected by ".$_POST['user']."(Timekeeper)";
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Rejected',is_assigned='0' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenequipment_req set status='Rejected' where optr_id='$id' and request_no='".$_POST['req']."'");
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Rejected' and emp_id='$id'");
		$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Rejected' and optr_id='$id' and request_no='".$_POST['req']."'");
		$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and emp_id='$id'");
		while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row1['emp_id'];
			$update = $this->db->query("UPDATE tblpersonnel_activity set status='Stopped',work_stopped='".$Ctime."',remarks='Rejected', notes='".$notes."', reason='".$_POST['notes']."' where emp_id='".$emp_id."'");
		}
		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id'");
		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row2['emp_id'];
			$update = $this->db->query("UPDATE tbloperator_activity set status='Stopped',work_stopped='".$Ctime."',remarks='Rejected', notes='".$notes."', reason='".$_POST['notes']."' where emp_id='".$emp_id."'");
		}
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "rejected";
		}else {
			return "error";
		}
	}
	public function toPer_dispatch($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Dispatched' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Dispatched',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id' and request_no='".$_POST['req']."'");
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Dispatched' and emp_id='$id'");
		$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Dispatched' and emp_id='$id' and request_no='".$_POST['req']."'");
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "dispatched";
		}else {
			return "error";
		}
	}
	public function toPer_relieve($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$notes = "Relieved by ".$_POST['user']."(Timekeeper)";
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Relieved',is_assigned='0' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Relieved' where emp_id='$id' and request_no='".$_POST['req']."'");
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Relieved' and emp_id='$id'");
		$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Relieved' and emp_id='$id' and request_no='".$_POST['req']."'");
		$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and emp_id='$id'");
		while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row1['emp_id'];
			$update = $this->db->query("UPDATE tblpersonnel_activity set status='Stopped',work_stopped='".$Ctime."',remarks='Relieved', notes='".$notes."', reason='".$_POST['notes']."' where emp_id='".$emp_id."'");
		}
		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id'");
		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row2['emp_id'];
			$update = $this->db->query("UPDATE tbloperator_activity set status='Stopped',work_stopped='".$Ctime."',remarks='Relieved', notes='".$notes."', reason='".$_POST['notes']."' where emp_id='".$emp_id."'");
		}
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "relieved";
		}else {
			return "error";
		}
	}
	public function toPer_reject($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$notes = "Rejected by ".$_POST['user']."(Timekeeper)";
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Rejected',is_assigned='0' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Rejected' where emp_id='$id' and request_no='".$_POST['req']."'");
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Rejected' and emp_id='$id'");
		$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Rejected' and emp_id='$id' and request_no='".$_POST['req']."'");
		$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and emp_id='$id'");
		while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row1['emp_id'];
			$update = $this->db->query("UPDATE tblpersonnel_activity set status='Stopped',work_stopped='".$Ctime."',remarks='Rejected', notes='".$notes."', reason='".$_POST['notes']."' where emp_id='".$emp_id."'");
		}
		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id'");
		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row2['emp_id'];
			$update = $this->db->query("UPDATE tbloperator_activity set status='Stopped',work_stopped='".$Ctime."',remarks='Rejected', notes='".$notes."', reason='".$_POST['notes']."' where emp_id='".$emp_id."'");
		}
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "rejected";
		}else {
			return "error";
		}
	}
	public function toClear_stat($id)
	{
		$optr_activity = $this->db->query("UPDATE tblemployee set job_stat='',request_no='' where emp_id='$id'");
		$check = $this->db->query("SELECT * FROm tblemployee where job_stat='' and request_no='' and emp_id='$id'");
		if ($check->rowCount() > 0) {
			return "cleared";
		}else{
			return "error";
		}
	}
	public function getJob_status($id)
	{
		$job_stat='';
		$res = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$job_stat = $row['status'];
		}
		return $job_stat;
	}
	public function toList_relieve($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$notes = "Relieved by ".$_POST['user']."(Timekeeper)";
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Relieved',is_assigned='0' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Relieved' where emp_id='$id' and request_no='".$_POST['req']."'");
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Relieved' and emp_id='$id'");
		$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Relieved' and emp_id='$id' and request_no='".$_POST['req']."'");
		$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and emp_id='$id'");
		while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row1['emp_id'];
			$update = $this->db->query("UPDATE tblpersonnel_activity set status='Stopped',work_stopped='".$Ctime."',remarks='Relieved', notes='".$notes."', reason='".$_POST['notes']."' where emp_id='".$emp_id."'");
		}
		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id'");
		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row2['emp_id'];
			$update = $this->db->query("UPDATE tbloperator_activity set status='Stopped',work_stopped='".$Ctime."',remarks='Relieved', notes='".$notes."', reason='".$_POST['notes']."' where emp_id='".$emp_id."'");
		}
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "relieved";
		}else {
			return "error";
		}
	}
	public function toList_reject($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$notes = "Rejected by ".$_POST['user']."(Timekeeper)";
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Rejected',is_assigned='0' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Rejected' where emp_id='$id' and request_no='".$_POST['req']."'");
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Rejected' and emp_id='$id'");
		$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Rejected' and emp_id='$id' and request_no='".$_POST['req']."'");
		$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and emp_id='$id'");
		while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row1['emp_id'];
			$update = $this->db->query("UPDATE tblpersonnel_activity set status='Stopped',work_stopped='".$Ctime."',remarks='Rejected', notes='".$notes."', reason='".$_POST['notes']."' where emp_id='".$emp_id."'");
		}
		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id'");
		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row2['emp_id'];
			$update = $this->db->query("UPDATE tbloperator_activity set status='Stopped',work_stopped='".$Ctime."',remarks='Rejected', notes='".$notes."', reason='".$_POST['notes']."' where emp_id='".$emp_id."'");
		}
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "rejected";
		}else {
			return "error";
		}
	}
	public function todispatched_mp()
	{
		$res = $this->db->query("SELECT req.request_no,emp.emp_id,emp.fname,emp.mname,emp.lname,req.status,req.created_at FROM tblgivenmanpower_req req,tblemployee emp where emp.emp_id=req.emp_id and req.status='Dispatched'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->dispatched_mp[] = $row;
		}
		return $this->dispatched_mp;
	}
	public function todispatched_optr()
	{
		$res = $this->db->query("SELECT req.request_no,emp.emp_id,emp.fname,emp.mname,emp.lname,req.status,req.created_at FROM tblgivenequipment_req req,tblemployee emp where emp.emp_id=req.optr_id and req.status='Dispatched'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->dispatched_optr[] = $row;
		}
		return $this->dispatched_optr;
	}
	public function toActivity($id)
	{
		$res = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_activity[] = $row;
		}
		return $this->data_activity;
	}
	public function tojob_timestamp($id)
	{
		$res = $this->db->query("SELECT jo.reason,jo.accomplishment,jo.request_no,jo.status,jo.work_started,jo.work_stopped,jo.work_resumed,jo.work_completed FROM tbljoborderrequest j LEFT JOIN tbljob_timestamp jo on j.request_no=jo.request_no where j.request_no='$id' ORDER BY jo.id ASC");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->timestamps[] = $row;
		}
		return $this->timestamps;
	}
	public function toPersonnel_task_added($id)
	{
		$res = $this->db->query("SELECT per.status,per.id,per.temp_designation,emp.emp_id,emp.fname,emp.mname,emp.lname,mp.mp_name,per.remarks FROM tblpersonnel_activity per,tblemployee emp,tblmanpower mp where per.emp_id=emp.emp_id and emp.mp_id=mp.id and mp.mp_code='Personnel' and per.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->per_added_task[] = $row;
		}
		return $this->per_added_task;
	}
	public function toOperator_task_added($id)
	{
		$res = $this->db->query("SELECT optr.id,emp.emp_id,emp.fname,emp.mname,emp.lname,mp.mp_name,optr.temp_designation,optr.status,optr.remarks FROM tbloperator_activity optr,tblmanpower mp,tblemployee emp where optr.emp_id=emp.emp_id and emp.mp_id=mp.id and optr.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->optr_added_task[] = $row;
		}
		return $this->optr_added_task;
	}
	public function tooperator_act($id)
	{
		$handler = array();
		$res = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where emp_id='".$_POST['emp_id']."' and request_no='".$_POST['req']."' ORDER BY id ASC");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->operator_act[] = $row;
		}
		$res2 = $this->db->query("SELECT e.fname,e.mname,e.lname,e.emp_id FROM tbloperator_activity o,tblemployee e WHERE o.emp_id='".$_POST['emp_id']."' and o.request_no='".$_POST['req']."' and e.emp_id=o.emp_id");
		$row = $res2->fetch(PDO::FETCH_ASSOC);
		$emp_id = $row['emp_id'];
		$fname = $row['fname'];
		$mname = $row['mname'];
		$lname = $row['lname'];
		$handler = array("optr_act"=>$this->operator_act,"emp_id"=>$emp_id,"fname"=>$fname,"mname"=>$mname,"lname"=>$lname);
		return $handler;
	}
	public function topersonnel_act($id)
	{
		$handler = array();
		$res = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where emp_id='".$_POST['emp_id']."' and request_no='".$_POST['req']."' ORDER BY id ASC");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->personnel_act[] = $row;
		}
		$res2 = $this->db->query("SELECT e.fname,e.mname,e.lname,e.emp_id FROM tblpersonnel_activity o,tblemployee e WHERE o.emp_id='".$_POST['emp_id']."' and o.request_no='".$_POST['req']."' and e.emp_id=o.emp_id");
		$row = $res2->fetch(PDO::FETCH_ASSOC);
		$emp_id = $row['emp_id'];
		$fname = $row['fname'];
		$mname = $row['mname'];
		$lname = $row['lname'];
		$handler = array("per_act"=>$this->personnel_act,"emp_id"=>$emp_id,"fname"=>$fname,"mname"=>$mname,"lname"=>$lname);
		return $handler;
	}
	public function tojob_equipment($id)
	{
		$res = $this->db->query("SELECT e.eqpt_name,req.status,req.eq_code FROM tblequipreq req,tblequipment e where req.eq_code=e.id and req.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->job_equipment[] = $row;
		}
		return $this->job_equipment;
	}
	public function toequipment_act($id)
	{
		$handler = array();
		$res = $this->db->query("SELECT * FROM tblequipment_timestamp where eq_code='$id' and request_no='".$_POST['req']."' ORDER BY id ASC");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->equipment_act[] = $row;
		}
		$res2 = $this->db->query("SELECT * FROM tblequipment where id='$id'");
		$row = $res2->fetch(PDO::FETCH_ASSOC);
		$eqpt_name = $row['eqpt_name'];
		$handler = array("eqpt_act"=>$this->equipment_act,"eqpt_name"=>$eqpt_name);
		return $handler;
	}
	public function torelieve($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$notes = "Relieved by ".$_POST['user']."(Timekeeper)";
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Relieved',is_assigned='0',request_no='',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."'
			where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Relieved',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where emp_id='$id' and request_no='".$_POST['req']."'");
		$res3 = $this->db->query("UPDATE tblgivenequipment_req set status='Relieved',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where optr_id='$id' and request_no='".$_POST['req']."'");
		$check = $this->db->query("SELECT * FROM tblgivenmanpower_req where job_stat='Relieved' and emp_id='$id'");
		if ($check->rowCount() > 0) {
			$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Relieved' and emp_id='$id'");
		}else{
			$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Relieved' and optr_id='$id'");
		}
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Relieved' and emp_id='$id'");
		$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and emp_id='$id' and request_no='".$_POST['req']."'");
		while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row1['emp_id'];
			$req = $row1['request_no'];
			$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='Relieved', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
			$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id' and request_no='".$_POST['req']."'");
		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row2['emp_id'];
			$req2 = $row2['request_no'];
			$update = $this->db->query("UPDATE tbloperator_activity set status='Stopped',remarks='Rejected', notes='".$notes."',updated_by='".$_POST['user']."',reason='".$_POST['notes']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
			$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req2."','".$emp_id."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "relieved";
		}else {
			return "error";
		}
	}
	public function toreject($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$notes = "Rejected by ".$_POST['user']."(Timekeeper)";
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Rejected',is_assigned='0',request_no='',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Rejected',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where emp_id='$id' and request_no='".$_POST['req']."'");
		$res3 = $this->db->query("UPDATE tblgivenequipment_req set status='Rejected',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where optr_id='$id' and request_no='".$_POST['req']."'");
		$check = $this->db->query("SELECT * FROM tblgivenmanpower_req where job_stat='Rejected' and emp_id='$id'");
		if ($check->rowCount() > 0) {
			$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Rejected' and emp_id='$id'");
		}else{
			$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Rejected' and optr_id='$id'");
		}
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Rejected' and emp_id='$id'");
		$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and emp_id='$id' and request_no='".$_POST['req']."'");
		while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row1['emp_id'];
			$req = $row1['request_no'];
			$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='Rejected', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
			$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id' and request_no='".$_POST['req']."'");
		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row2['emp_id'];
			$req2 = $row2['request_no'];
			$update = $this->db->query("UPDATE tbloperator_activity set status='Stopped',remarks='Rejected', notes='".$notes."',updated_by='".$_POST['user']."',reason='".$_POST['notes']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
			$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req2."','".$emp_id."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "rejected";
		}else {
			return "error";
		}
	}
	public function toattendance_type()
	{
		$res = $this->db->query("SELECT * FROM tblattendance_type");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->attendance_type[] = $row;
		}
		return $this->attendance_type;
	}
	public function toattendance_date()
	{
		$res = $this->db->query("SELECT d.is_close,d.id,d.attendance_date,t.type,d.updated_at FROM tblattendance_date d,tblattendance_type t where d.attendance_type=t.id");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->attendance_date[] = $row;
		}
		return $this->attendance_date;
	}
	public function toedit_attendance($id)
	{
		$res = $this->db->query("SELECT * FROM tblattendance_date where id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function toupdate_attendance()
	{
		$check = $this->db->query("SELECT * FROM tblattendance_date where attendance_date='".$_POST['attendance_date']."' and attendance_type='".$_POST['attendance_type']."' and id='".$_POST['attendance_id']."'");
		if ($check->rowCount() > 0) {
			return "exist";
		}else{
			$check3 = $this->db->query("SELECT * FROM tblattendance_date where attendance_date='".$_POST['attendance_date']."' and attendance_type='".$_POST['attendance_type']."'");
			if ($check3->rowCount() > 0) {
				return "exist2";
			}else{
				$res = $this->db->query("UPDATE tblattendance_date set attendance_date='".$_POST['attendance_date']."', attendance_type='".$_POST['attendance_type']."' where id='".$_POST['attendance_id']."'");
				$check2 = $this->db->query("SELECT * FROM tblattendance_date where attendance_date='".$_POST['attendance_date']."' and attendance_type='".$_POST['attendance_type']."'");
				if ($check2->rowCount() > 0) {
					return "updated";
				}else{
					return "error";
				}
			}
		}
	}
	public function toget_date($id)
	{
		$res = $this->db->query("SELECT d.is_close,d.id,d.attendance_date,t.type FROM tblattendance_date d,tblattendance_type t where d.id='$id' and d.attendance_type=t.id");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function toattendance_save()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$check1 = $this->db->query("SELECT * FROM tblattendance_date where attendance_date='".$_POST['attendance_date']."' and attendance_type='".$_POST['attendance_type']."' ");
		if ($check1->rowCount() > 0) {
			return "exist";
		}else{
			$res = $this->db->query("INSERT INTO tblattendance_date(attendance_date,attendance_type,encoded_by,created_at)values('".$_POST['attendance_date']."','".$_POST['attendance_type']."','".$_POST['user']."','".$Ctime."')");
			$check = $this->db->query("SELECT * FROM tblattendance_date where attendance_date='".$_POST['attendance_date']."' and attendance_type='".$_POST['attendance_type']."' ");
			if ($check->rowCount() > 0) {
				return "added";
			}else{
				return "error";
			}
		}
	}
	public function toemployee_attendance($id)
	{
		$res = $this->db->query("SELECT e.fname,e.mname,e.lname,e.emp_id FROM tblattendance a,tblemployee e where a.emp_id=e.emp_id and a.attendance_date='$id' ");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->employee_attendance[] = $row;
		}
		return $this->employee_attendance;
	}
	public function get_is_available()
	{
		$timezone  = +8;
		$today = date("Y-m-d");
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("SELECT * FROM tblattendance_date where id='".$_POST['date_id']."' ");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		$date = $row['attendance_date'];
		if ($date == $today) {
			$check_emp = $this->db->query("SELECT * FROM tblattendance where emp_id='".$_POST['emp_id']."' and attendance_date='".$_POST['date_id']."'");
			if ($check_emp->rowCount() > 0) {
				return "exist";
			}else{
				$insert = $this->db->query("INSERT INTO tblattendance(emp_id,attendance_date,encoded_by,created_at)values('".$_POST['emp_id']."','".$_POST['date_id']."','".$_POST['user']."','".$Ctime."')");
				$update = $this->db->query("UPDATE tblemployee set is_present='1',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$_POST['emp_id']."'");
				$update2 = $this->db->query("UPDATE tblusers set account_stat='Active',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where user_id='".$_POST['emp_id']."'");
				$check = $this->db->query("SELECT * FROM tblattendance where emp_id='".$_POST['emp_id']."' and attendance_date='".$_POST['date_id']."'");
				if ($check->rowCount() > 0) {
					return "added";
				}else{
					return "error";
				}
			}
		}else {
			$check_emp = $this->db->query("SELECT * FROM tblattendance where emp_id='".$_POST['emp_id']."' and attendance_date='".$_POST['date_id']."'");
			if ($check_emp->rowCount() > 0) {
				return "exist";
			}else{
				$insert = $this->db->query("INSERT INTO tblattendance(emp_id,attendance_date,encoded_by,created_at)values('".$_POST['emp_id']."','".$_POST['date_id']."','".$_POST['user']."','".$Ctime."')");
				$check = $this->db->query("SELECT * FROM tblattendance where emp_id='".$_POST['emp_id']."' and attendance_date='".$_POST['date_id']."'");
				if ($check->rowCount() > 0) {
					return "added";
				}else{
					return "error";
				}
			}
		}
	}
	public function get_del_attendance()
	{
		$timezone  = +8;
		$today = date("Y-m-d");
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("SELECT * FROM tblattendance_date where id='".$_POST['date_id']."' ");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		$date = $row['attendance_date'];
		if ($date == $today) {
			$delete = $this->db->query("DELETE FROM tblattendance where emp_id='".$_POST['emp_id']."' and attendance_date='".$_POST['date_id']."'");
			$update = $this->db->query("UPDATE tblemployee set is_present='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$_POST['emp_id']."'");
			$check = $this->db->query("SELECT * FROM tblattendance where emp_id='".$_POST['emp_id']."' and attendance_date='".$_POST['date_id']."'");
			if ($check->rowCount() > 0) {
				return "error";
			}else{
				return "deleted";
			}
		}else {
			$delete = $this->db->query("DELETE FROM tblattendance where emp_id='".$_POST['emp_id']."' and attendance_date='".$_POST['date_id']."'");
			$check = $this->db->query("SELECT * FROM tblattendance where emp_id='".$_POST['emp_id']."' and attendance_date='".$_POST['date_id']."'");
			if ($check->rowCount() > 0) {
				return "error";
			}else{
				return "deleted";
			}
		}
	}
	public function todel_all_attendance($id)
	{
		$delete = $this->db->query("DELETE FROM tblattendance_date where id='".$id."'");
		$delete2 = $this->db->query("DELETE FROM tblattendance where attendance_date='".$id."'");
		$check = $this->db->query("SELECT * FROM tblattendance_date where id='".$id."'");
		$check2 = $this->db->query("SELECT * FROM tblattendance where attendance_date='".$id."'");
		if ($check->rowCount() > 0 && $check2->rowCount() > 0) {
			return "error";
		}else{
			return "deleted";
		}
	}
	public function toclose_attendance($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$today = date("Y-m-d");
		$get = $this->db->query("SELECT * FROM tblattendance_date where id='".$id."'");
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$date = $row['attendance_date'];
		if ($date == $today) {
			$res = $this->db->query("SELECT * FROM tblattendance where attendance_date='".$id."'");
			while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
			{
				$emp_id = $row['emp_id'];
				$update = $this->db->query("UPDATE tblemployee set is_present='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."'");
			}
		}
		$update = $this->db->query("UPDATE tblattendance_date set is_close='1',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$id."'");
		$check2 = $this->db->query("SELECT * FROM tblattendance_date where id='".$id."' and is_close='1'");
		if ($check2->rowCount() > 0) {
			return "closed";
		}else{
			return "error";
		}
	}
	public function topersonnel_timestamp()
	{
		$res = $this->db->query("SELECT t.status,e.fname,e.mname,e.lname,e.emp_id,t.status,t.request_no,t.work_started,t.work_stopped,t.work_resumed,t.work_completed,t.total_time,t.reason FROM tblemployee e,tbljobperactivity_timestamp t where t.emp_id=e.emp_id");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->personnel_timestamp[] = $row;
		}
		return $this->personnel_timestamp;
	}
	public function tooperator_timestamp()
	{
		$res = $this->db->query("SELECT t.status,e.fname,e.mname,e.lname,e.emp_id,t.status,t.request_no,t.work_started,t.work_stopped,t.work_resumed,t.work_completed,t.total_time,t.reason FROM tblemployee e,tbljoboptractivity_timestamp t where t.emp_id=e.emp_id");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->operator_timestamp[] = $row;
		}
		return $this->operator_timestamp;
	}
	public function toequipment_timestamp()
	{
		$res = $this->db->query("SELECT t.status,e.eqpt_name,t.status,t.request_no,t.work_started,t.work_stopped,t.work_resumed,t.work_completed,t.total_time,t.reason FROM tblequipment e,tblequipment_timestamp t where t.eq_code=e.id");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->equipment_timestamp[] = $row;
		}
		return $this->equipment_timestamp;
	}
	public function toupload()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$file = $_FILES['excel']['tmp_name'];
		$user = $_POST['username'];
		$csv = fopen($file, "r");
		$data = fgetcsv($csv, 1000, ",");
	// $handler = array();
		if (($handle = fopen($file, "r")) !== FALSE) {
			$handler = array();
			$ctr=0;
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$fname = str_replace("'", " ", $data[2]);
				$mname = str_replace("'", " ", $data[3]);
				$lname = str_replace("'", " ", $data[1]);
				$check = $this->db->query("SELECT * FROM tblemployee where emp_id='".$data[0]."'");
				if ($check->rowCount() > 0) {
					
				}else{
					if ($fname != null && $lname!=null && $data[0]!=null && $data[4]!=null && $data[5]!=null) {
						$insert = $this->db->query("INSERT INTO tblemployee(emp_id,lname,fname,mname,mp_id,employment_status,encoded_by,created_at,status)VALUES('".$data[0]."','".$lname."','".$fname."','".$mname."','".$data[4]."','".$data[5]."','".$user."','".$Ctime."','".$data[6]."')");
						$ctr++;
					}else{

					}
				}
			}
			fclose($handle);
			$check2 = $this->db->query("SELECT * FROM tblemployee where created_at='".$Ctime."'");
			if ($check2->rowCount() > 0) {
				$handler = array("msg"=>"added","ctr"=>$ctr);
				return $handler;
			}else{
				$handler = array("msg"=>"error","ctr"=>$ctr);
				return $handler;
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
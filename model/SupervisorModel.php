<?php 

class SupervisorModel
{
	private $db;
	private $id;

	public function __construct()
	{
		require_once("../../assets/connect.php");
		$this->db = Connect::dbconnect();
		$this->data = array();
		$this->data_foreman = array();
		$this->data_info1 = array();
		$this->data_info2 = array();
		$this->data_allinfo = array();
		$this->data_activity = array();
		$this->personnel_arr = array();
		$this->data_eqptgiv = array();
		$this->all_operator = array();
		$this->all_gang = array();
		$this->search_job = array();
		$this->toPersonnel_activity_arr = array();
		$this->toOperator_activity_arr = array();
		$this->per_added_task = array();
		$this->optr_added_task = array();
		$this->timestamps = array();
		$this->job_equipment = array();
		$this->equipment_act = array();

	}
	
	public function get_Job_order_list()
	{
		$jobs = $this->db->query("SELECT * FROM tbljoborderrequest where is_removed='0' ORDER BY id DESC");
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
	public function getcurrent_pass($user,$id)
	{
		$res = $this->db->query("SELECT * FROM tblusers where username='$user' and id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function getForeman()
	{
		$res = $this->db->query("SELECT * FROM tblusers where role='2'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_foreman[] = $row;
		}
		return $this->data_foreman;
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
	public function toAssign_foreman()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("UPDATE tbljoborderrequest set foreman_id='".$_POST['id']."',foreman_name='".$_POST['name']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['req_no']."'");
		if ($res == true) {
			return "assigned";
		}else {
			return "error";
		}
	}
	public function toActivate_req()
	{
		$check = $this->db->query("SELECT * FROM tbljoborderrequest where id='".$_POST['id']."' and foreman_id=0");
		if ($check->rowCount() >0) {
			return "noforeman";
		}else{
			$res = $this->db->query("UPDATE tbljoborderrequest set status='activated' where id='".$_POST['id']."'");
			if ($res == true) {
				return "activated";
			}else {
				return "error";
			}
		}
	}
	// public function toCancel_req()
	// {
	// 	$timezone  = +7;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$remarks = "cancelled by ".$_POST['user'];
	// 	$res = $this->db->query("UPDATE tbljoborderrequest set status='cancelled',work_stopped='".$Ctime."',remarks='".$remarks."' where request_no='".$_POST['id']."'");
	// 	$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where status!='completed' and request_no='".$_POST['id']."'");
	// 	while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req = $row['request_no'];
	// 		$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped', work_stopped='".$Ctime."',remarks='cancelled',notes='".$remarks."' where request_no='".$req."'");
	// 	}
	// 	$res3 = $this->db->query("SELECT * FROM tbloperator_activity where status!='completed' and request_no='".$_POST['id']."'");
	// 	while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req2 = $row['request_no'];
	// 		$update2 = $this->db->query("UPDATE tbloperator_activity set status='stopped', work_stopped='".$Ctime."',remarks='cancelled',notes='".$remarks."' where request_no='".$req2."'");
	// 	}
	// 	$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='cancelled' and request_no='".$_POST['id']."'");
	// 	if ($check->rowCount() > 0) {
	// 		return "cancelled";
	// 	}else {
	// 		return "error";
	// 	}
	// }
	// public function toStop_req()
	// {
	// 	$timezone  = +7;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$remarks = "stopped by ".$_POST['user']."(supervisor)";
	// 	$res = $this->db->query("UPDATE tbljoborderrequest set status='closed',work_stopped='".$Ctime."',remarks='".$remarks."' where request_no='".$_POST['id']."'");
	// 	$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where status!='completed' and request_no='".$_POST['id']."'");
	// 	while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req = $row['request_no'];
	// 		$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped', work_stopped='".$Ctime."',remarks='closed',notes='".$remarks."' where request_no='".$req."'");
	// 	}
	// 	$res3 = $this->db->query("SELECT * FROM tbloperator_activity where status!='completed' and request_no='".$_POST['id']."'");
	// 	while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req2 = $row['request_no'];
	// 		$update2 = $this->db->query("UPDATE tbloperator_activity set status='stopped', work_stopped='".$Ctime."', remarks='closed',notes='".$remarks."' where request_no='".$req2."'");
	// 	}
	// 	$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='stopped' and request_no='".$_POST['id']."'");
	// 	if ($check->rowCount() > 0) {
	// 		return "stopped";
	// 	}else {
	// 		return "error";
	// 	}
	// }
	// public function getInfo_req($id)
	// {
	// 	$res = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id'");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->data_info1[] = $row;
	// 	}
	// 	return $this->data_info1;
		// $res2 = $this->db->query("SELECT * FROM tblman where request_no='$id'");
		// while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		// {
		// 	$this->data_info1[] = $row;
		// }
		// $data_allinfo =$this->data_info1;
	// }
	public function toActivity($id)
	{
		$res = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_activity[] = $row;
		}
		return $this->data_activity;
	}
	public function toPersonnel($id)
	{
		$res = $this->db->query("SELECT emp.fname,emp.id,emp.mname,emp.lname,mp.mp_name FROM tblgivenmanpower_req mp1,tblemployee emp,tblmanpower mp where mp1.emp_id=emp.emp_id and emp.mp_id=mp.id and mp1.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->personnel_arr[] = $row;
		}
		return $this->personnel_arr;
	}
	public function equipment_given($id)
	{
		$res = $this->db->query("SELECT emp.fname,emp.id,emp.mname,emp.lname,eqpt2.eqpt_name FROM tblgivenequipment_req eqpt1,tblemployee emp,tblequipment eqpt2 where eqpt1.optr_id=emp.emp_id and eqpt1.eqpt_id=eqpt2.id and eqpt1.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_eqptgiv[] = $row;
		}
		return $this->data_eqptgiv;
	}
	public function all_operator($id)
	{
		$res = $this->db->query("SELECT emp.fname,emp.id,emp.emp_id,emp.mname,emp.lname,mp.mp_name FROM tblgivenequipment_req eqpt1,tblemployee emp, tblmanpower mp where eqpt1.optr_id=emp.emp_id and mp.mp_code='operator' and emp.mp_id=mp.id and eqpt1.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->all_operator[] = $row;
		}
		return $this->all_operator;
	}
	public function all_gang($id)
	{
		$res = $this->db->query("SELECT emp.fname,emp.id,emp.emp_id,emp.mname,emp.lname,mp.mp_name FROM tblgivenmanpower_req emp1,tblemployee emp, tblmanpower mp where emp1.emp_id=emp.emp_id and emp.mp_id=mp.id and emp1.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->all_gang[] = $row;
		}
		return $this->all_gang;
	}
	public function toSearch_data()
	{
		$jobs = $this->db->query("SELECT * FROM tbljoborderrequest where request_no LIKE '".$_POST['search_data']."%'");
		while ($row = $jobs->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->search_job[] = $row;
		}
		return $this->search_job;
	}
	public function toPersonnel_activity($id)
	{
		$res = $this->db->query("SELECT per.status,per.id,emp.emp_id,emp.fname,emp.mname,emp.lname,mp.mp_name,per.remarks FROM tblpersonnel_activity per,tblemployee emp,tblmanpower mp where per.emp_id=emp.emp_id and emp.mp_id=mp.id and mp.mp_code='Personnel' and per.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->toPersonnel_activity_arr[] = $row;
		}
		return $this->toPersonnel_activity_arr;
	}
	public function toOperator_activity($id)
	{
		$res = $this->db->query("SELECT optr.id,emp.fname,emp.mname,emp.lname,mp.mp_name,optr.temp_designation,optr.status,optr.remarks FROM tbloperator_activity optr,tblmanpower mp,tblemployee emp where optr.emp_id=emp.emp_id and emp.mp_id=mp.id and optr.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->toOperator_activity_arr[] = $row;
		}
		return $this->toOperator_activity_arr;
	}
	public function toSubmit_status()
	{
		// $check_foreman = $this->db->query("SELECT * FROM tbljoborderrequest where foreman_id!='0' and request_no='".$_POST['req']."'");
		// if ($check_foreman->rowCount() > 0) {
			$timezone  = +8;
			$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
			if($_POST['status'] == "activated"){
				$remarks = "activated by ".$_POST['user']."(supervisor)";
				// $check_foreman = $this->db->query("SELECT * FROM tbljoborderrequest where foreman_id='0' and request_no='".$_POST['req']."'");
				// if ($check_foreman->rowCount() > 0) {
				// 	return "no_foreman";
				// }else{
					$res = $this->db->query("UPDATE tbljoborderrequest set status='activated',remarks='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."'");
					$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='activated' and request_no='".$_POST['req']."'");
					if ($check->rowCount() > 0) {
						return "updated";
					}else {
						return "error";
					}
				// }
			}else{
				$res = $this->db->query("UPDATE tbljoborderrequest set status='queued',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."'");
				$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='queued' and request_no='".$_POST['req']."'");
				if ($check->rowCount() > 0) {
					return "updated";
				}else {
					return "error";
				}
			}
		// }else{
		// 	return "no_foreman";
		// }
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
	public function toremove_id($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("UPDATE tbljoborderrequest set is_removed='1', removed_by='".$_POST['user']."', updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='$id'");
		$check = $this->db->query("SELECT * FROM tbljoborderrequest where is_removed='1' and removed_by='".$_POST['user']."'");
		if ($check->rowCount() > 0) {
			return "removed";
		}else {
			return "error";
		}
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
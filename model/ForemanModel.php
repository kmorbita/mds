<?php 

class ForemanModel
{
	private $db;
	private $id;

	public function __construct()
	{
		require_once("../../assets/connect.php");
		$this->db = Connect::dbconnect();
		$this->data = array();
		$this->data_activity = array();
		$this->eqpt = array();
		$this->personnel_arr = array();
		$this->data_eqptgiv = array();
		$this->all_operator = array();
		$this->all_gang = array();
		$this->messages = array();
		$this->getPersonnel_task = array();
		$this->getpersonnel_task_data = array();
		$this->getequipment_task_data = array();
		$this->getequipment_task = array();
		$this->search_job = array();
		$this->per_table_task = array();
		$this->eqpt_table_task = array();
		$this->per_added_task = array();
		$this->optr_added_task = array();
		$this->assigned_emp = array();
		$this->data_jobeqpt = array();
		$this->data_jobmp = array();
		$this->data_mpgiv = array();
		$this->data_eqptgiv = array();
		$this->data_mp_req = array();
		$this->to_assigned_optr = array();
		$this->task = array();
		$this->data_mp = array();
		$this->timestamps = array();
		$this->operator_act = array();
		$this->emp_info = array();
		$this->personnel_act = array();
		$this->excel4 = array();
		$this->excel5 = array();
		$this->per_task_time = array();
		$this->optr_task_time = array();
		$this->job_eqpt_list = array();
		$this->job_equipment = array();
		$this->equipment_act = array();
		$this->data_emp = array();
		$this->data_equip3 = array();
		$this->fill_eqpt_needed = array();
	}
	
	public function get_Job_order_list($id)
	{
		$jobs = $this->db->query("SELECT * FROM tbljoborderrequest where foreman_id='0' ORDER BY id DESC");
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
	public function toWork($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$remarks = "Worked by".$_POST['user']."(Foreman)";
			$check_eqpt = $this->db->query("SELECT * FROM tblequipreq where request_no='$id' and no_optr='1'");

			if ($check_eqpt->rowCount() > 0) {
				$check_mp2 = $this->db->query("SELECT * FROM tblgivenmanpower_req mp_req,tblemployee emp where mp_req.request_no='$id' and mp_req.emp_id=emp.emp_id and emp.job_stat='Dispatched'");
				$check_mp2_2 = $this->db->query("SELECT * FROM tblmanpowerreq where request_no='$id'");
				$given_mp_ctr = $check_mp2->rowCount();
				$given_mp_ctr2 = $check_mp2_2->rowCount();
				$check_eqpt2 = $this->db->query("SELECT * FROM tblgivenequipment_req eq_req,tblemployee emp where eq_req.request_no='$id' and eq_req.optr_id=emp.emp_id and emp.job_stat='Dispatched'");
				$check_eqpt2_2 = $this->db->query("SELECT * FROM tblequipreq where request_no='$id' and no_optr='1'");
				$given_eqpt_ctr = $check_eqpt2->rowCount();
				$given_eqpt_ctr2 = $check_eqpt2_2->rowCount();
				if ($given_mp_ctr != $given_mp_ctr2 && $given_eqpt_ctr != $given_eqpt_ctr2) {
					return "no_records";
				}else{
				// return "given Manpower: ".$given_mp_ctr."\nManpower: ".$given_mp_ctr2."\ngiven Equipment: ".$given_eqpt_ctr."\nEquipment: ".$given_eqpt_ctr2."\n";
					$res = $this->db->query("UPDATE tbljoborderrequest set status='working',remarks='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='$id'");
					$ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_started,encoded_by,created_at)values('".$id."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
					$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where status='queued' and request_no='$id'");
					while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
					{
						$req = $row['request_no'];
						$emp_id = $row['emp_id'];
						$update = $this->db->query("UPDATE tblpersonnel_activity set status='working',remarks='working',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$id."'");
						$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$req."','".$emp_id."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
					}
					$res3 = $this->db->query("SELECT * FROM tbloperator_activity where status='queued' and request_no='$id'");
					while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
					{
						$req2 = $row['request_no'];
						$emp_id2 = $row['emp_id'];
						$update = $this->db->query("UPDATE tbloperator_activity set status='working', remarks='working',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."'");
						$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$req2."','".$emp_id2."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
					}
					$res4 = $this->db->query("SELECT * FROM tblequipreq where request_no='$id'");
					while ($row = $res4->fetch(PDO::FETCH_ASSOC)) 
					{
						$req2 = $row['request_no'];
						$eq_code = $row['eq_code'];
						$rem = $row['remarks'];
						if ($rem == "Relieved" || $rem == "stopped") {

						}else{
							$update2 = $this->db->query("UPDATE tblequipreq set status='working',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and eq_code='".$eq_code."'");
							$update3 = $this->db->query("UPDATE tblequipment set status='Working' where id='".$eq_code."'");
							$ins_optr_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_started,encoded_by,created_at)values('".$req2."','".$eq_code."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
						}
					}
					$check = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id' and status='working'");
					if ($check->rowCount() > 0) {
						return "working";
					}else {
						return "error";
					}
				}
			}else {
				$check_mp2 = $this->db->query("SELECT * FROM tblgivenmanpower_req mp_req,tblemployee emp where mp_req.request_no='$id' and mp_req.request_no=emp.request_no and emp.job_stat='Dispatched'");
				if ($check_mp2->rowCount() <= 0) {
					return "no_personnel";
				}else{
					$res = $this->db->query("UPDATE tbljoborderrequest set status='working',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='$id'");
					$ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_started,encoded_by,created_at)values('".$id."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
					$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where status='queued' and request_no='$id'");
					while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
					{
						$req = $row['request_no'];
						$emp_id = $row['emp_id'];
						$update = $this->db->query("UPDATE tblpersonnel_activity set status='working',remarks='closed',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$id."'");
						$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$req."','".$emp_id."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
					}
					$res3 = $this->db->query("SELECT * FROM tbloperator_activity where status='queued' and request_no='$id'");
					while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
					{
						$req2 = $row['request_no'];
						$emp_id2 = $row['emp_id'];
						$update2 = $this->db->query("UPDATE tbloperator_activity set status='working', remarks='closed',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."'");
						$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$req2."','".$emp_id2."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
					}
					$res4 = $this->db->query("SELECT * FROM tblequipreq where request_no='$id'");
					while ($row = $res4->fetch(PDO::FETCH_ASSOC)) 
					{
						$req2 = $row['request_no'];
						$eq_code = $row['eq_code'];
						$rem = $row['remarks'];
						if ($rem == "Relieved" || $rem == "stopped") {

						}else{
							$update2 = $this->db->query("UPDATE tblequipreq set status='working',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and eq_code='".$eq_code."'");
							$update3 = $this->db->query("UPDATE tblequipment set status='Working' where id='".$eq_code."'");
							$ins_optr_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_started,encoded_by,created_at)values('".$req2."','".$eq_code."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
						}
					}
					$check = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id' and status='working'");
					if ($check->rowCount() > 0) {
						return "working";
					}else {
						return "error";
					}
				}
			}
		}
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
	public function toPersonnel($id)
	{
		$res = $this->db->query("SELECT emp.fname,emp.id as emp_id2,emp.emp_id,emp.mname,emp.lname,mp.mp_name FROM tblgivenmanpower_req mp1,tblemployee emp,tblmanpower mp where mp1.emp_id=emp.emp_id and emp.mp_id=mp.id and mp.mp_code='Personnel' and emp.job_stat='Dispatched' and mp1.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->personnel_arr[] = $row;
		}
		return $this->personnel_arr;
	}
	// public function equipment_given($id)
	// {
	// 	$res = $this->db->query("SELECT emp.fname,emp.id,emp.emp_id,emp.mname,emp.lname,eqpt2.eqpt_name FROM tblgivenequipment_req eqpt1,tblemployee emp,tblequipment eqpt2 where eqpt1.optr_id=emp.emp_id and eqpt1.eqpt_id=eqpt2.id and eqpt1.request_no='$id'");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->data_eqptgiv[] = $row;
	// 	}
	// 	return $this->data_eqptgiv;
	// }
	public function all_operator($id)
	{
		$res = $this->db->query("SELECT emp.fname,emp.id,emp.emp_id,emp.mname,emp.lname,eqpt1.status,mp.mp_name FROM tblgivenequipment_req eqpt1,tblemployee emp, tblmanpower mp where eqpt1.optr_id=emp.emp_id and mp.mp_code='operator' and emp.mp_id=mp.id and eqpt1.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->all_operator[] = $row;
		}
		return $this->all_operator;
	}
	public function all_gang($id)
	{
		$res = $this->db->query("SELECT emp.fname,emp.id,emp.emp_id,emp.mname,emp.lname,emp1.status,mp.mp_name FROM tblgivenmanpower_req emp1,tblemployee emp, tblmanpower mp where emp1.emp_id=emp.emp_id and emp.mp_id=mp.id and emp1.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->all_gang[] = $row;
		}
		return $this->all_gang;
	}
	public function toNotify_eq_given()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("INSERT INTO tblnotify(to_user_role,message_title,message_content,from_username,from_name,status,date_sent,request_no)values('3','".$_POST['msg_title']."','".$_POST['msg_content']."','".$_POST['username']."','".$_POST['name']."','not seen','".$Ctime."','".$_POST['job_req']."')");
		$check = $this->db->query("SELECT * FROM tblnotify where to_user_role='3' and message_title='".$_POST['msg_title']."' and message_content='".$_POST['msg_content']."' and from_username='".$_POST['username']."' and from_name='".$_POST['name']."'");
		if ($check->rowCount() >0) {
			return "sent";
		}else {
			return "error";
		}
	}
	public function getMessages($msg)
	{
		$res = $this->db->query("SELECT n.from_name,n.status,n.message_content,n.date_sent,n.date_response,n.is_replied,n.id,n.is_response_seen,n.is_replied,n.response,j.status as job_stat FROM tblnotify n,tbljoborderrequest j where n.request_no=j.request_no and n.from_username='$msg' ORDER BY id DESC");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->messages[] = $row;
		}
		return $this->messages;
	}
	public function toViewmessages($id)
	{
		$res = $this->db->query("SELECT * FROM tblnotify where id='$id'");
		$res2 = $this->db->query("UPDATE tblnotify set is_response_seen='1' where id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row['response'];
	}
	public function toCount_message($user)
	{
		$res = $this->db->query("SELECT * FROM tblnotify where is_replied='1' and is_response_seen='0' and from_username='$user'");
		$count = $res->rowCount();
		return $count;
	}
	// public function getPersonnel_task($id)
	// {
	// 	$res = $this->db->query("SELECT * FROM tbltasks where task_for='Personnel' and request_no = '$id'");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->getPersonnel_task[] = $row;
	// 	}
	// 	return $this->getPersonnel_task;
	// }
	// public function getequipment_task($id)
	// {
	// 	$res = $this->db->query("SELECT * FROM tbltasks where task_for='Equipment' and request_no = '$id'");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->getequipment_task[] = $row;
	// 	}
	// 	return $this->getequipment_task;
	// }
	public function toAdd_personnel()
	{
		$msg = array();
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$checkIfexist = $this->db->query("SELECT * FROM tblpersonnel_task where request_no ='".$_POST['req']."' and task='".$_POST['task']."'");
		if ($checkIfexist->rowCount() > 0) {
			return "existed";
		}else{
			$res = $this->db->query("INSERT INTO tblpersonnel_task (request_no,task,encoded_by,created_at,status)values('".$_POST['req']."','".$_POST['task']."','".$_POST['user']."','".$Ctime."','queued')");
			$check = $this->db->query("SELECT * FROM tblpersonnel_task where request_no ='".$_POST['req']."' and task='".$_POST['task']."'");
			if ($check->rowCount() > 0) {
				return "true";
			}else {
				return "error";
			}
		}
	}
	public function toAdd_operator()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$checkIfexist = $this->db->query("SELECT * FROM tbloperator_task where request_no ='".$_POST['req']."' and task='".$_POST['task']."'");
		if ($checkIfexist->rowCount() > 0) {
			return "existed";
		}else{
			$res = $this->db->query("INSERT INTO tbloperator_task (request_no,task,encoded_by,created_at,status)values('".$_POST['req']."','".$_POST['task']."','".$_POST['user']."','".$Ctime."','queued')");
			$check = $this->db->query("SELECT * FROM tbloperator_task where request_no ='".$_POST['req']."' and task='".$_POST['task']."'");
			if ($check->rowCount() > 0) {
				return "true";
			}else {
				return "error";
			}
		}
	}
	// public function getpersonnel_task_data($id)
	// {
	// 	$res = $this->db->query("SELECT task.task,job.task as task_id,job.status,job.id FROM tblpersonnel_task job,tbltasks task where job.task=task.id and task.task_for='Personnel' and job.request_no = '$id'");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->getpersonnel_task_data[] = $row;
	// 	}
	// 	return $this->getpersonnel_task_data;
	// }
	// public function getequipment_task_data($id)
	// {
	// 	$res = $this->db->query("SELECT task.task,job.task as task_id,job.status,job.id FROM tbloperator_task job,tbltasks task where job.task=task.id and task.task_for='Equipment' and job.request_no = '$id'");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->getequipment_task_data[] = $row;
	// 	}
	// 	return $this->getequipment_task_data;
	// }
	public function toworking_jobs($id)
	{
		$jobs = $this->db->query("SELECT * FROM tbljoborderrequest where foreman_id='$id' and is_removed='0' ORDER BY id DESC");
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
	// public function personnel_table_task($id)
	// {
	// 	$jobs = $this->db->query("SELECT task.task,job.id FROM tblpersonnel_task job,tbltasks task where job.request_no=task.request_no and job.task=task.id and task.task_for='Personnel' and job.request_no = '$id'");
	// 	while ($row = $jobs->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->per_table_task[] = $row;
	// 	}
	// 	return $this->per_table_task;
	// }
	// public function equipment_table_task($id)
	// {
	// 	$jobs = $this->db->query("SELECT task.task,job.id FROM tbloperator_task job,tbltasks task where job.request_no=task.request_no and job.task=task.id and task.task_for='Equipment' and job.request_no = '$id'");
	// 	while ($row = $jobs->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->eqpt_table_task[] = $row;
	// 	}
	// 	return $this->eqpt_table_task;
	// }
	public function per_work_start($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row = $status->fetch(PDO::FETCH_ASSOC);
			$job_stat = $row['status'];
			if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
				$check_task = $this->db->query("SELECT * FROM tblpersonnel_task where task='".$_POST['task_id']."' and request_no='".$_POST['req']."' and status!='working' and status!='resumed'");
				if ($check_task->rowCount() > 0) {
					return "not_started";
				}else{
					$res = $this->db->query("UPDATE tblpersonnel_activity set status='working',remarks='working',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
					$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
					while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
					{
						$req=$row['request_no'];
						$emp_id=$row['emp_id'];
						$task=$row['task'];
						$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,task,status,work_started,encoded_by,created_at)values('".$req."','".$emp_id."','".$task."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
					}
					$check = $this->db->query("SELECT * FROM tblpersonnel_activity where id='".$id."' and status='working'");
					if ($check->rowCount() > 0) {
						return "started";
					}else {
						return "error";
					}
				}
			}else {
				return $job_stat;
			}
		}
	}
	public function per_work_pause($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row = $status->fetch(PDO::FETCH_ASSOC);
			$job_stat = $row['status'];
			if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
				$res = $this->db->query("UPDATE tblpersonnel_activity set status='paused',remarks='paused',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
				$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
				while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
				{
					$req=$row['request_no'];
					$emp_id=$row['emp_id'];
					$task=$row['task'];
					$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,task,status,work_paused,encoded_by,created_at)values('".$req."','".$emp_id."','".$task."','paused','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				}
				$check = $this->db->query("SELECT * FROM tblpersonnel_activity where id='".$id."' and status='paused'");
				if ($check->rowCount() > 0) {
					return "paused";
				}else {
					return "error";
				}
			}else {
				return $job_stat;
			}
		}
	}
	public function per_work_stop($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row = $status->fetch(PDO::FETCH_ASSOC);
			$job_stat = $row['status'];
			if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
				$res = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='stopped',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where id='$id'");
				$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
				while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
				{
					$req=$row['request_no'];
					$emp_id=$row['emp_id'];
					$task=$row['task'];
					$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,task,status,work_stopped,encoded_by,created_at)values('".$req."','".$emp_id."','".$task."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				}
				$check = $this->db->query("SELECT * FROM tblpersonnel_activity where id='".$id."' and status='stopped'");
				if ($check->rowCount() > 0) {
					return "stopped";
				}else {
					return "error";
				}
			}else {
				return $job_stat;
			}
		}
	}
	public function per_work_continue($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row = $status->fetch(PDO::FETCH_ASSOC);
			$job_stat = $row['status'];
			if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
				$check_task = $this->db->query("SELECT * FROM tblpersonnel_task where task='".$_POST['task_id']."' and request_no='".$_POST['req']."' and status='paused'");
				if ($check_task->rowCount() > 0) {
					return "not_started";
				}else{
					$res = $this->db->query("UPDATE tblpersonnel_activity set status='resumed',remarks='resumed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
					$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
					while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
					{
						$req=$row['request_no'];
						$emp_id=$row['emp_id'];
						$task=$row['task'];
						$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,task,status,work_resumed,encoded_by,created_at)values('".$req."','".$emp_id."','".$task."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
					}
					$check = $this->db->query("SELECT * FROM tblpersonnel_activity where id='".$id."' and status='resumed'");
					if ($check->rowCount() > 0) {
						return "continued";
					}else {
						return "error";
					}
				}
			}else {
				return $job_stat;
			}
		}
	}
	public function per_work_complete($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row = $status->fetch(PDO::FETCH_ASSOC);
			$job_stat = $row['status'];
			if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
				$res = $this->db->query("UPDATE tblpersonnel_activity set status='completed',remarks='completed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
				$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
				while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
				{
					$req=$row['request_no'];
					$emp_id=$row['emp_id'];
					$task=$row['task'];
					$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,task,status,work_completed,encoded_by,created_at)values('".$req."','".$emp_id."','".$task."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				}
				$check = $this->db->query("SELECT * FROM tblpersonnel_activity where id='".$id."' and status='completed'");
				if ($check->rowCount() > 0) {
					return "complete";
				}else {
					return "error";
				}
			}else {
				return $job_stat;
			}
		}
	}
	public function optr_work_start($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row = $status->fetch(PDO::FETCH_ASSOC);
			$job_stat = $row['status'];
			if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
				$check_task = $this->db->query("SELECT * FROM tbloperator_task where task='".$_POST['task_id']."' and request_no='".$_POST['req']."' and status!='working' and status!='resumed'");
				if ($check_task->rowCount() > 0) {
					return "not_started";
				}else{
					$res = $this->db->query("UPDATE tbloperator_activity set status='working',remarks='working',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
					$res2 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
					while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
					{
						$req=$row['request_no'];
						$emp_id=$row['emp_id'];
						$task=$row['task'];
						$ins_per_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,task,status,work_started,encoded_by,created_at)values('".$req."','".$emp_id."','".$task."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
					}
					$check = $this->db->query("SELECT * FROM tbloperator_activity where id='".$id."' and status='working'");
					if ($check->rowCount() > 0) {
						return "started";
					}else {
						return "error";
					}
				}
			}else {
				return $job_stat;
			}
		}
	}
	public function optr_work_pause($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row = $status->fetch(PDO::FETCH_ASSOC);
			$job_stat = $row['status'];
			if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
				$res = $this->db->query("UPDATE tbloperator_activity set status='paused',remarks='paused',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
				$res2 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
				while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
				{
					$req=$row['request_no'];
					$emp_id=$row['emp_id'];
					$task=$row['task'];
					$ins_per_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,task,status,work_paused,encoded_by,created_at)values('".$req."','".$emp_id."','".$task."','paused','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				}
				$check = $this->db->query("SELECT * FROM tbloperator_activity where id='".$id."' and status='paused'");
				if ($check->rowCount() > 0) {
					return "paused";
				}else {
					return "error";
				}
			}else {
				return $job_stat;
			}
		}
	}
	public function optr_work_stop($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row = $status->fetch(PDO::FETCH_ASSOC);
			$job_stat = $row['status'];
			if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
				$res = $this->db->query("UPDATE tbloperator_activity set status='stopped',remarks='stopped',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where id='$id'");
				$res2 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
				while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
				{
					$req=$row['request_no'];
					$emp_id=$row['emp_id'];
					$task=$row['task'];
					$ins_per_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,task,status,work_stopped,encoded_by,created_at)values('".$req."','".$emp_id."','".$task."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				}
				$check = $this->db->query("SELECT * FROM tbloperator_activity where id='".$id."' and status='stopped'");
				if ($check->rowCount() > 0) {
					return "stopped";
				}else {
					return "error";
				}
			}else {
				return $job_stat;
			}
		}
	}
	public function optr_work_continue($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row = $status->fetch(PDO::FETCH_ASSOC);
			$job_stat = $row['status'];
			if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
				$check_task = $this->db->query("SELECT * FROM tbloperator_task where task='".$_POST['task_id']."' and request_no='".$_POST['req']."' and status='paused'");
				if ($check_task->rowCount() > 0) {
					return "not_started";
				}else{
					$res = $this->db->query("UPDATE tbloperator_activity set status='resumed',remarks='resumed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
					$res2 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
					while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
					{
						$req=$row['request_no'];
						$emp_id=$row['emp_id'];
						$task=$row['task'];
						$ins_per_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,task,status,work_resumed,encoded_by,created_at)values('".$req."','".$emp_id."','".$task."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
					}
					$check = $this->db->query("SELECT * FROM tbloperator_activity where id='".$id."' and status='resumed'");
					if ($check->rowCount() > 0) {
						return "continued";
					}else {
						return "error";
					}
				}
			}else {
				return $job_stat;
			}
		}
	}
	public function optr_work_complete($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row = $status->fetch(PDO::FETCH_ASSOC);
			$job_stat = $row['status'];
			if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
				$res = $this->db->query("UPDATE tbloperator_activity set status='completed',remarks='completed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
				$res2 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
				while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
				{
					$req=$row['request_no'];
					$emp_id=$row['emp_id'];
					$task=$row['task'];
					$ins_per_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,task,status,work_completed,encoded_by,created_at)values('".$req."','".$emp_id."','".$task."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				}
				$check = $this->db->query("SELECT * FROM tbloperator_activity where id='".$id."' and status='completed'");
				if ($check->rowCount() > 0) {
					return "complete";
				}else {
					return "error";
				}
			}else {
				return $job_stat;
			}
		}
	}
	public function toAdd_personnel_task()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req_no']."'");
		$row = $status->fetch(PDO::FETCH_ASSOC);
		$job_stat = $row['status'];
		if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
			$res = $this->db->query("INSERT INTO tblpersonnel_activity (request_no,emp_id,status,encoded_by,created_at,temp_designation)values('".$_POST['req_no']."','".$_POST['id']."','queued','".$_POST['user']."','".$Ctime."','".$_POST['temp_des']."')");
			$check = $this->db->query("SELECT * FROM tblpersonnel_activity where request_no='".$_POST['req_no']."' and emp_id='".$_POST['id']."' and status='queued'");
			if ($check->rowCount() > 0) {
				return "added";
			}else {
				return "error";
			}

		}else {
			return $job_stat;
		}
	}
	public function toAdd_operator_task()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req_no']."'");
		$row = $status->fetch(PDO::FETCH_ASSOC);
		$job_stat = $row['status'];
		if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
			$res = $this->db->query("INSERT INTO tbloperator_activity (request_no,emp_id,status,encoded_by,created_at,temp_designation)values('".$_POST['req_no']."','".$_POST['id']."','queued','".$_POST['user']."','".$Ctime."','".$_POST['temp_des']."')");
			$check = $this->db->query("SELECT * FROM tbloperator_activity where request_no='".$_POST['req_no']."' and emp_id='".$_POST['id']."' and status='queued'");
			if ($check->rowCount() > 0) {
				return "added";
			}else {
				return "error";
			}
		}else {
			return $job_stat;
		}
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
		$res = $this->db->query("SELECT optr.reason,optr.id,emp.emp_id,emp.fname,emp.mname,emp.lname,mp.mp_name,optr.temp_designation,optr.status,optr.remarks FROM tbloperator_activity optr,tblmanpower mp,tblemployee emp where optr.emp_id=emp.emp_id and emp.mp_id=mp.id and optr.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->optr_added_task[] = $row;
		}
		return $this->optr_added_task;
	}
	public function toOptr_delete($id)
	{
		$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
		$row = $status->fetch(PDO::FETCH_ASSOC);
		$job_stat = $row['status'];
		if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
			$del = $this->db->query("DELETE FROM tbloperator_activity where id='$id'");
			$check = $this->db->query("SELECT * FROM tbloperator_activity where id='$id'");
			if ($check->rowCount() > 0) {
				return "error";
			}else {
				return "deleted";
			}
		}else {
			return $job_stat;
		}
	}
	public function toPer_delete($id)
	{
		$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
		$row = $status->fetch(PDO::FETCH_ASSOC);
		$job_stat = $row['status'];
		if ($job_stat != "completed" || $job_stat != "closed" || $job_stat != "cancelled") {
			$del = $this->db->query("DELETE FROM tblpersonnel_activity where id='$id'");
			$check = $this->db->query("SELECT * FROM tblpersonnel_activity where id='$id'");
			if ($check->rowCount() > 0) {
				return "error";
			}else {
				return "deleted";
			}
		}else {
			return $job_stat;
		}
	}
	public function toCancel_req()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$remarks = "cancelled by ".$_POST['user']."(foreman)";
		$res = $this->db->query("UPDATE tbljoborderrequest set status='cancelled',work_stopped='".$Ctime."',remarks='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['id']."'");
		$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where status!='completed' and request_no='".$_POST['id']."'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req = $row['request_no'];
			$rem = $row['remarks'];
			if ($rem == "Relieved" || $rem == "Rejected") {

			}else{
				$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped', work_stopped='".$Ctime."',remarks='cancelled',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req."'");
				$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at,reason)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['notes']."')");
			}
		}
		$res3 = $this->db->query("SELECT * FROM tbloperator_activity where status!='completed' and request_no='".$_POST['id']."'");
		while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
		{
			$req2 = $row['request_no'];
			$emp_id2 = $row['emp_id'];
			$update2 = $this->db->query("UPDATE tbloperator_activity set status='stopped', work_stopped='".$Ctime."',remarks='cancelled',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."'");
			$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at,reason)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['notes']."')");
		}
		$optr = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['id']."'");
		while ($row = $optr->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row['optr_id'];
			$update2 = $this->db->query("UPDATE tblemployee set job_stat='', request_no='', is_assigned='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."'");
		}
		$per = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['id']."'");
		while ($row = $per->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row['emp_id'];
			$update2 = $this->db->query("UPDATE tblemployee set job_stat='', request_no='', is_assigned='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."'");
		}
		$per_task = $this->db->query("SELECT * FROM tblpersonnel_task where (status!='queued' or status!='completed') and request_no='".$_POST['id']."'");
		while ($row = $per_task->fetch(PDO::FETCH_ASSOC)) 
		{
			$update2 = $this->db->query("UPDATE tblpersonnel_task set status='stopped',work_stopped='".$Ctime."' where request_no='".$_POST['id']."'");
		}
		$optr_task = $this->db->query("SELECT * FROM tbloperator_task where (status!='queued' or status!='completed') and request_no='".$_POST['id']."'");
		while ($row = $optr_task->fetch(PDO::FETCH_ASSOC)) 
		{
			$update2 = $this->db->query("UPDATE tbloperator_task set status='stopped',work_stopped='".$Ctime."' where request_no='".$_POST['id']."'");
		}
		$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='cancelled' and request_no='".$_POST['id']."'");
		if ($check->rowCount() > 0) {
			return "cancelled";
		}else {
			return "error";
		}
	}
	public function toStop_req()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$remarks = "stopped by ".$_POST['user']."(foreman)";
			$res = $this->db->query("UPDATE tbljoborderrequest set status='stopped',remarks='".$remarks."',notes='".$_POST['notes']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',accomplishment='".$_POST['accom']."' where request_no='".$_POST['id']."'");
			$ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_stopped,encoded_by,created_at,reason,accomplishment)values('".$_POST['id']."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['notes']."','".$_POST['accom']."')");
			$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljob_timestamp where request_no='".$_POST['id']."'");
			$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
			$togetid = $get_timestamp['id'];
			$time = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['id']."' and id='".$togetid."'");
			$get_time = $time->fetch(PDO::FETCH_ASSOC);
			$ids = $get_time['id'];
			$stopped = $get_time['work_stopped'];
			$get = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['id']."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
			$getid = $get->fetch(PDO::FETCH_ASSOC);
			$id = $getid['id'];
			$time2 = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['id']."' and id='$id'");
			$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
			$jobstat = $get_time2['status'];
			if ($jobstat == "resumed") {
				$datetime = $get_time2['work_resumed'];
				$start_date = new DateTime($stopped);
				$since_start = $start_date->diff(new DateTime($datetime));
				$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
				$updating = $this->db->query("UPDATE tbljob_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
			}else if ($jobstat == "working") {
				$datetime = $get_time2['work_started'];
				$start_date = new DateTime($stopped);
				$since_start = $start_date->diff(new DateTime($datetime));
				$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
				$updating = $this->db->query("UPDATE tbljob_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
			}
			$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['id']."'");
			while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
			{
				$req = $row['request_no'];
				$emp_id = $row['emp_id'];
				$rem = $row['remarks'];
				if ($rem == "Relieved" || $rem == "Rejected") {

				}else{
					$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='stopped' ,notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req."' and emp_id='".$emp_id."'");
					$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at,reason)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['notes']."')");
					$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljobperactivity_timestamp where request_no='".$_POST['id']."' and emp_id='".$emp_id."'");
					$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
					$togetid = $get_timestamp['id'];
					$time = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['id']."' and id='".$togetid."'");
					$get_time = $time->fetch(PDO::FETCH_ASSOC);
					$ids = $get_time['id'];
					$stopped = $get_time['work_stopped'];
					$get = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['id']."' and emp_id='".$emp_id."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
					$getid = $get->fetch(PDO::FETCH_ASSOC);
					$id = $getid['id'];
					$time2 = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['id']."' and id='$id'");
					$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
					$jobstat = $get_time2['status'];
					if ($jobstat == "resumed") {
						$datetime = $get_time2['work_resumed'];
						$start_date = new DateTime($stopped);
						$since_start = $start_date->diff(new DateTime($datetime));
						$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
						$updating = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
					}else if ($jobstat == "working") {
						$datetime = $get_time2['work_started'];
						$start_date = new DateTime($stopped);
						$since_start = $start_date->diff(new DateTime($datetime));
						$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
						$updating = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
					}
				}
			}
			$res3 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['id']."'");
			while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
			{
				$req2 = $row['request_no'];
				$emp_id2 = $row['emp_id'];
				$rem = $row['remarks'];
				if ($rem == "Relieved" || $rem == "Rejected") {

				}else{
					$update2 = $this->db->query("UPDATE tbloperator_activity set status='stopped', remarks='stopped', notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and emp_id='".$emp_id2."'");
					$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at,reason)values('".$req2."','".$emp_id2."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['notes']."')");
					$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljoboptractivity_timestamp where request_no='".$_POST['id']."' and emp_id='".$emp_id2."'");
					$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
					$togetid = $get_timestamp['id'];
					$time = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['id']."' and id='".$togetid."'");
					$get_time = $time->fetch(PDO::FETCH_ASSOC);
					$ids = $get_time['id'];
					$stopped = $get_time['work_stopped'];
					$get = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['id']."' and emp_id='".$emp_id2."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
					$getid = $get->fetch(PDO::FETCH_ASSOC);
					$id = $getid['id'];
					$time2 = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['id']."' and id='$id'");
					$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
					$jobstat = $get_time2['status'];
					if ($jobstat == "resumed") {
						$datetime = $get_time2['work_resumed'];
						$start_date = new DateTime($stopped);
						$since_start = $start_date->diff(new DateTime($datetime));
						$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
						$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
					}else if ($jobstat == "working") {
						$datetime = $get_time2['work_started'];
						$start_date = new DateTime($stopped);
						$since_start = $start_date->diff(new DateTime($datetime));
						$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
						$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
					}
				}
			}
			$res4 = $this->db->query("SELECT * FROM tblequipreq where request_no='".$_POST['id']."'");
			while ($row = $res4->fetch(PDO::FETCH_ASSOC)) 
			{
				$req2 = $row['request_no'];
				$eq_code = $row['eq_code'];
				$rem = $row['remarks'];
				if ($rem == "Relieved" || $rem == "stopped") {

				}else{
					$update2 = $this->db->query("UPDATE tblequipreq set status='stopped',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['id']."' and eq_code='".$eq_code."'");
					$update3 = $this->db->query("UPDATE tblequipment set status='stopped' where id='".$eq_code."'");
					$ins_optr_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_stopped,reason,encoded_by,created_at)values('".$req2."','".$eq_code."','stopped','".$_POST['timestamp']."','".$_POST['notes']."','".$_POST['user']."','".$Ctime."')");
					$timestamp = $this->db->query("SELECT MAX(id) as id FROM tblequipment_timestamp where request_no='".$_POST['id']."' and eq_code='".$eq_code."'");
					$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
					$togetid = $get_timestamp['id'];
					$time = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['id']."' and id='".$togetid."'");
					$get_time = $time->fetch(PDO::FETCH_ASSOC);
					$ids = $get_time['id'];
					$stopped = $get_time['work_stopped'];
					$get = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['id']."' and eq_code='".$eq_code."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
					$getid = $get->fetch(PDO::FETCH_ASSOC);
					$id = $getid['id'];
					$time2 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['id']."' and id='$id'");
					$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
					$jobstat = $get_time2['status'];
					if ($jobstat == "resumed") {
						$datetime = $get_time2['work_resumed'];
						$start_date = new DateTime($stopped);
						$since_start = $start_date->diff(new DateTime($datetime));
						$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
						$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
					}else if ($jobstat == "working") {
						$datetime = $get_time2['work_started'];
						$start_date = new DateTime($stopped);
						$since_start = $start_date->diff(new DateTime($datetime));
						$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
						$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
					}
				}
			}
			$optr = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['id']."'");
			while ($row = $optr->fetch(PDO::FETCH_ASSOC)) 
			{
				$emp_id = $row['optr_id'];
				$update2 = $this->db->query("UPDATE tblemployee set job_stat='', request_no='', is_assigned='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."'");
			}
			$per = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['id']."'");
			while ($row = $per->fetch(PDO::FETCH_ASSOC)) 
			{
				$emp_id = $row['emp_id'];
				$update2 = $this->db->query("UPDATE tblemployee set job_stat='', request_no='', is_assigned='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."'");
			}
			$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='stopped' and request_no='".$_POST['id']."'");
			if ($check->rowCount() > 0) {
				return "stopped";
			}else {
				return "error";
			}
		}
	}
	public function toResume_req()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$remarks = "resumed by ".$_POST['user']."(foreman)";
			$res = $this->db->query("UPDATE tbljoborderrequest set status='resumed',remarks='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['id']."'");
			$ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_resumed,encoded_by,created_at)values('".$_POST['id']."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
			$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['id']."'");
			while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
			{
				$req = $row['request_no'];
				$emp_id = $row['emp_id'];
				$rem = $row['remarks'];
				$stat = $row['status'];
				if ($rem == "Dispatched" && $stat=="queued") {
					$update = $this->db->query("UPDATE tblpersonnel_activity set status='resumed',remarks='resumed' ,notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req."' and emp_id='".$emp_id."'");
					$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req."','".$emp_id."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				}else if($rem == "Relieved" || $rem == "Rejected"){

				}else if($rem == "Dispatched"){
					$update2 = $this->db->query("UPDATE tblpersonnel_activity set notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and emp_id='".$emp_id."'");
					$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req."','".$emp_id."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				}else{
					$update = $this->db->query("UPDATE tblpersonnel_activity set status='resumed',remarks='resumed' ,notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req."' and emp_id='".$emp_id."'");
					$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req."','".$emp_id."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				}
			}
			$res3 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['id']."'");
			while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
			{
				$req2 = $row['request_no'];
				$emp_id2 = $row['emp_id'];
				$rem = $row['remarks'];
				$stat = $row['status'];
				if ($rem == "Dispatched" && $stat=="queued") {
					$update2 = $this->db->query("UPDATE tbloperator_activity set status='resumed', remarks='resumed', notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and emp_id='".$emp_id2."'");
					$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req2."','".$emp_id2."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				}else if ($rem == "Relieved" || $rem == "Rejected"){

				}else if($rem == "Dispatched"){
					$update2 = $this->db->query("UPDATE tbloperator_activity set notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and emp_id='".$emp_id2."'");
					$ins_per_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req2."','".$emp_id2."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				}else{
					$update2 = $this->db->query("UPDATE tbloperator_activity set status='resumed', remarks='resumed', notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and emp_id='".$emp_id2."'");
					$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req2."','".$emp_id2."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				}
			}
			$res4 = $this->db->query("SELECT * FROM tblequipreq where request_no='".$_POST['id']."'");
			while ($row = $res4->fetch(PDO::FETCH_ASSOC)) 
			{
				$req2 = $row['request_no'];
				$eq_code = $row['eq_code'];
				$rem = $row['remarks'];
				if ($rem == "Relieved" || $rem == "stopped") {

				}else{
					$update2 = $this->db->query("UPDATE tblequipreq set status='resumed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['id']."' and eq_code='".$eq_code."'");
					$update3 = $this->db->query("UPDATE tblequipment set status='working' where id='".$eq_code."'");
					$ins_optr_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_resumed,encoded_by,created_at)values('".$req2."','".$eq_code."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				}
			}
			$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='resumed' and request_no='".$_POST['id']."'");
			if ($check->rowCount() > 0) {
				return "resumed";
			}else {
				return "error";
			}
		}
	}
	public function toPause_req()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$remarks = "paused by ".$_POST['user']."(foreman)";
		$res = $this->db->query("UPDATE tbljoborderrequest set status='paused',remarks='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['id']."'");
		$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['id']."'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req = $row['request_no'];
			$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='paused' ,notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req."'");
		}
		$res3 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['id']."'");
		while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
		{
			$req2 = $row['request_no'];
			$update2 = $this->db->query("UPDATE tbloperator_activity set status='stopped', remarks='paused', notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."'");
		}
		$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='paused' and request_no='".$_POST['id']."'");
		if ($check->rowCount() > 0) {
			return "resumed";
		}else {
			return "error";
		}
	}
	public function toComplete_req()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$remarks = "completed by ".$_POST['user']."(foreman)";
			$res = $this->db->query("UPDATE tbljoborderrequest set status='completed',remarks='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',accomplishment='".$_POST['accom']."' where request_no='".$_POST['id']."'");
			$ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_completed,encoded_by,created_at,accomplishment)values('".$_POST['id']."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['accom']."')");
			$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljob_timestamp where request_no='".$_POST['id']."'");
			$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
			$togetid = $get_timestamp['id'];
			$time = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['id']."' and id='".$togetid."'");
			$get_time = $time->fetch(PDO::FETCH_ASSOC);
			$ids = $get_time['id'];
			$stopped = $get_time['work_completed'];
			$get = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['id']."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
			$getid = $get->fetch(PDO::FETCH_ASSOC);
			$id = $getid['id'];
			$time2 = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['id']."' and id='$id'");
			$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
			$jobstat = $get_time2['status'];
			if ($jobstat == "resumed") {
				$datetime = $get_time2['work_resumed'];
				$start_date = new DateTime($stopped);
				$since_start = $start_date->diff(new DateTime($datetime));
				$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
			// $updating2 = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
				$sum = strtotime('00:00:00');
				$sum2=0; 
				$time3 = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['id']."' and total_time!=''");
				while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
					$sum1=strtotime($all_time['total_time'])-$sum;
					$sum2 = $sum2+$sum1;
				}
				$sum3=$sum+$sum2;
				$temp = $sum1=strtotime($total_time)-$sum;
				$sum3=$sum3+$temp;
				$com_time = date("H:i:s",$sum3);
				$updating = $this->db->query("UPDATE tbljob_timestamp set total_time='".$com_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
			}else if ($jobstat == "working") {
				$datetime = $get_time2['work_started'];
				$start_date = new DateTime($stopped);
				$since_start = $start_date->diff(new DateTime($datetime));
				$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
			// $updating2 = $this->db->query("UPDATE tbljob_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
				$sum = strtotime('00:00:00');
				$sum2=0; 
				$time3 = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['id']."' and total_time!=''");
				while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
					$sum1=strtotime($all_time['total_time'])-$sum;
					$sum2 = $sum2+$sum1;
				}
				$sum3=$sum+$sum2;
				$temp = $sum1=strtotime($total_time)-$sum;
				$sum3=$sum3+$temp;
				$com_time = date("H:i:s",$sum3);
				$updating = $this->db->query("UPDATE tbljob_timestamp set total_time='".$com_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
			}
			$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['id']."'");
			while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
			{
				$req = $row['request_no'];
				$emp_id = $row['emp_id'];
				$rem = $row['remarks'];
				if ($rem == "Relieved" || $rem == "Rejected") {

				}else{
					$update = $this->db->query("UPDATE tblpersonnel_activity set status='completed',remarks='completed' ,notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req."' and emp_id='".$emp_id."'");
					$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_completed,encoded_by,created_at)values('".$req."','".$emp_id."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
					$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljobperactivity_timestamp where request_no='".$_POST['id']."' and emp_id='".$emp_id."'");
					$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
					$togetid = $get_timestamp['id'];
					$time = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['id']."' and id='".$togetid."'");
					$get_time = $time->fetch(PDO::FETCH_ASSOC);
					$ids = $get_time['id'];
					$get = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['id']."' and emp_id='".$emp_id."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
					$getid = $get->fetch(PDO::FETCH_ASSOC);
					$id = $getid['id'];
					$stopped = $get_time['work_completed'];
					$time2 = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['id']."' and id='$id'");
					$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
					$jobstat = $get_time2['status'];
					if ($jobstat == "resumed") {
						$datetime = $get_time2['work_resumed'];
						$start_date = new DateTime($stopped);
						$since_start = $start_date->diff(new DateTime($datetime));
						$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
						$sum = strtotime('00:00:00');
						$sum2=0; 
						$time3 = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['id']."' and total_time!='' and emp_id='".$emp_id."'");
						while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
							$sum1=strtotime($all_time['total_time'])-$sum;
							$sum2 = $sum2+$sum1;
						}
						$sum3=$sum+$sum2;
						$temp = $sum1=strtotime($total_time)-$sum;
						$sum3=$sum3+$temp;
						$com_time = date("H:i:s",$sum3);
						$updating = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$com_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
					}else if ($jobstat == "working") {
						$datetime = $get_time2['work_started'];
						$start_date = new DateTime($stopped);
						$since_start = $start_date->diff(new DateTime($datetime));
						$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
						$sum = strtotime('00:00:00');
						$sum2=0;
						$time3 = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['id']."' and total_time!='' and emp_id='".$emp_id."'");
						while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
							$sum1=strtotime($all_time['total_time'])-$sum;
							$sum2 = $sum2+$sum1;
						}
						$sum3=$sum+$sum2;
						$temp = $sum1=strtotime($total_time)-$sum;
						$sum3=$sum3+$temp;
						$com_time = date("H:i:s",$sum3);
						$updating = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$com_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
					}
				}
			}
			$res3 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['id']."'");
			while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
			{
				$req2 = $row['request_no'];
				$emp_id2 = $row['emp_id'];
				$rem = $row['remarks'];
				if ($rem == "Relieved" || $rem == "Rejected") {

				}else{
					$update2 = $this->db->query("UPDATE tbloperator_activity set status='completed', remarks='completed', notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and emp_id='".$emp_id2."'");
					$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_completed,encoded_by,created_at)values('".$req2."','".$emp_id2."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
					$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljoboptractivity_timestamp where request_no='".$_POST['id']."' and emp_id='".$emp_id2."'");
					$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
					$togetid = $get_timestamp['id'];
					$time = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['id']."' and id='".$togetid."'");
					$get_time = $time->fetch(PDO::FETCH_ASSOC);
					$ids = $get_time['id'];
					$stopped = $get_time['work_completed'];
					$get = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['id']."' and emp_id='".$emp_id2."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
					$getid = $get->fetch(PDO::FETCH_ASSOC);
					$id = $getid['id'];
					$time2 = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['id']."' and id='$id'");
					$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
					$jobstat = $get_time2['status'];
					if ($jobstat == "resumed") {
						$datetime = $get_time2['work_resumed'];
						$start_date = new DateTime($stopped);
						$since_start = $start_date->diff(new DateTime($datetime));
						$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
						$sum = strtotime('00:00:00');
						$sum2=0;
						$time3 = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['id']."' and total_time!='' and emp_id='".$emp_id2."'");
						while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
							$sum1=strtotime($all_time['total_time'])-$sum;
							$sum2 = $sum2+$sum1;
						}
						$sum3=$sum+$sum2;
						$temp = $sum1=strtotime($total_time)-$sum;
						$sum3=$sum3+$temp;
						$com_time = date("H:i:s",$sum3);
						$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$com_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
					}else if ($jobstat == "working") {
						$datetime = $get_time2['work_started'];
						$start_date = new DateTime($stopped);
						$since_start = $start_date->diff(new DateTime($datetime));
						$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
						$sum = strtotime('00:00:00');
						$sum2=0;
						$time3 = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['id']."' and total_time!='' and emp_id='".$emp_id2."'");
						while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
							$sum1=strtotime($all_time['total_time'])-$sum;
							$sum2 = $sum2+$sum1;
						}
						$sum3=$sum+$sum2;
						$temp = $sum1=strtotime($total_time)-$sum;
						$sum3=$sum3+$temp;
						$com_time = date("H:i:s",$sum3);
						$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$com_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
					}
				}
			}
			$res4 = $this->db->query("SELECT * FROM tblequipreq where request_no='".$_POST['id']."'");
			while ($row = $res4->fetch(PDO::FETCH_ASSOC)) 
			{
				$req2 = $row['request_no'];
				$eq_code = $row['eq_code'];
				$rem = $row['remarks'];
				if ($rem == "Relieved" || $rem == "stopped") {

				}else{
					$update2 = $this->db->query("UPDATE tblequipreq set status='completed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['id']."' and eq_code='".$eq_code."'");
					$update3 = $this->db->query("UPDATE tblequipment set status='Active' where id='".$eq_code."'");
					$ins_optr_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_completed,encoded_by,created_at)values('".$req2."','".$eq_code."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
					$timestamp = $this->db->query("SELECT MAX(id) as id FROM tblequipment_timestamp where request_no='".$_POST['id']."' and eq_code='".$eq_code."'");
					$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
					$togetid = $get_timestamp['id'];
					$time = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['id']."' and id='".$togetid."'");
					$get_time = $time->fetch(PDO::FETCH_ASSOC);
					$ids = $get_time['id'];
					$stopped = $get_time['work_completed'];
					$get = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['id']."' and eq_code='".$eq_code."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
					$getid = $get->fetch(PDO::FETCH_ASSOC);
					$id = $getid['id'];
					$time2 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['id']."' and id='$id'");
					$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
					$jobstat = $get_time2['status'];
					if ($jobstat == "resumed") {
						$datetime = $get_time2['work_resumed'];
						$start_date = new DateTime($stopped);
						$since_start = $start_date->diff(new DateTime($datetime));
						$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
						$sum = strtotime('00:00:00');
						$sum2=0;
						$time3 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['id']."' and total_time!='' and eq_code='".$eq_code."'");
						while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
							$sum1=strtotime($all_time['total_time'])-$sum;
							$sum2 = $sum2+$sum1;
						}
						$sum3=$sum+$sum2;
						$temp = $sum1=strtotime($total_time)-$sum;
						$sum3=$sum3+$temp;
						$com_time = date("H:i:s",$sum3);
						$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$com_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
					}else if ($jobstat == "working") {
						$datetime = $get_time2['work_started'];
						$start_date = new DateTime($stopped);
						$since_start = $start_date->diff(new DateTime($datetime));
						$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
						$sum = strtotime('00:00:00');
						$sum2=0;
						$time3 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['id']."' and total_time!='' and eq_code='".$eq_code."'");
						while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
							$sum1=strtotime($all_time['total_time'])-$sum;
							$sum2 = $sum2+$sum1;
						}
						$sum3=$sum+$sum2;
						$temp = $sum1=strtotime($total_time)-$sum;
						$sum3=$sum3+$temp;
						$com_time = date("H:i:s",$sum3);
						$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$com_time."' where request_no='".$_POST['id']."' and id='".$ids."'");
					}
				}
			}
			$optr = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['id']."'");
			while ($row = $optr->fetch(PDO::FETCH_ASSOC)) 
			{
				$emp_id = $row['optr_id'];
				$update2 = $this->db->query("UPDATE tblemployee set job_stat='', request_no='', is_assigned='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."'");
			}
			$per = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['id']."'");
			while ($row = $per->fetch(PDO::FETCH_ASSOC)) 
			{
				$emp_id = $row['emp_id'];
				$update2 = $this->db->query("UPDATE tblemployee set job_stat='', request_no='', is_assigned='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."'");
			}
			$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='completed' and request_no='".$_POST['id']."'");
			if ($check->rowCount() > 0) {
				return "completed";
			}else {
				return "error";
			}
		}
	}
	public function toOptr_relieve($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$notes = "Relieved by ".$_POST['user']."(Foreman)";
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Relieved',is_assigned='0',request_no='',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenequipment_req set status='Relieved',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where optr_id='".$id."' and request_no='".$_POST['req']."'");
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Relieved' and emp_id='$id'");
		$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Relieved' and optr_id='$id'");
		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id' and request_no='".$_POST['req']."'");
		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row2['emp_id'];
			$req2 = $row2['request_no'];
			$update = $this->db->query("UPDATE tbloperator_activity set status='Stopped',remarks='Relieved', notes='".$notes."',updated_by='".$_POST['user']."',reason='".$_POST['notes']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
			$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at)values('".$req2."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "relieved";
		}else {
			return "error";
		}
	}
	public function toOptr_reject($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$notes = "Rejected by ".$_POST['user']."(Foreman)";
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Rejected',is_assigned='0',request_no='',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenequipment_req set status='Rejected',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where optr_id='$id' and request_no='".$_POST['req']."'");
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Rejected' and emp_id='$id'");
		$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Rejected' and optr_id='$id'");
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
	public function toPer_relieve($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$notes = "Relieved by ".$_POST['user']."(Superadmin)";
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Relieved',is_assigned='0',request_no='',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."'
			where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Relieved',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where emp_id='$id' and request_no='".$_POST['req']."'");
		$res3 = $this->db->query("UPDATE tblgivenequipment_req set status='Relieved',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where optr_id='$id' and request_no='".$_POST['req']."'");
		$check = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Relieved' and emp_id='$id'");
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
			$stat = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row2 = $stat->fetch(PDO::FETCH_ASSOC);
			$status = $row2['status'];
			if ($status == "working" || $status == "stopped" || $status == "resumed" || $status == "completed") {
				$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at,reason)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','Relieved')");
				$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."'");
				$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
				$togetid = $get_timestamp['id'];
				$time = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
				$get_time = $time->fetch(PDO::FETCH_ASSOC);
				$ids = $get_time['id'];
				$stopped = $get_time['work_stopped'];
				$get = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
				$getid = $get->fetch(PDO::FETCH_ASSOC);
				$id = $getid['id'];
				$time2 = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and id='$id'");
				$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
				$jobstat = $get_time2['status'];
				if ($jobstat == "resumed") {
					$datetime = $get_time2['work_resumed'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}else if ($jobstat == "working") {
					$datetime = $get_time2['work_started'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}
			}
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
		$notes = "Rejected by ".$_POST['user']."(Superadmin)";
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Rejected',is_assigned='0',is_present='0',request_no='',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Rejected',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where emp_id='$id' and request_no='".$_POST['req']."'");
		$res3 = $this->db->query("UPDATE tblgivenequipment_req set status='Rejected',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where optr_id='$id' and request_no='".$_POST['req']."'");
		$check = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Rejected' and emp_id='$id'");
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
			$stat = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row2 = $stat->fetch(PDO::FETCH_ASSOC);
			$status = $row2['status'];
			if ($status == "working" || $status == "stopped" || $status == "resumed" || $status == "completed") {
				$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at,reason)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','Rejected')");
				$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."'");
				$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
				$togetid = $get_timestamp['id'];
				$time = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
				$get_time = $time->fetch(PDO::FETCH_ASSOC);
				$ids = $get_time['id'];
				$stopped = $get_time['work_stopped'];
				$get = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
				$getid = $get->fetch(PDO::FETCH_ASSOC);
				$id = $getid['id'];
				$time2 = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and id='$id'");
				$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
				$jobstat = $get_time2['status'];
				if ($jobstat == "resumed") {
					$datetime = $get_time2['work_resumed'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}else if ($jobstat == "working") {
					$datetime = $get_time2['work_started'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}
			}
		}
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "rejected";
		}else {
			return "error";
		}
	}
	public function getJob_description($id)
	{
		$job_desc='';
		$res = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$job_desc = $row['jobdescription'];
		}
		return $job_desc;
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
	public function getAssigned_emp()
	{
		$res = $this->db->query("SELECT emp.job_stat,emp.fname,emp.mname,emp.lname,emp.emp_id,job.request_no,job.jobdescription,job.jobdate,emp.is_present,emp.is_assigned FROM tblemployee emp LEFT JOIN tbljoborderrequest job on emp.request_no=job.request_no where emp.is_present='1'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->assigned_emp[] = $row;
		}
		return $this->assigned_emp;
	}
	public function toSubmit_status()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		if ($_POST['status'] == "cancelled") {
			$timestamp = $_POST['timestamp'];
			$e = explode(" ",$timestamp);
			$date = $e[0];
			if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
				return "date";
			} else {
				$remarks = "cancelled by ".$_POST['user']."(foreman)";
				$res = $this->db->query("UPDATE tbljoborderrequest set status='cancelled',remarks='".$remarks."',reason='".$_POST['reason']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."'");
				$ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_stopped,encoded_by,created_at)values('".$_POST['req']."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljob_timestamp where request_no='".$_POST['req']."'");
				$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
				$togetid = $get_timestamp['id'];
				$time = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
				$get_time = $time->fetch(PDO::FETCH_ASSOC);
				$ids = $get_time['id'];
				$stopped = $get_time['work_stopped'];
				$get = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['req']."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
				$getid = $get->fetch(PDO::FETCH_ASSOC);
				$id = $getid['id'];
				$time2 = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['req']."' and id='$id'");
				$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
				$jobstat = $get_time2['status'];
				if ($jobstat == "resumed") {
					$datetime = $get_time2['work_resumed'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$sum = strtotime('00:00:00');
					$sum2=0; 
					$time3 = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['req']."' and total_time!=''");
					while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
						$sum1=strtotime($all_time['total_time'])-$sum;
						$sum2 = $sum2+$sum1;
					}
					$sum3=$sum+$sum2;
					$temp = $sum1=strtotime($total_time)-$sum;
					$sum3=$sum3+$temp;
					$com_time = date("H:i:s",$sum3);
					$updating = $this->db->query("UPDATE tbljob_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}else if ($jobstat == "working") {
					$datetime = $get_time2['work_started'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
			// $updating2 = $this->db->query("UPDATE tbljob_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
					$sum = strtotime('00:00:00');
					$sum2=0; 
					$time3 = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['req']."' and total_time!=''");
					while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
						$sum1=strtotime($all_time['total_time'])-$sum;
						$sum2 = $sum2+$sum1;
					}
					$sum3=$sum+$sum2;
					$temp = $sum1=strtotime($total_time)-$sum;
					$sum3=$sum3+$temp;
					$com_time = date("H:i:s",$sum3);
					$updating = $this->db->query("UPDATE tbljob_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}
				$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."'");
				while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
				{
					$req = $row['request_no'];
					$emp_id = $row['emp_id'];
					$rem = $row['remarks'];
					if ($rem == "Relieved" || $rem == "Rejected") {

					}else{
						$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='cancelled',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req."' and emp_id='".$emp_id."'");
						$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at,reason)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['reason']."')");
						$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."'");
						$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
						$togetid = $get_timestamp['id'];
						$time = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
						$get_time = $time->fetch(PDO::FETCH_ASSOC);
						$ids = $get_time['id'];
						$stopped = $get_time['work_stopped'];
						$get = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
						$getid = $get->fetch(PDO::FETCH_ASSOC);
						$id = $getid['id'];
						$time2 = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and id='$id'");
						$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
						$jobstat = $get_time2['status'];
						if ($jobstat == "resumed") {
							$datetime = $get_time2['work_resumed'];
							$start_date = new DateTime($stopped);
							$since_start = $start_date->diff(new DateTime($datetime));
							$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
							$sum = strtotime('00:00:00');
							$sum2=0; 
							$time3 = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and total_time!='' and emp_id='".$emp_id."'");
							while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
								$sum1=strtotime($all_time['total_time'])-$sum;
								$sum2 = $sum2+$sum1;
							}
							$sum3=$sum+$sum2;
							$temp = $sum1=strtotime($total_time)-$sum;
							$sum3=$sum3+$temp;
							$com_time = date("H:i:s",$sum3);
							$updating = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
						}else if ($jobstat == "working") {
							$datetime = $get_time2['work_started'];
							$start_date = new DateTime($stopped);
							$since_start = $start_date->diff(new DateTime($datetime));
							$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
							$sum = strtotime('00:00:00');
							$sum2=0; 
							$time3 = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and total_time!='' and and emp_id='".$emp_id."'");
							while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
								$sum1=strtotime($all_time['total_time'])-$sum;
								$sum2 = $sum2+$sum1;
							}
							$sum3=$sum+$sum2;
							$temp = $sum1=strtotime($total_time)-$sum;
							$sum3=$sum3+$temp;
							$com_time = date("H:i:s",$sum3);
							$updating = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
						}
					}
				}
				$res3 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."'");
				while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
				{
					$req2 = $row['request_no'];
					$emp_id2 = $row['emp_id'];
					$rem = $row['remarks'];
					if ($rem == "Relieved" || $rem == "Rejected") {

					}else{
						$update2 = $this->db->query("UPDATE tbloperator_activity set status='stopped',remarks='cancelled',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req2."' and emp_id='".$emp_id2."'");
						$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at,reason)values('".$req2."','".$emp_id2."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['reason']."')");
						$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id2."'");
						$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
						$togetid = $get_timestamp['id'];
						$time = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
						$get_time = $time->fetch(PDO::FETCH_ASSOC);
						$ids = $get_time['id'];
						$stopped = $get_time['work_stopped'];
						$get = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id2."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
						$getid = $get->fetch(PDO::FETCH_ASSOC);
						$id = $getid['id'];
						$time2 = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and id='$id'");
						$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
						$jobstat = $get_time2['status'];
						if ($jobstat == "resumed") {
							$datetime = $get_time2['work_resumed'];
							$start_date = new DateTime($stopped);
							$since_start = $start_date->diff(new DateTime($datetime));
							$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
					// $sum = strtotime('00:00:00');
							$sum2=0; 
							$time3 = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and total_time!='' and emp_id='".$emp_id2."'");
							while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
								$sum1=strtotime($all_time['total_time'])-$sum;
								$sum2 = $sum2+$sum1;
							}
							$sum3=$sum+$sum2;
							$temp = $sum1=strtotime($total_time)-$sum;
							$sum3=$sum3+$temp;
							$com_time = date("H:i:s",$sum3);
							$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
						}else if ($jobstat == "working") {
							$datetime = $get_time2['work_started'];
							$start_date = new DateTime($stopped);
							$since_start = $start_date->diff(new DateTime($datetime));
							$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
							$updating2 = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
							$sum = strtotime('00:00:00');
							$sum2=0; 
							$time3 = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and total_time!='' and emp_id='".$emp_id2."'");
							while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
								$sum1=strtotime($all_time['total_time'])-$sum;
								$sum2 = $sum2+$sum1;
							}
							$sum3=$sum+$sum2;
							$com_time = date("H:i:s",$sum3);
							$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
						}
					}
				}
				$res4 = $this->db->query("SELECT * FROM tblequipreq where request_no='".$_POST['req']."'");
				while ($row = $res4->fetch(PDO::FETCH_ASSOC)) 
				{
					$req2 = $row['request_no'];
					$eq_code = $row['eq_code'];
					$rem = $row['remarks'];
					if ($rem == "Relieved" || $rem == "stopped") {

					}else{
						$update2 = $this->db->query("UPDATE tblequipreq set status='stopped',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and eq_code='".$eq_code."'");
						$update3 = $this->db->query("UPDATE tblequipment set status='Active' where id='".$eq_code."'");
						$ins_optr_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_stopped,reason)values('".$req2."','".$eq_code."','stopped','".$_POST['timestamp']."','".$_POST['reason']."')");
						$timestamp = $this->db->query("SELECT MAX(id) as id FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
						$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
						$togetid = $get_timestamp['id'];
						$time = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
						$get_time = $time->fetch(PDO::FETCH_ASSOC);
						$ids = $get_time['id'];
						$stopped = $get_time['work_stopped'];
						$get = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
						$getid = $get->fetch(PDO::FETCH_ASSOC);
						$id = $getid['id'];
						$time2 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='$id'");
						$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
						$jobstat = $get_time2['status'];
						if ($jobstat == "resumed") {
							$datetime = $get_time2['work_resumed'];
							$start_date = new DateTime($stopped);
							$since_start = $start_date->diff(new DateTime($datetime));
							$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
							$sum = strtotime('00:00:00');
							$sum2=0; 
							$time3 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and total_time!='' and eq_code='".$eq_code."'");
							while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
								$sum1=strtotime($all_time['total_time'])-$sum;
								$sum2 = $sum2+$sum1;
							}
							$sum3=$sum+$sum2;
							$temp = $sum1=strtotime($total_time)-$sum;
							$sum3=$sum3+$temp;
							$com_time = date("H:i:s",$sum3);
							$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
						}else if ($jobstat == "working") {
							$datetime = $get_time2['work_started'];
							$start_date = new DateTime($stopped);
							$since_start = $start_date->diff(new DateTime($datetime));
							$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
							$sum = strtotime('00:00:00');
							$sum2=0; 
							$time3 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and total_time!='' and id='".$ids."'");
							while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
								$sum1=strtotime($all_time['total_time'])-$sum;
								$sum2 = $sum2+$sum1;
							}
							$sum3=$sum+$sum2;
							$temp = $sum1=strtotime($total_time)-$sum;
							$sum3=$sum3+$temp;
							$com_time = date("H:i:s",$sum3);
							$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
						}
					}
				}
				$optr = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['req']."'");
				while ($row = $optr->fetch(PDO::FETCH_ASSOC)) 
				{
					$emp_id = $row['optr_id'];
					$update2 = $this->db->query("UPDATE tblemployee set job_stat='', request_no='', is_assigned='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."'");
				}
				$per = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['req']."'");
				while ($row = $per->fetch(PDO::FETCH_ASSOC)) 
				{
					$emp_id = $row['emp_id'];
					$update2 = $this->db->query("UPDATE tblemployee set job_stat='', request_no='', is_assigned='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."'");
				}

				$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='cancelled' and request_no='".$_POST['req']."'");
				if ($check->rowCount() > 0) {
					return "updated";
				}else {
					return "error";
				}
			}
		}else if ($_POST['status'] == "closed"){
			$timestamp = $_POST['timestamp'];
			$e = explode(" ",$timestamp);
			$date = $e[0];
			if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
				return "date";
			} else {
				$remarks = "closed by ".$_POST['user']."(foreman)";
				$res = $this->db->query("UPDATE tbljoborderrequest set status='closed',remarks='".$remarks."',reason='".$_POST['reason']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."'");
				$ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_stopped,encoded_by,created_at)values('".$_POST['req']."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljob_timestamp where request_no='".$_POST['req']."'");
				$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
				$togetid = $get_timestamp['id'];
				$time = $this->db->query("SELECT * FROM tbljob_timestamp where id='".$togetid."'");
				$get_time = $time->fetch(PDO::FETCH_ASSOC);
				$ids = $get_time['id'];
				$stopped = $get_time['work_stopped'];
				$get = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['req']."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
				$getid = $get->fetch(PDO::FETCH_ASSOC);
				$id = $getid['id'];
				$time2 = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['req']."' and id='$id'");
				$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
				$jobstat = $get_time2['status'];
				if ($jobstat == "resumed") {
					$datetime = $get_time2['work_resumed'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
			// $updating2 = $this->db->query("UPDATE tbljob_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
					$sum = strtotime('00:00:00');
					$sum2=0; 
					$time3 = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['req']."' and total_time!=''");
					while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
						$sum1=strtotime($all_time['total_time'])-$sum;
						$sum2 = $sum2+$sum1;
					}
					$sum3=$sum+$sum2;
					$temp = $sum1=strtotime($total_time)-$sum;
					$sum3=$sum3+$temp;
					$com_time = date("H:i:s",$sum3);
					$updating = $this->db->query("UPDATE tbljob_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}else if ($jobstat == "working") {
					$datetime = $get_time2['work_started'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
			// $updating2 = $this->db->query("UPDATE tbljob_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
					$sum = strtotime('00:00:00');
					$sum2=0; 
					$time3 = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['req']."' and total_time!=''");
					while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
						$sum1=strtotime($all_time['total_time'])-$sum;
						$sum2 = $sum2+$sum1;
					}
					$sum3=$sum+$sum2;
					$temp = $sum1=strtotime($total_time)-$sum;
					$sum3=$sum3+$temp;
					$com_time = date("H:i:s",$sum3);
					$updating = $this->db->query("UPDATE tbljob_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}
				$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."'");
				while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
				{
					$req = $row['request_no'];
					$emp_id = $row['emp_id'];
					$rem = $row['remarks'];
					if ($rem == "Relieved" || $rem == "Rejected") {

					}else{
						$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='closed',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req."' and emp_id='".$emp_id."'");
						$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at,reason)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['reason']."')");
						$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."'");
						$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
						$togetid = $get_timestamp['id'];
						$time = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
						$get_time = $time->fetch(PDO::FETCH_ASSOC);
						$ids = $get_time['id'];
						$stopped = $get_time['work_stopped'];
						$get = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
						$getid = $get->fetch(PDO::FETCH_ASSOC);
						$id = $getid['id'];
						$time2 = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and id='$id'");
						$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
						$jobstat = $get_time2['status'];
						if ($jobstat == "resumed") {
							$datetime = $get_time2['work_resumed'];
							$start_date = new DateTime($stopped);
							$since_start = $start_date->diff(new DateTime($datetime));
							$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
							$sum = strtotime('00:00:00');
							$sum2=0; 
							$time3 = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and total_time!='' and emp_id='".$emp_id."'");
							while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
								$sum1=strtotime($all_time['total_time'])-$sum;
								$sum2 = $sum2+$sum1;
							}
							$sum3=$sum+$sum2;
							$temp = $sum1=strtotime($total_time)-$sum;
							$sum3=$sum3+$temp;
							$com_time = date("H:i:s",$sum3);
							$updating = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
						}else if ($jobstat == "working") {
							$datetime = $get_time2['work_started'];
							$start_date = new DateTime($stopped);
							$since_start = $start_date->diff(new DateTime($datetime));
							$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
							$sum = strtotime('00:00:00');
							$sum2=0; 
							$time3 = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and total_time!='' and emp_id='".$emp_id."'");
							while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
								$sum1=strtotime($all_time['total_time'])-$sum;
								$sum2 = $sum2+$sum1;
							}
							$sum3=$sum+$sum2;
							$temp = $sum1=strtotime($total_time)-$sum;
							$sum3=$sum3+$temp;
							$com_time = date("H:i:s",$sum3);
							$updating = $this->db->query("UPDATE tbljobperactivity_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
						}
					}
				}
				$res3 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."'");
				while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
				{
					$req2 = $row['request_no'];
					$emp_id2 = $row['emp_id'];
					$rem = $row['remarks'];
					if ($rem == "Relieved" || $rem == "Rejected") {

					}else{
						$update2 = $this->db->query("UPDATE tbloperator_activity set status='stopped', remarks='closed',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req2."' and emp_id='".$emp_id2."'");
						$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at)values('".$req2."','".$emp_id2."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
						$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id2."'");
						$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
						$togetid = $get_timestamp['id'];
						$time = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
						$get_time = $time->fetch(PDO::FETCH_ASSOC);
						$ids = $get_time['id'];
						$stopped = $get_time['work_stopped'];
						$get = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id2."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
						$getid = $get->fetch(PDO::FETCH_ASSOC);
						$id = $getid['id'];
						$time2 = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and id='$id'");
						$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
						$jobstat = $get_time2['status'];
						if ($jobstat == "resumed") {
							$datetime = $get_time2['work_resumed'];
							$start_date = new DateTime($stopped);
							$since_start = $start_date->diff(new DateTime($datetime));
							$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
							$sum = strtotime('00:00:00');
							$sum2=0;
							$time3 = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and total_time!='' and emp_id='".$emp_id2."'");
							while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
								$sum1=strtotime($all_time['total_time'])-$sum;
								$sum2 = $sum2+$sum1;
							}
							$sum3=$sum+$sum2;
							$temp = $sum1=strtotime($total_time)-$sum;
							$sum3=$sum3+$temp;
							$com_time = date("H:i:s",$sum3);
							$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
						}else if ($jobstat == "working") {
							$datetime = $get_time2['work_started'];
							$start_date = new DateTime($stopped);
							$since_start = $start_date->diff(new DateTime($datetime));
							$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
							$sum = strtotime('00:00:00');
							$sum2=0;
							$time3 = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and total_time!='' and emp_id='".$emp_id2."'");
							while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
								$sum1=strtotime($all_time['total_time'])-$sum;
								$sum2 = $sum2+$sum1;
							}
							$sum3=$sum+$sum2;
							$temp = $sum1=strtotime($total_time)-$sum;
							$sum3=$sum3+$temp;
							$com_time = date("H:i:s",$sum3);
							$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
						}
					}
				}
				$res4 = $this->db->query("SELECT * FROM tblequipreq where request_no='".$_POST['req']."'");
				while ($row = $res4->fetch(PDO::FETCH_ASSOC)) 
				{
					$req2 = $row['request_no'];
					$eq_code = $row['eq_code'];
					$rem = $row['remarks'];
					if ($rem == "Relieved" || $rem == "stopped") {

					}else{
						$update2 = $this->db->query("UPDATE tblequipreq set status='stopped',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and eq_code='".$eq_code."'");
						$update3 = $this->db->query("UPDATE tblequipment set status='Active' where id='".$eq_code."'");
						$ins_optr_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_stopped,reason)values('".$req2."','".$eq_code."','stopped','".$_POST['timestamp']."','".$_POST['reason']."')");
						$timestamp = $this->db->query("SELECT MAX(id) as id FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
						$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
						$togetid = $get_timestamp['id'];
						$time = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
						$get_time = $time->fetch(PDO::FETCH_ASSOC);
						$ids = $get_time['id'];
						$stopped = $get_time['work_stopped'];
						$get = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
						$getid = $get->fetch(PDO::FETCH_ASSOC);
						$id = $getid['id'];
						$time2 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='$id'");
						$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
						$jobstat = $get_time2['status'];
						if ($jobstat == "resumed") {
							$datetime = $get_time2['work_resumed'];
							$start_date = new DateTime($stopped);
							$since_start = $start_date->diff(new DateTime($datetime));
							$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
							$sum = strtotime('00:00:00');
							$sum2=0;
							$time3 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and total_time!='' and eq_code='".$eq_code."'");
							while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
								$sum1=strtotime($all_time['total_time'])-$sum;
								$sum2 = $sum2+$sum1;
							}
							$sum3=$sum+$sum2;
							$temp = $sum1=strtotime($total_time)-$sum;
							$sum3=$sum3+$temp;;
							$com_time = date("H:i:s",$sum3);
							$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
						}else if ($jobstat == "working") {
							$datetime = $get_time2['work_started'];
							$start_date = new DateTime($stopped);
							$since_start = $start_date->diff(new DateTime($datetime));
							$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
							$sum = strtotime('00:00:00');
							$sum2=0;
							$time3 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and total_time!='' and eq_code='".$eq_code."'");
							while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
								$sum1=strtotime($all_time['total_time'])-$sum;
								$sum2 = $sum2+$sum1;
							}
							$sum3=$sum+$sum2;
							$temp = $sum1=strtotime($total_time)-$sum;
							$sum3=$sum3+$temp;
							$com_time = date("H:i:s",$sum3);
							$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
						}
					}
				}
				$optr = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['req']."'");
				while ($row = $optr->fetch(PDO::FETCH_ASSOC)) 
				{
					$emp_id = $row['optr_id'];
					$update2 = $this->db->query("UPDATE tblemployee set job_stat='', request_no='', is_assigned='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."'");
				}
				$per = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['req']."'");
				while ($row = $per->fetch(PDO::FETCH_ASSOC)) 
				{
					$emp_id = $row['emp_id'];
					$update2 = $this->db->query("UPDATE tblemployee set job_stat='', request_no='', is_assigned='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."'");
				}
				$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='closed' and request_no='".$_POST['req']."'");
				if ($check->rowCount() > 0) {
					return "updated";
				}else {
					return "error";
				}
			}
		}else{
			return "";
		}
	}
	public function get_job_equipment($id)
	{
		$res = $this->db->query("SELECT eq.mp_id,er.id,er.eq_code,eq.eqpt_name,er.no_optr,er.no_eqpt FROM tblequipreq er,tblequipment eq where er.eq_code=eq.id and er.request_no='$id' ORDER BY eq.eqpt_name");
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
	public function toManpower_given($id)
	{
		$res = $this->db->query("SELECT emp.fname,emp.emp_id,emp.id,emp.mname,emp.lname,mp1.status,mp.mp_name FROM tblgivenmanpower_req mp1,tblemployee emp,tblmanpower mp where mp1.emp_id=emp.emp_id and emp.mp_id=mp.id and mp1.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_mpgiv[] = $row;
		}
		return $this->data_mpgiv;
	}
	public function equipment_given($id)
	{
		$res = $this->db->query("SELECT emp.fname,emp.emp_id,emp.id,emp.mname,emp.lname,eqpt1.status,eqpt2.eqpt_name,mp.mp_name FROM tblgivenequipment_req eqpt1,tblemployee emp,tblequipment eqpt2,tblmanpower mp where eqpt1.optr_id=emp.emp_id and eqpt1.eqpt_id=eqpt2.id and emp.mp_id=mp.id and eqpt1.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_eqptgiv[] = $row;
		}
		return $this->data_eqptgiv;
	}
	// ssssssssssssssssssssssssssssssssssssssssss
	public function toAdd_emp()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$get_emp_id = $this->db->query("SELECT * FROM tblemployee where id='".$_POST['id']."'");
		$row = $get_emp_id->fetch(PDO::FETCH_ASSOC);
		$emp_id = $row['emp_id'];
		$mp_id = $row['mp_id'];
		$check = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['req_no']."' and emp_id='".$emp_id."'");
		if ($check->rowCount() > 0) {
			return "existed";
		}else{
			$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['req_no']."'");
			if ($check2->rowCount() == $_POST['nos']) {
				return "exceeded";
			}else{
				$res = $this->db->query("INSERT INTO tblgivenmanpower_req (request_no,emp_id,mp_code,encoded_by,created_at)values('".$_POST['req_no']."','".$emp_id."','".$mp_id."','".$_POST['username']."','".$Ctime."')");
				$update = $this->db->query("UPDATE tblemployee set is_assigned='1',is_present='1',request_no='".$_POST['req_no']."' where emp_id='$emp_id'");
				$check3 = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['req_no']."' and emp_id='".$emp_id."'");
				if ($check3->rowCount() > 0) {
					return "inserted";
				}else{
					return "error";
				}
			}
		}
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
			$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['req_no']."' and eqpt_id='".$_POST['eqpt_id']."'");
			if ($check2->rowCount() == $_POST['no_eq']) {
				return "exceeded";
				// return "exceed= given: ".$check2->rowCount()." req: ".$_POST['no_eq'];
			}else{
				// return "given: ".$check2->rowCount()." req: ".$_POST['no_eq'];
				$res = $this->db->query("INSERT INTO tblgivenequipment_req (request_no,eqpt_id,optr_id,encoded_by,created_at)values('".$_POST['req_no']."','".$_POST['eqpt_id']."','".$emp_id."','".$_POST['username']."','".$Ctime."')");
				$update = $this->db->query("UPDATE tblemployee set is_assigned='1',is_present='1',request_no='".$_POST['req_no']."' where emp_id='$emp_id'");
				$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['req_no']."' and optr_id='".$emp_id."' and eqpt_id='".$_POST['eqpt_id']."'");
				if ($check2->rowCount() >0) {
					return "inserted";
				}else{
					return "error";
				}
			}
		}
	}
	// public function get_mp_req($id)
	// {

	// 	$res = $this->db->query("SELECT mp_req.mp_code,emp.fname,emp.id,emp.mname,emp.lname,emp.status,emp.emp_id,mp_req.nos FROM tblemployee emp,tblmanpowerreq mp_req where mp_req.mp_code=emp.mp_id and emp.is_present='1' and mp_req.id='$id' and emp.status='Active' and emp.job_stat='' and emp.is_assigned='0'");
	// 	// $row = $res->fetch(PDO::FETCH_ASSOC);
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->data_mp_req[] = $row;
	// 	}
	// 	return $this->data_mp_req;
	// }
	public function get_mp_req($id)
	{
		$handler = array();
		$get = $this->db->query("SELECT * FROM tblmanpowerreq where id='$id'");
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$nos = $row['nos'];
		$res = $this->db->query("SELECT emp.mp_id,emp.fname,emp.id,emp.mname,emp.lname,emp.status,emp.emp_id FROM tblemployee emp,tblmanpower mp where mp.id=emp.mp_id and mp.mp_code='Personnel' and emp.is_present='1' and emp.status='Active' and emp.job_stat='' and emp.is_assigned='0' and emp.is_present='1' ORDER BY emp.fname");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_mp_req[] = $row;
		}
		$handler = array('data_mp_req'=>$this->data_mp_req,'nos'=>$nos);
		return $handler;
	}
	public function toAssigned_optr($id)
	{
		$res = $this->db->query("SELECT emp.emp_id,emp.id,emp.fname,emp.mname,emp.lname FROM tblemployee emp,tblmanpower mp where emp.mp_id=mp.id and mp.mp_code='Operator' and emp.status='Active' and emp.job_stat='' and mp.id='$id' and emp.is_assigned='0' and emp.is_present='1' ORDER BY emp.fname");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->to_assigned_optr[] = $row;
		}
		return $this->to_assigned_optr;
	}
	public function toEqpt_dispatch($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$notes = "Dispatched by ".$_POST['user'];
		$status = $_POST['job_status'];
		if ($status == "activated") {
			$res1 = $this->db->query("UPDATE tblemployee set job_stat='Dispatched',is_assigned='1',request_no='".$_POST['req']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
			$res2 = $this->db->query("UPDATE tblgivenequipment_req set status='Dispatched',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where optr_id='$id' and request_no='".$_POST['req']."'");
			$check_emp = $this->db->query("SELECT * FROM tbloperator_activity where emp_id='$id' and request_no='".$_POST['req']."'");
			if ($check_emp->rowCount() > 0) {
				$update = $this->db->query("UPDATE tbloperator_activity set status='queued',notes='".$notes."',remarks='Dispatched' where request_no='".$_POST['req']."' and emp_id='".$id."'");
			}else{
				$ins = $this->db->query("INSERT INTO tbloperator_activity(request_no,emp_id,status,notes,encoded_by,created_at,remarks)values('".$_POST['req']."','".$id."','queued','".$notes."','".$_POST['user']."','".$Ctime."','Dispatched')");
			}
			$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Dispatched' and emp_id='$id'");
			$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Dispatched' and optr_id='$id' and request_no='".$_POST['req']."'");
			if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
				return "dispatched";
			}else {
				return "error";
			}
		}else{
			if ($status == "working") {
				$res1 = $this->db->query("UPDATE tblemployee set job_stat='Dispatched',is_assigned='1',request_no='".$_POST['req']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
				$res2 = $this->db->query("UPDATE tblgivenequipment_req set status='Dispatched',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where optr_id='$id' and request_no='".$_POST['req']."'");
				$check_emp = $this->db->query("SELECT * FROM tbloperator_activity where emp_id='$id' and request_no='".$_POST['req']."'");
				if ($check_emp->rowCount() > 0) {
					$update = $this->db->query("UPDATE tbloperator_activity set status='working',notes='".$notes."',remarks='Dispatched' where request_no='".$_POST['req']."' and emp_id='".$id."'");
				}else{
					$ins = $this->db->query("INSERT INTO tbloperator_activity(request_no,emp_id,status,notes,encoded_by,created_at,remarks)values('".$_POST['req']."','".$id."','working','".$notes."','".$_POST['user']."','".$Ctime."','Dispatched')");
				}
				$ins_per_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$_POST['req']."','".$id."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Dispatched' and emp_id='$id'");
				$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Dispatched' and optr_id='$id' and request_no='".$_POST['req']."'");
				if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
					return "dispatched";
				}else {
					return "error";
				}
			}
			if ($status == "stopped") {
				$res1 = $this->db->query("UPDATE tblemployee set job_stat='Dispatched',is_assigned='1',request_no='".$_POST['req']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
				$res2 = $this->db->query("UPDATE tblgivenequipment_req set status='Dispatched',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where optr_id='$id' and request_no='".$_POST['req']."'");
				$check_emp = $this->db->query("SELECT * FROM tbloperator_activity where emp_id='$id' and request_no='".$_POST['req']."'");
				if ($check_emp->rowCount() > 0) {
					$update = $this->db->query("UPDATE tbloperator_activity set status='queued',notes='".$notes."',remarks='Dispatched' where request_no='".$_POST['req']."' and emp_id='".$id."'");
				}else{
					$ins = $this->db->query("INSERT INTO tbloperator_activity(request_no,emp_id,status,notes,encoded_by,created_at,remarks)values('".$_POST['req']."','".$id."','queued','".$notes."','".$_POST['user']."','".$Ctime."','Dispatched')");
				}
				$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Dispatched' and emp_id='$id'");
				$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Dispatched' and optr_id='$id' and request_no='".$_POST['req']."'");
				if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
					return "dispatched";
				}else {
					return "error";
				}
			}
			if ($status == "resumed") {
				$res1 = $this->db->query("UPDATE tblemployee set job_stat='Dispatched',is_assigned='1',request_no='".$_POST['req']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
				$res2 = $this->db->query("UPDATE tblgivenequipment_req set status='Dispatched',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where optr_id='$id' and request_no='".$_POST['req']."'");
				$check_emp = $this->db->query("SELECT * FROM tbloperator_activity where emp_id='$id' and request_no='".$_POST['req']."'");
				if ($check_emp->rowCount() > 0) {
					$update = $this->db->query("UPDATE tbloperator_activity set status='working',notes='".$notes."',remarks='Dispatched' where request_no='".$_POST['req']."' and emp_id='".$id."'");
				}else{
					$ins = $this->db->query("INSERT INTO tbloperator_activity(request_no,emp_id,status,notes,encoded_by,created_at,remarks)values('".$_POST['req']."','".$id."','working','".$notes."','".$_POST['user']."','".$Ctime."','Dispatched')");
				}
				$ins_per_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$_POST['req']."','".$id."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Dispatched' and emp_id='$id'");
				$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Dispatched' and optr_id='$id' and request_no='".$_POST['req']."'");
				if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
					return "dispatched";
				}else {
					return "error";
				}
			}
		}
	}
	public function toEqpt_relieve($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$notes = "Relieved by ".$_POST['user']."(Superadmin)";
		
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Relieved',is_assigned='0',request_no='',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."'
			where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Relieved',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where emp_id='$id' and request_no='".$_POST['req']."'");
		$res3 = $this->db->query("UPDATE tblgivenequipment_req set status='Relieved',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where optr_id='$id' and request_no='".$_POST['req']."'");
		$check = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Relieved' and emp_id='$id'");
		if ($check->rowCount() > 0) {
			$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Relieved' and emp_id='$id'");
		}else{
			$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Relieved' and optr_id='$id'");
		}

		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Relieved' and emp_id='$id'");
		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id' and request_no='".$_POST['req']."'");
		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row2['emp_id'];
			$req2 = $row2['request_no'];
			$update = $this->db->query("UPDATE tbloperator_activity set status='stopped',remarks='Relieved', notes='".$notes."',updated_by='".$_POST['user']."',reason='".$_POST['notes']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
			$stat = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row2 = $stat->fetch(PDO::FETCH_ASSOC);
			$status = $row2['status'];
			if ($status == "working" || $status == "stopped" || $status == "resumed" || $status == "completed") {
				$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at,reason)values('".$req2."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','Relieved')");
				$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."'");
				$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
				$togetid = $get_timestamp['id'];
				$time = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
				$get_time = $time->fetch(PDO::FETCH_ASSOC);
				$ids = $get_time['id'];
				$stopped = $get_time['work_stopped'];
				$get = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
				$getid = $get->fetch(PDO::FETCH_ASSOC);
				$id = $getid['id'];
				$time2 = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and id='$id'");
				$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
				$jobstat = $get_time2['status'];
				if ($jobstat == "resumed") {
					$datetime = $get_time2['work_resumed'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}else if ($jobstat == "working") {
					$datetime = $get_time2['work_started'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}
			}
		}
		$res4 = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['req']."' and optr_id='$id'");
		while ($row = $res4->fetch(PDO::FETCH_ASSOC)) 
		{
			$req2 = $row['request_no'];
			$eq_code = $row['eqpt_id'];
			$update2 = $this->db->query("UPDATE tblequipreq set status='stopped',remarks='stopped',reason='".$_POST['notes']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
			$update3 = $this->db->query("UPDATE tblequipment set status='Active' where id='".$eq_code."'");

			$stat = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row2 = $stat->fetch(PDO::FETCH_ASSOC);
			$status = $row2['status'];
			if ($status == "working" || $status == "stopped" || $status == "resumed" || $status == "completed") {
				$ins_equip_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_stopped,encoded_by,created_at,reason)values('".$req2."','".$eq_code."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['notes']."')");
				$timestamp = $this->db->query("SELECT MAX(id) as id FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
				$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
				$togetid = $get_timestamp['id'];
				$time = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
				$get_time = $time->fetch(PDO::FETCH_ASSOC);
				$ids = $get_time['id'];
				$stopped = $get_time['work_stopped'];
				$get = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
				$getid = $get->fetch(PDO::FETCH_ASSOC);
				$id = $getid['id'];
				$time2 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='$id'");
				$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
				$jobstat = $get_time2['status'];
				if ($jobstat == "resumed") {
					$datetime = $get_time2['work_resumed'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}else if ($jobstat == "working") {
					$datetime = $get_time2['work_started'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}
			}

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
		$notes = "Rejected by ".$_POST['user']."(Superadmin)";
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Rejected',is_assigned='0',is_present='0',request_no='',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Rejected',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where emp_id='$id' and request_no='".$_POST['req']."'");
		$res3 = $this->db->query("UPDATE tblgivenequipment_req set status='Rejected',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where optr_id='$id' and request_no='".$_POST['req']."'");
		$check = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Rejected' and emp_id='$id'");
		if ($check->rowCount() > 0) {
			$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Rejected' and emp_id='$id'");
		}else{
			$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Rejected' and optr_id='$id'");
		}
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Rejected' and emp_id='$id'");
		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id' and request_no='".$_POST['req']."'");
		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
		{
			$emp_id = $row2['emp_id'];
			$req2 = $row2['request_no'];
			$update = $this->db->query("UPDATE tbloperator_activity set status='stopped',remarks='Rejected', notes='".$notes."',updated_by='".$_POST['user']."',reason='".$_POST['notes']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
			$stat = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row2 = $stat->fetch(PDO::FETCH_ASSOC);
			$status = $row2['status'];
			if ($status == "working" || $status == "stopped" || $status == "resumed" || $status == "completed") {
				$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at,reason)values('".$req2."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','Rejected')");
				$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."'");
				$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
				$togetid = $get_timestamp['id'];
				$time = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
				$get_time = $time->fetch(PDO::FETCH_ASSOC);
				$ids = $get_time['id'];
				$stopped = $get_time['work_stopped'];
				$get = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
				$getid = $get->fetch(PDO::FETCH_ASSOC);
				$id = $getid['id'];
				$time2 = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and id='$id'");
				$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
				$jobstat = $get_time2['status'];
				if ($jobstat == "resumed") {
					$datetime = $get_time2['work_resumed'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}else if ($jobstat == "working") {
					$datetime = $get_time2['work_started'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}
			}
		}
		$res4 = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['req']."' and optr_id='$id'");
		while ($row = $res4->fetch(PDO::FETCH_ASSOC)) 
		{
			$req2 = $row['request_no'];
			$eq_code = $row['eqpt_id'];
			$update2 = $this->db->query("UPDATE tblequipreq set status='stopped',remarks='stopped',reason='".$_POST['notes']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
			$update3 = $this->db->query("UPDATE tblequipment set status='Active' where id='".$eq_code."'");

			$stat = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
			$row2 = $stat->fetch(PDO::FETCH_ASSOC);
			$status = $row2['status'];
			if ($status == "working" || $status == "stopped" || $status == "resumed" || $status == "completed") {
				$ins_equip_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_stopped,encoded_by,created_at,reason)values('".$req2."','".$eq_code."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['notes']."')");
				$timestamp = $this->db->query("SELECT MAX(id) as id FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
				$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
				$togetid = $get_timestamp['id'];
				$time = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
				$get_time = $time->fetch(PDO::FETCH_ASSOC);
				$ids = $get_time['id'];
				$stopped = $get_time['work_stopped'];
				$get = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
				$getid = $get->fetch(PDO::FETCH_ASSOC);
				$id = $getid['id'];
				$time2 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='$id'");
				$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
				$jobstat = $get_time2['status'];
				if ($jobstat == "resumed") {
					$datetime = $get_time2['work_resumed'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}else if ($jobstat == "working") {
					$datetime = $get_time2['work_started'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}
			}

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
		$notes = "Dispatched by ".$_POST['user'];
		$status = $_POST['job_status'];
		if ($status == "activated") {
			$res1 = $this->db->query("UPDATE tblemployee set job_stat='Dispatched',is_assigned='1',request_no='".$_POST['req']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
			$check_emp = $this->db->query("SELECT * FROM tblpersonnel_activity where emp_id='$id' and request_no='".$_POST['req']."'");
			if ($check_emp->rowCount() > 0) {
				$update = $this->db->query("UPDATE tblpersonnel_activity set status='queued',notes='".$notes."',remarks='Dispatched' where request_no='".$_POST['req']."' and emp_id='".$id."'");
			}else{
				$ins = $this->db->query("INSERT INTO tblpersonnel_activity(request_no,emp_id,status,notes,encoded_by,created_at,remarks)values('".$_POST['req']."','".$id."','queued','".$notes."','".$_POST['user']."','".$Ctime."','Dispatched')");
			}
			$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Dispatched',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id' and request_no='".$_POST['req']."'");
			$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Dispatched' and emp_id='$id'");
			$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Dispatched' and emp_id='$id' and request_no='".$_POST['req']."'");
			if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
				return "dispatched";
			}else {
				return "error";
			}
		}else{
			if ($status == 'working') {
				$res1 = $this->db->query("UPDATE tblemployee set job_stat='Dispatched',is_assigned='1',request_no='".$_POST['req']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
				$check_emp = $this->db->query("SELECT * FROM tblpersonnel_activity where emp_id='$id' and request_no='".$_POST['req']."'");
				if ($check_emp->rowCount() > 0) {
					$update = $this->db->query("UPDATE tblpersonnel_activity set status='working',notes='".$notes."',remarks='Dispatched' where request_no='".$_POST['req']."' and emp_id='".$id."'");
				}else{
					$ins = $this->db->query("INSERT INTO tblpersonnel_activity(request_no,emp_id,status,notes,encoded_by,created_at,remarks)values('".$_POST['req']."','".$id."','working','".$notes."','".$_POST['user']."','".$Ctime."','Dispatched')");
				}
				$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$_POST['req']."','".$id."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Dispatched',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id' and request_no='".$_POST['req']."'");
				$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Dispatched' and emp_id='$id'");
				$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Dispatched' and emp_id='$id' and request_no='".$_POST['req']."'");
				if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
					return "dispatched";
				}else {
					return "error";
				}
			}
			if ($status == 'stopped') {
				$res1 = $this->db->query("UPDATE tblemployee set job_stat='Dispatched',is_assigned='1',request_no='".$_POST['req']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
				$check_emp = $this->db->query("SELECT * FROM tblpersonnel_activity where emp_id='$id' and request_no='".$_POST['req']."'");
				if ($check_emp->rowCount() > 0) {
					$update = $this->db->query("UPDATE tblpersonnel_activity set status='queued',notes='".$notes."',remarks='Dispatched' where request_no='".$_POST['req']."' and emp_id='".$id."'");
				}else{
					$ins = $this->db->query("INSERT INTO tblpersonnel_activity(request_no,emp_id,status,notes,encoded_by,created_at,remarks)values('".$_POST['req']."','".$id."','queued','".$notes."','".$_POST['user']."','".$Ctime."','Dispatched')");
				}
				$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Dispatched',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id' and request_no='".$_POST['req']."'");
				$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Dispatched' and emp_id='$id'");
				$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Dispatched' and emp_id='$id' and request_no='".$_POST['req']."'");
				if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
					return "dispatched";
				}else {
					return "error";
				}
			}
			if ($status == 'resumed') {
				$res1 = $this->db->query("UPDATE tblemployee set job_stat='Dispatched',is_assigned='1',request_no='".$_POST['req']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
				$check_emp = $this->db->query("SELECT * FROM tblpersonnel_activity where emp_id='$id' and request_no='".$_POST['req']."'");
				if ($check_emp->rowCount() > 0) {
					$update = $this->db->query("UPDATE tblpersonnel_activity set status='working',notes='".$notes."',remarks='Dispatched' where request_no='".$_POST['req']."' and emp_id='".$id."'");
				}else{
					$ins = $this->db->query("INSERT INTO tblpersonnel_activity(request_no,emp_id,status,notes,encoded_by,created_at,remarks)values('".$_POST['req']."','".$id."','working','".$notes."','".$_POST['user']."','".$Ctime."','Dispatched')");
				}
				$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$_POST['req']."','".$id."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				$res2 = $this->db->query("UPDATE tblgivenmanpower_req set status='Dispatched',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id' and request_no='".$_POST['req']."'");
				$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Dispatched' and emp_id='$id'");
				$check2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where status='Dispatched' and emp_id='$id' and request_no='".$_POST['req']."'");
				if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
					return "dispatched";
				}else {
					return "error";
				}
			}
		}


	}
	// public function getTask($id)
	// {
	// 	$res = $this->db->query("SELECT * FROM tbltasks where request_no = '$id'");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->task[] = $row;
	// 	}
	// 	return $this->task;
	// }
	// public function insert_task()
	// {
	// 	$timezone  = +8;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$res = $this->db->query("INSERT INTO tbltasks (request_no,task,task_for,encoded_by,created_at)values('".$_POST['task_id']."','".$_POST['task']."','".$_POST['task_for']."','".$_POST['username']."','".$Ctime."')");
	// 	$check = $this->db->query("SELECT * FROM tbltasks where request_no = '".$_POST['task_id']."' and task='".$_POST['task']."' and task_for='".$_POST['task_for']."'");
	// 	if ($check->rowCount() >0) {
	// 		return "true";
	// 	}else {
	// 		return "error";
	// 	}
	// }
	// public function delete_task($id)
	// {
	// 	$res = $this->db->query("DELETE FROM tbltasks where id='$id'");
	// 	$check = $this->db->query("SELECT * FROM tbltasks where id='$id'");
	// 	if ($check->rowCount() > 0) {
	// 		return "error";
	// 	}else{
	// 		return "deleted";
	// 	}
	// }
	// public function toEdit_task($id)
	// {
	// 	$res = $this->db->query("SELECT * FROM tbltasks where id='$id'");
	// 	$row = $res->fetch(PDO::FETCH_ASSOC);
	// 	return $row;
	// }
	// public function toUpdate_task($id)
	// {
	// 	$timezone  = +8;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$res = $this->db->query("UPDATE tbltasks set task='".$_POST['task']."',task_for='".$_POST['task_for']."',updated_by='".$_POST['username']."',updated_at='".$Ctime."' where id='$id'");
	// 	$check = $this->db->query("SELECT * FROM tbltasks where task='".$_POST['task']."' and task_for='".$_POST['task_for']."' and id='$id'");
	// 	if ($check->rowCount() > 0) {
	// 		return "updated";
	// 	}else{
	// 		return "error";
	// 	}
	// }
	// here
	// public function to_per_task_work()
	// {
	// 	$timezone  = +8;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$timestamp = $_POST['timestamp'];
	// 	$e = explode(" ",$timestamp);
	// 	$date = $e[0];
	// 	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
	// 	    return "date";
	// 	} else {
	// 	$res = $this->db->query("UPDATE tblpersonnel_task set status='working',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
	// 	$per_task = $this->db->query("SELECT * FROM tblpersonnel_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
	// 	while ($row = $per_task->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req = $row['request_no'];
	// 		$task = $row['task'];
	// 		$ins_per_task = $this->db->query("INSERT INTO tblpertask_timestamp(request_no,task,status,work_started,encoded_by,created_at)values('".$req."','".$task."','started','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	// 	}
	// 	$check = $this->db->query("SELECT * FROM tblpersonnel_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='working'");
	// 	if ($check->rowCount() > 0) {
	// 		return "working";
	// 	}else{
	// 		return "error";
	// 	}
	// 	}
	// }
	// public function to_per_task_stop()
	// {
	// 	$timezone  = +8;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$timestamp = $_POST['timestamp'];
	// 	$e = explode(" ",$timestamp);
	// 	$date = $e[0];
	// 	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
	// 	    return "date";
	// 	} else {
	// 	$notes = "Stopped by ".$_POST['user']."(Foreman)";
	// 	$res = $this->db->query("UPDATE tblpersonnel_task set status='stopped',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
	// 	$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and task='".$_POST['per_task_id']."' and request_no='".$_POST['req']."'");
	// 	while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$emp_id = $row1['emp_id'];
	// 		$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='Stopped', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
	// 	}
	// 	$per_task = $this->db->query("SELECT * FROM tblpersonnel_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
	// 	while ($row = $per_task->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req = $row['request_no'];
	// 		$task = $row['task'];
	// 		$ins_per_task = $this->db->query("INSERT INTO tblpertask_timestamp(request_no,task,status,work_stopped,encoded_by,created_at)values('".$req."','".$task."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	// 	}
	// 	$check = $this->db->query("SELECT * FROM tblpersonnel_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='stopped'");
	// 	if ($check->rowCount() > 0) {
	// 		return "stopped";
	// 	}else{
	// 		return "error";
	// 	}
	// 	}
	// }
	// public function to_per_task_complete()
	// {
	// 	$timezone  = +8;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$timestamp = $_POST['timestamp'];
	// 	$e = explode(" ",$timestamp);
	// 	$date = $e[0];
	// 	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
	// 	    return "date";
	// 	} else {
	// 	$notes = "Completed by ".$_POST['user']."(Foreman)";
	// 	$res = $this->db->query("UPDATE tblpersonnel_task set status='completed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
	// 	$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and task='".$_POST['per_task_id']."' and request_no='".$_POST['req']."'");
	// 	while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$emp_id = $row1['emp_id'];
	// 		$update = $this->db->query("UPDATE tblpersonnel_activity set status='completed',remarks='Completed', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
	// 	}
	// 	$per_task = $this->db->query("SELECT * FROM tblpersonnel_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
	// 	while ($row = $per_task->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req = $row['request_no'];
	// 		$task = $row['task'];
	// 		$ins_per_task = $this->db->query("INSERT INTO tblpertask_timestamp(request_no,task,status,work_completed,encoded_by,created_at)values('".$req."','".$task."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	// 	}
	// 	$check = $this->db->query("SELECT * FROM tblpersonnel_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='completed'");
	// 	if ($check->rowCount() > 0) {
	// 		return "completed";
	// 	}else{
	// 		return "error";
	// 	}
	// 	}
	// }
	// public function to_per_task_resume()
	// {
	// 	$timezone  = +8;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$timestamp = $_POST['timestamp'];
	// 	$e = explode(" ",$timestamp);
	// 	$date = $e[0];
	// 	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
	// 	    return "date";
	// 	} else {
	// 	$res = $this->db->query("UPDATE tblpersonnel_task set status='resumed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
	// 	$per_task = $this->db->query("SELECT * FROM tblpersonnel_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
	// 	while ($row = $per_task->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req = $row['request_no'];
	// 		$task = $row['task'];
	// 		$ins_per_task = $this->db->query("INSERT INTO tblpertask_timestamp(request_no,task,status,work_resumed,encoded_by,created_at)values('".$req."','".$task."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	// 	}
	// 	$check = $this->db->query("SELECT * FROM tblpersonnel_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='resumed'");
	// 	if ($check->rowCount() > 0) {
	// 		return "resumed";
	// 	}else{
	// 		return "error";
	// 	}
	// 	}
	// }
	// public function to_per_task_pause()
	// {
	// 	$timezone  = +8;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$timestamp = $_POST['timestamp'];
	// 	$e = explode(" ",$timestamp);
	// 	$date = $e[0];
	// 	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
	// 	    return "date";
	// 	} else {
	// 	$notes = "Paused by ".$_POST['user']."(Foreman)";
	// 	$res = $this->db->query("UPDATE tblpersonnel_task set status='paused',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
	// 	$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where status!='queued' and task='".$_POST['per_task_id']."' and request_no='".$_POST['req']."' and status!='completed' and status!='paused'");
	// 	while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$emp_id = $row1['emp_id'];
	// 		$update = $this->db->query("UPDATE tblpersonnel_activity set status='paused',remarks='Paused', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
	// 	}
	// 	$per_task = $this->db->query("SELECT * FROM tblpersonnel_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
	// 	while ($row = $per_task->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req = $row['request_no'];
	// 		$task = $row['task'];
	// 		$ins_per_task = $this->db->query("INSERT INTO tblpertask_timestamp(request_no,task,status,work_paused,encoded_by,created_at)values('".$req."','".$task."','paused','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	// 	}
	// 	$check = $this->db->query("SELECT * FROM tblpersonnel_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='paused'");
	// 	if ($check->rowCount() > 0) {
	// 		return "paused";
	// 	}else{
	// 		return "error";
	// 	}
	// 	}
	// }
	// // operator tsk activity per job request
	// public function to_optr_task_work()
	// {
	// 	$timezone  = +8;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$timestamp = $_POST['timestamp'];
	// 	$e = explode(" ",$timestamp);
	// 	$date = $e[0];
	// 	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
	// 	    return "date";
	// 	} else {
	// 	$res = $this->db->query("UPDATE tbloperator_task set status='working',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
	// 	$optr_task = $this->db->query("SELECT * FROM tbloperator_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
	// 	while ($row = $optr_task->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req = $row['request_no'];
	// 		$task = $row['task'];
	// 		$ins_per_task = $this->db->query("INSERT INTO tbloptrtask_timestamp(request_no,task,status,work_started,encoded_by,created_at)values('".$req."','".$task."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	// 	}
	// 	$check = $this->db->query("SELECT * FROM tbloperator_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='working'");
	// 	if ($check->rowCount() > 0) {
	// 		return "working";
	// 	}else{
	// 		return "error";
	// 	}
	// 	}
	// }
	// public function to_optr_task_stop()
	// {
	// 	$timezone  = +8;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$timestamp = $_POST['timestamp'];
	// 	$e = explode(" ",$timestamp);
	// 	$date = $e[0];
	// 	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
	// 	    return "date";
	// 	} else {
	// 	$notes = "Stopped by ".$_POST['user']."(Foreman)";
	// 	$res = $this->db->query("UPDATE tbloperator_task set status='stopped',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
	// 	$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and task='".$_POST['eqpt_task_id']."'  and request_no='".$_POST['req']."'");
	// 	while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$emp_id = $row2['emp_id'];
	// 		$update = $this->db->query("UPDATE tbloperator_activity set status='stopped',remarks='Stopped', notes='".$notes."',reason='".$_POST['reason']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
	// 	}
	// 	$optr_task = $this->db->query("SELECT * FROM tbloperator_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
	// 	while ($row = $optr_task->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req = $row['request_no'];
	// 		$task = $row['task'];
	// 		$ins_per_task = $this->db->query("INSERT INTO tbloptrtask_timestamp(request_no,task,status,work_stopped,encoded_by,created_at)values('".$req."','".$task."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	// 	}
	// 	$check = $this->db->query("SELECT * FROM tbloperator_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='stopped'");
	// 	if ($check->rowCount() > 0) {
	// 		return "stopped";
	// 	}else{
	// 		return "error";
	// 	}
	// 	}
	// }
	// public function to_optr_task_complete()
	// {
	// 	$timezone  = +8;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$timestamp = $_POST['timestamp'];
	// 	$e = explode(" ",$timestamp);
	// 	$date = $e[0];
	// 	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
	// 	    return "date";
	// 	} else {
	// 	$notes = "Completed by ".$_POST['user']."(Foreman)";
	// 	$res = $this->db->query("UPDATE tbloperator_task set status='completed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
	// 	$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and task='".$_POST['eqpt_task_id']."'  and request_no='".$_POST['req']."'");
	// 	while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$emp_id = $row2['emp_id'];
	// 		$update = $this->db->query("UPDATE tbloperator_activity set status='completed',remarks='Completed', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
	// 	}
	// 	$optr_task = $this->db->query("SELECT * FROM tbloperator_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
	// 	while ($row = $optr_task->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req = $row['request_no'];
	// 		$task = $row['task'];
	// 		$ins_per_task = $this->db->query("INSERT INTO tbloptrtask_timestamp(request_no,task,status,work_completed,encoded_by,created_at)values('".$req."','".$task."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	// 	}
	// 	$check = $this->db->query("SELECT * FROM tbloperator_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='completed'");
	// 	if ($check->rowCount() > 0) {
	// 		return "completed";
	// 	}else{
	// 		return "error";
	// 	}
	// 	}
	// }
	// public function to_optr_task_resume()
	// {
	// 	$timezone  = +8;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$timestamp = $_POST['timestamp'];
	// 	$e = explode(" ",$timestamp);
	// 	$date = $e[0];
	// 	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
	// 	    return "date";
	// 	} else {
	// 	$res = $this->db->query("UPDATE tbloperator_task set status='resumed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
	// 	$optr_task = $this->db->query("SELECT * FROM tbloperator_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
	// 	while ($row = $optr_task->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req = $row['request_no'];
	// 		$task = $row['task'];
	// 		$ins_per_task = $this->db->query("INSERT INTO tbloptrtask_timestamp(request_no,task,status,work_resumed,encoded_by,created_at)values('".$req."','".$task."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	// 	}
	// 	$check = $this->db->query("SELECT * FROM tbloperator_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='resumed'");
	// 	if ($check->rowCount() > 0) {
	// 		return "resumed";
	// 	}else{
	// 		return "error";
	// 	}
	// 	}
	// }
	// public function to_optr_task_pause()
	// {

	// 	$timezone  = +8;
	// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	// 	$timestamp = $_POST['timestamp'];
	// 	$e = explode(" ",$timestamp);
	// 	$date = $e[0];
	// 	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
	// 	    return "date";
	// 	} else {
	// 	$notes = "Paused by ".$_POST['user']."(Foreman)";
	// 	$res = $this->db->query("UPDATE tbloperator_task set status='paused',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
	// 	$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where status!='queued' and status!='completed' and status!='paused' and task='".$_POST['eqpt_task_id']."'  and request_no='".$_POST['req']."'");
	// 	while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$emp_id = $row2['emp_id'];
	// 		$update = $this->db->query("UPDATE tbloperator_activity set status='paused',remarks='Paused', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
	// 	}
	// 	$optr_task = $this->db->query("SELECT * FROM tbloperator_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
	// 	while ($row = $optr_task->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$req = $row['request_no'];
	// 		$task = $row['task'];
	// 		$ins_per_task = $this->db->query("INSERT INTO tbloptrtask_timestamp(request_no,task,status,work_paused,encoded_by,created_at)values('".$req."','".$task."','paused','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	// 	}
	// 	$check = $this->db->query("SELECT * FROM tbloperator_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='paused'");
	// 	if ($check->rowCount() > 0) {
	// 		return "paused";
	// 	}else{
	// 		return "error";
	// 	}
	// 	}
	// }
	public function get_manpower()
	{
		$res = $this->db->query("SELECT * FROM tblmanpower ORDER BY mp_name ASC");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_mp[] = $row;
		}
		return $this->data_mp;
	}
	/*public function to_eqpt_task_del($id)
	{
		$get = $this->db->query("SELECT * FROM tbloperator_task where id='$id'");
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$task = $row['task'];
		$res = $this->db->query("DELETE FROM tbloperator_task where id='$id'");
		$res2 = $this->db->query("DELETE FROM tbloperator_activity where task='".$task."'");
		$check = $this->db->query("SELECT * FROM tbloperator_task where id='$id'");
		if ($check->rowCount() > 0) {
			return "error";
		}else {
			return "deleted";
		}
	}
	public function to_per_task_del($id)
	{
		$get = $this->db->query("SELECT * FROM tblpersonnel_task where id='$id'");
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$task = $row['task'];
		$res = $this->db->query("DELETE FROM tblpersonnel_task where id='$id'");
		$res2 = $this->db->query("DELETE FROM tblpersonnel_activity where task='".$task."'");
		$check = $this->db->query("SELECT * FROM tblpersonnel_task where id='$id'");
		if ($check->rowCount() > 0) {
			return "error";
		}else {
			return "deleted";
		}
	}*/
	public function toselect_job($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("UPDATE tbljoborderrequest set foreman_id='$id',foreman_name='".$_POST['name']."',updated_by='".$_POST['username']."',updated_at='".$Ctime."' where id='".$_POST['id']."'");
		$check = $this->db->query("SELECT * FROM tbljoborderrequest where foreman_id='$id' and foreman_name='".$_POST['name']."' and id='".$_POST['id']."'");
		if ($check->rowCount() >0) {
			return "selected";
		}else{
			return "error";
		}
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
	// public function toJob_per_task($id)
	// {
	// 	$res = $this->db->query("SELECT per.request_no,task.task,per.status,per.task as task_id FROM tblpersonnel_task per,tbltasks task where per.task=task.id and per.request_no='$id'");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->excel4[] = $row;
	// 	}
	// 	return $this->excel4;
	// }
	// public function toJob_optr_task($id)
	// {
	// 	$res = $this->db->query("SELECT per.request_no,task.task,per.status,per.task as task_id FROM tbloperator_task per,tbltasks task where per.task=task.id and per.request_no='$id'");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->excel5[] = $row;
	// 	}
	// 	return $this->excel5;
	// }
	// public function toper_task_act($req,$task)
	// {
	// 	$handler = array();
	// 	$res = $this->db->query("SELECT * FROM tblpertask_timestamp where task='".$task."' and request_no='".$req."' ORDER BY id ASC");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->per_task_time[] = $row;
	// 	}
	// 	// return $this->per_task_time;
	// 	$res2 = $this->db->query("SELECT per.request_no,task.task,per.status,per.task as task_id FROM tblpersonnel_task per,tbltasks task where per.task=task.id and per.request_no='".$req."'");
	// 	$row = $res2->fetch(PDO::FETCH_ASSOC);
	// 	$status = $row['status'];
	// 	$task = $row['task'];
	// 	$handler = array("per_arr" => $this->per_task_time,"status" =>$status,"task" =>$task );
	// 	return $handler;
	// }
	// public function tooptr_task_act($req,$task)
	// {
	// 	$handler = array();
	// 	$res = $this->db->query("SELECT * FROM tbloptrtask_timestamp where task='".$task."' and request_no='".$req."' ORDER BY id ASC");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->optr_task_time[] = $row;
	// 	}
	// 	// return $this->per_task_time;
	// 	$res2 = $this->db->query("SELECT per.request_no,task.task,per.status,per.task as task_id FROM tbloperator_task per,tbltasks task where per.task=task.id and per.request_no='".$req."'");
	// 	$row = $res2->fetch(PDO::FETCH_ASSOC);
	// 	$status = $row['status'];
	// 	$task = $row['task'];
	// 	$handler = array("optr_arr" => $this->optr_task_time,"status" =>$status,"task" =>$task );
	// 	return $handler;
	// }
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
	public function todel_giv_eqpt($id)
	{
		$check = $this->db->query("SELECT * FROM tblemployee where emp_id='$id'");
		$row = $check->fetch(PDO::FETCH_ASSOC);
		$status = $row['job_stat'];
		if ($status == 'Dispatched') {
			$res = $this->db->query("DELETE FROM tblgivenequipment_req where request_no='".$_POST['req']."' and optr_id='$id'");
			$update = $this->db->query("UPDATE tblemployee set is_assigned='0',request_no='',job_stat='' where emp_id='$id'");
			$check = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['req']."' and optr_id='$id'");
			if ($check->rowCount() > 0) {
				return "error";
			}else {
				return "deleted";
			}
		}else if ($status == 'Relieved') {
			$res = $this->db->query("DELETE FROM tblgivenequipment_req where request_no='".$_POST['req']."' and optr_id='$id'");
			$update = $this->db->query("UPDATE tblemployee set is_assigned='0',request_no='',job_stat='' where emp_id='$id'");
			$check = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['req']."' and optr_id='$id'");
			if ($check->rowCount() > 0) {
				return "error";
			}else {
				return "deleted";
			}
		}else{
			$res = $this->db->query("DELETE FROM tblgivenequipment_req where request_no='".$_POST['req']."' and optr_id='$id'");
			$update = $this->db->query("UPDATE tblemployee set is_assigned='0' where emp_id='$id'");
			$check = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$_POST['req']."' and optr_id='$id'");
			if ($check->rowCount() > 0) {
				return "error";
			}else {
				return "deleted";
			}
		}
	}
	public function todel_giv_mp($id)
	{
		$check = $this->db->query("SELECT * FROM tblemployee where emp_id='$id'");
		$row = $check->fetch(PDO::FETCH_ASSOC);
		$status = $row['job_stat']; 
		if ($status == 'Dispatched') {
			$res = $this->db->query("DELETE FROM tblgivenmanpower_req where request_no='".$_POST['req']."' and emp_id='$id'");
			$update = $this->db->query("UPDATE tblemployee set is_assigned='0',request_no='',job_stat='' where emp_id='$id'");
			$check = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['req']."' and emp_id='$id'");
			if ($check->rowCount() > 0) {
				return "error";
			}else {
				return "deleted";
			}
		}else if ($status == 'Relieved') {
			$res = $this->db->query("DELETE FROM tblgivenmanpower_req where request_no='".$_POST['req']."' and emp_id='$id'");
			$update = $this->db->query("UPDATE tblemployee set is_assigned='0',request_no='',job_stat='' where emp_id='$id'");
			$check = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['req']."' and emp_id='$id'");
			if ($check->rowCount() > 0) {
				return "error";
			}else {
				return "deleted";
			}
		}else{
			$res = $this->db->query("DELETE FROM tblgivenmanpower_req where request_no='".$_POST['req']."' and emp_id='$id'");
			$update = $this->db->query("UPDATE tblemployee set is_assigned='0' where emp_id='$id'");
			$check = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$_POST['req']."' and emp_id='$id'");
			if ($check->rowCount() > 0) {
				return "error";
			}else {
				return "deleted";
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
	public function job_status($id)
	{
		$check = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id'");
		if ($check->rowCount() > 0) {
			$check1 = $this->db->query("SELECT * FROM tbljoborderrequest where status='completed' and request_no='$id'");
			$check2 = $this->db->query("SELECT * FROM tbljoborderrequest where status='closed' and request_no='$id'");
			$check3 = $this->db->query("SELECT * FROM tbljoborderrequest where status='cancelled' and request_no='$id'");
			if ($check1->rowCount() > 0) {
				return "redirect";
			}else if($check2->rowCount() > 0){
				return "redirect";
			}else if($check3->rowCount() > 0){
				return "redirect";
			}else {
				return "none";
			}
		}
	}
	public function tojob_eqpt_list($id)
	{
		$jobs = $this->db->query("SELECT req.remarks,req.reason,e.eqpt_name,req.status,req.request_no,req.id,req.eq_code FROM tblequipreq req, tblequipment e where req.eq_code=e.id and req.request_no='$id'");
		while ($row = $jobs->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->job_eqpt_list[] = $row;
		}
		return $this->job_eqpt_list;
	}
	public function toeq_work($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$res = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_started,encoded_by,created_at)values('".$_POST['req']."','".$_POST['id']."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
			$update = $this->db->query("UPDATE tblequipreq set status='working' where request_no='".$_POST['req']."' and eq_code='".$_POST['id']."'");
			$check = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and status='working' and work_started='".$_POST['timestamp']."' and eq_code='".$_POST['id']."'");
			if ($check->rowCount() > 0) {
				return "working";
			}else{
				return "error";
			}
		}
	}
	public function toeq_pause($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$res = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_paused,encoded_by,created_at)values('".$_POST['req']."','".$_POST['id']."','paused','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
			$update = $this->db->query("UPDATE tblequipreq set status='paused' where request_no='".$_POST['req']."' and eq_code='".$_POST['id']."'");
			$check = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and status='paused' and work_paused='".$_POST['timestamp']."' and eq_code='".$_POST['id']."'");
			if ($check->rowCount() > 0) {
				return "paused";
			}else{
				return "error";
			}
		}
	}
	public function toeq_stop($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		$eq_code = $_POST['id'];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$res = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_stopped,encoded_by,created_at,reason)values('".$_POST['req']."','".$_POST['id']."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['reason']."')");
			$update = $this->db->query("UPDATE tblequipreq set status='stopped',remarks='stopped' where request_no='".$_POST['req']."' and eq_code='".$_POST['id']."'");
			$update3 = $this->db->query("UPDATE tblequipment set status='Active' where id='".$eq_code."'");
			$timestamp = $this->db->query("SELECT MAX(id) as id FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
			$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
			$togetid = $get_timestamp['id'];
			$time = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
			$get_time = $time->fetch(PDO::FETCH_ASSOC);
			$ids = $get_time['id'];
			$stopped = $get_time['work_stopped'];
			$get = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
			$getid = $get->fetch(PDO::FETCH_ASSOC);
			$id = $getid['id'];
			$time2 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='$id'");
			$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
			$jobstat = $get_time2['status'];
			if ($jobstat == "resumed") {
				$datetime = $get_time2['work_resumed'];
				$start_date = new DateTime($stopped);
				$since_start = $start_date->diff(new DateTime($datetime));
				$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
				$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
			}else if ($jobstat == "working") {
				$datetime = $get_time2['work_started'];
				$start_date = new DateTime($stopped);
				$since_start = $start_date->diff(new DateTime($datetime));
				$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
				$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
			}
			$check = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and status='stopped' and work_stopped='".$_POST['timestamp']."' and eq_code='".$_POST['id']."'");
			if ($check->rowCount() > 0) {
				return "stopped";
			}else{
				return "error";
			}
		}
	}
	public function toeq_complete($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		$eq_code = $_POST['id'];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$res = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_completed,encoded_by,created_at)values('".$_POST['req']."','".$_POST['id']."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
			$update = $this->db->query("UPDATE tblequipreq set status='completed' where request_no='".$_POST['req']."' and eq_code='".$_POST['id']."'");
			$timestamp = $this->db->query("SELECT MAX(id) as id FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
			$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
			$togetid = $get_timestamp['id'];
			$time = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
			$get_time = $time->fetch(PDO::FETCH_ASSOC);
			$ids = $get_time['id'];
			$stopped = $get_time['work_completed'];
			$get = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
			$getid = $get->fetch(PDO::FETCH_ASSOC);
			$id = $getid['id'];
			$time2 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='$id'");
			$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
			$jobstat = $get_time2['status'];
			if ($jobstat == "resumed") {
				$datetime = $get_time2['work_resumed'];
				$start_date = new DateTime($stopped);
				$since_start = $start_date->diff(new DateTime($datetime));
				$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				$sum = strtotime('00:00:00');
				$sum2=0;
				$time3 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and total_time!='' and eq_code='".$eq_code."'");
				while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
					$sum1=strtotime($all_time['total_time'])-$sum;
					$sum2 = $sum2+$sum1;
				}
				$sum3=$sum+$sum2;
				$temp = $sum1=strtotime($total_time)-$sum;
				$sum3=$sum3+$temp;
				$com_time = date("H:i:s",$sum3);
				$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
			}else if ($jobstat == "working") {
				$datetime = $get_time2['work_started'];
				$start_date = new DateTime($stopped);
				$since_start = $start_date->diff(new DateTime($datetime));
				$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					// $updating2 = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				$sum = strtotime('00:00:00');
				$sum2=0;
				$time3 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and total_time!='' and eq_code='".$eq_code."'");
				while($all_time = $time3->fetch(PDO::FETCH_ASSOC)){
					$sum1=strtotime($all_time['total_time'])-$sum;
					$sum2 = $sum2+$sum1;
				}
				$sum3=$sum+$sum2;
				$temp = $sum1=strtotime($total_time)-$sum;
				$sum3=$sum3+$temp;
				$com_time = date("H:i:s",$sum3);
				$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$com_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
			}
			$check = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and status='completed' and work_completed='".$_POST['timestamp']."' and eq_code='".$_POST['id']."'");
			if ($check->rowCount() > 0) {
				return "completed";
			}else{
				return "error";
			}
		}
	}
	public function toeq_resume($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$timestamp = $_POST['timestamp'];
		$e = explode(" ",$timestamp);
		$date = $e[0];
		if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
			return "date";
		} else {
			$res = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_resumed,encoded_by,created_at)values('".$_POST['req']."','".$_POST['id']."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
			$update = $this->db->query("UPDATE tblequipreq set status='resumed' where request_no='".$_POST['req']."' and eq_code='".$_POST['id']."'");
			$check = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and status='resumed' and work_resumed='".$_POST['timestamp']."' and eq_code='".$_POST['id']."'");
			if ($check->rowCount() > 0) {
				return "resumed";
			}else{
				return "error";
			}
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
	public function getEmployees()
	{
		$res = $this->db->query("SELECT emp.job_stat,emp.request_no,emp.employment_status,emp.emp_id,emp.fname,emp.is_assigned,emp.mname,emp.lname,mp.mp_name as manpower,emp.status,emp.is_present FROM tblemployee emp,tblmanpower mp where emp.mp_id=mp.id");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_emp[] = $row;
		}
		return $this->data_emp;
	}
	public function toEdit_emp($id)
	{
		$res = $this->db->query("SELECT * FROM tblemployee where emp_id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function get_equipment_list()
	{
		$res = $this->db->query("SELECT e.status,e.id,e.eqpt_code,e.eqpt_name,m.mp_name FROM tblequipment e,tblmanpower m where e.mp_id=m.id and status='Active'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_equip3[] = $row;
		}
		return $this->data_equip3;
	}
	public function toUpdate_emp($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$id = $_POST['mp_id_edit'];
		$res = $this->db->query("UPDATE tblemployee set job_stat='".$_POST['mp_jobstat_edit']."',updated_by='".$_POST['username']."',updated_at='".$Ctime."' where emp_id='$id'");
		$check = $this->db->query("SELECT * FROM tblemployee where job_stat='".$_POST['mp_jobstat_edit']."' and emp_id='$id'");
		if ($check->rowCount() > 0) {
			return "updated";
		}else {
			return "error";
		}
		return $res;
	}
	public function toadd_equipment()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$check = $this->db->query("SELECT * FROM tblequipreq where eq_code='".$_POST['id']."' and request_no='".$_POST['req']."'");
		if ($check->rowCount() > 0) {
			return "exist";
		}else{
			$res = $this->db->query("INSERT INTO tblequipreq(request_no,eq_code,encoded_by,created_at,remarks,no_eqpt,no_optr,reason)values('".$_POST['req']."','".$_POST['id']."','".$_POST['user']."','".$Ctime."','Dispatched','".$_POST['no_eqpt']."','".$_POST['no_optr']."','".$_POST['reason']."')");
			$update = $this->db->query("UPDATE tblequipment set status='Dispatched' where id='".$_POST['id']."'");
			$check2 = $this->db->query("SELECT * FROM tblequipreq where eq_code='".$_POST['id']."' and request_no='".$_POST['req']."'");
			if ($check2->rowCount() > 0) {
				return "added";
			}else{
				return "error";
			}
		}
	}
	public function toeq_relieve()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$reason = "Relieved - ".$_POST['reason']; 
		$job_stat = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
		$row = $job_stat->fetch(PDO::FETCH_ASSOC);
		$status = $row['status'];
		$eq_code=$_POST['eq_code'];
		if ($status == "activated" || $status == "queued") {
			$res = $this->db->query("UPDATE tblequipreq set status='stopped',remarks='Relieved',reason='".$_POST['reason']."' where eq_code='".$_POST['eq_code']."' and request_no='".$_POST['req']."'");
			$res_equip = $this->db->query("UPDATE tblequipment set status='Inactive',reason='".$_POST['reason']."' where id='".$_POST['eq_code']."'");
			$res2 = $this->db->query("SELECT * FROM tblgivenequipment_req where eqpt_id='".$_POST['eq_code']."' and request_no='".$_POST['req']."'");
			while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
			{
				$optr_id = $row['optr_id'];
				$req = $row['request_no'];
				$update = $this->db->query("UPDATE tblgivenequipment_req set status='Relieved',updated_by='".$_POST['user']."',reason='".$_POST['reason']."',updated_at='".$Ctime."' where optr_id='".$optr_id."' and request_no='".$req."'");
				$update2 = $this->db->query("UPDATE tbloperator_activity set status='stopped',remarks='Relieved',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where emp_id='".$optr_id."' and request_no='".$req."'");
				$update3 = $this->db->query("UPDATE tblemployee set job_stat='Relieved',request_no='',is_assigned='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$optr_id."'");
			}
			$check = $this->db->query("SELECT * FROM tblequipreq where remarks='Relieved' and eq_code='".$_POST['eq_code']."' and request_no='".$_POST['req']."'");
			if ($check->rowCount() > 0) {
				return "relieved";
			}else{
				return "error";
			}
		}else{
			$res = $this->db->query("UPDATE tblequipreq set status='stopped',remarks='Relieved',reason='".$_POST['reason']."' where eq_code='".$_POST['eq_code']."' and request_no='".$_POST['req']."'");
			$res_equip = $this->db->query("UPDATE tblequipment set status='Inactive',reason='".$_POST['reason']."' where id='".$_POST['eq_code']."'");
			$res1 = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_stopped,encoded_by,created_at,reason)values('".$_POST['req']."','".$_POST['eq_code']."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['reason']."')");
			$timestamp = $this->db->query("SELECT MAX(id) as id FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
			$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
			$togetid = $get_timestamp['id'];
			$time = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
			$get_time = $time->fetch(PDO::FETCH_ASSOC);
			$ids = $get_time['id'];
			$stopped = $get_time['work_stopped'];
			$get = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and eq_code='".$eq_code."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
			$getid = $get->fetch(PDO::FETCH_ASSOC);
			$id = $getid['id'];
			$time2 = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and id='$id'");
			$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
			$jobstat = $get_time2['status'];
			if ($jobstat == "resumed") {
				$datetime = $get_time2['work_resumed'];
				$start_date = new DateTime($stopped);
				$since_start = $start_date->diff(new DateTime($datetime));
				$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
				$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
			}else if ($jobstat == "working") {
				$datetime = $get_time2['work_started'];
				$start_date = new DateTime($stopped);
				$since_start = $start_date->diff(new DateTime($datetime));
				$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
				$updating = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
			}
			$res2 = $this->db->query("SELECT * FROM tblgivenequipment_req where eqpt_id='".$_POST['eq_code']."' and request_no='".$_POST['req']."'");
			while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
			{
				$optr_id = $row['optr_id'];
				$emp_id2 = $row['optr_id'];
				$req = $row['request_no'];
				$update = $this->db->query("UPDATE tblgivenequipment_req set status='Relieved',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where optr_id='".$optr_id."' and request_no='".$req."'");
				$update2 = $this->db->query("UPDATE tbloperator_activity set status='stopped',remarks='Relieved',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where emp_id='".$optr_id."' and request_no='".$req."'");
				$update3 = $this->db->query("UPDATE tblemployee set job_stat='Relieved',request_no='',is_assigned='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$optr_id."'");
				$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at,reason)values('".$req."','".$optr_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$reason."')");
			// OPERATOR
				$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id2."'");
				$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
				$togetid = $get_timestamp['id'];
				$time = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
				$get_time = $time->fetch(PDO::FETCH_ASSOC);
				$ids = $get_time['id'];
				$stopped = $get_time['work_stopped'];
				$get = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id2."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
				$getid = $get->fetch(PDO::FETCH_ASSOC);
				$id = $getid['id'];
				$time2 = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and id='$id'");
				$get_time2 = $time2->fetch(PDO::FETCH_ASSOC);
				$jobstat = $get_time2['status'];
				if ($jobstat == "resumed") {
					$datetime = $get_time2['work_resumed'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}else if ($jobstat == "working") {
					$datetime = $get_time2['work_started'];
					$start_date = new DateTime($stopped);
					$since_start = $start_date->diff(new DateTime($datetime));
					$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
					$updating = $this->db->query("UPDATE tbljoboptractivity_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
				}
// OPERATOR
			}
			$check_optr = $this->db->query("SELECT * FROM tblequipreq where remarks='Relieved' and eq_code='".$_POST['eq_code']."' and request_no='".$_POST['req']."'");
			$check = $this->db->query("SELECT * FROM tblequipreq where remarks='Relieved' and eq_code='".$_POST['eq_code']."' and request_no='".$_POST['req']."'");
			if ($check->rowCount() > 0) {
				return "relieved";
			}else{
				return "error";
			}
		}
	}
	public function toeq_delete($id)
	{
		$res = $this->db->query("DELETE FROM tblequipreq where id='$id'");
		$check = $this->db->query("SELECT * FROM tblequipreq where id='$id'");
		if ($check->rowCount() > 0) {
			return "error";
		}else{
			return "deleted";
		}
	}





	public function toequipment_needed_list($id)
	{
		$eqpt = array();
		$res = $this->db->query("SELECT eq.eqpt_type,eqpt.no_eqpt,eqpt.id,eqpt.eqpt_type as type,eqpt.no_optr FROM tblequipment_needed eqpt,tblequipment_type eq where eqpt.eqpt_type=eq.id and eqpt.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->eqpt[] = $row;
		}
		return $this->eqpt;
	}
	public function tofill_eqpt_needed()
	{
		$res = $this->db->query("SELECT * FROM tblequipment where eqpt_type='".$_POST['eq_type']."' and status='Active'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->fill_eqpt_needed[] = $row;
		}
		return $this->fill_eqpt_needed;
	}
	public function toadd_equipment_needed()
	{
		
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$check = $this->db->query("SELECT * FROM tblequipreq where eq_code='".$_POST['eq_code']."' and request_no='".$_POST['req']."'");
		if ($check->rowCount() > 0) {
			return "exist";
		}else{
			$check3 = $this->db->query("SELECT * FROM tblequipreq req,tblequipment q where req.eq_code=q.id and req.request_no='".$_POST['req']."' and q.eqpt_type='".$_POST['eqpt_type']."'");
			$ctr = $check3->rowCount();
			if ($check3->rowCount() == $_POST['no_eqpt']) {
				return "exceeded";
			}else{
				$res = $this->db->query("INSERT INTO tblequipreq(request_no,eq_code,encoded_by,created_at,remarks,no_eqpt,no_optr,reason)values('".$_POST['req']."','".$_POST['eq_code']."','".$_POST['user']."','".$Ctime."','Dispatched','1','".$_POST['no_optr']."','".$_POST['reason']."')");
				$update = $this->db->query("UPDATE tblequipment set status='Dispatched' where id='".$_POST['eq_code']."'");
				$check2 = $this->db->query("SELECT * FROM tblequipreq where eq_code='".$_POST['eq_code']."' and request_no='".$_POST['req']."'");
				if ($check2->rowCount() > 0) {
					return "added";
				}else{
					return "error";
				}
				// return $check3->rowCount()."---".$_POST['eqpt_type'];
			}
		}
	}
}
?>
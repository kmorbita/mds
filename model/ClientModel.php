<?php 

class ClientModel
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
	}
	
	public function get_Job_order_list()
	{
		$jobs = $this->db->query("SELECT * FROM tbljoborderrequest where encoded_by='".$_POST['user']."' ORDER BY id DESC");
		while ($row = $jobs->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data[] = $row;
		}
		return $this->data;
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
	public function toInsert()
	{
		$requestno = $_POST['requestno'];
		$arr = explode("-", $requestno);
		$req = $arr[1];
		$check = $this->db->query("SELECT * FROM tbltempreqno where id='$req'");
		$check2 = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$requestno'");
		$check3 = $this->db->query("SELECT * FROM tbltempreqno where id='$req'");
		if ($check->rowCount() > 0 && $check2->rowCount() > 0) {
			return "false";
		}else if($check3->rowCount() <= 0){
			return "false";
		}else{
			$encoder = $_POST['encoder'];
			$requestor = $_POST['requestor'];
			$requestno = $_POST['requestno'];
			$address = $_POST['address'];
			$requestdate = $_POST['requestdate'];
			$jobcode = $_POST['jobcode'];
			$description = $_POST['description'];
			$jobdate = $_POST['jobdate'];
			$joblocation = $_POST['joblocation'];
			$est = $_POST['est'];

			$vessel = $_POST['vessel'];
			$voyage = $_POST['voyage'];
			$vanno = $_POST['vanno'];
			$truckno = $_POST['truckno'];
			$hatchno = $_POST['hatchno'];
			$deckno = $_POST['deckno'];

			$comm = json_decode($_POST['commjsonstring']);
			$eqpt = json_decode($_POST['eqptjsonstring']);
			$eqpt_temp2 = json_decode($_POST['eqptjsonstring']);
			$mp = json_decode($_POST['mpjsonstring']);
			$ctr = 0;
			foreach ($eqpt as $key) {
				$eq_code = $key->eq_id;
				$no_of_eqpt = $key->no_of_eqpt;
				$w_optr = $key->w_optr;
				$check = $this->db->query("SELECT * FROM tblequipreq where eq_code='".$eq_code."' and request_no='".$requestno."'");
				if ($check->rowCount() > 0) {
					$ctr++;
					break;
				}else{
				$res = $this->db->query("INSERT INTO tblequipreq (request_no,eq_code,no_eqpt,no_optr)values('".$requestno."','".$eq_code."','".$no_of_eqpt."','".$w_optr."')");
				}
			}
			if ($ctr > 0) {
				$del = $this->db->query("DELETE FROM tblequipreq where request_no='".$requestno."'");
				$check_del = $this->db->query("SELECT * FROM tblequipreq where request_no='".$requestno."'");
				if ($check_del->rowCount() <= 0) {
					return "duplicate";
				}
			}else{
				$del = $this->db->query("DELETE FROM tblequipreq where request_no='".$requestno."'");
			$timezone  = +8;
			$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
			foreach ($comm as $key) {
				$shipper = $key->shipper;
				$commodity = $key->commodity;
				$qty = $key->qty;
				$unit = $key->unit;
				$destination = $key->destination;
				$res = $this->db->query("INSERT INTO tbljobcargocommodities (request_no,shipper,commodity,qty,unit,destination,encoded_by,created_at)values('".$requestno."','".$shipper."','".$commodity."','".$qty."','".$unit."','".$destination."','".$encoder."','".$Ctime."')");
			}
			foreach ($eqpt as $key) {
				$eq_code = $key->eq_id;
				$no_of_eqpt = $key->no_of_eqpt;
				$w_optr = $key->w_optr;
				$res = $this->db->query("INSERT INTO tblequipreq (request_no,eq_code,no_eqpt,no_optr,encoded_by,created_at)values('".$requestno."','".$eq_code."','".$no_of_eqpt."','".$w_optr."','".$encoder."','".$Ctime."')");
			}
			foreach ($mp as $key) {
				$mp_code = $key->mp_id;
				$nos = $key->nos;
				$res = $this->db->query("INSERT INTO tblmanpowerreq (request_no,mp_code,nos,encoded_by,created_at)values('".$requestno."','".$mp_code."','".$nos."','".$encoder."','".$Ctime."')");
			}
			
			$res = $this->db->query("INSERT INTO tbljoborderrequest (request_no,requestor,address,requestdate,jobcode,jobdescription,jobdate,joblocation,est,status,encoded_by,created_at,foreman_id)values('".$requestno."','".$requestor."','".$address."','".$requestdate."','".$jobcode."','".$description."','".$jobdate."','".$joblocation."','".$est."','queued','".$encoder."','".$Ctime."','0')");
			$res = $this->db->query("INSERT INTO tbljobcargocarrier (request_no,vessel,voyage,van_no,truck_no,hatch_no,deck_no)values('".$requestno."','".$vessel."','".$voyage."','".$vanno."','".$truckno."','".$hatchno."','".$deckno."')");
			
			$check = $this->db->query("SELECT * FROM tbljoborderrequest where request_no ='".$requestno."'");
			if ($check->rowCount() > 0) {
				return "true";
			}else {
				return "error";
			}
		}
	}
	}
	public function delete_comm($id)
	{
		$res = $this->db->query("DELETE FROM tbljobcargocommodities where id='$id'");
		return $res;
	}
	public function delete_eqpt($id)
	{
		$get = $this->db->query("SELECT * FROM tblequipreq where id='$id'");
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$req = $row['request_no'];
		$res = $this->db->query("DELETE FROM tblequipreq where id='$id'");
		$get2 = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='$req'");
		// $res2 = $this->db->query("DELETE FROM tblgivenequipment_req where request_no='$req'");
		while ($row = $get2->fetch(PDO::FETCH_ASSOC)) 
		{
			$update = $this->db->query("UPDATE tblemployee set is_assigned='0', request_no='' where emp_id='".$row['optr_id']."'");
			$del = $this->db->query("DELETE FROM tblgivenequipment_req where optr_id='".$row['optr_id']."'");
		}
		$check = $this->db->query("SELECT * FROM tblequipreq where id='$id'");
		if ($check->rowCount() >0) {
			return "error";
		}else {
			return "deleted";
		}
		return $res;
	}
	public function delete_mp($id)
	{
		$get = $this->db->query("SELECT * FROM tblmanpowerreq where id='$id'");
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$req = $row['request_no'];
		$res = $this->db->query("DELETE FROM tblmanpowerreq where id='$id'");
		$get2 = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='$req'");
		// $res2 = $this->db->query("DELETE FROM tblgivenmanpower_req where request_no='$req'");
		while ($row = $get2->fetch(PDO::FETCH_ASSOC)) 
		{
			$update = $this->db->query("UPDATE tblemployee set is_assigned='0', request_no='' where emp_id='".$row['emp_id']."'");
			$del = $this->db->query("DELETE FROM tblgivenmanpower_req where emp_id='".$row['emp_id']."'");
		}
		$check = $this->db->query("SELECT * FROM tblmanpowerreq where id='$id'");
		if ($check->rowCount() >0) {
			return "error";
		}else {
			return "deleted";
		}
		return $res;
		return $res;
	}
	public function toInsert_comm()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("INSERT INTO tbljobcargocommodities (request_no,shipper,commodity,qty,unit,destination,encoded_by,created_at) values('".$_POST['requestno']."','".$_POST['shipper']."','".$_POST['commodity']."','".$_POST['qty']."','".$_POST['unit']."','".$_POST['destination']."','".$_POST['user']."','".$Ctime."')");
		return $res;	
	}
	public function toInsert_eqpt()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$check = $this->db->query("SELECT * FROM tblequipreq where eq_code='".$_POST['eq_code']."' and request_no='".$_POST['requestno']."'");
		if ($check->rowCount() > 0) {
			return "duplicate";
		}else{
		$res = $this->db->query("INSERT INTO tblequipreq (request_no,eq_code,no_eqpt,no_optr,encoded_by,created_at) values('".$_POST['requestno']."','".$_POST['eq_code']."','".$_POST['no_of_eqpt']."','".$_POST['w_optr']."','".$_POST['user']."','".$Ctime."')");
		$check2 = $this->db->query("SELECT * FROM tblequipreq where eq_code='".$_POST['eq_code']."' and request_no='".$_POST['requestno']."'");
		if($check2->rowCount() > 0){
			return "true";
		}else{
			return "error";
		}
		}	
	}
	public function toInsert_mp()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("INSERT INTO tblmanpowerreq (request_no,mp_code,nos,encoded_by,created_at) values('".$_POST['requestno']."','".$_POST['mp_code']."','".$_POST['nos']."','".$_POST['user']."','".$Ctime."')");
		return $res;	
	}
	public function toUpdate_all()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("UPDATE tbljoborderrequest set requestor='".$_POST['requestor']."',address='".$_POST['address']."',requestdate='".$_POST['requestdate']."',jobcode='".$_POST['jobcode']."',jobdescription='".$_POST['description']."',jobdate='".$_POST['jobdate']."',joblocation='".$_POST['joblocation']."',est='".$_POST['est']."',updated_by='".$_POST['encoder']."',updated_at='".$Ctime."' where request_no='".$_POST['requestno']."'");
		$res = $this->db->query("UPDATE tbljobcargocarrier set vessel='".$_POST['vessel']."',voyage='".$_POST['voyage']."',van_no='".$_POST['vanno']."',truck_no='".$_POST['truckno']."',hatch_no='".$_POST['hatchno']."',deck_no='".$_POST['deckno']."' where request_no='".$_POST['requestno']."'");
		return $res;	
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
	public function toEdit($id)
	{
		$res = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function toEditcargo($id)
	{
		$res = $this->db->query("SELECT * FROM tbljobcargocarrier where request_no='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function toEditcomm($id)
	{
		$comm = array();
		$res3 = $this->db->query("SELECT c.request_no,c.id,c.shipper,c.commodity,c.qty,c.destination,u.type FROM tbljobcargocommodities c,tblunits u where c.unit=u.id and c.request_no='$id'");
		while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->comm[] = $row;
		}
		return $this->comm;
	}
	public function toEditeqpt($id)
	{
		$eqpt = array();
		$res = $this->db->query("SELECT eq.eqpt_name,eqpt.no_eqpt,eqpt.id,eqpt.no_optr FROM tblequipreq eqpt,tblequipment eq where eqpt.eq_code=eq.id and eqpt.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->eqpt[] = $row;
		}
		return $this->eqpt;
	}
	public function toEditmp($id)
	{
		$mp = array();
		$res = $this->db->query("SELECT mp.mp_name,mp_req.nos,mp_req.id FROM tblmanpowerreq mp_req,tblmanpower mp where mp_req.mp_code=mp.id and mp_req.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->mp[] = $row;
		}
		return $this->mp;
	}
	public function getcurrent_pass($user,$id)
	{
		$res = $this->db->query("SELECT * FROM tblusers where username='$user' and id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function toReqno()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("INSERT INTO tbltempreqno (datetime)values('".$Ctime."')");
		// needs validation if data is stored, before proceeding below line
		$res2 = $this->db->query("SELECT * FROM tbltempreqno where datetime='$Ctime'");
		$rows = $res2->fetch(PDO::FETCH_ASSOC);
		$row = $rows['id'];
		return $row;
	}
	public function toCancel_req()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$remarks = "cancelled by ".$_POST['user']."(client)";
		$res = $this->db->query("UPDATE tbljoborderrequest set status='cancelled',work_stopped='".$Ctime."',remarks='".$remarks."',reason='".$_POST['reason']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."'");
		$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req = $row['request_no'];
			$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped', work_stopped='".$Ctime."',remarks='cancelled',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req."'");
		}
		$res3 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."'");
		while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
		{
			$req2 = $row['request_no'];
			$update2 = $this->db->query("UPDATE tbloperator_activity set status='stopped', work_stopped='".$Ctime."',remarks='cancelled',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req2."'");
		}
		$optr_task = $this->db->query("UPDATE tbloperator_task set status='stopped',work_stopped='".$Ctime."' where request_no='".$_POST['req']."' and (status!='queued' or status!='completed')");
		$per_task = $this->db->query("UPDATE tblpersonnel_task set status='stopped',work_stopped='".$Ctime."' where request_no='".$_POST['req']."' and (status!='queued' or status!='completed')");
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
	public function to_job_code()
	{
		$res = $this->db->query("SELECT * FROM tbljobcode");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->job_code[] = $row;
		}
		return $this->job_code;
	}
	public function job_code_location($desc)
	{
		$res = $this->db->query("SELECT * FROM tbljobcode where description='$desc'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		$job_desc = $row['location'];
		return $job_desc;
	}
	public function get_units()
	{
		$res = $this->db->query("SELECT * FROM tblunits");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->units_arr[] = $row;
		}
		return $this->units_arr;
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
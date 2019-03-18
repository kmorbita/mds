<?php 

class JoclerkModel
{
	private $db;
	private $id;

	public function __construct()
	{
		require_once("../../assets/connect.php");
		$this->db = Connect::dbconnect();
		$this->data = array();
		$this->comm = array();
		$this->eqpt = array();
		$this->mp = array();
		$this->data_mp = array();
		$this->data_equip = array();
		$this->data_jobeqpt = array();
		$this->data_jobmp = array();
		$this->del_eq = array();
		$this->search_job = array();
		$this->excel = array();
		$this->excel2 = array();
		$this->excel3 = array();
		$this->excel4 = array();
		$this->excel5 = array();
		$this->excel6 = array();
		$this->excel7 = array();
		$this->excel8 = array();
		$this->excel9 = array();
		$this->job_code = array();
		$this->units_arr = array();
		$this->per_task_time = array();
		$this->optr_task_time = array();
		$this->job_toexpo_time = array();
		$this->job_equipment = array();
		$this->data_activity = array();
		$this->equip_timestamp = array();
		$this->timestamps = array();
		$this->per_added_task = array();
		$this->optr_added_task = array();
		$this->all_operator = array();
		$this->all_gang = array();
		$this->data_truck = array();
		$this->data_box_type = array();
		$this->data_weight_per_box = array();
		$this->job_comm = array();
		$this->equipment_type = array();
		$this->job_equipment_needed = array();
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
	public function toReqno()
	{
		$timezone  = +7;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("INSERT INTO tbltempreqno (datetime)values('".$Ctime."')");
		// needs validation if data is stored, before proceeding below line
		$res2 = $this->db->query("SELECT * FROM tbltempreqno where datetime='$Ctime'");
		$rows = $res2->fetch(PDO::FETCH_ASSOC);
		$row = $rows['id'];
		return $row;
	}

	public function reqnoTocancel($id)
	{
		$res = $this->db->query("DELETE FROM tbltempreqno where id='$id'");
		return $res;
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
			$trk_type = $_POST['trk_type'];

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
					$box = $key->box;
					$weight = $key->weight;
					$destination = $key->destination;
					$res = $this->db->query("INSERT INTO tbljobcargocommodities (request_no,shipper,commodity,qty,unit,destination,encoded_by,created_at,box,weight)values('".$requestno."','".$shipper."','".$commodity."','".$qty."','".$unit."','".$destination."','".$encoder."','".$Ctime."','".$box."','".$weight."')");
				}
				foreach ($eqpt as $key) {
					$eq_code = $key->eq_id;
					$no_of_eqpt = $key->no_of_eqpt;
					$w_optr = $key->w_optr;
					$res = $this->db->query("INSERT INTO tblequipment_needed (request_no,eqpt_type,no_eqpt,no_optr,encoded_by,created_at)values('".$requestno."','".$eq_code."','".$no_of_eqpt."','".$w_optr."','".$encoder."','".$Ctime."')");
				}
				foreach ($mp as $key) {
					$mp_code = $key->mp_id;
					$nos = $key->nos;
					$res = $this->db->query("INSERT INTO tblmanpowerreq (request_no,mp_code,nos,encoded_by,created_at)values('".$requestno."','".$mp_code."','".$nos."','".$encoder."','".$Ctime."')");
				}
				
				$res = $this->db->query("INSERT INTO tbljoborderrequest (request_no,requestor,address,requestdate,jobcode,jobdescription,jobdate,joblocation,est,status,encoded_by,created_at,foreman_id)values('".$requestno."','".$requestor."','".$address."','".$requestdate."','".$jobcode."','".$description."','".$jobdate."','".$joblocation."','".$est."','queued','".$encoder."','".$Ctime."','0')");
				$res = $this->db->query("INSERT INTO tbljobcargocarrier (request_no,vessel,voyage,van_no,truck_no,hatch_no,deck_no,trk_type)values('".$requestno."','".$vessel."','".$voyage."','".$vanno."','".$truckno."','".$hatchno."','".$deckno."','".$trk_type."')");
				
				$check = $this->db->query("SELECT * FROM tbljoborderrequest where request_no ='".$requestno."'");
				if ($check->rowCount() > 0) {
					return "true";
				}else {
					return "error";
				}
			}
		}
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
		$res3 = $this->db->query("SELECT b.type as box,w.weight,c.request_no,c.shipper,c.commodity,c.qty,c.destination,u.type FROM tbljobcargocommodities c,tblunits u,tblbox_type b,tblweight_per_box w where c.unit=u.id and c.box=b.id and c.weight=w.id and c.request_no='$id'");
		while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->comm[] = $row;
		}
		return $this->comm;
	}
	public function toEditeqpt($id)
	{
		$eqpt = array();
		$res = $this->db->query("SELECT eq.eqpt_type,eqpt.no_eqpt,eqpt.id,eqpt.no_optr FROM tblequipment_needed eqpt,tblequipment_type eq where eqpt.eqpt_type=eq.id and eqpt.request_no='$id'");
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
	public function toInsert_mp()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("INSERT INTO tblmanpowerreq (request_no,mp_code,nos,encoded_by,created_at) values('".$_POST['requestno']."','".$_POST['mp_code']."','".$_POST['nos']."','".$_POST['user']."','".$Ctime."')");
		return $res;	
	}
	public function toInsert_eqpt()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$check = $this->db->query("SELECT * FROM tblequipment_needed where eqpt_type='".$_POST['eq_code']."' and request_no='".$_POST['requestno']."'");
		if ($check->rowCount() > 0) {
			return "duplicate";
		}else{
			$res = $this->db->query("INSERT INTO tblequipment_needed (request_no,eqpt_type,no_eqpt,no_optr,encoded_by,created_at) values('".$_POST['requestno']."','".$_POST['eq_code']."','".$_POST['no_of_eqpt']."','".$_POST['w_optr']."','".$_POST['user']."','".$Ctime."')");
			$check2 = $this->db->query("SELECT * FROM tblequipment_needed where eqpt_type='".$_POST['eq_code']."' and request_no='".$_POST['requestno']."'");
			if($check2->rowCount() > 0){
				return "true";
			}else{
				return "error";
			}
		}	
	}
	public function toInsert_comm()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("INSERT INTO tbljobcargocommodities (request_no,shipper,commodity,qty,unit,destination,encoded_by,created_at,box,weight) values('".$_POST['requestno']."','".$_POST['shipper']."','".$_POST['commodity']."','".$_POST['qty']."','".$_POST['unit']."','".$_POST['destination']."','".$_POST['user']."','".$Ctime."','".$_POST['box']."','".$_POST['weight']."')");
		return $res;	
	}
	public function toUpdate_all()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("UPDATE tbljoborderrequest set requestor='".$_POST['requestor']."',address='".$_POST['address']."',requestdate='".$_POST['requestdate']."',jobcode='".$_POST['jobcode']."',jobdescription='".$_POST['description']."',jobdate='".$_POST['jobdate']."',joblocation='".$_POST['joblocation']."',est='".$_POST['est']."',updated_by='".$_POST['encoder']."',updated_at='".$Ctime."' where request_no='".$_POST['requestno']."'");
		$res = $this->db->query("UPDATE tbljobcargocarrier set vessel='".$_POST['vessel']."',voyage='".$_POST['voyage']."',van_no='".$_POST['vanno']."',truck_no='".$_POST['truckno']."',hatch_no='".$_POST['hatchno']."',deck_no='".$_POST['deckno']."',trk_type='".$_POST['trk_type']."' where request_no='".$_POST['requestno']."'");
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
	public function delete_comm($id)
	{
		$res = $this->db->query("DELETE FROM tbljobcargocommodities where id='$id'");
		return $res;
	}
	public function delete_eqpt($id)
	{
		$get = $this->db->query("SELECT * FROM tblequipment_needed where id='$id'");
		$row = $get->fetch(PDO::FETCH_ASSOC);
		$req = $row['request_no'];
		$res = $this->db->query("DELETE FROM tblequipment_needed where id='$id'");
		$get3 = $this->db->query("SELECT * FROM tblequipment where eqpt_type='$id'");
		// $res2 = $this->db->query("DELETE FROM tblgivenequipment_req where request_no='$req'");
		while ($row = $get3->fetch(PDO::FETCH_ASSOC)) 
		{
			$eq_id = $row['id'];
			$del = $this->db->query("DELETE FROM tblequipreq where request_no='".$req."' and eq_code='".$eq_id."'");
		}
		$get2 = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='$req'");
		// $res2 = $this->db->query("DELETE FROM tblgivenequipment_req where request_no='$req'");
		while ($row = $get2->fetch(PDO::FETCH_ASSOC)) 
		{
			$update = $this->db->query("UPDATE tblemployee set is_assigned='0', request_no='' where emp_id='".$row['optr_id']."'");
			$del = $this->db->query("DELETE FROM tblgivenequipment_req where optr_id='".$row['optr_id']."'");
		}
		$check = $this->db->query("SELECT * FROM tblequipment_needed where id='$id'");
		if ($check->rowCount() >0) {
			return "error";
		}else {
			return "deleted";
		}
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
	public function get_manpower()
	{
		$res = $this->db->query("SELECT * FROM tblmanpower");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_mp[] = $row;
		}
		return $this->data_mp;
	}
	public function get_equipment()
	{
		$res = $this->db->query("SELECT * FROM tblequipment where status='Active'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_equip[] = $row;
		}
		return $this->data_equip;
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
	public function toJob_toexpo($id)
	{
		$res = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function toJob_per_act_toexpo($id)
	{
		$res = $this->db->query("SELECT per.remarks,per.request_no,per.notes,per.reason,emp.emp_id,emp.fname,emp.mname,emp.lname,mp.mp_name,per.status FROM tblpersonnel_activity per,tblemployee emp,tblmanpower mp where per.request_no='$id' and per.emp_id=emp.emp_id and emp.mp_id=mp.id");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->excel2[] = $row;
		}
		return $this->excel2;
	}
	public function toJob_optr_act_toexpo($id)
	{
		$res = $this->db->query("SELECT per.remarks,per.request_no,per.notes,per.reason,emp.emp_id,emp.fname,emp.mname,emp.lname,mp.mp_name,per.status FROM tbloperator_activity per,tblemployee emp,tblmanpower mp where per.request_no='$id' and per.emp_id=emp.emp_id and emp.mp_id=mp.id");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->excel3[] = $row;
		}
		return $this->excel3;
	}
	// public function toJob_per_task_toexpo($id)
	// {
	// 	$res = $this->db->query("SELECT per.request_no,task.task,per.status,per.task as task_id FROM tblpersonnel_task per,tbltasks task where per.task=task.id and per.request_no='$id'");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->excel4[] = $row;
	// 	}
	// 	return $this->excel4;
	// }
	// public function toJob_optr_task_toexpo($id)
	// {
	// 	$res = $this->db->query("SELECT per.request_no,task.task,per.status,per.task as task_id FROM tbloperator_task per,tbltasks task where per.task=task.id and per.request_no='$id'");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->excel5[] = $row;
	// 	}
	// 	return $this->excel5;
	// }
	public function toJob_per_req_toexpo($id)
	{
		$res = $this->db->query("SELECT mp.mp_name,mp_req.nos FROM tblmanpowerreq mp_req,tblmanpower mp where mp_req.mp_code=mp.id and mp_req.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->excel6[] = $row;
		}
		return $this->excel6;
	}
	public function toJob_optr_req_toexpo($id)
	{
		$res = $this->db->query("SELECT eq.eqpt_code,eq_req.no_eqpt,eq_req.no_optr FROM tblequipreq eq_req,tblequipment eq where eq_req.eq_code=eq.id and eq_req.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->excel7[] = $row;
		}
		return $this->excel7;
	}
	public function toJob_per_req_giv_toexpo($id)
	{
		$res = $this->db->query("SELECT emp.emp_id,emp.fname,emp.mname,emp.lname,mp.mp_name FROM tblgivenmanpower_req mp_req,tblmanpower mp,tblemployee emp where mp_req.emp_id=emp.emp_id and mp_req.mp_code=mp.id and mp_req.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->excel8[] = $row;
		}
		return $this->excel8;
	}
	public function toJob_optr_req_giv_toexpo($id)
	{
		$res = $this->db->query("SELECT emp.emp_id,emp.fname,emp.mname,emp.lname,eq.eqpt_code FROM tblgivenequipment_req optr_req,tblemployee emp,tblequipment eq where optr_req.optr_id=emp.emp_id and optr_req.eqpt_id=eq.id and optr_req.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->excel9[] = $row;
		}
		return $this->excel9;
	}
	public function to_cancel_req($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("UPDATE tbljoborderrequest set status='cancelled',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='$id'");
		$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='cancelled' and request_no='$id'");
		if ($check->rowCount() > 0) {
			return "cancelled";
		}else{
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
	// public function toper_task_time($id,$task)
	// {
	// 	$res = $this->db->query("SELECT * FROM tblpertask_timestamp where task='".$task."' and request_no='".$id."' ORDER BY id ASC");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->per_task_time[] = $row;
	// 	}
	// 	return $this->per_task_time;
	// }
	// public function tooptr_task_time($id,$task)
	// {
	// 	$res = $this->db->query("SELECT * FROM tbloptrtask_timestamp where task='".$task."' and request_no='".$id."' ORDER BY id ASC");
	// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	// 	{
	// 		$this->optr_task_time[] = $row;
	// 	}
	// 	return $this->optr_task_time;
	// }
	public function tojob_per_act_toexpo_timestamp($id,$emp_id)
	{
		$handler = array();
		$res = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where emp_id='".$emp_id."' and request_no='".$id."' ORDER BY id ASC");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$handler[] = $row;
		}
		return $handler;
	}
	public function tojob_optr_act_toexpo_timestamp($id,$emp_id)
	{
		$handler = array();
		$res = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where emp_id='".$emp_id."' and request_no='".$id."' ORDER BY id ASC");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$handler[] = $row;
		}
		return $handler;
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
	public function tojob_toexpo_time($id)
	{
		$res = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='$id' ORDER BY id ASC");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->job_toexpo_time[] = $row;
		}
		return $this->job_toexpo_time;
	}
	public function toequip_timestamp($id,$eq)
	{
		$handler = array();
		$res = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='$id' and eq_code='$eq' ORDER BY id ASC");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$handler[] = $row;
		}
		return $handler;
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
	public function tojob_equipment($id)
	{
		$res = $this->db->query("SELECT e.eqpt_name,req.status,req.eq_code FROM tblequipreq req,tblequipment e where req.eq_code=e.id and req.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->job_equipment[] = $row;
		}
		return $this->job_equipment;
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
	public function totruck_type()
	{
		$jobs = $this->db->query("SELECT * FROM tbltruck_type");
		while ($row = $jobs->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_truck[] = $row;
		}
		return $this->data_truck;
	}
	public function box_type()
	{
		$jobs = $this->db->query("SELECT * FROM tblbox_type");
		while ($row = $jobs->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_box_type[] = $row;
		}
		return $this->data_box_type;
	}
	public function weight_per_box()
	{
		$jobs = $this->db->query("SELECT * FROM tblweight_per_box");
		while ($row = $jobs->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_weight_per_box[] = $row;
		}
		return $this->data_weight_per_box;
	}
	public function tojob_carrier($id)
	{
		$res = $this->db->query("SELECT * FROM tbljobcargocarrier where request_no='".$id."'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function tojob_comm($id)
	{
		$res = $this->db->query("SELECT b.type as box,w.weight,c.request_no,c.shipper,c.commodity,c.qty,c.destination,u.type FROM tbljobcargocommodities c,tblunits u,tblbox_type b,tblweight_per_box w where c.unit=u.id and c.box=b.id and c.weight=w.id and c.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->job_comm[] = $row;
		}
		return $this->job_comm;
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
	public function tojob_equipment_needed($id)
	{
		$res = $this->db->query("SELECT eq.eqpt_type,eqpt.no_eqpt,eqpt.id,eqpt.no_optr FROM tblequipment_needed eqpt,tblequipment_type eq where eqpt.eqpt_type=eq.id and eqpt.request_no='$id'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->job_equipment_needed[] = $row;
		}
		return $this->job_equipment_needed;
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
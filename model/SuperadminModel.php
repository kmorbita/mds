<?php 

class SuperadminModel
{
	private $db;
	private $id;

	public function __construct()
	{
		require_once("../../assets/connect.php");
		require_once("../../assets/Phpexcel/Phpexcel/IOFactory.php");
		$this->db = Connect::dbconnect();
		$this->data = array();
		$this->data_emp = array();
		$this->data_mp = array();
		$this->data_users = array();
		$this->data_role = array();
		$this->data_att = array();
		$this->data_equip = array();
		$this->search_job = array();
		$this->job_stat = array();
		$this->personnel_arr = array();
		$this->data_eqptgiv = array();
		$this->getPersonnel_task = array();
		$this->getequipment_task = array();
		$this->getpersonnel_task_data = array();
		$this->getequipment_task_data = array();
		$this->per_table_task = array();
		$this->eqpt_table_task = array();
		$this->per_added_task = array();
		$this->optr_added_task = array();
		$this->task = array();
		$this->data_activity = array();
		$this->all_operator = array();
		$this->all_gang = array();
		$this->data_jobeqpt = array();
		$this->data_jobmp = array();
		$this->data_mpgiv = array();
		$this->data_mp_req = array();
		$this->to_assigned_optr = array();
		$this->job_activity = array();
		$this->toPersonnel_activity_arr = array();
		$this->toOperator_activity_arr = array();
		$this->comm = array();
		$this->eqpt = array();
		$this->mp = array();
		$this->data_foreman = array();
		$this->excel = array();
		$this->excel2 = array();
		$this->excel3 = array();
		$this->excel4 = array();
		$this->excel5 = array();
		$this->excel6 = array();
		$this->excel7 = array();
		$this->excel8 = array();
		$this->excel9 = array();
		$this->user_logs = array();
		$this->job_code = array();
		$this->eqpt_list = array();
		$this->units_arr = array();
		$this->timestamps = array();
		$this->operator_act = array();
		$this->personnel_act = array();
		$this->job_time = array();
		$this->per_info = array();
		$this->optr_info = array();
		$this->per_time = array();
		$this->optr_time = array();
		$this->per_task_time = array();
		$this->optr_task_time = array();
		$this->optr_task_time2 = array();
		$this->per_task_time2 = array();
		$this->job_toexpo_time = array();
		$this->dispatched_mp = array();
		$this->dispatched_optr = array();
		$this->job_eqpt_list = array();
		$this->job_equipment = array();
		$this->equipment_act = array();
		$this->getEquipment = array();
		$this->equipt_time = array();
		$this->edit_equip = array();
		$this->data_truck = array();
		$this->data_box_type = array();
		$this->data_weight_per_box = array();
		$this->data_equip2 = array();
		$this->data_equip3 = array();
		$this->attendance_type = array();
		$this->employee_attendance = array();
		$this->attendance_date = array();
		$this->job_comm = array();
		$this->equipment_type = array();
		$this->fill_eqpt_needed = array();
		$this->personnel_timestamp = array();
		$this->operator_timestamp = array();
		$this->equipment_timestamp = array();
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
	public function toInsertmp()
	{
		$res = $this->db->query("INSERT INTO tblmanpower(mp_name,mp_code,code)values('".$_POST['mp_name']."','".$_POST['mp_code']."','".$_POST['mp_code2']."')");
		return $res;
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
	public function toDel_mp($id)
	{
		$res = $this->db->query("DELETE FROM tblmanpower where id='$id'");
		return $res;
	}
	public function toEdit_mp($id)
	{
		$res = $this->db->query("SELECT * FROM tblmanpower where id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function toUpdate_mp($id)
	{
		$res = $this->db->query("UPDATE tblmanpower set mp_name='".$_POST['mp_name_edit']."',mp_code='".$_POST['mp_code_edit']."',code='".$_POST['mp_code_edit2']."' where id='$id'");
		return $res;
	}
	public function getusers()
	{
		$res = $this->db->query("SELECT user.user_id,user.id,user.ufname,user.umname,user.ulname,user.username,role.role,user.account_stat FROM tblusers user,tblrole role where user.role=role.id");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_users[] = $row;
		}
		return $this->data_users;
	}
	public function getRole()
	{
		$res = $this->db->query("SELECT * FROM tblrole");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_role[] = $row;
		}
		return $this->data_role;
	}
	public function toInsertuser()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$check = $this->db->query("SELECT * FROM tblusers where username='".$_POST['username']."'");
		$check_id = $this->db->query("SELECT * FROM tblusers where user_id='".$_POST['uID']."'");
		if ($check->rowCount() > 0 || $check_id->rowCount() > 0) {
			if ($check->rowCount() > 0) {
				return "user_exists";
			}
			if ($check_id->rowCount() > 0) {
				return "user_id_exists";
			}
		}else{
			$temp_pass = sha1($_POST['pass']);
			$temp_pass = md5($temp_pass);
			$res = $this->db->query("INSERT INTO tblusers (ufname,umname,ulname,username,password,original_pass,role,encoded_by,created_at,user_id)values('".$_POST['ufname']."','".$_POST['umname']."','".$_POST['ulname']."','".$_POST['username']."','".$temp_pass."','".$_POST['pass']."','".$_POST['role']."','".$_POST['user']."','".$Ctime."','".$_POST['uID']."')");
			$check_user = $this->db->query("SELECT * FROM tblusers where user_id='".$_POST['uID']."' and username='".$_POST['username']."' and original_pass='".$_POST['pass']."'");
			if ($check_user->rowCount() > 0) {
				return "added";
			}else{
				return "error";
			}
		}
	}
	public function toEdit_user($id)
	{
		$res = $this->db->query("SELECT * FROM tblusers where id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
	}
	public function toUpdate_user($id)
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$temp_pass = sha1($_POST['pass']);
		$temp_pass = md5($temp_pass);
		$res = $this->db->query("UPDATE tblusers set user_id='".$_POST['uID']."',ufname='".$_POST['ufname']."',umname='".$_POST['umname']."',ulname='".$_POST['ulname']."',username='".$_POST['username']."',password='".$temp_pass."',original_pass='".$_POST['pass']."',role='".$_POST['role']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',account_stat='".$_POST['acc_stat']."' where id='".$_POST['user_id']."'");
		$check_user = $this->db->query("SELECT * FROM tblusers where user_id='".$_POST['uID']."' and username='".$_POST['username']."' and original_pass='".$_POST['pass']."'");
		if ($check_user->rowCount() > 0) {
			return "updated";
		}else{
			return "error";
		}
	}
	public function toDel_user($id)
	{
		$res = $this->db->query("DELETE FROM tblusers where id='$id'");
		return $res;
	}
	public function toGet_attendance($date)
	{
		$res = $this->db->query("SELECT att.date,att.emp_id,att.emp_name,att.am_in,att.am_out,att.pm_in,att.pm_out,att.extra_in,att.extra_out,mp.mp_name as manpower FROM tblattendance att, tblmanpower mp,tblemployee emp where att.emp_id=emp.emp_id and emp.mp_id=mp.id and att.date='".$date."'");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_att[] = $row;
		}
		return $this->data_att;
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
	public function get_equipment2()
	{
		$res = $this->db->query("SELECT t.eqpt_type,e.reason,e.status,e.id,e.eqpt_code,e.eqpt_name,m.mp_name FROM tblequipment e,tblmanpower m ,tblequipment_type t where e.mp_id=m.id and t.id=e.eqpt_type");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_equip2[] = $row;
		}
		return $this->data_equip2;
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
	public function toEdit_eqpt($id)
	{
		$res = $this->db->query("SELECT * FROM tblequipment where id='$id'");
		$row = $res->fetch(PDO::FETCH_ASSOC);
		return $row;
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
	public function toDel_job($id)
	{
		
		$job1 = $this->db->query("DELETE FROM tbljoborderrequest where request_no='".$id."'");
		$job2 = $this->db->query("DELETE FROM tbljobcargocommodities where request_no='".$id."'");
		$job3 = $this->db->query("DELETE FROM tbljobcargocarrier where request_no='".$id."'");
		
		$job6 = $this->db->query("DELETE FROM tblequipreq where request_no='".$id."'");
		$job7 = $this->db->query("DELETE FROM tblmanpowerreq where request_no='".$id."'");
		$job8 = $this->db->query("DELETE FROM tbloperator_task where request_no='".$id."'");
		$job8 = $this->db->query("DELETE FROM tblpersonnel_task where request_no='".$id."'");
		$job9 = $this->db->query("DELETE FROM tblnotify where request_no='".$id."'");
		$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$id."'");
		$job_stat = $status->fetch(PDO::FETCH_ASSOC);
		$req_status = $job_stat['status'];
		if ($req_status == "working" || $req_status == "stopped" || $req_status == "queued" || $req_status == "activated" || $req_status == "resumed") {
			$get_job4 = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$id."'");
			$get_job5 = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$id."'");
			while ($row1 = $get_job4->fetch(PDO::FETCH_ASSOC)) 
			{
				$emp_id = $row1['optr_id'];
				$update1 = $this->db->query("UPDATE tblemployee set is_assigned='0',request_no='' where emp_id='".$emp_id."'");
				$check1 = $this->db->query("SELECT * FROM tblemployee where is_assigned='0' and request_no='' and emp_id ='".$emp_id."'");
				if ($check1->rowCount() > 0) {
					$delete1 = $this->db->query("DELETE FROM tblgivenequipment_req where request_no='".$id."' and optr_id='".$emp_id."'");
				}
			}
			while ($row2 = $get_job5->fetch(PDO::FETCH_ASSOC)) 
			{
				$emp_id = $row2['emp_id'];
				$update2 = $this->db->query("UPDATE tblemployee set is_assigned='0',request_no='' where emp_id='".$emp_id."'");
				$check2 = $this->db->query("SELECT * FROM tblemployee where is_assigned='0' and request_no='' and emp_id ='".$emp_id."'");
				if ($check2->rowCount() > 0) {
					$delete2 = $this->db->query("DELETE FROM tblgivenmanpower_req where request_no='".$id."' and emp_id='".$emp_id."'");
				}
			}
		}else{
			$del1 = $this->db->query("DELETE FROM tblgivenmanpower_req where request_no='".$id."'");
			$del2 = $this->db->query("DELETE FROM tblgivenequipment_req where request_no='".$id."'");
		}
		$check_job1 = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$id."'");
		$check_job2 = $this->db->query("SELECT * FROM tbljobcargocommodities where request_no='".$id."'");
		$check_job3 = $this->db->query("SELECT * FROM tbljobcargocarrier where request_no='".$id."'");
		$check_job4 = $this->db->query("SELECT * FROM tblgivenmanpower_req where request_no='".$id."'");
		$check_job5 = $this->db->query("SELECT * FROM tblgivenequipment_req where request_no='".$id."'");
		$check_job6 = $this->db->query("SELECT * FROM tblequipreq where request_no='".$id."'");
		$check_job7 = $this->db->query("SELECT * FROM tblmanpowerreq where request_no='".$id."'");
		$check_job8 = $this->db->query("SELECT * FROM tbloperator_task where request_no='".$id."'");
		$check_job10 = $this->db->query("SELECT * FROM tblpersonnel_task where request_no='".$id."'");
		$check_job9 = $this->db->query("SELECT * FROM tblnotify where request_no='".$id."'");
		if ($check_job1->rowCount() > 0 && $check_job2->rowCount() > 0 && $check_job3->rowCount() > 0 && $check_job4->rowCount() > 0
			&& $check_job5->rowCount() > 0 && $check_job6->rowCount() > 0 && $check_job7->rowCount() > 0 && $check_job8->rowCount() > 0 && $check_job9->rowCount() > 0 && $check_job10->rowCount() > 0) {
			return "error";
	}else{
		return "deleted";
	}
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
public function toPersonnel($id)
{
	$res = $this->db->query("SELECT emp.fname,emp.id as emp_id2,emp.emp_id,emp.mname,emp.lname,mp.mp_name FROM tblgivenmanpower_req mp1,tblemployee emp,tblmanpower mp where mp1.emp_id=emp.emp_id and emp.mp_id=mp.id and mp.mp_code='Personnel' and emp.job_stat='Dispatched' and mp1.request_no='$id'");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->personnel_arr[] = $row;
	}
	return $this->personnel_arr;
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
// public function getpersonnel_task_data($id)
// {
// 	$res = $this->db->query("SELECT job.request_no,task.task,job.task as task_id,job.status,job.id FROM tblpersonnel_task job,tbltasks task where job.task=task.id and task.task_for='Personnel' and job.request_no = '$id'");
// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
// 	{
// 		$this->getpersonnel_task_data[] = $row;
// 	}
// 	return $this->getpersonnel_task_data;
// }
// public function getequipment_task_data($id)
// {
// 	$res = $this->db->query("SELECT job.request_no,task.task,job.task as task_id,job.status,job.id FROM tbloperator_task job,tbltasks task where job.task=task.id and task.task_for='Equipment' and job.request_no = '$id'");
// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
// 	{
// 		$this->getequipment_task_data[] = $row;
// 	}
// 	return $this->getequipment_task_data;
// }
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
public function toPersonnel_task_added($id)
{
	$res = $this->db->query("SELECT per.request_no,per.status,per.emp_id,per.id,per.temp_designation,emp.emp_id,emp.fname,emp.mname,emp.lname,mp.mp_name,per.remarks FROM tblpersonnel_activity per,tblemployee emp,tblmanpower mp where per.emp_id=emp.emp_id and emp.mp_id=mp.id and mp.mp_code='Personnel' and per.request_no='$id'");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->per_added_task[] = $row;
	}
	return $this->per_added_task;
}
public function toOperator_task_added($id)
{
	$res = $this->db->query("SELECT optr.remarks,optr.reason,optr.request_no,optr.id,optr.emp_id,emp.fname,emp.mname,emp.lname,mp.mp_name,optr.temp_designation,optr.status,optr.remarks FROM tbloperator_activity optr,tblmanpower mp,tblemployee emp where optr.emp_id=emp.emp_id and emp.mp_id=mp.id and optr.request_no='$id'");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->optr_added_task[] = $row;
	}
	return $this->optr_added_task;
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
public function toActivity($id)
{
	$res = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id'");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->data_activity[] = $row;
	}
	return $this->data_activity;
}
public function all_operator($id)
{
	$stat = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id'");
	$rows = $stat->fetch(PDO::FETCH_ASSOC);
	$status = $rows['status'];
	$res = $this->db->query("SELECT emp.fname,emp.id,emp.emp_id,emp.mname,emp.lname,eqpt1.status,mp.mp_name FROM tblgivenequipment_req eqpt1,tblemployee emp, tblmanpower mp where eqpt1.optr_id=emp.emp_id and mp.mp_code='operator' and emp.mp_id=mp.id and eqpt1.request_no='$id'");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->all_operator[] = $row;
	}
	$arr = array("status"=>$status,"array"=>$this->all_operator);
	return $arr;
}
public function all_gang($id)
{
	$stat = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id'");
	$rows = $stat->fetch(PDO::FETCH_ASSOC);
	$status = $rows['status'];
	$res = $this->db->query("SELECT emp.fname,emp.id,emp.emp_id,emp.mname,emp.lname,emp1.status,mp.mp_name FROM tblgivenmanpower_req emp1,tblemployee emp, tblmanpower mp where emp1.emp_id=emp.emp_id and emp.mp_id=mp.id and emp1.request_no='$id'");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->all_gang[] = $row;
	}
	$arr = array("status"=>$status,"array"=>$this->all_gang);
	return $arr;
}
public function get_job_equipment($id)
{
	$res = $this->db->query("SELECT eq.mp_id,er.status,er.id,er.eq_code,eq.eqpt_name,er.no_optr,er.no_eqpt FROM tblequipreq er,tblequipment eq where er.eq_code=eq.id and er.request_no='$id' and er.remarks!='Relieved'");
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
public function get_mp_req($id)
{
	$handler = array();
	$get = $this->db->query("SELECT * FROM tblmanpowerreq where id='$id'");
	$row = $get->fetch(PDO::FETCH_ASSOC);
	$nos = $row['nos'];
	$res = $this->db->query("SELECT emp.mp_id,emp.fname,emp.id,emp.mname,emp.lname,emp.status,emp.emp_id FROM tblemployee emp,tblmanpower mp where mp.id=emp.mp_id and mp.mp_code='Personnel' and emp.is_present='1' and emp.status='Active' and emp.job_stat='' and emp.is_assigned='0' ORDER BY emp.fname");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->data_mp_req[] = $row;
	}
	$handler = array('data_mp_req'=>$this->data_mp_req,'nos'=>$nos);
	return $handler;
}
public function toAssigned_optr($id)
{
	$res = $this->db->query("SELECT emp.emp_id,emp.id,emp.fname,emp.mname,emp.lname FROM tblemployee emp,tblmanpower mp where emp.mp_id=mp.id and mp.mp_code='operator' and emp.status='Active' and mp.id='$id' and emp.job_stat='' and emp.is_assigned='0' and emp.is_present='1' ORDER BY emp.fname");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->to_assigned_optr[] = $row;
	}
	return $this->to_assigned_optr;
}
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
		$res = $this->db->query("UPDATE tblpersonnel_activity set status='working',remarks='working',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
		$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req=$row['request_no'];
			$emp_id=$row['emp_id'];
			$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$req."','".$emp_id."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		$check = $this->db->query("SELECT * FROM tblpersonnel_activity where id='".$id."' and status='working'");
		if ($check->rowCount() > 0) {
			return "started";
		}else {
			return "error";
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
		$res = $this->db->query("UPDATE tblpersonnel_activity set status='paused',remarks='paused',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
		$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req=$row['request_no'];
			$emp_id=$row['emp_id'];
			$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_paused,encoded_by,created_at)values('".$req."','".$emp_id."','paused','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		$check = $this->db->query("SELECT * FROM tblpersonnel_activity where id='".$id."' and status='paused'");
		if ($check->rowCount() > 0) {
			return "paused";
		}else {
			return "error";
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
		$res = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='stopped',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where id='$id'");
		$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req=$row['request_no'];
			$emp_id=$row['emp_id'];
			$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		$check = $this->db->query("SELECT * FROM tblpersonnel_activity where id='".$id."' and status='stopped'");
		if ($check->rowCount() > 0) {
			return "stopped";
		}else {
			return "error";
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
		$res = $this->db->query("UPDATE tblpersonnel_activity set status='resumed',remarks='resumed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
		$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req=$row['request_no'];
			$emp_id=$row['emp_id'];
			$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req."','".$emp_id."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		$check = $this->db->query("SELECT * FROM tblpersonnel_activity where id='".$id."' and status='resumed'");
		if ($check->rowCount() > 0) {
			return "continued";
		}else {
			return "error";
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
		$res = $this->db->query("UPDATE tblpersonnel_activity set status='completed',remarks='completed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
		$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req=$row['request_no'];
			$emp_id=$row['emp_id'];
			$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_completed,encoded_by,created_at)values('".$req."','".$emp_id."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		$check = $this->db->query("SELECT * FROM tblpersonnel_activity where id='".$id."' and status='completed'");
		if ($check->rowCount() > 0) {
			return "completed";
		}else {
			return "error";
		}
	}
}
public function toPer_delete($id)
{
	$del = $this->db->query("DELETE FROM tblpersonnel_activity where id='$id'");
	$check = $this->db->query("SELECT * FROM tblpersonnel_activity where id='$id'");
	if ($check->rowCount() > 0) {
		return "error";
	}else {
		return "deleted";
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
		$res = $this->db->query("UPDATE tbloperator_activity set status='working',remarks='working',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
		$res2 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req=$row['request_no'];
			$emp_id=$row['emp_id'];
			$ins_per_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$req."','".$emp_id."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		$check = $this->db->query("SELECT * FROM tbloperator_activity where id='".$id."' and status='working'");
		if ($check->rowCount() > 0) {
			return "started";
		}else {
			return "error";
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
		$res = $this->db->query("UPDATE tbloperator_activity set status='paused',remarks='paused',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
		$res2 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req=$row['request_no'];
			$emp_id=$row['emp_id'];
			$ins_per_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_paused,encoded_by,created_at)values('".$req."','".$emp_id."','paused','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		$check = $this->db->query("SELECT * FROM tbloperator_activity where id='".$id."' and status='paused'");
		if ($check->rowCount() > 0) {
			return "paused";
		}else {
			return "error";
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
		$res = $this->db->query("UPDATE tbloperator_activity set status='stopped',remarks='stopped',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where id='$id'");
		$res2 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req=$row['request_no'];
			$emp_id=$row['emp_id'];
			$ins_per_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		$check = $this->db->query("SELECT * FROM tbloperator_activity where id='".$id."' and status='stopped'");
		if ($check->rowCount() > 0) {
			return "stopped";
		}else {
			return "error";
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
				$ins_per_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req."','".$emp_id."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
			}
			$check = $this->db->query("SELECT * FROM tbloperator_activity where id='".$id."' and status='resumed'");
			if ($check->rowCount() > 0) {
				return "continued";
			}else {
				return "error";
			}
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
		$res = $this->db->query("UPDATE tbloperator_activity set status='completed',remarks='completed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='$id'");
		$res2 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."' and id='$id'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req=$row['request_no'];
			$emp_id=$row['emp_id'];
			$ins_per_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_completed,encoded_by,created_at)values('".$req."','".$emp_id."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		$check = $this->db->query("SELECT * FROM tbloperator_activity where id='".$id."' and status='completed'");
		if ($check->rowCount() > 0) {
			return "completed";
		}else {
			return "error";
		}
	}
}
public function toOptr_delete($id)
{
	$del = $this->db->query("DELETE FROM tbloperator_activity where id='$id'");
	$check = $this->db->query("SELECT * FROM tbloperator_activity where id='$id'");
	if ($check->rowCount() > 0) {
		return "error";
	}else {
		return "deleted";
	}
}
public function toAdd_personnel_task()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$check_stat = $this->db->query("SELECT * FROM tblpersonnel_activity where request_no='".$_POST['req_no']."' and emp_id='".$_POST['id']."' and status!='completed'");
	if ($check_stat->rowCount() > 0) {
		return "pending";
	}else{
		$res = $this->db->query("INSERT INTO tblpersonnel_activity (request_no,emp_id,status,encoded_by,created_at,temp_designation)values('".$_POST['req_no']."','".$_POST['id']."','queued','".$_POST['user']."','".$Ctime."','".$_POST['temp_des']."')");
		$check = $this->db->query("SELECT * FROM tblpersonnel_activity where request_no='".$_POST['req_no']."' and emp_id='".$_POST['id']."' and status='queued'");
		if ($check->rowCount() > 0) {
			return "added";
		}else {
			return "error";
		}
	}
}
public function toAdd_operator_task()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$check_stat = $this->db->query("SELECT * FROM tbloperator_activity where request_no='".$_POST['req_no']."' and emp_id='".$_POST['id']."' and status!='completed'");
	if ($check_stat->rowCount() > 0) {
		return "pending";
	}else{
		$res = $this->db->query("INSERT INTO tbloperator_activity (request_no,emp_id,status,encoded_by,created_at,temp_designation)values('".$_POST['req_no']."','".$_POST['id']."','queued','".$_POST['user']."','".$Ctime."','".$_POST['temp_des']."')");
		$check = $this->db->query("SELECT * FROM tbloperator_activity where request_no='".$_POST['req_no']."' and emp_id='".$_POST['id']."' and status='queued'");
		if ($check->rowCount() > 0) {
			return "added";
		}else {
			return "error";
		}
	}
}
public function toOptr_relieve($id)
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$notes = "Relieved by ".$_POST['user']."(Superadmin)";

	$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and emp_id='$id' and request_no='".$_POST['req']."'");
	while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
	{
		$emp_id = $row1['emp_id'];
		$req = $row1['request_no'];
		$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='Relieved', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
		$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	}
	$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id' and request_no='".$_POST['req']."'");
	while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
	{
		$emp_id = $row2['emp_id'];
		$req2 = $row2['request_no'];
		$update = $this->db->query("UPDATE tbloperator_activity set status='stopped',remarks='Relieved', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
		$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req2."','".$emp_id."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	}
	$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
	$job_stat = $status->fetch(PDO::FETCH_ASSOC);
	$req_status = $job_stat['status'];
	if ($req_status == "working" || $req_status == "stopped" || $req_status == "queued" || $req_status == "activated" || $req_status == "resumed") {
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Relieved',is_assigned='0',request_no='',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenequipment_req set status='Relieved',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where optr_id='".$id."' and request_no='".$_POST['req']."'");
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Relieved' and emp_id='$id'");
		$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Relieved' and optr_id='$id'");
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "relieved";
		}else {
			return "error";
		}
	}else{
		$res2 = $this->db->query("UPDATE tblgivenequipment_req set status='Relieved',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where optr_id='".$id."' and request_no='".$_POST['req']."'");
		$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Relieved' and optr_id='$id'");
		if ($check2->rowCount() > 0) {
			return "relieved";
		}else {
			return "error";
		}
	}
}
public function toOptr_reject($id)
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$notes = "Rejected by ".$_POST['user']."(Superadmin)";

	$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and emp_id='$id' and request_no='".$_POST['req']."'");
	while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
	{
		$emp_id = $row1['emp_id'];
		$req = $row1['request_no'];
		$task = $row1['task'];
		$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='Rejected', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
		$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	}
	$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id' and request_no='".$_POST['req']."'");
	while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
	{
		$emp_id = $row2['emp_id'];
		$req2 = $row2['request_no'];
		$task2 = $row2['task'];
		$update = $this->db->query("UPDATE tbloperator_activity set status='stopped',remarks='Rejected', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
		$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at)values('".$req2."','".$emp_id."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	}
	$status = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='".$_POST['req']."'");
	$job_stat = $status->fetch(PDO::FETCH_ASSOC);
	$req_status = $job_stat['status'];
	if ($req_status == "working" || $req_status == "stopped" || $req_status == "queued" || $req_status == "activated" || $req_status == "resumed") {
		$res1 = $this->db->query("UPDATE tblemployee set job_stat='Rejected',is_assigned='0',request_no='',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='$id'");
		$res2 = $this->db->query("UPDATE tblgivenequipment_req set status='Rejected',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where optr_id='$id' and request_no='".$_POST['req']."'");
		$check1 = $this->db->query("SELECT * FROM tblemployee where job_stat='Rejected' and emp_id='$id'");
		$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Rejected' and optr_id='$id'");
		if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
			return "rejected";
		}else {
			return "error";
		}
	}else{
		$res2 = $this->db->query("UPDATE tblgivenequipment_req set status='Rejected',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where optr_id='$id' and request_no='".$_POST['req']."'");
		$check2 = $this->db->query("SELECT * FROM tblgivenequipment_req where status='Rejected' and optr_id='$id'");
		if ($check2->rowCount() > 0) {
			return "rejected";
		}else {
			return "error";
		}
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
// public function to_per_task_work()
// {
// 	$timezone  = +8;
// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
// 	$timestamp = $_POST['timestamp'];
// 	$e = explode(" ",$timestamp);
// 	$date = $e[0];
// 	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
// 		return "date";
// 	} else {
// 		$res = $this->db->query("UPDATE tblpersonnel_task set status='working',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
// 		$per_task = $this->db->query("SELECT * FROM tblpersonnel_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
// 		while ($row = $per_task->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$req = $row['request_no'];
// 			$task = $row['task'];
// 			$ins_per_task = $this->db->query("INSERT INTO tblpertask_timestamp(request_no,task,status,work_started,encoded_by,created_at)values('".$req."','".$task."','started','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
// 		}
// 		$check = $this->db->query("SELECT * FROM tblpersonnel_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='working'");
// 		if ($check->rowCount() > 0) {
// 			return "working";
// 		}else{
// 			return "error";
// 		}
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
// 		return "date";
// 	} else {
// 		$notes = "Stopped by ".$_POST['user']."(Superadmin)";
// 		$res = $this->db->query("UPDATE tblpersonnel_task set status='stopped',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
// 		$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and task='".$_POST['per_task_id']."' and request_no='".$_POST['req']."'");
// 		while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$emp_id = $row1['emp_id'];
// 			$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='Stopped', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
// 		}
// 		$per_task = $this->db->query("SELECT * FROM tblpersonnel_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
// 		while ($row = $per_task->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$req = $row['request_no'];
// 			$task = $row['task'];
// 			$ins_per_task = $this->db->query("INSERT INTO tblpertask_timestamp(request_no,task,status,work_stopped,encoded_by,created_at)values('".$req."','".$task."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
// 		}
// 		$check = $this->db->query("SELECT * FROM tblpersonnel_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='stopped'");
// 		if ($check->rowCount() > 0) {
// 			return "stopped";
// 		}else{
// 			return "error";
// 		}
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
// 		return "date";
// 	} else {
// 		$notes = "Completed by ".$_POST['user']."(Superadmin)";
// 		$res = $this->db->query("UPDATE tblpersonnel_task set status='completed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
// 		$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='queued' or status!='completed') and task='".$_POST['per_task_id']."' and request_no='".$_POST['req']."'");
// 		while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$emp_id = $row1['emp_id'];
// 			$update = $this->db->query("UPDATE tblpersonnel_activity set status='completed',remarks='Completed', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
// 		}
// 		$per_task = $this->db->query("SELECT * FROM tblpersonnel_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
// 		while ($row = $per_task->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$req = $row['request_no'];
// 			$task = $row['task'];
// 			$ins_per_task = $this->db->query("INSERT INTO tblpertask_timestamp(request_no,task,status,work_completed,encoded_by,created_at)values('".$req."','".$task."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
// 		}
// 		$check = $this->db->query("SELECT * FROM tblpersonnel_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='completed'");
// 		if ($check->rowCount() > 0) {
// 			return "completed";
// 		}else{
// 			return "error";
// 		}
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
// 		return "date";
// 	} else {
// 		$res = $this->db->query("UPDATE tblpersonnel_task set status='resumed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
// 		$per_task = $this->db->query("SELECT * FROM tblpersonnel_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
// 		while ($row = $per_task->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$req = $row['request_no'];
// 			$task = $row['task'];
// 			$ins_per_task = $this->db->query("INSERT INTO tblpertask_timestamp(request_no,task,status,work_resumed,encoded_by,created_at)values('".$req."','".$task."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
// 		}
// 		$check = $this->db->query("SELECT * FROM tblpersonnel_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='resumed'");
// 		if ($check->rowCount() > 0) {
// 			return "resumed";
// 		}else{
// 			return "error";
// 		}
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
// 		return "date";
// 	} else {
// 		$notes = "Paused by ".$_POST['user']."(Superadmin)";
// 		$res = $this->db->query("UPDATE tblpersonnel_task set status='paused',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
// 		$per_activity = $this->db->query("SELECT * FROM tblpersonnel_activity where status!='queued' and task='".$_POST['per_task_id']."' and request_no='".$_POST['req']."' and status!='completed' and status!='paused'");
// 		while ($row1 = $per_activity->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$emp_id = $row1['emp_id'];
// 			$update = $this->db->query("UPDATE tblpersonnel_activity set status='paused',remarks='Paused', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
// 		}
// 		$per_task = $this->db->query("SELECT * FROM tblpersonnel_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
// 		while ($row = $per_task->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$req = $row['request_no'];
// 			$task = $row['task'];
// 			$ins_per_task = $this->db->query("INSERT INTO tblpertask_timestamp(request_no,task,status,work_paused,encoded_by,created_at)values('".$req."','".$task."','paused','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
// 		}
// 		$check = $this->db->query("SELECT * FROM tblpersonnel_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='paused'");
// 		if ($check->rowCount() > 0) {
// 			return "paused";
// 		}else{
// 			return "error";
// 		}
// 	}
// }
// public function to_optr_task_work()
// {
// 	$timezone  = +8;
// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
// 	$timestamp = $_POST['timestamp'];
// 	$e = explode(" ",$timestamp);
// 	$date = $e[0];
// 	if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
// 		return "date";
// 	} else {
// 		$res = $this->db->query("UPDATE tbloperator_task set status='working',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
// 		$optr_task = $this->db->query("SELECT * FROM tbloperator_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
// 		while ($row = $optr_task->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$req = $row['request_no'];
// 			$task = $row['task'];
// 			$ins_per_task = $this->db->query("INSERT INTO tbloptrtask_timestamp(request_no,task,status,work_started,encoded_by,created_at)values('".$req."','".$task."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
// 		}
// 		$check = $this->db->query("SELECT * FROM tbloperator_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='working'");
// 		if ($check->rowCount() > 0) {
// 			return "working";
// 		}else{
// 			return "error";
// 		}
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
// 		return "date";
// 	} else {
// 		$notes = "Paused by ".$_POST['user']."(Superadmin)";
// 		$res = $this->db->query("UPDATE tbloperator_task set status='paused',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
// 		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where status!='queued' and status!='completed' and status!='paused' and task='".$_POST['eqpt_task_id']."'  and request_no='".$_POST['req']."'");
// 		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$emp_id = $row2['emp_id'];
// 			$update = $this->db->query("UPDATE tbloperator_activity set status='paused',remarks='Paused', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
// 		}
// 		$optr_task = $this->db->query("SELECT * FROM tbloperator_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
// 		while ($row = $optr_task->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$req = $row['request_no'];
// 			$task = $row['task'];
// 			$ins_per_task = $this->db->query("INSERT INTO tbloptrtask_timestamp(request_no,task,status,work_paused,encoded_by,created_at)values('".$req."','".$task."','paused','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
// 		}
// 		$check = $this->db->query("SELECT * FROM tbloperator_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='paused'");
// 		if ($check->rowCount() > 0) {
// 			return "paused";
// 		}else{
// 			return "error";
// 		}
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
// 		return "date";
// 	} else {
// 		$notes = "Stopped by ".$_POST['user']."(Superadmin)";
// 		$res = $this->db->query("UPDATE tbloperator_task set status='stopped',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
// 		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and task='".$_POST['eqpt_task_id']."'  and request_no='".$_POST['req']."'");
// 		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$emp_id = $row2['emp_id'];
// 			$update = $this->db->query("UPDATE tbloperator_activity set status='stopped',remarks='Stopped', notes='".$notes."',reason='".$_POST['reason']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
// 		}
// 		$optr_task = $this->db->query("SELECT * FROM tbloperator_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
// 		while ($row = $optr_task->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$req = $row['request_no'];
// 			$task = $row['task'];
// 			$ins_per_task = $this->db->query("INSERT INTO tbloptrtask_timestamp(request_no,task,status,work_stopped,encoded_by,created_at)values('".$req."','".$task."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
// 		}
// 		$check = $this->db->query("SELECT * FROM tbloperator_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='stopped'");
// 		if ($check->rowCount() > 0) {
// 			return "stopped";
// 		}else{
// 			return "error";
// 		}
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
// 		return "date";
// 	} else {
// 		$notes = "Completed by ".$_POST['user']."(Superadmin)";
// 		$res = $this->db->query("UPDATE tbloperator_task set status='completed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
// 		$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and task='".$_POST['eqpt_task_id']."'  and request_no='".$_POST['req']."'");
// 		while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$emp_id = $row2['emp_id'];
// 			$update = $this->db->query("UPDATE tbloperator_activity set status='completed',remarks='Completed', notes='".$notes."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
// 		}
// 		$optr_task = $this->db->query("SELECT * FROM tbloperator_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
// 		while ($row = $optr_task->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$req = $row['request_no'];
// 			$task = $row['task'];
// 			$ins_per_task = $this->db->query("INSERT INTO tbloptrtask_timestamp(request_no,task,status,work_completed,encoded_by,created_at)values('".$req."','".$task."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
// 		}
// 		$check = $this->db->query("SELECT * FROM tbloperator_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='completed'");
// 		if ($check->rowCount() > 0) {
// 			return "completed";
// 		}else{
// 			return "error";
// 		}
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
// 		return "date";
// 	} else {
// 		$res = $this->db->query("UPDATE tbloperator_task set status='resumed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['id']."' and request_no='".$_POST['req']."'");
// 		$optr_task = $this->db->query("SELECT * FROM tbloperator_task where (status!='queued' or status!='completed') and request_no='".$_POST['req']."'");
// 		while ($row = $optr_task->fetch(PDO::FETCH_ASSOC)) 
// 		{
// 			$req = $row['request_no'];
// 			$task = $row['task'];
// 			$ins_per_task = $this->db->query("INSERT INTO tbloptrtask_timestamp(request_no,task,status,work_resumed,encoded_by,created_at)values('".$req."','".$task."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
// 		}
// 		$check = $this->db->query("SELECT * FROM tbloperator_task where id='".$_POST['id']."' and request_no='".$_POST['req']."' and status='resumed'");
// 		if ($check->rowCount() > 0) {
// 			return "resumed";
// 		}else{
// 			return "error";
// 		}
// 	}
// }
// public function toAdd_personnel()
// {
// 	$msg = array();
// 	$timezone  = +8;
// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
// 	$checkIfexist = $this->db->query("SELECT * FROM tblpersonnel_task where request_no ='".$_POST['req']."' and task='".$_POST['task']."'");
// 	if ($checkIfexist->rowCount() > 0) {
// 		return "existed";
// 	}else{
// 		$res = $this->db->query("INSERT INTO tblpersonnel_task (request_no,task,encoded_by,created_at,status)values('".$_POST['req']."','".$_POST['task']."','".$_POST['user']."','".$Ctime."','queued')");
// 		$check = $this->db->query("SELECT * FROM tblpersonnel_task where request_no ='".$_POST['req']."' and task='".$_POST['task']."'");
// 		if ($check->rowCount() > 0) {
// 			return "true";
// 		}else {
// 			return "error";
// 		}
// 	}
// }
// public function toAdd_operator()
// {
// 	$timezone  = +8;
// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
// 	$checkIfexist = $this->db->query("SELECT * FROM tbloperator_task where request_no ='".$_POST['req']."' and task='".$_POST['task']."'");
// 	if ($checkIfexist->rowCount() > 0) {
// 		return "existed";
// 	}else{
// 		$res = $this->db->query("INSERT INTO tbloperator_task (request_no,task,encoded_by,created_at,status)values('".$_POST['req']."','".$_POST['task']."','".$_POST['user']."','".$Ctime."','queued')");
// 		$check = $this->db->query("SELECT * FROM tbloperator_task where request_no ='".$_POST['req']."' and task='".$_POST['task']."'");
// 		if ($check->rowCount() > 0) {
// 			return "true";
// 		}else {
// 			return "error";
// 		}
// 	}
// }
// public function delete_task($id)
// {
// 	$res = $this->db->query("DELETE FROM tbltasks where id='$id'");
// 	$check = $this->db->query("SELECT * FROM tbloptr where id='$id'");
// 	if ($check->rowCount() > 0) {
// 		return "error";
// 	}else{
// 		return "deleted";
// 	}
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
				$destination = $key->destination;
				$box = $key->box;
				$weight = $key->weight;
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
public function toInsert_comm()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$res = $this->db->query("INSERT INTO tbljobcargocommodities (request_no,shipper,commodity,qty,unit,destination,encoded_by,created_at,box,weight) values('".$_POST['requestno']."','".$_POST['shipper']."','".$_POST['commodity']."','".$_POST['qty']."','".$_POST['unit']."','".$_POST['destination']."','".$_POST['user']."','".$Ctime."','".$_POST['box']."','".$_POST['weight']."')");
	return $res;	
}
public function toInsert_eqpt2()
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
	$res = $this->db->query("UPDATE tbljobcargocarrier set vessel='".$_POST['vessel']."',voyage='".$_POST['voyage']."',van_no='".$_POST['vanno']."',truck_no='".$_POST['truckno']."',hatch_no='".$_POST['hatchno']."',deck_no='".$_POST['deckno']."',trk_type='".$_POST['trk_type']."' where request_no='".$_POST['requestno']."'");
	return $res;	
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
public function get_job_activty_edit($id)
{
	$res = $this->db->query("SELECT * FROM tbljoborderrequest where id='$id'");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
		// while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		// {
		// 	$this->job_activity[] = $row;
		// }
		// return $this->job_activity;
}
public function job_activty_update()
{
	$res = $this->db->query("UPDATE tbljoborderrequest set status='".$_POST['status']."',remarks='".$_POST['remarks']."',work_started='".$_POST['work_started']."',work_stopped='".$_POST['work_stopped']."',work_resumed='".$_POST['work_resumed']."',work_completed='".$_POST['work_completed']."',reason='".$_POST['reason']."' where id='".$_POST['job_id']."'");
	$check = $this->db->query("SELECT * FROm tbljoborderrequest where status='".$_POST['status']."' and remarks='".$_POST['remarks']."' and work_started='".$_POST['work_started']."' and work_stopped='".$_POST['work_stopped']."' and work_resumed='".$_POST['work_resumed']."' and work_completed='".$_POST['work_completed']."' and reason='".$_POST['reason']."' and id='".$_POST['job_id']."'");
	if ($check->rowCount() > 0) {
		return "updated";
	}else {
		return "error";
	}
}
// public function toPersonnel_activity($id)
// {
// 	$res = $this->db->query("SELECT per.status,per.id,emp.emp_id,emp.fname,emp.mname,emp.lname,task2.task,mp.mp_name,per.work_started,per.work_stopped,per.work_paused,per.work_resumed,per.work_completed,per.remarks,per.reason FROM tblpersonnel_activity per,tblemployee emp,tblmanpower mp,tblpersonnel_task task,tbltasks task2 where per.emp_id=emp.emp_id and emp.mp_id=mp.id and per.task=task.id and task.task=task2.id and mp.mp_code='Personnel' and per.request_no='$id'");
// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
// 	{
// 		$this->toPersonnel_activity_arr[] = $row;
// 	}
// 	return $this->toPersonnel_activity_arr;
// }
// public function toOperator_activity($id)
// {
// 	$res = $this->db->query("SELECT optr.id,emp.fname,emp.mname,emp.lname,mp.mp_name,optr.temp_designation,op_task.task as task_id,optr.status,task.task,optr.work_started,optr.work_stopped,optr.work_paused,optr.work_resumed,optr.work_completed,optr.remarks,optr.reason FROM tbloperator_activity optr,tblmanpower mp,tblemployee emp,tbloperator_task op_task,tbltasks task where optr.emp_id=emp.emp_id and emp.mp_id=mp.id and optr.task=op_task.id and op_task.task=task.id and optr.request_no='$id'");
// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
// 	{
// 		$this->toOperator_activity_arr[] = $row;
// 	}
// 	return $this->toOperator_activity_arr;
// }
public function to_edit_optr_activity($id)
{
	$res = $this->db->query("SELECT * FROM tbloperator_activity where id='$id'");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
}
public function to_edit_per_activity($id)
{
	$res = $this->db->query("SELECT * FROM tblpersonnel_activity where id='$id'");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
}
public function to_update_optr_activity()
{
	$res = $this->db->query("UPDATE tbloperator_activity set status='".$_POST['status']."',remarks='".$_POST['remarks']."',notes='".$_POST['notes']."',work_started='".$_POST['work_started']."',work_stopped='".$_POST['work_stopped']."',work_resumed='".$_POST['work_resumed']."',work_completed='".$_POST['work_completed']."',reason='".$_POST['reason']."' where id='".$_POST['job_id']."'");
	$check = $this->db->query("SELECT * FROM tbloperator_activity where status='".$_POST['status']."' and remarks='".$_POST['remarks']."' and notes='".$_POST['notes']."' and work_started='".$_POST['work_started']."' and work_stopped='".$_POST['work_stopped']."' and work_resumed='".$_POST['work_resumed']."' and work_completed='".$_POST['work_completed']."' and reason='".$_POST['reason']."' and id='".$_POST['job_id']."'");
	if ($check->rowCount() > 0) {
		return "updated";
	}else{
		return "error";
	}
}
public function to_update_per_activity()
{
	$res = $this->db->query("UPDATE tblpersonnel_activity set status='".$_POST['status']."',remarks='".$_POST['remarks']."',notes='".$_POST['notes']."',work_started='".$_POST['work_started']."',work_stopped='".$_POST['work_stopped']."',work_resumed='".$_POST['work_resumed']."',work_completed='".$_POST['work_completed']."',reason='".$_POST['reason']."' where id='".$_POST['job_id']."'");
	$check = $this->db->query("SELECT * FROM tblpersonnel_activity where status='".$_POST['status']."' and remarks='".$_POST['remarks']."' and notes='".$_POST['notes']."' and work_started='".$_POST['work_started']."' and work_stopped='".$_POST['work_stopped']."' and work_resumed='".$_POST['work_resumed']."' and work_completed='".$_POST['work_completed']."' and reason='".$_POST['reason']."' and id='".$_POST['job_id']."'");
	if ($check->rowCount() > 0) {
		return "updated";
	}else{
		return "error";
	}
}
public function toSubmit_status()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	if ($_POST['status'] == "cancelled") {
		$remarks = "cancelled by ".$_POST['user']."(Superadmin)";
		$res = $this->db->query("UPDATE tbljoborderrequest set status='cancelled',remarks='".$remarks."',reason='".$_POST['reason']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."'");
		$ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_stopped,encoded_by,created_at,reason,accomplishment)values('".$_POST['req']."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['reason']."','".$_POST['accom']."')");

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
				$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='cancelled' ,notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req."' and emp_id='".$emp_id."'");
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
				$update2 = $this->db->query("UPDATE tbloperator_activity set status='stopped', remarks='cancelled', notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and emp_id='".$emp_id2."'");
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
				$ins_equip_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_stopped,reason,encoded_by,created_at)values('".$req2."','".$eq_code."','stopped','".$_POST['timestamp']."','".$_POST['reason']."','".$_POST['user']."','".$Ctime."')");
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
	}else if ($_POST['status'] == "closed"){
		$remarks = "closed by ".$_POST['user']."(Superadmin)";
		$res = $this->db->query("UPDATE tbljoborderrequest set status='closed',remarks='".$remarks."',reason='".$_POST['reason']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."'");
		$ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_stopped,encoded_by,created_at,reason,accomplishment)values('".$_POST['req']."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['reason']."','".$_POST['accom']."')");
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
				$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,reason,encoded_by,created_at)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['reason']."','".$_POST['user']."','".$Ctime."')");
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
				$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,reason,encoded_by,created_at)values('".$req2."','".$emp_id2."','stopped','".$_POST['timestamp']."','".$_POST['reason']."','".$_POST['user']."','".$Ctime."')");
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
				$update2 = $this->db->query("UPDATE tblequipreq set status='stopped',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
				$update3 = $this->db->query("UPDATE tblequipment set status='Active' where id='".$eq_code."'");
				$ins_equip_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_stopped,reason,encoded_by,created_at)values('".$req2."','".$eq_code."','stopped','".$_POST['timestamp']."','".$_POST['reason']."','".$_POST['user']."','".$Ctime."')");
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
	}else if ($_POST['status'] == "working"){
		$remarks = "worked by ".$_POST['user']."(Superadmin)";
		$res = $this->db->query("UPDATE tbljoborderrequest set status='working',remarks='".$remarks."',reason='".$_POST['reason']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."'");
		$ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_started,encoded_by,created_at)values('".$_POST['req']."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where status='queued' and request_no='".$_POST['req']."'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req = $row['request_no'];
			$emp_id = $row['emp_id'];
			$update = $this->db->query("UPDATE tblpersonnel_activity set status='working',remarks='working',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req."'");
			$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$req."','".$emp_id."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		$res3 = $this->db->query("SELECT * FROM tbloperator_activity where status='queued' and request_no='".$_POST['req']."'");
		while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
		{
			$req2 = $row['request_no'];
			$emp_id2 = $row['emp_id'];
			$update2 = $this->db->query("UPDATE tbloperator_activity set status='working', remarks='working',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req2."'");
			$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$req2."','".$emp_id2."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		}
		$res4 = $this->db->query("SELECT * FROM tblequipreq where request_no='".$_POST['req']."'");
		while ($row = $res4->fetch(PDO::FETCH_ASSOC)) 
		{
			$req2 = $row['request_no'];
			$eq_code = $row['eq_code'];
			$rem = $row['remarks'];
			if ($rem == "Relieved" || $rem == "stopped") {

			}else{
				$update2 = $this->db->query("UPDATE tblequipreq set status='working',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
				$update3 = $this->db->query("UPDATE tblequipment set status='Working' where id='".$eq_code."'");
				$ins_equip_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_started,encoded_by,created_at)values('".$req2."','".$eq_code."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
			}
		}
		$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='working' and request_no='".$_POST['req']."'");
		if ($check->rowCount() > 0) {
			return "updated";
		}else {
			return "error";
		}
	}else if ($_POST['status'] == "completed"){
		$remarks = "completed by ".$_POST['user']."(Superadmin)";
		$res = $this->db->query("UPDATE tbljoborderrequest set status='completed',remarks='".$remarks."',reason='".$_POST['reason']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',accomplishment='".$_POST['accom']."' where request_no='".$_POST['req']."'");
		$ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_completed,encoded_by,created_at,reason,accomplishment)values('".$_POST['req']."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['reason']."','".$_POST['accom']."')");
		$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljob_timestamp where request_no='".$_POST['req']."'");
		$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
		$togetid = $get_timestamp['id'];
		$time = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
		$get_time = $time->fetch(PDO::FETCH_ASSOC);
		$ids = $get_time['id'];
		$stopped = $get_time['work_completed'];
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
			// $updating2 = $this->db->query("UPDATE tblequipment_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
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
				$update = $this->db->query("UPDATE tblpersonnel_activity set status='completed',remarks='completed',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req."' and emp_id='".$emp_id."'");
				$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_completed,encoded_by,created_at)values('".$req."','".$emp_id."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."'");
				$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
				$togetid = $get_timestamp['id'];
				$time = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
				$get_time = $time->fetch(PDO::FETCH_ASSOC);
				$ids = $get_time['id'];
				$get = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id."' and id < '".$ids."' ORDER BY id DESC LIMIT 1");
				$getid = $get->fetch(PDO::FETCH_ASSOC);
				$id = $getid['id'];
				$stopped = $get_time['work_completed'];
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
				$update2 = $this->db->query("UPDATE tbloperator_activity set status='completed', remarks='completed',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req2."' and emp_id='".$emp_id2."'");
				$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_completed,encoded_by,created_at)values('".$req2."','".$emp_id2."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
				$timestamp = $this->db->query("SELECT MAX(id) as id FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and emp_id='".$emp_id2."'");
				$get_timestamp = $timestamp->fetch(PDO::FETCH_ASSOC);
				$togetid = $get_timestamp['id'];
				$time = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and id='".$togetid."'");
				$get_time = $time->fetch(PDO::FETCH_ASSOC);
				$ids = $get_time['id'];
				$stopped = $get_time['work_completed'];
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
				$update2 = $this->db->query("UPDATE tblequipreq set status='completed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
				$update3 = $this->db->query("UPDATE tblequipment set status='Active' where id='".$eq_code."'");
				$ins_equip_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_completed,encoded_by,created_at)values('".$req2."','".$eq_code."','completed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
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
		$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='completed' and request_no='".$_POST['req']."'");
		if ($check->rowCount() > 0) {
			return "updated";
		}else {
			return "error";
		}
	}else if ($_POST['status'] == "resumed"){
		$remarks = "resumed by ".$_POST['user']."(Superadmin)";
		$res = $this->db->query("UPDATE tbljoborderrequest set status='resumed',remarks='".$remarks."',reason='".$_POST['reason']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."'");
		$ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_resumed,encoded_by,created_at)values('".$_POST['req']."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req = $row['request_no'];
			$emp_id = $row['emp_id'];
			$rem = $row['remarks'];
			$stat = $row['status'];
			if ($rem == "Dispatched" && $stat=="queued") {
				$update = $this->db->query("UPDATE tblpersonnel_activity set status='working',remarks='working' ,notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req."' and emp_id='".$emp_id."'");
				$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$req."','".$emp_id."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
			}else if($rem == "Relieved" || $rem == "Rejected"){

			}else if ($rem == "Dispatched"){
				$update2 = $this->db->query("UPDATE tblpersonnel_activity set notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and emp_id='".$emp_id."'");
				$ins_optr_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req."','".$emp_id."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
			}else{
				$update = $this->db->query("UPDATE tblpersonnel_activity set status='resumed',remarks='resumed' ,notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req."' and emp_id='".$emp_id."'");
				$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req."','".$emp_id."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
			}
		}
		$res3 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."'");
		while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
		{
			$req2 = $row['request_no'];
			$emp_id2 = $row['emp_id'];
			$rem = $row['remarks'];
			$stat = $row['status'];
			if ($rem == "Dispatched" && $stat == "queued") {
				$update2 = $this->db->query("UPDATE tbloperator_activity set status='working', remarks='resumed', notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and emp_id='".$emp_id2."'");
				$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_started,encoded_by,created_at)values('".$req2."','".$emp_id2."','working','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
			}else if ($rem == "Relieved" || $rem == "Rejected"){

			}else if ($rem == "Dispatched"){
				$update2 = $this->db->query("UPDATE tbloperator_activity set notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and emp_id='".$emp_id2."'");
				$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req2."','".$emp_id2."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
			}else{
				$update2 = $this->db->query("UPDATE tbloperator_activity set status='resumed', remarks='resumed', notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$req2."' and emp_id='".$emp_id2."'");
				$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_resumed,encoded_by,created_at)values('".$req2."','".$emp_id2."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
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
				$update2 = $this->db->query("UPDATE tblequipreq set status='resumed',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
				$update3 = $this->db->query("UPDATE tblequipment set status='Working' where id='".$eq_code."'");
				$ins_equip_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_resumed,encoded_by,created_at)values('".$req2."','".$eq_code."','resumed','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
			}
		}
		$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='resumed' and request_no='".$_POST['req']."'");
		if ($check->rowCount() > 0) {
			return "updated";
		}else {
			return "error";
		}
	}else if ($_POST['status'] == "stopped"){
		$remarks = "stopped by ".$_POST['user']."(Superadmin)";
		$res = $this->db->query("UPDATE tbljoborderrequest set status='stopped',remarks='".$remarks."',reason='".$_POST['reason']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',accomplishment='".$_POST['accom']."' where request_no='".$_POST['req']."'");
		$ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_stopped,encoded_by,created_at,reason,accomplishment)values('".$_POST['req']."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."','".$_POST['reason']."','".$_POST['accom']."')");
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
			$updating = $this->db->query("UPDATE tbljob_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
		}else if ($jobstat == "working") {
			$datetime = $get_time2['work_started'];
			$start_date = new DateTime($stopped);
			$since_start = $start_date->diff(new DateTime($datetime));
			$total_time = $since_start->h.":".$since_start->i.":".$since_start->s;
			$updating = $this->db->query("UPDATE tbljob_timestamp set total_time='".$total_time."' where request_no='".$_POST['req']."' and id='".$ids."'");
		}
		$res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."'");
		while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		{
			$req = $row['request_no'];
			$emp_id = $row['emp_id'];
			$rem = $row['remarks'];
			if ($rem == "Relieved" || $rem == "Rejected") {

			}else{
				$update = $this->db->query("UPDATE tblpersonnel_activity set status='stopped',remarks='stopped',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req."' and emp_id='".$emp_id."'");
				$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,reason,encoded_by,created_at)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['reason']."','".$_POST['user']."','".$Ctime."')");
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
		$res3 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."'");
		while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
		{
			$req2 = $row['request_no'];
			$emp_id2 = $row['emp_id'];
			$rem = $row['remarks'];
			if ($rem == "Relieved" || $rem == "Rejected") {

			}else{
				$update2 = $this->db->query("UPDATE tbloperator_activity set status='stopped', remarks='stopped',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req2."' and emp_id='".$emp_id2."'");
				$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,reason,encoded_by,created_at)values('".$req2."','".$emp_id2."','stopped','".$_POST['timestamp']."','".$_POST['reason']."','".$_POST['user']."','".$Ctime."')");
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
				$update2 = $this->db->query("UPDATE tblequipreq set status='stopped',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
				$update3 = $this->db->query("UPDATE tblequipment set status='Stopped' where id='".$eq_code."'");
				$ins_equip_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_stopped,reason,encoded_by,created_at)values('".$req2."','".$eq_code."','stopped','".$_POST['timestamp']."','".$_POST['reason']."','".$_POST['user']."','".$Ctime."')");
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
		$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='stopped' and request_no='".$_POST['req']."'");
		if ($check->rowCount() > 0) {
			return "updated";
		}else {
			return "error";
		}
	}else{
		// $check_foreman = $this->db->query("SELECT * FROM tbljoborderrequest where foreman_id!='0' and request_no='".$_POST['req']."'");
		// if ($check_foreman->rowCount() > 0) {
		$remarks = "activated by ".$_POST['user']."(Superadmin)";
		$res = $this->db->query("UPDATE tbljoborderrequest set status='activated',remarks='".$remarks."',reason='".$_POST['reason']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."'");
		// $ins = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_stopped,encoded_by,created_at)values('".$_POST['req']."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
		// $res2 = $this->db->query("SELECT * FROM tblpersonnel_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."'");
		// while ($row = $res2->fetch(PDO::FETCH_ASSOC)) 
		// {
		// 	$req = $row['request_no'];
		// 	$update = $this->db->query("UPDATE tblpersonnel_activity set status='queued',remarks='closed',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req."'");
		// }
		// $res3 = $this->db->query("SELECT * FROM tbloperator_activity where (status!='completed' or status!='queued') and request_no='".$_POST['req']."'");
		// while ($row = $res3->fetch(PDO::FETCH_ASSOC)) 
		// {
		// 	$req2 = $row['request_no'];
		// 	$update2 = $this->db->query("UPDATE tbloperator_activity set status='queued', remarks='closed',notes='".$remarks."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where request_no='".$req2."'");
		// }
		// $res4 = $this->db->query("SELECT * FROM tblequipreq where request_no='".$_POST['req']."'");
		// while ($row = $res4->fetch(PDO::FETCH_ASSOC)) 
		// {
		// 	$req2 = $row['request_no'];
		// 	$eq_code = $row['eq_code'];
		// 	$update2 = $this->db->query("UPDATE tblequipreq set status='queued',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where request_no='".$_POST['req']."' and eq_code='".$eq_code."'");
		// 	$ins_optr_act = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,eq_code,status,work_stopped,reason)values('".$req2."','".$eq_code."','queued','".$_POST['timestamp']."','".$_POST['reason']."')");
		// }
		$check = $this->db->query("SELECT * FROM tbljoborderrequest where status='activated' and request_no='".$_POST['req']."'");
		if ($check->rowCount() > 0) {
			return "updated";
		}else {
			return "error";
		}
		// }else{
		// 	return "no_foreman";
		// }
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
		$del = $this->db->query("DELETE FROM tblgivenmanpower_req where emp_id='".$row['emp_id']."' and request_no='".$req."'");
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
// public function to_eqpt_task_del($id)
// {
// 	$get = $this->db->query("SELECT * FROM tbloperator_task where id='$id'");
// 	$row = $get->fetch(PDO::FETCH_ASSOC);
// 	$task = $row['task'];
// 	$res = $this->db->query("DELETE FROM tbloperator_task where id='$id'");
// 	$res2 = $this->db->query("DELETE FROM tbloperator_activity where task='".$task."'");
// 	$check = $this->db->query("SELECT * FROM tbloperator_task where id='$id'");
// 	if ($check->rowCount() > 0) {
// 		return "error";
// 	}else {
// 		return "deleted";
// 	}
// }
// public function to_per_task_del($id)
// {
// 	$get = $this->db->query("SELECT * FROM tblpersonnel_task where id='$id'");
// 	$row = $get->fetch(PDO::FETCH_ASSOC);
// 	$task = $row['task'];
// 	$res = $this->db->query("DELETE FROM tblpersonnel_task where id='$id'");
// 	$res2 = $this->db->query("DELETE FROM tblpersonnel_activity where task='".$task."'");
// 	$check = $this->db->query("SELECT * FROM tblpersonnel_task where id='$id'");
// 	if ($check->rowCount() > 0) {
// 		return "error";
// 	}else {
// 		return "deleted";
// 	}
// }
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
public function toDel_emp($id)
{
	$res = $this->db->query("DELETE FROM tblemployee where emp_id='$id'");
	return $res;
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
public function getEmployees()
{
	$res = $this->db->query("SELECT mp.mp_code,emp.created_at,emp.job_stat,emp.request_no,emp.employment_status,emp.emp_id,emp.fname,emp.is_assigned,emp.mname,emp.lname,mp.mp_name as manpower,emp.status,emp.is_present FROM tblemployee emp,tblmanpower mp where emp.mp_id=mp.id");
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
public function getForeman()
{
	$res = $this->db->query("SELECT * FROM tblusers where role='2'");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->data_foreman[] = $row;
	}
	return $this->data_foreman;
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
public function toJob_toexpo($id)
{
	$res = $this->db->query("SELECT * FROM tbljoborderrequest where request_no='$id'");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
}
public function toJob_per_act_toexpo($id)
{
	$res = $this->db->query("SELECT per.remarks,per.notes,per.reason,per.request_no,emp.emp_id,emp.fname,emp.mname,emp.lname,mp.mp_name,per.status FROM tblpersonnel_activity per,tblemployee emp,tblmanpower mp where per.request_no='$id' and per.emp_id=emp.emp_id and emp.mp_id=mp.id");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->excel2[] = $row;
	}
	return $this->excel2;
}
public function toJob_optr_act_toexpo($id)
{
	$res = $this->db->query("SELECT per.remarks,per.notes,per.reason,per.request_no,emp.emp_id,emp.fname,emp.mname,emp.lname,mp.mp_name,per.status FROM tbloperator_activity per,tblemployee emp,tblmanpower mp where per.request_no='$id' and per.emp_id=emp.emp_id and emp.mp_id=mp.id");
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
public function get_user_log()
{
	$res = $this->db->query("SELECT u.id,u.type,u.date,u.username,r.role FROM tbluserlogs u,tblrole r where u.role=r.id");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->user_logs[] = $row;
	}
	return $this->user_logs;
}
public function to_del_log($id)
{
	$res = $this->db->query("DELETE FROM tbluserlogs where id='$id'");
	$check = $this->db->query("SELECT * FROM tbluserlogs where id='$id'");
	if ($check->rowCount() > 0) {
		return "erorr";
	}else{
		return "deleted";
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
public function eqpt_list($id)
{
	$res = $this->db->query("SELECT * FROM tblequipreq where request_no='$id'");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->eqpt_list[] = $row;
	}
	return $this->eqpt_list;
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
public function tojob_timestamp($id)
{
	$res = $this->db->query("SELECT jo.reason,jo.accomplishment,jo.id,jo.request_no,jo.status,jo.work_started,jo.work_stopped,jo.work_resumed,jo.work_completed FROM tbljoborderrequest j LEFT JOIN tbljob_timestamp jo on j.request_no=jo.request_no where j.request_no='$id' ORDER BY jo.id ASC");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->timestamps[] = $row;
	}
	return $this->timestamps;
}
public function tooperator_act($req,$emp_id)
{
		// $handler = array();
	$res = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where emp_id='".$emp_id."' and request_no='".$req."' ORDER BY id ASC");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->operator_act[] = $row;
	}
	return $this->operator_act;
		// $res2 = $this->db->query("SELECT t.task,e.fname,e.mname,e.lname,e.emp_id FROM tbloperator_activity o,tbloperator_task op,tbltasks t,tblemployee e WHERE o.emp_id='".$_POST['emp_id']."' and o.task='".$_POST['task']."' and o.request_no='".$_POST['req']."' and o.task=op.id and op.task=t.id and e.emp_id=o.emp_id");
		// $row = $res2->fetch(PDO::FETCH_ASSOC);
		// 	$emp_id = $row['emp_id'];
		// 	$task = $row['task'];
		// 	$fname = $row['fname'];
		// 	$mname = $row['mname'];
		// 	$lname = $row['lname'];
		// $handler = array("optr_act"=>$this->operator_act,"emp_id"=>$emp_id,"task"=>$task,"fname"=>$fname,"mname"=>$mname,"lname"=>$lname);
		// return $handler;
}
public function topersonnel_act($req,$emp_id)
{
		// $handler = array();
	$res = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where emp_id='".$emp_id."' and request_no='".$req."' ORDER BY id ASC");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->personnel_act[] = $row;
	}
	return $this->personnel_act;
		// $res2 = $this->db->query("SELECT t.task,e.fname,e.mname,e.lname,e.emp_id FROM tblpersonnel_activity o,tblpersonnel_task op,tbltasks t,tblemployee e WHERE o.emp_id='".$_POST['emp_id']."' and o.task='".$_POST['task']."' and o.request_no='".$_POST['req']."' and o.task=op.id and op.task=t.id and e.emp_id=o.emp_id");
		// $row = $res2->fetch(PDO::FETCH_ASSOC);
		// 	$emp_id = $row['emp_id'];
		// 	$task = $row['task'];
		// 	$fname = $row['fname'];
		// 	$mname = $row['mname'];
		// 	$lname = $row['lname'];
		// $handler = array("per_act"=>$this->personnel_act,"emp_id"=>$emp_id,"task"=>$task,"fname"=>$fname,"mname"=>$mname,"lname"=>$lname);
		// return $handler;
}
public function todelete_job_time($id)
{
	$res = $this->db->query("DELETE FROM tbljob_timestamp where id='$id'");
	$check = $this->db->query("SELECT * FROM tbljob_timestamp where id='$id'");
	if ($check->rowCount() > 0) {
		return "error";
	}else{
		return "deleted";
	}
}
public function toedit_job_time($id)
{
	$res = $this->db->query("SELECT * FROM tbljob_timestamp where id='$id'");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
}
public function toupdate_job_timestamp()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$res = $this->db->query("UPDATE tbljob_timestamp set work_started='".$_POST['edit_work_started']."',work_stopped='".$_POST['edit_work_stopped']."',work_resumed='".$_POST['edit_work_resumed']."',work_completed='".$_POST['edit_work_completed']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."',accomplishment='".$_POST['accom']."' where id='".$_POST['timestamp_id']."' and request_no='".$_POST['req']."'");
	$check = $this->db->query("SELECT * FROM tbljob_timestamp where  work_started='".$_POST['edit_work_started']."' and work_stopped='".$_POST['edit_work_stopped']."' and work_resumed='".$_POST['edit_work_resumed']."' and work_completed='".$_POST['edit_work_completed']."' and updated_by='".$_POST['user']."' and updated_at='".$Ctime."' and id='".$_POST['timestamp_id']."'");
	if ($check->rowCount() > 0) {
		return "updated";
	}else {
		return "error";
	}
}
public function topersonnel_info($req,$emp_id)
{
	$res = $this->db->query("SELECT e.fname,e.mname,e.lname,e.emp_id FROM tblpersonnel_activity o,tblemployee e WHERE o.emp_id='".$emp_id."' and o.request_no='".$req."' and e.emp_id=o.emp_id");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
}
public function tooperator_info($req,$emp_id)
{
	$res = $this->db->query("SELECT e.fname,e.mname,e.lname,e.emp_id FROM tbloperator_activity o,tblemployee e WHERE o.emp_id='".$emp_id."' and o.request_no='".$req."' and e.emp_id=o.emp_id");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
}
public function toedit_job_per_time($id)
{
	$res = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where id='$id'");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
}
public function toedit_job_optr_time($id)
{
	$res = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where id='$id'");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
}
public function toupdate_job_per_timestamp()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$res = $this->db->query("UPDATE tbljobperactivity_timestamp set work_started='".$_POST['edit_work_started']."',work_stopped='".$_POST['edit_work_stopped']."',work_resumed='".$_POST['edit_work_resumed']."',work_completed='".$_POST['edit_work_completed']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['reason']."' where id='".$_POST['timestamp_id']."'");
	$check = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where work_started='".$_POST['edit_work_started']."' and work_stopped='".$_POST['edit_work_stopped']."' and work_resumed='".$_POST['edit_work_resumed']."' and work_completed='".$_POST['edit_work_completed']."' and updated_by='".$_POST['user']."' and updated_at='".$Ctime."' and id='".$_POST['timestamp_id']."'");
	if ($check->rowCount() > 0) {
		return "updated";
	}else{
		return "error";
	}

}
public function toupdate_job_optr_timestamp()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$res = $this->db->query("UPDATE tbljoboptractivity_timestamp set work_started='".$_POST['edit_work_started']."',work_stopped='".$_POST['edit_work_stopped']."',work_resumed='".$_POST['edit_work_resumed']."',work_completed='".$_POST['edit_work_completed']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['update_reason']."' where id='".$_POST['timestamp_id']."'");
	$check = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where work_started='".$_POST['edit_work_started']."' and work_stopped='".$_POST['edit_work_stopped']."' and work_resumed='".$_POST['edit_work_resumed']."' and work_completed='".$_POST['edit_work_completed']."' and updated_by='".$_POST['user']."' and updated_at='".$Ctime."' and id='".$_POST['timestamp_id']."'");
	if ($check->rowCount() > 0) {
		return "updated";
	}else{
		return "error";
	}

}
public function todelete_job_per_time($id)
{
	$res = $this->db->query("DELETE FROM tbljobperactivity_timestamp where id='$id'");
	$check = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where id='$id'");
	if ($check->rowCount() > 0) {
		return "error";
	}else {
		return "deleted";
	}
}
public function todelete_job_optr_time($id)
{
	$res = $this->db->query("DELETE FROM tbljoboptractivity_timestamp where id='$id'");
	$check = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where id='$id'");
	if ($check->rowCount() > 0) {
		return "error";
	}else {
		return "deleted";
	}
}
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
// public function toper_task_time($id)
// {
// 	$handler = array();
// 	$res = $this->db->query("SELECT * FROM tblpertask_timestamp where request_no='".$id."' ORDER BY id ASC");
// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
// 	{
// 		$handler[] = $row;
// 	}
// 	return $handler;
// }
// public function tooptr_task_time($id,$task)
// {
// 	$handler = array();
// 	$res = $this->db->query("SELECT * FROM tbloptrtask_timestamp where task='".$task."' and request_no='".$id."' ORDER BY id ASC");
// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
// 	{
// 		$handler[] = $row;
// 	}
// 	return $handler;
// }
// public function get_personnel_task_details($id,$task)
// {
// 	$res = $this->db->query("SELECT t.id,t2.task,t.request_no,t.status,t.work_started,t.work_stopped,t.work_paused,t.work_resumed,t.work_completed FROM tblpertask_timestamp t,tbltasks t2 where t.task=t2.id and t.task='".$task."' and t.request_no='".$id."' ORDER BY t.id ASC");
// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
// 	{
// 		$this->per_task_time2[] = $row;
// 	}
// 	return $this->per_task_time2;
// }
// public function get_operator_task_details($id,$task)
// {
// 	$res = $this->db->query("SELECT t.id,t2.task,t.request_no,t.status,t.work_started,t.work_stopped,t.work_paused,t.work_resumed,t.work_completed FROM tbloptrtask_timestamp t,tbltasks t2 where t.task=t2.id and t.task='".$task."' and t.request_no='".$id."' ORDER BY t.id ASC");
// 	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
// 	{
// 		$this->optr_task_time2[] = $row;
// 	}
// 	return $this->optr_task_time2;
// }
// public function get_details_per_task_time($id)
// {
// 	$res = $this->db->query("SELECT * FROM tblpertask_timestamp where id='$id'");
// 	$row = $res->fetch(PDO::FETCH_ASSOC);
// 	return $row;
// }
// public function get_details_optr_task_time($id)
// {
// 	$res = $this->db->query("SELECT * FROM tbloptrtask_timestamp where id='$id'");
// 	$row = $res->fetch(PDO::FETCH_ASSOC);
// 	return $row;
// }
// public function to_update_per_task_timestamp()
// {
// 	$timezone  = +8;
// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
// 	$res = $this->db->query("UPDATE tblpertask_timestamp set work_started='".$_POST['work_started']."',work_stopped='".$_POST['work_stopped']."',work_paused='".$_POST['work_paused']."',work_resumed='".$_POST['work_resumed']."',work_completed='".$_POST['work_completed']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['timestamp_id']."'");
// 	$check = $this->db->query("SELECT * FROM  tblpertask_timestamp where work_started='".$_POST['work_started']."' and work_stopped='".$_POST['work_stopped']."' and work_paused='".$_POST['work_paused']."' and work_resumed='".$_POST['work_resumed']."' and work_completed='".$_POST['work_completed']."' and id='".$_POST['timestamp_id']."'");
// 	if ($check->rowCount() > 0) {
// 		return "updated";
// 	}else{
// 		return "error";
// 	}
// }
// public function to_update_optr_task_timestamp()
// {
// 	$timezone  = +8;
// 	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
// 	$res = $this->db->query("UPDATE tbloptrtask_timestamp set work_started='".$_POST['work_started']."',work_stopped='".$_POST['work_stopped']."',work_paused='".$_POST['work_paused']."',work_resumed='".$_POST['work_resumed']."',work_completed='".$_POST['work_completed']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['timestamp_id']."'");
// 	$check = $this->db->query("SELECT * FROM  tbloptrtask_timestamp where work_started='".$_POST['work_started']."' and work_stopped='".$_POST['work_stopped']."' and work_paused='".$_POST['work_paused']."' and work_resumed='".$_POST['work_resumed']."' and work_completed='".$_POST['work_completed']."' and id='".$_POST['timestamp_id']."'");
// 	if ($check->rowCount() > 0) {
// 		return "updated";
// 	}else{
// 		return "error";
// 	}
// }
// public function to_delete_per_task_time($id)
// {
// 	$res = $this->db->query("DELETE FROM tblpertask_timestamp where id='$id'");
// 	$check = $this->db->query("SELECT * FROM tblpertask_timestamp where id='$id'");
// 	if ($check->rowCount() > 0) {
// 		return "error";
// 	}else{
// 		return "deleted";
// 	}
// }
// public function to_delete_optr_task_time($id)
// {
// 	$res = $this->db->query("DELETE FROM tbloptrtask_timestamp where id='$id'");
// 	$check = $this->db->query("SELECT * FROM tbloptrtask_timestamp where id='$id'");
// 	if ($check->rowCount() > 0) {
// 		return "error";
// 	}else{
// 		return "deleted";
// 	}
// }
public function to_insert_job_timestamp()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$res = $this->db->query("INSERT INTO tbljob_timestamp(request_no,status,work_started,work_stopped,work_resumed,work_completed,encoded_by,created_at,reason,accomplishment)values('".$_POST['req']."','".$_POST['status']."','".$_POST['work_started']."','".$_POST['work_stopped']."','".$_POST['work_resumed']."','".$_POST['work_completed']."','".$_POST['user']."','".$Ctime."','".$_POST['reason']."','".$_POST['accom']."')");
	$check = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='".$_POST['req']."' and status='".$_POST['status']."' and work_started='".$_POST['work_started']."' and work_stopped='".$_POST['work_stopped']."' and work_resumed='".$_POST['work_resumed']."' and work_completed='".$_POST['work_completed']."' ");
	if ($check->rowCount() > 0) {
		return "added";
	}else{
		return "error";
	}
}
public function to_insert_optr_timestamp()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$res = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,status,work_started,work_stopped,work_resumed,work_completed,encoded_by,created_at,emp_id,reason)values('".$_POST['req']."','".$_POST['status']."','".$_POST['work_started']."','".$_POST['work_stopped']."','".$_POST['work_resumed']."','".$_POST['work_completed']."','".$_POST['user']."','".$Ctime."','".$_POST['emp_id']."','".$_POST['reason']."')");
	$check = $this->db->query("SELECT * FROM tbljoboptractivity_timestamp where request_no='".$_POST['req']."' and status='".$_POST['status']."' and work_started='".$_POST['work_started']."' and work_stopped='".$_POST['work_stopped']."' and work_resumed='".$_POST['work_resumed']."' and work_completed='".$_POST['work_completed']."' and emp_id='".$_POST['emp_id']."' ");
	if ($check->rowCount() > 0) {
		return "added";
	}else{
		return "error";
	}
}
public function to_insert_eqpt_timestamp()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$res = $this->db->query("INSERT INTO tblequipment_timestamp(request_no,status,eq_code,work_started,work_stopped,work_resumed,work_completed,encoded_by,created_at,reason)values('".$_POST['req']."','".$_POST['status']."','".$_POST['eq_code']."','".$_POST['work_started']."','".$_POST['work_stopped']."','".$_POST['work_resumed']."','".$_POST['work_completed']."','".$_POST['user']."','".$Ctime."','".$_POST['reason']."')");
	$check = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='".$_POST['req']."' and status='".$_POST['status']."' and work_started='".$_POST['work_started']."' and work_stopped='".$_POST['work_stopped']."' and work_resumed='".$_POST['work_resumed']."' and work_completed='".$_POST['work_completed']."' and eq_code='".$_POST['eq_code']."' ");
	if ($check->rowCount() > 0) {
		return "added";
	}else{
		return "error";
	}
}
public function to_insert_per_timestamp()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$res = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,status,work_started,work_stopped,work_resumed,work_completed,encoded_by,created_at,emp_id,reason)values('".$_POST['req']."','".$_POST['status']."','".$_POST['work_started']."','".$_POST['work_stopped']."','".$_POST['work_resumed']."','".$_POST['work_completed']."','".$_POST['user']."','".$Ctime."','".$_POST['emp_id']."','".$_POST['reason']."')");
	$check = $this->db->query("SELECT * FROM tbljobperactivity_timestamp where request_no='".$_POST['req']."' and status='".$_POST['status']."' and work_started='".$_POST['work_started']."' and work_stopped='".$_POST['work_stopped']."' and work_resumed='".$_POST['work_resumed']."' and work_completed='".$_POST['work_completed']."' and emp_id='".$_POST['emp_id']."' ");
	if ($check->rowCount() > 0) {
		return "added";
	}else{
		return "error";
	}
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
public function tojob_toexpo_time($id)
{
	$res = $this->db->query("SELECT * FROM tbljob_timestamp where request_no='$id' ORDER BY id ASC");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->job_toexpo_time[] = $row;
	}
	return $this->job_toexpo_time;
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
public function tojob_eqpt_list($id)
{
	$jobs = $this->db->query("SELECT req.reason,req.remarks,e.eqpt_name,req.status,req.request_no,req.id,req.eq_code FROM tblequipreq req, tblequipment e where req.eq_code=e.id and req.request_no='$id'");
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
		$update3 = $this->db->query("UPDATE tblequipment set status='Active' where id='".$eq_code."'");
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
	$res = $this->db->query("SELECT req.remarks,e.eqpt_name,req.status,req.eq_code FROM tblequipreq req,tblequipment e where req.eq_code=e.id and req.request_no='$id'");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->job_equipment[] = $row;
	}
	return $this->job_equipment;
}
public function toequip_timestamp($id,$eq)
{
	$handler = array();
	$res = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='$id' and eq_code='$eq'");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$handler[] = $row;
	}
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
public function togetEquipment($code)
{
	$res = $this->db->query("SELECT * FROM tblequipment where id='$code'");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
}
public function togetEquip_timestamp($id,$code)
{
	$res = $this->db->query("SELECT * FROM tblequipment_timestamp where request_no='$id' and eq_code='$code'");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->equipt_time[] = $row;
	}
	return $this->equipt_time;
}
public function todelete_equip_time($id)
{
	$res = $this->db->query("DELETE FROM tblequipment_timestamp where id='$id'");
	$check = $this->db->query("SELECT * FROM tblequipment_timestamp where id='$id'");
	if ($check->rowCount() > 0) {
		return "error";
	}else{
		return "deleted";
	}
}
public function toedit_equip_time($id)
{
	$res = $this->db->query("SELECT * FROm tblequipment_timestamp where id='$id'");
	$row = $res->fetch(PDO::FETCH_ASSOC); 
	return $row;
}
public function toupdate_eqpt_timestamp()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$res = $this->db->query("UPDATE tblequipment_timestamp set work_started='".$_POST['edit_work_started']."',work_stopped='".$_POST['edit_work_stopped']."',work_resumed='".$_POST['edit_work_resumed']."',work_completed='".$_POST['edit_work_completed']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['update_reason']."' where id='".$_POST['timestamp_id']."' and request_no='".$_POST['req']."'");
	$check = $this->db->query("SELECT * FROM tblequipment_timestamp where  work_started='".$_POST['edit_work_started']."' and work_stopped='".$_POST['edit_work_stopped']."' and work_resumed='".$_POST['edit_work_resumed']."' and work_completed='".$_POST['edit_work_completed']."' and updated_by='".$_POST['user']."' and updated_at='".$Ctime."' and id='".$_POST['timestamp_id']."'");
	if ($check->rowCount() > 0) {
		return "updated";
	}else {
		return "error";
	}
}
public function torelieve($id)
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
		$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	}
	$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id' and request_no='".$_POST['req']."'");
	while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
	{
		$emp_id = $row2['emp_id'];
		$req2 = $row2['request_no'];
		$update = $this->db->query("UPDATE tbloperator_activity set status='Stopped',remarks='Rejected', notes='".$notes."',updated_by='".$_POST['user']."',reason='".$_POST['notes']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
		$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at)values('".$req2."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	}
	if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
		return "relieved";
	}else {
		return "error";
	}
		// $ctr1
}
public function toreject($id)
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$notes = "Rejected by ".$_POST['user']."(Superadmin)";
	$res1 = $this->db->query("UPDATE tblemployee set job_stat='Rejected',is_assigned='0',request_no='',updated_by='".$_POST['user']."',updated_at='".$Ctime."',reason='".$_POST['notes']."' where emp_id='$id'");
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
		$ins_per_act = $this->db->query("INSERT INTO tbljobperactivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at)values('".$req."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	}
	$optr_activity = $this->db->query("SELECT * FROM tbloperator_activity where (status!='queued' or status!='completed') and emp_id='$id' and request_no='".$_POST['req']."'");
	while ($row2 = $optr_activity->fetch(PDO::FETCH_ASSOC)) 
	{
		$emp_id = $row2['emp_id'];
		$req2 = $row2['request_no'];
		$update = $this->db->query("UPDATE tbloperator_activity set status='Stopped',remarks='Rejected', notes='".$notes."',updated_by='".$_POST['user']."',reason='".$_POST['notes']."',updated_at='".$Ctime."' where emp_id='".$emp_id."' and request_no='".$_POST['req']."'");
		$ins_optr_act = $this->db->query("INSERT INTO tbljoboptractivity_timestamp(request_no,emp_id,status,work_stopped,encoded_by,created_at)values('".$req2."','".$emp_id."','stopped','".$_POST['timestamp']."','".$_POST['user']."','".$Ctime."')");
	}
	if ($check1->rowCount() > 0 && $check2->rowCount() > 0) {
		return "rejected";
	}else {
		return "error";
	}
}
public function toedit_equipment($id)
{
	$res = $this->db->query("SELECT * FROM tblequipment where id='$id'");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
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
public function toedit_box($id)
{
	$res = $this->db->query("SELECT * FROM tblbox_type where id='$id'");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
}
public function toedit_weight($id)
{
	$res = $this->db->query("SELECT * FROM tblweight_per_box where id='$id'");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
}
public function toupdate_box()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$res = $this->db->query("UPDATE tblbox_type set type='".$_POST['box_type']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['box_id']."'");
	$check = $this->db->query("SELECT * FROM tblbox_type where type='".$_POST['box_type']."' and id='".$_POST['box_id']."'");
	if ($check->rowCount() > 0) {
		return "updated";
	}else{
		return "error";
	}
}
public function tosubmit_box()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$is_exist = $this->db->query("SELECT * FROM tblbox_type where type='".$_POST['box_type']."'");
	if ($is_exist->rowCount() > 0) {
		return "exist";
	}else{
		$res = $this->db->query("INSERT INTO tblbox_type(type,encoded_by,created_at)values('".$_POST['box_type']."','".$_POST['user']."','".$Ctime."')");
		$check = $this->db->query("SELECT * FROM tblbox_type where type='".$_POST['box_type']."'");
		if ($check->rowCount() > 0) {
			return "added";
		}else{
			return "error";
		}
	}
}
public function toupdate_weight()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$res = $this->db->query("UPDATE tblweight_per_box set weight='".$_POST['weight']."',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$_POST['weight_id']."'");
	$check = $this->db->query("SELECT * FROM tblweight_per_box where weight='".$_POST['weight']."' and id='".$_POST['weight_id']."'");
	if ($check->rowCount() > 0) {
		return "updated";
	}else{
		return "error";
	}
}
public function tosubmit_weight()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$is_exist = $this->db->query("SELECT * FROM tblweight_per_box where weight='".$_POST['new_weight']."'");
	if ($is_exist->rowCount() > 0) {
		return "exist";
	}else{
		$res = $this->db->query("INSERT INTO tblweight_per_box(weight,encoded_by,created_at)values('".$_POST['new_weight']."','".$_POST['user']."','".$Ctime."')");
		$check = $this->db->query("SELECT * FROM tblweight_per_box where weight='".$_POST['new_weight']."'");
		if ($check->rowCount() > 0) {
			return "added";
		}else{
			return "error";
		}
	}
}
public function todel_box($id)
{
	$res = $this->db->query("DELETE FROM tblbox_type where id='$id'");
	$check = $this->db->query("SELECT * FROM tblbox_type where id='$id'");
	if ($check->rowCount() > 0) {
		return "error";
	}else{
		return "deleted";
	}
}
public function todel_weight($id)
{
	$res = $this->db->query("DELETE FROM tblweight_per_box where id='$id'");
	$check = $this->db->query("SELECT * FROM tblweight_per_box where id='$id'");
	if ($check->rowCount() > 0) {
		return "error";
	}else{
		return "deleted";
	}
}
public function toadd_equipment()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$check = $this->db->query("SELECT * FROM tblequipreq where eq_code='".$_POST['id']."' and request_no='".$_POST['req']."'");
	if ($check->rowCount() > 0) {
		return "exist";
	}else{
		$res = $this->db->query("INSERT INTO tblequipreq(request_no,eq_code,encoded_by,created_at,remarks,no_eqpt,no_optr,reason)values('".$_POST['req']."','".$_POST['id']."','".$_POST['user']."','".$Ctime."','Dispatched','".$_POST['no_eqpt']."','".$_POST['no_optr']."','".$_POST['user']."')");
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
public function get_equipment_type()
{
	$res = $this->db->query("SELECT * FROM tblequipment_type");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->equipment_type[] = $row;
	}
	return $this->equipment_type;
}
public function get_is_available()
{
	$timezone  = +8;
	// $today = gmdate("Y-m-j", time() + 3600*($timezone+date("I")));
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
public function toopen_attendance($id)
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$update = $this->db->query("UPDATE tblattendance_date set is_close='0',updated_by='".$_POST['user']."',updated_at='".$Ctime."' where id='".$id."'");
	$check2 = $this->db->query("SELECT * FROM tblattendance_date where id='".$id."' and is_close='0'");
	if ($check2->rowCount() > 0) {
		return "open";
	}else{
		return "error";
	}
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
public function tosubmit_eqpt_type()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$check = $this->db->query("SELECT * FROM tblequipment_type where eqpt_type='".$_POST['eqpt_type']."'");
	if ($check->rowCount() > 0) {
		return "exist";
	}else{
		$res = $this->db->query("INSERT INTO tblequipment_type (eqpt_type,encoded_by,created_at)values('".$_POST['eqpt_type']."','".$_POST['user']."','".$Ctime."')");
		$check2 = $this->db->query("SELECT * FROM tblequipment_type where eqpt_type='".$_POST['eqpt_type']."'");
		if ($check2->rowCount() > 0) {
			return "added";
		}else{
			return "error";
		}
	}
}
public function toupdate_eqpt_type()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$check = $this->db->query("SELECT * FROM tblequipment_type where eqpt_type='".$_POST['eqpt_type']."'");
	if ($check->rowCount() > 0) {
		return "exist";
	}else{
		$check3 = $this->db->query("SELECT * FROM tblequipment_type where eqpt_type='".$_POST['eqpt_type']."' and id='".$_POST['id']."'");
		if ($check3->rowCount() > 0) {
			return "no_changes";
		}else{
			$res = $this->db->query("UPDATE tblequipment_type set eqpt_type='".$_POST['eqpt_type']."' where id='".$_POST['id']."'");
			$check2 = $this->db->query("SELECT * FROM tblequipment_type where eqpt_type='".$_POST['eqpt_type']."' and id='".$_POST['id']."'");
			if ($check2->rowCount() > 0) {
				return "updated";
			}else{
				return "error";
			}
		}
	}
}
public function toedit_type($id)
{
	$res = $this->db->query("SELECT * FROM tblequipment_type where id='$id'");
	$row = $res->fetch(PDO::FETCH_ASSOC);
	return $row;
}
public function todel_type($id)
{
	$res = $this->db->query("DELETE FROM tblequipment_type where id='$id'");
	$check = $this->db->query("SELECT * FROM tblequipment_type where id='$id'");
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
		}
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
public function tojob_equipment_needed($id)
{
	$res = $this->db->query("SELECT eq.eqpt_type,eqpt.no_eqpt,eqpt.id,eqpt.no_optr FROM tblequipment_needed eqpt,tblequipment_type eq where eqpt.eqpt_type=eq.id and eqpt.request_no='$id'");
	while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
	{
		$this->job_equipment_needed[] = $row;
	}
	return $this->job_equipment_needed;
}
public function toupload()
{
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	$file = $_FILES['excel']['tmp_name'];
	$filename = $_FILES['excel']['name'];
	$name = explode(".", $filename);
	$user = $_POST['username'];
	$handler = array();
	$file_array = explode(".", $_FILES["excel"]["name"]);  
	if($file_array[1] == "xlsx" || $file_array[1] == "csv")  
	{  
		$ctr=0;
		$object = PHPExcel_IOFactory::load($_FILES["excel"]["tmp_name"]);  
		foreach($object->getWorksheetIterator() as $worksheet)  
		{  
			$highestRow = $worksheet->getHighestRow();  
			for($row=1; $row<=$highestRow; $row++)  
			{  
				$emp_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();  
				$lname = $worksheet->getCellByColumnAndRow(1, $row)->getValue();  
				$mname = $worksheet->getCellByColumnAndRow(2, $row)->getValue();  
				$fname = $worksheet->getCellByColumnAndRow(3, $row)->getValue();  
				$designation = $worksheet->getCellByColumnAndRow(4, $row)->getValue(); 
				$emp_stat = $worksheet->getCellByColumnAndRow(5, $row)->getValue(); 
				$status = $worksheet->getCellByColumnAndRow(6, $row)->getValue(); 
				$fname = str_replace("'", " ", $fname);
				$mname = str_replace("'", " ", $mname);
				$lname = str_replace("'", " ", $lname);
				$check = $this->db->query("SELECT * FROM tblemployee where emp_id='".$emp_id."'");
				if ($check->rowCount() > 0) {

				}else{
					if ($fname != null && $lname!=null && $emp_id!=null && $designation!=null && $emp_stat!=null && $status!=null) {
						$insert = $this->db->query("INSERT INTO tblemployee(emp_id,lname,fname,mname,mp_id,employment_status,encoded_by,created_at,status)VALUES('".$emp_id."','".$lname."','".$fname."','".$mname."','".$designation."','".$emp_stat."','".$user."','".$Ctime."','".$status."')");
						$ctr++;
					}else{

					}
				}
			}
		}
		$check2 = $this->db->query("SELECT * FROM tblemployee where created_at='".$Ctime."'");
		if ($check2->rowCount() > 0) {
			$handler = array("msg"=>"added","ctr"=>$ctr);
			return $handler;
		}else{
			$handler = array("msg"=>"error","ctr"=>$ctr);
			return $handler;
		}
	}else{
		$handler = array("msg"=>"not_csv");
		return $handler;
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
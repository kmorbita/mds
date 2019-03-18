<?php 

class JobModel
{
	private $db;
	private $id;

	public function __construct()
	{
		require_once("../assets/connect.php");
		$this->db = Connect::dbconnect();
		$this->data = array();
		$this->data_mp = array();
		$this->data_equip = array();
	}
	// public function toInsert()
	// {
		// $sql = "INSERT INTO student (student_id,fname,mname,lname,status)values('".$_POST['student_id']."','".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."','Not Enrolled')";
		// $res = $this->db->query($sql);
		// return $res;
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
			return false;
		}else if($check3->rowCount() <= 0){
			return false;
		}else{
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
			$mp = json_decode($_POST['mpjsonstring']);

			$timezone  = +8;
			$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));

			foreach ($comm as $key) {
				$shipper = $key->shipper;
				$commodity = $key->commodity;
				$qty = $key->qty;
				$unit = $key->unit;
				$destination = $key->destination;
				$res = $this->db->query("INSERT INTO tbljobcargocommodities (request_no,shipper,commodity,qty,unit,destination)values('".$requestno."','".$shipper."','".$commodity."','".$qty."','".$unit."','".$destination."')");
			}
			foreach ($eqpt as $key) {
				$eq_code = $key->eq_id;
				$no_of_eqpt = $key->no_of_eqpt;
				$w_optr = $key->w_optr;
				$res = $this->db->query("INSERT INTO tblequipreq (request_no,eq_code,no_eqpt,no_optr)values('".$requestno."','".$eq_code."','".$no_of_eqpt."','".$w_optr."')");
			}
			foreach ($mp as $key) {
				$mp_code = $key->mp_id;
				$nos = $key->nos;
				$res = $this->db->query("INSERT INTO tblmanpowerreq (request_no,mp_code,nos)values('".$requestno."','".$mp_code."','".$nos."')");
			}
			
			$res = $this->db->query("INSERT INTO tbljoborderrequest (request_no,requestor,address,requestdate,jobcode,jobdescription,jobdate,joblocation,est,status,created_at)values('".$requestno."','".$requestor."','".$address."','".$requestdate."','".$jobcode."','".$description."','".$jobdate."','".$joblocation."','".$est."','queued','".$Ctime."')");
			$res = $this->db->query("INSERT INTO tbljobcargocarrier (request_no,vessel,voyage,van_no,truck_no,hatch_no,deck_no)values('".$requestno."','".$vessel."','".$voyage."','".$vanno."','".$truckno."','".$hatchno."','".$deckno."')");
			
			
			return true;
		}
	}
	public function toReqno()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$res = $this->db->query("INSERT INTO tbltempreqno (datetime)values('".$Ctime."')");
		// needs validation if data is stored, before proceeding below line
		$res2 = $this->db->query("SELECT id FROM tbltempreqno where datetime='$Ctime'");
		return $res2;
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
		$res = $this->db->query("SELECT * FROM tblequipment");
		while ($row = $res->fetch(PDO::FETCH_ASSOC)) 
		{
			$this->data_equip[] = $row;
		}
		return $this->data_equip;
	}
}
?>
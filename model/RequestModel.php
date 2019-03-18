<?php 

class RequestModel
{
	private $db;
	private $id;

	public function __construct()
	{
		require_once("../assets/connect.php");
		$this->db = Connect::dbconnect();
		$this->data = array();
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
}
?>
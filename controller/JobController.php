<?php 
require_once("../model/JobModel.php");
class JobController
{
	protected $data2;

	public function __construct()
	{
		$this->data2 = new JobModel();
	}
	public function insert()
	{
			// if ($_POST) {
		$insert = $this->data2->toInsert();
		if ($insert) {
					// header("Location: ../index.php");
			return true;
		}else if($insert == false){
			return false;
		}else{
			header("Location: ../jobform/jobform.php");
		}
		// 	}else{
		// 		header("Location: ../index.php");
		// 	}
	}
	public function reqno()
	{
		if ($_POST) {
			$reqno = $this->data2->toReqno();
			if ($reqno != 0 || $reqno != null) {
				header("Location: ../jobform/jobform.php?reqno=".$reqno."");
			}else{
				header("Location: ../index.php");
			}
		}
	}
	public function manpower()
	{
		$res = $this->data2->get_manpower();
		return $res;
	}
	public function equipment()
	{
		$res = $this->data2->get_equipment();
		return $res;
	}
}



?>
<?php 
require_once("../model/RequestModel.php");
class RequestController
{
	protected $data;

	public function __construct()
	{
		$this->data = new RequestModel();
	}
	public function reqno()
	{
		$reqno = $this->data->toReqno();
		if ($reqno != 0 || $reqno != null) {
			header("Location: ../jobform/jobform.php?reqno=".$reqno."");
		}else{
			header("Location: ../index.php");
					// header("Location: ../jobform/jobform.php?reqno=12");
		}
	}
	public function reqnocancel($id)
	{
		$cancel = $this->data->reqnoTocancel($id);
		if ($cancel == true) {
			header("Location: ../index.php");
		}else{
			header("Location: ../jobform/jobform.php?reqno=".$id."");
		}
	}
}



?>
<?php 
require_once("model/SignupModel.php");
class SignupController
{
	protected $data;

	public function __construct()
	{
		$this->data = new SignupModel();
	}
	public function signup()
	{
		if ($_POST) {
			$res = $this->data->signup();
			return $res;
		}
	}
}



?>
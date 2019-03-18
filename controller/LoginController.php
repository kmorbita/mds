<?php 
require_once("model/LoginModel.php");
class LoginController
{
	protected $data;

	public function __construct()
	{
		$this->data = new LoginModel();
	}
	public function getLogin()
	{
		if ($_POST) {
			$res = $this->data->Login();
			if ($res == "1") {
				header("Location: ../mds/view/supervisor/index.php");
			}else if($res == "2"){
				header("Location: ../mds/view/foreman/index.php");
			}else if($res == "3"){
				header("Location: ../mds/view/timekeeper/index.php");
			}else if($res == "4"){
				header("Location: ../mds/view/joclerk/index.php");
			}else if($res == "5"){
				header("Location: ../mds/view/superadmin/index.php");
			}else if($res == "6"){
				header("Location: ../mds/view/client/index.php");
			}else if($res == "7"){
				header("Location: ../mds/view/jochecker/index.php");
			}else if($res == "8"){
				header("Location: ../mds/view/maintenance/index.php");
			}else if($res == "match"){
				return $res;
			}else{
					// header("Location: ../mds/index.php");
				return $res;
			}
		}else{

		}
	}
	
}



?>
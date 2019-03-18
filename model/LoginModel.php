<?php 

class LoginModel
{
	private $db;
	private $id;

	public function __construct()
	{
		require_once("assets/connect.php");
		$this->db = Connect::dbconnect();
		$this->data = array();
	}
	
	public function Login()
	{
		$username = $_POST['username'];
		
		if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
			return "match";
		}else{
			$timezone  = +8;
			$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
			$password = $_POST['password'];
			$temp_pass = sha1($password);
			$temp_pass = md5($temp_pass);
			$res = $this->db->query("SELECT * FROM tblusers where username='$username' and password='$temp_pass'");
			$rows = $res->fetch(PDO::FETCH_ASSOC);
			$name = $rows['ufname']." ".$rows['umname']." ".$rows['ulname'];
			$role = $rows['role'];
			$user = $rows['username'];
			$id = $rows['id'];
			$id_user = $rows['user_id'];
			$status = $rows['account_stat'];
			if ($res->rowCOunt() > 0 && $status=='Active') {
				session_start();
				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;
				$_SESSION['name'] = $name;
				$_SESSION['id'] = $id;
				$_SESSION['role'] = $role;
				$_SESSION['user_id'] = $id_user;
				$insert = $this->db->query("INSERT INTO tbluserlogs(type,username,role,date)values('Login','".$user."','".$role."','".$Ctime."')");
				return $role;
			}else{
				$role = "0";
				return $role;
			}
		}
	}
	
}
?>
<?php 

class SignupModel
{
	private $db;
	private $id;

	public function __construct()
	{
		require_once("assets/connect.php");
		$this->db = Connect::dbconnect();
		$this->data = array();
	}
	public function signup()
	{
		$timezone  = +8;
		$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$password_confirm = $_POST['password_confirm'];
		$user_length = strlen($username);
		$pass_length = strlen($password);
		$check_user = $this->db->query("SELECT * FROM tblusers where username='$username'");
		if (empty($fname) || empty($lname) || empty($password) || empty($password_confirm)) {
			return "blank";
		}else if (!preg_match("/^[a-zA-Z ]*$/",$username)){
			return "user_characters";
		}else if (!preg_match("/^[a-zA-Z ]*$/",$password)){
			return "pass_characters";
		}else if ($user_length < 5 || $user_length > 15){
			if ($user_length < 5) {
				return "min_user_len";
			}
			if ($user_length > 15) {
				return "max_user_len";
			}
		}else if ($pass_length < 5 || $pass_length > 15){
			if ($pass_length < 5) {
				return "min_pass_len";
			}
			if ($pass_length > 15) {
				return "max_pass_len";
			}
		}else if ($password != $password_confirm){
			return "no_match";
		}else if ($check_user->rowCount() > 0){
			return "exist";
		}else {
			$temp_pass = sha1($password);
			$temp_pass = md5($temp_pass);
			$res = $this->db->query("INSERT INTO tblusers (ufname,umname,ulname,username,password,original_pass,role,encoded_by,created_at)values('$fname','$mname','$lname','$username','$temp_pass','$password','6','$username','$Ctime')");
			$check = $this->db->query("SELECT * FROM tblusers where ufname='$fname' and umname='$mname' and ulname='$lname' and username='$username' and password='$temp_pass' and original_pass='$password'");
			if ($check->rowCount() > 0) {
				return "inserted";
			}
		}
		return $pass_length;
	}
}
?>
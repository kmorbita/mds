<?php 
require("controller/SignupController.php");
$controller = new SignupController();

if (isset($_POST['signup']) == "true") {
	$res = $controller->signup();
	echo $res;
}
 ?>
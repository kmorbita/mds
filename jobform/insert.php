<?php 
require '../controller/JobController.php';
$controller = new JobController();

if (isset($_POST['submit']) == "true") {
	$msg = $controller->insert();
	if ($msg == true) {
			// header("Location: ../index.php");
		echo true;
	}else{
			// header("Location: ../index.php?error");
		echo false;
	}
}
?>
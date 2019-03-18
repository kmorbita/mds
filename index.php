<?php 
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role']) && $_SESSION['role'] != "0" && $_SESSION['role'] != null) {
	header("Location: error.php");
}else{
	
}
?>
<!doctype html>
<html class="fixed">
<head>

	<!-- Basic -->
	<title>Davao International Container Terminal</title>
	<link rel="icon" type="image/gif/png" href="assets/images/icon.PNG">
	<meta charset="UTF-8">

	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css"> -->

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />
	
	<!-- Theme CSS -->
	<link rel="stylesheet" href="assets/stylesheets/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

	<!-- Head Libs -->
	<script src="assets/vendor/modernizr/modernizr.js"></script>

	<style>
	body {
		background-image:url('assets/images/bg.jpg');
		background-repeat:no-repeat;
		background-size:100%;
		background-position:center;
	}
</style>
</head>
<script>
	function deleteeqpt(id) {
		alert(id);
	}
</script>
<body>
	<section class="body-sign body-locked">
		<div class="center-sign">
			<div class="panel panel-sign">
				<div class="panel-body">

					<form method="post">
						
						<?php 
						require("controller/LoginController.php");
						$controller = new LoginController();
						$msg = $controller->getLogin();
							// echo $msg;
						if ($msg == "0") {
							echo "<script>alert('Account didn't exist!, please check your credentials')</script>";
						}
						if ($msg == "match") {
							echo "<script>alert('Only letters and whitespace allowed in username!')</script>";
						}
						?>
						<div class="current-user text-center">
							<img src="assets/images/login.jpg" alt="John Doe" class="img-circle user-image" />
							<img src="assets/images/mds_logo.png" height="100">
						</div>
						<div class="form-group" align="center">
							<h3>Log in</h3>
						</div>
						<div class="form-group mb-lg">
							<div class="input-group input-group-icon">
								<input name="username" type="text" class="form-control input-lg" placeholder="Username" />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-user"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="form-group mb-lg">
							<div class="input-group input-group-icon">
								<input name="password" type="password" class="form-control input-lg" placeholder="Password" />
								<span class="input-group-addon">
									<span class="icon icon-lg">
										<i class="fa fa-lock"></i>
									</span>
								</span>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 text-center">
								<button type="submit" class="btn btn-primary btn-block">Sign In</button>
							</div>
						</div>
						<span class="mt-lg mb-lg line-thru text-center text-uppercase">
							<span>or</span>
						</span>
						<div class="row">
							<div class="col-xs-12 text-center">
								<!-- <a href="jobform/requestno.php?req=requesting_no"><button type="button" class="btn btn-primary btn-sm">Create Job Order</button></a> -->
								<a href="signup.php" style="text-decoration: none;"><button type="button" class="btn btn-default btn-block">Sign up</button></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!-- start: page -->
	<!-- end: page -->

	<!-- Vendor -->
	<script type="text/javascript" src="assets/vendor/jquery/jquery.js"></script>
	<script type="text/javascript" src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script type="text/javascript" src="assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script type="text/javascript" src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/vendor/magnific-popup/magnific-popup.js"></script>
	<script type="text/javascript" src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
	
	<!-- Theme Base, Components and Settings -->
	<script type="text/javascript" src="assets/javascripts/theme.js"></script>
	
	<!-- Theme Custom -->
	<script type="text/javascript" src="assets/javascripts/theme.custom.js"></script>
	
	<!-- Theme Initialization Files -->
	<script type="text/javascript" src="assets/javascripts/theme.init.js"></script>
	<script type="text/javascript" src="assets/javascripts/ui-elements/examples.notifications.js"></script>
</body>
</html>
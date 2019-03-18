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
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
	<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

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

</head>
<body style="background: url(assets/images/patterns/noisy_net.png) repeat;">
	<!-- start: page -->
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
							<h3>Sign up</h3>
						</div>
						<div class="form-group mb-lg">
							<label>Firstname</label>
							<input id="fname" name="fname" type="text" class="form-control input-lg input" required/>
						</div>
						<div class="form-group mb-lg">
							<label>Middlename</label>
							<input id="mname" name="mname" type="text" class="form-control input-lg input"/>
						</div>
						<div class="form-group mb-lg">
							<label>Lastname</label>
							<input id="lname" name="lname" type="text" class="form-control input-lg input" required/>
						</div>
						<div class="form-group mb-lg">
							<label>Username</label>
							<input id="username" name="username" type="text" class="form-control input-lg input" required/>
						</div>

						<div class="form-group mb-none">
							<div class="row">
								<div class="col-sm-6 mb-lg">
									<label>Password</label>
									<input id="password" name="password" type="password" class="form-control input-lg input" required/>
								</div>
								<div class="col-sm-6 mb-lg">
									<label>Password Confirmation</label>
									<input id="password_confirm" name="password_confirm" type="password" class="form-control input-lg input" required/>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12 text-center">
								<button type="button" class="btn btn-primary btn-block btn-lg mt-lg" id="signup">Sign Up</button>
							</div>
						</div>

						<p class="text-center">Already have an account? <a href="index.php">Sign In!</a>
						</form>
					</div>
				</div>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script type="text/javascript" src="assets/vendor/jquery/jquery.js"></script>
		<script type="text/javascript" src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script type="text/javascript" src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script type="text/javascript" src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script type="text/javascript" src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

		<!-- Specific Page Vendor -->
		<script type="text/javascript" src="assets/vendor/select2/select2.js"></script>
		<script type="text/javascript" src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script type="text/javascript" src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

		<!-- Specific Page Vendor -->
		<script type="text/javascript" src="assets/vendor/pnotify/pnotify.custom.js"></script>

		<!-- Theme Base, Components and Settings -->
		<script type="text/javascript" src="assets/javascripts/theme.js"></script>

		<!-- Theme Custom -->
		<script type="text/javascript" src="assets/javascripts/theme.custom.js"></script>

		<!-- Theme Initialization Files -->
		<script type="text/javascript" src="assets/javascripts/theme.init.js"></script>

		<!-- Examples -->
		<script type="text/javascript" src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script type="text/javascript" src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script type="text/javascript" src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>

		<script type="text/javascript" src="assets/javascripts/ui-elements/examples.modals.js"></script>

		<!-- Examples -->
		<script type="text/javascript" src="assets/javascripts/ui-elements/examples.notifications.js"></script>
		<script src="custom.js"></script>

	</body>
	</html>
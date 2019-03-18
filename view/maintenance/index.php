<?php 
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role']) && $_SESSION['role'] == "8") {
	
}else{
	header("Location: error.php");
}
?>
<!doctype html>
<html class="fixed">
<head>

	<!-- Basic -->
	<meta charset="UTF-8">

	<title>Davao International Container Terminal</title>
	<link rel="icon" type="image/gif/png" href="../../assets/images/icon.PNG">
	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="../../assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="../../assets/vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="../../assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="../../assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="../../assets/vendor/select2/select2.css" />
	<link rel="stylesheet" href="../../assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="../../assets/vendor/pnotify/pnotify.custom.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="../../assets/stylesheets/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="../../assets/stylesheets/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="../../assets/stylesheets/theme-custom.css">

	<!-- Head Libs -->
	<script src="../../assets/vendor/modernizr/modernizr.js"></script>
	<style type="text/css">
	.modaldialog {
		width: 100%;
		height: 100%;
		padding: 0;
	}

	.modalcontent {
		height: auto;
		border-radius: 0;
	}
	.image_msg {
		width: 50px;
		height: 50px
	}
</style>
</head>
<body>
	<section class="body">
		<input type="hidden" id="username" value="<?= $_SESSION['username'] ?>">
		<!-- start: header -->
		<header class="header">
			<div class="logo-container">
				<a href="index.php" class="logo">
					<img src="../../assets/images/mds_logo.png" height="45" alt="Porto Admin" />
				</a>
				<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
					<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
				</div>
			</div>
			
			<!-- start: search & user box -->
			<div class="header-right">
				<input type="hidden" id="username_session" value="<?= $_SESSION['username'] ?>">
				<input type="hidden" id="user_id" value="<?= $_SESSION['id'] ?>">
				<span class="separator"></span>
				<ul class="notifications">
					<li>
						<a href="?page=messages" class="notification-icon" id="append_badge">
							<i class="fa fa-envelope"></i>
						</a>
					</li>
				</ul>
				<span class="separator"></span>
				
				<div id="userbox" class="userbox">
					<a href="#" data-toggle="dropdown">
						<figure class="profile-picture">
							<img src="../../assets/images/user.png" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
						</figure>
						<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
							<span class="name"><?= $_SESSION['name']  ?></span>
							<span class="role">Maintenance</span>
						</div>
						
						<i class="fa custom-caret"></i>
					</a>
					
					<div class="dropdown-menu">
						<ul class="list-unstyled">
							<li class="divider"></li>
							<li>
								<a role="menuitem" tabindex="-1" href="passer.php?msg=logout&user=<?= $_SESSION['username']?>&role=<?= $_SESSION['role']?>"><i class="fa fa-power-off"></i> Logout</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- end: search & user box -->
		</header>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<aside id="sidebar-left" class="sidebar-left">
				
				<div class="sidebar-header">
					<div class="sidebar-title" style="color: #ffffff">
						Navigation
					</div>
					<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
				
				<div class="nano">
					<div class="nano-content">
						<?php 
						require_once('sidebar.php');
						?>
					</div>
					
				</div>
				
			</aside>
			<!-- end: sidebar -->
			<section role="main" class="content-body">
				<header class="page-header">
					<h2>Foreman</h2>
					
					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="index.php">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<?php 
							if (isset($_GET['page']) && $_GET['page'] == "joborderlist") {
								echo "<li><span>Job Order List</span></li>";
							}else{
								echo "<li><span>Job Order List</span></li>";
							}
							?>
						</ol>
						
						<a class="sidebar-right-toggle"><i class="fa fa-chevron-left"></i></a>
					</div>
				</header>

				<!-- start: page -->
				<div class="row">
					<div class="col-md-12">
						<!-- Content -->
						<?php 
						require("../../controller/MaintenanceController.php");
						$controller = new MaintenanceController();
						$equipment = $controller->equipment();
						$manpower = $controller->manpower();
						$equipment_type = $controller->equipment_type();
						// $job_code = $controller->job_code();
						// $units = $controller->units();
						$equipment2 = $controller->equipment2();
						$current_pass = $controller->current_pass($_SESSION['username'],$_SESSION['id']);
						require_once('view.php');
						?>
						<!-- Content -->
					</div>
				</div>
				
				<!-- end: page -->
			</section>
		</div>

		<aside id="sidebar-right" class="sidebar-right">
			<div class="nano">
				<div class="nano-content">
					<a href="#" class="mobile-close visible-xs">
						Collapse <i class="fa fa-chevron-right"></i>
					</a>
					
					<div class="sidebar-right-wrapper">
						
						<div class="sidebar-widget widget-calendar">
							<h6>Upcoming Tasks</h6>
							<div data-plugin-datepicker data-plugin-skin="dark" ></div>
							
						</div>
						
					</div>
				</div>
			</div>
		</aside>
	</section>

	<!-- Vendor -->
	<script type="text/javascript" src="../../assets/vendor/jquery/jquery.js"></script>
	<script type="text/javascript" src="../../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script type="text/javascript" src="../../assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../../assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script type="text/javascript" src="../../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="../../assets/vendor/magnific-popup/magnific-popup.js"></script>
	<script type="text/javascript" src="../../assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

	<!-- Specific Page Vendor -->
	<script type="text/javascript" src="../../assets/vendor/select2/select2.js"></script>
	<script type="text/javascript" src="../../assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="../../assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
	<script type="text/javascript" src="../../assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

	<!-- Specific Page Vendor -->
	<script type="text/javascript" src="../../assets/vendor/pnotify/pnotify.custom.js"></script>
	
	<!-- Theme Base, Components and Settings -->
	<script type="text/javascript" src="../../assets/javascripts/theme.js"></script>
	
	<!-- Theme Custom -->
	<script type="text/javascript" src="../../assets/javascripts/theme.custom.js"></script>
	
	<!-- Theme Initialization Files -->
	<script type="text/javascript" src="../../assets/javascripts/theme.init.js"></script>

	<!-- Examples -->
	<script type="text/javascript" src="../../assets/javascripts/tables/examples.datatables.default.js"></script>
	<script type="text/javascript" src="../../assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
	<script type="text/javascript" src="../../assets/javascripts/tables/examples.datatables.tabletools.js"></script>

	<script type="text/javascript" src="../../assets/javascripts/ui-elements/examples.modals.js"></script>

	<!-- Examples -->
	<script type="text/javascript" src="../../assets/javascripts/ui-elements/examples.notifications.js"></script>
	<!-- <script type="text/javascript" src="js/job_details.js"></script> -->
	<script type="text/javascript" src="js/custom.js"></script>
	<script type="text/javascript" src="js/edit.js"></script>
	<script type="text/javascript" src="js/delete.js"></script>
	<script type="text/javascript" src="js/changepass.js"></script>
	<script type="text/javascript" src="js/equipment.js"></script>
</body>
</html>
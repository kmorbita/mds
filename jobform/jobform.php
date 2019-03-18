<!doctype html>
<html class="fixed">
<head>

	<!-- Basic -->
	<meta charset="UTF-8">
	<link rel="icon" type="image/gif/png" href="../assets/images/icon.PNG">
	<title>Davao International Container Terminal</title>
	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="../assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="../assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="../assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
	<link rel="stylesheet" href="../assets/vendor/select2/select2.css" />
	<link rel="stylesheet" href="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
	<link rel="stylesheet" href="../assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
	<link rel="stylesheet" href="../assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
	<link rel="stylesheet" href="../assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
	<link rel="stylesheet" href="../assets/vendor/dropzone/css/basic.css" />
	<link rel="stylesheet" href="../assets/vendor/dropzone/css/dropzone.css" />
	<link rel="stylesheet" href="../assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
	<link rel="stylesheet" href="../assets/vendor/summernote/summernote.css" />
	<link rel="stylesheet" href="../assets/vendor/summernote/summernote-bs3.css" />
	<link rel="stylesheet" href="../assets/vendor/codemirror/lib/codemirror.css" />
	<link rel="stylesheet" href="../assets/vendor/codemirror/theme/monokai.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="../assets/vendor/pnotify/pnotify.custom.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="../assets/stylesheets/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="../assets/stylesheets/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="../assets/stylesheets/theme-custom.css">

	<!-- Head Libs -->
	<script src="../assets/vendor/modernizr/modernizr.js"></script>
	
	<style>
	hr {
		display: block;
		height: 1px;
		border: 0;
		border-top: 1px solid #ccc;
		margin: 1em 0;
		padding: 0; 
		border-color: #000000;
	}
	.color-text {
		color: red;
	}
</style>

</head>
<body>
	<?php 
		// get request number
	if (isset($_GET['reqno'])) {
		$req = $_GET['reqno'];
	}else {
		$req = 0;
	}
		// get request number
	?>
	<section class="body">

		<!-- start: header -->
		<header class="header">
			<div class="logo-container">
				<a href="requestno.php?req=<?= $req ?>&status=cancelation">
					<img src="../assets/images/mds2.png" height="35" alt="Porto Admin" />
				</a>
				<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
					<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
				</div>
			</div>
			
			
		</header>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<!-- end: sidebar -->

			<section role="main">
				

				<!-- start: page -->
				<div class="row">
					<div class="col-xs-12">
						<section class="panel">
							<header class="panel-heading">
								<h2 class="panel-title" align="center">Job Order Request</h2>
							</header>
							<div class="panel-body">
								<?php 
								require("../controller/JobController.php");
								$controller = new JobController();
								$equipment = $controller->equipment();
								$manpower = $controller->manpower();
								?>
								<section class="panel">
									<div class="panel-body">
										<form class="form-horizontal form-bordered" action="#">				<div class="col-md-12" align="left">
											<div class="col-md-2">
												<img src="../assets/images/DICT.jpg">
											</div>
											<div class="col-md-10">
												DAVAO INTERNATIONAL CONTAINER TERMINAL<br>
												BRGY. SAN PEDRO, PANABO CITY
											</div>
											<div class="col-md-12">
												<hr>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>REQUESTOR</label><b><span class="color-text" id="requestor_error"></span></b>
														<input type="text" class="form-control input" id="requestor" name="requestor" value="requestor">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>REQUEST NO</label><b><span class="color-text" id="requestno_error"></span></b>
														<input type="text" class="form-control input" id="requestno" name="requestno" value="<?= 'DICT-'.$req ?>" readonly>
														<input type="hidden" name="hid_requestno" value="<?= $req ?>">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>ADDRESS</label><b><span class="color-text" id="address_error"></span></b>
														<input type="text" class="form-control input" id="address" name="address" value="address">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>REQUEST DATE</label><b><span class="color-text" id="requestdate_error"></span></b>
														<input type="date" class="form-control input" id="requestdate" name="requestdate">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>JOB CODE</label><b><span class="color-text" id="jobcode_error"></span></b>
														<input type="text" class="form-control input" id="jobcode" name="jobcode" value="jobcode">
													</div>
												</div>
												
											</div>

											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>DESCRIPTION</label><b><span class="color-text" id="description_error"></span></b>
														<input type="text" class="form-control input" id="description" name="description" value="description">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>JOB DATE</label><b><span class="color-text" id="jobdate_error"></span></b>
														<input type="date" class="form-control input" id="jobdate" name="jobdate">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>JOB LOCATION</label><b><span class="color-text" id="joblocation_error"></span></b>
														<input type="text" class="form-control input" id="joblocation" name="joblocation" value="joblocation">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>ESTIMATED TIME TO COMPLETE</label><b><span class="color-text" id="est_error"></span></b>
														<input type="text" class="form-control input" id="est" name="est" value="est">
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<section class="panel">
									<header class="panel-heading">
										<h2 class="panel-title">Cargo Details</h2>
									</header>
									<div class="panel-body">
										<div class="form-group">
											<div class="col-md-4">
												<center>CARRIER</center>
												<div class="form-group">
													<label>VESSEL</label><b><span class="color-text" id="vessel_error"></span></b>
													<input type="text" class="form-control input" id="vessel" name="vessel" value="vessel">
												</div>
												<div class="form-group">
													<label>VOYAGE</label><b><span class="color-text" id="voyage_error"></span></b>
													<input type="text" class="form-control input" id="voyage" name="voyage" value="voyage">
												</div>
												<div class="form-group">
													<label>VAN#</label><b><span class="color-text" id="vanno_error"></span></b>
													<input type="text" class="form-control input" id="vanno" name="vanno" value="van">
												</div>
												<div class="form-group">
													<label>TRUCK#</label><b><span class="color-text" id="truckno_error"></span></b>
													<input type="text" class="form-control input" id="truckno" name="truckno" value="truckno">
												</div>
												<div class="form-group">
													<label>HATCH#</label><b><span class="color-text" id="hatchno_error"></span></b>
													<input type="text" class="form-control input" id="hatchno" name="hatchno" value="hatchno">
												</div>
												<div class="form-group">
													<label>DECK#</label><b><span class="color-text" id="deckno_error"></span></b>
													<input type="text" class="form-control input" id="deckno" name="deckno" value="deckno">
												</div>
											</div>
											<div class="col-md-7">
												<center>COMMODITIES</center>
												<div class="form-group">
													<label>SHIPPER</label><b><span class="color-text" id="shipper_error"></span></b>
													<input type="text" class="form-control input" id="shipper" name="shipper" value="shipper">
												</div>

												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label>COMMODITY</label><b><span class="color-text" id="commodity_error"></span></b>
															<input type="text" class="form-control input" id="commodity" name="commodity" value="commodity">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>QTY</label><b><span class="color-text" id="qty_error"></span></b>
															<input type="number" class="form-control input" id="qty" name="qty" value="1">
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label>UNIT</label><b><span class="color-text" id="unit_error"></span></b>
															<input type="number" class="form-control input" id="unit" name="unit" value="1">
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-10">
														<div class="form-group">
															<label>DESTINATION</label><b><span class="color-text" id="destination_error"></span></b>
															<input type="text" class="form-control input" id="destination" name="destination" value="destination">
														</div>
													</div>
													<div class="col-md-2">
														<!-- <div class="form-group"> --><br>
															<button class="btn btn-info btn-sm" type="button" onclick="insertcomm()">ADD</button>
															<!-- </div> -->
														</div>
														
													</div>
													<div class="form-group">
														<div id="display_comm"></div>
													</div>
												</div>
											</div>
										</div>
									</section>
									<section class="panel">
										<header class="panel-heading">
											<h2 class="panel-title">Requesting for</h2>
										</header>
										<div class="panel-body">
											<div class="form-group">
												<section class="panel">
													<header class="panel-heading">
														<h2 class="panel-title">Equipments</h2>
													</header>
													<div class="panel-body">
														<form class="form-horizontal form-bordered" action="#">
															<div class="form-group">
																<div class="col-md-12">
																	<h5>EQUIPMENTS</h5>
																	<div class="row">
																		<div class="col-md-3">
																			<div class="form-group">
																				<label>EQ CODE</label><b><span class="color-text" id="eq_code_error"></span></b>
																				<select data-plugin-selectTwo class="form-control input populate" id="eq_code">
																					<option></option>	
																					<?php foreach($equipment as $row): ?>
																						<option value="<?= $row['id'] ?>=<?= $row['eqpt_name'] ?>"><?= $row['eqpt_name'] ?></option>
																					<?php endforeach ?>
																				</select>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<div class="form-group">
																				<label>NO. OF EQPT.</label><b><span class="color-text" id="no_of_eqpt_error"></span></b>
																				<input type="number" class="form-control input" id="no_of_eqpt" name="no_of_eqpt" value="1">
																			</div>
																		</div>
																		<div class="col-md-3">
																			<div class="form-group">
																				<label>W/ OPTR</label><b><span class="color-text" id="w_optr_error"></span></b>
																				<select data-plugin-selectTwo class="form-control input populate" id="w_optr">
																					<option></option>
																					<option value="1">YES</option>
																					<option value="0">NO</option>
																				</select>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<!-- <div class="form-group"> --><br>
																				<button class="btn btn-info btn-sm" type="button" onclick="inserteqpt()">ADD</button>
																				<!-- </div> -->
																			</div>
																		</div>
																		<div class="form-group">
																			<div id="display_eqpt"></div>
																		</div><br><br>
																	</div>	
																</div>
															</form>
														</div>
													</section>
													<section class="panel">
														<header class="panel-heading">
															<h2 class="panel-title">Manpower</h2>
														</header>
														<div class="panel-body">
															<form class="form-horizontal form-bordered" action="#">
																<div class="form-group">
																	<div class="col-md-12">
																		<h5>MANPOWERS</h5>
																		<div class="row">
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>MP CODE</label><b><span class="color-text" id="mp_code_error"></span></b>
																					<select data-plugin-selectTwo class="form-control input populate" id="mp_code">
																						<option></option>
																						<?php foreach($manpower as $row): ?>
																							<option value="<?= $row['id'] ?>=<?= $row['mp_name'] ?>"><?= $row['mp_name'] ?></option>
																						<?php endforeach ?>
																					</select>
																				</div>
																			</div>
																			<div class="col-md-4">
																				<div class="form-group">
																					<label>NO. OF MANPOWER</label><b><span class="color-text" id="nos_error"></span></b>
																					<input type="number" class="form-control input" id="nos">
																				</div>
																			</div>
																			<div class="col-md-4">
																				<!-- <div class="form-group"> --><br>
																					<button class="btn btn-info btn-sm" type="button" onclick="insertmp()">ADD</button>
																					<!-- </div> -->
																				</div>
																			</div>
																			<div class="form-group">
																				<div id="display_mp"></div>
																			</div><br><br>
																			<div class="col-md-12">
																				<div class="form-group" align="center">
																					<button class="btn btn-info btn-sm" type="button" id="submit_all">SUBMIT</button>
																					<button class="btn btn-info btn-sm" id="clear_all" type="button">CLEAR ALL</button>
																					<a href="requestno.php?req=<?= $req ?>&status=cancelation"><button type="button" class="btn btn-info btn-sm">CANCEL</button></a>
																					<!-- <a href="index.php"><button class="btn btn-info bnt-sm">HOME</button></a> -->
																				</div>
																			</div>
																		</div>
																	</div>
																</form>
															</div>
														</section>








														
													</div>
												</div>
											</section>
										</section>
									</div>
								</section>
							</div>
						</div>
						
						
						
						<!-- end: page -->
					</section>
				</div>

				
			</section>

			<!-- Vendor -->
			<script src="../assets/vendor/jquery/jquery.js"></script>
			<script src="../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
			<script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
			<script src="../assets/vendor/nanoscroller/nanoscroller.js"></script>
			<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
			<script src="../assets/vendor/magnific-popup/magnific-popup.js"></script>
			<script src="../assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
			
			<!-- Specific Page Vendor -->
			<script src="../assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
			<script src="../assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
			<script src="../assets/vendor/select2/select2.js"></script>
			<script src="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
			<script src="../assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
			<script src="../assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
			<script src="../assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
			<script src="../assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
			<script src="../assets/vendor/fuelux/js/spinner.js"></script>
			<script src="../assets/vendor/dropzone/dropzone.js"></script>
			<script src="../assets/vendor/bootstrap-markdown/js/markdown.js"></script>
			<script src="../assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
			<script src="../assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
			<script src="../assets/vendor/codemirror/lib/codemirror.js"></script>
			<script src="../assets/vendor/codemirror/addon/selection/active-line.js"></script>
			<script src="../assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
			<script src="../assets/vendor/codemirror/mode/javascript/javascript.js"></script>
			<script src="../assets/vendor/codemirror/mode/xml/xml.js"></script>
			<script src="../assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
			<script src="../assets/vendor/codemirror/mode/css/css.js"></script>
			<script src="../assets/vendor/summernote/summernote.js"></script>
			<script src="../assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
			<script src="../assets/vendor/ios7-switch/ios7-switch.js"></script>
			
			<!-- Specific Page Vendor -->
			<script src="../assets/vendor/pnotify/pnotify.custom.js"></script>

			<!-- Theme Base, Components and Settings -->
			<script src="../assets/javascripts/theme.js"></script>
			
			<!-- Theme Custom -->
			<script src="../assets/javascripts/theme.custom.js"></script>
			
			<!-- Theme Initialization Files -->
			<script src="../assets/javascripts/theme.init.js"></script>


			<!-- Examples -->
			<script src="../assets/javascripts/forms/examples.advanced.form.js" /></script>

			<!-- Examples -->
			<script src="../assets/javascripts/ui-elements/examples.notifications.js"></script>

			<!-- My Custom -->
			<script src="custom.js"></script>
		</body>
		<script type="text/javascript">
			$(document).ready( function () {
				$("#clear_all").click(function(){
					$(".input").val(""); 
				});
			});
		</script>

		</html>
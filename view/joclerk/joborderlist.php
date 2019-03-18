<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="?page=createform"><button class="btn btn-info btn-sm">Create Job Request</button></a>
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		<h2 class="panel-title">Job Order List</h2>
	</header>
	<div class="panel-body">
		<!-- <a class="mb-xs mt-xs mr-xs modal-sizes btn btn-default" href="#modalFull"> -->
			<!-- </a> -->
								<!-- <div class="input-group mb-md">
									<input type="text" class="form-control" placeholder="Type Request Number" id="search_data">
									<span class="input-group-btn">
										<button class="btn btn-success" type="button" id="search">Search</button>|
										<button class="btn btn-info" type="button" id="view_all"><i class="fa fa-list-alt"></i></button>
									</span>
								</div> -->
								<table class="table table-bordered table-striped mb-none" id="datatable-joblist">									<thead>
									<tr>
										<th>No#</th>
										<th>Request No.</th>
										<th>Job code</th>
										<th>Job Description</th>
										<th>Job Date</th>
										<th>Foreman</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="append_job">
									
								</tbody>
							</table>
								<!-- <div id="modalFull" class="modal-block modal-block-full mfp-hide" role=dialog"">
										<section class="panel">
											<header class="panel-heading">
												<h2 class="panel-title">Are you sure?</h2>
											</header>
											<div class="panel-body">
												<div class="modal-wrapper">
													<div class="modal-text">
														<p>Are you sure that you want to delete this image?</p>
													</div>
												</div>
											</div>
											<footer class="panel-footer">
												<div class="row">
													<div class="col-md-12 text-right">
														<button class="btn btn-primary modal-confirm">Confirm</button>
														<button class="btn btn-default modal-dismiss">Cancel</button>
													</div>
												</div>
											</footer>
										</section>
									</div> -->
									<div class="modal fade" id="modalFull" role="dialog">
										<div class="modal-dialog modaldialog">
											
											<!-- Modal content-->
											<div class="modal-content modalcontent">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Job Order Request Details</h4>
												</div>
												<div class="modal-body">
													<div id="job_display"></div>
													<?php 
											// echo "string";
										// if (isset($_POST['joblistid'])) {
											// require("../../controller/SupervisorController.php");
											// $controller = new SupervisorController();
											// $id = $_POST['joblistid'];
											// $res = $controller->view_job($id);
											// echo $res;
											// echo $id;
											// echo "string2";
											// header("Location: dashboard.php");
										// echo $joblistview;
										// }
													?>

													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													</div>
												</div>
												
											</div>
										</div>
									</div>
									<div class="modal fade" id="status" role="dialog">
										<div class="modal-dialog">

											<!-- Modal content-->
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Job Status</h4>
												</div>
												<div class="modal-body">
													<div class="form-group">
														<input type="hidden" id="request_no">
														<label>Status</label>
														<select data-plugin-selectTwo class="form-control input populate" id="status_code">
															<option></option>
															<option value="cancelled">cancelled</option>
														</select>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" id="submit_status">Submit</button>
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													</div>
												</div>

											</div>
										</div>
									</div>
								</section>
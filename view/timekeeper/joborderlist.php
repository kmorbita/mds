<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
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
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
										
									</div>
								</div>
							</section>
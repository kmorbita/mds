<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">Job Order List</h2>
	</header>
	<div class="panel-body">
		<div class="modal fade" id="foreman" role="dialog">
			<div class="modal-dialog">
				
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Assign Foreman</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<input type="hidden" id="req_no">
							<table class="table table-bordered table-striped mb-none">
								<thead>
									<tr>
										<th>No#</th>
										<th>Foreman Name</th>
										<th>Select</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i=1;

									foreach ($foreman as $row):
										?>
										<tr class="foreman_<?= $row['user_id'] ?>">
											<td><?= $i ?></td>
											<td><?= $row['ufname']." ".$row['umname']." ".$row['ulname'] ?> <input type="hidden" id="foreman_name_<?= $row['user_id']?>" value="<?= $row['ufname']." ".$row['umname']." ".$row['ulname'] ?>"></td>
											<td><button type="button" class="btn btn-info btn-xs" onclick="assign('<?= $row['user_id'] ?>')">Assign</button></td>
										</tr>
										<?php 
										$i++;
									endforeach
									?>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
			
		</div>
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
							</div>
							<div class="modal fade" id="info" role="dialog">
								<div class="modal-dialog modaldialog">
									
									<!-- Modal content-->
									<div class="modal-content modalcontent">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Job Order Request Information</h4>
										</div>
										<div class="modal-body">
											<table class="table table-bordered table-striped mb-none" id="append_table">				  
												<thead>
													<tr>
														<th>No#</th>
														<th>Job Description</th>
														<th>Time Started</th>
														<th>Time End</th>
														<th>Status</th>
														<th>Remarks</th>
													</thead>
													<tbody>
													</tbody>
												</table>
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
														<option value="activated">activate</option>
														<option value="queued">queued</option>
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
								
							</div>
						</div>
					</div>
				</section>
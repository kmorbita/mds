<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">Job Order List</h2>
	</header>
	<div class="panel-body">

		<div align="right">
			<a href="?page=joborderlist"><button type="button" class="btn btn-default">View All</button></a>
			<a href="?page=working_jobs"><button type="button" class="btn btn-default">My Job list</button></a>
		</div>

		<table class="table table-bordered table-striped mb-none" id="datatable-joblist">									
			<thead>
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
		<div class="modal fade" id="status" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Job Status</h4>
					</div>
					<div class="modal-body">
						<input type="text" id="request_no">
						<div class="form-group">
							
							<label>Status</label>
							<select data-plugin-selectTwo class="form-control input populate" id="status_code">
								<option></option>
								<option value="cancelled">Cancelled</option>
								<option value="closed">Closed</option>
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
</section>
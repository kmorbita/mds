<?php 
if (isset($_GET['page']) && isset($_GET['view_activity_id']) != null) {
	$id = $_GET['view_activity_id'];
	$job_activity = $controller->activity($id);
	$job_timestamp = $controller->job_timestamp($id);
	$personnel_task_added = $controller->personnel_task_added($id);
	$operator_task_added = $controller->operator_task_added($id);
	$all_operator = $controller->all_operator($id);
	$all_gang = $controller->all_gang($id);
	$equip = $controller->job_equipment_expo($id);
	// $job_per_task = $controller->job_per_task($id);
	// $job_optr_task = $controller->job_optr_task($id);
}
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			Job Request Number: <u><?= $id ?></u>
			<a href="#" class="fa fa-caret-down"></a>
		</div>
		
		<h2 class="panel-title">Job Activity</h2>
	</header>
	<div class="panel-body">
		<input type="hidden" id="username" value="<?= $_SESSION['username'] ?>">
		<input type="hidden" id="name" value="<?= $_SESSION['name'] ?>">
		<input type="hidden" id="job_req" value="<?= $id ?>">
		<table class="table table-bordered table-striped mb-none" id="datatable-def1">									
			<thead>
				<tr>
					<th>No#</th>
					<th>Request No#</th>
					<th>Job Description</th>
					<th>Job Code</th>
					<th>Job Location</th>
					<th>Status</th>
					<th>Remarks</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				foreach($job_activity as $job):
					?>
					<tr class="gradeX">
						<td><?= $i ?></td>
						<td><?= $job['request_no'] ?><input type="hidden" id="job_desc" value="<?=  $job['jobdescription'] ?>"></td>
						<td><?= $job['jobdescription'] ?></td>
						<td><?= $job['jobcode'] ?></td>
						<td><?= $job['joblocation'] ?></td>
						<td><?= $job['status'] ?></td>
						<td><?= $job['remarks'] ?></td>
					</tr>
					<?php
					$i++;
				endforeach ?>
			</tbody>
		</table>
		<table class="table table-bordered table-striped mb-none" id="datatable-def2">									
			<thead>
				<tr>
					<th>Request No#</th>
					<th>Status</th>
					<th>Work Started</th>
					<th>Work Stopped</th>
					<th>Work Resumed</th>
					<th>Work Completed</th>
					<th>Reason</th>
					<th>Accomplishment</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				foreach($job_timestamp as $job):
					?>
					<tr class="gradeX">
						<td><?= $job['request_no'] ?></td>
						<td><?= $job['status'] ?></td>
						<td><?= $job['work_started'] ?></td>
						<td><?= $job['work_stopped'] ?></td>
						<td><?= $job['work_resumed'] ?></td>
						<td><?= $job['work_completed'] ?></td>
						<td><?= $job['reason'] ?></td>
						<td><?= $job['accomplishment'] ?></td>
					</tr>
					<?php
					$i++;
				endforeach ?>
			</tbody>
		</table>
		<div class="col-md-12">
			<table class="table table-bordered table-striped mb-none"  id="datatable-def3">
				<thead>
					<tr>
						<th colspan="10" class="center" style="background-color: #DADADA">Operator Activity</th>
					</tr>
					<tr>
						<th>No#</th>
						<th>Personnel Name</th>
						<th>Designation</th>
						<th>Status</th>
						<th>Remarks</th>
						<th>Work Time</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i=1;
					foreach($operator_task_added as $row):
						?>
						<tr>
							<td><?= $i ?></td>
							<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
							<td><?= $row['mp_name'] ?></td>
							<td><?= $row['status'] ?></td>
							<td><?= $row['remarks'] ?></td>
							<td class="center"><button type="button" class="btn btn-default btn-xs" onclick="operator_act('<?= $row['emp_id'] ?>')">View</button></td>
						</tr>
						<?php 
						$i++;
					endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="col-md-12">
			<br>
			<table class="table table-bordered table-striped mb-none"  id="datatable-def4">
				<thead>
					<tr>
						<th colspan="10" class="center" style="background-color: #DADADA">Personnel Activity</th>
					</tr>
					<tr>
						<th>No#</th>
						<th>Personnel Name</th>
						<th>Designation</th>
						<th>Status</th>
						<th>Remarks</th>
						<th>Work Time</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i=1;
					foreach($personnel_task_added as $row):
						?>
						<tr>
							<td><?= $i ?></td>
							<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
							<td><?= $row['mp_name'] ?></td>
							<td><?= $row['status'] ?></td>
							<td><?= $row['remarks'] ?></td>
							<td class="center"><button type="button" class="btn btn-default btn-xs" onclick="personnel_act('<?= $row['emp_id'] ?>')">View</button></td>
						</tr>
						<?php 
						$i++;
					endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="col-md-12">
			<br>
			<table class="table table-bordered table-striped mb-none" id="datatable-def5">
				<thead>
					<tr>
						<th colspan="10" class="center" style="background-color: #DADADA">Equipment Activity</th>
					</tr>
					<tr>
						<th>No#</th>
						<th>Equipment Name</th>
						<th>Status</th>
						<th>Work Time</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i=1;
					foreach($equip as $row):
						?>
						<tr>
							<td><?= $i ?></td>
							<td><?= $row['eqpt_name'] ?></td>
							<td><?= $row['status'] ?></td>
							<td class="center"><button type="button" class="btn btn-default btn-xs" onclick="equipment_act('<?= $row['eq_code'] ?>')">View</button></td>
						</tr>
						<?php 
						$i++;
					endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<div class="modal fade" id="operator_modal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Operator Activity</h4>
			</div>
			<div class="modal-body">
				<!-- <div class="col-md-12"> -->
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Operator ID</label>
								<input type="text" class="form-control" id="optr_id" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Operator Name</label>
								<input type="text" class="form-control" id="optr_name" readonly>
							</div>
						</div>
					</div>
					<!-- </div> -->
					<table class="table table-bordered table-striped mb-none" id="datatable-personnel">									
						<thead>
							<tr>
								<th>Status</th>
								<th>Work Started</th>
								<th>Work Stopped</th>
								<th>Work Resumed</th>
								<th>Work Completed</th>
								<th>Reason</th>
							</tr>
						</thead>
						<tbody id="optr_modal">
						</tbody>
					</table>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="modal fade" id="personnel_modal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Personnel Activity</h4>
				</div>
				<div class="modal-body">
					<!-- <div class="col-md-12"> -->
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Personnel ID</label>
									<input type="text" class="form-control" id="per_id" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Personnel Name</label>
									<input type="text" class="form-control" id="per_name" readonly>
								</div>
							</div>
						</div>
						<!-- </div> -->
						<table class="table table-bordered table-striped mb-none" id="datatable-operator">									
							<thead>
								<tr>
									<th>Status</th>
									<th>Work Started</th>
									<th>Work Stopped</th>>
									<th>Work Resumed</th>
									<th>Work Completed</th>
									<th>Reason</th>
								</tr>
							</thead>
							<tbody id="per_modal">
							</tbody>
						</table>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="modal fade" id="per_task_acts" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Personnel Task Activity</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Status</label>
									<input type="text" class="form-control" id="per_task_status" readonly>
								</div>
							</div>
						</div>
						<table class="table table-bordered table-striped mb-none" id="datatable-per-task">
							<thead>
								<tr>
									<th>Status</th>
									<th>Work Started</th>
									<th>Work Stopped</th>
									<th>Work Resumed</th>
									<th>Work Completed</th>
									<th>Reason</th>
								</tr>
							</thead>
							<tbody id="per_task_modal">
							</tbody>
						</table>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="modal fade" id="equipment_modal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Equipment Activity</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Equipement</label>
									<input type="text" class="form-control" id="equipment" readonly>
								</div>
							</div>
						</div>
						<table class="table table-bordered table-striped mb-none" id="datatable-job">
							<thead>
								<tr>
									<th>Status</th>
									<th>Work Started</th>
									<th>Work Stopped</th>
									<th>Work Resumed</th>
									<th>Work Completed</th>
									<th>Reason</th>
								</tr>
							</thead>
							<tbody id="equipment_modal_data">
							</tbody>
						</table>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
		</div>
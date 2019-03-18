<?php 
		// get request number
if (isset($_GET['page']) && $_GET['page'] == "personnel_task") {
	$id = $_GET['req'];
	$task = $_GET['task'];
	$tasks = $controller->personnel_task_details($id,$task);
}
		// get request number
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>

		<h2 class="panel-title">Personnel Task Timestamp Details</h2>
	</header>
	<div class="panel-body">
		<div class="col-md-12">
			<div class="form-group">
				<label>Task: </label>
				<?php 
				$ctr = count($tasks);
				if ($ctr > 0) {
					?>
					<input type='text' class='form-control' value='<?= $tasks[0]['task']  ?>' id='per_task' readonly>
					<?php
				}else {
					?>
					<input type='text' class='form-control' id='per_task' readonly>
					<?php
				}
				 ?>
				
			</div>
		</div>
		<!-- </div> -->
		<table class="table table-bordered table-striped mb-none" id="datatable-operator">									
			<thead>
				<tr>
					<th>No#</th>
					<th>Request No#</th>
					<th>Status</th>
					<th>Work Started</th>
					<th>Work Stopped</th>
					<th>Work Paused</th>
					<th>Work Resumed</th>
					<th>Work Completed</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				foreach($tasks as $job):
					?>
					<tr class="gradeX job_per_task_<?= $job['id'] ?>">
						<td><?= $i ?></td>
						<td><?= $job['request_no'] ?></td>
						<td><?= $job['status'] ?></td>
						<td><?= $job['work_started'] ?></td>
						<td><?= $job['work_stopped'] ?></td>
						<td><?= $job['work_paused'] ?></td>
						<td><?= $job['work_resumed'] ?></td>
						<td><?= $job['work_completed'] ?></td>
						<td><button class="btn btn-default btn-xs fa fa-pencil" onclick="edit_per_task_time('<?= $job['id'] ?>')"></button>|<button class="btn btn-default btn-xs fa fa-trash-o" onclick="return confirm('Are you sure?')?delete_per_task_time('<?= $job['id'] ?>'):'';"></button></td>
					</tr>
					<?php
					$i++;
				endforeach ?>
			</tbody>
		</table>
	</div>
</section>

<div class="modal fade" id="edit_per_task_time" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Personnel Task Timestamp</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="request_no_job">
				<input type="hidden" id="timestamp_id">
				<div class="form-group">
					<label>Status</label>
					<input type="text" class="form-control" id="status" readonly>
				</div>
				<div class="form-group">
					<label>Work Started</label>
					<input type="text" class="form-control" id="work_started"><b><span class="color-text" id="work_started_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Stopped</label>
					<input type="text" class="form-control" id="work_stopped"><b><span class="color-text" id="work_stopped_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Paused</label>
					<input type="text" class="form-control" id="work_paused"><b><span class="color-text" id="work_stopped_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Resumed</label>
					<input type="text" class="form-control" id="work_resumed"><b><span class="color-text" id="work_resumed_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Completed</label>
					<input type="text" class="form-control" id="work_completed"><b><span class="color-text" id="work_completed_error"></span></b>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" id="update_per_task_timestamp">Update</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="close_job_time">Close</button>
				</div>
			</div>

		</div>
	</div>
</div>
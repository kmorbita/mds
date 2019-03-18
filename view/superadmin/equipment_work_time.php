<?php 
		// get request number
if (isset($_GET['page']) && $_GET['page'] == "equipment_work_time") {
	$request_no = $_GET['req'];
	$eq_code = $_GET['eq_code'];
	$getEquipment = $controller->getEquipment($eq_code);
	$getEquip_timestamp = $controller->getEquip_timestamp($request_no,$eq_code);

}
		// get request number
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<button type="button" class="btn btn=sm btn-default" data-toggle="modal" data-target="#add_per_timestamp">Add Equipment Timestamp</button>
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>

		<h2 class="panel-title">Edit Equipment Activity Timestamp</h2>
	</header>
	<div class="panel-body">
		<input type="hidden" id="req" value="<?= $request_no ?>">
		<input type="hidden" id="eq_code" value="<?= $eq_code ?>">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Equipment</label>
					<input type="text" class="form-control" value="<?= $getEquipment['eqpt_name'] ?>" id="per_name" readonly>
				</div>
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
					<th>Work Resumed</th>
					<th>Work Completed</th>
					<th>Reason</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				foreach($getEquip_timestamp as $job):
					?>
					<tr class="gradeX equip_<?= $job['id'] ?>">
						<td><?= $i ?></td>
						<td><?= $job['request_no'] ?></td>
						<td><?= $job['status'] ?></td>
						<td><?= $job['work_started'] ?></td>
						<td><?= $job['work_stopped'] ?></td>
						<td><?= $job['work_resumed'] ?></td>
						<td><?= $job['work_completed'] ?></td>
						<td><?= $job['reason'] ?></td>
						<td><button class="btn btn-default btn-xs fa fa-pencil" onclick="edit_equip_time('<?= $job['id'] ?>')"></button>|<button class="btn btn-default btn-xs fa fa-trash-o" onclick="return confirm('Are you sure?')?delete_equip_time('<?= $job['id'] ?>'):'';"></button></td>
					</tr>
					<?php
					$i++;
				endforeach ?>
			</tbody>
		</table>
	</div>
</section>

<div class="modal fade" id="edit_eqpt_timestamp" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Equipment Timestamp</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="request_no_job">
				<input type="hidden" id="timestamp_id">
				<div class="form-group">
					<label>Work Started</label>
					<input type="text" class="form-control" id="update_work_started"><b><span class="color-text" id="update_work_started_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Stopped</label>
					<input type="text" class="form-control" id="update_work_stopped"><b><span class="color-text" id="update_work_stopped_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Resumed</label>
					<input type="text" class="form-control" id="update_work_resumed"><b><span class="color-text" id="update_work_resumed_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Completed</label>
					<input type="text" class="form-control" id="update_work_completed"><b><span class="color-text" id="update_work_completed_error"></span></b>
				</div>
				<div class="form-group">
					<label>Reason</label>
					<input type="text" class="form-control" id="update_reason"><b><span class="color-text" id="update_reason_error"></span></b>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" id="update_eqpt_timestamp">Update</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="close_job_time">Close</button>
				</div>
			</div>

		</div>
	</div>
</div>



<div class="modal fade" id="add_per_timestamp" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Equipment Timestamp</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Status</label>
					<select data-plugin-selectTwo name="role" class="form-control populate" id="job_status">
						<option></option>
						<option value="started">Started</option>
						<option value="stopped">Stopped</option>
						<option value="paused">Paused</option>
						<option value="resumed">Resumed</option>
						<option value="completed">Completed</option>
					</select>
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
				<div class="form-group">
					<label>Reason</label>
					<input type="text" class="form-control" id="reason"><b><span class="color-text" id="update_reason_error"></span></b>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" id="insert_eqpt_timestamp">Add</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="close_job">Close</button>
				</div>
			</div>

		</div>
	</div>
</div>
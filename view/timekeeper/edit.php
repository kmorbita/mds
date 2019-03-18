<?php 
if (isset($_GET['page']) && isset($_GET['emp_id']) != null) {
	$id = $_GET['emp_id'];
	$res = $controller->edit_mp($id);
}
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
		</div>
		<h2 class="panel-title">Edit Employee</h2>
	</header>
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label">Employee ID</label><b><span class="color-text" id="mp_id_edit_error"></span></b>
			<div class="col-sm-9">
				<input type="text" name="name" id="mp_id_edit" class="form-control" value="<?= $res['emp_id'] ?>" readonly/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Firstname</label><b><span class="color-text" id="mp_fname_edit_error"></span></b>
			<div class="col-sm-9">
				<input type="text" name="name" id="mp_fname_edit" class="form-control" value="<?= $res['fname'] ?>" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Middlename</label><b><span class="color-text" id="mp_mname_edit_error"></span></b>
			<div class="col-sm-9">
				<input type="text" name="name" id="mp_mname_edit" class="form-control" value="<?= $res['mname'] ?>" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Lastname</label><b><span class="color-text" id="mp_lname_edit_error"></span></b>
			<div class="col-sm-9">
				<input type="text" name="name" id="mp_lname_edit" class="form-control" value="<?= $res['lname'] ?>" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Manpower Code</label><b><span class="color-text" id="mp_code_edit_error"></span></b>
			<div class="col-sm-9">
				<select data-plugin-selectTwo id="mp_code_edit" class="form-control populate">
					<option></option>
					<?php foreach($manpower as $row): ?>
						<option value="<?= $row['id'] ?>" <?php if($res['mp_id'] ==  $row['id']) echo 'selected="selected"' ?>><?= $row['mp_name'] ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Status</label><b><span class="color-text" id="mp_stat_edit_error"></span></b>
			<div class="col-sm-9">
				<select data-plugin-selectTwo id="mp_stat_edit" class="form-control populate">
					<option></option>
					<option value="Active" <?php if($res['status'] == "Active") echo 'selected="selected"' ?>>Active</option>
					<option value="Layoff" <?php if($res['status'] == "Layoff") echo 'selected="selected"' ?>>Layoff</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Employment Status</label><b><span class="color-text" id="emp_stat_edit_error"></span></b>
			<div class="col-sm-9">
				<select id="emp_stat_edit" class="form-control populate">
					<option value=""></option>
					<option value="Regular" <?php if($res['employment_status'] == "Regular") echo 'selected="selected"' ?>>Regular</option>
					<option value="Probationary" <?php if($res['employment_status'] == "Probationary") echo 'selected="selected"' ?>>Probationary</option>
					<option value="Casual" <?php if($res['employment_status'] == "Casual") echo 'selected="selected"' ?>>Casual</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Is Assigned</label><b><span class="color-text" id="mp_isassigned_edit_error"></span></b>
			<div class="col-sm-9">
				<select data-plugin-selectTwo id="mp_isassigned_edit" class="form-control populate">
					<option></option>
					<option value="1" <?php if($res['is_assigned'] == "1") echo 'selected="selected"' ?>>Yes</option>
					<option value="0" <?php if($res['is_assigned'] == "0") echo 'selected="selected"' ?>>No</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Job Status</label><b><span class="color-text" id="mp_jobstat_edit_error"></span></b>
			<div class="col-sm-9">
				<select id="mp_jobstat_edit" class="form-control populate">
					<option value=""></option>
					<option value="Dispatched" <?php if($res['job_stat'] == "Dispatched") echo 'selected="selected"' ?>>Dispatched</option>
					<option value="Relieved" <?php if($res['job_stat'] == "Relieved") echo 'selected="selected"' ?>>Relieved</option>
					<option value="Rejected" <?php if($res['job_stat'] == "Rejected") echo 'selected="selected"' ?>>Rejected</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Current Job Request</label><b><span class="color-text" id="mp_reques_no_edit_error"></span></b>
			<div class="col-sm-9">
				<input type="text" name="name" id="mp_reques_no_edit" class="form-control" value="<?= $res['request_no'] ?>" required/>
			</div>
		</div>
		<div class="form-group" align="center">
			<div class="col-sm-12">
				<button type="button" class="btn btn-info btn-sm" id="update_emp">UPDATE</button>
				<button type="button" class="btn btn-info btn-sm" onclick="location.href='?page=employee_list'">FINISH</button>
			</div>
		</div>
	</div>
</section>
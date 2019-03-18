<?php 
if (isset($_GET['page']) && $_GET['id'] != null && $_GET['page'] == "edit_equipment") {
	$id = $_GET['id'];
	$edit_equipment = $controller->edit_equipment($id);
}
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
		</div>
		<h2 class="panel-title">Job Order List</h2>
	</header>
	<div class="panel-body">
		<input type="hidden" id="id_edit" value="<?= $id ?>">
		<div class="form-group">
			<label class="col-sm-3 control-label">Equipment Code</label><b><span class="color-text" id="eqpt_code_edit_error"></span></b>
			<div class="col-sm-9">
				<input type="text" name="eqpt_code" class="form-control" id="eqpt_code_edit" value="<?= $edit_equipment['eqpt_code'] ?>" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Equipment Name</label><b><span class="color-text" id="eqpt_name_edit_error"></span></b>
			<div class="col-sm-9">
				<input type="text" name="eqpt_name" class="form-control" id="eqpt_name_edit" value="<?= $edit_equipment['eqpt_name'] ?>" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Equipment Designation</label><b><span class="color-text" id="eqpt_deg_edit_error"></span></b>
			<div class="col-sm-9">
				<select data-plugin-selectTwo id="eqpt_deg_edit" class="form-control populate">
					<option></option>
					<?php foreach($manpower as $row): ?>
						<option value="<?= $row['id'] ?>" <?php if($edit_equipment['mp_id'] ==  $row['id']) echo 'selected="selected"' ?>><?= $row['mp_name'] ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Equipment Type</label><b><span class="color-text" id="eqpt_name_edit_error"></span></b>
			<div class="col-sm-9">
				<select data-plugin-selectTwo id="eqpt_type_edit" class="form-control populate">
					<option></option>
					<?php foreach($equipment_type as $row): ?>
						<option value="<?= $row['id'] ?>" <?php if($edit_equipment['eqpt_type'] ==  $row['id']) echo 'selected="selected"' ?>><?= $row['eqpt_type'] ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Status</label><b><span class="color-text" id="status_edit_error"></span></b>
			<div class="col-sm-9">
				<select data-plugin-selectTwo id="status_edit" class="form-control populate">
					<option></option>
					<option value="Active" <?php if($edit_equipment['status'] ==  "Active") echo 'selected="selected"' ?>>Active</option>
					<option value="Inactive" <?php if($edit_equipment['status'] ==  "Inactive") echo 'selected="selected"' ?>>Inactive</option>
					<option value="Working" <?php if($edit_equipment['status'] ==  "Working") echo 'selected="selected"' ?>>Working</option>
					<option value="Stopped" <?php if($edit_equipment['status'] ==  "Stopped") echo 'selected="selected"' ?>>Stopped</option>
					<option value="Dispatched" <?php if($edit_equipment['status'] ==  "Dispatched") echo 'selected="selected"' ?>>Dispatched</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Reason</label><b><span class="color-text" id="reason_error"></span></b>
			<div class="col-sm-9">
				<input type="text" name="eqpt_name" class="form-control" id="reason" value="<?= $edit_equipment['reason'] ?>" required/>
			</div>
		</div>
		<div class="form-group" align="center">
			<button type="button" class="btn btn-info btn-sm" id="update_eqpt">Update</button>
			<button type="button" class="btn btn-info btn-sm" onclick="location.href='?page=equipment'">Finish</button>
		</div>
	</div>
</section>
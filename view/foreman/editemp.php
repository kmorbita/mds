<?php 
if (isset($_GET['page']) && isset($_GET['emp_id']) != null) {
	$id = $_GET['emp_id'];
	$res = $controller->edit_emp($id);
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
		<input type="hidden" id="mp_id_edit" value="<?= $id ?>">
		<div class="form-group">
			<label class="col-sm-3 control-label">Job Status</label><b><span class="color-text" id="mp_jobstat_edit_error"></span></b>
			<div class="col-sm-9">
				<input type="text" class="form-control" value="<?= $res['fname'].' '.$res['mname'].' '.$res['lname'] ?>" readonly>
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
		<div class="form-group" align="center">
			<div class="col-sm-12">
				<button type="button" class="btn btn-info btn-sm" id="update_emp">UPDATE</button>
				<button type="button" class="btn btn-info btn-sm" onclick="location.href='?page=employee_list'">FINISH</button>
			</div>
		</div>
	</div>
</section>
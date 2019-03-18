<?php 
if (isset($_GET['page']) && isset($_GET['attendance_id']) != null && $_GET['page'] == "editattendance") {
	$id = $_GET['attendance_id'];
	$res = $controller->edit_attendance($id);
}
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
		</div>
		<h2 class="panel-title">Edit Attendance</h2>
	</header>
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label">Attendance Date</label><b><span class="color-text" id="attendance_date_error"></span></b>
			<div class="col-sm-9">
				<input type="hidden" id="attendance_id" value="<?= $id ?>">
				<input type="date" name="name" id="attendance_date" class="form-control" value="<?= $res['attendance_date'] ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Attendance Type</label><b><span class="color-text" id="attendance_type_error"></span></b>
			<div class="col-sm-9">
				<select data-plugin-selectTwo id="attendance_type" class="form-control populate">
					<option></option>
					<option></option>
					<?php foreach($attendance_type as $row): ?>
						<option value="<?= $row['id'] ?>" <?php if($res['attendance_type'] == $row['id']) echo 'selected="selected"' ?>><?= $row['type'] ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group" align="center">
			<div class="col-sm-12">
				<button type="button" class="btn btn-info btn-sm" id="update_attendance">UPDATE</button>
				<button type="button" class="btn btn-info btn-sm" onclick="location.href='?page=attendance'">FINISH</button>
			</div>
		</div>
	</div>
</section>
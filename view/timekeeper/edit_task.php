<?php 
if (isset($_GET['page']) && isset($_GET['task_id']) != null && $_GET['page'] == "edittask") {
	$id = $_GET['task_id'];
	$req = $_GET['req'];
	$res = $controller->edit_task($id);
}
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
		</div>
		<h2 class="panel-title">Edit Task</h2>
	</header>
	<div class="panel-body">
		<input type="hidden" id="username" value="<?= $_SESSION['username'] ?>">
		<div class="form-group">
			<label class="col-sm-3 control-label">Task</label><b><span class="color-text" id="task_error"></span></b>
			<div class="col-sm-9">
				<input type="hidden" id="task_id" value="<?= $id ?>">
				<input type="text" name="name" id="task" class="form-control" value="<?= $res['task'] ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label">Task For</label><b><span class="color-text" id="task_for_error"></span></b>
			<div class="col-sm-9">
				<select data-plugin-selectTwo id="task_for" class="form-control populate">
					<option></option>
					<option value="Personnel" <?php if($res['task_for'] == "Personnel") echo 'selected="selected"' ?>>Personnel</option>
					<option value="Equipment" <?php if($res['task_for'] == "Equipment") echo 'selected="selected"' ?>>Equipment</option>
				</select>
			</div>
		</div>
		<div class="form-group" align="center">
			<div class="col-sm-12">
				<button type="button" class="btn btn-info btn-sm" id="update_task">UPDATE</button>
				<button type="button" class="btn btn-info btn-sm" onclick="location.href='?page=task&req_no=<?= $req ?>'">FINISH</button>
			</div>
		</div>
	</div>
</section>
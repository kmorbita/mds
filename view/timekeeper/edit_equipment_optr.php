<?php 
if (isset($_GET['page']) && $_GET['page'] == "edit_equipment_optr" && $_GET['id'] != null) {
	$id = $_GET['id'];
	$edit_user = $controller->edit_eo($id);
}
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">Equipment Operators</h2>
	</header>
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-3 control-label">Equipment</label><b><span class="color-text" id="eqpt_edit_error"></span></b>
			<div class="col-sm-9">
				<input type="hidden" id="id_edit_eo" value="<?= $edit_user['id'] ?>">
				<select data-plugin-selectTwo class="form-control input populate" id="edit_eqpt_id">
					<option></option>
					<?php foreach($equipment as $row): ?>
						<option value="<?= $row['id'] ?>" <?php if($edit_user['eqpt_id'] ==  $row['id']) echo 'selected="selected"' ?> ><?= $row['eqpt_name'] ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Operator</label><b><span class="color-text" id="optr_edit_error"></span></b>
			<div class="col-sm-9">
				<select data-plugin-selectTwo class="form-control input populate" id="edit_optr_id">
					<option></option>
					<?php foreach($operator as $row): ?>
						<option value="<?= $row['optr_id'] ?>" <?php if($edit_user['optr_id'] ==  $row['optr_id']) echo 'selected="selected"' ?> ><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group" align="center">
			<button type="button" class="btn btn-info btn-sm" id="update_eo">Update</button>
			<a href="?page=equipment_optr"><button type="button" class="btn btn-info btn-sm">Finish</button></a>
		</div>
		
	</div>
</section>
<?php 
if (isset($_GET['page']) && $_GET['id'] != null) {
	$id = $_GET['id'];
	$edit_user = $controller->edit_user($id);
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
		
		<div class="form-group">
			<label class="col-sm-3 control-label">User ID</label><b><span class="color-text" id="user_error"></span></b>
			<div class="col-sm-9">
				<input type="text" name="ufname" class="form-control" id="uID" value="<?= $edit_user['user_id'] ?>" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Firstname</label><b><span class="color-text" id="fname_error"></span></b>
			<div class="col-sm-9">
				<input type="text" name="ufname" class="form-control" id="ufname" value="<?= $edit_user['ufname'] ?>" required/>
				<input type="hidden" id="user_id" value="<?= $id ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Middlename</label><b><span class="color-text" id="mname_error"></span></b>
			<div class="col-sm-9">
				<input type="text" name="umname" class="form-control" id="umname" value="<?= $edit_user['umname'] ?>" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Lastname</label><b><span class="color-text" id="lname_error"></span></b>
			<div class="col-sm-9">
				<input type="text" name="ulname" class="form-control" id="ulname" value="<?= $edit_user['ulname'] ?>" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Username</label><b><span class="color-text" id="user_error"></span></b>
			<div class="col-sm-9">
				<input type="text" name="username" class="form-control" id="usernames" value="<?= $edit_user['username'] ?>" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Password</label><b><span class="color-text" id="pass_error"></span></b>
			<div class="col-sm-9">
				<input type="password" name="pass" class="form-control" id="pass" value="<?= $edit_user['original_pass'] ?>" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Re-type Password</label><b><span class="color-text" id="rtype_error"></span></b>
			<div class="col-sm-9">
				<input type="password" name="r_type" class="form-control" id="r_type" value="<?= $edit_user['original_pass'] ?>" required/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Role</label><b><span class="color-text" id="role_error"></span></b>
			<div class="col-sm-9">
				<select data-plugin-selectTwo name="role" class="form-control populate" id="role">
					<option></option>
					<?php foreach($role as $row): ?>
						<option value="<?= $row['id'] ?>" <?php if($edit_user['role'] ==  $row['id']) echo 'selected="selected"' ?>><?= $row['role'] ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Acount Status</label><b><span class="color-text" id="mp_stat_edit_error"></span></b>
			<div class="col-sm-9">
				<select data-plugin-selectTwo id="acc_stat" class="form-control populate">
					<option></option>
					<option value="Active" <?php if($edit_user['account_stat'] == "Active") echo 'selected="selected"' ?>>Active</option>
					<option value="Inactive" <?php if($edit_user['account_stat'] == "Inactive") echo 'selected="selected"' ?>>Inactive</option>
				</select>
			</div>
		</div>
		<div class="form-group" align="center">
			<button type="button" class="btn btn-info btn-sm" id="user_update">Update</button>
			<button type="button" class="btn btn-info btn-sm" onclick="location.href='?page=users'">Finish</button>
		</div>
	</div>
</section>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
		</div>		
		<h2 class="panel-title">Change Password</h2>
	</header>
	<div class="panel-body">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="form-group">
				<div class="col-md-4">
					<label>Current Password</label><b><span class="color-text" id="curr_password_error"></span></b>
				</div>
				<div class="col-md-7">
					<input type="password" id="curr_password" class="form-control input">
					<input type="hidden" id="user_id" value="<?= $_SESSION['id'] ?>">
				</div>
				<div class="col-md-1">
					<button type="button" onclick="pass_but()" class="btn btn-default btn-xs fa fa-eye"></button>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label>New Password</label><b><span class="color-text" id="new_password_error"></span></b>
				</div>
				<div class="col-md-7">
					<input type="password" id="new_password" class="form-control input">
				</div>
				<div class="col-md-1">
					<button type="button" onclick="newpass_but()" class="btn btn-default btn-xs fa fa-eye"></button>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label>Re-type New Password</label><b><span class="color-text" id="renew_password_error"></span></b>
				</div>
				<div class="col-md-7">
					<input type="password" id="renew_password" class="form-control input">
				</div>
				<div class="col-md-1">
					<button type="button" onclick="repass_but()" class="btn btn-default btn-xs fa fa-eye"></button>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12" align="center">
					<button class="btn btn-default btn-sm" id="changepass">Change</button>
				</div>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
</section>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalFull">New</button>
			<a href="#" class="fa fa-caret-down"></a>
		</div>
		<h2 class="panel-title">Manpower</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped mb-none" id="datatable-default">
			<thead>
				<tr>
					<th>No#</th>
					<th>User ID</th>
					<th>Name</th>
					<th>Username</th>
					<th>Role</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1;
				foreach ($users as $row):?>
					<tr class="user_<?= $row['id']?>">
						<td><?= $i ?></td>
						<td><?= $row['user_id'] ?></td>
						<td><?= $row['ufname']." ".$row['umname']." ".$row['ulname'] ?></td>
						<td><?= $row['username'] ?></td>
						<td><?= $row['role'] ?></td>
						<td><?= $row['account_stat'] ?></td>
						<td><a href="?page=edituser&id=<?= $row['id'] ?>"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></button></a>|<button type="button" class="btn btn-default btn-sm" onclick="return confirm('Are you sure?')?del_user('<?= $row['id'] ?>'):'';"><i class="fa fa-trash-o"></i></button></td>
					</tr>
					<?php $i++; 
				endforeach ?>
			</tbody>
		</table>
		<div class="modal fade" id="modalFull" role="dialog">
			<div class="modal-dialog">
				
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">New User</h4>
					</div>
					<div class="modal-body">
						<!-- <form> -->
							<div class="form-group">
								<label class="col-sm-3 control-label">User ID</label><b><span class="color-text" id="user_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_name" class="form-control" id="uID" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Firstname</label><b><span class="color-text" id="fname_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_name" class="form-control" id="ufname" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Middlename</label><b><span class="color-text" id="mname_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_code" class="form-control" id="umname" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Lastname</label><b><span class="color-text" id="lname_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_code" class="form-control" id="ulname" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Username</label><b><span class="color-text" id="user_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_code" class="form-control" id="usernames" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Password</label><b><span class="color-text" id="pass_error"></span></b>
								<div class="col-sm-9">
									<input type="password" name="mp_code" class="form-control" id="pass" value="password" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Re-type Password</label><b><span class="color-text" id="rtype_error"></span></b>
								<div class="col-sm-9">
									<input type="password" name="mp_code" class="form-control" id="r_type" value="password" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Role</label><b><span class="color-text" id="role_error"></span></b>
								<div class="col-sm-9">
									<select data-plugin-selectTwo class="form-control populate" id="role">
										<option></option>
										<?php foreach($role as $row): ?>
											<option value="<?= $row['id'] ?>"><?= $row['role'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info btn-sm" id="submit_user">Save</button>
								<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>
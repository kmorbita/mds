
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<!-- <form>
				<input type="file" name="excel">
				<button type="submit" class="btn btn-xs -btn-default" name="submit">Upload</button>	
			</form> -->
			<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalFull">New</button>
			<a href="#" class="fa fa-caret-down"></a>
		</div>
		
		<h2 class="panel-title">Employee List</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped mb-none" id="datatable-default">									
			<thead>
				<tr>
					<th>No#</th>
					<th>Employee ID</th>
					<th>Name</th>
					<th>Designation</th>
					<th>Status</th>
					<th>Employment Status</th>
					<th>Is Assigned</th>
					<th>Request No#</th>
					<th>Is Present</th>
					<th>Reject/Relieve</th>
					<th>Date Created</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1;
				$pre='';
				foreach($employees as $row): 
					if ($row['is_assigned'] == '1') {
						$row['is_assigned'] = "Yes";
					}else{
						$row['is_assigned'] = "No";
					}
					if ($row['is_present'] == '1') {
						$pre = "Yes";
					}else{
						$pre = "No";
					}
					?>
					<tr class="gradeX emp_<?= $row['emp_id']?>">
						<td><?= $i  ?></td>
						<td><?= $row['emp_id'] ?></td>
						<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
						<td><?= $row['manpower'] ?></td>
						<td><?= $row['status'] ?></td>
						<td><?= $row['employment_status'] ?></td>
						<td><?= $row['is_assigned'] ?></td>
						<td><?= $row['request_no'] ?></td>
						<td><?= $pre ?></td>
						<?php 
						if ($row['is_assigned'] == '1' || $row['request_no'] != '' || $row['job_stat'] == 'Dispatched') {
							?>
							<td><button type="button" class="btn btn-default btn-xs" title="Relieved" onclick="relieve('<?= $row['emp_id'] ?>','<?= $row['request_no'] ?>')">Relive</button>|<button type="button" class="btn btn-default btn-xs" title="Reject" onclick="reject('<?= $row['emp_id'] ?>','<?= $row['request_no'] ?>')">Reject</button></td>
							<?php
						}else{
							echo "<td></td>";
						}
						?>
						<td><?= $row['created_at'] ?></td>
						<?php 
						if ($row['is_present'] == "0") {
							?>
							<td><a href="?page=editemp&emp_id=<?= $row['emp_id'] ?>"><button type="button" class="btn btn-default btn-sm fa fa-pencil"></button></a>|<button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?del_emp('<?= $row['emp_id'] ?>'):'';"></button>
							<?php
						}else{
							?>
							<td><a href="?page=editemp&emp_id=<?= $row['emp_id'] ?>"><button type="button" class="btn btn-default btn-sm fa fa-pencil"></button></a>|<button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?del_emp('<?= $row['emp_id'] ?>'):'';"></button>
								<?php 
								if ($row['is_assigned'] == 'No') {
									?>
									<?php
								}
								?>
							</td>	
							<?php
						}
						?>
					</tr>
					<?php
					$i++; 
				endforeach ?>
			</tbody>
		</table>
		<div class="modal fade" id="modalFull" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">New Employee</h4>
					</div>
					<div class="modal-body">
						<!-- <form> -->
							<div class="form-group">
								<label class="col-sm-3 control-label">Employee ID</label><b><span class="color-text" id="mp_id_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="name" id="mp_id" class="form-control" placeholder="Type Employee Identification..." required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Firstname</label><b><span class="color-text" id="mp_fname_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="name" id="mp_fname" class="form-control" placeholder="Type Firstname..." required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Middlename</label><b><span class="color-text" id="mp_mname_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="name" id="mp_mname" class="form-control" placeholder="Type Middlename..." required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Lastname</label><b><span class="color-text" id="mp_lname_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="name" id="mp_lname" class="form-control" placeholder="Type Lastname..." required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Manpower Code</label><b><span class="color-text" id="mp_code_error"></span></b>
								<div class="col-sm-9">
									<select data-plugin-selectTwo id="mp_code" class="form-control populate">
										<option></option>
										<?php foreach($manpower as $row): ?>
											<option value="<?= $row['id'] ?>"><?= $row['mp_name'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Status</label><b><span class="color-text" id="mp_stat_error"></span></b>
								<div class="col-sm-9">
									<select data-plugin-selectTwo id="mp_stat" class="form-control populate">
										<option></option>
										<option value="Active">Active</option>
										<option value="Layoff">Layoff</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Employment Status</label><b><span class="color-text" id="emp_stat_error"></span></b>
								<div class="col-sm-9">
									<select data-plugin-selectTwo id="emp_stat" class="form-control populate">
										<option></option>
										<option value="Regular">Regular</option>
										<option value="Probationary">Probationary</option>
										<option value="Casual">Casual</option>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info btn-sm" id="submit_tk">Save</button>
								<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="modal fade" id="modalFulledit" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">New Employee</h4>
						</div>
						<div class="modal-body">
							<!-- <form> -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Employee ID</label><b><span class="color-text" id="mp_id_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="name" id="mp_id_edit" class="form-control" placeholder="Type Employee Identification..." required/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Firstname</label><b><span class="color-text" id="mp_fname_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="name" id="mp_fname_edit" class="form-control" placeholder="Type Firstname..." required/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Middlename</label><b><span class="color-text" id="mp_mname_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="name" id="mp_mname_edit" class="form-control" placeholder="Type Middlename..." required/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Lastname</label><b><span class="color-text" id="mp_lname_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="name" id="mp_lname_edit" class="form-control" placeholder="Type Lastname..." required/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Manpower Code</label><b><span class="color-text" id="mp_code_edit_error"></span></b>
									<div class="col-sm-9">
										<select data-plugin-selectTwo id="mp_code_edit" class="form-control populate">
											<option></option>
											<?php foreach($manpower as $row): ?>
												<option value="<?= $row['id'] ?>"><?= $row['mp_name'] ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Status</label><b><span class="color-text" id="mp_stat_edit_error"></span></b>
									<div class="col-sm-9">
										<select data-plugin-selectTwo id="mp_stat_edit" class="form-control populate">
											<option></option>
											<option value="Active">Active</option>
											<option value="Layoff">Layoff</option>
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-info btn-sm" id="submit_tk">Save</button>
									<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>
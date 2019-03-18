<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<button type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#modalFull">New</button>
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">Equipments</h2>
	</header>
	<div class="panel-body">
		<!-- <a class="mb-xs mt-xs mr-xs modal-sizes btn btn-default" href="#modalFull"> -->
			<!-- </a> -->
			<table class="table table-bordered table-striped mb-none" id="datatable-default">									<thead>
				<tr>
					<th>No#</th>
					<th>Equipment Code</th>
					<th>Equipment Name</th>
					<th>Equipment Type</th>
					<th>Designation</th>
					<th>Status</th>
					<th>Reason</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				foreach($equipment2 as $row): 
					?>
					<tr class="gradeX eqpt_<?= $row['id']?>">
						<td><?= $i ?></td>
						<td><?= $row['eqpt_code'] ?></td>
						<td><?= $row['eqpt_name'] ?></td>
						<td><?= $row['eqpt_type'] ?></td>
						<td><?= $row['mp_name'] ?></td>
						<td><?= $row['status'] ?></td>
						<td><?= $row['reason'] ?></td>
						<td><a href="?page=edit_equipment&id=<?= $row['id'] ?>"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></button></a>|<button type="button" class="btn btn-default btn-sm" onclick="return confirm('Are you sure?')?del_eqpt2('<?= $row['id'] ?>'):'';"><i class="fa fa-trash-o"></i></button></td>
					</tr>

					
					<?php
					$i++;
				endforeach ?>
			</tbody>
		</table>
		<!-- new equipment -->
		<div class="modal fade" id="modalFull" role="dialog">
			<div class="modal-dialog">
				
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">New Equipment</h4>
					</div>
					<div class="modal-body">
						<!-- <form> -->
							<div class="form-group">
								<label class="col-sm-3 control-label">Equipment Code</label><b><span class="color-text" id="eqpt_code_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="eqpt_code" class="form-control" id="eqpt_code" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Equipment Name</label><b><span class="color-text" id="eqpt_name_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="eqpt_name" class="form-control" id="eqpt_name" required/>
								</div>
							</div>
<!-- 							<div class="form-group">
								<label class="col-sm-3 control-label">Equipment Type</label><b><span class="color-text" id="eqpt_name_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="eqpt_type" class="form-control" id="eqpt_type" required/>
								</div>
							</div> -->
							<div class="form-group">
								<label class="col-sm-3 control-label">Equipment Designation</label><b><span class="color-text" id="eqpt_deg_error"></span></b>
								<div class="col-sm-9">
									<select data-plugin-selectTwo id="eqpt_deg" class="form-control populate">
										<option></option>
										<?php foreach($manpower as $row): ?>
											<option value="<?= $row['id'] ?>"><?= $row['mp_name'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Equipment Type</label><b><span class="color-text" id="eqpt_type_error"></span></b>
								<div class="col-sm-9">
									<select data-plugin-selectTwo id="eqpt_type" class="form-control populate">
										<option></option>
										<?php foreach($equipment_type as $row): ?>
											<option value="<?= $row['id'] ?>"><?= $row['eqpt_type'] ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Status</label><b><span class="color-text" id="status_error"></span></b>
								<div class="col-sm-9">
									<select data-plugin-selectTwo id="status" class="form-control populate">
										<option></option>
										<option value="Active">Active</option>
										<option value="Inactive">Inactive</option>
										<option value="Working">Working</option>
										<option value="Stopped">Stopped</option>
										<option value="Dispatched">Dispatched</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Reason</label><b><span class="color-text" id="reason_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="eqpt_name" class="form-control" id="reason" required/>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info btn-sm" id="submit_eqpt">Save</button>
								<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<!-- edit equipment -->
			<div class="modal fade" id="modalFulledit" role="dialog">
				<div class="modal-dialog">
					
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Edit Equipment</h4>
						</div>
						<div class="modal-body">
							<!-- <form> -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Equipment Code</label><b><span class="color-text" id="eqpt_code_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="eqpt_code" class="form-control" id="eqpt_code_edit" value="sdsd" required/>
										<input type="hidden" id="id_edit">
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Equipment Name</label><b><span class="color-text" id="eqpt_name_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="eqpt_name" class="form-control" id="eqpt_name_edit" value="sdsd" required/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Equipment Type</label><b><span class="color-text" id="eqpt_name_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="eqpt_name" class="form-control" id="eqpt_type_edit" value="sdsd" required/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Status</label><b><span class="color-text" id="status_edit_error"></span></b>
									<div class="col-sm-9">
										<select data-plugin-selectTwo id="status_edit" class="form-control populate">
											<option></option>
											<option value="Active">Active</option>
											<option value="Inactive">Inactive</option>
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-info btn-sm" id="update_eqpt">Update</button>
									<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
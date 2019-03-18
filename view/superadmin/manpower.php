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
					<th>ID</th>
					<th>Manpower</th>
					<th>Manpower Code</th>
					<th>Manpower Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1;
				foreach ($manpower as $row):?>
					<tr class="mp_<?= $row['id']?>">
						<td><?= $i ?></td>
						<td><?= $row['id'] ?></td>
						<td><?= $row['mp_name'] ?></td>
						<td><?= $row['code'] ?></td>
						<td><?= $row['mp_code'] ?></td>
						<td><button type="button" class="btn btn-default btn-sm" onclick="edit_mp('<?= $row['id'] ?>')"><i class="fa fa-pencil"></i></button>|<button type="button" class="btn btn-default btn-sm" onclick="return confirm('Are you sure?')?del_mp('<?= $row['id'] ?>'):'';"><i class="fa fa-trash-o"></i></button></td>
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
						<h4 class="modal-title">New Manpower</h4>
					</div>
					<div class="modal-body">
						<!-- <form> -->
							<div class="form-group">
								<label class="col-sm-3 control-label">Manpower</label><b><span class="color-text" id="mp_name_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_name" class="form-control" id="mp_name" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Manpower Code</label><b><span class="color-text" id="mp_code_error2"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_code" class="form-control" id="mp_code2" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Manpower Type</label><b><span class="color-text" id="mp_code_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_code" class="form-control" id="mp_code" required/>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info btn-sm" id="submit_mp">Save</button>
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
							<h4 class="modal-title">Edit Manpower</h4>
						</div>
						<div class="modal-body">
							<!-- <form> -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Manpower</label><b><span class="color-text" id="mp_name_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="mp_name" class="form-control" id="mp_name_edit" required/>
										<input type="hidden" name="id_edit" class="form-control" id="id_edit" required/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Manpower Code</label><b><span class="color-text" id="mp_code_edit_error2"></span></b>
									<div class="col-sm-9">
										<input type="text" name="mp_code" class="form-control" id="mp_code_edit2" required/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Manpower Type</label><b><span class="color-text" id="mp_code_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="mp_code" class="form-control" id="mp_code_edit" required/>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-info btn-sm" id="edit_mp">Update</button>
									<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
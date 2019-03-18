<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<button type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#modalFull">New</button>
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">Operator</h2>
	</header>
	<div class="panel-body">
		<!-- <a class="mb-xs mt-xs mr-xs modal-sizes btn btn-default" href="#modalFull"> -->
			<!-- </a> -->
			<table class="table table-bordered table-striped mb-none" id="datatable-default">									<thead>
				<tr>
					<th>No#</th>
					<th>Operator ID</th>
					<th>Operator Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				foreach($operator as $row): 
					?>
					<tr class="gradeX optr_<?= $row['id'] ?>">
						<td><?= $i ?></td>
						<td><?= $row['optr_id'] ?></td>
						<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
						<td><button type="button" class="btn btn-info btn-sm" onclick="edit_optr('<?= $row['id'] ?>')"><i class="fa fa-pencil"></i></button>|<button type="button" class="btn btn-danger btn-sm" onclick="del_optr('<?= $row['id'] ?>')"><i class="fa fa-trash-o"></i></button></td>
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
						<h4 class="modal-title">New Operator</h4>
					</div>
					<div class="modal-body">
						<!-- <form> -->
							<div class="form-group">
								<label class="col-sm-3 control-label">Operator ID</label><b><span class="color-text" id="optr_id_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_name" class="form-control" id="optr_id" value="sdsd" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Firstname</label><b><span class="color-text" id="optr_fname_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_code" class="form-control" id="optr_fname" value="sdsd" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Middlename</label><b><span class="color-text" id="optr_mname_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_code" class="form-control" id="optr_mname" value="sdsd" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Lastname</label><b><span class="color-text" id="optr_lname_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_code" class="form-control" id="optr_lname" value="sdsd" required/>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info btn-sm" id="submit_optr">Save</button>
								<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="modal fade" id="optr_edit" role="dialog">
				<div class="modal-dialog">
					
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Edit Operator</h4>
						</div>
						<div class="modal-body">
							<!-- <form> -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Operator ID</label><b><span class="color-text" id="optr_id_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="mp_name" class="form-control" id="optr_id_edit" value="sdsd" required/>

									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Firstname</label><b><span class="color-text" id="optr_fname_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="mp_code" class="form-control" id="optr_fname_edit" value="sdsd" required/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Middlename</label><b><span class="color-text" id="optr_mname_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="mp_code" class="form-control" id="optr_mname_edit" value="sdsd" required/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Lastname</label><b><span class="color-text" id="optr_lname_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="mp_code" class="form-control" id="optr_lname_edit" value="sdsd" required/>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-info btn-sm" id="update_optr">Save</button>
									<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
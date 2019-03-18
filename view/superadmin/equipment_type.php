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
					<th>Equipment Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				foreach($equipment_type as $row): 
					?>
					<tr class="gradeX type_<?= $row['id']?>">
						<td><?= $i ?></td>
						<td><?= $row['eqpt_type'] ?></td>
						<td><button type="button" class="btn btn-default btn-sm" onclick="edit_type('<?= $row['id']?>')"><i class="fa fa-pencil"></i></button>|<button type="button" class="btn btn-default btn-sm" onclick="return confirm('Are you sure?')?del_type('<?= $row['id'] ?>'):'';"><i class="fa fa-trash-o"></i></button></td>
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
						<h4 class="modal-title">New Equipment Type</h4>
					</div>
					<div class="modal-body">
						<!-- <form> -->
							<div class="form-group">
								<label class="col-sm-3 control-label">Equipment Type</label><b><span class="color-text" id="eqpt_type_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="eqpt_type" class="form-control" id="eqpt_type" required/>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info btn-sm" id="submit_eqpt_type">Save</button>
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
							<h4 class="modal-title">Edit Equipment Type</h4>
						</div>
						<div class="modal-body">
							<!-- <form> -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Equipment Type</label><b><span class="color-text" id="eqpt_type_edit_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="eqpt_type" class="form-control" id="eqpt_type_edit" value="sdsd" required/>
										<input type="hidden" id="id_edit">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-info btn-sm" id="update_eqpt_type">Update</button>
									<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#add_weight">New</button>
			<a href="#" class="fa fa-caret-down"></a>
		</div>
		<h2 class="panel-title">Weight Per Box</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped mb-none" id="datatable-default">
			<thead>
				<tr>
					<th>No#</th>
					<th>Weight Per Box</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1;
				foreach ($weight_per_box as $row):?>
					<tr class="weight_<?= $row['id']?>">
						<td><?= $i ?></td>
						<td><?= $row['weight'] ?></td>
						<td><button type="button" class="btn btn-default btn-sm" onclick="edit_weight('<?= $row['id']?>')"><i class="fa fa-pencil"></i></button>|<button type="button" class="btn btn-default btn-sm" onclick="return confirm('Are you sure?')?del_weight('<?= $row['id'] ?>'):'';"><i class="fa fa-trash-o"></i></button></td>
					</tr>
					<?php $i++; 
				endforeach ?>
			</tbody>
		</table>
		<div class="modal fade" id="edit_weight" role="dialog">
			<div class="modal-dialog">
				
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Weight of box</h4>
					</div>
					<div class="modal-body">
						<!-- <form> -->
							<input type="hidden" id="weight_id">
							<div class="form-group">
								<label class="col-sm-3 control-label">Weight</label><b><span class="color-text" id="box_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_name" class="form-control" id="weight" required/>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info btn-sm" id="update_weight">Save</button>
								<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="close_box">Close</button>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="modal fade" id="add_weight" role="dialog">
			<div class="modal-dialog">
				
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Add New Box Weight</h4>
					</div>
					<div class="modal-body">
						<!-- <form> -->
							<!-- <input type="hidden" id="box_id"> -->
							<div class="form-group">
								<label class="col-sm-3 control-label">Weight</label><b><span class="color-text" id="box_error"></span></b>
								<div class="col-sm-9">
									<input type="text" name="mp_name" class="form-control" id="new_weight" required/>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info btn-sm" id="submit_weight">Save</button>
								<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="close_box">Close</button>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>
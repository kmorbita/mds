<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<button type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#modalFull">New</button>
			<a href="#" class="fa fa-caret-down"></a>
		</div>
		
		<h2 class="panel-title">Equipment Operators</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped mb-none" id="datatable-default">									<thead>
			<tr>
				<th>No#</th>
				<th>Equipment Code</th>
				<th>Equipment Name</th>
				<th>Operator Name</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i=1;
			foreach($eqpt_optr as $row): 
				?>
				<tr class="gradeX eo_<?= $row['id'] ?>">
					<td><?= $i ?></td>
					<td><?= $row['eqpt_code'] ?></td>
					<td><?= $row['eqpt_name'] ?></td>
					<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
					<td><a href="?page=edit_equipment_optr&id=<?= $row['id'] ?>"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></button></a>|<button type="button" class="btn btn-danger btn-sm" onclick="del_eo('<?= $row['id'] ?>')"><i class="fa fa-trash-o"></i></button></td>
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
					<h4 class="modal-title">New Equipment Operator</h4>
				</div>
				<div class="modal-body">
					<!-- <form> -->
						<div class="form-group">
							<label class="col-sm-3 control-label">Equipment</label><b><span class="color-text" id="eqpt_error"></span></b>
							<div class="col-sm-9">
								<select data-plugin-selectTwo class="form-control input populate" id="eqpt_id">
									<option></option>
									<?php foreach($equipment as $row): ?>
										<option value="<?= $row['id'] ?>"><?= $row['eqpt_name'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Operator</label><b><span class="color-text" id="optr_error"></span></b>
							<div class="col-sm-9">
								<select data-plugin-selectTwo class="form-control input populate" id="optr_id">
									<option></option>
									<?php foreach($operator as $row): ?>
										<option value="<?= $row['optr_id'] ?>"><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-info btn-sm" id="submit_eo">Save</button>
							<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
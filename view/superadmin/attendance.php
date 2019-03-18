<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalFull">New</button>
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">Attendance</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped mb-none" id="datatable-default">									
			<thead>
				<tr>
					<th>No#</th>
					<th>Date</th>
					<th>Type</th>
					<th>Is Close</th>
					<th>Time Updated</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1;
				$close = "";
				foreach ($attendance_date as $row):
					if ($row['is_close'] == "1") {
						$close = "Yes";
					}else{
						$close = "No";
					}
					?>
					<tr class="att_<?= $row['id']?>">
						<td><?= $i ?></td>
						<td><?= $row['attendance_date'] ?></td>
						<td><?= $row['type'] ?></td>
						<td><?= $close ?></td>
						<td><?= $row['updated_at'] ?></td>
						<?php 
						if ($close == "Yes") {
							?>
							<td><a href="?page=view_attendance&view_attendance_id=<?= $row['id']?>"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></button></a>|<button type="button" class="btn btn-default btn-sm" onclick="return confirm('Removing this item will delete all employees stored in this date and shift, would you like to proceed ?')?del_all_attendance('<?= $row['id'] ?>'):'';"><i class="fa fa-trash-o"></i></button>|<button type="button" class="btn btn-default btn-sm" onclick="open_attendance('<?= $row['id'] ?>')">open</button></td>
							<?php
						}else{
						 ?>
						<td><a href="?page=editattendance&attendance_id=<?= $row['id']?>"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></button></a>|<a href="?page=check_attendance&check_attendance_id=<?= $row['id']?>"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-users"></i></button></a>|<a href="?page=view_attendance&view_attendance_id=<?= $row['id']?>"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></button></a>|<button type="button" class="btn btn-default btn-sm" onclick="return confirm('Removing this item will delete all employees stored in this date and shift, would you like to proceed ?')?del_all_attendance('<?= $row['id'] ?>'):'';"><i class="fa fa-trash-o"></i></button>|<button type="button" class="btn btn-default btn-sm" onclick="close_attendance('<?= $row['id'] ?>')">close</button></td>
					<?php } ?>
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
						<button type="button" class="close" id="close_attendance2">&times;</button>
						<h4 class="modal-title">Job Order Request Details</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Attendance Date: </label>
							<input type="date" class="form-control" id="attendance_date">
						</div>
						<div class="form-group">
							<label>Attendance Type</label>
							<select data-plugin-selectTwo class="form-control populate" id="attendance_type">
								<option></option>
								<option></option>
								<?php foreach($attendance_type as $row): ?>
									<option value="<?= $row['id'] ?>"><?= $row['type'] ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" id="attendance_save">Save</button>
							<button type="button" class="btn btn-default" id="close_attendance">Close</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
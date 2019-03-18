<?php 
if (isset($_GET['page']) && isset($_GET['check_attendance_id']) != null && $_GET['page'] == "check_attendance") {
	$id = $_GET['check_attendance_id'];
	$res = $controller->get_date($id);
	$employee_attendance = $controller->employee_attendance($id);
}
if ($res['is_close'] == "1") {
	echo "<script> window.location.replace('?page=attendance')</script>";
}else{

}
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			Date: <u><?= $res['attendance_date'] ?></u>
			<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalFull">Fill Attendance</button>

			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">Check Attendance</h2>
	</header>
	<div class="panel-body">
		<input type="hidden" id="date_to_save" value="<?= $id ?>">
		<div class="col-md-12">
			<table class="table table-bordered table-striped mb-none" id="datatable-default">									
				<thead>
					<tr>
						<th>No#</th>
						<th>Employee ID</th>
						<th>Employee Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;
					foreach ($employee_attendance as $row):?>
						<tr class="del_attendance_<?= $row['emp_id']?>">
							<td><?= $i ?></td>
							<td><?= $row['emp_id'] ?></td>
							<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
							<td><button type="button" class="btn btn-default btn-sm" onclick="del_attendance('<?= $row['emp_id'] ?>')"><i class="fa fa-trash-o"></i></button></td>
						</tr>
						<?php $i++; 
					endforeach ?>
				</tbody>
			</table>
		</div>
		<div class="modal fade" id="modalFull" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" id="close_attendance2">&times;</button>
						<h4 class="modal-title">Fill Attendance</h4>
					</div>
					<div class="modal-body">
						<table class="table table-bordered table-striped mb-none" id="datatable-default2">									
							<thead>
								<tr>
									<th>No#</th>
									<th>Employee ID</th>
									<th>Employee Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($employees as $row):?>
									<tr class="emp_<?= $row['emp_id']?>">
										<td><?= $i ?></td>
										<td><?= $row['emp_id'] ?></td>
										<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
										<td class="center"><button type="button" class="btn btn-default btn-sm fa fa-check" onclick="is_available('<?= $row['emp_id'] ?>')"></button></td>
									</tr>
									<?php $i++; 
								endforeach ?>
							</tbody>
						</table>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" id="close_attendance">Close</button>
						</div>
					</div>

				</div>
			</div>
		</section>
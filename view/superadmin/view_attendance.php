<?php 
if (isset($_GET['page']) && isset($_GET['view_attendance_id']) != null && $_GET['page'] == "view_attendance") {
	$id = $_GET['view_attendance_id'];
	$res = $controller->get_date($id);
	$employee_attendance = $controller->employee_attendance($id);
}
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			Date: <u><?= $res['attendance_date'] ?></u>

			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">View Attendance</h2>
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
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;
					foreach ($employee_attendance as $row):?>
						<tr class="del_attendance_<?= $row['emp_id']?>">
							<td><?= $i ?></td>
							<td><?= $row['emp_id'] ?></td>
							<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
						</tr>
						<?php $i++; 
					endforeach ?>
				</tbody>
			</table>
		</div>
	</section>
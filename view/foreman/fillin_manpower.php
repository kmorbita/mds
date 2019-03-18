<?php 
if (isset($_GET['page']) && isset($_GET['mp_req_id']) != null && $_GET['page'] == "fillin_manpower") {
	$id = $_GET['mp_req_id'];
	$req = $_GET['req_no'];
	$res = $controller->mp_req($id);
	$arr = $res['data_mp_req'];
	$nos = $res['nos'];
}
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">Fillin Manpower</h2>
	</header>
	<div class="panel-body">
		<input type="hidden" id="nos" value="<?= $nos ?>">
		<input type="hidden" id="mp_req_no" value="<?= $req ?>">
		<table class="table table-bordered table-striped mb-none" id="datatable-default">									
			<thead>
				<tr>
					<th>No#</th>
					<th>Employee ID</th>
					<th>Employee Name</th>
					<th>Select</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1;
				$i=1;
				foreach($arr as $row): ?>
					<tr class="gradeX mpadd_<?= $row['id'] ?>">
						<td><?= $i  ?></td>
						<td><?= $row['emp_id'] ?></td>
						<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
						<td class="center"><button type="button" class="btn btn-default btn-xs fa fa-plus" onclick="add_emp('<?= $row['id'] ?>')"></button></td>
					</tr>
					<?php
					$i++; 
				endforeach ?>
			</tbody>
		</table>
	</div>
</section>
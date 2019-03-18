<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">Job Order List</h2>
	</header>
	<div class="panel-body">
		<!-- <a class="mb-xs mt-xs mr-xs modal-sizes btn btn-default" href="#modalFull"> -->
			<!-- </a> -->
			<table class="table table-bordered table-striped mb-none" id="datatable-default">									<thead>
				<tr>
					<th>No#</th>
					<th>Personnel ID</th>
					<th>Personnel</th>
					<th>Request No#</th>
					<th>Job Date</th>
					<th>Is Present</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				foreach($assigned_emp as $row): 
					if ($row['is_present'] == "1") {
						$row['is_present'] = "YES";
					}else {
						$row['is_present'] = "NO";
					}
					?>
					<tr class="gradeX ass_<?= $row['emp_id']?>">
						<td><?= $i ?></td>
						<td><?= $row['emp_id'] ?></td>
						<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
						<td><?= $row['request_no'] ?></td>
						<td><?= $row['jobdate'] ?></td>
						<td><?= $row['is_present'] ?></td>
					</tr>
					<?php
					$i++;
				endforeach ?>
			</tbody>
		</table>
		
	</div>
</section>
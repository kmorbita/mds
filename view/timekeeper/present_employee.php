<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>

		<h2 class="panel-title">Present Employee</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped mb-none" id="datatable-default">			
			<thead>
				<tr>
					<th>No#</th>
					<th>Personnel Name</th>
					<th>Designation</th>
					<th>is_present</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				foreach($employees_present as $row): 
					?>
					<tr class="gradeX">
						<?php
						$present='';
						if($row['is_present'] =="1"){
							$present = "Yes";
						}else {
							$present = "No";
						}
						?>
						<td><?= $i ?></td>
						<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
						<td><?= $row['mp_name'] ?></td>
						<td><?= $present ?></td>
						<td><?= $row['job_stat'] ?></td>
						<?php 
						if ($row['job_stat'] == "") {
							?>
							<td></td>
							<?php
						}else {
							?>
							<td><button type='button' class='btn btn-default btn-xs' onclick="clear_stat('<?= $row['emp_id'] ?>')">clear status</button></td>";
							<?php
						}
						?>
						
					</tr>
					<?php
					$i++;
				endforeach ?>
			</tbody>
		</table>
	</div>
</section>
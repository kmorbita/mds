<?php 
if (isset($_GET['page']) && $_GET['page'] = "fillin" && $_GET['id'] != null) {
	$id = $_GET['id'];
	$job_status = $controller->job_status($id);
	$eqpt_arr = $controller->job_equipment($id);
	$mp_arr = $controller->job_manpower($id);
	$manpower_given = $controller->manpower_given($id);
	$equipment_given = $controller->equipment_given($id);
}

?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<?= $id ?>
			<a href="#" class="fa fa-caret-down"></a>
		</div>
		<h2 class="panel-title">Fill in Requests</h2>
	</header>
	<div class="panel-body">
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
				</div>
				<h2 class="panel-title">Equipments</h2>
			</header>
			<div class="panel-body">
				<input type="hidden" id="req_no" value="<?= $id ?>">
				<table class="table table-bordered table-striped mb-none">									
					<thead>
						<tr>
							<th>No#</th>
							<th>Equipment Code</th>
							<th>No# of Equipment</th>
							<th>W/ Operator</th>
							<?php 
							if ($job_status == "completed" || $job_status == "closed" || $job_status == "cancelled") {
								echo "<th></th>";
							}else {
								echo "<th>Fill</th>";
							}
							?>

						</thead>
						<tbody>
							<?php 
							$i=1;
							foreach($eqpt_arr as $row): 
								if ($row['no_optr'] == "1") {
									$row['no_optr'] = "YES";
								}else{
									$row['no_optr'] = "NO";
								}
								?>
								<tr class="gradeX">
									<td><?= $i ?></td>
									<td><?= $row['eqpt_name'] ?></td>
									<td><?= $row['no_eqpt'] ?><input type="hidden" id="no_eqpt_<?= $row['eq_code'] ?>" value="<?= $row['no_eqpt'] ?>"></td>
									<td><?= $row['no_optr'] ?></td>
									<?php 
									if ($job_status == "completed" || $job_status == "closed" || $job_status == "cancelled") {
										echo "<td></td>";
									}else{
										if($row['no_optr'] == "YES"){
											?>
											<td><button class="btn btn-default btn-xs fa fa-pencil" onclick="equipment_req('<?= $row['eq_code'] ?>')"></button></td>
											<?php
										}else{
											?>
											<td></td>
											<?php
										}
									}
									?>
								</tr>
								
								<?php
								$i++;
							endforeach ?>
						</tbody>
					</table><br>
					<section class="panel">
						<header class="panel-heading">
							<div class="panel-actions">
								<a href="#" class="fa fa-caret-down"></a>
							</div>
							<h2 class="panel-title">Equipments Given</h2>
						</header>
						<div class="panel-body">
							<table class="table table-bordered table-striped mb-none">									<thead>
								<tr>
									<th>No#</th>
									<th>Personnel</th>
									<th>Equipment</th>
									<th>Job Status</th>
									<?php 
									if ($job_status == "completed" || $job_status == "closed" || $job_status == "cancelled") {
										echo "<th></th>";
									}else {
										echo "<th>Action</th>";
									}
									?>
								</thead>
								<tbody>
									<?php 
									$i=1;
									foreach($equipment_given as $row): 
										?>
										<tr class="gradeX">
											<td><?= $i ?></td>
											<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
											<td><?= $row['eqpt_name'] ?></td>
											<td><?= $row['status'] ?></td>
											<?php 
											if ($job_status == "completed" || $job_status == "closed" || $job_status == "cancelled") {
												echo "<td></td>";
											}else {
												?>
												<td><button type="button" class="btn btn-default btn-xs" title="Dispatch" onclick="eqpt_dispatch('<?= $row['emp_id'] ?>')">D</button>|<button type="button" class="btn btn-default btn-xs" title="Relieved" onclick="eqpt_relieve('<?= $row['emp_id'] ?>')">R</button>|<button type="button" class="btn btn-default btn-xs" title="Reject" onclick="eqpt_reject('<?= $row['emp_id'] ?>')">X</button></td>
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
				</div>
			</section>
			<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
						<a href="#" class="fa fa-caret-down"></a>
					</div>
					<h2 class="panel-title">Manpower</h2>
				</header>
				<div class="panel-body">

					<table class="table table-bordered table-striped mb-none">									<thead>
						<tr>
							<th>No#</th>
							<th>Manpower Code</th>
							<th>Manpower Needed</th>
							<?php 
							if ($job_status == "completed" || $job_status == "closed" || $job_status == "cancelled") {
								echo "<th></th>";
							}else {
								echo "<th>Fill</th>";
							}
							?>

						</thead>
						<tbody>
							<?php 
							$i=1;
							foreach($mp_arr as $row): 
								?>

								<tr class="gradeX">
									<td><?= $i ?></td>
									<td><?= $row['mp_name'] ?></td>
									<td><?= $row['nos'] ?></td>
									<?php 
									if ($job_status == "completed" || $job_status == "closed" || $job_status == "cancelled") {
										echo "<td></td>";
									}else {
										?>
										<td><button class="btn btn-default btn-xs fa fa-pencil" onclick="manpower_req('<?= $row['id'] ?>')"></button></td>
										<?php
									}
									?>
								</tr>
								
								<?php
								$i++;
							endforeach ?>
						</tbody>
					</table><br>
					<section class="panel">
						<header class="panel-heading">
							<div class="panel-actions">
								<a href="#" class="fa fa-caret-down"></a>
							</div>
							<div class="form-group">
								
							</div>
							<h2 class="panel-title">Manpower Given</h2>
						</header>
						<div class="panel-body">
							<table class="table table-bordered table-striped mb-none">									<thead>
								<tr>
									<th>No#</th>
									<th>Name</th>
									<th>Manpower Code</th>
									<th>Job Status</th>
									<?php 
									if ($job_status == "completed" || $job_status == "closed" || $job_status == "cancelled") {
										echo "<th></th>";
									}else {
										echo "<th>Action</th>";
									}
									?>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i=1;
								foreach($manpower_given as $row): 
									?>
									<tr class="gradeX">
										<td><?= $i ?></td>
										<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
										<td><?= $row['mp_name'] ?></td>
										<td><?= $row['status'] ?></td>
										<?php 
										if ($job_status == "completed" || $job_status == "closed" || $job_status == "cancelled") {
											echo "<th></th>";
										}else {
											?>
											<td><button type="button" class="btn btn-default btn-xs" title="Dispatch" onclick="per_dispatch('<?= $row['emp_id'] ?>')">D</button>|<button type="button" class="btn btn-default btn-xs" title="Relieved" onclick="per_relieve('<?= $row['emp_id'] ?>')">R</button>|<button type="button" class="btn btn-default btn-xs" title="Reject" onclick="per_reject('<?= $row['emp_id'] ?>')">X</button></td>
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
			</div>
		</section>
	</div>
</section>
<div class="modal fade" id="modal_mp" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Manpower Fill-in Requests</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="mp_req_no" value="<?= $id ?>">
				<table class="table table-bordered table-striped mb-none" id="append_data">		<thead>
					<tr>
						<th>No#</th>
						<th>Name</th>
						<th>Status</th>
						<th>Add</th>

					</thead>
					<tbody>
						
					</tbody>
				</table>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" id="close_mp">Close</button>
				</div>
			</div>
			
		</div>
	</div>
</div>

<div class="modal fade" id="modal_eqpt" role="dialog">
	<div class="modal-dialog">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Equipment Operator</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="eqpt_id">
				<input type="hidden" id="no_eq">
				<table class="table table-bordered table-striped mb-none" id="append_data2">		
					<thead>
						<tr>
							<th>No#</th>
							<th>Operator ID</th>
							<th>Name</th>
							<th>Assign</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="close_eqpt">Close</button>
				</div>
			</div>
			
		</div>
	</div>
</div>
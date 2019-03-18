<?php 
if (isset($_GET['page']) && $_GET['page'] = "fillin" && $_GET['id'] != null) {
	$id = $_GET['id'];
	$job_status = $controller->job_status($id);
	$eqpt_arr = $controller->job_equipment($id);
	$mp_arr = $controller->job_manpower($id);
	$manpower_given = $controller->manpower_given($id);
	$equipment_given = $controller->equipment_given($id);
	$equipment_needed_list = $controller->equipment_needed_list($id);
	$Equipment_list = $controller->job_eqpt_list($id);
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
				<div class="form-group">

				</div>
				<h2 class="panel-title">Equipment</h2>
			</header>
			<div class="panel-body">
				<div class="col-md-12">
					<header class="panel-heading">
						<div class="panel-actions">
							<!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#operator_activity">New</button> -->	
						</div>
						<h2 class="panel-title">Equipment Requested</h2>
					</header>
					<div class="panel-body">
						<table class="table table-striped" id="datatable-task-per">
							<thead>
								<tr>
									<th>Equipment Code</th>
									<th>No. of Equipment</th>
									<th>W/ Operator</th>
									<th>Fill</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$optr = ""; 
								foreach($equipment_needed_list as $row): 
									if ($row['no_optr'] == "1") {
										$optr = "YES";
									}else{
										$optr = "NO";
									}

									?>
									<tr>
										<td><?= $row['eqpt_type'] ?></td>
										<td><?= $row['no_eqpt'] ?></td>
										<td><?= $optr ?></td>
										<td><button type="button" class="btn btn-default btn-sm" onclick="fill_eqpt_needed('<?= $row['type'] ?>','<?= $row['no_eqpt'] ?>','<?= $row['no_optr'] ?>')"><i class="fa fa-pencil"></i></button></td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-bordered table-striped mb-none" id="datatable-per-task">
					<thead>
						<tr>
							<th colspan="6" class="center"	style="background-color: #DADADA">Equipment</th>
						</tr>
						<tr>
							<th>No#</th>
							<th>Equipment</th>
							<th>Status</th>
							<th>Remarks</th>
							<th>Reason</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i=1;
						$status3="";
						foreach ($Equipment_list as $val): 
							if ($val['status'] == "") {
								$status3 = "<button type='button' class='btn btn-xs btn-default'>queued</button>";
							}elseif ($val['status'] == "stopped") {
								$status3 = "<button type='button' class='btn btn-xs btn-danger'>stopped</button>";
							}elseif ($val['status'] == "paused") {
								$status3 = "<button type='button' class='btn btn-xs btn-danger'>paused</button>";
							}elseif ($val['status'] == "working") {
								$status3 = "<button type='button' class='btn btn-xs btn-warning'>working</button>";
							}elseif ($val['status'] == "started") {
								$status3 = "<button type='button' class='btn btn-xs btn-success'>started</button>";
							}elseif ($val['status'] == "resumed") {
								$status3 = "<button type='button' class='btn btn-xs btn-primary'>resumed</button>";
							}else{
								$status3 = "<button type='button' class='btn btn-xs btn-info'>completed</button>";
							}
							?>
							<tr>
								<td><?= $i ?></td>
								<td><?= $val['eqpt_name'] ?></td>
								<td><?= $status3 ?></td>
								<td><?= $val['remarks'] ?></td>
								<td><?= $val['reason'] ?></td>
								<?php 
								if($job_status != "activated"){
									if ($val['status'] == "") {
										?>
										<?php if ($val['remarks'] == "Relieved") {
											?>
											<td><button type="button" class="btn btn-default btn-xs fa fa-trash-o" onclick="return confirm('Are you sure?')?eq_delete('<?= $val['id'] ?>'):'';"></button></td>
											<?php
										}else{
											?>
											<td><button type="button" class="btn btn-default btn-xs" onclick="eq_work('<?= $val['eq_code'] ?>')"><i class="fa fa-play"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="eq_relieve('<?= $val['eq_code'] ?>')">Relieve</button></td>
											<?php
										}
										?>
										<?php
									}else if ($val['status'] == "working") {
										?>
										<?php if ($val['remarks'] == "Relieved") {
											?>
											<td><button type="button" class="btn btn-default btn-xs fa fa-trash-o" onclick="return confirm('Are you sure?')?eq_delete('<?= $val['id'] ?>'):'';"></button></td>
											<?php
										}else{
											?>
											<td><button type="button" class="btn btn-default btn-xs" onclick="eq_stop('<?= $val['eq_code'] ?>')"><i class="fa fa-stop"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="eq_complete('<?= $val['eq_code'] ?>')">complete</button>|<button type="button" class="btn btn-default btn-xs" onclick="eq_relieve('<?= $val['eq_code'] ?>')">Relieve</button></td>
											<?php
										}
										?>
										<?php
									}else if ($val['status'] == "resumed") {
										?>
										<?php if ($val['remarks'] == "Relieved") {
											?>
											<td><button type="button" class="btn btn-default btn-xs fa fa-trash-o" onclick="return confirm('Are you sure?')?eq_delete('<?= $val['id'] ?>'):'';"></button></td>
											<?php
										}else{
											?>
											<td><button type="button" class="btn btn-default btn-xs" onclick="eq_stop('<?= $val['eq_code'] ?>')"><i class="fa fa-stop"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="eq_complete('<?= $val['eq_code'] ?>')">complete</button>|<button type="button" class="btn btn-default btn-xs" onclick="eq_relieve('<?= $val['eq_code'] ?>')">Relieve</button></td>
											<?php
										}
										?>
										<?php
									}else if ($val['status'] == "stopped") {
										?>
										<?php if ($val['remarks'] == "Relieved") {
											?>
											<td><button type="button" class="btn btn-default btn-xs fa fa-trash-o" onclick="return confirm('Are you sure?')?eq_delete('<?= $val['id'] ?>'):'';"></button></td>
											<?php
										}else{
											?>
											<td><button type="button" class="btn btn-default btn-xs" onclick="eq_resume('<?= $val['eq_code'] ?>')"><i class="fa fa-play"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="eq_complete('<?= $val['eq_code'] ?>')">complete</button>|<button type="button" class="btn btn-default btn-xs" onclick="eq_relieve('<?= $val['eq_code'] ?>')">Relieve</button></td>
											<?php
										}
										?>
										<?php
									}else if ($val['status'] == "paused") {
										?>
										<td><button type="button" class="btn btn-default btn-xs" onclick="eq_resume('<?= $val['eq_code'] ?>')"><i class="fa fa-play"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="eq_complete('<?= $val['eq_code'] ?>')">complete</button>|<button type="button" class="btn btn-default btn-xs" onclick="eq_relieve('<?= $val['eq_code'] ?>')">Relieve</button></td>
										<?php
									}else{
										?>
										<td><button type="button" class="btn btn-default btn-xs" onclick="eq_relieve('<?= $val['eq_code'] ?>')">Relieve</button></td>
									<?php }
								}else{
									?>
									<?php if ($val['remarks'] == "Relieved") {
										?>
										<td><button type="button" class="btn btn-default btn-xs fa fa-trash-o" onclick="return confirm('Are you sure?')?eq_delete('<?= $val['id'] ?>'):'';"></button></td>
										<?php
									}else{
										?>
										<td><button type="button" class="btn btn-default btn-xs" onclick="eq_relieve('<?= $val['eq_code'] ?>')">Relieve</button></td>
										<?php
									}
									?>
								<?php } ?>
							</tr>
							<?php
							$i++;
						endforeach ?>
					</tbody>
				</table>
			</div>
		</section>
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
				</div>
				<h2 class="panel-title">Operators</h2>
			</header>
			<div class="panel-body">
				<input type="hidden" id="req_no" value="<?= $id ?>">
				<input type="hidden" id="job_req" value="<?= $id ?>">
				<input type="hidden" id="job_status" value="<?= $job_status ?>">
				<table class="table table-bordered table-striped mb-none" id="datatable-def1">									
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
											<td><a href="?page=fillin_operator&req=<?= $id ?>&eq_code=<?= $row['eq_code'] ?>&mp_id=<?= $row['mp_id'] ?>&no_eqpt=<?= $row['no_eqpt'] ?>" target='blank'><button class="btn btn-default btn-xs fa fa-pencil"></button></a></td>
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
							<table class="table table-bordered table-striped mb-none" id="datatable-def2">									<thead>
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
												<td><button type="button" class="btn btn-default btn-xs" title="Dispatch" onclick="eqpt_dispatch('<?= $row['emp_id'] ?>')">D</button>|<button type="button" class="btn btn-default btn-xs" title="Relieved" onclick="eqpt_relieve('<?= $row['emp_id'] ?>')">R</button>|<button type="button" class="btn btn-default btn-xs" title="Reject" onclick="eqpt_reject('<?= $row['emp_id'] ?>')">X</button>|<button type="button" class="btn btn-default btn-xs fa fa-trash-o" title="Delete" onclick="return confirm('Are you sure?')?delete_given_eqpt('<?= $row['emp_id'] ?>'):'';"></button></td>
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

					<table class="table table-bordered table-striped mb-none" id="datatable-def3">									<thead>
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
										<td><a href="?page=fillin_manpower&req_no=<?= $id ?>&mp_req_id=<?= $row['id'] ?>" target='blank'><button class="btn btn-default btn-xs fa fa-pencil"></button></a></td>
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
							<table class="table table-bordered table-striped mb-none" id="datatable-def4">									<thead>
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
											<td><button type="button" class="btn btn-default btn-xs" title="Dispatch" onclick="per_dispatch('<?= $row['emp_id'] ?>')">D</button>|<button type="button" class="btn btn-default btn-xs" title="Relieved" onclick="per_relieve('<?= $row['emp_id'] ?>')">R</button>|<button type="button" class="btn btn-default btn-xs" title="Reject" onclick="per_reject('<?= $row['emp_id'] ?>')">X</button>|<button type="button" class="btn btn-default btn-xs fa fa-trash-o" title="Delete" onclick="return confirm('Are you sure?')?delete_given_mp('<?= $row['emp_id'] ?>'):'';"></button></td>
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
				<!-- here -->
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
				<!-- <input type="text" id="nos_limit"> -->
				<table class="table table-bordered table-striped mb-none">		<thead>
					<tr>
						<th>No#</th>
						<th>Name</th>
						<th>Status</th>
						<th>Add</th>
					</tr>
				</thead>
				<tbody id="append_data">

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
				<table class="table table-bordered table-striped mb-none">		
					<thead>
						<tr>
							<th>No#</th>
							<th>Operator ID</th>
							<th>Name</th>
							<th>Assign</th>
						</tr>
					</thead>
					<tbody id="append_data2">
						
					</tbody>
				</table>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="close_eqpt">Close</button>
				</div>
			</div>
			
		</div>
	</div>
</div>
<div class="modal fade" id="equipment_data_modal" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" id="equipment_activity_close2">&times;</button>
				<h4 class="modal-title">Select Equipment</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="no_optr">
				<input type="hidden" id="no_eqpt">
				<input type="hidden" id="eqpt_type_id">
				<table class="table table-bordered table-striped mb-none" id="datatable-task-per">									
					<thead>
						<tr class="center">
							<th>Add</th>
							<th>Equipment</th>
						</tr>
					</thead>
					<tbody id="equipment_data">

					</tbody>
				</table>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" id="equipment_activity_close">Close</button>
				</div>
			</div>

		</div>
	</div>
</div>
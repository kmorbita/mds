<?php 
if (isset($_GET['page']) && $_GET['req_no'] != null) {
	$id = $_GET['req_no'];
			// $edit_user = $controller->edit_user($id);
	$job_status = $controller->job_status($id);
			// if ($job_status != "completed" && $job_status != "closed" && $job_status != "cancelled") {
	$personnel = $controller->personnel($id);
	$equipment_given = $controller->equipment_given($id);
	// $personnel_task = $controller->personnel_task($id);
	// $equipment_task = $controller->equipment_task($id);
	// $personnel_task_data = $controller->personnel_task_data($id);
	// $equipment_task_data = $controller->equipment_task_data($id);
	// $personnel_table_task = $controller->personnel_table_task($id);
	// $equipment_table_task = $controller->equipment_table_task($id);
			// $equipment_task_data = $controller->equipment_task_data($id);
	$personnel_task_added = $controller->personnel_task_added($id);
	$operator_task_added = $controller->operator_task_added($id);
	$Equipment_list = $controller->job_eqpt_list($id);
	$equipment_needed_list = $controller->equipment_needed_list($id);
	// 		}else{
	// 	echo "<script> window.location.replace('?page=joborderlist')</script>";
	// }
}
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<u><?= $id ?></u>
			<a href="#" class="fa fa-caret-down"></a>
		</div>
		<h2 class="panel-title">Operator & Equipments Activity</h2>
	</header>
	<div class="panel-body">
		<input type="hidden" id="req_no" value="<?= $id ?>">


		
		<div class="col-md-12">
			<header class="panel-heading">
				<div class="panel-actions">
					<!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#equipment_activity">New</button> -->
				</div>
				<h2 class="panel-title">Equipment</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped mb-none" id="datatable-def3">
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
		</div>
		<div class="col-md-12">
			<header class="panel-heading">
				<div class="panel-actions">
					<!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#operator_activity">New</button> -->
				</div>
				<h2 class="panel-title">Operator</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped mb-none" id="datatable-default">									
					<thead>
						<tr>
							<th>Personnel</th>
							<th>Designation</th>
							<th>Temp .Designation</th>
							<th>Remarks</th>
							<th>Status</th>
							<th>Reason</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php 
							$i=1;
							$status2='';
							foreach($operator_task_added as $rows): 
								if ($rows['status'] == "queued") {
									$status2 = "<button type='button' class='btn btn-xs btn-default'>queued</button>";
								}elseif ($rows['status'] == "stopped") {
									$status2 = "<button type='button' class='btn btn-xs btn-danger'>stopped</button>";
								}elseif ($rows['status'] == "paused") {
									$status2 = "<button type='button' class='btn btn-xs btn-danger'>paused</button>";
								}elseif ($rows['status'] == "working") {
									$status2 = "<button type='button' class='btn btn-xs btn-warning'>working</button>";
								}elseif ($rows['status'] == "started") {
									$status2 = "<button type='button' class='btn btn-xs btn-success'>started</button>";
								}elseif ($rows['status'] == "resumed") {
									$status2 = "<button type='button' class='btn btn-xs btn-primary'>resumed</button>";
								}else{
									$status2 = "<button type='button' class='btn btn-xs btn-info'>completed</button>";
								}
								?>
								<tr class="gradeX optr_<?= $rows['id'] ?>">
									<td><?= $rows['fname']." ".$rows['mname']." ".$rows['lname'] ?></td>
									<td><?= $rows['mp_name'] ?></td>
									<td><?= $rows['temp_designation'] ?></td>
									<td><?= $rows['remarks'] ?></td>
									<td><?= $status2 ?></td>
									<td><?= $rows['reason'] ?></td>
									
									<td><button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?optr_delete('<?= $rows['id'] ?>'):'';"></button></td>
								</tr>
								<?php
								$i++;
							endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>


	<div class="modal fade" id="personnel_activity" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" id="personnel_activity_close">&times;</button>
					<h4 class="modal-title">Select task for personnel</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-striped mb-none" id="datatable-default3">								
						<thead>
							<tr>
								<th>Add</th>
								<th>Personnel</th>
								<th>Designation</th>
								<th>Temp. Designation</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i=1;
							foreach($personnel as $rows):
								?>
								<tr class="gradeX">
									<td class="center"><button type="button" class="btn btn-info btn-xs" onclick="add_personnel_task('<?= $rows['emp_id'] ?>')"><i class="fa fa-plus"></i></button></td>
									<td><?= $rows['fname']." ".$rows['mname']." ".$rows['lname'] ?></td>
									<td><?= $rows['mp_name'] ?></td>
									<td> <select class="form-control input" id="per_<?= $rows['emp_id'] ?>_temp_des">
										<option  value="none" disabled selected>Selet Temp. Designation</option>
										<?php foreach($manpower as $row): ?>
											<option value="<?= $row['mp_name'] ?>"><?= $row['mp_name'] ?></option>
										<?php endforeach ?>
									</select></td>
								</tr>
								
								<?php
								$i++;
							endforeach ?>
						</tbody>
					</table>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" id="personnel_activity_close2">Close</button>
					</div>
				</div>

			</div>
		</div>
	</div>



	<div class="modal fade" id="operator_activity" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" id="operator_activity_close">&times;</button>
					<h4 class="modal-title">Select task for personnel</h4>
				</div>
				<div class="modal-body">
					<table class="table table-bordered table-striped mb-none" id="datatable-task-per">									
						<thead>
							<tr>
								<th>Add</th>
								<th>Personnel</th>
								<th>Equipment</th>
								<th>Designation</th>
								<th>Temp. Designation</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i=1;
							foreach($equipment_given as $rows): 
								?>
								<tr class="gradeX">
									<td class="center"><button type="button" class="btn btn-info btn-xs" onclick="add_operator_task('<?= $rows['emp_id'] ?>')"><i class="fa fa-plus"></i></button></td>
									<td><?= $rows['fname']." ".$rows['mname']." ".$rows['lname'] ?></td>
									<td><?= $rows['eqpt_name'] ?></td>
									<td><?= $rows['mp_name'] ?></td>
									<td> <select class="form-control populate" id="eqpt_<?= $rows['emp_id'] ?>_temp_des2">
										<option value="none" disabled selected>Selet Temp. Designation</option>
										<?php foreach($manpower as $row): ?>
											<option value="<?= $row['mp_name'] ?>"><?= $row['mp_name'] ?></option>
										<?php endforeach ?>
									</select></td>
								</tr>
								<?php
								$i++;
							endforeach ?>
						</tbody>
					</table>

					<div class="modal-footer">
						<button type="button" class="btn btn-default" id="operator_activity_close2">Close</button>
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
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
		<h2 class="panel-title">Personnel & Equipments Activity</h2>
	</header>
	<div class="panel-body">
		<input type="hidden" id="req_no" value="<?= $id ?>">
		<div class="col-md-12">
			<header class="panel-heading">
				<div class="panel-actions">
					<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#personnel_activity">New</button>
				</div>
				<h2 class="panel-title">Personnel</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped mb-none" id="datatable-default2">								
					<thead>
						<tr>
							<th>Personnel</th>
							<th>Designation</th>
							<th>Temp. Designation</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i=1;
						$status='';
						foreach($personnel_task_added as $row):
							if ($row['status'] == "queued") {
								$status = "<button type='button' class='btn btn-xs btn-default'>queued</button>";
							}elseif ($row['status'] == "stopped") {
								$status = "<button type='button' class='btn btn-xs btn-danger'>stopped</button>";
							}elseif ($row['status'] == "paused") {
								$status = "<button type='button' class='btn btn-xs btn-danger'>paused</button>";
							}elseif ($row['status'] == "working") {
								$status = "<button type='button' class='btn btn-xs btn-warning'>working</button>";
							}elseif ($row['status'] == "started") {
								$status = "<button type='button' class='btn btn-xs btn-success'>started</button>";
							}elseif ($row['status'] == "resumed") {
								$status = "<button type='button' class='btn btn-xs btn-primary'>resumed</button>";
							}else{
								$status = "<button type='button' class='btn btn-xs btn-info'>completed</button>";
							}
							?>
							<tr class="gradeX per_<?= $row['id']?>">
								<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
								<td><?= $row['mp_name'] ?></td>
								<td><?= $row['temp_designation'] ?></td>
								<td><?= $status ?></td>
								<?php 
									if($row['status'] == "queued"){ ?>
										<td><button type="button" class="btn btn-default btn-xs"><i class="fa fa-play" onclick="per_work_start('<?= $row['id'] ?>')"></i></button>|<button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?per_delete('<?= $row['id'] ?>'):'';"></button></td>
									<?php }elseif($row['status'] == "working"){ ?>
										<td><button type="button" class="btn btn-default btn-xs" onclick="per_work_stop('<?= $row['id'] ?>')"><i class="fa fa-stop"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="per_work_complete('<?= $row['id'] ?>')">complete</button>|<button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?per_delete('<?= $row['id'] ?>'):'';"></button></td>
									<?php }elseif($row['status'] == "paused"){ ?>
										<td><button type="button" class="btn btn-default btn-xs"><i class="fa fa-play" onclick="per_work_continue('<?= $row['id'] ?>')"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="per_work_stop('<?= $row['id'] ?>')"><i class="fa fa-stop"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="per_work_complete('<?= $row['id'] ?>')">complete</button>|<button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?per_delete('<?= $row['id'] ?>'):'';"></button></td>
									<?php }elseif($row['status'] == "resumed"){ ?>
										<td><button type="button" class="btn btn-default btn-xs" onclick="per_work_stop('<?= $row['id'] ?>')"><i class="fa fa-stop"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="per_work_complete('<?= $row['id'] ?>')">complete</button>|<button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?per_delete('<?= $row['id'] ?>'):'';"></button></td>
									<?php }elseif($row['status'] == "stopped"){ ?>
										<td><button type="button" class="btn btn-default btn-xs"><i class="fa fa-play" onclick="per_work_continue('<?= $row['id'] ?>')"></i></button>|<button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?per_delete('<?= $row['id'] ?>'):'';"></button></td>
									<?php }else{ ?>
										<td><button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?per_delete('<?= $row['id'] ?>'):'';"></button></td>
									<?php } 
								?>
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
					<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#operator_activity">New</button>
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
							<th>Status</th>
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
									<td><?= $status2 ?></td>
									<?php 
									if ($job_status != "stopped") {
										if($rows['status'] == "queued"){ ?>
											<td><button type="button" class="btn btn-default btn-xs"><i class="fa fa-play" onclick="optr_work_start('<?= $rows['id'] ?>')"></i></button>|<button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?optr_delete('<?= $rows['id'] ?>'):'';"></button></td>
										<?php }elseif($rows['status'] == "working"){ ?>
											<td><button type="button" class="btn btn-default btn-xs" onclick="optr_work_stop('<?= $rows['id'] ?>')"><i class="fa fa-stop"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="optr_work_complete('<?= $rows['id'] ?>')">complete</button>|<button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?optr_delete('<?= $rows['id'] ?>'):'';"></button></td>
										<?php }elseif($rows['status'] == "paused"){ ?>
											<td><button type="button" class="btn btn-default btn-xs"><i class="fa fa-play" onclick="optr_work_continue('<?= $rows['id'] ?>')"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="optr_work_stop('<?= $rows['id'] ?>')"><i class="fa fa-stop"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="optr_work_complete('<?= $rows['id'] ?>')">complete</button>|<button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?optr_delete('<?= $rows['id'] ?>'):'';"></button></td>
										<?php }elseif($rows['status'] == "resumed"){ ?>
											<td><button type="button" class="btn btn-default btn-xs" onclick="optr_work_stop('<?= $rows['id'] ?>')"><i class="fa fa-stop"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="optr_work_complete('<?= $rows['id'] ?>')">complete</button>|<button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?optr_delete('<?= $rows['id'] ?>'):'';"></button></td>
										<?php }elseif($rows['status'] == "stopped"){ ?>
											<td><button type="button" class="btn btn-default btn-xs"><i class="fa fa-play" onclick="optr_work_continue('<?= $rows['id'] ?>')"></i></button>|<button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?optr_delete('<?= $rows['id'] ?>'):'';"></button></td>
										<?php }else{ ?>
											<td><button type="button" class="btn btn-default btn-sm fa fa-trash-o" onclick="return confirm('Are you sure?')?optr_delete('<?= $rows['id'] ?>'):'';"></button></td>
										<?php }
									}else{
										echo "<td></td>";
									}
									?>
								</tr>
								<?php
								$i++;
							endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-12">
				<table class="table table-bordered table-striped mb-none" id="datatable-def3">
					<thead>
						<tr>
							<th>No#</th>
							<th>Equipment</th>
							<th>Status</th>
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
								<?php if ($val['status'] == "queued") {
											?>
											<td><button type="button" class="btn btn-default btn-xs" onclick="eq_work('<?= $val['eq_code'] ?>')"><i class="fa fa-play"></i></button></td>
											<?php
										}else if ($val['status'] == "working") {
											?>
											<td><button type="button" class="btn btn-default btn-xs" onclick="eq_stop('<?= $val['eq_code'] ?>')"><i class="fa fa-stop"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="eq_complete('<?= $val['eq_code'] ?>')">complete</button></td>
											<?php
										}else if ($val['status'] == "resumed") {
											?>
											<td><button type="button" class="btn btn-default btn-xs" onclick="eq_stop('<?= $val['eq_code'] ?>')"><i class="fa fa-stop"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="eq_complete('<?= $val['eq_code'] ?>')">complete</button></td>
											<?php
										}else if ($val['status'] == "stopped") {
											?>
											<td><button type="button" class="btn btn-default btn-xs" onclick="eq_resume('<?= $val['eq_code'] ?>')"><i class="fa fa-play"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="eq_complete('<?= $val['eq_code'] ?>')">complete</button></td>
											<?php
										}else if ($val['status'] == "paused") {
											?>
											<td><button type="button" class="btn btn-default btn-xs" onclick="eq_resume('<?= $val['eq_code'] ?>')"><i class="fa fa-play"></i></button>|<button type="button" class="btn btn-default btn-xs" onclick="eq_complete('<?= $val['eq_code'] ?>')">complete</button></td>
											<?php
										}else{
											?>
											<td></td>
										<?php } ?>
							</tr>
							<?php
							$i++;
						endforeach ?>
					</tbody>
				</table>
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
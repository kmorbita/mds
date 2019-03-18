<?php 
if (isset($_GET['page']) && isset($_GET['activity_id']) != null) {
	$id = $_GET['activity_id'];
	$job_status = $controller->job_status($id);
	// if ($job_status != "completed" && $job_status != "closed" && $job_status != "cancelled") {
	$job_desc = $controller->job_description($id);
	$personnel = $controller->personnel($id);
	$equipment_given = $controller->equipment_given($id);
	// $personnel_task_data = $controller->personnel_task_data($id);
	// $equipment_task_data = $controller->equipment_task_data($id);
	$job_timestamp = $controller->job_timestamp($id);
	$personnel_task_added = $controller->personnel_task_added($id);
	$operator_task_added = $controller->operator_task_added($id);
	$equip = $controller->job_equipment_expo($id);
	// }else{
	// 	echo "<script> window.location.replace('?page=joborderlist')</script>";
	// }
}
?>
<script>
	var job_activity = function () {
		var req = $("#job_req").val();
		$.ajax({
			url : "passer.php",
			type : "POST",
			data : {job_activity : req},
			cache : false,
			success : function (res) {
      // alert(res);
      var i = 1;
      var arr = JSON.parse(res);
      // console.log(arr)
      var html = "";
      var i=1;
      arr.forEach(function(item){
      	html+="<tr class='gradeX'>";
      	html+="<td>"+i+"</td>";
      	html+="<td>"+item.request_no+"</td>";
      	html+="<td>"+item.jobdescription+"</td>";
      	html+="<td>"+item.jobcode+"</td>";
      	html+="<td>"+item.joblocation+"</td>";
      	html+="<td>"+item.status+"</td>";
      	html+="<td>"+item.remarks+"</td>";;
      	// html+="<td><button type='button' class='btn btn-default btn-xs' onclick='edit("+item.id+")'>Edit</button></td>";
      	html+="</tr>";
      	i++;
      });
      $("#job_activity").html(html);
  }
});
	}
	setInterval(job_activity,1000)



	var all_operator = function () {
		var req = $("#job_req").val();
  // alert(req);
  $.ajax({
  	url : "passer.php",
  	type : "POST",
  	data : {all_operator : req},
  	cache : false,
  	success : function (res) {
      // alert(res);
      var i = 1;
      var arr = JSON.parse(res);
      // console.log(arr)
      var html = "";
      var i=1;
      arr.array.forEach(function(item){
      	html+="<tr class='gradeX'>";
      	html+="<td>"+i+"</td>";
      	html+="<td>"+item.fname+" "+item.mname+" "+item.lname+"</td>";
      	html+="<td>"+item.mp_name+"</td>";
      	html+="<td>"+item.status+"</td>";
      	if (arr.status != "completed" && arr.status != "cancelled" && arr.status != "closed") {
      		html+="<td><button type='button' class='btn btn-default btn-xs' onclick='optr_relieve("+item.emp_id+")'>Relieve</button>|<button type='button' class='btn btn-default btn-xs' onclick='optr_reject("+item.emp_id+")'>Reject</button></td>";
      	}else{
      		html+="<td></td>";
      	}
      	html+="</tr>";
      	i++;
      });
      $("#all_operator").html(html);
  }
});
}
setInterval(all_operator,1000)


var all_gang = function () {
	var req = $("#job_req").val();
	$.ajax({
		url : "passer.php",
		type : "POST",
		data : {all_gang : req},
		cache : false,
		success : function (res) {
      // alert(res);
      var i = 1;
      var arr = JSON.parse(res);
      // console.log(arr)
      var html = "";
      var i=1;
      arr.array.forEach(function(item){
      	html+="<tr class='gradeX'>";
      	html+="<td>"+i+"</td>";
      	html+="<td>"+item.fname+" "+item.mname+" "+item.lname+"</td>";
      	html+="<td>"+item.mp_name+"</td>";
      	html+="<td>"+item.status+"</td>";
      	if (arr.status != "completed" && arr.status != "cancelled" && arr.status != "closed") {
      		html+="<td><button type='button' class='btn btn-default btn-xs' onclick='per_relieve("+item.emp_id+")'>Relieve</button>|<button type='button' class='btn btn-default btn-xs' onclick='per_reject("+item.emp_id+")'>Reject</button></td>";
      	}else{
      		html+="<td></td>";
      	}
      	html+="</tr>";
      	i++;
      });
      $("#all_gang").html(html);
  }
});
}
setInterval(all_gang,1000)

</script>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			Job Request Number: <u><?= $id ?></u>
			<a href="#" class="fa fa-caret-down"></a>
		</div>

		<h2 class="panel-title">Job Activity</h2>
	</header>
	<div class="panel-body">
		<input type="hidden" id="req" value="<?= $id ?>">
		<input type="hidden" id="username" value="<?= $_SESSION['username'] ?>">
		<input type="hidden" id="name" value="<?= $_SESSION['name'] ?>">
		<input type="hidden" id="job_req" value="<?= $id ?>">
		<input type="hidden" id="job_desc" value="<?= $job_desc ?>">
		<table class="table table-bordered table-striped mb-none" id="datatable-joblist">									
			<thead>
				<tr>
					<th>No#</th>
					<th>Request No#</th>
					<th>Job Description</th>
					<th>Job Code</th>
					<th>Job Location</th>
					<th>Status</th>
					<th>Remarks</th>
					<!-- <th>Edit</th> -->
				</tr>
			</thead>
			<tbody id="job_activity">
			</tbody>
		</table>
		<div align="right">
			<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#add_job_timestamp">Add Job Timestamp</button>
		</div>
		<table class="table table-bordered table-striped mb-none" id="datatable-def2">									
			<thead>
				<tr>
					<th>Request No#</th>
					<th>Status</th>
					<th>Work Started</th>
					<th>Work Stopped</th>
					<th>Work Resumed</th>
					<th>Work Completed</th>
					<th>Reason</th>
					<th>Accomplishment</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				foreach($job_timestamp as $job):
					?>
					<tr class="gradeX job_del_<?= $job['id'] ?>">
						<td><?= $job['request_no'] ?></td>
						<td><?= $job['status'] ?></td>
						<td><?= $job['work_started'] ?></td>
						<td><?= $job['work_stopped'] ?></td>
						<td><?= $job['work_resumed'] ?></td>
						<td><?= $job['work_completed'] ?></td>
						<td><?= $job['reason'] ?></td>
						<td><?= $job['accomplishment'] ?></td>
						<td><button type="button" class="btn btn-default btn-xs fa fa-pencil" onclick="edit_job_time('<?= $job['id'] ?>')"></button>|<button type="button" class="btn btn-default btn-xs fa fa-trash-o" onclick="return confirm('Are you sure?')?delete_job_time('<?= $job['id'] ?>'):'';"></button></td>
					</tr>
					<?php
					$i++;
				endforeach ?>
			</tbody>
		</table>
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
				</div>

				<h2 class="panel-title">Personnel & Operator</h2>
			</header>
			<div class="panel-body">
				<div class="col-md-12">
					<table class="table table-bordered table-striped mb-none" id="datatable-all_operator">
						<thead>
							<tr>
								<th colspan="7" class="center" style="background-color: #DADADA">Operator</th>
							</tr>
							<tr>
								<th>No#</th>
								<th>Personnel Name</th>
								<th>Designation</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="all_operator">
						</tbody>
					</table>
				</div>
				<div class="col-md-12">
					<table class="table table-bordered table-striped mb-none" id="datatable-all_gang">
						<thead>
							<tr>
								<th colspan="7" class="center" style="background-color: #DADADA">Personnel</th>
							</tr>
							<tr>
								<th>No#</th>
								<th>Personnel Name</th>
								<th>Designation</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody id="all_gang">
						</tbody>
					</table>
				</div>
			</div>
		</section>
<!-- 		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
				</div>

				<h2 class="panel-title">Personnel & Operator Activity</h2>
			</header>
			<div class="panel-body"> -->
				<div class="col-md-12">
					<table class="table table-bordered table-striped mb-none"  id="datatable-def3">
						<thead>
							<tr>
								<th colspan="10" class="center" style="background-color: #DADADA">Operator Activity</th>
							</tr>
							<tr>
								<th>No#</th>
								<th>Personnel Name</th>
								<th>Designation</th>
								<th>Status</th>
								<th>Remarks</th>
								<th>Work Time</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i=1;
							foreach($operator_task_added as $row):
								?>
								<tr>
									<td><?= $i ?></td>
									<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
									<td><?= $row['mp_name'] ?></td>
									<td><?= $row['status'] ?></td>
									<td><?= $row['remarks'] ?></td>
									<td class="center"><a href="?page=operator_work_time&req=<?= $row['request_no'] ?>&emp_id=<?= $row['emp_id'] ?>"><button type="button" class="btn btn-default btn-xs">View</button></a></td>
								</tr>
								<?php 
								$i++;
							endforeach ?>
						</tbody>
					</table>
				</div>
				<div class="col-md-12">
					<table class="table table-bordered table-striped mb-none"  id="datatable-def4">
						<thead>
							<tr>
								<th colspan="10" class="center" style="background-color: #DADADA">Personnel Activity</th>
							</tr>
							<tr>
								<th>No#</th>
								<th>Personnel Name</th>
								<th>Designation</th>
								<th>Status</th>
								<th>Remarks</th>
								<th>Work Time</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i=1;
							foreach($personnel_task_added as $row):
								?>
								<tr>
									<td><?= $i ?></td>
									<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
									<td><?= $row['mp_name'] ?></td>
									<td><?= $row['status'] ?></td>
									<td><?= $row['remarks'] ?></td>
									<td class="center"><a href="?page=personnel_work_time&req=<?= $row['request_no'] ?>&emp_id=<?= $row['emp_id'] ?>"><button type="button" class="btn btn-default btn-xs">View</button></a></td>
								</tr>
								<?php 
								$i++;
							endforeach ?>
						</tbody>
					</table>
				</div>
				<div class="col-md-12">
					<br>
					<table class="table table-bordered table-striped mb-none" id="datatable-def5">
						<thead>
							<tr>
								<th colspan="10" class="center" style="background-color: #DADADA">Equipment Activity</th>
							</tr>
							<tr>
								<th>No#</th>
								<th>Equipment Name</th>
								<th>Status</th>
								<th>Remarks</th>
								<th>Work Time</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$i=1;
							foreach($equip as $row):
								if ($row['status'] == "") {
									$row['status']="queued";
								}else{
									$row['status'];
								}
								?>
								<tr>
									<td><?= $i ?></td>
									<td><?= $row['eqpt_name'] ?></td>
									<td><?= $row['status'] ?></td>
									<td><?= $row['remarks'] ?></td>
									<td class="center"><a href="?page=equipment_work_time&req=<?= $id?>&eq_code=<?= $row['eq_code'] ?>"><button type="button" class="btn btn-default btn-xs">View</button></a></td>
								</tr>
								<?php 
								$i++;
							endforeach ?>
						</tbody>
					</table>
				</div>
<!-- 			</div>
		</section> -->
	</div>
</section>
<div class="modal fade" id="edit_job_activity" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Job Activity</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="job_id">
				<div class="form-group">
					<label>Status</label>
					<input type="text" class="form-control" id="status"><b><span class="color-text" id="status_error"></span></b>
				</div>
				<div class="form-group">
					<label>Remarks</label>
					<input type="text" class="form-control" id="remarks"><b><span class="color-text" id="remarks_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Started</label>
					<input type="text" class="form-control" id="work_started"><b><span class="color-text" id="work_started_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Stopped</label>
					<input type="text" class="form-control" id="work_stopped"><b><span class="color-text" id="work_stopped_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Resumed</label>
					<input type="text" class="form-control" id="work_resumed"><b><span class="color-text" id="work_resumed_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Completed</label>
					<input type="text" class="form-control" id="work_completed"><b><span class="color-text" id="work_completed_error"></span></b>
				</div>
				<div class="form-group">
					<label>Reason</label>
					<input type="text" class="form-control" id="reason"><b><span class="color-text" id="reason_error"></span></b>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" id="update_activity">Update</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="close">Close</button>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="edit_optr_activity" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Operator Activity</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="optr_job_id">
				<div class="form-group">
					<label>Status</label>
					<input type="text" class="form-control" id="optr_status"><b><span class="color-text" id="status_optr_error"></span></b>
				</div>
				<div class="form-group">
					<label>Remarks</label>
					<input type="text" class="form-control" id="optr_remarks"><b><span class="color-text" id="remarks_optr_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Started</label>
					<input type="text" class="form-control" id="optr_work_started"><b><span class="color-text" id="work_started_optr_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Stopped</label>
					<input type="text" class="form-control" id="optr_work_stopped"><b><span class="color-text" id="work_stopped_optr_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Resumed</label>
					<input type="text" class="form-control" id="optr_work_resumed"><b><span class="color-text" id="work_resumed_optr_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Completed</label>
					<input type="text" class="form-control" id="optr_work_completed"><b><span class="color-text" id="work_completed_optr_error"></span></b>
				</div>
				<div class="form-group">
					<label>Reason</label>
					<input type="text" class="form-control" id="optr_reason"><b><span class="color-text" id="reason_optr_error"></span></b>
				</div>
				<div class="form-group">
					<label>Notes</label>
					<input type="text" class="form-control" id="optr_notes"><b><span class="color-text" id="notes_optr_error"></span></b>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" id="update_optr_activity">Update</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="close">Close</button>
				</div>
			</div>

		</div>
	</div>
</div>


<div class="modal fade" id="edit_per_activity" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Personnel Activity</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="per_job_id">
				<div class="form-group">
					<label>Status</label>
					<input type="text" class="form-control" id="per_status"><b><span class="color-text" id="status_per_error"></span></b>
				</div>
				<div class="form-group">
					<label>Remarks</label>
					<input type="text" class="form-control" id="per_remarks"><b><span class="color-text" id="remarks_per_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Started</label>
					<input type="text" class="form-control" id="per_work_started"><b><span class="color-text" id="work_started_per_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Stopped</label>
					<input type="text" class="form-control" id="per_work_stopped"><b><span class="color-text" id="work_stopped_per_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Resumed</label>
					<input type="text" class="form-control" id="per_work_resumed"><b><span class="color-text" id="work_resumed_per_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Completed</label>
					<input type="text" class="form-control" id="per_work_completed"><b><span class="color-text" id="work_completed_per_error"></span></b>
				</div>
				<div class="form-group">
					<label>Reason</label>
					<input type="text" class="form-control" id="per_reason"><b><span class="color-text" id="reason_per_error"></span></b>
				</div>
				<div class="form-group">
					<label>Notes</label>
					<input type="text" class="form-control" id="per_notes"><b><span class="color-text" id="notes_per_error"></span></b>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" id="update_per_activity">Update</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="close">Close</button>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="edit_job_timestamp" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Edit Job Timestamp</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="request_no_job">
				<input type="hidden" id="timestamp_id">
				<div class="form-group">
					<label>Work Started</label>
					<input type="text" class="form-control" id="edit_work_started"><b><span class="color-text" id="edit_work_started_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Stopped</label>
					<input type="text" class="form-control" id="edit_work_stopped"><b><span class="color-text" id="edit_work_stopped_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Resumed</label>
					<input type="text" class="form-control" id="edit_work_resumed"><b><span class="color-text" id="edit_work_resumed_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Completed</label>
					<input type="text" class="form-control" id="edit_work_completed"><b><span class="color-text" id="edit_work_completed_error"></span></b>
				</div>
				<div class="form-group">
					<label>Reason</label>
					<input type="text" class="form-control" id="edit_reason"><b><span class="color-text" id="edit_reason2_error"></span></b>
				</div>
				<div class="form-group">
					<label>Accomplishment</label>
					<input type="text" class="form-control" id="edit_accom"><b><span class="color-text" id="edit_accom2_error"></span></b>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" id="update_job_timestamp">Update</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="close_job_time">Close</button>
				</div>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="add_job_timestamp" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Job Timestamp</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="request_no_job">
				<!-- <input type="hidden" id="timestamp_id"> -->
				<div class="form-group">
					<label>Status</label>
					<select data-plugin-selectTwo name="role" class="form-control populate" id="job_status">
					<option></option>
					<option value="started">Started</option>
					<option value="stopped">Stopped</option>
					<option value="resumed">Resumed</option>
					<option value="completed">Completed</option>
				</select>
				</div>
				<div class="form-group">
					<label>Work Started</label>
					<input type="text" class="form-control" id="add_work_started"><b><span class="color-text" id="edit_work_started_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Stopped</label>
					<input type="text" class="form-control" id="add_work_stopped"><b><span class="color-text" id="edit_work_stopped_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Resumed</label>
					<input type="text" class="form-control" id="add_work_resumed"><b><span class="color-text" id="edit_work_resumed_error"></span></b>
				</div>
				<div class="form-group">
					<label>Work Completed</label>
					<input type="text" class="form-control" id="add_work_completed"><b><span class="color-text" id="edit_work_completed_error"></span></b>
				</div>
				<div class="form-group">
					<label>Reason</label>
					<input type="text" class="form-control" id="add_reason"><b><span class="color-text" id="edit_reason_error"></span></b>
				</div>
				<div class="form-group">
					<label>Accomplishment</label>
					<input type="text" class="form-control" id="add_accom"><b><span class="color-text" id="edit_accom_error"></span></b>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-sm" id="insert_job_timestamp">Add</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" id="close_job">Close</button>
				</div>
			</div>

		</div>
	</div>
</div>
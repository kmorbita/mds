<?php 
if (isset($_GET['page']) && isset($_GET['activity_id']) != null) {
	$id = $_GET['activity_id'];
	$job_status = $controller->job_status($id);
	if ($job_status != "completed" && $job_status != "closed" && $job_status != "cancelled") {
		$job_desc = $controller->job_description($id);
		$job_activity = $controller->activity($id);
		$personnel = $controller->personnel($id);
		$equipment_given = $controller->equipment_given($id);
		$all_operator = $controller->all_operator($id);
		$all_gang = $controller->all_gang($id);
	}else{
		echo "<script> window.location.replace('?page=joborderlist')</script>";
	}
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
      	html+="<td>"+item.est+"</td>";
      	html+="<td>"+item.status+"</td>";
      	html+="<td>"+item.remarks+"</td>";
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
      arr.forEach(function(item){
      	html+="<tr class='gradeX'>";
      	html+="<td>"+i+"</td>";
      	html+="<td>"+item.fname+" "+item.mname+" "+item.lname+"</td>";
      	html+="<td>"+item.mp_name+"</td>";
      	html+="<td>"+item.status+"</td>";
      	html+="<td><button type='button' class='btn btn-default btn-xs' onclick='optr_relieve("+item.emp_id+")'>Relieve</button>|<button type='button' class='btn btn-default btn-xs' onclick='optr_reject("+item.emp_id+")'>Reject</button></td>";
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
      arr.forEach(function(item){
      	html+="<tr class='gradeX'>";
      	html+="<td>"+i+"</td>";
      	html+="<td>"+item.fname+" "+item.mname+" "+item.lname+"</td>";
      	html+="<td>"+item.mp_name+"</td>";
      	html+="<td>"+item.status+"</td>";
      	html+="<td><button type='button' class='btn btn-default btn-xs' onclick='per_relieve("+item.emp_id+")'>Relieve</button>|<button type='button' class='btn btn-default btn-xs' onclick='per_reject("+item.emp_id+")'>Reject</button></td>";
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
					<th>EST.</th>
					<th>Status</th>
					<th>Remarks</th>
				</tr>
			</thead>
			<tbody id="job_activity">
			</tbody>
		</table><br>
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
				</div>
				
				<h2 class="panel-title">Personnel & Operator</h2>
			</header>
			<div class="panel-body">
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
		</section>
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
				</div>
				
				<h2 class="panel-title">Notify Timekeeper</h2>
			</header>
			<div class="panel-body">
				<div class="col-md-6">
					<table class="table table-bordered table-striped mb-none">									
						<thead>
							<tr>
								<th>No#</th>
								<th>Personnel</th>
								<th>Equipment</th>
								<th>Select</th>
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
										<td class="center"><input type="checkbox" value="<?= $row['fname']." ".$row['mname']." ".$row['lname'] ?>" name="equipment" class="equipment"></td>
									</tr>
									<?php
									$i++;
								endforeach ?>
							</tbody>
						</table>
						<div class="col-md-10">
							<label>Request:</label>
							<select data-plugin-selectTwo class="form-control input populate" id="eq_given">
								<option></option>
								<option>Lack Equipment</option>
								<option>Lack Operator</option>
								<option>Recall Operator</option>
								<option>Eject Operator</option>
								<option>Missing Operator</option>
							</select>
						</div>
						<div class="col-md-2">
							<label><br></label>
							<button type="button" class="btn btn-info btn-sm" id="sub_eq_given">Submit</button>
						</div>
					</div>
					<div class="col-md-6">
						<table class="table table-bordered table-striped mb-none">									
							<thead>
								<tr>
									<th>No#</th>
									<th>Personnel</th>
									<th>Designation</th>
									<th>Select</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i=1;
								foreach($personnel as $row):
									?>
									<tr class="gradeX">
										<td><?= $i ?></td>
										<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
										<td><?= $row['mp_name'] ?></td>
										<td class="center"><input type="checkbox" value="<?= $row['fname']." ".$row['mname']." ".$row['lname'] ?>" name="personnel" class="personnel"></td>
									</tr>
									<?php
									$i++;
								endforeach ?>
							</tbody>
						</table>
						<div class="col-md-10">
							<label>Request:</label>
							<select data-plugin-selectTwo class="form-control input populate" id="person_given">
								<option></option>
								<option>Lack Personnel</option>
								<option>Recall Personnel</option>
								<option>Eject Personnel</option>
								<option>Missing Personnel</option>
							</select>
						</div>
						<div class="col-md-2">
							<label><br></label>
							<button type="button" class="btn btn-info btn-sm" id="sub_person_given">Submit</button>
						</div>
					</div>
				</div>
			</section>
		</div>
	</section>

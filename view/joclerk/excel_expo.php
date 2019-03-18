<?php 

if (isset($_GET['req_no'])) {
	require("../../controller/JoclerkController.php");
	$controller = new JoclerkController();
	$id = $_GET['req_no'];
	$timezone  = +8;
	$Ctime = gmdate("Y/m/j H:i:s", time() + 3600*($timezone+date("I")));
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="'.$id.'-'.$Ctime.'.xls"');
	$job_toexpo = $controller->job_toexpo($_GET['req_no']);
	$job_toexpo_time = $controller->job_toexpo_time($_GET['req_no']);
	$job_per_act_toexpo = $controller->job_per_act_toexpo($_GET['req_no']);
	$job_optr_act_toexpo = $controller->job_optr_act_toexpo($_GET['req_no']);
	// $job_per_task_toexpo = $controller->job_per_task_toexpo($_GET['req_no']);
	// $job_optr_task_toexpo = $controller->job_optr_task_toexpo($_GET['req_no']);
	$job_per_req_toexpo = $controller->job_per_req_toexpo($_GET['req_no']);
	$job_optr_req_toexpo = $controller->job_optr_req_toexpo($_GET['req_no']);
	$job_per_req_giv_toexpo = $controller->job_per_req_giv_toexpo($_GET['req_no']);
	$job_optr_req_giv_toexpo = $controller->job_optr_req_giv_toexpo($_GET['req_no']);
	$equip = $controller->job_equipment($_GET['req_no']);
	$job_equipment_needed = $controller->job_equipment_needed($_GET['req_no']);

	$job_carrier = $controller->job_carrier($_GET['req_no']);
	$job_comm = $controller->job_comm($_GET['req_no']);
}

?>
<style type="text/css">

#table1 table, #table1 th, #table1 tr, #table1 td{
	border: 1px solid;
	border-collapse: collapse;
}
#table2 table, #table2 th, #table2 tr, #table2 td{
	border: 1px solid;
	border-collapse: collapse;
}
#table3 table, #table3 th, #table3 tr, #table3 td{
	border: 1px solid;
	border-collapse: collapse;
}
#table4 table, #table4 th, #table4 tr, #table4 td{
	border: 1px solid;
	border-collapse: collapse;
}
#table5 table, #table5 th, #table5 tr, #table5 td{
	border: 1px solid;
	border-collapse: collapse;
}
#table6 table, #table6 th, #table6 tr, #table6 td{
	border: 1px solid;
	border-collapse: collapse;
}
#table7 table, #table7 th, #table7 tr, #table7 td{
	border: 1px solid;
	border-collapse: collapse;
}
#table8 table, #table8 th, #table8 tr, #table8 td{
	border: 1px solid;
	border-collapse: collapse;
}
.head {
	background-color: #DADADA;
	color: #ffffff;
}
table	{
	border-collapse: collapse;

}
</style>
<table id="table_def">
	<tr>
		<td colspan="4" style="text-align: center;font-size: 20px"><b>Job Summary Details</b></td>
	</tr>
	<tr>
		<td>Requestor:</td>
		<td style="text-align: right"><?= $job_toexpo['requestor'] ?></td>
		<td>Request No#:</td>
		<td style="text-align: right"><?= $job_toexpo['request_no'] ?></td>
	</tr>
	<tr>
		<td>Address:</td>
		<td style="text-align: right"><?= $job_toexpo['address'] ?></td>
		<td>Request Date:</td>
		<td style="text-align: right"><?= $job_toexpo['requestdate'] ?></td>
	</tr>
	<tr>
		<td>Job Code:</td>
		<td style="text-align: right"><?= $job_toexpo['jobcode'] ?></td>
		<td>Job Description:</td>
		<td style="text-align: right"><?= $job_toexpo['jobdescription'] ?></td>
	</tr>
	<tr>
		<td>Job Date:</td>
		<td style="text-align: right"><?= $job_toexpo['jobdate'] ?></td>
		<td>Job Location:</td>
		<td style="text-align: right"><?= $job_toexpo['joblocation'] ?></td>
	</tr>
	<tr>
		<td>Estimated Time:</td>
		<td><?= $job_toexpo['est'] ?></td>
		<td>Status:</td>
		<td><?= $job_toexpo['status'] ?></td>
	</tr>
	<tr>
		<td>Accomplishments:</td>
		<td><?= $job_toexpo['accomplishment'] ?></td>
		<td>Foreman:</td>
		<td><?= $job_toexpo['foreman_name'] ?></td>
	</tr>	
</table>
<br>
<table id="table_def">
	<tr>
		<td colspan="4" style="text-align: center"><b>Cargo Carrier Details</b></td>
	</tr>
	<tr>
		<td>Vessel:</td>
		<td style="text-align: right"><?= $job_carrier['vessel'] ?></td>
		<td>Voyage:</td>
		<td style="text-align: right"><?= $job_carrier['voyage'] ?></td>
	</tr>
	<tr>
		<td>Van No#:</td>
		<td style="text-align: right"><?= $job_carrier['van_no'] ?></td>
		<td>Truck No#:</td>
		<td style="text-align: right"><?= $job_carrier['truck_no'] ?></td>
	</tr>
	<tr>
		<td>Hatch No#:</td>
		<td style="text-align: right"><?= $job_carrier['hatch_no'] ?></td>
		<td>Deck No#:</td>
		<td style="text-align: right"><?= $job_carrier['deck_no'] ?></td>
	</tr>
	<tr>
		<td>Truck Type:</td>
		<td style="text-align: right"><?= $job_carrier['trk_type'] ?></td>
	</tr>
</table>
<br>
<table id="table2" style="border: 1px solid black;text-align: center">
	<tr style="border: 1px solid black;text-align: center">
		<th colspan="7">Cargo Commodities</th>
	</tr>
	<tr style="border: 1px solid black;text-align: center">
		<td>Shipper</td>
		<td>Commodity</td>
		<td>Quantity</td>
		<td>Unit</td>
		<td>Destination</td>
		<td>Box Type</td>
		<td>Weight Per Box</td>
	</tr>
	<?php 
	$i=1;
	foreach($job_comm as $row):
		?>
		<tr style="border: 1px solid black;text-align: center">
			<td><?= $row['shipper'] ?></td>
			<td><?= $row['commodity'] ?></td>
			<td><?= $row['qty'] ?></td>
			<td><?= $row['type'] ?></td>
			<td><?= $row['destination'] ?></td>
			<td><?= $row['box'] ?></td>
			<td><?= $row['weight'] ?></td>
		</tr>
		<?php 
		$i++;
	endforeach ?>
</table>
<br>
<table id="table2" style="border: 1px solid black;text-align: center">
	<tr style="border: 1px solid black;text-align: center">
		<th colspan="4">Manpower Requested</th>
	</tr>
	<tr style="border: 1px solid black;text-align: center">
		<td colspan="2">Designation</td>
		<td colspan="2">No. Manpower</td>
	</tr>
	<?php 
	$i=1;
	foreach($job_per_req_toexpo as $row):
		?>
		<tr style="border: 1px solid black;text-align: center">
			<td colspan="2"><?= $row['mp_name'] ?></td>
			<td colspan="2"><?= $row['nos'] ?></td>
		</tr>
		<?php 
		$i++;
	endforeach ?>
</table>
<br>
<!-- equipment requested -->
<table id="table1" style="border: 1px solid black;text-align: center">
	<tr style="border: 1px solid black;text-align: center">
		<th colspan="5">Equipment Requested</th>
	</tr>
	<tr style="border: 1px solid black;text-align: center">
		<td colspan="2">Equipment</td>
		<td colspan="2">No# Equipment</td>
		<td>W/ Operator</td>
	</tr>
	<?php 
	$i=1;
	foreach($job_equipment_needed as $row):
		if ($row['no_optr'] == "1") {
			$row['no_optr'] = "Yes";
		}else {
			$row['no_optr'] = "No";
		}
		?>
		<tr style="border: 1px solid black;text-align: center">
			<td colspan="2"><?= $row['eqpt_type'] ?></td>
			<td colspan="2"><?= $row['no_eqpt'] ?></td>
			<td><?= $row['no_optr'] ?></td>
		</tr>
		<?php 
		$i++;
	endforeach ?>
</table>
<br>
<!-- equipment requested -->
<table id="table1" style="border: 1px solid black;text-align: center">
	<tr style="border: 1px solid black;text-align: center">
		<th colspan="3">Equipment Dispatched</th>
	</tr>
	<tr style="border: 1px solid black;text-align: center">
		<td colspan="2">Equipment</td>
		<!-- <td colspan="2">No# Equipment</td> -->
		<td>W/ Operator</td>
	</tr>
	<?php 
	$i=1;
	foreach($job_optr_req_toexpo as $row):
		if ($row['no_optr'] == "1") {
			$row['no_optr'] = "Yes";
		}else {
			$row['no_optr'] = "No";
		}
		?>
		<tr style="border: 1px solid black;text-align: center">
			<td colspan="2"><?= $row['eqpt_code'] ?></td>
			<td><?= $row['no_optr'] ?></td>
		</tr>
		<?php 
		$i++;
	endforeach ?>
</table>
<br>
<table id="table8" style="border: 1px solid black;text-align: center">
	<thead>
		<tr style="border: 1px solid black;text-align: center">
			<th colspan="8">Job Timestamp</th>
		</tr>
		<tr style="border: 1px solid black;text-align: center">
			<th>Status</th>
			<th>Work Started</th>
			<th>Work Stopped</th>
			<th>Work Resumed</th>
			<th>Work Completed</th>
			<th>Hours Worked</th>
			<th>Reason</th>
			<th>Accomplishment</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($job_toexpo_time as $val): ?>
			<tr style="border: 1px solid black;text-align: center">
				<td><?= $val['status'] ?></td>
				<td><?= $val['work_started'] ?></td>
				<td><?= $val['work_stopped'] ?></td>
				<td><?= $val['work_resumed'] ?></td>
				<td><?= $val['work_completed'] ?></td>
				<td><?= $val['total_time'] ?></td>
				<td><?= $val['reason'] ?></td>
				<td><?= $val['accomplishment'] ?></td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>
<br>
<?php 
$msg = count($job_per_act_toexpo);
if ($msg <= 0) {
	echo "";
}else {
	echo "<b>Personnel Activity</b>";
}
?>
<?php foreach ($job_per_act_toexpo as $val): ?>

	<table>
		<tr>
			<td>Employee ID: </td>
			<td><b><?= $val['emp_id'] ?></b></td>
			<td>Personnel Name: </td>
			<td><b><?= $val['fname']." ".$val['mname']." ".$val['lname'] ?></b></td>
		</tr>
		<tr>
			<td>Status: </td>
			<td><b><?= $val['status'] ?></b></td>
			<td>Notes: </td>
			<td><b><?= $val['notes'] ?></b></td>
		</tr>
	</table>
	<!-- <br> -->
	<?php ;
	$emp_id =  $val['emp_id'];
	$per_timestamp = $controller->job_per_act_toexpo_timestamp($id,$emp_id);
	?>
	<table id="table1" style="border: 1px solid black;text-align: center">									
		<thead>
			<tr style="border: 1px solid black;text-align: center">
				<th>Status</th>
				<th>Work Started</th>
				<th>Work Stopped</th>
				<th>Work Resumed</th>
				<th>Work Completed</th>
				<th>Hours Worked</th>
				<th>Reason</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach($per_timestamp as $job):
				?>
				<tr style="border: 1px solid black;text-align: center">
					<td><?= $job['status'] ?></td>
					<td><?= $job['work_started'] ?></td>
					<td><?= $job['work_stopped'] ?></td>
					<td><?= $job['work_resumed'] ?></td>
					<td><?= $job['work_completed'] ?></td>
					<td><?= $job['total_time'] ?></td>
					<td><?= $job['reason'] ?></td>
				</tr>
				<?php
			endforeach ?>
		</tbody>
	</tbody>
</table>
<br>
<?php endforeach ?>
<br>
<?php 
$msg = count($job_optr_act_toexpo);
if ($msg <= 0) {
	echo "";
}else {
	echo "<b>Operator Activity</b>";
}
?>
<?php foreach ($job_optr_act_toexpo as $val): ?>
	<table>
		<tr>
			<td>Employee ID: </td>
			<td><b><?= $val['emp_id'] ?></b></td>
			<td>Operator Name: </td>
			<td><b><?= $val['fname']." ".$val['mname']." ".$val['lname'] ?></b></td>
		</tr>
		<tr>
			<td>Status: </td>
			<td><b><?= $val['status'] ?></b></td>
			<td>Notes: </td>
			<td><b><?= $val['notes'] ?></b></td>
		</tr>
	</table>
	<!-- <br> -->
	<?php 
	$emp_id =  $val['emp_id'];
	$optr_timestamp = $controller->job_optr_act_toexpo_timestamp($id,$emp_id);
	?>
	<table id="table1" style="border: 1px solid black;text-align: center">									
		<thead>
			<tr style="border: 1px solid black;text-align: center">
				<th>Status</th>
				<th>Work Started</th>
				<th>Work Stopped</th>
				<th>Work Resumed</th>
				<th>Work Completed</th>
				<th>Hours Worked</th>
				<th>Reason</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach($optr_timestamp as $job):
				?>
				<tr style="border: 1px solid black;text-align: center">
					<td><?= $job['status'] ?></td>
					<td><?= $job['work_started'] ?></td>
					<td><?= $job['work_stopped'] ?></td>
					<td><?= $job['work_resumed'] ?></td>
					<td><?= $job['work_completed'] ?></td>
					<td><?= $job['total_time'] ?></td>
					<td><?= $job['reason'] ?></td>
				</tr>
				<?php
			endforeach ?>
		</tbody>
	</table>
	<br>
<?php endforeach ?>
<?php 
$msg = count($equip);
if ($msg <= 0) {
	echo "";
}else {
	echo "<b>Equipment Activity</b>";
}
?>
<?php foreach ($equip as $val): ?>
	<table>
		<tr>
			<td>Equipment: </td>
			<td><b><?= $val['eqpt_name'] ?></b></td>
		</tr>
		<tr>
			<td>Status: </td>
			<td><b><?= $val['status'] ?></b></td>
		</tr>
	</table>
	<?php 
	$eq_code =  $val['eq_code'];
	$equip_timestamp = $controller->equip_timestamp($id,$eq_code);
	?>
	<table id="table1" style="border: 1px solid black;text-align: center">									
		<thead>
			<tr style="border: 1px solid black;text-align: center">
				<th>Status</th>
				<th>Work Started</th>
				<th>Work Stopped</th>
				<th>Work Resumed</th>
				<th>Work Completed</th>
				<th>Hours Worked</th>
				<th>Reason</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach($equip_timestamp as $job):
				?>
				<tr style="border: 1px solid black;text-align: center">
					<td><?= $job['status'] ?></td>
					<td><?= $job['work_started'] ?></td>
					<td><?= $job['work_stopped'] ?></td>
					<td><?= $job['work_resumed'] ?></td>
					<td><?= $job['work_completed'] ?></td>
					<td><?= $job['total_time'] ?></td>
					<td><?= $job['reason'] ?></td>
				</tr>
				<?php
			endforeach ?>
		</tbody>
	</table>
	<?php endforeach ?>
<?php 
require("../../controller/SuperadminController.php");
$controller = new SuperadminController();
$equipment_timestamp = $controller->equipment_timestamp();
?>
<html>
<head>
	<title>Davao International Container Terminal</title>
	<link rel="icon" type="image/gif/png" href="../../assets/images/icon.PNG">
	<link rel="stylesheet" href="../../assets/assets/jquery.dataTables.min.css" />
	<link rel="stylesheet" href="../../assets/assets/buttons.dataTables.min.css" />
	<script src="../../assets/assets/jquery-1.12.3.js"></script>
	<script src="../../assets/assets/jquery.dataTables.min.js"></script>
	<script src="../../assets/assets/dataTables.buttons.min.js"></script>
	<script src="../../assets/assets/jszip.min.js"></script>
	<script src="../../assets/assets/pdfmake.min.js"></script>
	<script src="../../assets/assets/vfs_fonts.js"></script>
	<script src="../../assets/assets/buttons.html5.min.js"></script>
	<script type="text/javascript">
		var today = new Date();
		var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
    	dd = '0' + dd;
    }
    if (mm < 10) {
    	mm = '0' + mm;
    }
    today = yyyy + '-' + mm + '-' + dd;
    var hr = new Date();
    var time = hr.getHours() + ":" + hr.getMinutes() + ":" + hr.getSeconds();
    var datetime = today+" "+time;
    $(document).ready(function () {
    	$('#example2').dataTable({
    		dom: 'Bfrtip',
    		buttons: [{
    			extend: 'excel',
    			text: 'Excel',
    			className: 'exportExcel',
    			filename: 'Equipment Timestamp_'+datetime,
    			exportOptions: { modifier: { page: 'all'} }
    		}]
    	});

    });
</script>
<style type="text/css">
body {
	background-image: url("../../assets/images/patterns/noisy_net.png");
}
</style>
</head>
<body>
	<center>
		<section class="panel" style="background-color: #ffffff;width: 90%;padding: 10px">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
				</div>
				<h2 class="panel-title">Equipment Timestamp</h2>
			</header>
			<div class="panel-body">
				<table class="table table-bordered table-striped mb-none" id="example2">
					<thead>
						<tr>
							<th>Equipment</th>
							<th>Timestamp</th>
							<th>Status</th>
							<th>Request No#</th>
							<th>Hours Worked</th>
							<th>Remarks</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1;
						$time="";
						foreach ($equipment_timestamp as $row):
							if ($row['status'] == "working") {
								$time = $row['work_started'];
							}else if($row['status'] == "stopped"){
								$time = $row['work_stopped'];
							}else if($row['status'] == "resumed"){
								$time = $row['work_resumed'];
							}else if($row['status'] == "completed"){
								$time = $row['work_completed'];
							}else{
								$time ="";
							}
							?>
							<tr class="user_<?= $row['id']?>">
								<td><?= $row['eqpt_name'] ?></td>
								<td><?= $time ?></td>
								<td><?= $row['status'] ?></td>
								<td><?= $row['request_no'] ?></td>
								<td><?= $row['total_time'] ?></td>
								<td><?= $row['reason'] ?></td>
							</tr>
							<?php $i++; 
						endforeach ?>
					</tbody>
				</table>
			</div>
		</section>
	</center>
</body>
</html>
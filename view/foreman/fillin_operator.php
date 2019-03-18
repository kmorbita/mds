<?php 
if (isset($_GET['page']) && isset($_GET['mp_id']) != null && isset($_GET['eq_code']) != null && $_GET['page'] == "fillin_operator") {
	$mp_id = $_GET['mp_id'];
	$eq_code = $_GET['eq_code'];
	$no_eqpt = $_GET['no_eqpt'];
	$req = $_GET['req'];
	$res = $controller->toAssigned_optr($mp_id);
}
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">Fillin Operator</h2>
	</header>
	<div class="panel-body">
		<input type="hidden" id="no_eq" value="<?= $no_eqpt ?>">
		<input type="hidden" id="eqpt_id" value="<?= $eq_code ?>">
		<input type="hidden" id="req_no" value="<?= $req ?>">
		<table class="table table-bordered table-striped mb-none" id="datatable-default">									
			<thead>
				<tr>
					<th>No#</th>
					<th>Employee ID</th>
					<th>Employee Name</th>
					<th>Select</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1;
				$i=1;
				foreach($res as $row): ?>
					<tr class="gradeX eqptadd_<?= $row['id'] ?>">
						<td><?= $i  ?></td>
						<td><?= $row['emp_id'] ?></td>
						<td><?= $row['fname']." ".$row['mname']." ".$row['lname'] ?></td>
						<td class="center"><button type="button" class="btn btn-default btn-xs fa fa-plus" onclick="add_emp_optr('<?= $row['id'] ?>')"></button></td>
					</tr>
					<?php
					$i++; 
				endforeach ?>
			</tbody>
		</table>

		<div class="modal fade" id="modalFull" role="dialog">
			<div class="modal-dialog modaldialog">

				<!-- Modal content-->
				<div class="modal-content modalcontent">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Job Order Request Details</h4>
					</div>
					<div class="modal-body">
						<div id="job_display"></div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="modal fade" id="status" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Job Status</h4>
					</div>
					<div class="modal-body">
						<input type="text" id="request_no">
						<div class="form-group">
							
							<label>Status</label>
							<select data-plugin-selectTwo class="form-control input populate" id="status_code">
								<option></option>
								<option value="cancelled">Cancelled</option>
								<option value="closed">Closed</option>
							</select>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" id="submit_status">Submit</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
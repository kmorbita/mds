<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">Equipments</h2>
	</header>
	<div class="panel-body">
		<!-- <a class="mb-xs mt-xs mr-xs modal-sizes btn btn-default" href="#modalFull"> -->
			<!-- </a> -->
			<table class="table table-bordered table-striped mb-non" style="width:100%" id="example">									
				<thead>
					<tr>
						<th>No#</th>
						<th>Equipment Code</th>
						<th>Equipment Name</th>
						<th>Equipment Type</th>
						<th>Status</th>
						<th>Reason</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i=1;
					foreach($equipment as $row): 
						?>
						<tr class="gradeX">
							<td><?= $i ?></td>
							<td><?= $row['eqpt_code'] ?></td>
							<td><?= $row['eqpt_name'] ?></td>
							<td><?= $row['eqpt_type'] ?></td>
							<td><?= $row['status'] ?></td>
							<td><?= $row['reason'] ?></td>
						</tr>

						
						<?php
						$i++;
					endforeach ?>
				</tbody>
			</table>
			<div class="modal fade" id="modalFull" role="dialog">
				<div class="modal-dialog">
					
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">New Equipment</h4>
						</div>
						<div class="modal-body">
							<!-- <form> -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Manpower</label><b><span class="color-text" id="mp_name_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="mp_name" class="form-control" id="mp_name" value="sdsd" required/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Manpower Code</label><b><span class="color-text" id="mp_code_error"></span></b>
									<div class="col-sm-9">
										<input type="text" name="mp_code" class="form-control" id="mp_code" value="sdsd" required/>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-info btn-sm" id="submit_mp">Save</button>
									<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</section>
<?php 
		// get request number
if (isset($_GET['page']) && isset($_GET['req_no']) && $_GET['page'] == "editform") {
	$req = $controller->edit($_GET['req_no']);
	$reqcomm = $controller->editcomm($_GET['req_no']);
	$reqeqpt = $controller->editeqpt($_GET['req_no']);
	$reqmp = $controller->editmp($_GET['req_no']);
	$reqcargo = $controller->editcargo($_GET['req_no']);
}else {
	$req = 0;
}
		// get request number
?>
<section class="panel">
	<header class="panel-heading">
		<h2 class="panel-title" align="center">Job Order Request</h2>
	</header>
	<div class="panel-body">
		<section class="panel">
			<div class="panel-body">
				<form class="form-horizontal form-bordered" action="#">				<div class="col-md-12" align="left">
					<div class="col-md-2">
						<img src="../../assets/images/DICT.jpg">
					</div>
					<div class="col-md-10">
						DAVAO INTERNATIONAL CONTAINER TERMINAL<br>
						BRGY. SAN PEDRO, PANABO CITY
					</div>
					<div class="col-md-12">
						<hr>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="hidden" id="encoder" value="<?= $_SESSION['username'] ?>">
								<label>REQUESTOR</label><b><span class="color-text" id="requestor_error"></span></b>
								<input type="text" class="form-control input" id="requestor" name="requestor" value="<?= $req['requestor'] ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>REQUEST NO</label><b><span class="color-text" id="requestno_error"></span></b>
								<input type="text" class="form-control input" id="requestno" name="requestno" value="<?= $req['request_no'] ?>" readonly>
								<input type="hidden" name="hid_requestno" value="<?= $req ?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>ADDRESS</label><b><span class="color-text" id="address_error"></span></b>
								<input type="text" class="form-control input" id="address" name="address" value="<?= $req['address'] ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>REQUEST DATE</label><b><span class="color-text" id="requestdate_error"></span></b>
								<input type="date" class="form-control input" id="requestdate" name="requestdate" value="<?= $req['requestdate'] ?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>JOB CODE</label><b><span class="color-text" id="jobcode_error"></span></b>
								<!-- <input type="text" class="form-control input" id="jobcode" name="jobcode"> -->
								<select class="form-control input populate jobcode" id="jobcode">
									<option></option>
									<?php foreach($job_code as $row): ?>
										<option value="<?= $row['description'] ?>" <?php if($req['jobcode'] ==  $row['description']) echo 'selected="selected"' ?>><?= $row['description'] ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>DESCRIPTION</label><b><span class="color-text" id="description_error"></span></b>
								<input type="text" class="form-control input" id="description" name="description" value="<?= $req['jobdescription'] ?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>JOB DATE</label><b><span class="color-text" id="jobdate_error"></span></b>
								<input type="date" class="form-control input" id="jobdate" name="jobdate" value="<?= $req['jobdate'] ?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>JOB LOCATION</label><b><span class="color-text" id="joblocation_error"></span></b>
								<input type="text" class="form-control input" id="joblocation" name="joblocation" value="<?= $req['joblocation'] ?>">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>ESTIMATED TIME TO COMPLETE</label><b><span class="color-text" id="est_error"></span></b>
								<input type="text" class="form-control input" id="est" name="est" value="<?= $req['est'] ?>">
							</div>
						</div>
					</div>
					<br>
					<div class="col-md-12">
						<div class="tabs">
							<ul class="nav nav-tabs nav-justified">
								<li class="active">
									<a href="#cargo" data-toggle="tab" class="text-center">Cargo Details</a>
								</li>
								<li>
									<a href="#equipment" data-toggle="tab" class="text-center">Equipment</a>
								</li>
								<li>
									<a href="#manpower" data-toggle="tab" class="text-center">Manpower</a>
								</li>
							</ul>
							<div class="tab-content">
								<div id="cargo" class="tab-pane active">
									<div class="form-group">
										<div class="col-md-4">
											<center>CARRIER</center>
											<div class="form-group">
												<label>VESSEL</label><b><span class="color-text" id="vessel_error"></span></b>
												<input type="text" class="form-control input" id="vessel" name="vessel" value="<?= $reqcargo['vessel'] ?>">
											</div>
											<div class="form-group">
												<label>VOYAGE</label><b><span class="color-text" id="voyage_error"></span></b>
												<input type="text" class="form-control input" id="voyage" name="voyage" value="<?= $reqcargo['voyage'] ?>">
											</div>
											<div class="form-group">
												<label>VAN#</label><b><span class="color-text" id="vanno_error"></span></b>
												<input type="text" class="form-control input" id="vanno" name="vanno" value="<?= $reqcargo['van_no'] ?>">
											</div>
											<div class="form-group">
												<label>TRUCK#</label><b><span class="color-text" id="truckno_error"></span></b>
												<input type="text" class="form-control input" id="truckno" name="truckno" value="<?= $reqcargo['truck_no'] ?>">
											</div>
											<div class="form-group">
												<label>HATCH#</label><b><span class="color-text" id="hatchno_error"></span></b>
												<input type="text" class="form-control input" id="hatchno" name="hatchno" value="<?= $reqcargo['hatch_no'] ?>">
											</div>
											<div class="form-group">
												<label>DECK#</label><b><span class="color-text" id="deckno_error"></span></b>
												<input type="text" class="form-control input" id="deckno" name="deckno" value="<?= $reqcargo['deck_no'] ?>">
											</div>
											<div class="form-group">
												<label>TRUCK TYPE</label><b><span class="color-text"></span></b>
												<select data-plugin-selectTwo class="form-control input populate" id="trk_type">
													<option></option>
													<?php foreach($truck_type as $row): ?>
														<option value="<?= $row['name'] ?>"<?php if($reqcargo['trk_type'] ==  $row['name']) echo 'selected="selected"' ?>><?= $row['name'] ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
										<div class="col-md-7">
											<center>COMMODITIES</center>
											<div class="form-group">
												<label>SHIPPER</label><b><span class="color-text" id="shipper_error"></span></b>
												<input type="text" class="form-control input" id="shipper" name="shipper">
												<span style="color: red;" id="shipperError"></span>
											</div>

											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label>COMMODITY</label><b><span class="color-text" id="commodity_error"></span></b>
														<input type="text" class="form-control input" id="commodity" name="commodity">
														<span style="color: red;" id="commodityError"></span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>QTY</label><b><span class="color-text" id="qty_error"></span></b>
														<input type="number" class="form-control input" id="qty" name="qty">
														<span style="color: red;" id="qtyError"></span>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Box Type</label><b><span class="color-text" id="box_error"></span></b>
														<!-- <input type="number" class="form-control input" id="unit" name="unit" value="1"> -->
														<select data-plugin-selectTwo class="form-control input populate" id="box">
															<option></option>
															<?php foreach($box_type as $row): ?>
																<option value="<?= $row['id'] ?>"><?= $row['type'] ?></option>
															<?php endforeach ?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Weight Per Box</label><b><span class="color-text" id="weight_error"></span></b>
														<!-- <input type="number" class="form-control input" id="unit" name="unit" value="1"> -->
														<select data-plugin-selectTwo class="form-control input populate" id="weight">
															<option></option>
															<?php foreach($weight_per_box as $row): ?>
																<option value="<?= $row['id'] ?>"><?= $row['weight'] ?></option>
															<?php endforeach ?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>UNIT</label><b><span class="color-text" id="unit_error"></span></b>
														<!-- <input type="number" class="form-control input" id="unit" name="unit"> -->
														<select data-plugin-selectTwo class="form-control input populate" id="unit">
															<option></option>
															<?php foreach($units as $row): ?>
																<option value="<?= $row['id'] ?>"><?= $row['type'] ?></option>
															<?php endforeach ?>
														</select>
														<span style="color: red;" id="unitError"></span>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-10">
													<div class="form-group">
														<label>DESTINATION</label><b><span class="color-text" id="destination_error"></span></b>
														<input type="text" class="form-control input" id="destination" name="destination">
														<span style="color: red;" id="destinationError"></span>
													</div>
												</div>
												<div class="col-md-2">
													<!-- <div class="form-group"> --><br>
														<button class="btn btn-info btn-sm" type="button" id="edit_comm">ADD</button>
														<!-- </div> -->
													</div>

												</div>
												<div class="form-group">
													<table class="table table-striped" id="datatable-def1">
														<thead>
															<tr>
																<th>Shipper</th>
																<th>Commodity</th>
																<th>Qty</th>
																<th>Unit</th>
																<th>Destination</th>
																<th>Delete</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach($reqcomm as $row): ?>
																<tr>
																	<td><?= $row['shipper'] ?></td>
																	<td><?= $row['commodity'] ?></td>
																	<td><?= $row['qty'] ?></td>
																	<td><?= $row['type'] ?></td>
																	<td><?= $row['destination'] ?></td>
																	<td><button type="button" class="btn btn-danger btn-sm" onclick="del_comm('<?= $row['id'] ?>')"><i class="fa fa-trash-o"></i></button></td>
																</tr>
															<?php endforeach ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div id="equipment" class="tab-pane">
										<form class="form-horizontal form-bordered" action="#">
											<div class="form-group">
												<div class="col-md-12">
													<h5>EQUIPMENTS</h5>
													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label>EQ CODE</label><b><span class="color-text" id="eq_code_error"></span></b>
																<select data-plugin-selectTwo class="form-control input populate" id="eq_code">
																	<option></option>
																	<?php foreach($equipment_type as $row): ?>
																		<option value="<?= $row['id'] ?>"><?= $row['eqpt_type'] ?></option>
																	<?php endforeach ?>
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label>NO. OF EQPT.</label><b><span class="color-text" id="no_of_eqpt_error"></span></b>
																<input type="number" class="form-control input" id="no_of_eqpt" name="no_of_eqpt">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label>W/ OPTR</label><b><span class="color-text" id="w_optr_error"></span></b>
																<select data-plugin-selectTwo class="form-control input populate" id="w_optr">
																	<option></option>
																	<option value="1">YES</option>
																	<option value="0">NO</option>
																</select>
															</div>
														</div>
														<div class="col-md-3">
															<!-- <div class="form-group"> --><br>
																<button class="btn btn-info btn-sm" type="button" id="edit_eqpt">ADD</button>
																<!-- </div> -->
															</div>
														</div>
														<div class="form-group">
															<table class="table table-striped" id="datatable-def2">
																<thead>
																	<tr>
																		<th>Equipment Code</th>
																		<th>No. of Equipment</th>
																		<th>W/ Operator</th>
																		<th>Delete</th>
																	</tr>
																</thead>
																<tbody>
																	<?php foreach($reqeqpt as $row): 
																		if ($row['no_optr'] == "1") {
																			$row['no_optr'] = "YES";
																		}else{
																			$row['no_optr'] = "NO";
																		}

																		?>
																		<tr>
																			<td><?= $row['eqpt_type'] ?></td>
																			<td><?= $row['no_eqpt'] ?></td>
																			<td><?= $row['no_optr'] ?></td>
																			<td><button type="button" class="btn btn-danger btn-sm" onclick="del_eqpt('<?= $row['id'] ?>')"><i class="fa fa-trash-o"></i></button></td>
																		</tr>
																	<?php endforeach ?>
																</tbody>
															</table>
														</div><br><br>
													</div>	
												</div>
											</form>
										</div>
										<div id="manpower" class="tab-pane">
											<form class="form-horizontal form-bordered" action="#">
												<div class="form-group">
													<div class="col-md-12">
														<h5>MANPOWERS</h5>
														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label>MP CODE</label><b><span class="color-text" id="mp_code_error"></span></b>
																	<select data-plugin-selectTwo class="form-control input populate" id="mp_code">
																		<option></option>
																		<?php foreach($manpower as $row): ?>
																			<option value="<?= $row['id'] ?>"><?= $row['mp_name'] ?> - (<?= $row['code'] ?>)</option>
																		<?php endforeach ?>
																	</select>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label>NO. OF MANPOWER</label><b><span class="color-text" id="nos_error"></span></b>
																	<input type="number" class="form-control input" id="nos">
																</div>
															</div>
															<div class="col-md-4">
																<!-- <div class="form-group"> --><br>
																	<button class="btn btn-info btn-sm" type="button" id="edit_mp1">ADD</button>
																	<!-- </div> -->
																</div>
															</div>
															<div class="form-group">
																<table class="table table-striped" id="datatable-def3">
																	<thead>
																		<tr>
																			<th>Manpower Code</th>
																			<th>No. of Manpower</th>
																			<th>Delete</th>
																		</tr>
																	</thead>
																	<tbody>
																		<?php foreach($reqmp as $row): ?>
																			<tr>
																				<td><?= $row['mp_name'] ?></td>
																				<td><?= $row['nos'] ?></td>
																				<td><button type="button" class="btn btn-danger btn-sm" onclick="del_mp2('<?= $row['id'] ?>')"><i class="fa fa-trash-o"></i></button></td>
																			</tr>
																		<?php endforeach ?>
																	</tbody>
																</table>
															</div><br><br>
															
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group" align="center">
										<button class="btn btn-info btn-sm" type="button" id="edit_req_cargo">SUBMIT</button>
										<button class="btn btn-info btn-sm" id="clear_all" type="button">CLEAR ALL</button>
										<button type="button" class="btn btn-info btn-sm" onclick="location.href='index.php'">FINISH</button>
										<!-- <a href="index.php"><button class="btn btn-info bnt-sm">HOME</button></a> -->
									</div>
								</div>
							</div>
						</form>
					</div>
					
				</section>
			</div>
		</section>
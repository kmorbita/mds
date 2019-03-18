<?php 
if (isset($_GET['page']) && isset($_GET['req_no']) != null) {
	$id = $_GET['req_no'];
	$task = $controller->task($id);
}
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalFull">New</button>
			<?= $id ?>
			<a href="#" class="fa fa-caret-down"></a>
		</div>

		<h2 class="panel-title">Tasks</h2>
	</header>
	<div class="panel-body">
		<input type="hidden" id="task_id" value="<?= $id ?>">
		<input type="hidden" id="username" value="<?= $_SESSION['username'] ?>">
		<table class="table table-bordered table-striped mb-none" id="datatable-default">
			<thead>
				<tr>
					<th>No#</th>
					<th>Job Request No#</th>
					<th>Tasks</th>
					<th>Task For</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1;
				foreach ($task as $row):?>
					<tr class="task_<?= $row['id']?>">
						<td><?= $i ?></td>
						<td><?= $row['request_no'] ?></td>
						<td><?= $row['task'] ?></td>
						<td><?= $row['task_for'] ?></td>
						<td><a href="?page=edittask&task_id=<?= $row['id']?>&req=<?= $id ?>"><button type="button" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></button></a>|<button type="button" class="btn btn-default btn-sm" onclick="return confirm('Are you sure?')?del_task('<?= $row['id'] ?>'):'';"><i class="fa fa-trash-o"></i></button></td>
					</tr>
					<?php $i++; 
				endforeach ?>
			</tbody>
		</table>
		<div class="modal fade" id="modalFull" role="dialog">
			<div class="modal-dialog">
				
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">New Task</h4>
					</div>
					<div class="modal-body">
						<!-- <form> -->
							<div class="form-group">
								<label class="col-sm-3 control-label">Task</label><b><span class="color-text" id="task_error"></span></b>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="task" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Task for</label><b><span class="color-text" id="task_for_error"></span></b>
								<div class="col-sm-9">
									<select data-plugin-selectTwo id="task_for" class="form-control populate">
										<option></option>
										<option>Personnel</option>
										<option>Equipment</option>
									</select>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-info btn-sm" id="submit_task">Save</button>
								<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
		</div>
	</section>
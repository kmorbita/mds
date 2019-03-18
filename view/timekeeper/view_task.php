<?php 
if (isset($_GET['page']) && isset($_GET['req_no']) != null) {
	$id = $_GET['req_no'];
	$task = $controller->task($id);
}
?>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
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
					</tr>
					<?php $i++; 
				endforeach ?>
			</tbody>
		</table>	
	</div>
</section>
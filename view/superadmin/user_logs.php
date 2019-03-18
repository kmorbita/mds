<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<button type="button" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#modalFull">New</button>
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">User Login & Logout logs</h2>
	</header>
	<div class="panel-body">
		<table class="table table-striped table-no-more table-bordered  mb-none" id="datatable-default">
			<thead>
				<tr>
					<th><span class="text-normal text-sm">Type</span></th>
					<th><span class="text-normal text-sm">User</span></th>
					<th><span class="text-normal text-sm">Role</span></th>
					<th><span class="text-normal text-sm">Date</span></th>
					<th><span class="text-normal text-sm">Action</span></th>
				</tr>
			</thead>
			<tbody class="log-viewer">
				<?php 
					foreach($user_log as $row): 
				?>
					<tr class="userlog_<?= $row['id'] ?>">
						<td data-title="Type" class="pt-md pb-md">
							<i class=" fa-fw text-muted text-md va-middle"></i> <?= $row['type'] ?>
						</td>
						<td class="pt-md pb-md">
							<?= $row['username'] ?>
						</td>
						<td class="pt-md pb-md">
							<?= $row['role'] ?>
						</td>
						<td data-title="Date" class="pt-md pb-md">
							<?= $row['date'] ?>
						</td>
						<td>
							<button type="button" class="btn btn-sm btn-default fa fa-trash-o" onclick="del_log('<?= $row['id'] ?>')"></button>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</section>
<section class="panel">
	<header class="panel-heading">
		<div class="panel-actions">
			<a href="#" class="fa fa-caret-down"></a>
			<!-- <a href="#" class="fa fa-times"></a> -->
		</div>
		
		<h2 class="panel-title">Dispatched Operator</h2>
	</header>
	<div class="panel-body">
		<table class="table table-bordered table-striped mb-none" id="datatable-default">									
			<thead>
				<tr>
					<th>No#</th>
					<th>Request No#</th>
					<th>Name</th>
					<th>Status</th>
					<th>Dispatched Date</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				foreach ($dispatched_optr as $val): ?>
					<tr>
						<td><?= $i  ?></td>
						<td><?= $val['request_no'] ?></td>
						<td><?= $val['fname']." ".$val['mname']." ".$val['lname']  ?></td>
						<td><?= $val['status'] ?></td>
						<td><?= $val['created_at'] ?></td>
					</tr>
				<?php 
				$i++;
			endforeach ?>
			</tbody>
		</table>
	</section>
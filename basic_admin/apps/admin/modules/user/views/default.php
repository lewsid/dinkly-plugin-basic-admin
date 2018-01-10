<div class="container mt-4">
	<?php include($_SERVER['APPLICATION_ROOT'] . 'plugins/basic_admin/apps/admin/layout/messaging.php'); ?>

	<h2>Users <a href="/admin/user/new/" class="btn btn-primary float-right">Create User</a></h2>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<?php if($users != array()): ?>
				<table cellpadding="0" cellspacing="0" border="0"  class="table table-striped table-bordered dinkly-datatable" id="user-list">
					<thead>
						<tr>
							<th>Username</th>
							<th>Created</th>
							<th>Last Login</th>
							<th>Login Count</th>
							<th class="no-sort">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($users as $pos => $user): ?>
							<tr class="<?php echo ($pos % 2 == 0) ? 'odd' : 'even'; ?>">
								<td><?php echo $user->getUsername(); ?></td>
								<td><?php echo $user->getCreatedAt($date_format); ?></td>
								<td><?php echo $user->getLastLoginAt($date_format); ?></td>
								<td><?php echo $user->getLoginCount(); ?></td>
								<td><a href="/admin/user/detail/id/<?php echo $user->getId(); ?>">view</a></td>
							</tr> 
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				No users to display
			<?php endif; ?>
		</div>
	</div>
</div>
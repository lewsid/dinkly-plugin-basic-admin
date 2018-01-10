<div class="container mt-4">
	<?php include($_SERVER['APPLICATION_ROOT'] . 'plugins/basic_admin/apps/admin/layout/messaging.php'); ?>

	<h2>Admin Dashboard</h2>
	<hr>
	<div class="row">
		<div class="col-md-4">
			<ul class="list-group">
				<li class="list-group-item d-flex justify-content-between align-items-center">
					Total Users
					<span class="badge badge-dark badge-pill"><?php echo $total_users; ?></span>
				</li>
				<li class="list-group-item d-flex justify-content-between align-items-center">
					Locked Accounts
					<span class="badge badge-dark badge-pill"><?php echo $locked_accounts; ?></span>
				</li>
				<li class="list-group-item d-flex justify-content-between align-items-center">
					Logins Today
					<span class="badge badge-dark badge-pill"><?php echo $logins_today; ?></span>
				</li>
			</ul>
		</div>
	</div>
</div>
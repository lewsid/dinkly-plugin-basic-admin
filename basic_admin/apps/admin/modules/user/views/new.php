<div class="container mt-4 mb-4">
	<?php include($_SERVER['APPLICATION_ROOT'] . 'plugins/basic_admin/apps/admin/layout/messaging.php'); ?>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/admin/user/">Users</a></li>
			<li class="breadcrumb-item active" aria-current="page">Create User</li>
		</ol>
	</nav>

	<h2>New User</h2>
	<hr>
	<div class="row">
		<div class="col-md-8">
			<?php include('form_user.php'); ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.btn-cancel-user').click(function() {
			window.location = "/admin/user/";
		});
	});
</script>
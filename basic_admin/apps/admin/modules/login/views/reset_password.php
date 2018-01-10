<div class="container-fluid viewport-height">
	<div class="row align-items-center viewport-height">
		<div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3">
			<h1>Reset Password</h1>
			<p>Please set a new password</p>
			
			<?php if(DinklyFlash::exists('reset_error')): ?>
				<div class="alert alert-danger">
					<?php echo DinklyFlash::get('reset_error'); ?>
					<button type="button" class="close message-close" aria-hidden="true">&times;</button>
				</div>
			<?php endif; ?>

			<?php if(DinklyFlash::exists('reset_success')): ?>
				<div class="alert alert-success">
					<?php echo DinklyFlash::get('reset_success'); ?>
				</div>
			<?php endif; ?>

			<div>
				<form class="form-inline" action="" method="post">
					<div class="form-group">
						<input placeholder="Enter new password" id="password" name="password" type="password" class="form-control mb-2 mr-sm-2">
					</div>
					<div class="form-group">
						<input placeholder="Confirm password" id="password-confirm" name="password-confirm" type="password" class="form-control mb-2 mr-sm-2">
					</div>
					<button type="submit" class="btn btn-primary form-control mb-2 mr-sm-2">Change Password</button>
				</form>
			</div>
		</div>
	</div>
</div>
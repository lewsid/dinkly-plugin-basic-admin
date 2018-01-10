<div class="container-fluid viewport-height">
	<div class="row align-items-center viewport-height">
		<div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
			<?php if(DinklyFlash::exists('reset_success')): ?>
				<div class="alert alert-success">
					<?php echo DinklyFlash::get('reset_success'); ?>
				</div>
			<?php endif; ?>
			<?php if(DinklyFlash::exists('invalid_login')): ?>
				<div class="alert alert-danger">
					<?php echo DinklyFlash::get('invalid_login'); ?>
					<button type="button" class="close message-close" aria-hidden="true">&times;</button>
				</div>
			<?php endif; ?>
			<div class="card">
				<h4 class="card-header">Admin Access</h4>
				<div class="card-body">
					<form method="post" action="">
						<div class="form-group">
							<label for="username">Email</label>
							<div class="controls">
								<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<div class="controls">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Login</button>
							<a class="btn btn-link forgot-password" href="/admin/login/forgot_password">Forgot your password?</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
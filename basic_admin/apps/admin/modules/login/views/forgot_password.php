<div class="container-fluid viewport-height">
	<div class="row align-items-center viewport-height">
		<div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
			<h1>Forget your password?</h1>
			<p>Enter your email address to start recovery</p>
			
			<?php if(DinklyFlash::exists('request_error')): ?>
				<div class="alert alert-danger">
					<?php echo DinklyFlash::get('request_error'); ?>
					<button type="button" class="close message-close" aria-hidden="true">&times;</button>
				</div>
			<?php endif; ?>

			<?php if(DinklyFlash::exists('request_success')): ?>
				<div class="alert alert-success">
					<?php echo DinklyFlash::get('request_success'); ?>
				</div>
			<?php endif; ?>

			<div>
				<form class="form-inline" action="" method="post">
					<input id="email" name="email" type="text" class="form-control mb-2 mr-sm-2" placeholder="Enter Email Address">
					<button type="submit" class="btn btn-primary mb-2">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
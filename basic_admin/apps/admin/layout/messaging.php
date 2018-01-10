<?php if(DinklyFlash::exists('good_user_message')): ?>
	<div class="alert alert-success">
		<?php echo DinklyFlash::get('good_user_message'); ?>
		<button type="button" class="close message-close" aria-hidden="true">&times;</button>
	</div>
<?php endif; ?>
<?php if(DinklyFlash::exists('error')): ?>
	<div class="alert alert-danger">
		<?php echo DinklyFlash::get('error'); ?>
		<button type="button" class="close message-close" aria-hidden="true">&times;</button>
	</div>
<?php endif; ?>
<?php if(DinklyFlash::exists('errors')): ?>
	<div class="alert alert-danger">
		<?php foreach(DinklyFlash::get('errors') as $error): ?>
			<?php echo $error; ?>
		<?php endforeach; ?>
		<button type="button" class="close message-close" aria-hidden="true">&times;</button>
	</div>
<?php endif; ?>
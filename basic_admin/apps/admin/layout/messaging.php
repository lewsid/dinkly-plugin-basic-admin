<?php if(DinklyFlash::exists('good_user_message')): ?>
	<div class="alert alert-success">
		<button type="button" class="close message-close" aria-hidden="true">&times;</button>
		<?php echo DinklyFlash::get('good_user_message'); ?>
	</div>
<?php endif; ?>
<?php if(DinklyFlash::exists('error')): ?>
	<div class="alert alert-danger">
		<button type="button" class="close message-close" aria-hidden="true">&times;</button>
		<?php echo DinklyFlash::get('error'); ?>
	</div>
<?php endif; ?>
<?php if(DinklyFlash::exists('errors')): ?>
    <div class="alert alert-danger">
    	<button type="button" class="close message-close" aria-hidden="true">&times;</button>
        <ul>
            <?php foreach(DinklyFlash::get('errors') as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
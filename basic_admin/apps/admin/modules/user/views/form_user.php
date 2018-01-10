<form role="form" action="" method="post" id="user-form">	  
	<div class="form-group">
		<label class="col-sm-4" for="username">Email</label>
		<div class="col-md-7">
			<input required="required" maxlength="64" value="<?php echo $user->getUsername(); ?>" type="email" class="form-control" id="username" name="username">
			<small class="form-text text-muted">Must be a valid email address</small>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4" for="password">Password</label>
		<div class="col-md-7">
			<input <?php echo ($this->getCurrentModule() == 'new') ? 'required="required"' : ''; ?> maxlength="1024" placeholder="************" type="password" class="form-control" id="password" name="password">
			<small class="form-text text-muted">Must be at least 8 characters long</small>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4" for="confirm-password">Confirm Password</label>
		<div class="col-md-7">
			<input maxlength="1024" placeholder="************" type="password" class="form-control" id="confirm-password" name="confirm-password">
			<p id="password-match-error" class="text-danger" style="display: none;">Passwords do not match</p>
		</div>
	</div>
	<div class="form-group">
		<label for="first-name" class="col-sm-4">First Name</label>
		<div class="col-md-7">
			<input required="required" maxlength="24" value="<?php echo $user->getFirstName(); ?>" type="text" class="form-control" id="first-name" name="first-name">
		</div>
	</div>
	<div class="form-group">
		<label for="last-name" class="col-sm-4">Last Name</label>
		<div class="col-md-7">
			<input maxlength="24" value="<?php echo $user->getLastName(); ?>" type="text" class="form-control" id="last-name" name="last-name">
		</div>
	</div>
	<div class="form-group">
		<label for="title" class="col-sm-4">Title</label>
		<div class="col-md-7">
			<input maxlength="128" value="<?php echo $user->getTitle(); ?>" type="text" class="form-control" id="title" name="title">
		</div>
	</div>
	<div class="form-group edit-user-controls">
		<label for="btn-create-user" class="col-sm-4"></label>
		<div class="col-md-7">
			<hr>
			<button type="submit" class="btn btn-primary btn-save-user float-right">Save User</button>
			<button type="button" class="btn btn-link btn-cancel-user" data-dismiss="modal">Cancel</button>
		</div>
	</div>
	<input type="hidden" name="user-id" id="user-id" value="<?php echo $user->getId(); ?>">
	<input type="hidden" name="source" value="<?php echo $this->getCurrentModule(); ?>">
</form>

<script type="text/javascript">
	$(document).ready(function() {
		$('#username').val('<?php echo $user->getUsername(); ?>');
		$('#first_name').val('<?php echo $user->getFirstName(); ?>');
		$('#last_name').val('<?php echo $user->getLastName(); ?>');
		$('#title').val('<?php echo $user->getTitle(); ?>');

		$('#user-form').submit(function() {
			if(($('#password').val() != $('#confirm-password').val()) && $('#password').val().length > 0) {
				$('#password').parents('.form-group').addClass('has-error');
				$('#confirm-password').parents('.form-group').addClass('has-error');
				$('#password-match-error').show();
				return false
			}
			else {
				$('#password').parents('.form-group').removeClass('has-error');
				$('#confirm-password').parents('.form-group').removeClass('has-error');
				$('#password-match-error').hide();
			}

			return true;
		});
	});
</script>
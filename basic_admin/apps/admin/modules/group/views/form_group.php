<form class="form-horizontal" role="form" action="" method="post" id="group-form">	  
	<div class="form-group">
		<label class="col-sm-3 for="name">Name</label>
		<div class="col-md-5">
			<input required="required" maxlength="100" value="<?php echo $group->getName(); ?>" type="text" class="form-control" id="name" name="name">
		</div>
	</div>	
	<div class="form-group">
		<label class="col-sm-3 for="abbreviation">Abbreviation</label>
		<div class="col-md-5">
			<input maxlength="25" value="<?php echo $group->getAbbreviation(); ?>" type="text" class="form-control" id="abbreviation" name="abbreviation">
			<small class="form-text text-muted">Cannot contain whitespace. Must be alphanumeric. Dashes and underscores allowed.</small>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-3 for="description">Description</label>
		<div class="col-md-7">
			<textarea class="form-control" id="description" name="description"><?php echo $group->getDescription(); ?></textarea>
		</div>
	</div>
	<div class="form-group edit-group-controls">
		<label for="btn-create-group" class="col-sm-3"></label>
		<div class="col-md-7">
			<hr>
			<button type="submit" class="btn btn-primary btn-save-group float-right">Save</button>
			<button type="button" class="btn btn-link btn-cancel-group" data-dismiss="modal">Cancel</button>
		</div>
	</div>
	<input type="hidden" name="group-id" id="group-id" value="<?php echo $group->getId(); ?>">
</form>

<script type="text/javascript">
$(document).ready(function() {
	$('#name').val('<?php echo $group->getName(); ?>');
	$('#abbreviation').val('<?php echo $group->getAbbreviation(); ?>');
});
</script>
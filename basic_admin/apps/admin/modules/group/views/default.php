<div class="container mt-4">
	<?php include($_SERVER['APPLICATION_ROOT'] . 'plugins/basic_admin/apps/admin/layout/messaging.php'); ?>

	<h2>Groups <button type="button" data-toggle="modal" data-target="#manage-permissions-modal" class="btn btn-link btn-manage-permissions">Manage Permissions</button><button type="button" class="btn btn-primary btn-create-group float-right">Create Group</button></h2>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<?php if($groups != array()): ?>
				<table cellpadding="0" cellspacing="0" border="0"  class="table table-striped table-bordered dinkly-datatable" id="user-list">
					<thead>
						<tr>
							<th>Name</th>
							<th>Abbreviation</th>
							<th>Members</th>
							<th class="no-sort">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($groups as $pos => $group): ?>
							<tr class="<?php echo ($pos % 2 == 0) ? 'odd' : 'even'; ?>">
								<td><?php echo $group->getName(); ?></td>
								<td><?php echo $group->getAbbreviation(); ?></td>
								<td><?php echo $group->getMemberCount(); ?></td>
								<td><a href="/admin/group/detail/id/<?php echo $group->getId(); ?>">view</a></td>
							</tr> 
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				There are no groups to display
			<?php endif; ?>
		</div>
	</div>
</div>

<div class="modal fade" id="manage-permissions-modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Manage Permissions</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger permission-error" style="display: none;">
					<div class="permission-error-message"></div>
					<button type="button" class="close message-close" aria-hidden="true">&times;</button>
				</div>
				<form class="form-inline" role="form" id="permission-form">
					<div class="form-group mr-1">
						<label class="sr-only" for="permission-name">Name</label>
						<input required="required" type="text" class="form-control" id="permission-name" name="permission-name" placeholder="Name">
					</div>
					<div class="form-group mr-1">
						<label class="sr-only" for="permission-description">Description</label>
						<input type="text" class="form-control" id="permission-description" name="permission-description" placeholder="Description">
					</div>
					<button type="submit" class="btn btn-primary btn-create-permission">Create Permission</button>
				</form>

				<hr>

				<div id="permissions-table"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	$(document).ready(function() {
		function drawPermissionsTable() {
			$('#permissions-table').load('/admin/group/permission_table');
		}

		$('.btn-create-group').click(function() { 
			window.location = "/admin/group/new/";
			return true;
		});

		$('#permission-form').submit(function() {
			$.ajax({
				type: "POST",
				url: "/admin/group/create_permission/",
				data: { 
					permission_name: $('#permission-name').val(), 
					permission_description: $('#permission-description').val()
				},
				success: function(response) {
					if(response == 'success') { drawPermissionsTable(); }
					else {
						$('.permission-error-message').html(response);
						$('.permission-error').show();
					}
				}
			});

			return false;
		});

		drawPermissionsTable();
	}); 
</script>
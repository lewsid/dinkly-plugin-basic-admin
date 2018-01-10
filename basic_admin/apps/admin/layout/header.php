<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo Dinkly::getConfigValue('app_name', 'admin'); ?> v<?php echo Dinkly::getConfigValue('dinkly_version', 'global'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="/css/bootstrap.4.0.0-beta.3.min.css" rel="stylesheet">
	<link href="/css/fontawesome-all.5.0.3.min.css" rel="stylesheet">
	<link href="/css/datatables.1.10.16.combined.min.css" rel="stylesheet">
	<link href="/css/dinkly.3.27.css" rel="stylesheet">

	<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.4.0.0-beta.3.min.js"></script>
	<script type="text/javascript" src="/js/datatables.1.10.16.combined.min.js"></script>
	<script type="text/javascript" src="/js/dinkly.3.27.js"></script>

	<?php echo $this->getModuleHeader(); ?>
</head>
<body>
	<?php if(Dinkly::isDevMode()): ?>
		<!-- Handy Dev Mode Info Label -->
		<h3 class="dev-mode-indicator-label">
			<span class="badge badge-warning">
				Dev Mode
			</span>
		</h3>
		<h3 class="dev-mode-info-label">
			<span class="badge badge-info">
				<?php echo $this->getCurrentModule(); ?> -> <?php echo $this->getCurrentView(); ?>
			</span>
		</h3>
	<?php endif; ?>
	<?php if($this->getCurrentModule() != 'login'): ?>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="/admin/home">Dinkly Basic Admin</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<?php if(DinklyUser::isLoggedIn()): ?>
				<div class="collapse navbar-collapse" id="navbar">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item <?php echo (Dinkly::getCurrentModule() == 'home') ? 'active' : ''; ?>">
							<a class="nav-link" href="/admin/home">Home</a>
						</li>
						<li class="nav-item <?php echo (Dinkly::getCurrentModule() == 'user') ? 'active' : ''; ?>">
							<a class="nav-link" href="/admin/user">Users</a>
						</li>
						<li class="nav-item <?php echo (Dinkly::getCurrentModule() == 'group') ? 'active' : ''; ?>">
							<a class="nav-link" href="/admin/group">Groups</a>
						</li>
					</ul>
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="download" aria-expanded="false"><?php echo DinklyUser::getLoggedUsername(); ?></a>
							<div class="dropdown-menu" aria-labelledby="download">
								<a class="dropdown-item" href="/admin/profile">Edit Settings</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="/admin/login/logout">Logout</a>
							</div>
						</li>
					</ul>
				</div>
			<?php endif; ?>
		</nav>
	<?php endif; ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?= $data['judul']; ?></title>

	<!-- Bootstrap CSS CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- Our Custom CSS -->
	<link rel="stylesheet" href="<?= BASEURL; ?>/css/custom.css">

	<!-- Font Awesome JS -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
</head>

<body>

	<div class="wrapper">
		<!-- Sidebar Holder -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<a href="<?= BASEURL; ?>home">
					<h5>Travel Batang Kapas Bersatu</h5>
				</a>
			</div>
			<ul class="list-unstyled">
				<li>
					<a href="#proyekSubmenu" data-toggle="collapse" aria-expanded="false" aria-controls="proyekSubmenu" id="colapsButton" class="dropdown">Daftar Proyek
					</a>
					<div class="bg-secondary">
						<ul class="collapse list-unstyled text-white" id="proyekSubmenu">
							<li>
								<a href="<?= BASEURL; ?>proyek">Semua Proyek</a>
							</li>
							<?php for ($tahun = 2015; $tahun <= 2030; $tahun++) { ?>
								<li>
									<a href="<?= BASEURL; ?>proyek/Tahun/<?= $tahun ?>"><?php echo $tahun; ?></a>
								</li>
							<?php } ?>
						</ul>
					</div>
				</li>
			</ul>
		</nav>

		<!-- Page Content Holder -->
		<div id="content">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
					<button type="button" id="sidebarCollapse" class="navbar-btn">
						<span></span>
						<span></span>
						<span></span>
					</button>
					<ul class="nav navbar-nav flex-row">
						<!-- <li class="nav-item"><a class="nav-link pr-3" href="<?= BASEURL; ?>login/logout">Logout</a></li> -->
						<li class="nav-item">
							<a class="nav-link pr-3" id="logout-button">Logout</a>
						</li>
						<script>
							$('#logout-button').click(function() {
								$.ajax({
									url: '<?= BASEURL; ?>login/logout',
									type: 'POST',
									success: function() {
										window.location.href = '<?= BASEURL; ?>login';
									}
								});
							});
						</script>
					</ul>
				</div>
			</nav>
			<div class="container-content">
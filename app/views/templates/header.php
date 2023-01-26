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

<nav class="navbar navbar-expand navbar-light bg-light fixed-top">
	<div class="container-fluid">
		<img src="<?= BASEURL; ?>img/tbkb-no-text.png" alt="swap" class="home-button" style="width: 60px; height: 60px;">
		<span></span>
		<span></span>
		<span></span>
		<ul class="nav navbar-nav flex-row">
			<!-- <li class="nav-item"><a class="nav-link pr-3" href="<?= BASEURL; ?>login/logout">Logout</a></li> -->
			<li class="nav-item">

				<?php if (isset($_SESSION['tbkb_user_id'])) { ?>
					<div class="dropdown">
						<button type="button" class="btn btn-secondary" data-bs-toggle="dropdown" aria-expanded="false">
							<?= $_SESSION['tbkb_nama']; ?>
						</button>
						<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
							<li>
								<a class="dropdown-item home-button">Beranda</a>
							</li>
							<li>
								<a class="dropdown-item" id="orders-button">Pesanan Anda</a>
							</li>
							<li>
								<a class="dropdown-item" id="logout-button">Logout</a>
							</li>
						</ul>
					</div>
				<?php } else { ?>
					<a class="nav-link pr-3" id="login-button">Login</a>
				<?php } ?>
			</li>
			<script>
				$('#logout-button').click(function() {
					window.location.href = '<?= BASEURL; ?>user/logout';
				});
				$('#login-button').click(function() {
					window.location.href = '<?= BASEURL; ?>login';
				});
				$('#orders-button').click(function() {
					window.location.href = '<?= BASEURL; ?>home/orderList';
				});
				$('.home-button').click(function() {
					window.location.href = '<?= BASEURL; ?>home';
				});
			</script>
		</ul>
	</div>
</nav>

<body>

	<div class="wrapper">
		<!-- Sidebar Holder -->
		<!-- <nav id="sidebar">
			<div class="sidebar-header">
				<a href="<?= BASEURL; ?>home">
					<h5>Travel Batang Kapas Bersatu</h5>
				</a>
			</div>
			
		</nav> -->

		<!-- Page Content Holder -->
		<div id="content">
			<div class="container-content mt-5 pt-5">
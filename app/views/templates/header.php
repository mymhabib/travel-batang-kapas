<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?= $data['judul']; ?></title>
	<link rel="icon" type="image/x-icon" href="<?= BASEURL; ?>img/tbkb-no-text-whitebg.png">

	<!-- Bootstrap CSS CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- Our Custom CSS -->
	<link rel="stylesheet" href="<?= BASEURL; ?>/css/custom.css">

	<!-- Font Awesome JS -->
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<style>
		#intro {
			background-image: url("<?= BASEURL; ?>img/bgimage.webp");
			background-position: center;
			background-repeat: repeat;
			background-attachment: fixed;
		}

		.invert {
			filter: invert(100%);
		}
	</style>

</head>
<div id="intro" class="bg-image">
	<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
		<div class="container-fluid">
			<img src="<?= BASEURL; ?>img/tbkb-no-text-whitebg.png" alt="swap" class="home-button" style="width: 40px; height: 40px;">
			<span></span>
			<span></span>
			<span></span>
			<ul class="nav navbar-nav flex-row">
				<!-- <li class="nav-item"><a class="nav-link pr-3" href="<?= BASEURL; ?>login/logout">Logout</a></li> -->
				<li class="nav-item">

					<?php if (isset($_SESSION['tbkb_user_id'])) { ?>
						<div class="dropdown">
							<a data-bs-toggle="dropdown" class="invert" aria-expanded="false"><img src="<?= BASEURL; ?>img/profile.png" style="width: 30px; height: 30px;"></a>
							<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
								<li>
									<h6 class="dropdown-header"><?php echo $_SESSION['tbkb_nama']; ?></h6>
								</li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li>
									<a class="dropdown-item home-button">Beranda</a>
								</li>
								<li>
									<a class="dropdown-item" id="bookings-button">Pesanan Anda</a>
								</li>
								<li>
									<a class="dropdown-item" id="logout-button">Logout</a>
								</li>
							</ul>
						</div>
					<?php } elseif (isset($_SESSION['tbkb_driver_id'])) { ?>
						<div class="dropdown">
							<a data-bs-toggle="dropdown" class="invert" aria-expanded="false"><img src="<?= BASEURL; ?>img/profile.png" style="width: 30px; height: 30px;"></a>
							<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
								<li>
									<h6 class="dropdown-header">Driver: <?php echo $_SESSION['tbkb_driver_nama']; ?></h6>
								</li>
								<li>
									<hr class="dropdown-divider">
								</li>
								<li>
									<a class="dropdown-item home-button">Beranda</a>
								</li>
								<?php if ($_SESSION['tbkb_driver_id'] == 1) { ?>
									<li>
										<a class="dropdown-item" id="all-bookings-button">Semua Pesanan</a>
									</li>
									<li>
										<a class="dropdown-item" id="driver-button">Daftar Driver</a>
									</li>
									<li>
										<a class="dropdown-item" id="driver-registration-button">Tambah Driver</a>
									</li>
								<?php } else { ?>
									<li>
										<a class="dropdown-item" id="bookings-driver-button">Pesanan yang anda terima</a>
									</li>
									<li>
										<a class="dropdown-item" id="history-button">Riwayat pesanan</a>
									</li>
								<?php } ?>
								<li>
									<a class="dropdown-item" id="logout-driver-button">Logout</a>
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
						window.location.href = '<?= BASEURL; ?>user/login';
					});
					$('#bookings-button').click(function() {
						window.location.href = '<?= BASEURL; ?>home/bookingList';
					});
					$('.home-button').click(function() {
						window.location.href = '<?= BASEURL; ?>home';
					});
					$('#logout-driver-button').click(function() {
						window.location.href = '<?= BASEURL; ?>driver/logout';
					});
					$('#all-bookings-button').click(function() {
						window.location.href = '<?= BASEURL; ?>admin/getAllBookings';
					});
					$('#driver-button').click(function() {
						window.location.href = '<?= BASEURL; ?>admin/driver';
					});
					$('#driver-registration-button').click(function() {
						window.location.href = '<?= BASEURL; ?>driver/registration';
					});
					$('#bookings-driver-button').click(function() {
						window.location.href = '<?= BASEURL; ?>home_driver/bookingList';
					});
					$('#history-button').click(function() {
						window.location.href = '<?= BASEURL; ?>home_driver/bookingHistory';
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
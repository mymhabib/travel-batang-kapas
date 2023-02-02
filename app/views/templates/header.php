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
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
	<symbol id="success-icon" fill="currentColor" viewBox="0 0 16 16">
		<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
	</symbol>
	<symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
		<path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
	</symbol>
	<symbol id="danger-icon" fill="currentColor" viewBox="0 0 16 16">
		<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
	</symbol>
</svg>
<div id="intro" class="bg-image">
	<nav class="navbar navbar-expand navbar-dark bg-dark fixed-top">
		<div class="container-fluid">
			<?php if (isset($_SESSION['tbkb_driver_id'])) {
				if ($_SESSION['tbkb_driver_id'] == 1) { ?>
					<a class="navbar-brand home-button" href="#">
						<img src="<?= BASEURL; ?>img/tbkb-no-text-whitebg-admin.png" alt="swap" class="home-button" style="width: 160px; height: 40px;"></img>
					</a>
				<?php } else { ?>
					<a class="navbar-brand home-button" href="#">
						<img src="<?= BASEURL; ?>img/tbkb-no-text-whitebg-drivers.png" alt="swap" class="home-button" style="width: 160px; height: 40px;"></img>
					</a>
				<?php } ?>
			<?php } else { ?>
				<a class="navbar-brand home-button" href="#">
					<img src="<?= BASEURL; ?>img/tbkb-no-text-whitebg.png" alt="swap" class="home-button" style="width: 40px; height: 40px;"></img>
				</a>
			<?php } ?>
			<span></span>
			<span></span>
			<span></span>
			<ul class="nav navbar-nav flex-row">
				<!-- <li class="nav-item"><a class="nav-link pr-3" href="<?= BASEURL; ?>login/logout">Logout</a></li> -->
				<li class="nav-item">

					<?php if (isset($_SESSION['tbkb_user_id'])) { ?>
						<div class="dropdown">
							<a data-bs-toggle="dropdown" class="invert" aria-expanded="false"><img src="<?= BASEURL; ?>img/profile.png" style="width: 40px; height: 40px;"></a>
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
							<a data-bs-toggle="dropdown" class="invert" aria-expanded="false"><img src="<?= BASEURL; ?>img/profile.png" style="width: 40px; height: 40px;"></a>
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
						window.location.href = '<?= BASEURL; ?>admin/AllBookings';
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
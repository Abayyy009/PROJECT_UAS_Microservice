<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Abayyy's Store | Indonesia</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="frontend/css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="frontend/css/slick.css" />
	<link type="text/css" rel="stylesheet" href="frontend/css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="frontend/css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="frontend/css/style.css" />
</head>

<?php
include 'koneksi.php';

session_start();

$file = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['customer_status'])) {

	// halaman yg dilindungi jika customer belum login
	$lindungi = array('customer.php', 'customer_logout.php');

	// periksa halaman, jika belum login ke halaman di atas, maka alihkan halaman
	if (in_array($file, $lindungi)) {
		header("location:index.php");
	}

	if ($file == "checkout.php") {
		header("location:masuk.php?alert=login-dulu");
	}

} else {

	// halaman yg tidak boleh diakses jika customer sudah login
	$lindungi = array('masuk.php', 'daftar.php');

	// periksa halaman, jika sudah dan mengakses halaman di atas, maka alihkan halaman
	if (in_array($file, $lindungi)) {
		header("location:customer.php");
	}

}

?>

<body>
	<style>
		.card-custom {
			border: none;
			border-radius: 15px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
			transition: transform 0.3s;
		}

		.card-custom:hover {
			transform: translateY(-10px);
		}

		.card-custom .card-icon {
			font-size: 40px;
			margin-bottom: 15px;
		}

		#header {
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}

		/* Additional styles for header navigation */
		.header-navigation {
			padding-top: 20px;
		}

		.menu-list li {
			display: inline-block;
			margin-right: 20px;
		}

		.menu-list li a {
			font-size: 25px;
			text-decoration: none;
			color: #000;
		}
	</style>

	<!-- HEADER -->
	<header>
		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="index.php">
							<img src="assets/logo.png" alt="AbayyyShop">
						</a>
					</div>
					<!-- /Logo -->
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<?php
						if (isset($_SESSION['customer_status'])) {
							$id_customer = $_SESSION['customer_id'];
							$customer = $conn->prepare("SELECT * FROM customer WHERE customer_id = :id_customer");
							$customer->execute([':id_customer' => $id_customer]);
							$c = $customer->fetch(PDO::FETCH_ASSOC);
							?>
							<!-- Account -->
							<li class="header-account dropdown default-dropdown" style="min-width: 200px">
								<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
									<div class="header-btns-icon">
										<i class="fa fa-user-o"></i>
									</div>
									<strong class="text-uppercase"><?php echo $c['customer_nama']; ?> <i
											class="fa fa-caret-down"></i></strong>
								</div>
								<span><?php echo $c['customer_email']; ?></span>
								<ul class="custom-menu">
									<li><a href="customer.php"><i class="fa fa-user-o"></i> Akun Saya</a></li>
									<li><a href="customer_pesanan.php"><i class="fa fa-list"></i> Pesanan Saya</a></li>
									<li><a href="customer_password.php"><i class="fa fa-lock"></i> Ganti Password</a></li>
									<li><a href="customer_logout.php"><i class="fa fa-sign-out"></i> Keluar</a></li>
								</ul>
							</li>
							<!-- /Account -->
							<?php
						} else {
							?>
							<li class="header-account dropdown default-dropdown">
								<a href="masuk.php" class="text-uppercase main-btn">Login</a>
								<a href="daftar.php" class="text-uppercase primary-btn">Daftar</a>
							</li>
							<?php
						}
						?>

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
				<div class="header-navigation">
					<ul class="menu-list">
						<li><a href="index.php">Home</a></li>
						<li><a href="#">Shop</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /header -->
	</header>
	<!-- /HEADER -->
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard Admin - Abayyy's Store</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet"
    href="https://demo.getstisla.com/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/jquery-selectric/selectric.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/css/style.css">
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/css/components.css">
  <style>
    .modal-dialog {
      width: 30;
      max-width: 400;

    }

    .modal-body img {
      max-width: 50%;
      height: auto;
      display: block;
      margin: 0 auto;
    }
  </style>

  <?php
  include '../koneksi.php';
  session_start();
  if ($_SESSION['status'] != "login") {
    header("location:../login.php?alert=belum_login");
  }
  ?>
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <?php
              $id_admin = $_SESSION['id'];
              $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id = :id_admin");
              $stmt->bindParam(':id_admin', $id_admin);
              $stmt->execute();
              $profil = $stmt->fetch(PDO::FETCH_ASSOC);
              if ($profil['admin_foto'] == "") {
                ?>
                <img src="../gambar/sistem/user.png" class="rounded-circle mr-1">
              <?php } else { ?>
                <img src="../gambar/user/<?php echo htmlspecialchars($profil['admin_foto']); ?>"
                  class="rounded-circle mr-1">
              <?php } ?>
              <div class="d-sm-none d-lg-inline-block"><?php echo $_SESSION['nama']; ?> - Admin</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in</div>
              <a href="admin.php" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.php">Abayyy's Store</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.php">ABY</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main Navigation</li>
            <li>
              <a class="nav-link" href="index.php"><i class="fas fa-fire"></i> <span>DASHBOARD</span></a>
            </li>
            <li>
              <a class="nav-link" href="produk.php"><i class="fas fa-gift"></i> <span>DATA PRODUK</span></a>
            </li>
            <li>
              <a class="nav-link" href="customer.php"><i class="fas fa-users"></i> <span>DATA CUSTOMER</span></a>
            </li>
            <li>
              <a class="nav-link" href="transaksi.php"><i class="fas fa-retweet"></i> <span>TRANSAKSI /
                  PESANAN</span></a>
            </li>
            <li>
              <a class="nav-link" href="laporan.php"><i class="fas fa-file"></i> <span>LAPORAN PENJUALAN</span></a>
            </li>
            <li>
              <a class="nav-link" href="admin.php"><i class="fas fa-user"></i> <span>DATA ADMIN</span></a>
            </li>
            <li>
              <a class="nav-link" href="gantipassword.php"><i class="fas fa-lock"></i> <span>GANTI PASSWORD</span></a>
            </li>
            <li>
              <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>LOGOUT</span></a>
            </li>
          </ul>
        </aside>
      </div>
<?php include 'header.php'; ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Home</a></div>
        <div class="breadcrumb-item active">Dashboard</div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <a href="produk.php">
              <div class="card-icon bg-primary">
                <i class="fas fa-box"></i>
              </div>
            </a>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Jumlah Produk</h4>
              </div>
              <div class="card-body">
                <?php
                include '../koneksi.php';
                $stmt_produk = $conn->prepare("SELECT COUNT(*) as total_produk FROM produk");
                $stmt_produk->execute();
                $result_produk = $stmt_produk->fetch(PDO::FETCH_ASSOC);
                echo $result_produk['total_produk'];
                ?>
              </div>
            </div>
          </div>
        </div>


        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <a href="customer.php">
              <div class="card-icon bg-danger">
                <i class="fas fa-users"></i>
              </div>
            </a>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Jumlah Customer</h4>
              </div>
              <div class="card-body">
                <?php
                $stmt_customer = $conn->prepare("SELECT COUNT(*) as total_customer FROM customer");
                $stmt_customer->execute();
                $result_customer = $stmt_customer->fetch(PDO::FETCH_ASSOC);
                echo $result_customer['total_customer'];
                ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <a href="transaksi.php">
              <div class="card-icon bg-warning">
                <i class="fas fa-file-invoice"></i>
              </div>
            </a>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Jumlah Invoice</h4>
              </div>
              <div class="card-body">
                <?php
                $stmt_invoice = $conn->prepare("SELECT COUNT(*) as total_invoice FROM invoice");
                $stmt_invoice->execute();
                $result_invoice = $stmt_invoice->fetch(PDO::FETCH_ASSOC);
                echo $result_invoice['total_invoice'];
                ?>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <a href="admin.php">
              <div class="card-icon bg-success">
                <i class="fas fa-user-shield"></i>
              </div>
            </a>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Jumlah Pengguna</h4>
              </div>
              <div class="card-body">
                <?php
                $stmt_admin = $conn->prepare("SELECT COUNT(*) as total_admin FROM admin");
                $stmt_admin->execute();
                $result_admin = $stmt_admin->fetch(PDO::FETCH_ASSOC);
                echo $result_admin['total_admin'];
                ?>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Detail Login</h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <tr>
                  <th width="30%">Nama</th>
                  <td><?php echo $_SESSION['nama']; ?></td>
                </tr>
                <tr>
                  <th>Username</th>
                  <td><?php echo $_SESSION['username']; ?></td>
                </tr>
                <tr>
                  <th>Level Hak Akses</th>
                  <td>
                    <span class="badge badge-success text-uppercase"><?php echo $_SESSION['status']; ?></span>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>

<?php include 'footer.php'; ?>
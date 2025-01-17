<?php include 'header.php'; ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Customer
        <small>Edit Customer</small>
      </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Home</a></div>
        <div class="breadcrumb-item active">Customer</div>
        <div class="breadcrumb-item active">Edit Customer</div>
      </div>
    </div>
    <div class="content-wrapper">

      <section class="content">
        <div class="row">
          <section class="col-lg-6 col-lg-offset-3">
            <div class="box box-info">

              <div class="box-header">
                <h3 class="box-title">Edit Customer</h3>
                <a href="customer.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-reply"></i> &nbsp
                  Kembali</a>
              </div>
              <br>
              <div class="box-body">

                <?php
                include '../koneksi.php';
                $id = $_GET['id'];

                try {
                  // Query untuk mengambil data customer berdasarkan ID
                  $stmt = $conn->prepare("SELECT * FROM customer WHERE customer_id = ?");
                  $stmt->execute([$id]);
                  $d = $stmt->fetch(PDO::FETCH_ASSOC);

                  if ($d) {
                    ?>
                    <form action="customer_update.php" method="post">
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="hidden" name="id" value="<?php echo $d['customer_id']; ?>">
                        <input type="text" class="form-control" name="nama" required="required"
                          placeholder="Masukkan Nama customer.." value="<?php echo $d['customer_nama']; ?>">
                      </div>

                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" required="required"
                          placeholder="Masukkan email customer.." value="<?php echo $d['customer_email']; ?>">
                      </div>

                      <div class="form-group">
                        <label>HP</label>
                        <input type="number" class="form-control" name="hp" required="required"
                          placeholder="Masukkan no.hp customer.." value="<?php echo $d['customer_hp']; ?>">
                      </div>

                      <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" class="form-control" name="alamat" required="required"
                          placeholder="Masukkan alamat customer.." value="<?php echo $d['customer_alamat']; ?>">
                      </div>

                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password"
                          placeholder="Masukkan password customer..">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
                      </div>

                      <div class="form-group">
                        <input type="submit" class="btn btn-sm btn-primary" value="Simpan">
                      </div>
                    </form>
                    <?php
                  } else {
                    echo "Data customer tidak ditemukan.";
                  }
                } catch (PDOException $e) {
                  echo "Error: " . $e->getMessage();
                }
                ?>

              </div>

            </div>
          </section>
        </div>
      </section>

    </div>
    <?php include 'footer.php'; ?>
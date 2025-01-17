<?php include 'header.php'; ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>
        Customer
        <small>Data Customer</small>
      </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Home</a></div>
        <div class="breadcrumb-item active">Customer</div>
      </div>
    </div>
    <div class="content-wrapper">

      <section class="content">
        <div class="row">
          <section class="col-lg-10 col-lg-offset-1">
            <div class="box box-info">
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="table-datatable">
                    <thead>
                      <tr>
                        <th width="1%">NO</th>
                        <th>NAMA</th>
                        <th>EMAIL</th>
                        <th>HP</th>
                        <th>ALAMAT</th>
                        <th width="10%">OPSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Menggunakan PDO untuk koneksi
                      include '../koneksi.php';

                      // Query untuk mengambil data customer
                      $stmt = $conn->query("SELECT * FROM customer");
                      $no = 1;

                      // Menggunakan fetch() dengan mode FETCH_ASSOC untuk mendapatkan data dalam bentuk array asosiatif
                      while ($d = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo htmlspecialchars($d['customer_nama']); ?></td>
                          <td><?php echo htmlspecialchars($d['customer_email']); ?></td>
                          <td><?php echo htmlspecialchars($d['customer_hp']); ?></td>
                          <td><?php echo htmlspecialchars($d['customer_alamat']); ?></td>
                          <td>
                            <a class="btn btn-warning btn-sm"
                              href="customer_edit.php?id=<?php echo $d['customer_id']; ?>"><i class="fa fa-cog"></i></a>
                            <a class="btn btn-danger btn-sm"
                              href="customer_hapus_konfir.php?id=<?php echo $d['customer_id']; ?>"><i
                                class="fa fa-trash"></i></a>
                          </td>
                        </tr>
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </section>
        </div>
      </section>

    </div>
    <?php include 'footer.php'; ?>
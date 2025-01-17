<?php include 'header.php'; ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Produk
        <small>Data Produk</small>
      </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Home</a></div>
        <div class="breadcrumb-item active">Produk</div>
      </div>
    </div>
    <div class="content-wrapper">

      <section class="content">
        <div class="row">
          <section class="col-lg-10 col-lg-offset-1">
            <div class="box box-info">

              <div class="box-header">
                <h3 class="box-title">Produk</h3>
                <a href="produk_tambah.php" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> &nbsp
                  Tambah
                  Produk Baru</a>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="table-datatable">
                    <thead>
                      <tr>
                        <th width="1%">NO</th>
                        <th>NAMA PRODUK</th>
                        <th>HARGA</th>
                        <th>JUMLAH</th>
                        <th width="15%">FOTO</th>
                        <th width="10%">OPSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include '../koneksi.php';
                      $no = 1;
                      $stmt = $conn->prepare("SELECT * FROM produk ORDER BY produk_id DESC");
                      $stmt->execute();
                      $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($data as $d) {
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $d['produk_nama']; ?></td>
                          <td><?php echo "Rp. " . number_format($d['produk_harga']) . ",-"; ?></td>
                          <td><?php echo number_format($d['produk_jumlah']); ?></td>
                          <td>
                            <center>
                              <?php if (empty($d['produk_foto1'])) { ?>
                                <img src="../gambar/sistem/produk.png" style="width: 80px;height: auto">
                              <?php } else { ?>
                                <img src="../gambar/produk/<?php echo $d['produk_foto1'] ?>"
                                  style="width: 80px;height: auto">
                              <?php } ?>
                            </center>

                            <center>
                              <?php if (empty($d['produk_foto2'])) { ?>
                                <img src="../gambar/sistem/produk.png" style="width: 80px;height: auto">
                              <?php } else { ?>
                                <img src="../gambar/produk/<?php echo $d['produk_foto2'] ?>"
                                  style="width: 80px;height: auto">
                              <?php } ?>
                            </center>

                            <center>
                              <?php if (empty($d['produk_foto3'])) { ?>
                                <img src="../gambar/sistem/produk.png" style="width: 80px;height: auto">
                              <?php } else { ?>
                                <img src="../gambar/produk/<?php echo $d['produk_foto3'] ?>"
                                  style="width: 80px;height: auto">
                              <?php } ?>
                            </center>
                          </td>
                          <td>
                            <a class="btn btn-warning btn-sm" href="produk_edit.php?id=<?php echo $d['produk_id'] ?>"><i
                                class="fa fa-cog"></i></a>
                            <a class="btn btn-danger btn-sm" href="produk_hapus.php?id=<?php echo $d['produk_id'] ?>"><i
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
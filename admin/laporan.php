<?php include 'header.php'; ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Laporan
        <small>Data Laporan Penjualan</small>
      </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Home</a></div>
        <div class="breadcrumb-item active">Laporan</div>
      </div>
    </div>
    <div class="content-wrapper">
      <section class="content">
        <div class="row">
          <section class="col-lg-12">
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">Filter Laporan</h3>
              </div>
              <div class="box-body">
                <form method="get" action="">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Mulai Tanggal</label>
                        <input autocomplete="off" type="text"
                          value="<?php echo isset($_GET['tanggal_dari']) ? $_GET['tanggal_dari'] : ''; ?>"
                          name="tanggal_dari" class="form-control datepicker2" placeholder="Mulai Tanggal"
                          required="required">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Sampai Tanggal</label>
                        <input autocomplete="off" type="text"
                          value="<?php echo isset($_GET['tanggal_sampai']) ? $_GET['tanggal_sampai'] : ''; ?>"
                          name="tanggal_sampai" class="form-control datepicker2" placeholder="Sampai Tanggal"
                          required="required">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <br />
                        <input type="submit" value="TAMPILKAN LAPORAN" class="btn btn-sm btn-primary">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">Laporan Penjualan</h3>
              </div>
              <div class="box-body">
                <?php
                if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari'])) {
                  $tgl_dari = $_GET['tanggal_dari'];
                  $tgl_sampai = $_GET['tanggal_sampai'];

                  // Setup koneksi PDO
                  include '../koneksi.php';

                  try {
                    // Query untuk mendapatkan data invoice dengan filter tanggal
                    $query = "SELECT invoice.*, customer.customer_nama FROM invoice 
                              INNER JOIN customer ON invoice.invoice_customer = customer.customer_id 
                              WHERE DATE(invoice.invoice_tanggal) BETWEEN :tgl_dari AND :tgl_sampai";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':tgl_dari', $tgl_dari);
                    $stmt->bindParam(':tgl_sampai', $tgl_sampai);
                    $stmt->execute();

                    // Cek apakah ada data invoice yang ditemukan
                    if ($stmt->rowCount() > 0) {
                      ?>
                      <div class="row">
                        <div class="col-lg-6">
                          <table class="table table-bordered">
                            <tr>
                              <th width="30%">DARI TANGGAL</th>
                              <th width="1%">:</th>
                              <td><?php echo $tgl_dari; ?></td>
                            </tr>
                            <tr>
                              <th>SAMPAI TANGGAL</th>
                              <th>:</th>
                              <td><?php echo $tgl_sampai; ?></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <a href="laporan_print.php?tanggal_dari=<?php echo $tgl_dari ?>&tanggal_sampai=<?php echo $tgl_sampai ?>"
                        target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> &nbsp PRINT</a>
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table-datatable">
                          <thead>
                            <tr>
                              <th width="1%">NO</th>
                              <th>INVOICE</th>
                              <th>TANGGAL MASUK</th>
                              <th>NAMA SUPLIER</th>
                              <th>JUMLAH</th>
                              <th>STATUS</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $no = 1;
                            while ($i = $stmt->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                              <tr>
                                <td><?php echo $no++ ?></td>
                                <td>INVOICE-00<?php echo $i['invoice_id'] ?></td>
                                <td><?php echo date('d-m-Y', strtotime($i['invoice_tanggal'])); ?></td>
                                <td><?php echo $i['customer_nama'] ?></td>
                                <td><?php echo "Rp. " . number_format($i['invoice_total_bayar']) . " ,-" ?></td>
                                <td>
                                  <?php
                                  switch ($i['invoice_status']) {
                                    case 0:
                                      echo "Menunggu Pembayaran";
                                      break;
                                    case 1:
                                      echo "Menunggu Konfirmasi";
                                      break;
                                    case 2:
                                      echo "Ditolak";
                                      break;
                                    case 3:
                                      echo "Dikonfirmasi & Sedang Diproses";
                                      break;
                                    case 4:
                                      echo "Dikirim";
                                      break;
                                    case 5:
                                      echo "Selesai";
                                      break;
                                    default:
                                      echo "Status Tidak Diketahui";
                                  }
                                  ?>
                                </td>
                              </tr>
                              <?php
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                      <?php
                    } else {
                      ?>
                      <div class="alert alert-info text-center">
                        Tidak ada data invoice untuk periode tersebut.
                      </div>
                      <?php
                    }
                  } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                  }
                } else {
                  ?>
                  <div class="alert alert-info text-center">
                    Silahkan Filter Laporan Terlebih Dulu.
                  </div>
                  <?php
                }
                ?>
              </div>
            </div>
          </section>
        </div>
      </section>
    </div>

    <script>
      $(document).ready(function () {
        $('.datepicker2').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true,
          todayHighlight: true
        });
      });
    </script>
</div>
<?php include 'footer.php'; ?>
<?php include 'header.php'; ?>
<div class="main-content">
  <section class="section">
    <div class="section-header">
    <h1>
          Transaksi
          <small>Data Transaksi / Pesanan</small>
        </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="#">Home</a></div>
        <div class="breadcrumb-item active">Transaksi</div>
      </div>
    </div>
    <div class="content-wrapper">
      <section class="content">
        <div class="row">
          <section class="col-lg-12">
            <div class="box box-info">

              <div class="box-header">
                <h3 class="box-title">Transaksi / Pesanan</h3>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="table-datatable">
                    <thead>
                      <tr>
                        <th width="1%">NO</th>
                        <th>NO.INVOICE</th>
                        <th>TANGGAL</th>
                        <th>CUSTOMER</th>
                        <th>TOTAL BAYAR</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">UPDATE STATUS</th>
                        <th class="text-center">BUKTI PEMBAYARAN</th>
                        <th class="text-center" width="25%">OPSI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      $stmt = $conn->prepare("SELECT * FROM invoice, customer WHERE customer_id = invoice_customer ORDER BY invoice_id DESC");
                      $stmt->execute();
                      while ($i = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td>INVOICE-00<?php echo $i['invoice_id'] ?></td>
                          <td><?php echo date('d-m-Y', strtotime($i['invoice_tanggal'])); ?></td>
                          <td><?php echo $i['customer_nama'] ?></td>
                          <td><?php echo "Rp. " . number_format($i['invoice_total_bayar']) . " ,-" ?></td>
                          <td class="text-center">
                            <?php
                            if ($i['invoice_status'] == 0) {
                              echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
                            } elseif ($i['invoice_status'] == 1) {
                              echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
                            } elseif ($i['invoice_status'] == 2) {
                              echo "<span class='label label-danger'>Ditolak</span>";
                            } elseif ($i['invoice_status'] == 3) {
                              echo "<span class='label label-primary'>Dikonfirmasi & Sedang Diproses</span>";
                            } elseif ($i['invoice_status'] == 4) {
                              echo "<span class='label label-warning'>Dikirim</span>";
                            } elseif ($i['invoice_status'] == 5) {
                              echo "<span class='label label-success'>Selesai</span>";
                            }
                            ?>
                          </td>
                          <td class="text-center">
                            <form action="transaksi_status.php" method="post">
                              <input type="hidden" value="<?php echo $i['invoice_id'] ?>" name="invoice">
                              <select name="status" id="" class="form-control" onchange="this.form.submit()">
                                <option <?php if ($i['invoice_status'] == "0") {
                                  echo "selected='selected'";
                                } ?> value="0">Menunggu Pembayaran</option>
                                <option <?php if ($i['invoice_status'] == "1") {
                                  echo "selected='selected'";
                                } ?> value="1">Menunggu Konfirmasi</option>
                                <option <?php if ($i['invoice_status'] == "2") {
                                  echo "selected='selected'";
                                } ?> value="2">Ditolak</option>
                                <option <?php if ($i['invoice_status'] == "3") {
                                  echo "selected='selected'";
                                } ?> value="3">Dikonfirmasi & Sedang Diproses</option>
                                <option <?php if ($i['invoice_status'] == "4") {
                                  echo "selected='selected'";
                                } ?> value="4">Dikirim</option>
                                <option <?php if ($i['invoice_status'] == "5") {
                                  echo "selected='selected'";
                                } ?> value="5">Selesai</option>
                              </select>
                            </form>
                          </td>
                          <td class="text-center">
                            <?php
                            if ($i['invoice_bukti'] == "") {
                              echo "Bukti pembayaran belum diupload oleh pembeli/customer.";
                            } else {
                              ?>
                              <img src="../gambar/bukti_pembayaran/<?php echo $i['invoice_bukti']; ?>" alt="" style="width: 100px; height: auto;">
                              <?php
                            }
                            ?>
                          </td>
                          <td class="text-center">
                            <a class='btn btn-sm btn-success' href="transaksi_invoice.php?id=<?php echo $i['invoice_id']; ?>"><i class="fa fa-print"></i> Invoice</a>
                            <a class='btn btn-sm btn-danger' href="transaksi_hapus.php?id=<?php echo $i['invoice_id']; ?>"><i class="fa fa-trash"></i></a>
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

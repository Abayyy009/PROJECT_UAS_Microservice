<!DOCTYPE html>
<html>

<head>
  <title>Laporan Penjualan</title>
</head>

<body>

  <style type="text/css">
    body {
      font-family: sans-serif;
    }

    .table {
      width: 100%;
    }

    th,
    td {}

    .table,
    .table th,
    .table td {
      padding: 5px;
      border: 1px solid black;
      border-collapse: collapse;
    }
  </style>

  <center>
    <h2>Laporan Penjualan Toko Online Pakaian Tenun</h2>
  </center>

  <?php
  include '../koneksi.php';
  if (isset($_GET['tanggal_sampai']) && isset($_GET['tanggal_dari'])) {
    $tgl_dari = $_GET['tanggal_dari'];
    $tgl_sampai = $_GET['tanggal_sampai'];
    ?>
    <br />

    <table class="">
      <tr>
        <td width="20%">DARI TANGGAL</td>
        <td width="1%">:</td>
        <td><?php echo $tgl_dari; ?></td>
      </tr>
      <tr>
        <td>SAMPAI TANGGAL</td>
        <td>:</td>
        <td><?php echo $tgl_sampai; ?></td>
      </tr>
    </table>

    <br />

    <table class="table table-bordered table-striped" id="table-datatable">
      <thead>
        <tr>
          <th width="1%">NO</th>
          <th>INVOICE</th>
          <th>TANGGAL MASUK</th>
          <th>NAMA CUSTOMER</th>
          <th>JUMLAH</th>
          <th>STATUS</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $query = "SELECT * FROM invoice, customer WHERE invoice_customer = customer_id AND DATE(invoice_tanggal) >= :tgl_dari AND DATE(invoice_tanggal) <= :tgl_sampai";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tgl_dari', $tgl_dari);
        $stmt->bindParam(':tgl_sampai', $tgl_sampai);
        $stmt->execute();

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

    <?php
  } else {
    ?>

    <div class="alert alert-info text-center">
      Silahkan Filter Laporan Terlebih Dulu.
    </div>

    <?php
  }
  ?>
</body>

<script>
  window.print();
</script>

</html>
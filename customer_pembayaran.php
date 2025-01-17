<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Konfirmasi Pembayaran</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<div class="section">
	<div class="container">
		<div class="row">

			<?php include 'customer_sidebar.php'; ?>

			<div id="main" class="col-md-9">
				<h4>KONFIRMASI PEMBAYARAN</h4>

				<div id="store">
					<div class="row">
						<div class="col-lg-12">
							<?php
							// Validasi parameter id
							if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
								die("<div class='alert alert-danger'>Parameter tidak valid.</div>");
							}

							$id_invoice = $_GET['id'];
							$id = $_SESSION['customer_id'];

							$stmt = $conn->prepare("SELECT * FROM invoice WHERE invoice_customer = :id AND invoice_id = :invoice_id");
							$stmt->bindParam(':id', $id);
							$stmt->bindParam(':invoice_id', $id_invoice);
							$stmt->execute();
							$invoice = $stmt->fetch(PDO::FETCH_ASSOC);

							if ($invoice) {
								?>
								<table class="table table-bordered">
									<tr>
										<th width="20%">No.Invoice</th>
										<td>INVOICE-00<?php echo $invoice['invoice_id'] ?></td>
									</tr>
									<tr>
										<th>Tanggal</th>
										<td><?php echo date('d-m-Y', strtotime($invoice['invoice_tanggal'])) ?></td>
									</tr>
									<tr>
										<th>Total Bayar</th>
										<td><?php echo "Rp. " . number_format($invoice['invoice_total_bayar']) . " ,-" ?>
										</td>
									</tr>
									<tr>
										<th>Status</th>
										<td>
											<?php
											switch ($invoice['invoice_status']) {
												case 0:
													echo "<span class='label label-warning'>Menunggu Pembayaran</span>";
													break;
												case 1:
													echo "<span class='label label-default'>Menunggu Konfirmasi</span>";
													break;
												case 2:
													echo "<span class='label label-danger'>Ditolak</span>";
													break;
												case 3:
													echo "<span class='label label-primary'>Dikonfirmasi & Sedang Diproses</span>";
													break;
												case 4:
													echo "<span class='label label-warning'>Dikirim</span>";
													break;
												case 5:
													echo "<span class='label label-success'>Selesai</span>";
													break;
												default:
													echo "<span class='label label-default'>Status Tidak Dikenali</span>";
													break;
											}
											?>
										</td>
									</tr>
								</table>

								<p>Silahkan Lakukan Pembayaran Ke Nomor Rekening Berikut:</p>
								<table class="table table-bordered">
									<tr>
										<th width="30%">Nomor Rekening</th>
										<td>123-122-3345</td>
									</tr>
									<tr>
										<th>Atas Nama</th>
										<td>Akbar Firdaus</td>
									</tr>
									<tr>
										<th>Bank</th>
										<td>BSI</td>
									</tr>
								</table>

								<form action="customer_pembayaran_act.php" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<input type="hidden" name="id" value="<?php echo $id_invoice; ?>">
										<label>Upload Bukti Pembayaran</label>
										<input type="file" name="bukti" required>
										<small class="text-muted">File yang diperbolehkan hanya file gambar.</small>
									</div>
									<input type="submit" value="Upload Bukti Pembayaran" class="btn btn-primary">
								</form>
								<?php
							} else {
								echo "<div class='alert alert-danger'>Maaf, invoice tidak ditemukan atau Anda tidak memiliki akses.</div>";
							}
							?>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
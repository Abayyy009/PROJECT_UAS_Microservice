<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Invoice Customer</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<div class="section">
	<div class="container">
		<div class="row">

			<?php include 'customer_sidebar.php'; ?>

			<div id="main" class="col-md-9">

				<h4>INVOICE</h4>

				<div id="store">
					<div class="row">

						<?php
						include 'koneksi.php';

						$id_invoice = $_GET['id'];
						$id = $_SESSION['customer_id'];

						// Query menggunakan PDO
						$sql = "SELECT * FROM invoice WHERE invoice_customer = :id_customer AND invoice_id = :id_invoice ORDER BY invoice_id DESC";
						$stmt = $conn->prepare($sql);
						$stmt->execute(['id_customer' => $id, 'id_invoice' => $id_invoice]);
						$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

						foreach ($result as $i) {
							?>

							<div class="col-lg-12">

								<a href="customer_invoice_cetak.php?id=<?php echo $_GET['id'] ?>" target="_blank"
									class="btn btn-default btn-sm"><i class="fa fa-print"></i> CETAK</a>

								<br />
								<br />

								<h4>INVOICE-00<?php echo $i['invoice_id'] ?></h4>


								<br />
								<?php echo $i['invoice_nama']; ?><br />
								<?php echo $i['invoice_alamat']; ?><br />
								<?php echo $i['invoice_provinsi']; ?><br />
								<?php echo $i['invoice_kabupaten']; ?><br />
								Hp. <?php echo $i['invoice_hp']; ?><br />
								<br />

								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th class="text-center" width="1%">NO</th>
												<th colspan="2">Produk</th>
												<th class="text-center">Harga</th>
												<th class="text-center">Jumlah</th>
												<th class="text-center">Total Harga</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$no = 1;
											$total = 0;

											// Query untuk mendapatkan detail transaksi
											$sql_transaksi = "SELECT * FROM transaksi JOIN produk ON transaksi.transaksi_produk = produk.produk_id WHERE transaksi_invoice = :id_invoice";
											$stmt_transaksi = $conn->prepare($sql_transaksi);
											$stmt_transaksi->execute(['id_invoice' => $id_invoice]);
											$result_transaksi = $stmt_transaksi->fetchAll(PDO::FETCH_ASSOC);

											foreach ($result_transaksi as $d) {
												$total += $d['transaksi_harga'];
												?>
												<tr>
													<td class="text-center"><?php echo $no++; ?></td>
													<td>
														<center>
															<?php if (empty($d['produk_foto1'])) { ?>
																<img src="gambar/sistem/produk.png"
																	style="width: 50px;height: auto">
															<?php } else { ?>
																<img src="gambar/produk/<?php echo $d['produk_foto1'] ?>"
																	style="width: 50px;height: auto">
															<?php } ?>
														</center>
													</td>
													<td><?php echo $d['produk_nama']; ?></td>
													<td class="text-center">
														<?php echo "Rp. " . number_format($d['transaksi_harga']) . ",-"; ?></td>
													<td class="text-center"><?php echo number_format($d['transaksi_jumlah']); ?>
													</td>
													<td class="text-center">
														<?php echo "Rp. " . number_format($d['transaksi_jumlah'] * $d['transaksi_harga']) . " ,-"; ?>
													</td>
												</tr>
											<?php
											}
											?>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="4" style="border: none"></td>
												<th>Berat</th>
												<td class="text-center"><?php echo number_format($i['invoice_berat']); ?>
													gram</td>
											</tr>
											<tr>
												<td colspan="4" style="border: none"></td>
												<th>Total Belanja</th>
												<td class="text-center"><?php echo "Rp. " . number_format($total) . " ,-"; ?>
												</td>
											</tr>
											<tr>
												<td colspan="4" style="border: none"></td>
												<th>Ongkir (<?php echo $i['invoice_kurir'] ?>)</th>
												<td class="text-center">
													<?php echo "Rp. " . number_format($i['invoice_ongkir']) . " ,-"; ?></td>
											</tr>
											<tr>
												<td colspan="4" style="border: none"></td>
												<th>Total Bayar</th>
												<td class="text-center">
													<?php echo "Rp. " . number_format($i['invoice_total_bayar']) . " ,-"; ?>
												</td>
											</tr>
										</tfoot>
									</table>
								</div>


								<h5>STATUS :</h5>
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

							</div>


						<?php
						}
						?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>
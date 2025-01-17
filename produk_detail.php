<?php include 'header.php'; ?>

<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">Detail Produk</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<?php
include 'koneksi.php';

try {
	$id_produk = $_GET['id'];

	// buka koneksi PDO
	$dbh = new PDO("mysql:host=$host;dbname=$database", $user, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// query untuk mendapatkan detail produk
	$stmt = $dbh->prepare("SELECT * FROM produk WHERE produk_id = :id");
	$stmt->bindParam(':id', $id_produk);
	$stmt->execute();
	$produk = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($produk) {
		?>

		<div class="section">
			<div class="container">
				<div class="row">
					<div class="product product-details clearfix">
						<div class="col-md-6">
							<div id="product-main-view">
								<?php
								// Tampilkan gambar produk
								for ($i = 1; $i <= 3; $i++) {
									$foto_produk = $produk["produk_foto$i"];
									if (empty($foto_produk)) {
										$foto_produk = "gambar/sistem/produk.png";
									} else {
										$foto_produk = "gambar/produk/$foto_produk";
									}
									?>
									<div class="product-view">
										<img src="<?php echo $foto_produk; ?>">
									</div>
									<?php
								}
								?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="product-body">
								<br>
								<h2 class="product-name"><?php echo $produk['produk_nama']; ?></h2>
								<br>
								<h3 class="product-price"><?php echo "Rp. " . number_format($produk['produk_harga']) . ",-"; ?>
									<?php if ($produk['produk_jumlah'] == 0) { ?>
										<del class="product-old-price">Kosong</del>
									<?php } ?>
								</h3>
								<br>

								<br>
								<p>
									<strong>Status:</strong>
									<?php echo $produk['produk_jumlah'] == 0 ? "Kosong" : "Tersedia"; ?>
								</p>
								<br>
								<form action="">
									<div class="product-btns">
										<a class="primary-btn add-to-cart"
											href="checkout.php?id=<?php echo htmlspecialchars($produk['produk_id']); ?>&jumlah=1&redirect=index">
											<i class="fa fa-shopping-cart"></i> Checkout
										</a>
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-12">
							<div class="product-tab">
								<ul class="tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab1">Deskripsi</a></li>
								</ul>
								<div class="tab-content">
									<div id="tab1" class="tab-pane fade in active">
										<p><?php echo $produk['produk_keterangan']; ?></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	} else {
		echo "<p>Produk tidak ditemukan.</p>";
	}

} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}

// Tutup koneksi PDO
$dbh = null;
?>

<?php include 'footer.php'; ?>
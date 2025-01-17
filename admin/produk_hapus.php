<?php
include '../koneksi.php';
$id = $_GET['id'];

// Mengambil data produk berdasarkan ID
$stmt = $conn->prepare("SELECT * FROM produk WHERE produk_id = :id");
$stmt->execute(['id' => $id]);
$d = $stmt->fetch(PDO::FETCH_ASSOC);

$foto1 = $d['produk_foto1'];
$foto2 = $d['produk_foto2'];
$foto3 = $d['produk_foto3'];

// Menghapus file gambar produk
if ($foto1 != "") {
	unlink("../gambar/produk/$foto1");
}
if ($foto2 != "") {
	unlink("../gambar/produk/$foto2");
}
if ($foto3 != "") {
	unlink("../gambar/produk/$foto3");
}

// Menghapus data produk
$stmt = $conn->prepare("DELETE FROM produk WHERE produk_id = :id");
$stmt->execute(['id' => $id]);

// Mengambil data transaksi yang terkait dengan produk
$stmt = $conn->prepare("SELECT * FROM transaksi WHERE transaksi_produk = :id");
$stmt->execute(['id' => $id]);

while ($d = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$id_invoice = $d['transaksi_invoice'];

	// Menghapus data invoice yang terkait
	$stmt_delete_invoice = $conn->prepare("DELETE FROM invoice WHERE invoice_id = :id_invoice");
	$stmt_delete_invoice->execute(['id_invoice' => $id_invoice]);
}

// Menghapus data transaksi yang terkait dengan produk
$stmt = $conn->prepare("DELETE FROM transaksi WHERE transaksi_produk = :id");
$stmt->execute(['id' => $id]);

header("location:produk.php");
?>
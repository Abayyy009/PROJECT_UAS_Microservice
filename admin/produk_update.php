<?php
include '../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$kategori = $_POST['kategori'];
$harga = $_POST['harga'];
$keterangan = $_POST['keterangan'];
$berat = $_POST['berat'];
$jumlah = $_POST['jumlah'];

$rand = rand();
$allowed = array('gif', 'png', 'jpg', 'jpeg');

$filename1 = $_FILES['foto1']['name'];
$filename2 = $_FILES['foto2']['name'];
$filename3 = $_FILES['foto3']['name'];

// Update data produk
$stmt = $conn->prepare("UPDATE produk SET produk_nama = :nama, produk_harga = :harga, produk_keterangan = :keterangan, produk_berat = :berat, produk_jumlah = :jumlah WHERE produk_id = :id");
$stmt->execute([
	'nama' => $nama,
	'harga' => $harga,
	'keterangan' => $keterangan,
	'berat' => $berat,
	'jumlah' => $jumlah,
	'id' => $id
]);

// Proses upload dan update foto1
if ($filename1 != "") {
	$ext = pathinfo($filename1, PATHINFO_EXTENSION);
	if (in_array($ext, $allowed)) {
		move_uploaded_file($_FILES['foto1']['tmp_name'], '../gambar/produk/' . $rand . '_' . $filename1);
		$file_gambar = $rand . '_' . $filename1;

		// Hapus foto lama
		$stmt = $conn->prepare("SELECT produk_foto1 FROM produk WHERE produk_id = :id");
		$stmt->execute(['id' => $id]);
		$foto = $stmt->fetchColumn();

		unlink("../gambar/produk/$foto");

		// Update nama file baru ke database
		$stmt = $conn->prepare("UPDATE produk SET produk_foto1 = :file_gambar WHERE produk_id = :id");
		$stmt->execute(['file_gambar' => $file_gambar, 'id' => $id]);
	}
}

// Proses upload dan update foto2
if ($filename2 != "") {
	$ext = pathinfo($filename2, PATHINFO_EXTENSION);
	if (in_array($ext, $allowed)) {
		move_uploaded_file($_FILES['foto2']['tmp_name'], '../gambar/produk/' . $rand . '_' . $filename2);
		$file_gambar = $rand . '_' . $filename2;

		// Hapus foto lama
		$stmt = $conn->prepare("SELECT produk_foto2 FROM produk WHERE produk_id = :id");
		$stmt->execute(['id' => $id]);
		$foto = $stmt->fetchColumn();

		unlink("../gambar/produk/$foto");

		// Update nama file baru ke database
		$stmt = $conn->prepare("UPDATE produk SET produk_foto2 = :file_gambar WHERE produk_id = :id");
		$stmt->execute(['file_gambar' => $file_gambar, 'id' => $id]);
	}
}

// Proses upload dan update foto3
if ($filename3 != "") {
	$ext = pathinfo($filename3, PATHINFO_EXTENSION);
	if (in_array($ext, $allowed)) {
		move_uploaded_file($_FILES['foto3']['tmp_name'], '../gambar/produk/' . $rand . '_' . $filename3);
		$file_gambar = $rand . '_' . $filename3;

		// Hapus foto lama
		$stmt = $conn->prepare("SELECT produk_foto3 FROM produk WHERE produk_id = :id");
		$stmt->execute(['id' => $id]);
		$foto = $stmt->fetchColumn();

		unlink("../gambar/produk/$foto");

		// Update nama file baru ke database
		$stmt = $conn->prepare("UPDATE produk SET produk_foto3 = :file_gambar WHERE produk_id = :id");
		$stmt->execute(['file_gambar' => $file_gambar, 'id' => $id]);
	}
}

header("location:produk.php");
?>
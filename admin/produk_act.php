<?php
include '../koneksi.php';

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$keterangan = $_POST['keterangan'];
$berat = $_POST['berat'];
$jumlah = $_POST['jumlah'];

$rand = rand();
$allowed = array('gif', 'png', 'jpg', 'jpeg');

$filename1 = $_FILES['foto1']['name'];
$filename2 = $_FILES['foto2']['name'];
$filename3 = $_FILES['foto3']['name'];

try {
	// Insert produk baru
	$stmt = $conn->prepare("INSERT INTO produk (produk_nama, produk_harga, produk_keterangan, produk_jumlah, produk_berat, produk_foto1, produk_foto2, produk_foto3) VALUES (?, ?, ?, ?, ?, '', '', '')");
	$stmt->execute([$nama, $harga, $keterangan, $jumlah, $berat]);

	// Ambil ID produk yang baru saja dimasukkan
	$last_id = $conn->lastInsertId();

	// Proses upload foto1
	if ($filename1 != "") {
		$ext = pathinfo($filename1, PATHINFO_EXTENSION);

		if (in_array($ext, $allowed)) {
			if (move_uploaded_file($_FILES['foto1']['tmp_name'], '../gambar/produk/' . $rand . '_' . $filename1)) {
				$file_gambar = $rand . '_' . $filename1;

				$stmt = $conn->prepare("UPDATE produk SET produk_foto1 = ? WHERE produk_id = ?");
				$stmt->execute([$file_gambar, $last_id]);
			} else {
				echo "Failed to upload file 1.";
			}
		} else {
			echo "Invalid file type for file 1.";
		}
	}

	// Proses upload foto2
	if ($filename2 != "") {
		$ext = pathinfo($filename2, PATHINFO_EXTENSION);

		if (in_array($ext, $allowed)) {
			if (move_uploaded_file($_FILES['foto2']['tmp_name'], '../gambar/produk/' . $rand . '_' . $filename2)) {
				$file_gambar = $rand . '_' . $filename2;

				$stmt = $conn->prepare("UPDATE produk SET produk_foto2 = ? WHERE produk_id = ?");
				$stmt->execute([$file_gambar, $last_id]);
			} else {
				echo "Failed to upload file 2.";
			}
		} else {
			echo "Invalid file type for file 2.";
		}
	}

	// Proses upload foto3
	if ($filename3 != "") {
		$ext = pathinfo($filename3, PATHINFO_EXTENSION);

		if (in_array($ext, $allowed)) {
			if (move_uploaded_file($_FILES['foto3']['tmp_name'], '../gambar/produk/' . $rand . '_' . $filename3)) {
				$file_gambar = $rand . '_' . $filename3;

				$stmt = $conn->prepare("UPDATE produk SET produk_foto3 = ? WHERE produk_id = ?");
				$stmt->execute([$file_gambar, $last_id]);
			} else {
				echo "Failed to upload file 3.";
			}
		} else {
			echo "Invalid file type for file 3.";
		}
	}

	echo "Produk berhasil ditambahkan.";
	header("Location: produk.php");
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}
?>
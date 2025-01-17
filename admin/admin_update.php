<?php
// Include file koneksi menggunakan PDO
include '../koneksi.php';

// Ambil data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$pwd = $_POST['password'];
$password = md5($_POST['password']);

// Cek file gambar
$rand = rand();
$allowed = array('gif', 'png', 'jpg', 'jpeg');
$filename = $_FILES['foto']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

try {
	// Mulai transaksi PDO
	$conn->beginTransaction();

	if ($pwd == "" && $filename == "") {
		// Update tanpa password dan tanpa gambar
		$stmt = $koneksi->prepare("UPDATE admin SET admin_nama = ?, admin_username = ? WHERE admin_id = ?");
		$stmt->execute([$nama, $username, $id]);
	} elseif ($pwd == "") {
		// Update tanpa password tapi dengan gambar
		if (!in_array($ext, $allowed)) {
			header("location: admin.php?alert=gagal");
			exit();
		} else {
			move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/' . $rand . '_' . $filename);
			$x = $rand . '_' . $filename;
			$stmt = $koneksi->prepare("UPDATE admin SET admin_nama = ?, admin_username = ?, admin_foto = ? WHERE admin_id = ?");
			$stmt->execute([$nama, $username, $x, $id]);
		}
	} elseif ($filename == "") {
		// Update dengan password tapi tanpa gambar
		$stmt = $conn->prepare("UPDATE admin SET admin_nama = ?, admin_username = ?, admin_password = ? WHERE admin_id = ?");
		$stmt->execute([$nama, $username, $password, $id]);
	}

	// Commit transaksi
	$conn->commit();

	// Redirect ke halaman admin.php
	header("location: admin.php?alert=berhasil");
	exit();
} catch (PDOException $e) {
	// Rollback jika terjadi error
	$conn->rollBack();
	echo "Error: " . $e->getMessage();
}
?>
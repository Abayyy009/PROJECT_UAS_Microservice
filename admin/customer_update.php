<?php
// Include file koneksi menggunakan PDO
include '../koneksi.php';

// Ambil data dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];
$password = md5($_POST['password']);

try {
	// Cek apakah password diubah atau tidak
	if ($_POST['password'] == "") {
		// Query untuk update data customer tanpa mengubah password
		$stmt = $conn->prepare("UPDATE customer SET customer_nama = ?, customer_email = ?, customer_hp = ?, customer_alamat = ? WHERE customer_id = ?");
		$stmt->execute([$nama, $email, $hp, $alamat, $id]);
	} else {
		// Query untuk update data customer dengan mengubah password
		$stmt = $conn->prepare("UPDATE customer SET customer_nama = ?, customer_email = ?, customer_hp = ?, customer_alamat = ?, customer_password = ? WHERE customer_id = ?");
		$stmt->execute([$nama, $email, $hp, $alamat, $password, $id]);
	}

	// Redirect ke halaman customer.php jika berhasil
	header("location: customer.php");
	exit();
} catch (PDOException $e) {
	// Tampilkan pesan error jika terjadi kesalahan
	echo "Error: " . $e->getMessage();
}
?>
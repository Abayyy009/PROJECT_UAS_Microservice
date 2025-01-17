<?php
// Menghubungkan dengan koneksi
include 'koneksi.php';

// Menangkap data yang dikirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);

try {
	// Query menggunakan PDO untuk mencari admin dengan username dan password yang cocok
	$stmt = $conn->prepare("SELECT * FROM admin WHERE admin_username=:username AND admin_password=:password");
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':password', $password);
	$stmt->execute();

	// Mengecek apakah ada hasil yang ditemukan
	if ($stmt->rowCount() > 0) {
		session_start();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		$_SESSION['id'] = $data['admin_id'];
		$_SESSION['nama'] = $data['admin_nama'];
		$_SESSION['username'] = $data['admin_username'];
		$_SESSION['status'] = "login";

		header("location:admin/");
	} else {
		header("location:login.php?alert=gagal");
	}
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}
?>
<?php
include '../koneksi.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);

$rand = rand();
$allowed = array('gif', 'png', 'jpg', 'jpeg');
$filename = $_FILES['foto']['name'];

if ($filename == "") {
	$stmt = $conn->prepare("INSERT INTO admin (admin_nama, admin_username, admin_password, admin_foto) VALUES (:nama, :username, :password, '')");
	$stmt->bindParam(':nama', $nama);
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':password', $password);
	$stmt->execute();
	header("Location: admin.php");
} else {
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if (!in_array($ext, $allowed)) {
		header("Location: admin.php?alert=gagal");
	} else {
		move_uploaded_file($_FILES['foto']['tmp_name'], '../gambar/user/' . $rand . '_' . $filename);
		$file_gambar = $rand . '_' . $filename;
		$stmt = $conn->prepare("INSERT INTO admin (admin_nama, admin_username, admin_password, admin_foto) VALUES (:nama, :username, :password, :file_gambar)");
		$stmt->bindParam(':nama', $nama);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':file_gambar', $file_gambar);
		$stmt->execute();
		header("Location: admin.php");
	}
}

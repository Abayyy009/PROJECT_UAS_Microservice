<?php
include 'koneksi.php';

// Ambil data dari form
$nama = $_POST['nama'];
$email = $_POST['email'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];
$password = md5($_POST['password']);

// Query untuk mengecek apakah email sudah terdaftar
$stmt = $conn->prepare("SELECT * FROM customer WHERE customer_email = :email");
$stmt->bindParam(':email', $email);
$stmt->execute();
$cek_email = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika email sudah terdaftar, redirect kembali ke halaman pendaftaran
if ($cek_email) {
	header("location:daftar.php?alert=duplikat");
	exit();
} else {
	// Jika email belum terdaftar, lakukan proses penyimpanan data customer baru
	$stmt = $conn->prepare("INSERT INTO customer (customer_nama, customer_email, customer_hp, customer_alamat, customer_password) 
                              VALUES (:nama, :email, :hp, :alamat, :password)");
	$stmt->bindParam(':nama', $nama);
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':hp', $hp);
	$stmt->bindParam(':alamat', $alamat);
	$stmt->bindParam(':password', $password);

	// Eksekusi query
	if ($stmt->execute()) {
		header("location:masuk.php?alert=terdaftar");
		exit();
	} else {
		echo "Gagal melakukan pendaftaran. Silakan coba lagi.";
	}
}
?>
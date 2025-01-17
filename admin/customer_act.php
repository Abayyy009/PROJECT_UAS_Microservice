<?php
include '../koneksi.php';

// Ambil data dari form
$nama = $_POST['nama'];
$email = $_POST['email'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];
$password = md5($_POST['password']);

try {

    // Query untuk melakukan penyisipan data dengan prepared statement
    $stmt = $conn->prepare("INSERT INTO customer (nama, email, hp, alamat, password) VALUES (:nama, :email, :hp, :alamat, :password)");

    // Bind parameter ke prepared statement
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':hp', $hp);
    $stmt->bindParam(':alamat', $alamat);
    $stmt->bindParam(':password', $password);

    // Eksekusi prepared statement untuk menyisipkan data
    $stmt->execute();

    // Redirect ke halaman customer.php jika berhasil
    header("location: customer.php");
    exit();
} catch (PDOException $e) {
    // Tampilkan pesan error jika terjadi kesalahan
    echo "Error: " . $e->getMessage();
}

// Tutup koneksi PDO
$conn = null;
?>
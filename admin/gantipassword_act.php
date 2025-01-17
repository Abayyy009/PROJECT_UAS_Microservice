<?php
// Include file koneksi menggunakan PDO
include '../koneksi.php';

// Mulai session
session_start();

// Ambil id admin dari session
$id = $_SESSION['id'];

// Ambil password baru dari form dan hash menggunakan md5
$password = md5($_POST['password']);

try {
    // Persiapkan query menggunakan prepared statement
    $stmt = $conn->prepare("UPDATE admin SET admin_password = ? WHERE admin_id = ?");

    // Bind parameter ke query
    $stmt->bindParam(1, $password);
    $stmt->bindParam(2, $id);

    // Eksekusi query
    $stmt->execute();

    // Redirect ke halaman gantipassword.php dengan alert sukses
    header("location: gantipassword.php?alert=sukses");
    exit();
} catch (PDOException $e) {
    // Tampilkan pesan error jika terjadi kesalahan
    echo "Error: " . $e->getMessage();
}
?>
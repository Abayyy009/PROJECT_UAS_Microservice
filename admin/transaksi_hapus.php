<?php
include '../koneksi.php';

// Ambil ID invoice dari parameter GET
$id = $_GET['id'];

// Buat koneksi PDO
try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Hapus invoice berdasarkan ID
    $stmt1 = $dbh->prepare("DELETE FROM invoice WHERE invoice_id = :id");
    $stmt1->bindParam(':id', $id);
    $stmt1->execute();

    // Hapus transaksi berdasarkan ID invoice
    $stmt2 = $dbh->prepare("DELETE FROM transaksi WHERE transaksi_invoice = :id");
    $stmt2->bindParam(':id', $id);
    $stmt2->execute();

    // Redirect ke halaman transaksi.php setelah berhasil menghapus
    header("location: transaksi.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Tutup koneksi PDO
$dbh = null;
?>
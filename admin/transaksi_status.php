<?php
include '../koneksi.php';

// Mengambil nilai dari form
$invoice = $_POST['invoice'] ?? null;
$status = $_POST['status'] ?? null;

if ($invoice !== null && $status !== null) {
    try {
        // Buat koneksi PDO
        $dbh = new PDO("mysql:host=$host;dbname=$database", $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepared statement untuk update status invoice
        $stmt = $dbh->prepare("UPDATE invoice SET invoice_status = :status WHERE invoice_id = :invoice");
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':invoice', $invoice, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect ke halaman transaksi.php setelah update selesai
        header("location: transaksi.php");
        exit(); // Pastikan script berhenti setelah redirect

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Tutup koneksi PDO
        $dbh = null;
    }
} else {
    echo "Invalid input.";
}
?>
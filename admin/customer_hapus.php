<?php
include '../koneksi.php'; // Ensure this file sets up the PDO connection as $pdo
$id = $_GET['id'];

try {
	// Start transaction
	$conn->beginTransaction();

	// Delete from customer table
	$stmt = $conn->prepare("DELETE FROM customer WHERE customer_id = :id");
	$stmt->execute(['id' => $id]);

	// Select all invoices for the customer
	$stmt = $conn->prepare("SELECT * FROM invoice WHERE invoice_customer = :id");
	$stmt->execute(['id' => $id]);

	while ($d = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$id_invoice = $d['invoice_id'];

		// Delete from transaksi table
		$stmt_delete_transaksi = $conn->prepare("DELETE FROM transaksi WHERE transaksi_invoice = :id_invoice");
		$stmt_delete_transaksi->execute(['id_invoice' => $id_invoice]);
	}

	// Delete from invoice table
	$stmt_delete_invoice = $conn->prepare("DELETE FROM invoice WHERE invoice_customer = :id");
	$stmt_delete_invoice->execute(['id' => $id]);

	// Commit transaction
	$conn->commit();
} catch (Exception $e) {
	// Rollback transaction if something went wrong
	$conn->rollBack();
	echo "Failed: " . $e->getMessage();
}

header("Location: customer.php");
?>
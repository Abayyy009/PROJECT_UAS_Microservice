<?php
include 'koneksi.php';

header("Content-Type: application/json");

try {
    // Pastikan request menggunakan metode POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405); // Method Not Allowed
        echo json_encode(['status' => 'error', 'message' => 'Only POST method is allowed']);
        exit;
    }

    // Validasi apakah file diunggah
    if (!isset($_FILES['bukti']) || !isset($_POST['id'])) {
        http_response_code(400); // Bad Request
        echo json_encode(['status' => 'error', 'message' => 'ID or file is missing']);
        exit;
    }

    $id = $_POST['id'];
    $filename = $_FILES['bukti']['name'];
    $tmpName = $_FILES['bukti']['tmp_name'];
    $allowed = ['gif', 'png', 'jpg', 'jpeg'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($ext, $allowed)) {
        http_response_code(400); // Bad Request
        echo json_encode(['status' => 'error', 'message' => 'Invalid file type']);
        exit;
    }

    $rand = rand();
    $file_gambar = $rand . '.' . $ext;

    // Begin transaction
    $conn->beginTransaction();

    // Ambil nama file lama
    $stmt_lama = $conn->prepare("SELECT invoice_bukti FROM invoice WHERE invoice_id = :id");
    $stmt_lama->bindParam(':id', $id);
    $stmt_lama->execute();
    $lama = $stmt_lama->fetch(PDO::FETCH_ASSOC);

    if (!$lama) {
        throw new Exception("Invoice not found");
    }

    $foto_lama = $lama['invoice_bukti'];

    // Hapus file lama jika ada
    if (!empty($foto_lama) && file_exists("gambar/bukti_pembayaran/$foto_lama")) {
        unlink("gambar/bukti_pembayaran/$foto_lama");
    }

    // Pindahkan file baru
    if (!move_uploaded_file($tmpName, "gambar/bukti_pembayaran/$file_gambar")) {
        throw new Exception("Failed to upload file");
    }

    // Update database
    $stmt_update = $conn->prepare("UPDATE invoice SET invoice_bukti = :file_gambar, invoice_status = 1 WHERE invoice_id = :id");
    $stmt_update->bindParam(':file_gambar', $file_gambar);
    $stmt_update->bindParam(':id', $id);
    $stmt_update->execute();

    // Commit transaction
    $conn->commit();

    echo json_encode(['status' => 'success', 'message' => 'Payment proof uploaded successfully']);
} catch (Exception $e) {
    // Rollback transaction if something goes wrong
    $conn->rollBack();
    http_response_code(500); // Internal Server Error
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

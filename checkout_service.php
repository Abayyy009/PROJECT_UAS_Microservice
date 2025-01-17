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

    // Ambil data JSON dari body request
    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input) {
        http_response_code(400); // Bad Request
        echo json_encode(['status' => 'error', 'message' => 'Invalid JSON input']);
        exit;
    }

    // Validasi data yang diperlukan
    $requiredFields = ['customer_id', 'nama', 'hp', 'alamat', 'provinsi', 'kabupaten', 'kurir', 'berat', 'ongkir', 'total_bayar', 'produk_id', 'jumlah'];
    foreach ($requiredFields as $field) {
        if (!isset($input[$field])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => "Field '$field' is required"]);
            exit;
        }
    }

    // Begin transaction
    $conn->beginTransaction();

    $tanggal = date('Y-m-d');
    $customerId = $input['customer_id'];
    $nama = $input['nama'];
    $hp = $input['hp'];
    $alamat = $input['alamat'];
    $provinsi = $input['provinsi'];
    $kabupaten = $input['kabupaten'];
    $kurir = $input['kurir'];
    $berat = $input['berat'];
    $ongkir = $input['ongkir'];
    $totalBayar = $input['total_bayar'];

    // Insert into invoice table
    $stmt = $conn->prepare("INSERT INTO invoice VALUES (NULL, :tanggal, :id_customer, :nama, :hp, :alamat, :provinsi, :kabupaten, :kurir, :berat, :ongkir, :total_bayar, '0', '', '')");
    $stmt->execute([
        ':tanggal' => $tanggal,
        ':id_customer' => $customerId,
        ':nama' => $nama,
        ':hp' => $hp,
        ':alamat' => $alamat,
        ':provinsi' => $provinsi,
        ':kabupaten' => $kabupaten,
        ':kurir' => $kurir,
        ':berat' => $berat,
        ':ongkir' => $ongkir,
        ':total_bayar' => $totalBayar
    ]);

    // Get the last inserted ID
    $invoiceId = $conn->lastInsertId();

    // Retrieve product details
    $produkId = $input['produk_id'];
    $jumlah = $input['jumlah'];

    $stmt = $conn->prepare("SELECT * FROM produk WHERE produk_id = :produk_id");
    $stmt->execute([':produk_id' => $produkId]);
    $produk = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produk) {
        $harga = $produk['produk_harga'];

        // Insert into transaksi table
        $stmt = $conn->prepare("INSERT INTO transaksi VALUES (NULL, :invoice, :produk, :jumlah, :harga)");
        $stmt->execute([
            ':invoice' => $invoiceId,
            ':produk' => $produkId,
            ':jumlah' => $jumlah,
            ':harga' => $harga
        ]);
    } else {
        throw new Exception("Produk tidak ditemukan.");
    }

    // Commit transaction
    $conn->commit();

    echo json_encode(['status' => 'success', 'invoice_id' => $invoiceId]);
} catch (Exception $e) {
    // Rollback transaction if there is any error
    $conn->rollBack();
    http_response_code(500); // Internal Server Error
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

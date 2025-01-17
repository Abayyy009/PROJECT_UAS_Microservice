<?php
session_start();

$id = $_POST['id'];
$file = $_FILES['bukti'];

// Validasi apakah file ada
if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
	header("location:customer_pesanan.php?alert=gagal");
	exit;
}

// URL microservice untuk upload bukti pembayaran
$url = 'http://localhost/tokoonline/payment_service.php';

// Siapkan data untuk dikirim
$data = ['id' => $id];
$filePath = $file['tmp_name'];
$fileName = $file['name'];
$fileType = $file['type'];

// Siapkan cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

// Tambahkan file menggunakan CURLFile
$cfile = new CURLFile($filePath, $fileType, $fileName);
$data['bukti'] = $cfile;

curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// Eksekusi cURL
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Handle response
$responseData = json_decode($response, true);

if ($httpCode == 200 && isset($responseData['status']) && $responseData['status'] === 'success') {
	header("location:customer_pesanan.php?alert=upload");
} else {
	header("location:customer_pesanan.php?alert=gagal");
}

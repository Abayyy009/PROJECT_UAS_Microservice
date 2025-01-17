<?php
session_start();

$id_customer = $_SESSION['customer_id'];

$data = [
    'customer_id' => $id_customer,
    'nama' => $_POST['nama'],
    'hp' => $_POST['hp'],
    'alamat' => $_POST['alamat'],
    'provinsi' => $_POST['provinsi2'],
    'kabupaten' => $_POST['kabupaten2'],
    'kurir' => $_POST['kurir'] . " - " . $_POST['service'],
    'berat' => $_POST['berat'],
    'ongkir' => $_POST['ongkir2'],
    'total_bayar' => $_POST['total_bayar'] + $_POST['ongkir2'],
    'produk_id' => htmlspecialchars($_POST['produk_id']),
    'jumlah' => htmlspecialchars($_POST['jumlah']),
];

// URL microservice checkout
$url = 'http://localhost/tokoonline/checkout_service.php';

// Kirim data ke REST API menggunakan cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Handle response
if ($httpCode == 200) {
    $responseData = json_decode($response, true);
    if ($responseData['status'] === 'success') {
        header("Location: customer_pesanan.php?alert=sukses");
    } else {
        die("Error: " . $responseData['message']);
    }
} else {
    die("Error connecting to the checkout service. HTTP Code: " . $httpCode);
}

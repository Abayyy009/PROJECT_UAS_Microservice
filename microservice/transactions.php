<?php
include 'koneksi.php'; // Koneksi untuk fitur non-transaksi
require_once './microservice.php'; // Fungsi call microservice

session_start();

$id_customer = $_SESSION['customer_id'];
$tanggal = date('Y-m-d');

// Data yang diterima dari POST
$nama = $_POST['nama'];
$hp = $_POST['hp'];
$alamat = $_POST['alamat'];
$provinsi = $_POST['provinsi2'];
$kabupaten = $_POST['kabupaten2'];
$kurir = $_POST['kurir'] . " - " . $_POST['service'];
$berat = $_POST['berat'];
$ongkir = $_POST['ongkir2'];
$total_bayar = $_POST['total_bayar'] + $ongkir;

$produk_id = htmlspecialchars($_POST['produk_id']);
$jumlah = htmlspecialchars($_POST['jumlah']);

try {
    // Data yang akan dikirim ke microservice
    $data = [
        'tanggal' => $tanggal,
        'customer_id' => $id_customer,
        'nama' => $nama,
        'hp' => $hp,
        'alamat' => $alamat,
        'provinsi' => $provinsi,
        'kabupaten' => $kabupaten,
        'kurir' => $kurir,
        'berat' => $berat,
        'ongkir' => $ongkir,
        'total_bayar' => $total_bayar,
        'produk_id' => $produk_id,
        'jumlah' => $jumlah
    ];

    // Panggil API microservice untuk proses transaksi
    $response = callMicroservice('/transactions', 'POST', $data);

    if ($response['status'] === 201) {
        // Redirect ke halaman sukses jika berhasil
        header("location:customer_pesanan.php?alert=sukses");
    } else {
        // Tampilkan error jika gagal
        throw new Exception("Gagal membuat transaksi: " . $response['response']['message']);
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
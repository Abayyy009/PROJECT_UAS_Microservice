<?php
// menghubungkan dengan koneksi
include 'koneksi.php';

session_start();

// Menghapus semua variabel session terkait customer
unset($_SESSION['customer_id']);
unset($_SESSION['customer_status']);

header("location:index.php");
?>
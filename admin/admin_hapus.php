<?php 
include '../koneksi.php';

$id = $_GET['id'];

// Fetch the admin data
$stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$d = $stmt->fetch(PDO::FETCH_ASSOC);

if ($d) {
    $foto = $d['admin_foto'];

    // Delete the photo if it exists
    if (!empty($foto)) {
        unlink("../gambar/user/$foto");
    }

    // Delete the admin
    $stmt = $conn->prepare("DELETE FROM admin WHERE admin_id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

header("location:admin.php");

<?php 
// menghubungkan dengan koneksi
include 'koneksi.php';

session_start();

$id = $_SESSION['customer_id'];
$password = md5($_POST['password']);

// Persiapan statement update dengan PDO
$sql = "UPDATE customer SET customer_password = :password WHERE customer_id = :id";
$stmt = $koneksi->prepare($sql);

// Bind parameter ke statement
$stmt->bindParam(':password', $password);
$stmt->bindParam(':id', $id);

// Eksekusi statement
if ($stmt->execute()) {
    header("location:customer_password.php?alert=sukses");
} else {
    // Handle error jika query gagal
    // Contoh: header("location:customer_password.php?alert=gagal");
    echo "Gagal mengganti password.";
}
?>

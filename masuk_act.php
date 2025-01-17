<?php
// Database credentials
$host = 'localhost';
$database = 'project';
$user = 'root';
$password = '';

try {
	// Create PDO instance
	$dbh = new PDO("mysql:host=$host;dbname=$database", $user, $password);
	// Set error mode to exception
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Capture data from form
	$email = $_POST['email'];
	$password = md5($_POST['password']); // For secure applications, consider using password_hash

	// Prepare and execute the query
	$stmt = $dbh->prepare("SELECT * FROM customer WHERE customer_email=:email AND customer_password=:password");
	$stmt->bindParam(':email', $email);
	$stmt->bindParam(':password', $password);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($result) {
		session_start();
		// Unset other sessions
		unset($_SESSION['id']);
		unset($_SESSION['nama']);
		unset($_SESSION['username']);
		unset($_SESSION['status']);

		// Set customer session
		$_SESSION['customer_id'] = $result['customer_id'];
		$_SESSION['customer_status'] = "login";
		header("location:customer.php");
		exit;
	} else {
		header("location:masuk.php?alert=gagal");
		exit;
	}
} catch (PDOException $e) {
	echo "Error: " . $e->getMessage();
}

$dbh = null;
?>
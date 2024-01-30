<!-- delete_account.php -->
<?php
include_once 'connect1.php';
$username = $_SESSION['username'];

$sql = "DELETE FROM `Registraion1` WHERE username=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $username);
// $userId should be obtained from the logged-in user's session or any other method
mysqli_stmt_execute($stmt);

// Close database connection

// Redirect to a thank you page or login page
header("Location: login.php"); // or header("Location: login.html");

?>

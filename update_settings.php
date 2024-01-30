
    <!-- update_settings.php -->
<?php
// Establish database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect1.php';
  $password = $_POST["password"];
  $mobile = $_POST["mobile"];

  $username = $_SESSION['username'];
  $npassword = $_SESSION['password'];
  $nmobile = $_SESSION['mobile'];
  // Process uploaded image and store in a folder

  // Update user details in the database
  $sql = "UPDATE `Registration1` SET  password=?, mobile=? WHERE username=?";
  $stmt = mysqli_prepare($conn, $sql);
  if($stmt){
    mysqli_stmt_bind_param($stmt, "sss", $password, $mobile, $username);
  // $userId should be obtained from the logged-in user's session or any other method
    mysqli_stmt_execute($stmt);

  }
  else{
    echo "Error: " . mysqli_error($conn);
  }
  
  // Close database connection
}

// Redirect back to settings page
//header("Location: home2.php");
?>

<?php

$login=0;
$invalid=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect1.php';
    $username = $_POST['username'];
    $mailid = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['num'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $pincode = $_POST['pin'];
    
            session_start();
            $_SESSION['username']=$username;
            $_SESSION['password']=$password;

            $query = "DELETE FROM `Registration1 WHERE username = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s",$username); // "i" indicates integer type
            if ($stmt->execute()) {
                echo "Account deleted successfully.";
                header('location:login.php');
            } else {
                echo "Error deleting account: " . $stmt->error;
            }
            
            $stmt->close();
            $conn->close();

    
    

   

    
}

?>
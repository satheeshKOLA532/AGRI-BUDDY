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
    $image = $_POST['image'];
    

    

    
    

    $sql = "select * from `Registration1` where username='$username' and password='$password'";

    $result = mysqli_query($conn,$sql);
    if($result){
        $num = mysqli_num_rows($result);
        if($num>0){
            $row=mysqli_fetch_assoc($result);
            echo "login successfull";
            $login=1;
            session_start();
            $_SESSION['username']=$username;
            $_SESSION['password']=$password;
            $_SESSION['email']=$row['email'];
            $_SESSION['mobile']=$row['mobile'];
            $_SESSION['country']=$row['country'];
            $_SESSION['state']=$row['state'];
            $_SESSION['pincode']=$row['pincode'];
            $_SESSION['image']=$_SESSION['image'];
            header('location:home2.php');
        }else{

            echo "invalid login credentials!";
            $invalid=1;

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.min.css">

<script src="js/bootstrap.bundle.min.js"></script>

<link href="style.css" rel="stylesheet">

    <title>Farmer Login</title>

    <!-- <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }
        body{
            
            justify-content: center;
            align-items: center;
            height: 100vh;

        }
        select{
            cursor: pointer;
            width: 300px;
            height: 40px;
            border-radius: 15px;
            background-color: rgb(250, 250, 250);
            box-shadow: 2px 4px 8px #c5c5c5;
            border: darkslategray;
            outline: dimgrey;
            margin-top: 30px;
        }
    </style> -->
</head>
<body   >


    <h1 style="text-align: center;"><u>Farmer Login page</u></h1>
   

        <div class="container-fluid mt-5">

        <form action="/crud/project_S/login.php" method="POST">
            
            <br>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="tel" class="form-control" id="username" name="username" required>
            </div>
            <br>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <br>    
            <div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
            
        </form>
    </div>

</body>
</html>
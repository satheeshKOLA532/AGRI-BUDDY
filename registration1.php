<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Details</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

<script src="js/bootstrap.bundle.min.js"></script>


    
</head>
<body>

<?php

$success=0;
$user=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect1.php';
    $username = $_POST['username'];
    $mailid = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['num'];
    //image file operations

    $targetDir = "./uploads/"; // Directory to store uploaded images
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if($user==0){
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 50000000) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow only certain image file formats
    $allowedFormats = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.<br>";
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
}
   /* $file = $_FILES['file'];
    $filename = $_FILES['file']['name'];
    $filetmpname = $_FILES['file']['tmp_name'];
    $filesize = $_FILES['file']['size'];
    $fileerror = $_FILES['file']['error'];
    $filetype = $_FILES['file']['type'];

    $fileExt=  explode('.', $filename);
    $fileactualext = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','pdf');

    if(in_array($fileactualext, $allowed)){
        if($fileerror === 0){
            if($filesize < 50000000){
                $filenamenew = uniqid('IMG-', true).".".$fileactualext;
                $filedestination = 'uploads/'.$filenamenew;
                move_uploaded_file($filetmpname,$filedestination);
                header("location:login.php?uploadsuccess");
            }else
            {
                echo "your file is too large";
            }

        }else{
            echo "There was an error while uploading your file";
        }
    }else{
        echo "you cannot upload files of this type!";
    }
*/
    $country = $_POST['country'];
    $state = $_POST['state'];
    $pincode = $_POST['pin'];

    $sql = "select * from `Registration1` where
        username='$username'";

    $result = mysqli_query($conn,$sql);
    if($result){
        $num = mysqli_num_rows($result);
        if($num>0){
            //echo "username already exists";
            $user=1;
        }else{

            $sql = "insert into `Registration1`(username,email,password,mobile,image,country,state,pincode)
            values('$username','$mailid','$password','$number','$targetFile','$country','$state','$pincode')";
             $result = mysqli_query($conn,$sql);
             if($result){
                echo "Congratulations " .$username. "<br>";
                $success=1;
                session_start();
            $_SESSION['username']=$username;
                
            }else{
                die(mysqli_error($conn));
            }

        }
    }
}
if($user){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Ohh no sorryy</strong> user already exists
    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
//background-image: url(./uploads/carimg/5.jpg)
if($success){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong></strong> <br>your Registration is successfully done!";
    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  echo "<h1>Hey! <b><i>$username </i></b>Your Registration Details:</h1>";
  echo "<p><strong>Username:</strong> $username</p>";
  echo "<p><strong>Email:</strong> $mailid</p>";
  echo "<p><strong>Mobile Number:</strong> $number</p>";
  echo "<p><strong>Country:</strong> $country</p>";
  echo "<p><strong>State:</strong> $state</p>";
  echo "<p><strong>Pincode:</strong> $pincode</p>";
}
?>
    <div class="container-fluid">
        <div class="col-6">
            <h2> hey <?php echo $username ?> Now you can login into your account</h2>
        </div>
    <div class="col-6">
    <a href="login.php" class="btn btn-primary mt-5" style="text-align: end;">Login</a>
    </div>
</div>
</body>
</html>


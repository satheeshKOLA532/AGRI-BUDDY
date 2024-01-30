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
                
            }else{
                die(mysqli_error($conn));
            }

        }
    }
}
if($user){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Ohh no sorryy</strong> user already exists
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
//background-image: url(./uploads/carimg/5.jpg)
if($success){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong></strong> <br>your Registration is successfully done!";
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
  echo "<h1>Form Data</h1>";
  echo "<p><strong>Username:</strong> $username</p>";
  echo "<p><strong>Email:</strong> $email</p>";
  echo "<p><strong>Mobile Number:</strong> $mobile</p>";
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
    

    <title>Farmer registration</title>

        <style>
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
        .registration {
            position: relative;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 650px;

        }
        .registration h1{
            font-size: 40px;
            text-align: center;
            text-transform: uppercase;
            margin: 40px;
        }
        .registration input{
            font-size: 16px;
            padding: 15px 10px;
            width: 100%;
            border: 0;
            border-radius: 0px;
            outline: none;
        }
        

    </style> 
</head>
<body   >

<?php



?>
   

   <!-- <div class="container mt-5">
        
            <br>
            
<br>


           --> 


        <div class="container-fluid">
        <h1 ><u>New farmer registration</u></h1>
        <form action="/crud/project_S/registration1.php" method="POST"
        enctype="multipart/form-data" id="myForm">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" >
            </div>
            <br>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" >
            </div>
            <br>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" >
            </div>
            <br>
            <div class="form-group">
                <label for="cpassword">Confirm Password:</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" >
            </div>
            <br>
            <div class="form-group">
                <label for="num">Mobile</label>
                <input type="tel" class="form-control" id="num" name="num" >
            </div>
            <br>
            <div class="form-group">
                <label for="file">Image:</label>
                <input type="file" class="form-control" id="file" name="image" accept="image/*" >
            </div>
            <br>
<!-- country and state-->
<div class="wrapper">
                <select name ="country" id="countries">
                    <option value="-1">Select country</option>
                    <option value="India">India</option>
                    <option value="srilanka">Sri Lanka</option>
                    <option value="bangladesh">Bangladesh</option>
                    <option value="israel">Israel</option>

                </select>

                <select name="state" id="states">
                    <option value="-1">Select state</option>
                    
                </select>
</div>
<script>

    let countrystates=[
        {
            country:"India",
            code:"India",
            states:["Andhra pradesh","Arunachal pradesh","Assam","Bihar","chattisgarh","Haryana","TamilNadu","Karnakata","Telangana"]
        },
        {
            country:"Srilanka",
            code:"srilanka",
            states:["central","western","north"]
        },
        {
            country:"Bangladesh",
            code:"bangladesh",
            states:["Barishal","Chattogram","Dhaka" ," Khulna"," Rajshahi", " Rangpur", "Mymensingh","Sylhet"]
        },
        {
            country:"israel",
            code:"israel",
            states:["western","north central","central"]
        }
    ]

    let countryselect = document.querySelector('#countries');
    let stateselect = document.querySelector('#states');


    countryselect.onchange = function(){
        stateselect.options.length=0;
        if(countryselect.value!=-1){
            for(ele of countrystates){
           if(countryselect.value == ele.code){
            
            let states = ele.states
            let op = document.createElement('option')
            op.value = -1;
            op.innerText = "Select State";
            stateselect.options[0] = op;

            let i=1; 

            for(state of states){
            let op = document.createElement('option')
            op.value = state;
            op.innerText = state;
            stateselect.options[i] = op;
            i++
            }
             
           }
        }
        }
       
    }
</script>

            <!--<div class="form-group">
                <label for="country">country</label>
                <input type="text" class="form-control" id="country" name="country" required>
            </div>
            <br>
            <div class="form-group">
                <label for="state">state</label>
                <input type="text" class="form-control" id="state" name="state" required>
            </div> -->
            <br>
            <div class="form-group">
                <label for="pin">pincode</label>
                <input type="number" class="form-control" id="pin" name="pin" >
            </div>
            <div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
            </div>

            
        </form>
    </div>

    <script src="formvalidate.js"></script>

   
</body>
</html>
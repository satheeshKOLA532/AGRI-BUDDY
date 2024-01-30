<?php
session_start();
if(!isset($_SESSION['username'],)){
    header('location:login.php');
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect1.php';
    $username = $_POST['username'];
    $mailid = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['num'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $pincode = $_POST['pin'];

    
}   

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Your Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0e68c; /* Pale Goldenrod */
        }

        .header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2em;
        }

        .profile {
            display: flex;
            align-items: center;
        }

        .profile img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 1em;
        }

        .profile h2 {
            margin: 0;
        }

        .content {
            background-color: #fff; /* White */
            border: 1px solid #e0e0e0; /* Light Gray */
            padding: 1em;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div id="google_element"></div>
    <script src="http://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
<script>
	function loadGoogleTranslate(){
		new google.translate.TranslateElement(
			"google_element"
		);
	}
</script>



    <div class="header">
        <h1>Welcome to Your Dashboard</h1>
    </div>

    <div class="container">
        <div class="profile">
           <div class="col-11"><h2>hey <?php echo $_SESSION['username']; ?> how are you today!!<br></h2></div>
            <div class="col-11"> <a href="logout.php" class="btn btn-primary mt-5" style="text-align: end;">Logout</a></div>
        </div>
       
    
        <div class="content mt-4 p-4">
            <h3>Your Dashboard Content</h3>
            <p class="lead">Sof cultivation family welcomes you <?php echo $_SESSION['username']; ?> .</p>
            <p>Healthy living starts here. The agricultural way is our past, present, and future. Making a better world through healthy eats. Feeding the future.
</p>
        </div>
        
        <div class="content mt-4 p-4">
            <h3>Your Account Details</h3>
            <p><strong>Name:</strong> <?php echo $_SESSION['username']; ?></p>
            <p><strong>Password:</strong> <?php echo $_SESSION['password']; ?></p>
            <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
            <p><strong>Mobile:</strong> <?php echo $_SESSION['mobile']; ?></p>
            <p><strong>country:</strong> <?php echo $_SESSION['country']; ?></p>
            <p><strong>state:</strong> <?php echo $_SESSION['state']; ?></p>
            <p><strong>Pincode:</strong> <?php echo $_SESSION['pincode']; ?></p>
            <img src="<?php echo $_SESSION['image']; ?>">
            <!-- Add more account details as needed -->
            
            <a id="editAccountBtn" class="btn btn-primary">Edit Account</a>
        </div>
    </div>

    <a href="/crud/project_S/home2.php"><button id="get-account-button">get account details</button></a>
    <button id="delete-account-button">delete account</button>
    <script>
document.getElementById("delete-account-button").addEventListener("click", function() {
    if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
        // Perform AJAX request to delete account
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "deleteaccount.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                alert(xhr.responseText); // Show success or error message
            }
        };
        xhr.send();
    }
});
</script>



    
    <div class="modal fade" id="editAccountModal" tabindex="-1" role="dialog" aria-labelledby="editAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAccountModalLabel">Edit Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="newUsername">New Username:</label>
                    <input type="text" id="newUsername" class="form-control">
                    <label for="newEmail">New Email:</label>
                    <input type="email" id="newEmail" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="saveChangesBtn" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and Custom JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Edit Account Button Clicked
            $("#editAccountBtn").click(function() {
                $("#newUsername").val($("#username").text());
                $("#newEmail").val($("#email").text());
                $("#editAccountModal").modal("show");
            });

            // Save Changes Button Clicked
            $("#saveChangesBtn").click(function() {
                var newUsername = $("#newUsername").val();
                var newEmail = $("#newEmail").val();

                // Update the account details on the page
                $("#username").text(newUsername);
                $("#email").text(newEmail);

                // Close the modal
                $("#editAccountModal").modal("hide");
            });
        });
    </script>
   

</body>
</html>

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
  /* Styles for the navigation menu */
  .navigation {
    background-color: #336699;
    color: white;
    height: 100vh;
    width: 200px;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 20px;
    transition: left 0.3s ease-in-out;
  }
/* Initial black and white theme */
body {
  background-color: #fff;
  color: #fff;
}

  .navigation a {
    text-decoration: none;
    color: white;
    margin-bottom: 20px;
    padding: 10px;
    width: 80%;
    text-align: left;
    border-radius: 5px;
    transition: background-color 0.3s;
  }

  .navigation a:hover {
    background-color: #557799;
  }

  /* Styles for the main content area */
  .content {
    margin-left: 220px;
    padding: 20px;
    background: linear-gradient(120deg, #c9dadb, #e8f0ed);
  }
  
  /* Styles for the toggle button */
  #navToggleButton {
    cursor: pointer;
    position: fixed;
    top: 20px;
    left: 5px;
    font-size: 20px;
    z-index: 2; /* Ensure the button is on top of other content */
  }

  /* Styles for the account details section */
  .account-details {
    display: none;
    position: absolute;
    
    width: 500px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    padding: 20px;
    background-color: white;
    border-radius: 60px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    background: linear-gradient(120deg, #c9dadb, #e8f0ed);
  }
  
  /* Styles for the profile section */
  .profile {
    text-align: center;
    width: 500px;
  }
  
  .profile-image {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 10px;
  }
  
  .profile-name {
    font-size: 18px;
    font-weight: bolder;
    margin-bottom: 5px;
  }
  
  .profile-email {
    color: #777;
  }
  
  /* Styles for the settings section */
  .settings {
    text-align: center;
  }
  
  .settings-title {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
  }
  
  .settings-options {
    text-align: left;
  }
  
  .settings-option {
    margin-bottom: 10px;
  }
  
  .settings-option label {
    font-weight: bold;
    display: inline-block;
    width: 120px;
  }
  
  .settings-option input[type="text"] {
    width: 200px;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  </style>

    



</head>
<body>


        <div class="navigation" id="navMenu"> <br><br><br><br>
    <a href="#">Dashboard</a>
    <a href="#" onclick="toggleSection('profile')">Profile</a>
    <a href="#" onclick="toggleSection('settings')">Settings</a>
    <a href="/crud/project_S/logout.php" onclick="toggleSection('logout')">Logout</a>
   
  </div>


  <!-- delete_account.html -->
<script>
  function confirmDelete() {
    var confirmation = confirm("Are you sure you want to delete your account?");
    if (confirmation) {
      window.location.href = "delete_account.php";
    }
  }
</script>



  
  <button id="navToggleButton">☰</button>
  

    <div class="content">
      <h1 style="color: darkorange;">hey <?php echo $_SESSION['username'] ?> Welcome to the <i>sof family</i>
            <h3 style="color: darkorange;"> <b><i>how are you doing today?</i></b></h3></h1>
      <!-- Add more profile details as needed -->
    </div>
  </div>




  <div class="account-details" id="profileSection">
    <div class="profile">
    <?php
// Your database connection code
include 'connect1.php';
// Assume you have the user's username from the session
$username = $_SESSION['username'];

// Prepare the SQL query
$sql = "SELECT username, email, password, mobile, image, country, state, pincode FROM `Registration1` WHERE username = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $username);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Bind the result variables
    mysqli_stmt_bind_result($stmt, $resultUsername, $resultEmail, $resultPassword, $resultMobile, $resultProfileImage, $resultCountry, $resultState, $resultPincode);

    // Fetch the result
    mysqli_stmt_fetch($stmt);

    // Display user information
    echo '<img class="profile-image" src="data:image/jpeg;base64,' . base64_encode($resultImage) . '" alt="Profile Image">';
    echo '<div class="profile-name">' . $resultUsername . '</div>';
    echo '<div class="profile-email">' . $resultEmail . '</div>';
    echo '<div class="profile-details">';
    echo '<div>Mobile: ' . $resultMobile . '</div>';
    echo '<div>Country: ' . $resultCountry . '</div>';
    echo '<div>State: ' . $resultState . '</div>';
    echo '<div>Pincode: ' . $resultPincode . '</div>';
    echo '</div>';

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>

    </div>
  </div>
  <!--update profile sectin-->
  
  <div class="account-details" id="settingsSection">
    <div class="settings">



      <div class="settings-title" style="color: #336699;">Theme Settings</div>
      <div class="settings-options">
        <div class="settings-option">
        <button onclick="toggleTheme()" style="color:#336699">change Theme Color(black&whilte)</button>
        </div>
        
        <!-- Add more settings options as needed -->
      </div>
    </div>
  </div>
<script>
  function toggleTheme() {
  const body = document.body;
  const currentBackgroundColor = getComputedStyle(body).backgroundColor;

  if (currentBackgroundColor === "rgb(0, 0, 0)") {
    // Change to white theme
    body.style.backgroundColor = "#fff";
    body.style.color = "#000";
  } else {
    // Change to black theme
    body.style.backgroundColor = "#000";
    body.style.color = "#fff";
  }
}
</script>
  
  <!-- Add sections for profile, logout, and delete account as before -->
  
  <script>
    // JavaScript to toggle navigation menu visibility
    const navMenu = document.getElementById("navMenu");
    const navToggleButton = document.getElementById("navToggleButton");

    navToggleButton.addEventListener("click", () => {
      navMenu.style.left = navMenu.style.left === "0px" ? "-200px" : "0px";
    });

    // JavaScript to toggle sections visibility
    function toggleSection(sectionId) {
      const sections = ["profileSection", "settingsSection", "logoutSection", "deleteAccountSection"];
      sections.forEach((id) => {
        if (id === sectionId + "Section") {
          document.getElementById(id).style.display = "block";
        } else {
          document.getElementById(id).style.display = "none";
        }
      });
    }
  </script>
  <!--language translator-->
<div id="google_element"></div>
<script src="http://translate.google.com/translate_a/element.js?cb=loadGoogleTranslate"></script>
<script>
function loadGoogleTranslate(){
	new google.translate.TranslateElement(
		"google_element"
	);
}
</script>
</body>
</html>
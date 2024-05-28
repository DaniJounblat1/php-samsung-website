<?php
session_start();

$alertMessage = ""; // Variable to store the alert message

// Check if the user is already logged in
if (isset($_SESSION["currentUser"])) {
  // User is already logged in, redirect to the transaction ID page
  if (isset($_GET["method"]) && $_GET["method"] === "checkout") {
    // Redirect to the transaction ID page
    header("Location:../html/transaction.php");
  } elseif (isset($_GET["method"]) && $_GET["method"] === "repair") {
    // Redirect to the transaction ID page
    header("Location:../html/repair.html");
  } else {
    // Redirect to the index page
    header("Location:../html/welcom.php");
  }
  exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve the form data
  $email = $_POST["email"];
  $password = $_POST["password"];

  // <Data></Data>base connection
  require "connection.php";

  // Check if email and password match in the database
  $checkQuery = "SELECT * FROM payment WHERE Email = '$email'";
  $checkResult = $conn->query($checkQuery);

  if ($checkResult->num_rows > 0) {
    // Email exists in the database, check password
    $row = $checkResult->fetch_assoc();
    if ($row["password"] == $password) {
      // Login successful
      $alertMessage = "Login successful.";
      $_SESSION["currentUser"] = $row; // Store the logged-in user information in the session
      $_SESSION["currentUserEmail"] = $row["Email"];

      // Check if the query parameter 'method' is set and its value
      if (isset($_GET["method"]) && $_GET["method"] === "checkout") {
        // Redirect to the transaction ID page
        header("Location:../html/transaction.php");
      } elseif (isset($_GET["method"]) && $_GET["method"] === "repair") {
        // Redirect to the transaction ID page
        header("Location:../html/repair.html");
      } else {
        // Redirect to the index page
        header("Location: ../index.php");
      }
      exit(); // Terminate the current script to ensure the redirect takes place
    } else {
      // Incorrect password
      $alertMessage = "Incorrect password. Please try again.";
    }
  } else {
    // Email does not exist in the database
    $alertMessage = "Invalid email. Please try again.";
  }

  // Close the database connection
  $conn->close();
}
?>






<!DOCTYPE html>
    <head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../css/all.min.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/login.css">
        <link rel="stylesheet" href="../css/login2.css"> 
        <link rel="icon" href="../img/logo.avif" type="image/x-icon">
    <link rel="shortcut icon" href="../img/logo.avif" type="image/x-icon">

    <link rel="stylesheet" href="../css/footer.css">
   
    <link rel="stylesheet" href="../css/translate.css">

</head>
<body>
  <script>
    function googleTranslateElementInit() {
      new google.translate.TranslateElement(
        { pageLanguage: 'en', includedLanguages: 'ar', layout: google.translate.TranslateElement.InlineLayout.SIMPLE },
        'google_translate_element'
      );
    }
  </script>
  <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

  <!-- Translate Button -->
  <div id="google_translate_element" class="translate-button"></div>
   <header class="header">
    <a href="..\index.php" class="logo">Home</a>
    <nav class="navigation">
        
        
    </nav>
</header>
<br>
<form id="side-menu-login-form" action="" method="post"> 
        <section class="login">
            <div class="container d-flex justify-content-center align-items-center h-100">
                <div class="login-info text-center p-5">
                    <h2 class="text-center mb-5 fw-bold">Login</h2>

                    <div class="input-group my-3">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email"  class="form-control" id="logEmail" placeholder="Email" required >
                    </div>

                    <div class="input-group mb-4">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" id="logPass" placeholder="Password" 
                       required >
                    </div>
                    
                    <div id="invalidAlert">All inputs is required</div>
                    <div id="correction">incorrect email or password</div>
                    <div class="mt-4 w-75 m-auto">
                    <?php echo $alertMessage; ?>
        <div id="inputBox">
    <div class="button-row">
        <button class="btn main-bg" id="login-btn" type="submit" onclick="submitLoginForm()"> Login</button>
     
        <button type="button" class="cancelbtn" onclick="window.location.href='../index.php'">Cancel</button>
    
    </div>
    
</div>
    
    </form>
  <br>                   
 <span class=" font-style">Dont have an account?</span>
                            <a href="../html/sign.php" class="main-color sign-link">Sign Up Now!</a>
                    </div>
                </div>

                
            </div>
         
        </section>

        <script src="../js/jquery-3.6.0.min.js"></script>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        
       </body>
</html>
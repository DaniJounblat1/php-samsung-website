<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['currentUser'])) {
  // Redirect to the login page
  header("Location: ../html/login.php");
  exit();
}

// Retrieve the user's information from the session
$email = $_SESSION['currentUser']['email'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>User Profile</title>
  <link rel="stylesheet" href="../css/welcom.css">

  <link rel="stylesheet" href="../css/translate.css">
  <link rel="icon" href="../img/logo.avif" type="image/x-icon">
    <link rel="shortcut icon" href="../img/logo.avif" type="image/x-icon">

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
  <div class="container">
    <h1>Welcome!</h1>
     <p class="message">You are already signed in.</p>
    <p>Email: <?php echo $email; ?></p>
   
    <a class="button" href="../index.php">Home</a>
    <a class="button" href="../html/logout2.php">Logout</a>
  </div>
</body>
</html>

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['currentAdmin'])) {
  // Redirect to the login page
  header("Location: ../html/adminlogin.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Serial Number Page</title>
    <link rel="stylesheet" href="../css/feedback.css">
    <link rel="icon" href="../img/logo.avif" type="image/x-icon">
<link rel="shortcut icon" href="../img/logo.avif" type="image/x-icon">
<link rel="icon" href="../img/logo.avif" type="image/x-icon">
    <link rel="shortcut icon" href="../img/logo.avif" type="image/x-icon">

    <style>
      /* Global Styles */
body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  margin: 0;
  padding: 0;
}

h1 {
  text-align: center;
  margin-top: 30px;
}

/* Navigation Styles */
nav {
  background-color: #333;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

nav ul li {
  display: inline-block;
}

nav ul li a {
  display: block;
  color: #fff;
  text-decoration: none;
  padding: 10px 20px;
}

/* Table Styles */
table {
  width: 80%;
  margin: 20px auto;
  border-collapse: collapse;
  border: 1px solid #ccc;
  background-color: #fff;
}

table th, table td {
  padding: 10px;
  text-align: center;
  border: 1px solid #ccc;
}

table th {
  background-color: #333;
  color: #fff;
}

/* Translate Button Styles */
.translate-button {
  text-align: center;
  margin-bottom: 20px;
}

    </style>
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
<nav>
        <ul>
            <li><a  href="../index.php" class="del">Home</a></li>
            <li><a  href="../html/logout.php" class="del">logout</a></li>

        </ul>
</nav>

    <h1>Serial Numbers</h1>
    <?php
session_start(); // Start the session

// ...

// Database connection settings
require 'connection.php';
$email = $_SESSION['currentUser']['email'];

// Fetch serial numbers from the repair table
$sql = "SELECT serialnb FROM repair";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data as a table
    echo "<table>";
    echo "<tr><th>Email</th><th>Serial Number</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" .$email . "</td><td>" . $row["serialnb"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No serial numbers found in the database.";
}

// Close connection
$conn->close();
?>

</body>
</html>

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

    <meta charset="UTF-8">
    <title>Feedback Messages</title>
     <link rel="stylesheet" href="../css/feedback.css">
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

<nav>
        <ul>
            <li><a  href="../index.php" class="del">Home</a></li>
            <li><a  href="../html/logout.php" class="del">logout</a></li>

        </ul>
</nav>

<?php
require 'connection.php';

$role = 'Repair';
$query = "SELECT name, email, message, message_time, feedback_type FROM feedback WHERE feedback_type = 'Repair'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<h1>Repair Messages</h1>";

    while ($row = $result->fetch_assoc()) {
        $name = $row['name'];
        $email = $row['email'];
        $message = $row['message'];
        $messageTime = $row['message_time'];
        $feedbackType = $row['feedback_type'];
        ?>

        <div class="message-container">
            <span class="name"><?php echo $name; ?></span><br>
            <span class="email"><?php echo $email; ?></span><br>
            <span><?php echo $message; ?></span><br>
            <span class="message-time"><?php echo $messageTime; ?></span><br>
            <span>Feedback Type: <?php echo $feedbackType; ?></span><br>
            <button class="email-button" onclick="redirectToGmail('<?php echo $email; ?>')">Reply</button>
        </div>

        <?php
    }
} else {
    echo "<h1>No messages found for Repair</h1>";
}

$conn->close();

?>

<script>
    function redirectToGmail(email) {
        var mailtoLink = 'mailto:' + email;
        window.location.href = mailtoLink;
    }
</script>

</body>
</html>

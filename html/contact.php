<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us</title>
<link rel="stylesheet" href="../css/contact.css">
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/translate.css">
<link rel="icon" href="../img/logo.avif" type="image/x-icon">
<link rel="shortcut icon" href="../img/logo.avif" type="image/x-icon">
<style>#emailError { color: red; font-size: 0.8rem; margin-top: 0.2rem; }</style>
</head>
<body>
<header class="header">
    <a href="../index.php" class="logo">Home</a>
</header>
<br>
<center>
    <h2>Contact Us</h2>
</center>
<br>
<form action="contact.php" method="post" onsubmit="return validateForm()">
    <label for="name">Name:</label>
    <input type="text" id="name" required name="name" value="<?php echo isset(
      $_POST["name"]
    )
      ? $_POST["name"]
      : ""; ?>">
    <label for="email">Email:</label>
    <input type="email" id="email" required name="email" pattern="^[a-zA-Z0-9._%+-]+@gmail.com$" value="<?php echo isset(
      $_POST["email"]
    )
      ? $_POST["email"]
      : ""; ?>" />
    <center><span id="emailError"></span></center>
    <br>
    <label for="message">Message:</label>
    <select name="feedback_type" id="feedback_type">
        <option value="Feedback" <?php if (
          isset($_POST["feedback_type"]) &&
          $_POST["feedback_type"] == "Feedback"
        ) {
          echo "selected";
        } ?>>Feedback</option>
        <option value="Repair" <?php if (
          isset($_POST["feedback_type"]) &&
          $_POST["feedback_type"] == "Repair"
        ) {
          echo "selected";
        } ?>>Repair</option>
        <option value="Crushed products" <?php if (
          isset($_POST["feedback_type"]) &&
          $_POST["feedback_type"] == "Crushed products"
        ) {
          echo "selected";
        } ?>>Crushed products</option>
        <option value="Suggestion" <?php if (
          isset($_POST["feedback_type"]) &&
          $_POST["feedback_type"] == "Suggestion"
        ) {
          echo "selected";
        } ?>>Suggestion</option>
    </select>
    <textarea id="message" required name="message"><?php echo isset(
      $_POST["message"]
    )
      ? $_POST["message"]
      : ""; ?></textarea>
    <center>
        <div class="rating">
            <h6>Based on your experience at Samsung website, how likely are you to recommend visiting Samsung website to your friends or colleagues?</h6>
            <?php for ($i = 5; $i >= 1; $i--) {
              echo '<input type="radio" name="rating" id="star' .
                $i .
                '" value="' .
                $i .
                '" ' .
                (isset($_POST["rating"]) && $_POST["rating"] == $i
                  ? "checked"
                  : "") .
                ">";
              echo '<label for="star' . $i . '" class="star">&#9733;</label>';
            } ?>
        </div>
        <input type="submit" value="Send">
    </center>

    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    require "../html/connection.php";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Validate and sanitize the input data
      $name = $_POST["name"];
      $email = $_POST["email"];
      if (
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        !preg_match('/@gmail.com$/', $email)
      ) {
        $error = "Invalid email address!";
        echo "<script>document.querySelector('#emailError').textContent = '$error';</script>";
        return false;
      }
      $feedbackType = $_POST["feedback_type"];
      $message = $_POST["message"];
      $rating = isset($_POST["rating"]) ? $_POST["rating"] : null; // Use isset() to check if the rating is provided

      // Sanitize the input data
      $name = $conn->real_escape_string($name);
      $email = $conn->real_escape_string($email);
      $feedbackType = $conn->real_escape_string($feedbackType);
      $message = $conn->real_escape_string($message);

      // Insert the feedback into the database
      $sql =
        "INSERT INTO feedback (name, email, message, rating, feedback_type)
                VALUES ('$name', '$email', '$message', " .
        ($rating ? $rating : "NULL") .
        ", '$feedbackType')";

      if ($conn->query($sql) === true) {
        echo "<center>Thank you for your feedback! <br>We will reply soon via Email</center>";
      } else {
        echo "Error: " . $conn->error;
      }
    }

    // Close the database connection
    $conn->close();
    ?>
</form>
<script>
function validateForm() {
    let emailError = document.querySelector('#emailError');
    if (emailError.textContent) {
        return false;
    }
}
</script>
<br><br><br>
<?php include "../html/footer.html"; ?>
<script>
const stars = document.querySelectorAll('.rating input');
const ratingValue = document.querySelector('#rating-value');

stars.forEach(star => {
    star.addEventListener('change', (e) => {
        let selectedRating = e.target.value;
        let ratingText = selectedRating + " star" + (selectedRating == 1 ? "" : "s") + " selected";
        highlightStars(selectedRating);
        ratingValue.textContent = ratingText;
    });
});

function highlightStars(selectedRating) {
    const starLabels = document.querySelectorAll('.rating label.star');
    starLabels.forEach((starLabel, index) => {
        if (index < selectedRating) {
            starLabel.classList.add('selected');
        } else {
            starLabel.classList.remove('selected');
        }
    });
}
</script>
</body>
</html>

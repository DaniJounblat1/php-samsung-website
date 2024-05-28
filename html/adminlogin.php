<?php
session_start();

// Check if the Admin is already logged in and 'role' is set in the session
if (isset($_SESSION['currentAdmin'], $_SESSION['role'])) {
    // Admin is already logged in, redirect to the appropriate page based on their role
    $role = $_SESSION['role'];
    switch ($role) {
       

        case 'Repair':
            header("Location: ../html/repairMessage.php");
            exit();
        case 'Crushed products':
            header("Location: ../html/crushedMessage.php");
            exit();
        case 'Suggestion':
            header("Location: ../html/suggestionMessage.php");
            exit();
        case 'Feedback':
            header("Location: ../html/feedbackMessage.php");
            exit();
         case 'serial':
            header("Location: ../html/serial.php");
            exit();
        case 'Admin':
            header("Location: ../html/admin.php");
            exit();
    }
}

// Establish database connectionrequire 'connection.php';
require 'connection.php';
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Check if there are no input errors
    if (empty($email_err) && empty($password_err)) {
        // Check email and password combinations
        if ($email === 'repair@gmail.com' && $password === 'repair123') {
            // Set session variables
            $_SESSION['currentAdmin'] = true;
            $_SESSION['role'] = 'Repair';
            // Redirect to repairMessage.php
            header("Location: ../html/repairMessage.php");
            exit();
        } elseif ($email === 'crushed@gmail.com' && $password === 'crushed123') {
            // Set session variables
            $_SESSION['currentAdmin'] = true;
            $_SESSION['role'] = 'Crushed products';
            // Redirect to crushedMessage.php
            header("Location: ../html/crushedMessage.php");
            exit();
        } elseif ($email === 'suggestion@gmail.com' && $password === 'suggestion123') {
            // Set session variables
            $_SESSION['currentAdmin'] = true;
            $_SESSION['role'] = 'Suggestion';
            // Redirect to suggestionMessage.php
            header("Location: ../html/suggestionMessage.php");
            exit();
        } elseif ($email === 'feedback@gmail.com' && $password === 'feedback123') {
            // Set session variables
            $_SESSION['currentAdmin'] = true;
            $_SESSION['role'] = 'Feedback';
            // Redirect to feedbackMessage.php
            header("Location: ../html/feedbackMessage.php");
            exit();
        } elseif ($email === 'admin@gmail.com' && $password === 'admin123') {
            // Set session variables
            $_SESSION['currentAdmin'] = true;
            $_SESSION['role'] = 'Admin';
            // Redirect to admin.php
            header("Location: ../html/admin.php");
            exit();
        }
        elseif ($email === 'serial@gmail.com' && $password === 'serial123') {
            // Set session variables
            $_SESSION['currentAdmin'] = true;
            $_SESSION['role'] = 'serial';
            // Redirect to admin.php
            header("Location: ../html/serial.php");
            exit();
        } else {
            // Invalid email or password
            $login_err = "<center>Invalid email or password.</center>";
        }
    }

    // Close connection
    $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/adminlogin.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="icon" href="../img/logo.avif" type="image/x-icon">
<link rel="shortcut icon" href="../img/logo.avif" type="image/x-icon">

</head>
<body>
<header class="header">
    <a href="..\index.php" class="logo">Home</a>
    <nav class="navigation">

    </nav>
</header>
<br>
<div class="wrapper">
    <h2> Admin Login</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
            <span class="help-block"><?php echo $email_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password:</label>
            <input type="password" name="password">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="submit-btn" value="Login">
        </div>
        <span class="help-block"><?php echo $login_err; ?></span>
    </form>
</div>
</body>
</html>

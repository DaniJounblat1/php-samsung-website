<?php
// Start session
session_start();

// Check if the currentAdmin session is set
if (isset($_SESSION['currentAdmin'])) {
    // Unset the currentAdmin session
    unset($_SESSION['currentAdmin']);

    // Redirect to the login page for admins
    header("Location: ../html/adminlogin.php");
    exit();
} else {
    // Redirect to an appropriate page when the currentAdmin session is not set
    header("Location: ../index.php");
    exit();
}
?>

<?php
// Start session
session_start();

// Check if the currentUser session is set
if (isset($_SESSION['currentUser'])) {
    // Unset the currentUser session
    unset($_SESSION['currentUser']);

    // Redirect to the login page for users
    header("Location: ../html/login.php");
    exit();
} else {
    // Redirect to an appropriate page when the currentUser session is not set
    header("Location: ../index.php");
    exit();
}
?>

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['currentUser'])) {
  // Redirect to the login page
  header("Location: ../index.php");
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serialNumber = $_POST['serial-number-field'];

    // Validate the serial number (optional)
    if (strlen($serialNumber) !== 11) {
        echo "Please enter an 11-digit serial number.";
        exit;
    }

    // Connect to your database
    require 'connection.php';

    // Prepare and execute the SQL statement to insert the serial number
    $stmt = $conn->prepare("INSERT INTO repair (serialnb) VALUES (?)");
    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt->bind_param("s", $serialNumber);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "Serial number submitted successfully. Repair ID: " . $stmt->insert_id;

        // Delay the redirect by 3 seconds
        sleep(3);

        // Redirect to the index page
        header("Location: ../index.php");
        exit();
    } else {
        echo "Failed to submit the serial number.";
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>

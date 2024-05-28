<?php
$host = "localhost";
$username = "dani";
$password = "dani2003";
$dbname = "mydata";

// Create a mysqli database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

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
    <title>Product List</title>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="icon" href="../img/logo.avif" type="image/x-icon">
    <link rel="shortcut icon" href="../img/logo.avif" type="image/x-icon">
<style>
      @media (max-width: 500px) {
    
  h1{
      padding-top: 10%;
  }
   table {
   width: 320px; 
   } 
}
</style>
  </head>
  <body>
    
    <nav>
        <ul>
            <li><a href="../index.php" class="del">Home</a></li>
            <li><a href="../html/insert_product.php" class="del">Add New Product</a></li>
            <li><a href="../html/logout.php" class="del">logout</a></li>
        </ul>
    </nav>
    <h1>Product List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    <?php
// Include the db_connection.php file that contains the MySQLi connection code
require 'connection.php';

// Handle product deletion
if (isset($_GET['delete'])) {
    $productId = $_GET['delete'];

    // Prepare and execute the DELETE query
    $deleteQuery = "DELETE FROM product WHERE idproduct = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $stmt->close();
}

// Fetch product data from the "product" table
$query = "SELECT * FROM product";
$result = $conn->query($query);

// Check if there are any results
if ($result->num_rows > 0) {
    // Loop through the fetched data and display each product row
    while ($product = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $product['idproduct'] . "</td>";
echo "<td><img src='" . $product['productimage'] . "' alt='" . $product['productname'] . "'></td>";
echo "<td>" . $product['productname'] . "</td>";
echo "<td>" . $product['productprice'] . "$</td>";
echo "<td>";

        echo "<a href='../html/update_product.php?id=".$product['idproduct']."'>update</a>";
        echo "<a href='?delete=".$product['idproduct']."' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No products found.</td></tr>";
}

// Close the database connection
$conn->close();
?>

    </table>
    
</body>
</html>

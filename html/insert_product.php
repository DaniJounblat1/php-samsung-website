<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["currentAdmin"])) {
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
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="../css/update_styles.css">
    <link rel="stylesheet" href="../css/translate.css">
    <link rel="icon" href="../img/logo.avif" type="image/x-icon">
    <link rel="shortcut icon" href="../img/logo.avif" type="image/x-icon">
</head>
<body>

    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../html/admin.php">Admin Page</a></li>
        </ul>
    </nav>
    <center><h1>Add Product</h1></center>

    <?php
    require "connection.php"; // Ensure you have this file for the database connection

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $productType = $_POST["product_type"];
      $productName = $_POST["product_name"];
      $productPrice = $_POST["product_price"];

      // Setup file path and move uploaded file
      $target_dir = "/img/"; // Make sure this directory exists and is writable
      $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
      move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

      // Prepare and execute the INSERT query
      $insertQuery =
        "INSERT INTO product (producttype, productname, productprice, productimage) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($insertQuery);
      $stmt->bind_param(
        "ssds",
        $productType,
        $productName,
        $productPrice,
        $target_file
      );

      if ($stmt->execute()) {
        echo "Product added successfully.";
      } else {
        echo "Error: " . $stmt->error;
      }

      $stmt->close();
    }

    $conn->close();
    ?>

    <form method="POST" action="<?php echo htmlspecialchars(
      $_SERVER["PHP_SELF"]
    ); ?>" enctype="multipart/form-data">
        <label for="product_type">Product Type:</label>
        <select name="product_type" required>
            <option value="">Select Product Type</option>
            <option value="Watch">Watch</option>
            <option value="TV">TV</option>
            <option value="Buds">Buds</option>
            <option value="Samsung A Series">Samsung A Series</option>
            <option value="Samsung S Series">Samsung S Series</option>
            <option value="Samsung Z Series">Samsung Z Series</option>
        </select>
        <br><br>
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required><br><br>
        <label for="product_price">Product Price:</label>
        <input type="text" name="product_price" required><br><br>
        <label for="product_image">Product Image:</label>
        <input type="file" name="product_image" required><br><br>
        <input type="submit" value="Add Product">
    </form>
</body>
</html>

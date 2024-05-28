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

    <title>Update Product</title>
    <link rel="stylesheet" type="text/css" href="../css/update_styles.css">
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
            <li><a href="../index.php">Home</a></li>
            <li><a href="../html/insert_product.php">Add New Product</a></li>
            <li><a href="../html/admin.php">Admin Page</a></li>
        </ul>
    </nav>
    <center><h1>Update Product</h1></center> 

    <?php
    // Database configuration
    require "connection.php";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $productId = $_POST["product_id"];
      $productType = $_POST["product_type"];
      $productName = $_POST["product_name"];
      $productPrice = $_POST["product_price"];
      $productImage = $_FILES["product_image"]["tmp_name"];

      // Setup file path and move uploaded file
      $target_dir = "/img/";
      $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
      move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file);

      // Prepare and execute the UPDATE query
      $updateQuery =
        "UPDATE product SET producttype = ?, productname = ?, productprice = ?, productimage = ? WHERE idproduct = ?";
      $stmt = $conn->prepare($updateQuery);
      $stmt->bind_param(
        "ssssi",
        $productType,
        $productName,
        $productPrice,
        $target_file,
        $productId
      );
      $stmt->execute();
      $stmt->close();

      echo '<h1 style="color:green">Product updated successfully.</h1>';
    }

    // Retrieve product details from the database based on the provided product ID
    if (isset($_GET["id"])) {
      $productId = $_GET["id"];

      // Prepare and execute the SELECT query
      $selectQuery = "SELECT * FROM product WHERE idproduct = ?";
      $stmt = $conn->prepare($selectQuery);
      $stmt->bind_param("i", $productId);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        // Display the form with pre-filled product details
        ?>
            <form method="POST" action="<?php echo $_SERVER[
              "PHP_SELF"
            ]; ?>" enctype="multipart/form-data"> 
                <input type="hidden" name="product_id" value="<?php echo $product[
                  "idproduct"
                ]; ?>">
                <label for="product_type">Product Type:</label>
                <input type="text" name="product_type" value="<?php echo $product[
                  "producttype"
                ]; ?>"><br><br>
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" value="<?php echo $product[
                  "productname"
                ]; ?>"><br><br>
                <label for="product_price">Product Price:</label>
                <input type="text" name="product_price" value="<?php echo $product[
                  "productprice"
                ]; ?>"><br><br>
                <label for="product_image">Product Image:</label>
                <input type="file" name="product_image"><br><br>
                <input type="submit" value="Update Product">
            </form>
            <?php
      } else {
        echo '<h1 style="color:red">Product not found.</h1>';
      }

      $stmt->close();
    } else {
      echo '<h1 style="color:red">No product ID provided.</h1>';
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Samsung A Series Phones</title>
    <script>
    document.getElementsByTagName("html")[0].className += " js";
    </script>
    <link rel="stylesheet" href="..\css/nav.css">
    <link rel="stylesheet" href="..\css/footer.css">
    <link rel="icon" href="../img/logo.avif" type="image/x-icon">
    <link rel="shortcut icon" href="../img/logo.avif" type="image/x-icon">

    <link rel="stylesheet" href="..\cart\css/cart-style.css">
     <link rel="stylesheet" href="../css/translate.css">
     <link rel="stylesheet" href="../css/samsung-types.css">
</head>
<body>
 
  <div class="cd-cart cd-cart--empty js-cd-cart">
    <a href="#0" class="cd-cart__trigger text-replace">
      Cart
      <ul class="cd-cart__count">
        <li>0</li>
        <li>0</li>
      </ul>
    </a>
  
    <div class="cd-cart__content">
      <div class="cd-cart__layout">
        <header class="cd-cart__header">
          <h2>Cart</h2>
          <span class="cd-cart__undo">Item removed. <a href="#0">Undo</a></span>
        </header>
  
        <div class="cd-cart__body">
          <ul id="cart-list">
            <!-- Products added to the cart will be inserted here using JavaScript -->
          </ul>
        </div>
  
        <footer class="cd-cart__footer">
          <a href="#" class="cd-cart__checkout" id="checkout-btn">
            <em>Checkout - <span id="cart-total">0</span></em>
            <svg class="icon icon--sm" viewBox="0 0 24 24">
              <g fill="none" stroke="currentColor">
                <line stroke-width="2" stroke-linecap="round" stroke-linejoin="round" x1="3" y1="12" x2="21" y2="12" />
                <polyline stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="15,6 21,12 15,18 " />
              </g>
            </svg>
          </a>
        </footer>
      </div>
    </div>
  </div>
  
   
        <script>
    document.getElementById("checkout-btn").addEventListener("click", function(event) {
      event.preventDefault(); // Prevent the default behavior of the link
  
      // Redirect the user to the login page with the query parameter indicating the login method
      window.location.href = "../html/login.php?method=checkout";
    });
  </script>
  	<!-------------------------------------------------------------------------------------->
	<section id="section6">
		<header class="header">
		    
			<div class="header1">
    <a href="../index.php" class="logo">SAMSUNG</a>
	<div class="title">
			<p>Galaxy Z Series </p>
		</div>
		</div>
		<div class="header2">
    <nav class="navigation">
		
        <a href="../html/SamsungS.php">SAMSUNG S</a>
        <a href="../html/SamsungA.php">SAMSUNG A</a>
        </div>
    </nav>
		</header>
		<!-- ------------------------------- -->
    <div class="all">
    <?php
require 'connection.php';

// Fetch Samsung A series products from the database
$query = "SELECT * FROM product WHERE producttype = 'Samsung Z Series'";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Loop through the Samsung A series products and display them
    while ($row = mysqli_fetch_assoc($result)) {
        $productName = $row['productname'];
        $productPrice = $row['productprice'];
        $productImage = $row['productimage'];

        echo '
        <div class="phone">
            <h2>' . $productName . '</h2>
            <img src="' . $productImage . '" alt="' . $productName . '">
            <p>Price: ' . $productPrice . '$</p>
            <button class="js-cd-add-to-cart" 
                    data-price="' . $productPrice . '" 
                    data-product-id="1" 
                    data-product-name="' . $productName . '" 
                    data-product-price="' . $productPrice . '" 
                    data-product-image="' . $productImage . '">
                Add to cart
            </button>    
        </div>';
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    echo 'Error executing the query: ' . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

    </div>

<?php include '../html/footer.html'; ?>
          <script src="..\cart\js\util.js"></script> 
          <script src="../cart/js/cart.js"> </script>
</body>
</html>

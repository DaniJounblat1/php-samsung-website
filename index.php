<?php
include "html/connection.php"; ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SAMSUNG Electronics</title>
<link rel="stylesheet" href="css\index.css">
<script>document.getElementsByTagName("html")[0].className += " js";</script>
<link rel="stylesheet" href="cart/css/cart-style.css">
<link rel="stylesheet" href="css/nav.css">
<link rel="stylesheet" href="css/footer.css">
<link rel="stylesheet" href="css/translate.css">
<link rel="icon" href="img/logo.avif" type="image/x-icon">
<link rel="shortcut icon" href="img/logo.avif" type="image/x-icon">

</head>
<body>
  <div class="index">
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
    window.location.href = "html/login.php?method=checkout";
  });
</script>





 
  <section class="section" id="samsung">
<!-- --------------------------------------->
<header class="header">   
<a href="index.php" class="logo">SAMSUNG</a>
   <div class="header2">
    <div class="navigation">
        
             <a href="#samsunga" class="nav-link"> <img src="img/smartphone.png" class="nav-img" alt=""></a>

<a href="#watchs"> <img src="img/smart-watch.png" alt="" class="nav-img"></img>
</a>

<a href="#TVs"> <img src="img/television.png" alt="" class="nav-img"></img> </a>

<a href="#buds"> <img src="img/headphones.png" alt="" class="nav-img"></img></a>


        <a href="#" id="repairPage"> <img src="img/repair-tool.png" alt="" class="nav-img"></img>
        </a>
        <nav>
    <a href="#0">    <img src="img/list.png" class="nav-img" alt="List Icon" onclick="openSideMenu()"></a>
  </nav>

  <!-- Side Menu -->
  <div id="sideMenu" class="side-menu">
    <div class="side-menu-content">
      <!-- Content of the menu goes here -->
      <h3 class="services">Services</h3>
      <br>
     <a href="html/sign.php" id="login-link"> <img src="img/add-friend.png" alt="Add User" class="menu-icon"><span> Sign Up/Sign In</span> </a>
<script>
    document.getElementById("login-link").addEventListener("click", function () {
  // Clear the login flow in session storage
  sessionStorage.removeItem("loginFlow");
});

</script>
      <br>
      
      <br>
      <a href="html/warranty.php"
        class="menu-style">
        <img src="img/warranty.png" alt="Add User" class="menu-icon"><span>Warranty info</span></a>
        
        <br>
      <br>
        <a href="html/contact.php" class="menu-style">
            <img src="img/contact.png" alt="Add User" class="menu-icon"><span> Contact & Review</a>
      
        <script>
  document.getElementById("repairPage").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default behavior of the link

    // Redirect the user to the login page with the query parameter indicating the login method
    window.location.href = "html/login.php?method=repair";
  });
</script>

        <br>
      <br>
        <a href="html/security.php"
        class="menu-style">
        <img src="img/privacy-policy.png" alt="Add User" class="menu-icon"><span>Privacy & Security</a>
        
        <br>
      <br>
      
      <a href="html/dmg.php" class="menu-style">
          <img src="img/damaged-package.png" alt="Add User" class="menu-icon"><span>crushed products </a>
        <br>
      <br>
      <a href="html/FAQs.php"
        class="menu-style">
        <img src="img/question.png" alt="Add User" class="menu-icon"><span>FAQs</a>
        <br> <br>

        
        <a href=""
        class="menu-style" id="adminPage">
        <img src="img/software-engineer.png" alt="Add User" class="menu-icon"><span>Admin</a>
        <br>
        <script>
  document.getElementById("adminPage").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default behavior of the link

    // Redirect the user to the login page with the query parameter indicating the login method
    window.location.href = "html/adminlogin.php?method=admin";
  });
</script>
    </div>
    
    <span class="close-btn" onclick="closeSideMenu()"> &times;
</span>

  </div>      
</div>
     </div>  
    </nav>
</header>

<!-- -------------------------------------- -->

<div class="slideshow-container">

  <div class="mySlides fade">
    <div class="numbertext"></div>
    <img class="slide-img" src="img/slide2.jpg">
    <div class="text"></div>
  </div>
  <div class="mySlides fade">
    <div class="numbertext"></div>
    <img class="slide-img" src="img/slide.jpg">
    <div class="text"></div>
  </div>
  <div class="mySlides fade">
    <div class="numbertext"></div>
    <video class="slide-video" muted autoplay loop>
      <source src="img/slidevideo1.mp4" type="video/mp4">
    </video>
    <div class="text"></div>
  </div>
  <a class="prev" onclick="plusSlides(1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>




</section> 

<!-- ========================================  samsung  A ===================================       -->

		<section class="section2" id="samsunga">
      <div class="title">
        <h1>Check our availble Mobile Series</h1>
        </div>
       
        <div class="all">
        <div class="phone">
          <img id="A1" src="img\A.png"  alt="">
          <h2 class="name">Samsung A Series</h2>
          <div class="button-container">
            <button>
              <a href="html\SamsungA.php">Shop Now</a>
            </button>

        </div>
        </div>
        <div class="phone">
          <img  id="SseriesImg" src="img\c.png"   alt="">
          <h2 class="name">Samsung S Series</h2>
          <div class="button-container">
            <button>
              <a href="html\SamsungS.php">Shop Now</a>
            </button>      
            </div>
        </div>
        <div class="phone">
          <img  id="A3" src="img\zPage.png" alt="">
          
        <h2 class="name">Samsung Z Series</h2>
        <div class="button-container">
          <button>
            <a href="html\SamsungZ.php">Shop Now</a>
          </button>
                </div>
        </div>
    </section>
<!-- ========================================  samsung  S ===================================       -->

<section class="section3" id="watchs">
  <div class="title">
    <h1>Samsung Watches</h1>
  </div>

  <div class="all">
  <?php
  // Fetch TV products from the database
  $query = "SELECT * FROM product WHERE producttype = 'watch'";
  $result = $conn->query($query);

  // Check if the query was successful
  if ($result) {
    // Loop through the TV products and display them
    while ($row = $result->fetch_assoc()) {
      $productName = $row["productname"];
      $productPrice = $row["productprice"];
      $productImage = $row["productimage"];

      echo '
        <div class="phone wrap">
            <img src="' .
        $productImage .
        '" alt="' .
        $productName .
        '">
            <h2 class="name">' .
        $productName .
        '</h2>
            <span class="price">' .
        $productPrice .
        '$</span>
            <div class="button-container">
                <button class="js-cd-add-to-cart" 
                        data-price="' .
        $productPrice .
        '" 
                        data-product-id="1" 
                        data-product-name="' .
        $productName .
        '" 
                        data-product-price="' .
        $productPrice .
        '" 
                        data-product-image="' .
        $productImage .
        '">
                    Add to cart
                </button>
            </div>
        </div>';
    }

    // Free the result set
    $result->free(); // Free result set
  } else {
    echo "Error executing the query: " . $conn->error; // Display MySQLi error message
  }
  ?>



  </div>
</section>

<section class="section4" id="TVs">
  <div class="title">
    <h1>Samsung TVs</h1>
  </div>

  <div class="all">

<?php
// Fetch TV products from the database
$query = "SELECT * FROM product WHERE producttype = 'TV'";
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
  // Loop through the TV products and display them
  while ($row = $result->fetch_assoc()) {
    $productName = $row["productname"];
    $productPrice = $row["productprice"];
    $productImage = $row["productimage"];

    echo '
        <div class="phone wrap">
            <img src="' .
      $productImage .
      '" alt="' .
      $productName .
      '">
            <h2 class="name">' .
      $productName .
      '</h2>
            <span class="price">' .
      $productPrice .
      '$</span>
            <div class="button-container">
                <button class="js-cd-add-to-cart" 
                        data-price="' .
      $productPrice .
      '" 
                        data-product-id="1" 
                        data-product-name="' .
      $productName .
      '" 
                        data-product-price="' .
      $productPrice .
      '" 
                        data-product-image="' .
      $productImage .
      '">
                    Add to cart
                </button>
            </div>
        </div>';
  }

  // Free the result set
  $result->free(); // Free result set
} else {
  echo "Error executing the query: " . $conn->error; // Display MySQLi error message
}
?>


  
  </div>
</section>

<section class="section5" id="buds">
  <div class="title">
    <h1>Samsung Buds</h1>
  </div>

  <div class="all">
  <?php
  // Fetch TV products from the database
  $query = "SELECT * FROM product WHERE producttype = 'buds'";
  $result = $conn->query($query);

  // Check if the query was successful
  if ($result) {
    // Loop through the TV products and display them
    while ($row = $result->fetch_assoc()) {
      $productName = $row["productname"];
      $productPrice = $row["productprice"];
      $productImage = $row["productimage"];

      echo '
        <div class="phone wrap">
            <img src="' .
        $productImage .
        '" alt="' .
        $productName .
        '">
            <h2 class="name">' .
        $productName .
        '</h2>
            <span class="price">' .
        $productPrice .
        '$</span>
            <div class="button-container">
                <button class="js-cd-add-to-cart" 
                        data-price="' .
        $productPrice .
        '" 
                        data-product-id="1" 
                        data-product-name="' .
        $productName .
        '" 
                        data-product-price="' .
        $productPrice .
        '" 
                        data-product-image="' .
        $productImage .
        '">
                    Add to cart
                </button>
            </div>
        </div>';
    }

    // Free the result set
    $result->free(); // Free result set
  } else {
    echo "Error executing the query: " . $conn->error; // Display MySQLi error message
  }
  ?>

 
  </div>
</section>

<?php include "html/footer.html"; ?>
   <!--···················································-->

<script src="cart/js/util.js"></script> 
<script src="cart/js/cart.js"></script>
<script src="js/slide.js"></script>
    <script src="js/menu.js"></script>
  
</body>    
</html>

<?php // Close connection

$conn->close();
?>

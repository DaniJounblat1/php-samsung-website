<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['currentUser'])) {
    if (isset($_GET['method']) && $_GET['method'] === 'sign') {
        // Redirect to the transaction ID page
        header("Location:../html/welcom.php");
    } else {
        // Redirect to the index page
        header("Location: ../html/welcom.php");
    }
    exit();
}

$alertMessage = ""; // Variable to store the alert message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $cardNumber = $_POST['cardNumber'];
    $cardName = $_POST['cardName'];
    $cardMonth = $_POST['cardMonth'];
    $cardYear = $_POST['cardYear'];
    $cardCvv = $_POST['cardCvv'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipCode = $_POST['zipCode'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
        $alertMessage = '<span style="color: red;">Invalid email format. Please enter a valid Gmail address.</span>';
    } else {
        // Email format is valid, proceed with other checks and database operations
        
        // Database connection
        require 'connection.php';

        // Check if the connection is successful
        if ($conn) {
            // Check if email or card number already exist
            $checkQuery = "SELECT * FROM payment WHERE email = '$email' OR cardnumber = '$cardNumber'";
            $checkResult = $conn->query($checkQuery);

            if ($checkResult && $checkResult->num_rows > 0) {
                // Email or card number already exists
                $alertMessage = "Email or card number already exists. Please try again with different credentials.";
            } else {
                // Insert data into payment table
                $paymentSql = "INSERT INTO payment (cardnumber, cardname, cvv, email, password, year, month) 
                            VALUES ('$cardNumber', '$cardName', '$cardCvv', '$email', '$password', '$cardYear', '$cardMonth')";

                if ($conn->query($paymentSql) === TRUE) {
                    // Get the inserted payment ID
                    $paymentId = $conn->insert_id;

                    // Insert data into address table
                    $addressSql = "INSERT INTO address (address, state, city, zipcode) 
                                VALUES ('$address', '$state', '$city', '$zipCode')";

                    if ($conn->query($addressSql) === TRUE) {
                        // Get the inserted address ID
                        $addressId = $conn->insert_id;

                        // Insert data into user table
                        $userSql = "INSERT INTO user (username, useremail, password, address_idaddress, payment_idpayment, userType) 
                                    VALUES ('$cardName', '$email', '$password', '$addressId', '$paymentId', 'customer')";

                        if ($conn->query($userSql) === TRUE) {
                            // Data inserted successfully
                            $alertMessage = "Registration successful.";
                            // Redirect the user to login.php
                            header("Location: ../html/login.php");
                            exit();
                        } else {
                            // Error inserting data into user table
                            $alertMessage = "Error inserting data into user table: " . $conn->error;
                        }
                    } else {
                        // Error inserting data into address table
                        $alertMessage = "Error inserting data into address table: " . $conn->error;
                    }
                } else {
                    // Error inserting data into payment table
                    $alertMessage = "Error inserting data into payment table: " . $conn->error;
                }
            }

            $conn->close(); // Close the database connection
        } else {
            $alertMessage = "Database connection failed.";
        }
    }
}
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Samsung Sign Up / Sign In</title>

  <link rel="stylesheet" href="../css/signup.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel="icon" href="../img/logo.avif" type="image/x-icon">
    <link rel="shortcut icon" href="../img/logo.avif" type="image/x-icon">


</head>
<body>

  <br>
     <div class="container">
      <form  id = "myForm"  action ="" method="POST">
        
<!-- partial:index.partial.html -->
<div class="wrapper" id="app">
  <div class="card-form">
    <div class="card-list">
      <div class="card-item" v-bind:class="{ '-active' : isCardFlipped }">
        <div class="card-item__side -front">
          <div class="card-item__focus" v-bind:class="{'-active' : focusElementStyle }" v-bind:style="focusElementStyle" ref="focusElement"></div>
          <div class="card-item__cover">
            <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg">
          </div>
          
          <div class="card-item__wrapper">
            <div class="card-item__top">
              <img src="https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/chip.png" class="card-item__chip">
              <div class="card-item__type">
                <transition name="slide-fade-up">
                  <img v-bind:src="'../card_img.png'" v-if="getCardType" v-bind:key="getCardType" alt="" class="card-item__typeImg">
                </transition>
              </div>
            </div>
            <label for="cardNumber" class="card-item__number" ref="cardNumber">
              <template v-if="getCardType === 'amex'">
                <span v-for="(n, $index) in amexCardMask" :key="$index">
                  <transition name="slide-fade-up">
                    <div
                      class="card-item__numberItem"
                      v-if="$index > 4 && $index < 14 && cardNumber.length > $index && n.trim() !== ''"
                    >* </div>
                    <div class="card-item__numberItem"
                      :class="{ '-active' : n.trim() === '' }"
                      :key="$index" v-else-if="cardNumber.length > $index">
                      {{cardNumber[$index]}}
                    </div>
                    <div
                      class="card-item__numberItem"
                      :class="{ '-active' : n.trim() === '' }"
                      v-else
                      :key="$index + 1"
                    >{{n}}</div>
                  </transition>
                </span>
              </template>
              <template v-else>
                <span v-for="(n, $index) in otherCardMask" :key="$index">
                  <transition name="slide-fade-up">
                    <div
                      class="card-item__numberItem"
                      v-if="$index > 4 && $index < 15 && cardNumber.length > $index && n.trim() !== ''"
                    >*</div>
                    <div class="card-item__numberItem"
                      :class="{ '-active' : n.trim() === '' }"
                      :key="$index" v-else-if="cardNumber.length > $index">
                      {{cardNumber[$index]}}
                    </div>
                    <div
                      class="card-item__numberItem"
                      :class="{ '-active' : n.trim() === '' }"
                      v-else
                      :key="$index + 1"
                    >{{n}}</div>
                  </transition>
                </span>
              </template>
            </label>
            <div class="card-item__content">
              <label for="cardName" class="card-item__info" ref="cardName">
                <div class="card-item__holder">Card Holder</div>
                <transition name="slide-fade-up">
                  <div class="card-item__name" v-if="cardName.length" key="1">
                    <transition-group name="slide-fade-right">
                      <span class="card-item__nameItem" v-for="(n, $index) in cardName.replace(/\s\s+/g, ' ')" v-if="$index === $index" v-bind:key="$index + 1">{{n}}</span>
                    </transition-group>
                  </div>
                  <div class="card-item__name" v-else key="2">Full Name</div>
                </transition>
              </label>
              <div class="card-item__date" ref="cardDate">
                <label for="cardMonth" class="card-item__dateTitle">Expires</label>
                <label for="cardMonth" class="card-item__dateItem">
                  <transition name="slide-fade-up">
                    <span v-if="cardMonth" v-bind:key="cardMonth">{{cardMonth}}</span>
                    <span v-else key="2">MM</span>
                  </transition>
                </label>
                /
                <label for="cardYear" class="card-item__dateItem">
                  <transition name="slide-fade-up">
                    <span v-if="cardYear" v-bind:key="cardYear">{{String(cardYear).slice(2,4)}}</span>
                    <span v-else key="2">YY</span>
                  </transition>
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="card-item__side -back">
          <div class="card-item__cover">
            <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + currentCardBackground + '.jpeg'" class="card-item__bg">
          </div>
          <div class="card-item__band"></div>
          <div class="card-item__cvv">
            <div class="card-item__cvvTitle">CVV</div>
            <div class="card-item__cvvBand">
              <span v-for="(n, $index) in cardCvv" :key="$index">
                *
              </span>
            </div>
            <div class="card-item__type">
              <img v-bind:src="'https://raw.githubusercontent.com/muhammederdem/credit-card-form/master/src/assets/images/' + getCardType + '.png'" v-if="getCardType" class="card-item__typeImg">
            </div>
          </div>
        </div>
      </div>
    </div>

 

    <div class="card-form__inner">
      <div class="card-input">
        <label for="cardNumber" class="card-input__label">Card Number</label>
       <input type="text" id="cardNumber" name="cardNumber" class="card-input__input" v-mask="generateCardNumberMask" v-model="cardNumber" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardNumber" autocomplete="off" pattern="^(\d{4}\s?){4}$" required placeholder="Card Number" value="<?php echo isset($cardNumber) ? $cardNumber : ''; ?>">


    
 

      </div>
      <div class="card-input">
        <label for="cardName" class="card-input__label">Card Holders</label>
        <input type="text" id="cardName"  name="cardName" class="card-input__input" v-model="cardName" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardName" autocomplete="off" pattern="^[A-Za-z]+(\s[A-Za-z]+){2}$" required
        placeholder="Full Name"
        value="<?php echo isset($_POST['cardName']) ? $_POST['cardName'] : ''; ?>">
    
        

      </div>
      <div class="card-form__row">
        <div class="card-form__col">
          <div class="card-form__group">
            <label for="cardMonth" class="card-input__label">Expiration Date</label>
            <select class="card-input__input -select"  name="cardMonth"  id="cardMonth" v-model="cardMonth" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate"
            required >
              <option value="" disabled selected>Month</option>
              <?php
              for ($i = 1; $i <= 12; $i++) {
                echo '<option value="' . ($i < 10 ? '0' . $i : $i) . '"';
                if (isset($_POST['cardMonth']) && $_POST['cardMonth'] == ($i < 10 ? '0' . $i : $i)) {
                  echo ' selected';
                }
                echo '>' . ($i < 10 ? '0' . $i : $i) . '</option>';
              }
            ?>
            </select>
            <select class="card-input__input -select"  name="cardYear" id="cardYear" v-model="cardYear" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="cardDate"
            required>
              <option value="" disabled selected>Year</option>
           <?php
              $currentYear = date('Y');
              for ($i = $currentYear; $i <= $currentYear + 12; $i++) {
                echo '<option value="' . ($i % 100) . '"';
                if (isset($_POST['cardYear']) && $_POST['cardYear'] == ($i % 100)) {
                  echo ' selected';
                }
                echo '>' . ($i % 100) . '</option>';
              }
            ?>
            </select>
          </div>
        </div>
        <div class="card-form__col -cvv">
          <div class="card-input">
            <label for="cardCvv" class="card-input__label">CVV</label>
            <input type="text" name="cardCvv"  class="card-input__input" id="cardCvv" v-mask="'####'" maxlength="4" v-model="cardCvv" v-on:focus="flipCard(true)" v-on:blur="flipCard(false)" autocomplete="off"  pattern="[0-9]{3}" required 
            placeholder="123" title="Please enter three numbers"
            value="<?php echo isset($_POST['cardCvv']) ? $_POST['cardCvv'] : ''; ?>">
      
 
          </div>
        </div>
      </div>
      
      <div class="card-input">
    <label for="email" class="card-input__label">Email</label>
    <input type="email" id="email" name="email" class="card-input__input" placeholder="Enter your email"  v-on:focus="focusInput" v-on:blur="blurInput" autocomplete="off" required pattern="[a-zA-Z0-9._%+-]+@gmail\.com$" 
    value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
 
</div>
  <!-- Password -->
     
  <div class="card-input">
    <label for="password" class="card-input__label">Password</label>
    <input type="password" name="password" id="password" class="card-input__input" placeholder="Enter your password"  v-on:focus="focusInput" v-on:blur="blurInput" autocomplete="off" 
    pattern = "^.{8,20}$" title="Please enter a password with 8-20 characters, including letters and numbers" required
    value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
  
  </div>
 
      <div class="card-form__row">
        <div class="card-input">
  <label for="address" class="card-input__label">Address</label>
  <input type="text" id="address" name="address" class="card-input__input"  v-on:focus="focusInput" v-on:blur="blurInput" data-ref="address" autocomplete="off" pattern="^(?:[A-Za-z0-9]+(?:\s|$)){3,40}$" required
  placeholder="Room - Street - Locality"
  value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>">
 
</div>

        
        <div class="card-input">
  <label for="city" class="card-input__label">City</label>
  <input type="text" id="city" name="city"  class="card-input__input"  v-on:focus="focusInput" v-on:blur="blurInput" data-ref="city" autocomplete="off" pattern="^[A-Za-z]{3,32}$" required placeholder="Baalbak"
  value="<?php echo isset($_POST['city']) ? $_POST['city'] : ''; ?>">
 
  
</div>


      </div>
      <div class="card-form__row">
        <div class="card-input">
  <label for="State" class="card-input__label">State</label>
  <input type="text" id="state" name="state" class="card-input__input" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="state" autocomplete="off" pattern="^[A-Za-z]{3,32}$" required placeholder="Bikaa"
  value="<?php echo isset($_POST['state']) ? $_POST['state'] : ''; ?>">
 
  
</div>

        <div class="card-input">
  <label for="zipCode" class="card-input__label">ZIP Code</label>
  <input type="number" id="mobile" name="zipCode" class="card-input__input" v-on:focus="focusInput" v-on:blur="blurInput" data-ref="zipCode" autocomplete="off" required placeholder="123456"
  value="<?php echo isset($_POST['zipCode']) ? $_POST['zipCode'] : ''; ?>">
  
</div>

      </div>
      <?php echo $alertMessage; ?>

      <div class="inputBox">
        <input value="Send" id="signup" type="submit"   class="card-form__button">
        
          
<button type="button" class="cancelbtn" onclick="window.location.href='../index.php'">Cancel</button>

    </div>
   <div class="login-link"> <p>Already have an account? <a href="../html/login.php"> Sign In</a> </p>
   </div>
  </div>
</div>
</div>
      </form>
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js'></script>
<script src='https://unpkg.com/vue-the-mask@0.11.1/dist/vue-the-mask.js'></script>
<script src="../js/script.js"></script>
<script>
 document.getElementById('myForm').addEventListener('submit', function(event) {
  // Prevent the default form submission
  event.preventDefault();

  // Perform any necessary client-side validation here
  
  // Submit the form
  this.submit();
});

</script>
</body>
</html>

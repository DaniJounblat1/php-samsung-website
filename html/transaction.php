<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transaction ID</title>
<link rel="stylesheet" href="../css/services.css">
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/translate.css">
<link rel="icon" href="../img/logo.avif" type="image/x-icon">
<link rel="shortcut icon" href="../img/logo.avif" type="image/x-icon">
</head>
<body>
<header class="header">
    <a href="../index.php" class="logo">Home</a>
</header>
<section class="transaction">
    <div class="transaction-id">
        <h2>
            <p>Your purchase is complete, and we appreciate your trust in our products. Your transaction ID is your key to any future repair or return requests.</p><br>
            Transaction ID</h2>
        <p id="transaction-id">
        <?php
        // Establish a database connection (replace with your own database credentials)
        require 'connection.php';

        // Function to generate the transaction ID
        function generateTransactionID()
        {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $length = 10;
            $transactionID = '';

            for ($i = 0; $i < $length; $i++) {
                $index = rand(0, strlen($characters) - 1);
                $transactionID .= $characters[$index];
            }

            return $transactionID;
        }

        // Generate the transaction ID
        $transactionID = generateTransactionID();

        // Prepare the SQL statement to insert the transaction ID into the 'order' table
        $orderSql = "INSERT INTO `order` (`transaction`) VALUES ('$transactionID')";

        if ($conn->query($orderSql) === TRUE) {
            echo "<p>Your purchase is complete, and we appreciate your trust in our products.</p>";
            echo "<p>Your transaction ID is: $transactionID</p>";

            // Retrieve the inserted order ID
            $orderId = $conn->insert_id;

            // Prepare the SQL statement to insert the order ID and shipping date into the 'shipping' table
            $shippingDate = date("Y-m-d"); // Get the current date
            $shippingSql = "INSERT INTO `shipping` (`shippingdate`, `order_id`) VALUES ('$shippingDate', '$orderId')";

            if ($conn->query($shippingSql) === TRUE) {
                echo "<p>Shipping information has been recorded.</p>";
            } else {
                echo "Error: " . $shippingSql . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $orderSql . "<br>" . $conn->error;
        }

        $conn->close();
        ?>
        </p>
    </div>
</section>
<br><br><br><br><br><br><br><br>
<?php include '../html/footer.html'; ?>
<script>
window.onload = function() {
    clearCart();
};

function clearCart() {
    localStorage.clear();
}
</script>
</body>
</html>

<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveToHome - Place Your Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        select, input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #ff9900;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #ffbf00;
        }
        .message {
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Details</h1>
        <form method="post">
            <?php include('errors.php'); ?>
            
            <?php
            $host = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbName = "hivetohome"; 

            $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

            if ($conn->connect_error) {
                die('Could not connect to the database.');
            }

            $booking_id = $_SESSION['booking_id'];
            echo $booking_id;

            if (!isset($booking_id)) {
                echo $booking_id;
                echo "Invalid booking_id. Please go back and place an order.";
                exit(); 
            }

            $priceQuery = "SELECT h.price FROM honey_types h
                           JOIN bookings b ON h.type_id = b.type_id
                           WHERE b.booking_id = ?";
            $stmt = $conn->prepare($priceQuery);
            $stmt->bind_param("i", $booking_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $price = $row['price'];
                echo "<label>Payment Amount:</label>";
                echo "<p>$price</p>";
            } else {
                echo "Error fetching payment details.";
                exit();
            }
            $stmt->close();
            ?>
            
            <label for="country">Country:</label>
            <input type="text" id="country" name="country" required>
            
            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required></textarea>
            
            <label for="pincode">Pincode:</label>
            <input type="text" id="pincode" name="pincode" required>
            
            <input type="submit" name="submit_payment" value="Complete Payment">
        </form>
        <div class="message">
        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit_payment'])) {
    $country = $_POST['country'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];

    $payment_id = $pincode . "_" . $booking_id;

    $paymentInsertQuery = "INSERT INTO payment (payment_id, booking_id, price, country, address, pincode, payment_date) 
                           VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($paymentInsertQuery);
    $stmt->bind_param("siisss", $payment_id, $booking_id, $price, $country, $address, $pincode);
    
    if ($stmt->execute()) {
        echo "<div class='message'>Payment successful. Your payment ID: $payment_id</div>";
    } else {
        echo "<div class='message'>Payment failed. Please try again later.</div>";
    }

    $stmt->close();
}
?>


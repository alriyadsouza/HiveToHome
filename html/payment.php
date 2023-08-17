<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HiveToHome - Complete Payment</title>
    <style>
        /* ... (your existing CSS styles) ... */
    </style>
</head>
<body>
    <div class="container">
        <h1>Complete Payment</h1>
        <form method="post">
            <label for="bookingId">Booking ID:</label>
            <input type="number" id="bookingId" name="bookingId" min="1">
            <label for="amount">Amount ($):</label>
            <input type="number" id="amount" name="amount" min="0.01" step="0.01">
            <input type="submit" name="submit" value="Complete Payment">
        </form>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hivetohome"; // Replace with your actual database name
        
        if(isset($_POST['submit'])) {
            $bookingId = $_POST['bookingId'];
            $amount = $_POST['amount'];
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Insert payment data into the "payments" table
            $sql = "INSERT INTO payments (booking_id, amount, payment_date)
                    VALUES ($bookingId, $amount, NOW())";
            
            if ($conn->query($sql) === TRUE) {
                echo "<p>Payment successful. Thank you for your purchase!</p>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
        }
        ?>
    </div>
</body>
</html>

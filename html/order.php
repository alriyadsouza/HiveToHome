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
        <h1>Place Your Order</h1>
        <form method="post">
            <label for="honeyType">Select Honey Type:</label>
            <select id="honeyType" name="honeyType">
                <option value="Clover Honey">Clover Honey</option>
                <option value="Orange Blossom Hone">Orange Blossom Honey</option>
                <option value="Acacia Honey">Acacia Honey</option>
                <option value="Linden Honey">Linden Honey</option>
                <option value="Dandelion Honey">Dandelion Honey</option>
                <option value="Wildflower Honey">Wildflower Honey</option>
                <option value="Buckwheat Honey">Buckwheat Honey</option>
                <option value="Sage Honey">Sage Honey</option>
            </select>
            <label for="quantity">Quantity (kg):</label>
            <input type="number" id="quantity" name="quantity" min="1" max="100">
            <input type="submit" name="submit" value="Complete Order">
        </form>
        <div class="message">
            <?php
            $host = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbName = "hivetohome"; // Update with your database name

            $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

            if ($conn->connect_error) {
                die('Could not connect to the database.');
            }

            session_start();

            if (isset($_POST['submit'])) {
                $honeyType =($_POST['honeyType']);
                $quantity = $_POST['quantity'];
    
                // Get honey type details from the database
                $query = "SELECT ht.type_id, ht.name, ht.price, ht.description, iv.quantity FROM honey_types ht
                        JOIN inventory iv ON ht.type_id = iv.type_id
                        WHERE LOWER(ht.name) = LOWER(?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $honeyType);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $type_id = $row['type_id'];
                        $name = $row['name'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $availableQuantity = $row['quantity'];

                        if ($quantity <= $availableQuantity) {
                            $user_id = $_SESSION['user_id'];
                
                            // Insert booking into the database
                            $insertQuery = "INSERT INTO bookings (user_id, type_id, quantity, booking_date) VALUES (?, ?, ?, NOW())";
                            $stmt = $conn->prepare($insertQuery);
                            $stmt->bind_param("iii", $user_id, $type_id, $quantity);
                
                            if ($stmt->execute()) {
                                // Update inventory quantity
                                $updateInventoryQuery = "UPDATE inventory SET quantity = quantity - ? WHERE type_id = ?";
                                $stmt = $conn->prepare($updateInventoryQuery);
                                $stmt->bind_param("ii", $quantity, $type_id);
                                if ($stmt->execute()) {
                                    echo "Your order for $quantity bottle of $name has been placed successfully.";
                                } else {
                                    echo "Error updating inventory: " . $stmt->error;
                                }
                            } else {
                                echo "Error placing order: " . $stmt->error;
                            }
                        } else {
                            echo "Out of stock. Available quantity for $name: $availableQuantity bottles.";
                        }
                    }
                } else {
                    echo "Invalid honey type selected.";
                }

                $stmt->close();

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
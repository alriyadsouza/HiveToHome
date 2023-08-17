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
    </style>
</head>
<body>
    <div class="container">
        <h1>Place Your Order</h1>
        <form method="post">
            <label for="honeyType">Select Honey Type:</label>
            <select id="honeyType" name="honeyType">
                <option value="clover">Clover Honey</option>
                <option value="orange">Orange Blossom Honey</option>
                <option value="acacia">Acacia Honey</option>
                <option value="linden">Linden Honey</option>
                <option value="dandelion">Dandelion Honey</option>
                <option value="wildflower">Wildflower Honey</option>
                <option value="buckwheat">Buckwheat honey</option>
                <option value="sage">Sage honey</option>
            </select>
            <label for="quantity">Quantity (kg):</label>
            <input type="number" id="quantity" name="quantity" min="1" max="100">
            <input type="submit" name="submit" value="Complete Order">
        </form>
        <?php
        if(isset($_POST['submit'])) {
            $honeyType = $_POST['honeyType'];
            $quantity = $_POST['quantity'];
            
            // Process the order and store the data in the database
            // Replace this with your actual database handling code
            echo "<p>Delight in success as your order for $quantity bottles of $honeyType graces our hive with sweet anticipation.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "acmegrade";

    $conn = new mysqli($host, $user, $pass, $db);
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit;
    }
    
    $sql = "SELECT productId, name FROM products WHERE productId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_POST['productId']);
    $stmt->execute();
    $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Form</title>
    <style>
        body {
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Checkout Time: Your Treasure Awaits!</h2>
        <form id="checkoutForm" action="" method="POST">
            <label for="name">Full Name:</label>
            <input type="text" id="customerName" name="customerName" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="mobile">Mobile Number:</label>
            <input type="text" id="mobile" name="mobile" maxlength="10" required>

            <label for="address">Shipping Address:</label>
            <input type="text" id="address" name="address" required>

            <label for="street">Street:</label>
            <input type="text" id="street" name="street" required>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required>

            <label for="state">State:</label>
            <input type="text" id="state" name="state" required>

            <label for="zip">Pincode:</label>
            <input type="text" id="zip" name="zip" maxlength="6" required>
            
            <?php
            
                while ($dbrow = mysqli_fetch_assoc($result)) {
                    echo "<input type='hidden' name='productId' value='$dbrow[productId]'>";
                    echo "<input type='hidden' name='name' value='$dbrow[name]'>";
                }

                if (isset($_POST['productId'], $_POST['customerName'], $_POST['email'], $_POST['mobile'], $_POST['address'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['zip'])) {
            
                    if ($result->num_rows > 0) {
                    
                        $productName = $_POST['name'];
            
                        $name = htmlspecialchars($_POST['customerName']);
                        $email = htmlspecialchars($_POST['email']);
                        $mobile = htmlspecialchars($_POST['mobile']);
                        $address = htmlspecialchars($_POST['address']);
                        $street = htmlspecialchars($_POST['street']);
                        $city = htmlspecialchars($_POST['city']);
                        $state = htmlspecialchars($_POST['state']);
                        $zip = htmlspecialchars($_POST['zip']);
            
                        $insertSql = "INSERT INTO orders (productId, productName, customerName, email, mobile, address, street, city, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $insertStmt = $conn->prepare($insertSql);
                        $insertStmt->bind_param("isssssssss", $_POST['productId'], $productName, $name, $email, $mobile, $address, $street, $city, $state, $zip); // 'i' for integer, 's' for string
            
                        if ($insertStmt->execute()) {
                            header('Location: orderPlaced.php');
                        } 
                        
                        else {
                            echo "Error: " . $insertStmt->error;
                        }
            
                        $insertStmt->close();
                    } 
                    
                    else{
                        echo "Product not found.";
                    }
            
                    $stmt->close();
                    $conn->close();
                }

            ?>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
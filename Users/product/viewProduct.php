<html>
<head>
    <style>
        .container {
            display: flex;
        }

        .card {
            position: relative;
            background-color: #444;
            border: 3px solid black;
            padding: 10px;
            margin-right: 10px;
            height: fit-content;
        }

        .name {
            font-size: 25px;
            color: #fff;
            font-weight: bold;
            width: 170px;
            word-wrap: break-word;
        }
        
        .price {
            font-weight: 20px;
            color: gold;
            font-size: 20px;
            margin-top: 10px;
            border: 2px dashed gold;
            width: fit-content;
            padding-right: 10px;
            padding-left: 10px;
        }

        .detail {
            background-color: #333;
            color: #fff;
            padding: 10px 0 10px 10px;
            margin-top: 10px;
            width: 170px;
            border-radius: 10px;
        }

        .action {
            display: flex;
            margin-top: 10px;
            justify-content: space-around;
        }

        .img-container {
            width: 180px;
            height: 200px;
            margin-top: 10px;
        }

        img {
            width: 100%;
            height: 100%;
            border-radius: 20px;
        }

        button{
            position: relative;
            top: 10px;
            background-color: #fff;
            color: black;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background-color: #333;
            color: #fff;
        }

        #del {
            height: 28px;
        }

        #del:hover {
            background-color: red;
            color: #fff;
        }
    </style>
</head>
</html>

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

    function getProducts(){
        global $pdo;
        $sql_result = $pdo->query("SELECT * FROM products");
        return $sql_result->fetchAll(PDO::FETCH_ASSOC);
    }
    $products = getProducts();

    $sql_result = mysqli_query($conn, "SELECT * FROM products");

    if(!isset($_SESSION['userId'])){

        echo '<h1 style="color: #fff; background-color: #333; position: relative; left: 400px; top: 200px; width: fit-content; padding: 40px; font-size: 40px; border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0, 0, 0, 1);">You need to Login first</h1>';
        exit;

    }

    if(empty($products)){

        echo '<h1 style="color: #fff; background-color: #333; position: relative; left: 25%; top: 200px; width: fit-content; padding: 40px; font-size: 40px; border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0, 0, 0, 1);">The Products are not available</h1>';
        exit;

    }
    
    echo "<div class='container'>";
    while($dbrow = mysqli_fetch_assoc($sql_result)){
        echo "<div class='card'>
                <div class='name'>$dbrow[name]</div>
                <div class='price'>₹$dbrow[price]</div>
                <div class='img-container'>
                <img src='../../Admin/product/$dbrow[imgpath]' alt='image'>
            </div>
        
            <div class='detail'>$dbrow[detail]</div>
        
            <div class='action'>
        
                <form action='addCart.php' method='post'>
                    <input type='hidden' name='productId' value=$dbrow[productId]>
                    <button type='submit' onclick='solved()'>Add to cart</button>
                </form>

            </div>
        </div>";
    }
    echo "</div>";
?>
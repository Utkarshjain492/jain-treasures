<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section class="msg">
            <div class="container">
                <h1>Welcome Fire Geek! 🔥</h1>
                <p>A bug is not a mistake; it's an opportunity to learn.</p>
                <p>Programming isn't about what you know; it's about what you can figure out.</p>
                <button class="shopNow" onclick="openProduct()">Add Product</button>
            </div>
        </section>
    </main>

    <script>

        const filePath = '../product/product.html';
        function openProduct(){
            window.location.href = filePath;
        }

    </script>

</body>
</html>

<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "acmegrade";

    $conn = new mysqli($host, $user, $pass, $db);

    if(!isset($_SESSION['userId'])){
        echo "<h2 class='loginMsg'>Welcome User! You need to Login first.</h2>";
        exit;
    }

?>
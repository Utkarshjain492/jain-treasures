<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "acmegrade";

    $conn = new mysqli($host, $user, $pass, $db);

    if(!isset($_SESSION['userId'])){

?>
        
    <h1 style="color: #fff; background-color: #333; position: relative; left: 400px; top: 200px; width: fit-content; padding: 40px; font-size: 40px; border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0, 0, 0, 1);"><?php echo "You need to Login first"; ?></h1>
        
<?php
        
    exit();
    }
?>

<?php
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if(isset($_POST['productId'])){
        $query = "INSERT INTO cart (userId, productId) VALUES ($_SESSION[userId], $_POST[productId])";
        mysqli_query($conn, $query);
    }
    
    mysqli_close($conn);
    
    header('location: viewCart.php');

?>
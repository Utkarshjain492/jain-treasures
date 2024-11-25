<?php

    session_start();

    $source = $_FILES['productImg']['tmp_name'];
    $target = "productImg" . $_FILES['productImg']['name'];
    
    move_uploaded_file($source, $target);
    
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
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $detail = mysqli_real_escape_string($conn, $_POST['detail']);
    $owner = mysqli_real_escape_string($conn, $_SESSION['userId']);

    $stmt = $conn->prepare("INSERT INTO products (name, price, imgpath, detail, owner) VALUES (?,?,?,?,?)");

    $stmt->bind_param("sissi", $name, $price, $target, $detail, $owner);
    $stmt->execute();

    if($stmt->affected_rows > 0){

?>
    <h1 style="color: #fff; background-color: #333;position: relative; left: 350px; top: 200px; width: fit-content; padding: 40px; font-size: 40px; border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0, 0, 0, 1);"><?php echo "Product Uploaded Successfully"; ?></h1>
    
<?php

    }
    else{
        
?>
    <h1 style="color: #fff; background-color: #333;position: relative; left: 400px; top: 200px; width: fit-content; padding: 40px; font-size: 40px; border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0, 0, 0, 1);"><?php echo "ERROR" . mysqli_error($conn); ?></h1>

<?php

    }
    $stmt->close();
    $conn->close();

?>
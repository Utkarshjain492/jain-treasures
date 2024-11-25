<?php

    session_start();

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "acmegrade";

    $conn = new mysqli($host, $user, $pass, $db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = mysqli_real_escape_string($conn, "DELETE FROM cart WHERE productId=$_POST[productId];");

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    }
    else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();

    header('location: viewCart.php');

?>
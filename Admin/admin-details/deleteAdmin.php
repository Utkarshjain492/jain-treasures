<?php

session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "acmegrade";

$conn = new mysqli($host, $user, $pass, $db);

if(!$conn){

  die("Connection failed: ". mysqli_connect_error());

}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['id'])){
        $id = intval($_POST['id']);

        $stmt = $pdo->prepare("DELETE FROM admin WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if($stmt->execute()){
            echo "Admin with ID $id deleted successfully.";
        } 
        
        else{
            echo "Error deleting Admin.";
        }
    } 
    
    else{
        echo "No ID provided.";
    }
} 

catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

$pdo = null;

header("Location: adminDetails.php");
exit();
?>
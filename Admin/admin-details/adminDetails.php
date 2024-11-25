
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

try{
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM admin");
    $admin = $stmt->fetchAll(PDO::FETCH_ASSOC);
} 

catch(PDOException $e){
    echo "Error: " . $e->getMessage();
}

if(!isset($_SESSION['userId'])){

    echo '<h1 style="color: #fff; background-color: #333; position: relative; left: 400px; top: 200px; width: fit-content; padding: 40px; font-size: 40px; border: 1px solid #ddd; box-shadow: 0 0 10px rgba(0, 0, 0, 1);">You need to Login first</h1>';
    exit;

}
 

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="img/logo/attnlg.png" rel="icon">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" rel="stylesheet">
  <title>Dashboard</title>
  <link rel="stylesheet" href="../css/style.css">
  
</head>
<body>
    <section class="main">
    <div class="main--content">
        <div class="overview">
                <div class="title">
                    <h2 class="section--title">Overview</h2>
                </div>
                <div class="cards">
                    <div class="card card-1">
                        <?php 
                        $query1=mysqli_query($conn,"SELECT * from admin");                       
                        $admins = mysqli_num_rows($query1);
                        ?>
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">Total Admins</h5>
                                <h1><?php echo $admins;?></h1>
                            </div>
                            <i class="ri-user-2-line card--icon--lg"></i>
                        </div>
                       
                    </div>
                    <div class="card card-1">
                        <?php 
                        $query1=mysqli_query($conn,"SELECT * from users");                       
                        $users = mysqli_num_rows($query1);
                        ?>
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">Total Registered Users</h5>
                                <h1><?php echo $users;?></h1>
                            </div>
                            <i class="ri-user-line card--icon--lg"></i>
                        </div>
                        
                    </div>
                    
                    <div class="card card-1">
                        <?php 
                        $query1=mysqli_query($conn,"SELECT * from products");                       
                        $totalProducts = mysqli_num_rows($query1);
                        ?>
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">Total Products</h5>
                                <h1><?php echo $totalProducts;?></h1>
                            </div>
                            <i class="ri-file-text-line card--icon--lg"></i>
                        </div>
                       
                    </div>

                    <div class="card card-1">
                        <?php 
                        $query1=mysqli_query($conn,"SELECT * from orders");                       
                        $totalOrders = mysqli_num_rows($query1);
                        ?>
                        <div class="card--data">
                            <div class="card--content">
                                <h5 class="card--title">Total Orders</h5>
                                <h1><?php echo $totalOrders;?></h1>
                            </div>
                            <i class="ri-file-text-line card--icon--lg"></i>
                        </div>
                       
                    </div>
                </div>
            </div>
           
            <div class="table-container">
            <a href="createAdmin.php" style="text-decoration:none;"> <div class="title">
                    <h2 class="section--title">Admins</h2>
                    <button class="add"><i class="ri-add-line"></i>Add Admin</button>
                </div>
            </a>
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>Admin ID</th>
                                <th>Full Name</th>
                                <th>UserName</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                        <?php

                            $sql = "SELECT * from admin";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['fullName']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    echo '<form action="deleteAdmin.php" method="POST" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete this Admin?\');">';
                                    echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '">';
                                    echo '<td><button type="submit" style="border:none; background:none; padding:0;">';
                                    echo "<i class='ri-delete-bin-line delete' style='cursor: pointer;'></i></td>";
                                    echo '</button>';
                                    echo "</form>";
                                    echo "</tr>";
                                }
                            } 
                    
                            else {
                                echo "<tr><td colspan='6'>No records found</td></tr>";
                            }

                    ?>                     
                                
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
    <script src="../javascript/main.js"></script>
</body>
</html>
<?php
session_start();

if(!isset($_SESSION['username'])){
    $url = "../index.php";
    echo `<a href="' . $url . '" target="_parent"></a>`;
    exit;
}

$username = $_SESSION['username'];

$host = "localhost";
$user = "root";
$pass = "";
$db = "acmegrade";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

$admin_sql = "SELECT * FROM admin WHERE username='$username'";
$admin_result = $conn->query($admin_sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()) {
        $fullName = $row['fullName'];
        $email = $row['email'];
        $username = $row['username'];
    }
} 
elseif($admin_result->num_rows > 0){
    while($row = $admin_result->fetch_assoc()) {
        $fullName = $row['fullName'];
        $email = $row['email'];
        $username = $row['username'];
    }
} 
else{
    echo "Error: Unable to retrieve user information.";
}

$conn->close();

?>

<html>
<head>
    <title>Welcome <?php echo $username;?></title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background-image: url(/BG/inside_bg.png);
            background-position: center;
            background-size: cover;
            overflow-x: hidden;
        }
        .container{
            width: 80%;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header{
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .header h1{
            margin: 0;
        }
        .content{
            padding: 20px;
        }
        .content p{
            margin-bottom: 20px;
        }
        .logout{
            text-align: center;
            margin-top: 20px;
            display: inline;
            position: relative;
            left: 45%;
            top: 10px;
        }
        .logout a{
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .logout a:hover{
            background-color: #444;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Welcome <?php echo $fullName;?>!</h1>
        </div>
        <div class="content">
            <p>You are now logged in.</p>
            <p>Your User ID is: <?php echo $_SESSION['userId'];?></p>
            <p>Your Username is: <?php echo $username;?></p>
            <p>Your Email Address is: <?php echo $email;?></p>

            <div class="logout">
                <a href="logout.php" target="bottom">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
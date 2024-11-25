<html>
<head>
    <title>Jain-Treasures Hub</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background-image: url(/BG/index_bg.png);
            background-position: center;
            background-size: cover;
            overflow-x: hidden;
        }
        .webName{
          text-align: center;
          letter-spacing: 20px;
          margin-top: 30px;
          font-style: italic;
          text-decoration: underline;
          font-size: 50px;
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
        .logout, .home{
            text-align: center;
            margin-top: 20px;
            display: inline;
            position: relative;
            left: 400px;
            top: 10px;
        }
        .logout a, .home a{
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .logout a:hover, .home a:hover{
            background-color: #444;
        }
    </style>
</head>
<body>
    <h1 class="webName">Jain-Treasures Hub</h1>
</body>
</html>

<?php
session_start();

if(!isset($_SESSION['username'])){
    $url = "../index.php";
    echo `<a href="' . $url . '" target="_blank"></a>`;
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
        $email = $row['email'];
        $username = $row['username'];
    }
    echo "<div class='container'>
            <div class='header'>
                <h1>Welcome $username!</h1>
            </div>
            <div class='content'>
                <p>You are now logged in.</p>
                <p>Your email address is: $email</p>

                <div class='home'>
                    <a href='../Users/home-nav/home-nav.html'>Home</a>
                </div>

                <div class='logout'>
                    <a href='logout.php'>Logout</a>
                </div>
            </div>
        </div>";
} 
elseif($admin_result->num_rows > 0){
    while($row = $admin_result->fetch_assoc()) {
        $email = $row['email'];
        $username = $row['username'];
    }
    echo "<div class='container'>
            <div class='header'>
                <h1>Welcome $username!</h1>
            </div>
            <div class='content'>
                <p>You are now logged in.</p>
                <p>Your email address is: $email</p>

                <div class='home'>
                    <a href='../Admin/home-nav/home-nav.html'>Home</a>
                </div>

                <div class='logout'>
                    <a href='logout.php'>Logout</a>
                </div>
            </div>
        </div>";
}
else{
    echo "Error: Unable to retrieve user information.";
}

$conn->close();

?>
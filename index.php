<html>
<head>
    <title>Jain-Treasures Hub</title>
    <style>
        body {
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
        .container {
            width: 30%;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
        }
        .form {
            padding: 20px;
        }
        .form label {
            display: block;
            margin-bottom: 10px;
        }
        .form input[type="text"], .form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }
        .form input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form input[type="submit"]:hover {
            background-color: #444;
        }
        .error {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1 class="webName">Jain-Treasures Hub</h1>
    <div class="container">
        <div class="header">
            <h1>Login</h1>
        </div>
        <div class="form">
            <form action="index.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" autocomplete="off"><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" autocomplete="off"><br><br>
                <input type="submit" value="Login">
            </form>
            <!-- <a href="login/reset-password/smtp.php">Forgot Password?</a> -->
            <p>Don't have an account? <a href="login/register.php">Register</a></p>
        </div>
    </div>
</body>
</html>

<?php

  if(isset($_SESSION['error'])){

    echo '<p class="error">' . $_SESSION['error'] . '</p>';
    unset($_SESSION['error']);

  }
?>

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

if(isset($_POST['username']) && isset($_POST['password'])){
  
  $login = $_POST['username'];
  $password = $_POST['password'];
  
  $query = "SELECT * FROM users WHERE username = '$login' AND password = '$password'";
  $result = mysqli_query($conn, $query);

  $admin_query = "SELECT * FROM admin WHERE username = '$login' AND password = '$password'";
  $admin_result = mysqli_query($conn, $admin_query);
  
  if(mysqli_num_rows($result) > 0){
    
    $row = mysqli_fetch_assoc($result);
    $_SESSION['userId'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    header('Location: login/welcome.php');
    exit;
  
  }

  elseif(mysqli_num_rows($admin_result) > 0){
    
    $admin_row = mysqli_fetch_assoc($admin_result);
    $_SESSION['userId'] = $admin_row['id'];
    $_SESSION['username'] = $admin_row['username'];
    header('Location: login/welcome.php');
    exit;
  
  }

  else{
    
    $error = 'Invalid username or password';
  
  }

}

?>

<?php 
  if(isset($error)){
?>

  <p style="color: red; position: relative; left: 460px; bottom: 80px;"><?php echo $error;?></p>

<?php 
}
?>

<?php

  mysqli_close($conn);

?>
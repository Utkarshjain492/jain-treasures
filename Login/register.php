<html>
<head>
    <title>Register</title>
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
            width: 30%;
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
        .form{
            padding: 20px;
        }
        .form label{
            display: block;
            margin-bottom: 10px;
        }
        .form input[type="text"], .form input[type="email"], .form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }
        .form input[type="submit"]{
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form input[type="submit"]:hover{
            background-color: #444;
        }
    </style>
</head>
<body>
    <h1 class="webName">Jain-Treasures Hub</h1>
    <div class="container">
        <div class="header">
            <h1>Register</h1>
        </div>
        <div class="form">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label for="fullName">Name:</label>
                <input type="text" id="fullName" name="fullName" autocomplete="off"><br><br>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" autocomplete="off"><br><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" autocomplete="off"><br><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" autocomplete="off"><br><br>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" autocomplete="off"><br><br>
                <input type="submit" name="submit" value="Register">
            </form>
            <p>Already have an account? <a href="../index.php">Login</a></p>
        </div>
    </div>
</body>
</html>

<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "acmegrade";

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$query = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(500) DEFAULT NULL,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    reset_token VARCHAR(255) DEFAULT NULL,
    token_expiry DATETIME DEFAULT NULL
)";

$conn->query($query);

if(isset($_POST['submit'])){
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if(empty($username) || empty($email) || empty($password) || empty($confirm_password)){
        $error = "Please fill in all fields";
    } 
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email address";
    }
    elseif($password != $confirm_password){
        $error = "Passwords do not match";
    } 
    elseif($result -> num_rows > 0){
        $error = "User with this name or email already exists.";
    }
    else{
        $query = "INSERT INTO users(fullName, username, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $fullName, $username, $email, $password);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            $success = "User registered successfully";
        } 
        else{
            $error = "Failed to register user";
        }
    }
}

$conn->commit();
$conn->close();

?>

<?php 
    if(isset($error)){ 
?>
    <p style="color: red; position: relative; left: 450px; bottom: 80px;"><?php echo $error; ?></p>
<?php 
    } 
    elseif(isset($success)){ 
?>
    <p style="color: green; position: relative; left: 450px; bottom: 80px;"><?php echo $success; ?></p>
<?php 
    }
?>
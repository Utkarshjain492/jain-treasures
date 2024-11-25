<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background-image: url(/BG/index_bg.png);
            background-position: center;
            background-size: cover;
            overflow-x: hidden;
        }
        .container{
            position: relative;
            top: 100px;
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
        .message{
            position: relative;
            padding: 20px;
            text-align: center;
            bottom: 10px;
        }
        .login{
            right: 35%;
        }
        .login{
            position: absolute;
            width: 100px;
            bottom: 20px;
            text-align: center;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }
        .home:hover, .login:hover{
            background-color: #444;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Logout</h1>
        </div>
        <div class="message">
            <p>You have been successfully logged out.</p>
        </div>
        <p><a href="../index.php" class="login" target="_parent">Login Again</a></p>
    </div>
</body>
</html>

<?php

session_start();
$_SESSION = array();
session_destroy();
exit;

?>
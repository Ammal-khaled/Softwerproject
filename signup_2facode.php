<?php
session_start();

if(!isset($_SESSION["verified2"])){
    $_SESSION["verified2"]=false;
}
if($_SESSION["verified2"])
    header("location: home.php");

if($_SESSION["reg"]==false){
    header("location: signup.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f1e9fa;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.8); 
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            width: 100%;
        }
        .header {
            background-color: #d9c8fb; 
            color: rgb(151, 100, 246);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.5em;
            position: absolute;
            top: 0;
            width: 100%;
        }
        .header .title {
            font-size: 1em;
            margin-left:20px;
            color: rgb(151, 100, 246);
        }
        .header .welcome {
            font-size: 1em;
            margin-right: 20px;
            color: rgb(151, 100, 246);
            text-decoration: none;
        }
        h2 {
            color: #8421c2;
        }
        .button {
            background-color: #6A1B9A;
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #4A148C;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">KASIT</div>
        <a href="welcome.php" class="welcome">Welcome</a>
    </div>
    <div class="container">
        <h2>Please enter the following secret code into your google authenticator app </h2>
        <p><?php echo $_SESSION["2fa"]?><p>
        <form action="login.php" method="post">
        <button class="button" type="submit">Next</button>
        </form>

    </div>
</body>
</html>
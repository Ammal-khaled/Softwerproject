<?php
session_start();
require_once "config.php";


if(isset($_GET["token"])){
    $token = $_GET["token"];
    $_SESSION["token"] = $token ;
}
if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password2"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];    
    $token = $_SESSION["token"] ;
    $status=1;
    $sql = $conn->prepare("SELECT * FROM password_token WHERE user = ? and token = ? and status=?");
    $sql->bind_param("ssi", $username,$token,$status);
    $sql->execute();
    $result = $sql->get_result();
    if($result && mysqli_num_rows($result) > 0) {
        $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/';
        if($password == $password2) {
            if (preg_match($pattern, $password)){
                $salt= uniqid(mt_rand(), true);
                $hashed_password = hash('sha256', $password . $salt);
                $sql = $conn->prepare("UPDATE users SET password= ?,salt= ? WHERE username = ?");
                $sql->bind_param("sss", $hashed_password,$salt,$username);
                $sql->execute();
                $status=2;
                $sql = $conn->prepare("UPDATE password_token SET status=? WHERE user = ? and token = ?");
                $sql->bind_param("iss", $status,$username,$token);
                $sql->execute();
                header("location: login.php");
                $_SESSION["verified"]=false;
            }else $Errormsg="Password does not match.";
        }
        else $Errormsg="Password does not meet complexity requirements.";
    }
    else $Errormsg="Cannot update password" ;
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter New Password</title>
    <style>
        body {
            font-family: Garamond, serif;
            margin: 0;
            background-color: #e9d9fa; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            display: flex;
            width: 80%;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            height: 80%;
        }
        .left {
            background-color: #a125ef;
            color: rgb(244, 232, 255);
            padding: 40px;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: left;
        }
        .left h2 {
            font-size: 4em;
            margin: 0;
        }
        .right {
            background-color: #f5effb; /* Light lavender background */
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right h2 {
            color: #9636d1; /* Purple text color */
            margin-bottom: 20px;
        }
        .right input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #6A1B9A;
            border-radius: 4px;
            font-size: 1em;
            color: #e9d9fa;
        }
        .right input::placeholder {
            color: #eedcf9;
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
            align-self: flex-start;
        }
        .button:hover {
            background-color: #4A148C;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <h2>Please enter your new password</h2>
            
        </div>
        <div class="right">
            <h2>Username</h2>
            <form action="resetpassword.php" method="post">
                <input type="text" name="username" placeholder="Enter username..." required>
                <h2>New password </h2>
                <input type="password" name="password" placeholder="********" required>
                <h2>Re-enter new password </h2>
                <input type="password" name="password2" placeholder="********" required>
                <button class="button" type="submit">Submit</button>
                <h2><?php if(isset($Errormsg)){
                    echo $Errormsg; }
                ?></h2>
            </form>
        </div>
    </div>
</body>
</html>
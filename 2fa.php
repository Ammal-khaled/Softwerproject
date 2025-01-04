<?php
session_start();
if($_SESSION["verified"]==false)
{
    header("location: login.php");
    exit;
}
require_once('C:\Users\zaidf\vendor\autoload.php');
require_once "config.php";

if(isset($_POST["code"])){
$google2fa = new PragmaRX\Google2FA\Google2FA();    
$code = $_POST["code"];


$username=$_SESSION["user"];

$sql = $conn->prepare("SELECT * FROM users WHERE username = ?");
$sql->bind_param("s", $username);
$sql->execute();
$result = $sql->get_result();
if($result && mysqli_num_rows($result) > 0) {
    $record = mysqli_fetch_assoc($result);
    $userSecret =$record["userSecret"];

    $valid = $google2fa->verifyKey($userSecret, $code); 

    if($valid){
        $_SESSION["verified2"]=true;
        header("location: home.php");
    }
    else 
        $Errormsg="invalid 2fa code";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Two-Factor Authentication</title>
    <style>
        body {
            font-family: Garamond, serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f1e9fa;
        }
        .auth-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .auth-container h2 {
            color: #6A1B9A;
            text-align: center;
        }
        .auth-container h3 {
            color: #fa0202;
            text-align: center;
        }
        .auth-container input[type="text"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #6A1B9A;
            border-radius: 4px;
            font-size: 1em;
            border-color:#9728dc ;
        }
        .auth-container input[type="text"]::placeholder {
            color: #dea9ff; /* Change placeholder color */
        }
        .auth-container button {
            width: 100%;
            padding: 10px;
            background-color: #6A1B9A;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }
        .auth-container button:hover {
            background-color: #4A148C;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <h2>please Enter Two factor-authentication Code</h2>
        
        <form action="2fa.php" method="post">
            <input type="text" name="code" placeholder="Enter code" required>
            <button type="submit">Submit</button>
            <h3> <?php if(isset($Errormsg)){
            echo $Errormsg; }
            ?></h3>
        </form>

    </div>
</body>
</html>
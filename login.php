<?php
session_start();
require_once "config.php";

if(!isset($_SESSION["verified2"])){
$_SESSION["verified2"]=false;
}

if($_SESSION["verified2"])
    header("location: home.php");

    if(isset($_POST["username"]) && isset($_POST["password"])){
        
        $user="";
        $pass="";
        $salt="";
        $role=0;
        $username = $_POST["username"];
        $password = $_POST["password"];

        $response  = $_POST['g-recaptcha-response'] ; 
        $mysecret = "6Le-7hQqAAAAANa_akwrYXBBS1RKiiGnUSDR43fY" ;
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = ['secret'   => $mysecret,
                'response' => $response];
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
                ]
        ];
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $jsonArray = json_decode($result,true);
        $key = "success";
        $flag = $jsonArray[$key];



        if($flag){

            $sql = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $sql->bind_param("s", $username);
            $sql->execute();
            $result = $sql->get_result();
            if($result && mysqli_num_rows($result) > 0) {
                $record = mysqli_fetch_assoc($result);
                $user=$record["username"];
                $pass=$record["password"];
                $salt=$record["salt"];
                $role=$record["role"];
                $userID=$record["userID"];
            }

            $hash_password=hash('sha256', $password . $salt);
            if($hash_password==$pass) {
                $_SESSION["verified"]=true ;
                $_SESSION["user"]=$username ;
                $_SESSION["role"]=$role ;
                $_SESSION["userID"]=$userID ;
                $sql2 = $conn->prepare("SELECT * FROM users_information WHERE userID = ?");
                $sql2->bind_param("s", $_SESSION["userID"]);
                $sql2->execute();
                $result2 = $sql2->get_result();
                $record2 = mysqli_fetch_assoc($result2);
                $_SESSION["image_name"] = $record2['image_name'];
                header("location: 2fa.php");
            }
            else $Errormsg="incorect username or password";

        }
        else $Errormsg="plese check the box";
    
}
?>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f8f8;
        }
        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .login-container h2 {
            color: #6A1B9A;
            text-align: center;
        }
        .login-container h4 {
            color: #fa0202;
            text-align: center;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #6A1B9A;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #4A148C;
        }
        .login-container .signup-link,
        .login-container .forgot-password {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
        .g-recaptcha {
            margin: 20px 0;
        }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="login-container">
        <h2>Log In</h2>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <a href="forgetpassword.php" class="forgot-password">Forgot password?</a>
            <div class="g-recaptcha" data-sitekey="6Le-7hQqAAAAADLlRrAk0wjzDLLUi46aMEdeNjJA"></div>
            <h4> <?php if(isset($Errormsg)){
            echo $Errormsg; }
            ?></h4>
            <button type="submit">Log In</button>
            <a href="signup.php" class="signup-link">new user? Sign Up</a>
        </form>
    </div>
</body>
</html>
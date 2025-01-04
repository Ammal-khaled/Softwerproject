<?php
session_start();
require_once "config.php";
require_once('C:\Users\zaidf\vendor\autoload.php');

if(!isset($_SESSION["verified2"])){
    $_SESSION["verified2"]=false;
}

if($_SESSION["verified2"])
    header("location: home.php");

if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password2"]) && isset($_POST["email"]) && isset($_POST["role"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
    $email = $_POST["email"];
    $role=$_POST["role"];
    if($password == $password2){
        $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}$/';
        if (preg_match($pattern, $password)) {
            $salt= uniqid(mt_rand(), true);
            $hashed_password = hash('sha256', $password . $salt);
            $google2fa = new PragmaRX\Google2FA\Google2FA();
            $userSecret = $google2fa->generateSecretKey();
            $username2 = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
            $email2 = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
            $sql = $conn->prepare("INSERT INTO users (username, email, password, salt ,userSecret ,role) VALUES (?,?,?,?,?,?)");
            $sql->bind_param("ssssss", $username2, $email2, $hashed_password, $salt, $userSecret ,$role);
            if($sql->execute()){
                $_SESSION["2fa"]=$userSecret;
                $_SESSION["reg"]=true;
            } else $Errormsg="username is already taken" ;  

            $sql1 = $conn->prepare("SELECT userID from users where username = ?");
            $sql1->bind_param("s", $username2);
            $sql1->execute();
            $result1 = $sql1->get_result();
            if($result1 && mysqli_num_rows($result1) > 0) {
                $record1 = mysqli_fetch_assoc($result1);
                $userid = $record1['userID'];
                $sql2 = $conn->prepare("INSERT INTO users_information (userID) VALUES (?)");
                $sql2->bind_param("s",$userid);
                if($sql2->execute()){
                    header("location: signup_2facode.php");
                }
            }

                 

        }    
        else $Errormsg="Password does not meet complexity requirements.";       
    }else $Errormsg="Password does not match.";          
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
        .signup-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            padding-top: 30px;
        }
        .signup-container h2 {
            color: #6A1B9A;
            text-align: center;
        }
        .signup-container h4 {
            color: #fa0202;
            text-align: center;
        }
        .signup-container h5 {
            line-height: 0px;
        }
        
        .signup-container input[type="text"],
        .signup-container input[type="email"],
        .signup-container input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #6A1B9A;
            border-radius: 4px;
        }
        .signup-container input[type="radio"] {
            margin: 10px 5px 10px 0;
        }
        .signup-container label {
            margin-right: 15px;
        }
        .signup-container input[type="checkbox"] {
            margin: 10px 10px 10px 0;
        }
        .signup-container button {
            width: 100%;
            padding: 10px;
            background-color: #6A1B9A;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .signup-container button:hover {
            background-color: #4A148C;
        }
        .signup-container .login-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form action="signup.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password2" placeholder="Re-enter Password" required>
            <h5>Note:</h5>
        <h5> Password must be at least 8 characters long </h5>
        <h5> Password must contain at least one uppercase letter</h5>
        <h5> Password must contain at least one lowercase letter</h5>
        <h5> Password must contain at least one number</h5>
        <h5> Password must contain at least one special character</h5>      

            <div>
                <label>
                    <input type="radio" name="role" value="student" required> Student
                </label>
                <label>
                    <input type="radio" name="role" value="alumni"> Alumni
                </label>
                <label>
                    <input type="radio" name="role" value="company"> Company
                </label>
            </div>
            <label>
                <input type="checkbox" name="join_community"> Join the community
            </label>
            <br>
            <label>
                <input type="checkbox" name="privacy_policy" required>I agree to the privacy policy
            </label>
            <h4> <?php if(isset($Errormsg)){
            echo $Errormsg; }
            ?></h4>
            <button type="submit">Submit</button>
            <a href="login.php" class="login-link">Already a member? Log In</a>
        </form>
    </div>
</body>
</html>
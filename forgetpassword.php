<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('C:\Users\zaidf\vendor\autoload.php');
require_once "config.php";

#require 'PHPMailer.php';
#require 'C:\Users\admin\vendor\PHPMailer\PHPMailer\src\Exception.php';
#require 'C:\Users\admin\vendor\PHPMailer\PHPMailer\src\PHPMailer.php';
#require 'PHPMailer\src\SMTP.php';
#require 'PHPMailer/PHPMailerAutoload.php';

if(isset($_POST["username"])){
    // Recipient email address
    $username = $_POST["username"];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
        if($result && mysqli_num_rows($result) > 0) {
                $record = mysqli_fetch_assoc($result);
                $_SESSION["user"]=$username ;
                $to = $record["email"];
                
                $bytes = random_bytes(32); // 32 bytes = 256 bits
                $token = bin2hex($bytes);
                $status=1;

                $sql = $conn->prepare("INSERT INTO password_token (user, email, token, created, status) VALUES (?,?,?,NOW(),?)");
                $sql->bind_param("sssi",$username,$to,$token,$status);
                $sql->execute();
                // Sender email address (your Gmail address)
                $from = "zaidwebproject@outlook.com";
                // Email subject
                $subject = "Reset Password";
                // Email message
                $message = "Hi '$username', to reset your password click on the following link http://localhost/softwareproject/resetpassword.php?token=$token";

                // Email headers
                $headers = "From: $from\r\n";
                $headers .= "Reply-To: $from\r\n";
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

                // SMTP server configuration
                $smtpServer = "smtp.office365.com";
                $smtpPort = 587; 
                $username = "zaidwebproject@outlook.com";
                $password = "n6Y5HC8Di228mo@5fz~MCyt:8en-f3Mz";

                // PHPMailer library

                // Create a new PHPMailer instance
                $mail = new PHPMailer();

                // Set SMTP configuration
                $mail->isSMTP();
                $mail->Host = $smtpServer;
                $mail->Port = $smtpPort;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = $username;
                $mail->Password = $password;

                // Set email parameters
                $mail->setFrom($from);
                $mail->addAddress($to);
                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->send() ;
                // Send the email
           //   if ($mail->send()) {
           //    echo "Email sent successfully!";
           //    } else {
           //    echo "Error: " . $mail->ErrorInfo;

       //     }
      
        } $Outputmsg= "If the username is correct, an email will be sent to the corresspoding email";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Email</title>
    <style>
        body {
            font-family: Garamond, serif;
            margin: 0;
            background-color: #e9d9fa; /* Light purple background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: #f5effb; /* Light lavender background for the container */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        h2 {
            color: #6A1B9A; /* Purple text color */
            font-size: 2em;
            margin-bottom: 20px;
        }
        p {
            color: #6A1B9A; /* Purple text color */
            margin-bottom: 20px;
        }
        input[type="text"] {
            width: 80%;
            padding: 10px;
            margin: 20px 0;
            border: 2px solid #6A1B9A;
            border-radius: 4px;
            font-size: 1em;
        }
        input[type="text"]::placeholder {
            color: #eedcf9; /* Change placeholder color */
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
    <div class="container">
        <h2>Please enter your username</h2>
        <p>We will send you an email to verify the email, and then you can change the password.</p>

        <form action="forgetpassword.php" method="post">
        <input type="text" placeholder="Enter here" name="username" required />
        <button class="button" type="submit">Submit</button>
        <p><?php if(isset($Outputmsg)){
            echo $Outputmsg; }
        ?></p>
    </form>
    </div>
</body>
</html>
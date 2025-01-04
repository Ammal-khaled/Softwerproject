<?php
session_start();
require_once "config.php";
if($_SESSION["verified"]==false ||$_SESSION["verified2"]==false)
{
    header("location: login.php");
    exit;
}
if(isset($_GET["userID"])){
    $_SESSION["userID2"]=$_GET["userID"];
    $sql = $conn->prepare("SELECT username FROM users WHERE userID = ?");
    $sql->bind_param("s", $_SESSION["userID2"]);
    $sql->execute();
    $result = $sql->get_result();

    if ($result && mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);
        $_SESSION["username2"]=$record["username"];
        header("location:private_chat.php");
    }
}
?>
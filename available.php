<?php
session_start();
require_once "config.php";
if($_SESSION["verified"]==false ||$_SESSION["verified2"]==false)
{
    header("location: login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the value of the checkbox
    $available = isset($_POST['available']) ? 1 : 0;

    $sql = $conn->prepare("UPDATE users_information SET available=? WHERE userID = ?");
    $sql->bind_param("ss", $available,$_SESSION["userID"]);
    $sql->execute();
    header("location:profile.php?userID=".$_SESSION["userID"]);
}
?>
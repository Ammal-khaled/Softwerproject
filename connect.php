<?php
session_start();
require_once "config.php";
if($_SESSION["verified"]==false ||$_SESSION["verified2"]==false)
{
    header("location: login.php");
    exit;
}
if(isset($_GET["userID"]))
$sql = $conn->prepare("INSERT INTO connections (senderID, receiverID ,status) VALUES (?,?,0)");
$sql->bind_param("ss", $_SESSION["userID"],$_GET["userID"] );
if($sql->execute())
    header("location:profile.php?userID=".$_SESSION["userID2"])

?>
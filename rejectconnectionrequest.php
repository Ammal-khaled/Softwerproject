<?php
session_start();
require_once "config.php";
if($_SESSION["verified"]==false ||$_SESSION["verified2"]==false)
{
    header("location: login.php");
    exit;
}
if(isset($_GET["requestID"]))
$sql = $conn->prepare("DELETE FROM connections WHERE requestID=?");
$sql->bind_param("i", $_GET["requestID"] );
if($sql->execute())
    header("location:connections.php")

?>
<?php
session_start();
require_once "config.php";
if($_SESSION["verified"]==false ||$_SESSION["verified2"]==false)
{
    header("location: login.php");
    exit;
}

if(isset($_GET["eventID"])){
    $regID=$_GET["eventID"].$_SESSION["userID"].($_GET["eventID"]-$_SESSION["userID"]);

    $sql = $conn->prepare("INSERT INTO regevents (regID,eventID,userID) VALUES (?,?,?)");
    $sql->bind_param("sss", $regID,$_GET["eventID"],$_SESSION["userID"]);
    if($sql->execute()){
        $_SESSION["regmsg"]="Registration Successfully" ;
        header("location: myevents.php");
    }  
    else{
        $_SESSION["regmsg"]="Already Registered In This Event" ;
        header("location: myevents.php");
    }

}


?>
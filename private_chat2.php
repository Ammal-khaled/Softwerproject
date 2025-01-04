<?php
session_start();
require_once "config.php";

$sql2 = $conn->prepare("SELECT * FROM private_chat WHERE (senderID = ? or senderID = ?) and (receiverID = ? or receiverID = ?)");
$sql2->bind_param("ssss",$_SESSION["userID"],$_SESSION["userID2"],$_SESSION["userID"],$_SESSION["userID2"]);
$sql2->execute();
$result2 = $sql2->get_result();


if ($result2 && mysqli_num_rows($result2) > 0) {
    while ($record2 = mysqli_fetch_assoc($result2)) {
        $senderID = $record2['senderID'];
        $sql3 = $conn->prepare("SELECT username FROM users WHERE userID = ?");
        $sql3->bind_param("s", $senderID);
        $sql3->execute();
        $result3 = $sql3->get_result();

        if ($result3 && mysqli_num_rows($result3) > 0) {
            $record3 = mysqli_fetch_assoc($result3);
            $username = $record3['username'];
        }

        
        if($senderID==$_SESSION["userID"])
            echo '<div class="chat-message user"><p>' . htmlspecialchars($record2['message']) . '</p></div>';
        else if($senderID==$_SESSION["userID2"])
            echo '<div class="chat-message bot"><p>' . htmlspecialchars($record2['message']) . '</p></div>';
    }}
    ?>
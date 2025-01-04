<?php
session_start();
require_once "config.php";

$sql2 = $conn->prepare("SELECT * FROM events_chat WHERE eventID = ?");
$sql2->bind_param("s",$_SESSION["eventID"]);
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
        else 
        echo '<div class="chat-message bot"><p><strong>' .'<a href="profile.php?userID='.$senderID.'" style="text-decoration: none"; Color:"#6A1B9A";> '.htmlspecialchars($username).'</a>' . ': </strong>' . htmlspecialchars($record2['message']) . '</p></div>';
    }}
    ?>
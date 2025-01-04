<?php
session_start();
require_once "config.php";
$sql = "SELECT * FROM general_chat";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    while ($record = mysqli_fetch_assoc($result)) {
        $userID = $record['userID'];
        $sql2 = $conn->prepare("SELECT username FROM users WHERE userID = ?");
        $sql2->bind_param("s", $userID);
        $sql2->execute();
        $result2 = $sql2->get_result();

        if ($result2 && mysqli_num_rows($result2) > 0) {
            $record2 = mysqli_fetch_assoc($result2);
            $username = $record2['username'];
        } 
        if($userID==$_SESSION["userID"])
            echo '<div class="chat-message user"><p>' . htmlspecialchars($record['message']) . '</p></div>';
        else
            echo '<div class="chat-message bot"><p><strong>' .'<a href="profile.php?userID='.$userID.'" style="text-decoration: none"; Color:"#6A1B9A";> '.htmlspecialchars($username).'</a>' . ': </strong>' . htmlspecialchars($record['message']) . '</p></div>';
    }}
    ?>
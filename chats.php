<?php
session_start();
require_once "config.php";
if($_SESSION["verified"]==false ||$_SESSION["verified2"]==false)
{
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat List</title>
    <style>
        body {
            font-family: "Familjen Grotesk", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1e9fa;
            color: #6A1B9A;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .header {
    position: fixed;
    width: calc(100% - 40px);
    max-width: 97%;
    margin: 0 auto;
    background-color: #d9c8fb;
    color: white;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 1000;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Slightly more pronounced shadow */
    font-family: Arial, sans-serif;
}

.header .title {
    font-size: 1.8em;
    margin: 0;
    font-weight: bold;
}

.header nav {
    display: flex;
    align-items: center;
}

.header nav a {
    color: white;
    margin-left: 20px;
    text-decoration: none;
    padding: 8px 16px; /* Adjusted for a better balance */
    border-radius: 4px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.header nav a:hover,
.header nav a:focus {
    background-color: rgba(255, 255, 255, 0.3); /* Slightly more pronounced hover effect */
    transform: scale(1.05);
    outline: none;
}

a img {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    margin-right: 10px;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #d9c8fb;
    min-width: 200px; 
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 100;
    left: -50px;
    top: 100%;
    border-radius: 0 0 8px 8px;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}

.dropdown-content a {
    color: white;
    padding: 12px 16px;
    display: block;
    text-decoration: none;
}

.dropdown-content a:hover,
.dropdown-content a:focus {
    background-color: #cb84f9;
    outline: 2px solid #cb84f9;
    border-radius: 4px;
}

.dropdown:hover .dropdown-content {
    display: block;
    opacity: 1;
    visibility: visible;
}


        .container {
            width: 90%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
            overflow-y: auto;
        }
        .tab-buttons {
            display: flex;
            margin-bottom: 20px;
        }
        .tab-buttons button {
            flex: 1;
            padding: 10px;
            border: none;
            cursor: pointer;
            font-size: 1em;
            background-color: #e9d9fa; /* Default background for buttons */
            color: #6A1B9A;
            transition: background-color 0.3s ease;
        }
        .tab-buttons button.active {
            background-color: #6A1B9A; /* Active button background color */
            color: white;
        }
        .tab-buttons button:hover {
            background-color: #cb84f9; /* Hover effect for inactive buttons */
        }
        .chat-entry {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #6A1B9A;
            transition: background-color 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }
        .chat-entry:hover {
            background-color: #e9d9fa;
        }
        .chat-entry img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }
        .chat-entry .chat-info {
            flex-grow: 1;
        }
        .chat-entry .chat-info h4 {
            margin: 0;
            font-size: 1em;
            color: #6A1B9A;
        }
        .chat-entry .chat-info p {
            margin: 5px 0 0 0;
            font-size: 0.9em;
            color: #606770;
        }
        .chat-entry .chat-time {
            font-size: 0.8em;
            color: #999;
        }
    </style>

</head>
<body>
<header class="header">
    <div class="title">KASIT BRIDGE</div>
    <nav>
        <a href="home.php" aria-label="Home">Home</a>
        <a href="available_alumni.php" aria-label="Mentorship">Mentorship</a>
        <a href="connections.php" aria-label="Connections">Connections</a>
        <a href="events.php" aria-label="Events">Events</a>
        <a href="myevents.php" aria-label="My Events">My Events</a>
        <a href="job_board.php" aria-label="Job Board">Job Board</a>
        <a href="projects.php?" aria-label="Projects">Projects</a>
        <a href="chats.php?private" aria-label="Chats">Chats</a>
        <div class="dropdown">
            <a class="dropbtn" aria-label="Profile Menu">
                <img src="<?php echo htmlspecialchars($_SESSION['image_name']); ?>" alt="Profile Picture">
            </a>
            <div class="dropdown-content" id="dropdown-content">
                <a href="profile.php?userID=<?php echo urlencode($_SESSION['userID']); ?>" aria-label="My Profile">My Profile</a>
                <a href="general_chat.php" aria-label="General Chat">General Chat</a>
                <a href="links.php" aria-label="Learning">Learning</a>
                <a href="success.php" aria-label="Successful stories">Successful stories</a>
                <a href="contact.php" aria-label="Contact">Contact</a>
                <a href="logout.php" aria-label="Log out">Log out</a>
            </div>
        </div>
    </nav>
</header>
        <br><br><br>
    <div class="container">


        <?php
        if(isset($_GET["private"])){
            echo"<div class='tab-buttons'>
                <a href='chats.php?private=True'><button style='width:400px;' class='active' onclick='toggleTab(this)'>Private</button></a>
                <a href='chats.php?general=True'><button style='width:400px;' onclick='toggleTab(this)'>Events</button></a>
            </div>";





            $sql = $conn->prepare("SELECT DISTINCT chatID FROM private_chat WHERE  senderID = ? or  receiverID = ? ");
            $sql->bind_param("ss",$_SESSION["userID"],$_SESSION["userID"]);
            $sql->execute();
            $result = $sql->get_result();

            if ($result && mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_assoc($result)) {
                    $sql2 = $conn->prepare("SELECT * FROM private_chat WHERE  chatID=? ORDER BY msgID DESC; ");
                    $sql2->bind_param("s",$record["chatID"]);
                    $sql2->execute();
                    $result2 = $sql2->get_result();
            
                    if ($result2 && mysqli_num_rows($result2) > 0) {
                        $record2 = mysqli_fetch_assoc($result2);
                        if($_SESSION["userID"]!=$record2["receiverID"]){
                            $sql3 = $conn->prepare("SELECT image_name FROM users_information where userID=? ");
                            $sql3->bind_param("s",$record2["receiverID"]);
                            $sql3->execute();
                            $result3 = $sql3->get_result();

                            if ($result3 && mysqli_num_rows($result3) > 0) {
                                $record3 = mysqli_fetch_assoc($result3);

                                $sql4 = $conn->prepare("SELECT username FROM users WHERE userID = ?");
                                $sql4->bind_param("s", $record2["receiverID"]);
                                $sql4->execute();
                                $result4 = $sql4->get_result();
                        
                                if ($result4 && mysqli_num_rows($result4) > 0) {
                                    $record4 = mysqli_fetch_assoc($result4);
                                
                                    echo "<a href='chats2.php?userID=".$record2["receiverID"]."'class='chat-entry'>";
                                    echo "<img src='".$record3['image_name']."'  alt='Profile Picture'>";
                                    echo "<div class='chat-info'><h4>".$record4['username']."</h4>";
                                    echo "<p> ".$record2['message']." </p></div></a>";
                                }
                                
                            }
        
                        }else{
                            $sql3 = $conn->prepare("SELECT image_name FROM users_information where userID=? ");
                            $sql3->bind_param("s",$record2["senderID"]);
                            $sql3->execute();
                            $result3 = $sql3->get_result();

                            if ($result3 && mysqli_num_rows($result3) > 0) {
                                $record3 = mysqli_fetch_assoc($result3);

                                $sql4 = $conn->prepare("SELECT username FROM users WHERE userID = ?");
                                $sql4->bind_param("s", $record2["senderID"]);
                                $sql4->execute();
                                $result4 = $sql4->get_result();
                        
                                if ($result4 && mysqli_num_rows($result4) > 0) {
                                    $record4 = mysqli_fetch_assoc($result4);
                                
                                    echo "<a href='chats2.php?userID=".$record2["senderID"]."'class='chat-entry'>";
                                    echo "<img src='".$record3['image_name']."'  alt='Profile Picture'>";
                                    echo "<div class='chat-info'><h4>".$record4['username']."</h4>";
                                    echo "<p> ".$record2['message']." </p></div></a>";
                                }
                                
                            }

                            } 

                    }
                }

            }
        }    
        if(isset($_GET["general"])){
            echo"<div class='tab-buttons'>
                <a href='chats.php?private=True'><button style='width:400px;' onclick='toggleTab(this)'>Private</button></a>
                <a href='chats.php?general=True'><button style='width:400px;' class='active' onclick='toggleTab(this)'>Events</button></a>
                </div>";

            $sql = $conn->prepare("SELECT eventID FROM regevents where userID=? ");
            $sql->bind_param("s", $_SESSION["userID"]);
            $sql->execute();
            $result = $sql->get_result();
            if ($result && mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_assoc($result)) {
                    $sql2 = $conn->prepare("SELECT * FROM events where eventID = ?");
                    $sql2->bind_param("s", $record['eventID']);
                    $sql2->execute();
                    $result2 = $sql2->get_result();
                    if ($result2 && mysqli_num_rows($result2) > 0) {
                        $record2 = mysqli_fetch_assoc($result2);
                        
                        $sql3 = $conn->prepare("SELECT * FROM events_chat WHERE eventID = ? ORDER BY messageID DESC;");
                        $sql3->bind_param("s",$record['eventID']);
                        $sql3->execute();
                        $result3 = $sql3->get_result();
                        if ($result3 && mysqli_num_rows($result3) > 0) {
                            $record3 = mysqli_fetch_assoc($result3);

                            $sql4 = $conn->prepare("SELECT username FROM users WHERE userID = ? ");
                            $sql4->bind_param("s",$record3['senderID']);
                            $sql4->execute();
                            $result4 = $sql4->get_result();
                            if ($result4 && mysqli_num_rows($result4) > 0) {
                                $record4 = mysqli_fetch_assoc($result4);
                                if($record4['username']!=$_SESSION["user"]){
                                    echo "<a href='events_chat.php?eventID=".$record["eventID"]."'class='chat-entry'>";
                                    echo "<div class='chat-info'><h4>".$record2['event_name']."</h4>";
                                    echo "<p>".$record4['username'].": ".$record3['message']."</p></div></a>";
                                }else{
                                    echo "<a href='events_chat.php?eventID=".$record["eventID"]."'class='chat-entry'>";
                                    echo "<div class='chat-info'><h4>".$record2['event_name']."</h4>";
                                    echo "<p> You: ".$record3['message']."</p></div></a>";
                                }
                            }
                            
                        }
                    }
                }
            }
        }
    ?>
  
    </div>

</body>
</html>
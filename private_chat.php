<?php
session_start();
require_once "config.php";
if($_SESSION["verified"]==false ||$_SESSION["verified2"]==false)
{
    header("location: login.php");
    exit;
}

if(isset($_POST["message"])){
    $message = $_POST["message"];
    $escaped_message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    $chatID =($_SESSION["userID"]*$_SESSION["userID2"]).($_SESSION["userID"]+$_SESSION["userID2"]);
    $sql = $conn->prepare("INSERT INTO private_chat (chatID,senderID,receiverID,message) VALUES (?,?,?,?)");
    $sql->bind_param("ssss",$chatID,$_SESSION["userID"],$_SESSION["userID2"],$escaped_message);
    $sql->execute();

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f1e9fa;
            background-size: cover;
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


        .chat-container {
            background-color: rgba(252, 245, 252, 0.8); 
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(43, 0, 234, 0.1);
            max-width: 600px;
            width: 100%;
            display: flex;
            flex-direction: column;
            height: 80vh;
            margin: 20px auto;
        }
        .chat-header {
            color: #8421c2;
            text-align: left;
            font-size: 1.2em;
        }
        .chat-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            border: 1px solid #8000ff4e;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .chat-message {
            margin: -1.43em 0 -0.93em 0;

        }
        .chat-message.user {
            text-align: right;
        }
        .chat-message.bot {
            text-align: left;
        }
        .chat-message p {
            display: inline-block;
            padding: 10px;
            border-radius: 10px;
            max-width: 80%;
            word-wrap: break-word;
        }
        .chat-message.user p {
            background-color: #6A1B9A;
            color: white;
        }
        .chat-message.bot p {
            background-color: #e1e1e1;
            color: black;
        }
        .chat-input {
            display: flex;
            border-top: 1px solid #8000ff4e;
            padding: 10px;
        }
        .chat-input input {
            flex: 1;
            padding: 10px;
            border: 1px solid #8000ff4e;
            border-radius: 4px;
            background-color: rgba(252, 245, 252, 0.8);
            color:#8421c2;
        }
        .chat-input input::placeholder {
            color: #dea9ff;
        }
        .chat-input button {
            background-color: #6A1B9A;
            border: none;
            color: white;
            padding: 10px 20px;
            margin-left: 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .chat-input button:hover {
            background-color: #4A148C;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function updateContent() {
                $('#live-chat').load('private_chat2.php'); 
            }
            setInterval(updateContent, 1); 
        });
    </script>
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
    <div class="chat-container">
        <div class="chat-header"><a style="text-decoration: none"; href=<?php echo "profile.php?userID=".$_SESSION["userID2"]; ?>> <?php echo $_SESSION["username2"]  ?></a></div>
        <div class="chat-messages" id="live-chat">
            <!-- Example messages -->

        </div>
        <div class="chat-input">
        <form action="private_chat.php" method="post">
            <input style="width:472px;" type="text" name="message" placeholder="Type a message..." />
            <button type="submit">Send</button>
        </form>
        </div>
    </div>


</body>
</html>

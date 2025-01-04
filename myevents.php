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
    <title>My Events</title>
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


    .create-event-button {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #6A1B9A;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            margin: 5px 0px; /* Adjusted margin for left alignment */
            max-width: 160px; /* Optional: limit the width of the button */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.2s ease;
        }
        .create-event-button:hover {
            background-color: #4A148C;
        }
        .create-event-button i {
            margin-right: 5px;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            height: 70vh;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            flex: 1;
        }
        .event {
            background-color: #e9d9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: inherit;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .event:hover {
            background-color: #d0b6ec;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .event-content {
            flex-grow: 1;
        }
        .event h3 {
            margin: 0 0 10px 0;
            font-size: 1.2em;
        }
        .event p {
            margin: 5px 0;
        }
        .event .description {
            margin-top: 10px;
            color: #4A148C;
        }
        .register-button {
            background-color: #6A1B9A;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            transition: background-color 0.2s ease;
        }
        .register-button:hover {
            background-color: #4A148C;
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
        <br><br><br><br>
    <div class="container">
    <?php 
        if(isset($_SESSION["regmsg2"])){
        echo"<p>".$_SESSION["regmsg2"]."</p>";
        $_SESSION["regmsg"]="";
        $_SESSION["regmsg2"]="";
        }
    
    
    if(isset($_SESSION["regmsg"])){
        echo"<p>".$_SESSION["regmsg"]."</p>";
        $_SESSION["regmsg"]="";
    }      
    ?>


    <?php if($_SESSION["role"]!="student")
        echo"<a href='createevents.php' class='create-event-button'><i class='fa fa-plus'></i> Create Event</a>";
                
    ?>

    <?php 
        $sql = $conn->prepare("SELECT eventID FROM regevents where userID=? ");
        $sql->bind_param("s", $_SESSION["userID"]);
        $sql->execute();
        $result = $sql->get_result();
        if ($result && mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_assoc($result)) {
                $sql = $conn->prepare("SELECT * FROM events where eventID = ?");
                $sql->bind_param("s", $record['eventID']);
                $sql->execute();
                $result2 = $sql->get_result();
                if ($result2 && mysqli_num_rows($result2) > 0) {
                    while ($record2 = mysqli_fetch_assoc($result2)) {
                        echo "<div class='event'><div class='event-content'><h3>".$record2['event_name']."</h3>";
                        echo "<p><strong>Issuer: </strong>".$record2['event_owner_name']."</p>";
                        echo "<p><strong>Date: </strong>".$record2['event_date']."</p>";
                        echo "<p><strong>Time: </strong>".$record2['event_time']."</p>";
                        echo "<p class='description'>".$record2['event_description']."</p></div>";
                        echo "<form action='events_chat.php?eventID=".$record2['eventID']."' method='post'>
                        <button class='register-button' type='submit'>Start Chatting</button>
                    </form>"."</div>";
                    }
                }
            }
        }
    ?>
    </div>
                
            
            
       
    </div> 




</body>
</html>

<?php
session_start();
require_once "config.php";
if($_SESSION["verified"]==false ||$_SESSION["verified2"]==false)
{
    header("location: login.php");
    exit;
}
if(isset($_POST["event_name"]) && isset($_POST["event_description"]) && isset($_POST["event_date"]) && isset($_POST["event_time"])){

    $event_name = htmlspecialchars($_POST["event_name"], ENT_QUOTES, 'UTF-8');
    $event_description = htmlspecialchars($_POST["event_description"], ENT_QUOTES, 'UTF-8');
    $event_date = htmlspecialchars($_POST["event_date"], ENT_QUOTES, 'UTF-8');
    $event_time = htmlspecialchars($_POST["event_time"], ENT_QUOTES, 'UTF-8');

    $sql = $conn->prepare("INSERT INTO events (event_name, event_description, event_date,event_time ,event_owner_id ,event_owner_name) VALUES (?,?,?,?,?,?)");
    $sql->bind_param("ssssss", $event_name, $event_description,$event_date ,$event_time, $_SESSION["userID"], $_SESSION["user"]);
    if($sql->execute()){
        $sql = $conn->prepare("SELECT eventID FROM events where event_name=?");
        $sql->bind_param("s", $event_name);
        $sql->execute();
        $result = $sql->get_result();
        if ($result && mysqli_num_rows($result) > 0) {
            $record = mysqli_fetch_assoc($result);
            $_SESSION["regmsg2"]="Created Successfully" ;
            header("location: regevent.php?eventID=".$record['eventID']); 
        }   
    }else $Errormsg="cannot add event" ;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <style>
        body {
            font-family: "Familjen Grotesk", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1e9fa;
            color: #6A1B9A;
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
            margin: 80px auto 20px auto; /* Added margin to push content below fixed header */
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h3 {
            border-bottom: 2px solid #6A1B9A;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }
        .form-group label {
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea {
            padding: 10px;
            border: 2px solid #6A1B9A;
            border-radius: 4px;
        }
        .form-group input::placeholder, 
        .form-group textarea::placeholder {
            color: #c07de9; /* Custom color for placeholder text */
        }
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        .form-group input[type="datetime-local"] {
            padding: 10px;
            border-radius: 4px;
            border: 2px solid #6A1B9A;
        }
        .button-group {
            display: flex;
            justify-content: flex-end;
        }
        .button-group button {
            background-color: #6A1B9A;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }
        .button-group button:hover {
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
<br>
<div class="container">
    <div class="section">
        <h3>Create Event</h3>
        <form action="createevents.php" method="post">
            <div class="form-group">
                <label for="event-name">Event Name</label>
                <input type="text" id="event-name" name="event_name" placeholder="Enter the event name" required>
            </div>
            <div class="form-group">
                <label for="event-description">Description</label>
                <textarea id="event-description" name="event_description" placeholder="Enter a description of the event" required></textarea>
            </div>
            <div class="form-group">
                <label for="event-date">Date</label>
                <input type="date" id="event-date" name="event_date" required>
            </div>
            <div class="form-group">
                <label for="event-date">Time</label>
                <input type="time" id="event-time" name="event_time" required>
            </div>

            <div class="button-group">
                <button type="submit">Create Event</button>
            </div>
        </form>
    </div>
</div>


</body>
</html>
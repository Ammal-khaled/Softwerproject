<?php
session_start();
require_once "config.php";
if($_SESSION["verified"]==false ||$_SESSION["verified2"]==false)
{
    header("location: login.php");
    exit;
}

if(isset($_POST["F_name"]) && isset($_POST["L_name"]) && isset($_POST["email"]) && isset($_POST["subject"]) && isset($_POST["message"])){
    $F_name = htmlspecialchars($_POST["F_name"], ENT_QUOTES, 'UTF-8');
    $L_name = htmlspecialchars($_POST["L_name"], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8');
    $subject = htmlspecialchars($_POST["subject"], ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');

    $sql = $conn->prepare("INSERT INTO contacts (F_name, L_name ,email,subject,message) VALUES (?,?,?,?,?)");
    $sql->bind_param("sssss", $F_name, $L_name, $email,$subject,$message);
    if($sql->execute())
        $msg="Thank you for contacting us , we will respond to you as soon as possible.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect Now</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
        }
        .left-section {
            width: 40%;
            text-align: left;
        }
        .left-section img {
            width: 100%;
            border-radius: 8px;
        }
        .left-section h1 {
            font-size: 2.5em;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .left-section p {
            font-size: 1.2em;
            margin-top: 5px;
        }
        .right-section {
            width: 50%;
        }
        .right-section p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #6A1B9A;
            font-weight: bold;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-bottom: 2px solid #6A1B9A;
            font-size: 1em;
            color: #6A1B9A;
            background-color: transparent;
        }
        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #c07de9;
        }
        .form-group.full-width {
            flex-direction: column;
        }
        .form-group.full-width input,
        .form-group.full-width textarea {
            width: 100%;
        }
        .form-group.full-width textarea {
            height: 100px;
            resize: vertical;
        }
        .right-section button {
            background-color: #6A1B9A;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1.2em;
            display: block;
            margin-top: 20px;
            width: 100%;
        }
        .right-section button:hover {
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
        <div class="left-section">
            <p><?php if(isset($msg)) echo $msg;?></p>
            <img src="resources\contact.jpg" alt="Connect Image">
            <h1>CONNECT NOW</h1>
            <p>Reach Out to Us</p>
        </div>
        
        <div class="right-section">
        <form action="contact.php" method="post">
            <p>If you have any questions or need assistance, feel free to reach out. We're here to support you!</p>
            <div class="form-group">
                
                <div>
                    <label for="first-name">Your Name *</label>
                    <input type="text" name="F_name" id="first-name" placeholder="Your Name" required>
                </div>
                <div>
                    <label for="last-name">Last Name *</label>
                    <input type="text" name="L_name" id="last-name" placeholder="Last Name" required>
                </div>
            </div>
            <div class="form-group full-width">
                <label for="email">Your Email *</label>
                <input type="email" name="email" id="email" placeholder="Your Email" required>
            </div>
            <div class="form-group full-width">
                <label for="subject">Subject *</label>
                <input type="text" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group full-width">
                <label for="message">Message</label>
                <textarea id="message" name="message" placeholder="Message" required></textarea>
            </div>
            <button type="submit">Send</button>
        </div>    
        </form>
    </div>

</body>
</html>

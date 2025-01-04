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
    <title>helpful videos</title>
    <!-- Include FontAwesome CSS if needed for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: "Familjen Grotesk", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1e9fa; /* Your theme's background color */
            color: #6A1B9A; /* Your theme's text color */
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
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white; /* Your theme's container background color */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .block {
            background-color: #e9d9fa; /* Your theme's block background color */
            border: 1px solid #c07de9; /* Border color to match theme */
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .block h2 {
            margin-top: 0;
            color: #4A148C; /* Title color */
        }
        .block p {
            margin: 10px 0;
            color: #6A1B9A; /* Text color */
        }
        .block a {
            color: #6A1B9A; /* Link color */
            text-decoration: none;
            font-weight: bold;
        }
        .block a:hover {
            text-decoration: underline;
        }
        .block iframe {
            width: 100%;
            height: 315px;
            border: none;
            border-radius: 8px;
            margin-top: 10px;
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
        <div class="block">
            <h2>video 1</h2>
            <p>Introduction to Algorithms</p>
            <a href="https://www.youtube.com/watch?v=0IAPZzGSbME" target="_blank">Watch on YouTube</a>
            <iframe src="https://www.youtube.com/embed/0IAPZzGSbME" allowfullscreen></iframe>
        </div>
        <div class="block">
            <h2>video 2</h2>
            <p>React.js Basics in 90 Mins</p>
            <a href="https://www.youtube.com/watch?v=fJSFus0pxZI" target="_blank">Watch on YouTube</a>
            <iframe src="https://www.youtube.com/embed/fJSFus0pxZI" allowfullscreen></iframe>
        </div>
        <div class="block">
            <h2>video 3</h2>
            <p>Learn Python in Arabic #001 - Introduction And What's Python</p>
            <a href="https://www.youtube.com/watch?v=mvZHDpCHphk" target="_blank">Watch on YouTube</a>
            <iframe src="https://www.youtube.com/embed/mvZHDpCHphk" allowfullscreen></iframe>
        </div>
        <div class="block">
            <h2>video 4</h2>
            <p>SSL, TLS, HTTP, HTTPS Explained</p>
            <a href="https://www.youtube.com/watch?v=hExRDVZHhig" target="_blank">Watch on YouTube</a>
            <iframe src="https://www.youtube.com/embed/hExRDVZHhig" allowfullscreen></iframe>
        </div>
        <div class="block">
            <h2>video 5</h2>
            <p>Five Steps to Create a New AI Model</p>
            <a href="https://www.youtube.com/watch?v=jcgaNrC4ElU" target="_blank">Watch on YouTube</a>
            <iframe src="https://www.youtube.com/embed/jcgaNrC4ElU" allowfullscreen></iframe>
        </div>
        <div class="block">
            <h2>video 6</h2>
            <p>The Philosophy of Time Management | Brad Aeon | TEDxConcordia</p>
            <a href="https://www.youtube.com/watch?v=WXBA4eWskrc" target="_blank">Watch on YouTube</a>
            <iframe src="https://www.youtube.com/embed/WXBA4eWskrc" allowfullscreen></iframe>
        </div>
        <div class="block">
            <h2>video 7</h2>
            <p>Project Management Simplified: Learn The Fundamentals of PMI's Framework âœ“</p>
            <a href="https://www.youtube.com/watch?v=ZKOL-rZ79gs" target="_blank">Watch on YouTube</a>
            <iframe src="https://www.youtube.com/embed/ZKOL-rZ79gs" allowfullscreen></iframe>
        </div>
    </div>
    
</body>
</html>
<?php
session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];

    $sql = $conn->prepare("INSERT INTO projects (project_leader_id,leader_name, project_name, project_description) VALUES (?, ?, ?, ?)");
    $sql->bind_param("ssss",$_SESSION['userID'] ,$_SESSION['user'], $project_name, $project_description);

    if ($sql->execute()) {
        header("location:projects.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
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
            margin: 100px auto 20px auto; /* Added margin to push content below fixed header */
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
            color: #4A148C;
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
            color: #c07de9;
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
        <h3>Create Project</h3>
        <form action="" method="post">
            <div class="form-group">
                <label for="project-name">Project Name</label>
                <input type="text" id="project-name" name="project_name" placeholder="Enter the project name">
            </div>
            
            <div class="form-group">
                <label for="project-description">Description</label>
                <textarea id="project-description" name="project_description" placeholder="Enter a description of the project"></textarea>
            </div>
            <div class="button-group">
                <button type="submit">Create Project</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
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
    <title>View Projects</title>
    <style>
        body {
            font-family: "Familjen Grotesk", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1e9fa; /* Background color from your theme */
            color: #6A1B9A; /* Text color from your theme */
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


        h1 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #4A148C; /* Darker color for the heading */
            text-align: center; /* Align the heading to the left */
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        .project-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center; /* Center the projects */
            padding: 10px;
        }
        .project-box {
            background-color: #e9d9fa; /* Box background color to match your theme */
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 5px;
            width: calc(90% - 20px); /* Two boxes per line */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }
        .project-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .project-box h2 {
            margin-bottom: 0px;
            color: #4A148C; /* Darker color for the project titles */
        }
        .project-box p {
            color: #6A1B9A; /* Text color to match your theme */
        }
    </style>
</head>
<body>
    <br><br><br>
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

    <div class="container">
        <h1>Projects</h1>
        <div class="project-container">



                            
    <?php if($_SESSION["role"]!="company")
        echo"<a href='create_projects.php' class='create-event-button'><i class='fa fa-plus'></i> Create Project</a>";
                
    ?>
            <?php
                $sql = $conn->prepare("SELECT * FROM projects");
                $sql->execute();
                $result = $sql->get_result();
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($record = mysqli_fetch_assoc($result)) {
                        echo "<a style='text-decoration: none;' class='project-box' href='profile.php?userID=".$record['project_leader_id']."'><div> ";
                        echo "<h2>" . $record['project_name'] . "</h2>";
                        echo "<p><strong>Leader Name:</strong> " . $record['leader_name'] . "</p>";
                        echo "<p>" . $record['project_description'] . "</p>";
                        echo '</div></a>';
                    }
                } else {
                    echo "No projects found.";
                }
            ?>

            
    </div>
</body>
</html>
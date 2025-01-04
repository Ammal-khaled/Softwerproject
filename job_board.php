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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Jobs
    </title>
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
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
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
        .events-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Two columns */
            gap: 20px; /* Gap between cards */
        }
        .event-card {
            background-color: #e9d9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .event-card h3 {
            margin: 0 0 10px 0;
            font-size: 1.5em;
            color: #4A148C;
        }
        .event-card p {
            margin: 5px 0;
            font-size: 1.2em;
            color: #6A1B9A;
        }
        .event-card .description {
            margin-top: 10px;
            color: #4A148C;
            font-size: 1em;
        }
        .apply-button {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            background-color: #6A1B9A;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }
        .apply-button:hover {
            background-color: #4A148C;
        }

        .footer {
            background-color: #f1e9fa;
            color: #6A1B9A;
            padding: 20px;
            text-align: center;
            margin-top: auto;
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
    <?php if($_SESSION["role"]=="company")
        echo"<a href='create_job.php' class='create-event-button'><i class='fa fa-plus'></i> Post Job</a>";
        ?>

        <div class="events-grid">

        <?php 
        $sql = $conn->prepare("SELECT * FROM jobs ORDER BY jobID DESC;");
        $sql->execute();
        $result = $sql->get_result();
        if ($result && mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_assoc($result)) {
                echo "<div class='event-card'><h3>".$record['job_owner_name']."</h3>";
                echo "<p><strong>Job Name:</strong>".$record['job_name']."</p>";
                echo "<p class='description'>".$record['job_description']."</p>";
                if($_SESSION["role"]!="company")
                echo "<a style='text-decoration: none;' href='mailto:".$record['email']."'><button class='apply-button'>Apply</button></a>";
                echo"</div>";
            }}

    ?>
    </div></div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>


</body>
</html>
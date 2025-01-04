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
    <title>Connections Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        .sub-container {
            width: 100%;
            background-color: #e8e0f8;
            padding-top: 10px; /* Add padding to account for the fixed header */
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-height: 300px; /* Adjusted height */
            overflow-y: auto; /* Enable scrolling */
            position: relative;
            display: grid; /* To contain the fixed header */
            grid-template-columns: repeat(2, 1fr); /* Two columns */
            grid-auto-rows: minmax(100px, auto);  /* Adjusted for better alignment */
            gap: 10px;
        }

        .profile {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    padding: 10px;
    background-color: #fdf8ff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    text-decoration: none;
    color: inherit;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.profile-content {
    display: flex;
    align-items: center;
}

.profile img {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    margin-right: 15px;
}

.profile .name {
    font-size: 1.2em;
    color: #6A1B9A;
}

.profile:hover {
    background-color: #e4e4e4;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.profile .actions {
    display: flex;
    gap: 10px;
}

.actions button {
    background-color: transparent;
    border: none;
    cursor: pointer;
    font-size: 1.6em;
    transition: color 0.3s ease;
}

/* Set accept button to green */
.actions .accept {
    color: green;
}

/* Set reject button to red */
.actions .reject {
    color: red;
}

/* Hover effect for buttons */
.actions button:hover {
    color: #9060cb;
}

/* Ensure buttons are styled correctly even if wrapped in an anchor tag */
.profile .actions a {
    text-decoration: none; /* Remove default underline from anchor tags */
}

/* Ensure the `a` tag inside .profile does not affect button styles */
.profile .actions a button {
    background-color: transparent;
    border: none;
    cursor: pointer;
    font-size: 1.6em;
    transition: color 0.3s ease;
}

.section-title {
    font-size: 1.5em;
    color: #4A148C;
    margin-bottom: 10px;
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
    <div class="section-title"><strong>Requests</strong></div>
    <div class="sub-container">

        <?php
           $sql = $conn->prepare("SELECT * FROM connections where receiverID=? and status=0 ORDER BY requestID DESC;");
            $sql->bind_param("s", $_SESSION["userID"]);
            $sql->execute();
            $result = $sql->get_result();

            if ($result && mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_assoc($result)) {

                    $sql2 = $conn->prepare("SELECT username FROM users where userID=?");
                    $sql2->bind_param("s", $record["senderID"]);
                    $sql2->execute();
                    $result2 = $sql2->get_result();
                    if ($result2 && mysqli_num_rows($result2) > 0) {
                        $record2 = mysqli_fetch_assoc($result2);

                        $sql3 = $conn->prepare("SELECT image_name FROM users_information where userID=? ");
                        $sql3->bind_param("s", $record["senderID"]);
                        $sql3->execute();
                        $result3 = $sql3->get_result();
                        if ($result3 && mysqli_num_rows($result3) > 0){ 
                            $record3 = mysqli_fetch_assoc($result3);
                            echo "<a href='profile.php?userID=".$record["senderID"]."' class='profile'>";
                            echo "<div class='profile-content'><img src='".$record3["image_name"]."' alt='Profile Picture'>";
                            echo "<div class='name'>".$record2["username"]."</div></div>";
                            echo "<div class='actions'>";
                            echo "<form action='acceptconnectionrequest.php' method='GET' style='display:inline;'>";
                            echo "<input type='hidden' name='requestID' value='".$record["requestID"]."'>";
                            echo "<button class='accept'><i class='fa fa-check' aria-hidden='true'></i></button></form>";
                            echo "<form action='rejectconnectionrequest.php' method='GET' style='display:inline;'>";
                            echo "<input type='hidden' name='requestID' value='".$record["requestID"]."'>";
                            echo "<button class='reject'><i class='fa fa-times' aria-hidden='true'></i></button></form>";
                            echo "</div></a>";
                            }
                    }
                
                }
            }else echo"<div style='color: white;'>  No Requests found. </div>";

        ?>
        
    </div>

    <div class="section-title"><strong>Sent Requests</strong></div>
    <div class="sub-container">
    <?php
           $sql = $conn->prepare("SELECT * FROM connections where senderID=? and status=0 ORDER BY requestID DESC;");
            $sql->bind_param("s", $_SESSION["userID"]);
            $sql->execute();
            $result = $sql->get_result();
            if ($result && mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_assoc($result)) {

                    $sql2 = $conn->prepare("SELECT username FROM users where userID=?");
                    $sql2->bind_param("s", $record["receiverID"]);
                    $sql2->execute();
                    $result2 = $sql2->get_result();
                    if ($result2 && mysqli_num_rows($result2) > 0) {
                        $record2 = mysqli_fetch_assoc($result2);
                        $sql3 = $conn->prepare("SELECT image_name FROM users_information where userID=? ");
                        $sql3->bind_param("s", $record["receiverID"]);
                        $sql3->execute();
                        $result3 = $sql3->get_result();
                        if ($result3 && mysqli_num_rows($result3) > 0){ 
                            $record3 = mysqli_fetch_assoc($result3);
                            echo "<a href='profile.php?userID=".$record["receiverID"]."' class='profile'>";
                            echo "<div class='profile-content'><img src='".$record3["image_name"]."' alt='Profile Picture'>";
                            echo "<div class='name'>".$record2["username"]."</div></div></a>";

                        }
                    }
                
                }
            }else echo"<div style='color: white;'>  No Requests found. </div>";

        ?>
    

    </div>




    <div class="section-title"><strong>My Connections</strong></div>
    <div class="sub-container">

    <?php
           $sql = $conn->prepare("SELECT * FROM connections where (senderID=? or receiverID=?) and status=1 ORDER BY requestID DESC;");
            $sql->bind_param("ss", $_SESSION["userID"],$_SESSION["userID"]);
            $sql->execute();
            $result = $sql->get_result();
            
            if ($result && mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_assoc($result)) {
                    if($record["receiverID"]==$_SESSION["userID"]){
                        $sql2 = $conn->prepare("SELECT username FROM users where userID=?");
                        $sql2->bind_param("s", $record["senderID"]);
                        $sql2->execute();
                        $result2 = $sql2->get_result();
                        if ($result2 && mysqli_num_rows($result2) > 0) {
                            $record2 = mysqli_fetch_assoc($result2);

                            $sql3 = $conn->prepare("SELECT image_name FROM users_information where userID=? ");
                            $sql3->bind_param("s", $record["senderID"]);
                            $sql3->execute();
                            $result3 = $sql3->get_result();
                            if ($result3 && mysqli_num_rows($result3) > 0){ 
                                $record3 = mysqli_fetch_assoc($result3);
                                echo "<a href='profile.php?userID=".$record["senderID"]."' class='profile'>";
                                echo "<div class='profile-content'><img src='".$record3["image_name"]."' alt='Profile Picture'>";
                                echo "<div class='name'>".$record2["username"]."</div></div></a>";

                            }
                        }
                    }else{
                        $sql2 = $conn->prepare("SELECT username FROM users where userID=?");
                        $sql2->bind_param("s", $record["receiverID"]);
                        $sql2->execute();
                        $result2 = $sql2->get_result();
                        if ($result2 && mysqli_num_rows($result2) > 0) {
                            $record2 = mysqli_fetch_assoc($result2);

                            $sql3 = $conn->prepare("SELECT image_name FROM users_information where userID=? ");
                            $sql3->bind_param("s", $record["receiverID"]);
                            $sql3->execute();
                            $result3 = $sql3->get_result();
                            if ($result3 && mysqli_num_rows($result3) > 0){ 
                                $record3 = mysqli_fetch_assoc($result3);
                                echo "<a href='profile.php?userID=".$record["receiverID"]."' class='profile'>";
                                echo "<div class='profile-content'><img src='".$record3["image_name"]."' alt='Profile Picture'>";
                                echo "<div class='name'>".$record2["username"]."</div></div></a>";

                            }
                        }


                    }
                }
            }else echo"<div style='color: white;'>  No Connections found. </div>";
            





            
        ?>
        

    </div>
</div>

</body>
</html>
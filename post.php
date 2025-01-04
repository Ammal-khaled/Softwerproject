<?php
session_start();
require_once "config.php";
if($_SESSION["verified"]==false ||$_SESSION["verified2"]==false)
{
    header("location: login.php");
    exit;
}

if(isset($_POST["message"])){
    $message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');
    
    $sql = $conn->prepare("INSERT INTO postcomments (postID, senderID ,message) VALUES (?,?,?)");
    $sql->bind_param("sss", $_SESSION["postID"], $_SESSION["userID"],$message);
    $sql->execute();   
    }
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post and Comments</title>
    <!-- Include FontAwesome CSS -->
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
            max-width: 800px;
            margin: 100px auto 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
        }
        .post {
            background-color: #e9d9fa; /* Slightly different post background color */
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border: 1px solid #c07de9; /* Border color to match theme */
        }
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .post-header img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .post-header .author {
            font-weight: bold;
            color: #6A1B9A; /* Maintain the same text color */
        }
        .post-header .date {
            font-size: 0.9em;
            color: #606770;
        }
        .post-content {
            font-size: 1em;
            color: #6A1B9A; /* Maintain the same text color */
            margin-top: 10px;
        }
        .post-image {
            margin-top: 15px;
            border-radius: 8px;
            max-width: 100%;
            height: auto;
        }
        .post-actions {
            margin-top: 10px;
            display: flex;
            justify-content: space-around;
            border-top: 1px solid #c07de9; /* Border color to match theme */
            padding-top: 10px;
            
        }
        .post-actions button {
            background-color: transparent;
            border: none;
            color: #6A1B9A; /* Button text color to match theme */
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            transition: color 0.2s ease-in-out;
            
        }
        .post-actions button i {
            margin-right: 5px;
        }
        .post-actions button:hover {
            color: #4A148C;
        }
        .post-actions button.liked {
            color: #d77af0; /* Brighter color when liked */
        }

        .comments-section {
            margin-top: 20px;
        }
        .comments-container {
            max-height: 300px;
            overflow-y: scroll;
            padding: 10px;
            background-color: #f1e9fa;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .comment {
            padding: 10px;
            background-color: #f9f7fb;
            border-radius: 8px;
            margin-bottom: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .comment .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }
        .comment .comment-header img {
            border-radius: 50%;
            width: 30px;
            height: 30px;
            margin-right: 8px;
        }
        .comment .comment-header .comment-author {
            font-weight: bold;
            color: #6A1B9A;
            font-size: 0.9em;
        }
        .comment .comment-header .comment-date {
            font-size: 0.8em;
            color: #606770;
            margin-left: 8px;
        }
        .comment .comment-content {
            margin-top: 5px;
            font-size: 0.9em;
            color: #606770;
        }
        .comment-form {
            margin-top: 20px;
        }
        .comment-form textarea {
            width: 97%;
            padding: 10px;
            border: 2px solid;
            border-radius: 4px;
            resize: vertical;
            min-height: 80px;
            margin-bottom: 10px;
            border: none;
            background-color: #efe7f8;
        }
        .comment-form textarea::placeholder {
            color: #4A148C;
            opacity: 1;
        }
        .comment-form button {
            background-color: #6A1B9A;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }
        .comment-form button:hover {
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

    <div class="container">
        <!-- Post Section -->
        <?php 
        if (isset($_GET["postID"]))
            $_SESSION["postID"]=$_GET["postID"];

        $sql = $conn->prepare("SELECT * FROM posts where postID =? ");
        $sql->bind_param("s",$_SESSION["postID"]);
        $sql->execute();
        $result = $sql->get_result();

        if ($result && mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_assoc($result)) {;
                $sql = $conn->prepare("SELECT image_name FROM users_information where userID=? ");
                $sql->bind_param("s",$record["post_owner_id"]);
                $sql->execute();
                $result2 = $sql->get_result();

                if ($result2 && mysqli_num_rows($result2) > 0) {
                    $record2 = mysqli_fetch_assoc($result2);
                    echo "<div class='post'><div class='post-header'><a href=profile.php?userID=".$record['post_owner_id']." style='text-decoration: none'; Color:'#6A1B9A';><img src='".$record2['image_name']."' alt='Profile Picture'></a>";
                    echo "<div><a href=profile.php?userID=".$record['post_owner_id']." style='text-decoration: none'; Color:'#6A1B9A';><div class='author'>".$record['post_owner_name']."</div></a></div></div>";
                    echo "<div class='post-content'>".$record['post_content']."</div>";
                    if (isset($record['image_name']))
                    echo "<img src='".$record['image_name']."'alt='Post Image' class='post-image'>";

                    echo "<div class='post-actions'>
                    <button onclick='toggleLike(this)'><i class='far fa-thumbs-up'></i> Like</button>
                    <button  class='active' onclick='scrollToComment()' ><i class='far fa-comment'></i> Comment</button>
                    <a href=chats.php style='text-decoration: none;'><button onclick='copyURL(".$record['postID'].")'><i class='fas fa-share'></i> Share</button></a></div></div>";
                }
            }
        }

    ?>

        <!-- Comments Section -->
        <div class="comments-section">
            <div class="comments-container">
            <?php 
                $sql = $conn->prepare("SELECT * FROM postcomments where postID =? ORDER BY msgID DESC;");
                $sql->bind_param("s",$_SESSION["postID"]);
                $sql->execute();
                $result = $sql->get_result();

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($record = mysqli_fetch_assoc($result)) {
                        $sql = $conn->prepare("SELECT image_name FROM users_information where userID=? ");
                        $sql->bind_param("s",$record["senderID"]);
                        $sql->execute();
                        $result2 = $sql->get_result();

                        if ($result2 && mysqli_num_rows($result2) > 0) {
                            $record2 = mysqli_fetch_assoc($result2);

                            $sql = $conn->prepare("SELECT username FROM users where userID=? ");
                            $sql->bind_param("s",$record["senderID"]);
                            $sql->execute();
                            $result3 = $sql->get_result();
                            if ($result3 && mysqli_num_rows($result3) > 0) {
                                $record3 = mysqli_fetch_assoc($result3);
                                echo "<div class='comment'><div class='comment-header'><img src=".$record2['image_name']." alt='Profile Picture'>";
                                echo "<div class='comment-author'>".$record3['username']."</div></div>";
                                echo "<div class='comment-content'>".$record['message']."</div></div>";
                            } 
                        }
                    }
                }

    ?> 
            </div>
                    
            <div class="comment-form">
                <form method="post" action="post.php">
                <textarea id="comment-textarea" name="message" placeholder="Add a comment..."></textarea>
                <button type="submit">Post Comment</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function scrollToComment() {
            document.getElementById('comment-textarea').scrollIntoView({ behavior: 'smooth' });
            document.getElementById('comment-textarea').focus();
        }

        function toggleLike(button) {        const icon = button.querySelector('i');
        if (icon.classList.contains('far')) {
            icon.classList.remove('far');
            icon.classList.add('fas');
            button.style.color = "#d77af0"; // Change button color to a brighter shade
        } else {
            icon.classList.remove('fas');
            icon.classList.add('far');
            button.style.color = "#6A1B9A"; // Revert to original color
        }
    }
</script>
<script>
        function copyURL(st) {
            const predefinedURL = "http://localhost/SoftwareProject/post.php?postID="+st;
            
            const textarea = document.createElement('textarea');
            textarea.value = predefinedURL;
            document.body.appendChild(textarea);
            
            textarea.select();
            document.execCommand('copy');
            
            document.body.removeChild(textarea);
            
            alert('URL copied to clipboard!');
        }
    </script>
</body>
</html>

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
    <title>Home Page</title>
    <!-- Include FontAwesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: "Familjen Grotesk", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1e9fa; /* Maintain the same background color */
            color: #6A1B9A; /* Maintain the same text color */
            display: flex;
            flex-direction: column;
            min-height: 100vh;

        }
      /* Improved header styling */
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



        .search-container {
            position: relative;
            display: flex;
            justify-content: center;
            width: 90%;
            max-width: 800px;
            margin: 10px auto;
        }
        .search-bar {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            background-color: #d9c8fb; /* Same header color */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .search-bar input[type="text"] {
            flex: 1;
            padding: 10px;
            font-size: 1em;
            border: 2px solid #c07de9; /* Border color to match theme */
            border-radius: 4px;
            outline: none;
            color: #6A1B9A;
            background-color: #f1e9fa; /* Match background color */
        }
        .search-bar button {
            margin-left: 10px;
            padding: 10px 15px;
            background-color: #6A1B9A;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            font-size: 1em;
            transition: background-color 0.2s ease-in-out;
        }
        .search-bar button:hover {
            background-color: #4A148C;
        }
        .search-results {
            position: absolute;
            top: 42px; /* Align the top of the search results with the bottom of the search bar */
            width: 100%;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 8px 8px;
            z-index: 1000;
            display: none; /* Initially hidden */
            
        }
        .search-results div {
            padding: 10px;
            cursor: pointer;
            border-bottom: 1px solid #eee;
            
        }
        .search-results div:last-child {
            border-bottom: none;
        }
        .search-results div:hover {
            background-color: #f1e9fa;
        }
        .container {
            width: 90%;
            max-width: 800px; /* Adjusted for a slightly larger container */
            margin: 10px auto;
            padding: 10px;
            background-color: white; /* Maintain the white background */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
            position: relative;
        }
        .floating-plus-icon {
            position: fixed;
            bottom: 30px;
            right: 180px; /* Aligns the button beside the container */
            background-color: #6A1B9A;
            padding: 15px;
            border-radius: 90%;
            color: white;
            font-size: 1.5em;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .floating-plus-icon:hover {
            background-color: #4A148C;
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
            margin: 5px 0px;
            max-width: 160px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.2s ease;
        }
        .create-event-button:hover {
            background-color: #4A148C;
        }
        .create-event-button i {
            margin-right: 5px;}
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

        .search-results{
            font-size: 1.2em;
            color: #4A148C;
            text-align: left;
            margin-top: 20px;
            display: block;
            
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



    <div class="search-container">
        <div class="search-bar">
        <form  method="post" acthion="home.php" >
            <input style="width:690px;" type="text" name="searchvalue"  placeholder="Search users..." aria-label="Search" >
            <button type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
        </div>
        <div class="search-results">        
            <?php
                if(isset($_POST["searchvalue"]) && strlen($_POST["searchvalue"])>1){
                
                $searchvalue='%'.$_POST["searchvalue"].'%';
                $sql = $conn->prepare("SELECT * FROM users WHERE username LIKE ?");
                $sql->bind_param("s", $searchvalue);
                $sql->execute();
                $result = $sql->get_result();
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($record = mysqli_fetch_assoc($result)) {
                        $user=$record["username"];
                        $role=$record["role"];
                        $userID=$record["userID"];
                        echo "<a href='profile.php?userID=".$userID."'style='text-decoration: none';><div> ".$user."</div></a>";
                    }
                }else echo "not found";
            }?>
        </div>
    </div>



<div class="container" id="posts-container">
<a href="create_posts.php" class="create-event-button">
        <i class="fa fa-plus"></i> Add post
    </a>

     <a href="create_posts.php" style="color: white;">
           <div href="create_posts.php" class="floating-plus-icon">
             <i class="fa fa-plus"></i>
        </div>
        </a>

<?php 
        $sql = $conn->prepare("SELECT * FROM posts ORDER BY postID DESC;");
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
                    <a href=post.php?postID=".$record['postID']." style='text-decoration: none;'><button type='submit'><i class='far fa-comment'></i> Comment</button></a>
                    <a href=chats.php?private style='text-decoration: none;'><button onclick='copyURL(".$record['postID'].")'><i class='fas fa-share'></i> Share</button></a></div></div>";
                }
            }
        }

    ?>
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
        <script>
function toggleLike(button) {
            button.classList.toggle('liked');
            const icon = button.querySelector('i');
            if (button.classList.contains('liked')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
            }
        }

    </script>
    

</body>
</html>
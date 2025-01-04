<?php
session_start();
require_once "config.php";
if($_SESSION["verified"]==false ||$_SESSION["verified2"]==false)
{
    header("location: login.php");
    exit;
}


if(isset($_GET["userID"])){
    $_SESSION["userID2"]=$_GET["userID"];
    $sql = $conn->prepare("SELECT * FROM users WHERE userID = ?");
    $sql->bind_param("s", $_GET["userID"]);
    $sql->execute();
    $result = $sql->get_result();
    if($result && mysqli_num_rows($result) > 0) {
        $record = mysqli_fetch_assoc($result);
        $_SESSION["username2"] = $record['username'];
        $email=$record["email"];
        $role=$record["role"];
    }
    
    $sql2 = $conn->prepare("SELECT * FROM users_information WHERE userID = ?");
    $sql2->bind_param("s", $_GET["userID"]);
    $sql2->execute();
    $result2 = $sql2->get_result();
    if($result2 && mysqli_num_rows($result2) > 0) {
        $record2 = mysqli_fetch_assoc($result2);
        $F_Name = $record2['F_name'];
        $L_Name = $record2['L_name'];
        $about = $record2['about'];
        $Phone_number = $record2['Phone_number'];
        $image_name = $record2['image_name'];
        $CV_name = $record2['CV_name'];
        $available=$record2['available'];
    }



}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: "Familjen Grotesk", sans-serif;
            background-color: #f1e9fa;
            color: #b657f1;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
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
            height: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 1;
        }
        .profile-header {
            background-color: #a83eea;
            color: white;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            display: flex;
            align-items: center;
        }
        .profile-header img {
            border-radius: 50%;
            margin-right: 20px;
        }
        .profile-header .details {
            flex: 1;
        }
        .profile-header .details h2 {
            margin: 0;
        }
        .profile-header .button {
            background-color: #a83eea;
            color: white;
            padding: 10px 20px;
            border: 2px solid white; /* Added border for better visibility */
            border-radius: 4px;
            cursor: pointer;
            border-style: groove;
            top: 30px;
        }
        .section .cv-button {
            float: right;
            background-color: #9728dc;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            position: relative;
            bottom: 45px;
            right: 20px;
            margin-bottom: 30px;
        }

        .section {
            margin-top: 10px;
        }
        .section h3 {
            border-bottom: 2px solid #c07de9;
            padding-bottom: 10px;
            
        }
        .section textarea {
            width: 98%;
            padding: 10px;
            border: 2px solid #c07de9;
            border-radius: 4px;
            resize: vertical;
            min-height: 100px;
        }
        .section textarea::placeholder{
            color:#dea9ff;



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
        .toggle-switch {
            margin-left: 20px;
            position: relative;
            display: inline-block;
            width: 190px;
            height: 34px;
            right: 10px;
        }
        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 10px;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 34px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #d9c8fb;
        }
        input:checked + .slider:before {
            transform: translateX(150px); /* Adjusted to fit new width */
        }
        .slider .slider-text {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 10px;
            right: 10px;
            text-align: center;
            color:rgb(186, 61, 61);
            font-weight: bold;
            font-size: 0.9em;
            text-transform: uppercase;
        }
        input + .slider .slider-text-off {
            display: block;
        }
        input:checked + .slider .slider-text-off {
            display: none;
            color: red;
        }
        input + .slider .slider-text-on {
            display: none;
        }
        input:checked + .slider .slider-text-on {
            display: block;
            color: rgb(49, 195, 49);
        }
        .connect-container {
            bottom: 1000px;
    display: inline-flex;
    align-items: center;
    margin-left: 20px; /* Space between the name and the button */
}

.button-wrapper {
    position: relative;
    display: inline-block; /* Keep the button and count together */
    bottom: 20px; /* Adjust the vertical position */
    left: 140px; /* Adjust the horizontal position */
    transform: translate(20, 10); /* You can also use this for fine-tuning */
}

.connect-button {
    background-color: #810dc9; /* Button background color */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 1em;
}

.connect-button:hover {
    background-color: #d9c8fb; /* Darker color on hover */
}

.connection-count {
    margin-left: 10px; /* Space between button and count */
    font-size: 1em;
    color: #ffffff;
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
        <div class="profile-header">
            <img src="<?php echo $image_name; ?>" alt="Profile Picture" width="80" height="80">
            <div class="details">
                <h2><?php echo $_SESSION["username2"]; ?></h2>
                <h2><?php echo $role; ?></h2>

                <div class="button-wrapper">

                    <?php 
                        $sql = $conn->prepare("SELECT * FROM connections where (senderID = ? or senderID = ?) and (receiverID = ? or receiverID = ?)");
                        $sql->bind_param("ssss", $_SESSION["userID"],$_GET["userID"],$_SESSION["userID"],$_GET["userID"]);
                        $sql->execute();
                        $result = $sql->get_result();
                        if (!($result && mysqli_num_rows($result) > 0)) {
                            if($_GET["userID"]!=$_SESSION["userID"] )
                                echo"<a href='connect.php?userID=" . $_SESSION['userID2']."'><button class='connect-button'>Connect</button></a>";
                        }

                    $sql = $conn->prepare("SELECT count(requestID) FROM connections where (senderID=? or receiverID=?) and status=1 ORDER BY requestID DESC;");
                    $sql->bind_param("ss", $_SESSION["userID2"],$_SESSION["userID2"]);
                    $sql->execute();
                    $result = $sql->get_result();
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        $record = mysqli_fetch_assoc($result);
                        echo"<span class='connection-count'>".$record['count(requestID)']." connections </span>";
                        
                    }
                    

                    ?>
                </div>


            </div>
            <?php if($_GET["userID"]==$_SESSION["userID"] && $_SESSION["role"]=="alumni"){

                        echo "<form action='available.php' method='POST'>
                        <label class='toggle-switch'>
                        <input type='checkbox' name='available' value='1' ";
                        echo $available==1 ? 'checked' : '' ;
                        echo" onchange='this.form.submit()'>
                            <span class='slider'><span class='slider-text slider-text-off'>Not Available</span>             
                            <span class='slider-text slider-text-on'>Available</span></span></label></form>";
                    }
        
            ?>

            
                
            
            <?php if($_SESSION["userID2"]==$_SESSION["userID"])
            echo "<a href=edit_profile.php?userID=".$_SESSION["userID2"]." ><button class='button'>Edit Profile</button></a>";
            else
            echo "<a href=private_chat.php?userID=".$_SESSION["userID2"]." ><button class='button'>Start Chatting</button></a>";
            ?>
        </div>
        <div class="section">
            <h3>Name</h3>
            <p>First Name: <?php echo $F_Name; ?></p>
            <p>Last Name: <?php echo $L_Name; ?></p>
        </div>
        <div class="section">
            <h3>About</h3>
            <p><?php echo $about; ?></p>
            <?php if(isset($CV_name))
            echo"<a href='" . $CV_name . "'  target='_blank'><button class='cv-button'>CV</button></a>";
            ?>
        </div>
        <div class="section">
            <h3>Email</h3>
            <p><?php echo $email; ?></p>
        </div>

        <div class="section">
            <h3>Phone Number</h3>
            <p><?php echo $Phone_number; ?></p>
        </div>        
        
        
        
        
        
        
        <div class="section">
            <h3>Posts</h3>
            <div class="container" id="posts-container">

<?php 
        $sql = $conn->prepare("SELECT * FROM posts where post_owner_id=? ORDER BY postID DESC;");
        $sql->bind_param("s",$_SESSION["userID2"]);
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
                </div>
                <br>
            </div>
        </div>
    </div>


 
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
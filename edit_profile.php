<?php
session_start();
require_once "config.php";
if($_SESSION["verified"]==false ||$_SESSION["verified2"]==false)
{
    header("location: login.php");
    exit;
}

if(isset($_POST["F_name"]) && isset($_POST["L_name"]) && isset($_POST["about"]) && isset($_POST["phone_number"]) && isset($_POST["email"])){
    $F_Name2 = $_POST["F_name"];
    $L_Name2 = $_POST["L_name"];
    $about2 = $_POST["about"];
    $phone_number2 = $_POST["phone_number"];
    $email2 = $_POST["email"];
    $escaped_F_Name2 = htmlspecialchars($F_Name2, ENT_QUOTES, 'UTF-8');
    $escaped_L_Name2 = htmlspecialchars($L_Name2, ENT_QUOTES, 'UTF-8');
    $escaped_about2 = htmlspecialchars($about2, ENT_QUOTES, 'UTF-8');
    $escaped_phone_number2 = htmlspecialchars($phone_number2, ENT_QUOTES, 'UTF-8');
    $escaped_email2 = htmlspecialchars($email2, ENT_QUOTES, 'UTF-8');
    $sql = $conn->prepare("UPDATE users SET email= ? WHERE userID = ?");
    $sql->bind_param("ss", $escaped_email2,$_SESSION["userID"]);
    $sql->execute();


    $sql = $conn->prepare("UPDATE users_information SET F_name= ?,L_name= ?,Phone_number= ?,about= ? WHERE userID = ?");
    $sql->bind_param("sssss", $escaped_F_Name2,$escaped_L_Name2,$escaped_phone_number2,$escaped_about2,$_SESSION["userID"]);
    $sql->execute();



}

if(isset($_POST['upload'])){
    $target_dir = "uploadsimage/";
    $target_file = $target_dir . basename($_FILES["image_name"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");    


    if (in_array($imageFileType, $allowed_extensions)){
        move_uploaded_file($_FILES["image_name"]["tmp_name"], $target_file);

        $sql = $conn->prepare("UPDATE users_information SET image_name= ? WHERE userID = ?");
        $sql->bind_param("ss",$target_file,$_SESSION["userID"]);
        if($sql->execute())
        $_SESSION["image_name"]=$target_file; 

    }
    
    

}

if(isset($_POST['upload'])){
    $target_dir = "uploadsCV/";
    $target_file = $target_dir . basename($_FILES["CV_name"]["name"]);

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_extensions = array("pdf", "docx");    

    
    if (in_array($imageFileType, $allowed_extensions)){
        move_uploaded_file($_FILES["CV_name"]["tmp_name"], $target_file);

        $sql = $conn->prepare("UPDATE users_information SET CV_name= ? WHERE userID = ?");
        $sql->bind_param("ss",$target_file,$_SESSION["userID"]);
        $sql->execute(); 

    }
        
    

}


$sql = $conn->prepare("SELECT * FROM users WHERE userID = ?");
$sql->bind_param("s", $_SESSION["userID"]);
$sql->execute();
$result = $sql->get_result();
if($result && mysqli_num_rows($result) > 0) {
    $record = mysqli_fetch_assoc($result);
    $email=$record["email"];
    $role=$record["role"];
}

$sql2 = $conn->prepare("SELECT * FROM users_information WHERE userID = ?");
$sql2->bind_param("s", $_SESSION["userID"]);
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
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
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
            margin: 20px auto;
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
        .form-group input {
            padding: 10px;
            border: 2px solid #6A1B9A;
            border-radius: 4px;
        }
        .form-group input::placeholder {
            color: #9C27B0; /* Placeholder color */
            opacity: 1; /* Ensures the color is fully opaque */
        }
        .form-group textarea {
            padding: 10px;
            border: 2px solid #6A1B9A;
            border-radius: 4px;
            resize: vertical;
        }
        .form-group input::placeholder {
            color: #9C27B0; /* Placeholder color */
            opacity: 1; /* Ensures the color is fully opaque */
        }
        .form-group .password-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .form-group .password-group .required {
            color: red;
            font-size: 0.9em;
            margin-left: 10px;
        }
        .form-group a {
            color: #6A1B9A;
            text-decoration: none;
            font-size: 0.9em;
            margin-top: 5px;
            align-self: flex-start;
        }
        .form-group a:hover {
            text-decoration: underline;
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
    <br><br><br>
    <form method="post" action="edit_profile.php" enctype="multipart/form-data">
    <div class="container">
        <div class="section">
            <h3>Personal info</h3>
            <div class="form-group">
                <label for="first-name">First name</label>
                <input type="text" name="F_name" id="first-name" placeholder="Enter your first name" value=<?php echo $F_Name;?>>
            </div>
            <div class="form-group">
                <label for="last-name">Last name</label>
                <input type="text" name="L_name" id="last-name" placeholder="Enter your last name" value=<?php echo $L_Name;?>>
            </div>
            <div class="form-group">
                <label for="about">About</label>
                <input type="text" name="about" id="about" placeholder="Enter your bio" value=<?php echo "'".$about."'";?>>
            </div>            
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone_number" value=<?php echo "'".$Phone_number."'";?> id="phone" placeholder="Enter your phone number">
            </div>
            <div class="form-group">
                <label for="image_name">image upload</label>
                <input type="file" name="image_name" id="image_name">
            </div>  
            <div class="form-group">
                <label for="CV">CV upload</label>
                <input type="file" name="CV_name" id="CV">
            </div>  
        </div>
        <div class="section">
            <h3>Login info</h3>
            <div class="form-group">
                <label for="email">Login email</label>
                <input type="email" name="email"id="email" placeholder="Enter your email" value=<?php echo $email;?>>
            </div>
        </div>
        <div class="button-group">
            <button type="submit" name="upload">Update Info</button>
        </div>
    </div>
    </form>




</body>
</html>


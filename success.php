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
    <title>Text and Photo Layout</title>
    <style>
        body {
            font-family: "Familjen Grotesk", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1e9fa; /* Your theme's background color */
            color: #6A1B9A; /* Your theme's text color */
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
            flex-wrap: wrap;
            padding: 20px;
            max-width: 1200px;
            margin: 20px auto;
            background-color: white; /* Container background */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .item {
            display: flex;
            width: 100%;
            margin-bottom: 20px;
            align-items: center;
            padding: 15px;
            background-color: #e9d9fa; /* Item background */
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .item img {
            max-width: 500px;
            margin-right: 20px;
            border-radius: 30px;
        }
        .item:nth-child(even) {
            flex-direction: row-reverse;
        }
        .item:nth-child(even) img {
            margin-right: 0;
            margin-left: 20px;
        }
        .item p {
            color: #6A1B9A; /* Text color */
            font-size: 1em;
        }
        @media (max-width: 600px) {
            .item {
                flex-direction: column;
                text-align: center;
            }
            .item img {
                margin-right: 0;
                margin-bottom: 10px;
                max-width: 100%; /* Ensure image fits smaller screens */
            }
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
    <div class="container">
        <div class="item">
            <img src="resources\mark.jpg" alt="Placeholder Image 1">
            <p>Mark Zuckerberg (Facebook):
                Mark Zuckerberg, a Harvard student, saw a need for a better way for people to connect online. He created Facebook in 2004, initially as a way for students to share information and stay connected.
                Facebook quickly gained traction, spreading from Harvard to other universities and then to the general public. Zuckerberg's vision for a platform that could connect people globally resonated with users.
                Zuckerberg focused on constantly enhancing Facebook's features, adding news feeds, groups, events, messaging, and more. He understood the need to keep the platform engaging and relevant.
                Strategic AcHe acquired Instagram and WhatsApp, two popular social media platforms, to broaden Facebook's reach and capabilities. This demonstrated his strategic thinking and ability to identify growth opportunities.</p>
        </div>
        <div class="item">
            <img src="resources\larry-page-and-sergey-brin.jpg" alt="Placeholder Image 2">
            <p>Larry Page and Sergey Brin (Google):
                Larry Page and Sergey Brin, Stanford PhD students, created a search engine called BackRub in 1996, which later became Google. They recognized the potential of a search engine that could deliver more relevant and accurate results.
                Google quickly gained popularity for its ability to deliver high-quality search results, thanks to its innovative PageRank algorithm, which assessed the importance of websites based on links.
                Page and Brin recognized the potential of Google beyond search. They expanded into other areas, including email (Gmail), maps (Google Maps), advertising (AdSense and AdWords), cloud computing (Google Cloud), and more.
                Google became a dominant force in the tech industry, revolutionizing how people access information, communicate, and conduct business online.</p>
        </div>
        <div class="item">
            <img src="resources\elon.jpg" alt="Placeholder Image 3">
            <p>Elon Musk (Tesla, SpaceX):
                Elon Musk is a South African-born entrepreneur known for his ambitious ventures in technology, space exploration, and sustainable energy.
                He's the founder, CEO, and Chief Engineer of SpaceX, CEO and Product Architect of Tesla, Inc., and founder of The Boring Company and Neuralink.
                Musk's success is driven by his visionary thinking, relentless pursuit of innovation, and willingness to take bold risks.
                He's revolutionized electric vehicles with Tesla, advanced space exploration with SpaceX, and is pushing the boundaries of technology with Neuralink and The Boring Company.</p>
        </div>
        <div class="item">
            <img src="resources\Ronaldo Mouchawar.jpg" alt="Placeholder Image 4">
            <p>Ronaldo Mouchawar (Souq.com):
                Ronaldo Mouchawar is a Lebanese entrepreneur who revolutionized e-commerce in the Middle East.
                He co-founded Souq.com in 2005, which quickly became the leading online marketplace in the region.
                Mouchawar's success is attributed to his visionary leadership, adaptability, focus on customer experience, and strategic partnerships.
                Souq.com's growth attracted significant investment and eventually led to its acquisition by Amazon in 2017 for $650 million.</p>
        </div>
        <div class="item">
            <img src="resources\Fadi Ghandour.jpg" alt="Placeholder Image 5">
            <p>Fadi Ghandour (Aramex):
                The Story: Ghandour founded Aramex, a leading global logistics and transportation company. 
                He recognized the potential for a reliable and efficient delivery service in the Middle East and beyond, building a company that revolutionized the industry.</p>
        </div>
    </div>
</body>
</html>
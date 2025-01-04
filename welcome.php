
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        body{
            margin: 0;
            padding: 0;
        }

        hr{
            margin: 0 !important;
            padding: 0 !important;
        }

        .nav{
            height: 50px;
            padding: 5px;
            margin-right: 20px;
            max-width: 100%;
        }

        .login a{
            text-decoration: none;
            color: black;
            float: right;
            padding: 10px;
        }

        .welcome{
            font-size: 20px;
            padding: 10px;
            margin-left: 20px;
            font-weight: bold;
            font-family: "Familjen Grotesk", sans-serif;
            color: rgb(151, 100, 246);

        }

        .sub-header{
            color: rgb(151, 100, 246);
            font-family: "Familjen Grotesk", sans-serif;
            margin: 3%;
            margin-left: 5%;
            margin-right: 5%;
        }
        .sub-header h1{
            font-size: 70px;
        }

        .header{
            height: 100vh;
            width: 100%;
        }

        .header img{
            height: auto;
            width: 100%;
            padding-top: 3%;
        }

        .yapping{
            margin-top: 2%;
            font-size: 15px;
        }

        .yapping p{
            padding: 0;
            margin: 0;
        }

        .join button{
            float: right;
            background-color: #d9edff;
            border-radius: 50px;
            height: 50px;
            color: rgb(151, 100, 246);
            border: 2px solid #008CBA;
        }

        .join button:hover{
            background-color: black;
            color: white;
            transition: .3s;
        }

        .one{
            height: 100vh;
            width: 100%;
            font-family: "Familjen Grotesk", sans-serif;
        }

        .sub-one{
            margin: 3%;
            margin-left: 5%;
            margin-right: 5%;
        }

        .sub-one h2{
            font-size: 50px;
            font-family: "Familjen Grotesk", sans-serif;
            color: rgb(151, 100, 246);
        }

        .sub-one hr{
            height: 5px !important;
            color: rgb(151, 100, 246);
            opacity: 1 !important;
        }

        .two{
            height: 100vh;
            width: 100%;
            font-family: "Familjen Grotesk", sans-serif;
        }

        .sub-two{
            margin: 3%;
            margin-left: 5%;
            margin-right: 5%;
        }

        .sub-two h3{
            font-size: 50px;
            font-family: "Familjen Grotesk", sans-serif;
            color: rgb(151, 100, 246);
        }

        .approach{
            margin-top: 2%;
            font-size: 25px;
            width: 60%;
            font-weight: bold;
            color: rgb(151, 100, 246);
        }

        .visual{
            width: 60%;
            float: right;
            margin-bottom: 1%;
        }

        .visual img{
            width: 80%;
        }

        .visual p{
            width: 80%;
            color: rgb(151, 100, 246);
            font-size: 15px;
        }


        </style>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Familjen+Grotesk:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <script src="https://kit.fontawesome.com/12810f9768.js" crossorigin="anonymous"></script>

        <title>Welcome</title>
    </head>
    <body style="background-color: #f0f8ff;">

        <div class="header">
            <nav class="nav">
                <div class = "col-1 welcome">
                    Kasit
                </div>
                <div class="col">

                </div>
                <div class="col-1 login">
                    <a href="login.php"> <i class="fa-solid fa-user fa-2x" style="height: 50px; width: 50px;"></i> </a>
                </div>
            </nav>
            <div class="sub-header">
                <h1>
                    Empower Learning
                </h1>
                
                <div>
                    <img src="resources/website.png" alt="">
                </div>
                <div class="yapping">
                    <p>Empowering students and alumni with personalized education through our platform.</p> Join us to embark on a journey of knowledge and growth.
                </div>
                <div class="join">
                    <form action="login.php" method="post">
                        <button>Join the team</button>
                    </form>
                </div>
            </div>
        
        </div>

        <div class="one">
            <div class="sub-one">
                <h2>Lastest Insights</h2>
                <hr>
            </div>
        </div>

        <div class="two">
            <div class="sub-two">
                <div class="approach">
                    <h3>Our Approach</h3>
                    <p>At KASIT, we tailor a unique learning path for each student based on their objectives, skills, and pace. Our licensed teachers provide top-notch education to students worldwide through online platforms, ensuring accessibility and quality.</p>
                </div>
                <div class="visual">
                    
                    <p>Our team of experienced educators and industry professionals are dedicated to providing a comprehensive learning experience. Whether you're a beginner or an advanced learner, our curriculum is designed to meet your needs and help you achieve your goals. Join us today and unlock a world of knowledge and opportunities.</p>
                    <img src="resources/visual.png" alt="">
                </div>
            </div>
        </div>

       


    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyStudyKPI</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="siteJavaScript.js"></script>
    <script>
        function redirectToaboutme() {
            // Redirect to the About Me page
            window.location.href = "aboutMeModule/aboutme.php";
        }

        function redirectTokpimodule() {
            // Redirect to the kpi module page
            window.location.href = "kpiIndicatorModule/kpimodule.php";
        }

        function redirectToactivitieslist() {
            // Redirect to the activities page
            window.location.href = "activitiesModule/activitieslist.php";
        }

        function redirectTochallenges() {
            // Redirect to the challenges page
            window.location.href = "challengeModule/challenges.php";
        }
    </script>
    <style>
        
        body {
            font-family: Arial, sans-serif;
        }
        .block {
            text-align: center;
            background-color: #D9DADB;
            color: black;
            width: 50%;
            transition: background-color 0.1s; color 0.1s;
            margin-top: 0;
        }
        .block:hover {
            background-color: #d4d4d4;
            color: white;
            cursor: pointer;
        }
        .block i {
            text-align: center;
            margin-left: 20px;
            margin-right: 20px;
            padding-top: 10px;
            font-size: 100px;
        }
        .block p {
            margin-left: 20px;
            margin-right: 20px;
            font-size: 18px;
            color: #494949;
            padding-bottom: 20px;
        }

        .block b{
            font-size: 25px;
            color:black;
        }

        .logout-align {
            float: right;
        }
        @media screen and (max-width: 720px) {  /* CSS when pages are resized to smaller or for mobile screen */
            .block {
                width: 75%;
            }
        }
    </style>
</head>
<body>
<div class="header">
    <img class="header" src="images/homeBanner.png">
        <h1 class="banner-text">Home</h1>
</div>

    
<nav class="topnav" id="myTopnav">
	<a href="index.php" class="active"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
	<a href="aboutMeModule/aboutme.php">About Me</a>
	<a href="kpiIndicatorModule/kpimodule.php">MyKPI Indicator Module</a>
	<a href="activitiesModule/activitieslist.php">Activities List</a>
    <a href="challengeModule/challenges.php">Challenges and Future Plans</a>
    <div class="logout-align">
    <a href="userAuthenticationModule/login.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
    </div>
	<a href="javascript:void(0);" class="icon" onclick="myFunction()">
	<i class="fa fa-bars"></i></a>
</nav>
    

    <main>
        <center>
        <!-- <?php
            if (isset($_SESSION["UID"])) {
                echo "
                    <h1>Welcome back, <u>".$_SESSION["student_name"]."</u></h1>
                ";
            }
            else {
                echo "
                    <h1>Welcome to the UMS FKI MyStudyKPI website</h1>
                ";
            }
        ?> -->
        <div class="block" onclick="redirectToaboutme()">
                <i class="fa fa-user" aria-hidden="true"></i>
                <p><b>About Me:</b> <br> Get a concise overview of your information in a portfolio webpage.</p>
        </div>
        <div class="block" onclick="redirectTokpimodule()">
            <i class="fa fa-bar-chart" aria-hidden="true"></i>
            <p><b>MyKPI Indicator Module:</b> <br> A tool designed to help manage Key Performance Indicators and to track academic or personal performance metrics.</p>
        </div>
        <div class="block" onclick="redirectToactivitieslist()">
            <i class="fa fa-list-alt" aria-hidden="true"></i>   
            <p><b>Activities List:</b> <br> View a compiled list of faculty-recognised activities, and stay up-to-date on past, ongoing and upcoming activities.</p>
        </div>
        <div class="block" onclick="redirectTochallenges()">
            <i class="fa fa-book" aria-hidden="true"></i>
            <p><b>Challenges and Future Plans:</b> <br> Write about challenges you've encountered, how you've tackled them, and your goals or aspirations for the future. </p>
        </div>
        <br>
        </center>
    </main>
    <footer>
        <h5>© Christopher Wong Sen Li | BI21110070 | KK34703 Individual Project</h5>
    </footer>
</body>
</html>
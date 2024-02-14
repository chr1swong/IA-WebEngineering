<?php
    session_start();
    include("../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> KPI Indicator | myStudyKPI </title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../siteJavaScript.js"></script>
    <script>
    function myFunction() {
	var x = document.getElementById("myTopnav");
  	    if (x.className === "topnav") {
    	    x.className += " responsive";
  	    } else {
    	    x.className = "topnav";
  	    }
    }
    function redirect(url) {
	window.location.href = url;
    }
    </script>

    <style>
        body {
    font-family: Arial, sans-serif;
    }

        .logout-align {
        float: right;
    }

        .align-content {
            text-align: left;
            margin: 20px;
            max-width: 600px; /* Adjust the maximum width as needed */
    }

        #editfield, #select {
            width: 30%;
            height: 30px;
    }

        /* Add the following style to match the header style */
        .header {
            text-align: center;
            background-color: #333;
            color: white;

    }

        /* Add the following style for the main content */
        main {
            margin: 20px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
    }

        /* Add the following style for form labels */
        label {
            font-weight: bold;
    }

        /* Add the following style for buttons */
        #btneditindicator {
            width: 15%;
            height: 30px;
            font-family: Arial, sans-serif;
            font-size: 18px;
            background-color: white;
            border: 1px solid grey;
            transition: background-color 0.1s, color 0.1s;
            margin-right: 10px; /* Add margin to separate buttons */
    }

        #btneditindicator:hover {
            cursor: pointer;
            background-color: #333333;
            color: white;
    }

        /* Add the following style for textareas */
        textarea {
            width: 100%;
            font-family: Arial, sans-serif;
            resize: none;
            display: block;
            font-size: 18px;
    }
    </style>
</head>
<body>
<div class="header">
    <img class="header" src="../images/myKPIBanner.png">
        <h1 class="banner-text">KPI Indicator</h1>
</div>

    
<nav class="topnav" id="myTopnav">
	<a href="../index.php">Home</a>
	<a href="../aboutMeModule/aboutme.php"><i class="fa fa-user" aria-hidden="true"></i> About Me </a>
	<a href="kpimodule.php" class="active"><i class="fa fa-bar-chart" aria-hidden="true"></i> MyKPI Indicator Module</a>
	<a href="../activitiesModule/activitieslist.php">Activities List</a>
    <a href="../challengeModule/challenges.php">Challenges and Future Plans</a>
    <div class="logout-align">
        <a href="../userAuthenticationModule/login.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
    </div>
	<a href="javascript:void(0);" class="icon" onclick="myFunction()">
	<i class="fa fa-bars"></i></a>
</nav>

<main>
        <h3 style="text-align: left">Edit KPI Indicator Record</h3>
        <?php
            if (isset($_GET["id"]) && $_GET["id"] != "") {
                $id = $_GET["id"];
                $fetchRecordQuery = "SELECT * FROM indicator WHERE indicatorID=".$id;
                $result = mysqli_query($conn, $fetchRecordQuery);
                $row = mysqli_fetch_assoc($result);

                // fetch the data to populate the form
                $indicatorID = $row["indicatorID"];
                $indicatorSem = $row["indicatorSem"];
                $indicatorYear = $row["indicatorYear"];
                $indicatorCGPA = $row["indicatorCGPA"];
                $indicatorLeadership = $row["indicatorLeadership"];
                $indicatorGraduateAim = $row["indicatorGraduateAim"];
                $indicatorProfCert = $row["indicatorProfCert"];
                $indicatorEmployability = $row["indicatorEmployability"];
                $indicatorMobProg = $row["indicatorMobProg"];

                mysqli_close($conn);
            }
        ?>
        <div id="editIndicatorRecord-container">
            <form id="editIndicatorRecord" action="kpimodule_edit_action.php" method="POST" enctype="multipart/form-data">
                <input name="indicatorID" type="text" value="<?=$indicatorID;?>" hidden>
                <input name="indicatorSem" type="text" value="<?=$indictorSem;?>" hidden>
                <input name="indicatorYear" type="text" value="<?=$indicatorYear;?>" hidden>
                
                
                <label for="indicatorCGPA">CGPA:</label>
                <br>
                <input id="editfield" name="indicatorCGPA" type="text" value="<?=$indicatorCGPA;?>"></input><br>
                <br>

                <label for="indicatorLeadership">Leadership:</label>
                <br>
                <select id="select" name="indicatorLeadership">
                    <option value="<?=$indicatorLeadership;?>" selected>Current: <?=$indicatorLeadership;?></option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select><br>
                <br>
                <label for="indicatorGraduateAim">Graduate Aim:</label>
                <br>
                <select id="select" name="indicatorGraduateAim">
                    <option value="<?=$indicatorGraduateAim;?>" selected>Current: <?=$indicatorGraduateAim;?></option>
                    <option value="On Time">On Time</option>
                    <option value="Delayed">Delayed</option>
                    <option value="Ahead of Schedule">Ahead of Schedule</option>
                </select><br>
                <br>
                <label for="indicatorProfCert">Professional Certification:</label>
                <br>
                <select id="select" name="indicatorProfCert">
                    <option value="<?=$indicatorProfCert;?>" selected>Current: <?=$indicatorProfCert;?></option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select><br>
                <br>

                <label for="indicatorEmployability">Employability(Months of Industrial Training):</label>
                <br>
                <select id="select" name="indicatorEmployability">
                    <option value="<?=$indicatorEmployability;?>" selected>Current: <?=$indicatorEmployability;?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select><br>
                <br>

                <label for="indicatorMobProg">Mobility Program:</label>
                <br>
                <select id="select" name="indicatorMobProg">
                    <option value="<?=$indicatorMobProg;?>" selected>Current: <?=$indicatorMobProg;?></option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select><br>
                <br>

                <div id="center-content" style="text-align: left">
                    <input id="btneditindicator" name="btnsubmit" type="submit" value="EDIT">
                    <input id="btneditindicator" name="btnreset" type="reset" value="RESET">
                    <input id="btneditindicator" name="btncancel" type="button" onClick="redirect('kpimodule.php');" value="CANCEL">
                    <br><br>
                </div>
            </form>
        </div>
    </main>

    <footer>
            <h5>© Christopher Wong Sen Li | BI21110070 | KK34703 Individual Project</h5>
    </footer>
</body>
</html>
<?php
    session_start();
    include("../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me | MyStudyKPI</title>
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
.logout-align {
            float: right;
        }

body {
    font-family: Arial, sans-serif;
    margin: 0; /* Remove default margin */
    padding: 0; /* Remove default padding */
}

/* Container for the main content */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Center-align the content within the container */
.center-align {
    text-align: center;
}

/* Style for the left column */
.left-column {
    float: left;
    width: 50%;
    text-align: center;
}

/* Style for the right column */
.right-column {
    float: right;
    width: 50%;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 5px;
}

/* Style for the profile picture */
.profile-picture {
    max-width: 100%;
    display: block;
    margin: 0 auto;
}

/* Personal Info Table */
#tblprofile {
    text-align: left;
    border: 1px solid black;
    margin: 0 auto;
    width: 40%;
}

/* Style for all rows in the personal info table */
#tblprofile tr {
    background-color: #DDDDDD; 
}

#tblprofile tr:hover {
    background-color: #a1aeb1;
}

#tblprofile th {
    text-align: center;
    background-color: #BAE1FF;
    color: black;
}

/* Study Motto Table */
#tblmotto {
    text-align: center;
    border: 1px solid black;
    margin: 0 auto;
    width: 100%;
}

#tblmotto tr:nth-child(odd) {
    background-color: #DDDDDD;
}

#tblmotto tr:hover {
    background-color: #C8B4BA;
}

/* Button Style */
.btn {
    height: 40px;
    background-color: white;
    border: 1px solid black;
    width: 25%;
    font-size: 16px;
    font-family: Jost, monospace;
    transition: background-color 0.1s, color 0.1s;
    cursor: pointer;
}

.btn:hover {
    background-color: #333333;
    color: white;
}

h4 {
    margin-bottom: 2px;
}
        
    </style>
</head>
<body>
<div class="header">
    <img class="header" src="../images/aboutMeBanner.png">
        <h1 class="banner-text">About Me</h1>
</div>

    
<nav class="topnav" id="myTopnav">
	<a href="../index.php">Home</a>
	<a href="aboutme.php" class="active"><i class="fa fa-user" aria-hidden="true"></i> About Me </a>
	<a href="../kpiIndicatorModule/kpimodule.php">MyKPI Indicator Module</a>
	<a href="../activitiesModule/activitieslist.php">Activities List</a>
    <a href="../challengeModule/challenges.php">Challenges and Future Plans</a>
    <div class="logout-align">
        <a href="../userAuthenticationModule/login.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
    </div>
	<a href="javascript:void(0);" class="icon" onclick="myFunction()">
	<i class="fa fa-bars"></i></a>
</nav>

<main style="flex: 1;">
        <?php
            if (isset($_SESSION["UID"])) {
                $accountID = $_SESSION["UID"];
                $fetchAccountQuery = "SELECT * FROM account WHERE accountID='".$accountID."' LIMIT 1";
                $fetchProfileQuery = "SELECT * FROM profile WHERE accountID='".$accountID."' LIMIT 1";

                $result = mysqli_query($conn, $fetchAccountQuery);
                $row = mysqli_fetch_assoc($result);

                // variables for the fetched ACCOUNT data
                $matricNumber = $row["matricNumber"];
                $accountEmail = $row["accountEmail"];

                $result = mysqli_query($conn, $fetchProfileQuery);
                $row = mysqli_fetch_assoc($result);

                // variables for the fetched PROFILE data
                $username = $row["username"];
                $program = $row["program"];
                $intakeBatch = $row["intakeBatch"];
                $phoneNumber = $row["phoneNumber"];
                $mentor = $row["mentor"];
                $motto = $row["motto"];
                $profileImagePath = $row["profileImagePath"];

                mysqli_close($conn);
            }
            else {
                echo "ERROR: ".mysqli_error($conn);
            }
        ?>
        <div>
            <div style="text-align: center;">
                <h4>Profile Picture</h4>
                <form id="image-container" style="max-width: 30%; margin: 0 auto; text-align: center;">
                    <tr>
                        <img src="<?=$profileImagePath;?>" style="width: 30%; display: block; margin: 0 auto;"></image>
                    </tr>
                </form>
            </div>
            <div>
                <?php  
                    // this block is to determine what to output for Program
                    $programOutput = '';
                    switch ($program) {
                        case "hc00": $programOutput = "UH6481001 Software Engineering"; break;
                        case "hc05": $programOutput = "UH6481002 Network Engineering"; break;
                        case "hc13": $programOutput = "UH6481004 Business Computing"; break;
                        case "hc14": $programOutput = "UH6481005 Data Science"; break;
                        default: $programOutput = "";
                    }
                ?>
                <div id="personal-info-container"  style="text-align: center;">
                <table id='tblprofile' width='50%' style="margin: 0 auto;">
                    <caption><h4>Personal Info</h4></caption>
                        <tr>
                            <td><b>Name</b></td>
                            <td><?php echo ($username != '') ? $username : "No data"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Matric Number</b></td>
                            <td><?=$matricNumber;?></td>
                        </tr>
                        
                        <tr>
                            <td><b>Program</b></td>
                            <td><?php echo ($programOutput != '') ? $programOutput : "No data"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Email</b></td>
                            <td><?=$accountEmail;?></td>
                        </tr>
                        <tr>
                            <td><b>Intake Batch</b></td>
                            <td><?php echo ($intakeBatch != 0) ? $intakeBatch : "No data"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Phone Number</b></td>
                            <td><?php echo ($phoneNumber != '') ? $phoneNumber : "No data"; ?></td>
                        </tr>
                        <tr>
                            <td><b>Mentor</b></td>
                            <td><?php echo ($mentor != '') ? $mentor : "No data"; ?></td>
                        </tr>
                </table>
                <br>
                <div id="personal-info-container" style="text-align: center; ">
                <table id='tblprofile' width='30%' height='100px' style="margin: 0 auto;">
                    <caption><h4>Study Motto</h4></caption>
                    <tr>
                        <td style="text-align: left; vertical-align: top;"><?php echo ($motto != '') ? $motto : "No data"; ?></td>
                    </tr>
                </table>
                </div>
                <br>
                <div id="center-container" style="text-align: center; width: 100%;">
                    <div id="center-content" style="">
                        <input onclick="redirect('aboutme_edit_personal.php')" id="btneditpersonal" type="button" name="btneditpersonal" value="Edit Details">
                    </div>
                </div>
            </div>
        </div>
        
        <br>
        <br>
        <br>
        <br>
    </main>
    <footer>
            <h5>© Christopher Wong Sen Li | BI21110070 | KK34703 Individual Project</h5>
    </footer>
</body>
</html>
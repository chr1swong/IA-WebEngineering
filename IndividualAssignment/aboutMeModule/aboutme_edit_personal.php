<?php
    session_start();
    include("../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> About Me | myStudyKPI </title>
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
        max-width: 80%;
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
    #btnedit {
        width: 30%;
        height: 30px;
        font-family: Arial, sans-serif;
        font-size: 18px;
        background-color: white;
        border: 1px solid grey;
        transition: background-color 0.1s, color 0.1s;
        margin-right: 10px; /* Add margin to separate buttons */
    }

    #btnedit:hover {
        cursor: pointer;
        background-color: #333333;
        color: white;
    }

    /* Add the following style for textareas */
    textarea {
        width: 50%;
        font-family: Arial, sans-serif;
        resize: none;
        display: block;
        font-size: 18px;
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
	<a href="../activitiesModule/myActivities.php">Activities List</a>
    <a href="../challengeModule/challenges.php">Challenges and Future Plans</a>
    <div class="logout-align">
        <a href="../userAuthenticationModule/login.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
    </div>
	<a href="javascript:void(0);" class="icon" onclick="myFunction()">
	<i class="fa fa-bars"></i></a>
</nav>

<main>
    <div class="align-content">
        <h3 style>Edit Personal Info</h3>
        <?php
            // fetch the existing row data from the database
            if (isset($_SESSION["UID"])) {
                // do something
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
        <div id="editPersonalInfo-container">
            <form id="editPersonalInfo" action="../aboutMeModule/aboutme_edit_personal_action.php" method="POST" enctype="multipart/form-data">
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

                <label for="matricNumber">Matric Number:</label><br>
                <input id="editfield" name="matricNumber" type="text" value="<?=$matricNumber;?>" disabled><br>

                <br>

                <label for="accountEmail">Email:</label><br>
                <input id="editfield" name="accountEmail" type="text" value="<?=$accountEmail;?>" disabled><br>

                <br>    
                    
                <label for="username">Username:</label><br>
                <input id="editfield" name="username" type="text" value="<?=$username;?>"><br>

                <br>

                <label for="program">Program:</label><br>
                <select id="select" name="program">
                    <option value="<?=$program;?>" selected>Current Program: <?php echo ($program != '') ? $programOutput : "Not filled yet" ?></option>
                    <option value="hc00">UH6481001 Software Engineering</option>
                    <option value="hc05">UH6481002 Network Engineering</option>
                    <option value="hc13">UH6481004 Business Computing</option>
                    <option value="hc14">UH6481005 Data Science</option>
                </select><br>

                <br>    

                <label for="intakeBatch">Intake Batch:</label><br>
                <input id="editfield" name="intakeBatch" type="text" value=<?php echo ($intakeBatch != 0) ? $intakeBatch : ""; ?>><br>
                
                <br>

                <label for="phoneNumber">Phone Number:</label><br>
                <input id="editfield" name="phoneNumber" type="text" value="<?=$phoneNumber;?>"><br>

                <br>

                <label for="mentor">Mentor:</label><br>
                <input id="editfield" name="mentor" type="text" value="<?=$mentor;?>"><br>

                <br>

                <label for="motto">Motto:</label>
                <br>
                <textarea name="motto" rows="10" cols="80"><?=$motto?></textarea><br>

                <p>Upload new profile image here:</p>
                <input id="pfptoupload" type="file" name="pfpToUpload" accept=".jpg, .jpeg, .png"><br><br>
            </div>
                <center>
                    <input id="btnedit" name="editsubmit" type="submit" value="EDIT">
                    <input id="btnedit" name="editreset" type="reset" value="RESET">
                    <input id="btnedit" name="editcancel" type="button" onClick="redirect('../aboutMeModule/aboutme.php')" value="CANCEL">
                </center>
            </form>
        </div>
        <br>
    </main>

    <footer>
            <h5>© Christopher Wong Sen Li | BI21110070 | KK34703 Individual Project</h5>
    </footer>
</body>
</html>
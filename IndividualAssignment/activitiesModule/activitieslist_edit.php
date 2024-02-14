<?php
    session_start();
    include("../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Activities List | myStudyKPI </title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../siteJavaScript.js"></script>

<style>
    .logout-align {
        float: right;
    }

    body {
        font-family: Arial, sans-serif;
    }

    .align-content {
        text-align: left;
        margin: 20px;
        max-width: 80%;
    }

    main {
        margin: 20px;
        padding: 20px;
        background-color: #f5f5f5;
        border-radius: 5px;
    }

    #editActivityRecord-container {
        align: left;
    }

    #editActivityRecord {
        width: 100%;
        border-collapse: collapse;
    }

    #select {
        width: 30%;
        height: 30px;
    }

    textarea {
        width: 50%;
        font-family: Arial, sans-serif;
        resize: none;
        display: block;
        font-size: 18px;
    }

    #btneditactivity {
        width: 15%;
        height: 30px;
        font-family: Arial, sans-serif;
        font-size: 18px;
        background-color: white;
        border: 1px solid grey;
        transition: background-color 0.1s, color 0.1s;
        margin-right: 10px; /* Add margin to separate buttons */
    }
    
    #btneditactivity:hover {
        cursor: pointer;
        background-color: #333333;
        color: white;
    }

    #editActivityRecord textarea {
        width: 100%;
        font-family: Arial, sans-serif;
        resize: none;
        display: block;
        font-size: 18px;
    }

    @media screen and (max-width: 600px) {
        #editChallengeRecord-container {
            padding-left: 10%;
            padding-right: 10%;
        }
    }

</style>
</head>
<body>
<div class="header">
    <img class="header" src="../images/myActivitiesBanner.png">
        <h1 class="banner-text">Activities List</h1>
</div>
<nav class="topnav" id="myTopnav">
	<a href="../index.php">Home</a>
	<a href="../aboutMeModule/aboutMe.php">About Me</a>
	<a href="../kpiIndicatorModule/kpimodule.php">MyKPI Indicator Module</a>
	<a href="activitieslist.php" class="active"><i class="fa fa-list-alt" aria-hidden="true"></i> Activities List</a>
    <a href="../challengeModule/challenges.php">Challenges and Future Plans</a>
    <div class="logout-align">
        <a href="../userAuthenticationModule/login.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
    </div>
	<a href="javascript:void(0);" class="icon" onclick="myFunction()">
	<i class="fa fa-bars"></i></a>
</nav>
<main>
    <div class="align-content">
        <h3 style="text-align: left">Edit Activity Record</h3>
        <?php
            if (isset($_GET["id"]) && $_GET["id"] != "") {
                $id = $_GET["id"];
                $fetchRecordQuery = "SELECT * FROM activity WHERE activityID=".$id; /* maybe add another check using accountID? */
                $result = mysqli_query($conn, $fetchRecordQuery);
                $row = mysqli_fetch_assoc($result);

                // fetch the data to populate the form
                $activityID = $row["activityID"];
                $activitySem = $row["activitySem"];
                $activityYear = $row["activityYear"];
                $activityType = $row["activityType"];
                $activityLevel = $row["activityLevel"];
                $activityDetails = $row["activityDetails"];
                $activityRemarks = $row["activityRemarks"];

                // this block is to determine the output for activityType
                $typeOutput = '';
                switch($activityType) {
                    case "1": $typeOutput = "Activity"; break;
                    case "2": $typeOutput = "Club"; break;
                    case "3": $typeOutput = "Association"; break;
                    case "4": $typeOutput = "Competition"; break;
                    default: $typeOutput = "";
                }

                // this block is to determine the output for activityLevel
                $levelOutput = '';
                switch($row["activityLevel"]) {
                    case "1": $levelOutput = "Faculty"; break;
                    case "2": $levelOutput = "University"; break;
                    case "3": $levelOutput = "National"; break;
                    case "4": $levelOutput = "International"; break;
                    default: $levelOutput = "";
                }

                mysqli_close($conn);
            }
        ?>
        <div id="editActivityRecord-container">
            <form id="editActivityRecord" action="activitieslist_edit_action.php" method="POST" enctype="multipart/form-data">
                <input name="activityID" type="text" value="<?=$activityID;?>" hidden>
                
                <label for="activitySem"><b>Semester:</b></label>
                <br>
                <select id="select" name="activitySem">
                    <option value="<?=$activitySem;?>">Currently selected: <?=$activitySem;?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select><br>
                <br>

                <label for="activityYear"><b>Year:</b></label>
                <br>
                <select id="select" name="activityYear">
                    <option value="<?=$activityYear;?>">Currently selected: <?=$activityYear;?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select><br>
                <br>
                <label for="activityType"><b>Activity Type:</b></label>
                <br>
                <select id="select" name="activityType">
                    <option value="<?=$activityType;?>">Currently selected: <?=$typeOutput;?></option>
                    <option value="1">Activity</option>
                    <option value="2">Club</option>
                    <option value="3">Association</option>
                    <option value="4">Competition</option>
                </select><br>
                <br>
                <label for="activityLevel"><b>Activity Level:</b></label>
                <br>
                <select id="select" name="activityLevel">
                    <option value="<?=$activityLevel;?>">Currently selected: <?=$levelOutput;?></option>
                    <option value="1">Faculty</option>
                    <option value="2">University</option>
                    <option value="3">National</option>
                    <option value="4">International</option>
                </select><br>
                <br>
                <label for="activityDetails"><b>Details:</b></label>
                <br>
                <textarea name="activityDetails" rows="5" columns="50"><?=$activityDetails;?></textarea><br>
                <br>
                <label for="activityRemarks"><b>Remarks:</b></label>
                <br>
                <textarea name="activityRemarks" rows="5" columns="50"><?=$activityRemarks;?></textarea><br>
                
                <p>Upload new activity image here (max. 2MB):</p>
                <input id="activityImageToUpload" type="file" name="activityImageToUpload" accept=".jpg, .jpeg, .png"><br><br>
        </div>
                <div id="center-content" style="text-align: left">
                    <input id="btneditactivity" name="btnsubmit" type="submit" value="EDIT">
                    <input id="btneditactivity" name="btnreset" type="reset" value="RESET">
                    <input id="btneditactivity" name="btncancel" type="button" onClick="redirect('activitieslist.php');" value="CANCEL">
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
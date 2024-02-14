<?php
    session_start();
    include("../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> My Challenges | myStudyKPI</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../siteJavaScript.js"></script>

    <style>
        main {
            margin: 20px;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
        }   

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

        #select {
            width: 30%;
            height: 30px;
        }

        #editChallengeRecord-container {
            align: left;
        }
        #editChallengeRecord {
            width: 100%;
            border-collapse: collapse;
        }
        #btneditchallenge {
            width: 15%;
            height: 30px;
            font-size: 18px;
            background-color: white;
            border: 1px solid grey;
            transition: background-color 0.1s, color 0.1s;
        }
        #btneditchallenge:hover {
            cursor: pointer;
            background-color: #333333;
            color: white;
        }
        #editChallengeRecord textarea {
            height: 100px;
            width: 100%;
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
    <img class="header" src="../images/myChallengesBanner.png">
        <h1 class="banner-text">Challenges and Future Plans</h1>
</div>

<nav class="topnav" id="myTopnav">
	<a href="../index.php">Home</a>
	<a href="../aboutMeModule/aboutme.php">About Me</a>
	<a href="../kpiIndicatorModule/kpimodule.php">MyKPI Indicator Module</a>
	<a href="../activitiesModule/activitieslist.php">Activities List</a>
    <a href="challenges.php" class="active"><i class="fa fa-book" aria-hidden="true"></i> Challenges and Future Plans</a>
    <div class="logout-align">
        <a href="../userAuthenticationModule/login.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
    </div>
	<a href="javascript:void(0);" class="icon" onclick="myFunction()">
	<i class="fa fa-bars"></i></a>
</nav>
<main>
    <div class="align-content">
        <h3 style="text-align: left">Edit Challenge Record</h3>
        <?php
            if (isset($_GET["id"]) && $_GET["id"] != "") {
                $id = $_GET["id"];
                $fetchRecordQuery = "SELECT * FROM challenge WHERE challengeID=".$id;
                $result = mysqli_query($conn, $fetchRecordQuery);
                $row = mysqli_fetch_assoc($result);

                // fetch the data to populate the form
                $challengeID = $row["challengeID"];
                $challengeSem = $row["challengeSem"];
                $challengeYear = $row["challengeYear"];
                $challengeDetails = $row["challengeDetails"];
                $challengeFuturePlan = $row["challengeFuturePlan"];
                $challengeRemark = $row["challengeRemark"];

                mysqli_close($conn);
            }
        ?>
        <div id="editChallengeRecord-container">
            <form id="editChallengeRecord" action="action_scripts/challenge_edit_action.php" method="POST" enctype="multipart/form-data">
                <input name="challengeID" type="text" value="<?=$challengeID;?>" hidden>

                <label for="challengeSem"><b>Semester:</b></label>
                <br>
                <select id="select" name="challengeSem">
                    <option value="<?=$challengeSem;?>">Currently selected: <?=$challengeSem;?></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select><br>
                <br>

                <label for="challengeYear"><b>Year:</b></label>
                <br>
                <select id="select" name="challengeYear">
                    <option value="<?=$challengeYear;?>">Currently selected: <?=$challengeYear;?></option>
                    <option value="2021/2022">2021/2022</option>
                    <option value="2022/2023">2022/2023</option>
                    <option value="2023/2024">2023/2024</option>
                    <option value="2024/2025">2024/2025</option>
                </select><br>
                <br>
                <label for="challengeDetails"><b>Challenge Details:</b></label>
                <br>
                <textarea name="challengeDetails" rows="5" columns="50"><?=$challengeDetails;?></textarea><br>
                <br>

                <label for="challengeFuturePlan"><b>Future Plan:</b></label>
                <br>
                <textarea name="challengeFuturePlan" rows="5" columns="50"><?=$challengeFuturePlan;?></textarea><br>
                <br>

                <label for="challengeRemark"><b>Remarks:</b></label>
                <br>
                <textarea name="challengeRemark" rows="5" columns="50"><?=$challengeRemark;?></textarea><br>
                <br>

                <p>Upload new challenge image here (max. 2MB):</p>
                <input id="challengeImageToUpload" type="file" name="challengeImageToUpload" accept=".jpg, .jpeg, .png"><br><br>
        </div>
                <div id="center-content" style="text-align: left">
                    <input id="btneditchallenge" name="btnsubmit" type="submit" value="EDIT">
                    <input id="btneditchallenge" name="btnreset" type="reset" value="RESET">
                    <input id="btneditchallenge" name="btncancel" type="button" onClick="redirect('challenges.php');" value="CANCEL">
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
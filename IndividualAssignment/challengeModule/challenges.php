<?php
    session_start();
    include("../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> My Challenges | myStudyKPI </title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../siteJavaScript.js"></script>
    <script type="text/javascript">
        function createPath(target) {
            let scriptPath = "challenges_remove_action.php?id=";
            let overallPath = scriptPath.concat(target);
            return overallPath;
        }
        function confirmRemoval(target_id) {
            var promptConfirm = confirm("Are you sure you want to remove this record?");

            if (promptConfirm) {
                // if OK is clicked, redirect to challenge_remove_action with the target id
                var path = createPath(target_id);
                window.location.href = path;
            }
        }
    </script>
    <style>
        main {
            min-height: 90vh;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .logout-align {
            float: right;
        }

        #challengesTable-container {
            padding-left: 30px;
            padding-right: 30px;
        }
        #challengesTable {
            border: 1px solid black;
            width: 100%;
        }
        #challengesTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #45b6fe;
            color: #000000;
        }
        #challengesTable tr {
            transition: background-color 0.1s, color 0.1s;
        }
        #challengesTable tr:nth-child(odd) {
            background-color: #DDDDDD;
        }
        #challengesTable tr:hover {
            background-color: #a1aeb1;;
            font-weight: bold;
        }
        #challengeForm-container {
            padding-top: 10px;
            padding-left: 20%;
            padding-right: 20%;
            background-color: #D3D3D3;
        }
        #challengeForm #yearsem {
            height: 30px;
            width: 40%;
            display: block;
        }
        #challengeForm textarea {
            height: 100px;
            width: 100%;
            resize: none;
            display: block;
        }
        #btnchallenge {
            width: 30%;
            height: 30px;
            font-size: 18px;
            background-color: white;
            border: 1px solid grey;
            transition: background-color 0.1s, color 0.1s;
        }
        #btnchallenge:hover {
            cursor: pointer;
            background-color: #333333;
            color: white;
        }
        #challengesTable #edit, #remove, #image {
            text-decoration: none;
            color: black;
            transition: color 0.1s;
        }
        #challengesTable #edit:hover {
            cursor: pointer;
            color: #3BB143;
        }
        #challengesTable #remove:hover {
            cursor: pointer;
            color: #FF0000;
        }
        #challengesTable #image:hover {
            cursor: pointer;
            color: #1E90FF;
        }
        #btngeneric {
            height: 40px;
            background-color: white;
            border: 1px solid black;
            width: 25%;
            font-size: 16px;
            transition: background-color 0.1s, color 0.1s;
        }
        #btngeneric:hover {
            cursor: pointer;
            background-color: #333333;
            color: white;
        }

        @media screen and (max-width: 600px) {
            #challengeForm-container {
                padding-left: 10%;
                padding-right: 10%;
            }
            #challengeForm #yearsem {
                width: 50%;
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
        
        <?php
            if (isset($_SESSION["UID"])) {
                $accountID = $_SESSION["UID"];
                $fetchChallengesQuery = "SELECT * FROM challenge WHERE accountID='".$accountID."'";
                $challengesResult = mysqli_query($conn, $fetchChallengesQuery);
            }
        ?>
        
            <br>
            <table id="challengesTable">
                <?php
                    if (mysqli_num_rows($challengesResult) > 0) {
                        echo "
                            <tr>
                                <th>No.</th>
                                <th>Session</th>
                                <th>Challenge Details</th>
                                <th>Future Plan</th>
                                <th>Remarks</th>
                                <th>Image</th>
                                <th>&nbsp;</th>
                            </tr>
                        ";

                        $rowIndex = 1;

                        while ($row = mysqli_fetch_assoc($challengesResult)) {
                            $editID = $removeID = $imageID = $row["challengeID"];

                            echo "
                                <tr>
                                    <td>".$rowIndex."</td>
                                    <td>Sem ".$row["challengeSem"]." - ".$row["challengeYear"]."</td>
                                    <td>".$row["challengeDetails"]."</td>
                                    <td>".$row["challengeFuturePlan"]."</td>
                                    <td>".$row["challengeRemark"]."</td>
                            ";

                            if ($row["challengeImagePath"] != '') {
                                echo "
                                    <td style='text-align: center'>
                                        <a id='image' title='Open image' href='show_challenge_image.php?id=".$imageID."' target='blank'><i class='fa fa-image'></i></a>
                                    </td>
                                ";
                            }
                            else {
                                echo "<td>&nbsp;</td>";
                            }

                            echo "
                                <td style='text-align: center'>
                                    <a id='edit' title='Edit challenge' href='challenges_edit.php?id=".$editID."'><i class='fa fa-pencil-square-o'></i></a>
                                    <a id='remove' title='Remove challenge' onclick='confirmRemoval($removeID)'><i class='fa fa-trash-o'></i></a>
                                </td>
                            </tr>
                            ";

                            $rowIndex++;
                        }
                    }
                    else {  // if the query returns no rows
                        echo "
                            <tr>
                                <th>No.</th>
                                <th>Session</th>
                                <th>Challenge Details</th>
                                <th>Future Plan</th>
                                <th>Remarks</th>
                                <th>Image</th>
                            </tr>
                            <tr>
                                <td colspan='6'>No challenges have been added yet.</td>
                            </tr>
                        ";
                    }
                ?>
            </table>
        </div>
        <br>
        <div id="challengeForm-container">
            <form id="challengeForm" action="challenges_submit_action.php" method="POST" enctype="multipart/form-data">
                
                <label for="challengeSem">Semester (*)</label><br>
                <select id="yearsem" name="challengeSem" required>
                    <option value="" disabled selected>Select a Semester...</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select><br>

                <label for="challengeYear">Year (*)</label><br>
                <select id="yearsem" name="challengeYear" required>
                    <option value="" disabled selected>Select a Year...</option>
                    <option value="2021/2022">2021/2022</option>
                    <option value="2022/2023">2022/2023</option>
                    <option value="2023/2024">2023/2024</option>
                    <option value="2024/2025">2024/2025</option>
                </select><br>

                <label for="challengeDetails">Challenge Details (*)</label><br>
                <textarea name="challengeDetails" rows="5" columns="50" required></textarea><br>

                <label for="challengeFuturePlan">Future Plan (*)</label><br>
                <textarea name="challengeFuturePlan" rows="5" columns="50" required></textarea><br>

                <label for="challengeRemark">Remarks</label><br>
                <textarea name="challengeRemark" rows="5" columns="50" required></textarea><br>

                <p>Upload challenge image here (max. 2MB):</p>
                <input type="file" name="challengeImageToUpload" accept=".jpg, .jpeg, .png" style="width: 100%; display: block;"><br><br>

                <div id="center-content" style="text-align: center">
                    <input id="btnchallenge" name="btnsubmit" type="submit" value="Add">
                    <input id="btnchallenge" name="btnreset" type="reset" value="Reset"><br><br>
                </div>
            </form>
        </div>
    </main>
    <footer>
            <h5>© Christopher Wong Sen Li | BI21110070 | KK34703 Individual Project</h5>
    </footer>
</body>
</html>
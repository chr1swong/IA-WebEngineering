<?php
    include("../config.php");
?>

<!DOCTYPE HTML>

<html>

<head>
    <title>Registration Action | MyStudyKPI </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../sitejavascript.js"></script>
</head>

<body>
    <?php
        // STEP 1: Form data handling using mysqli_real_escape_string function to escape special characters for use in an SQL query
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $matricNumber = mysqli_real_escape_string($conn, $_POST["matricNumber"]);
            $accountEmail = mysqli_real_escape_string($conn, $_POST["accountEmail"]);
            $accountPassword = mysqli_real_escape_string($conn, $_POST["accountPassword"]);
            $confirmPassword = mysqli_real_escape_string($conn, $_POST["confirmPassword"]);

            // validation for matching student_password and confirm_password
            if ($accountPassword !== $confirmPassword) {
                echo "
                    <script>
                        popup('ERROR: Passwords do not match. Please try again.', '../userAuthenticationModule/register.php')
                    </script>
                ";
                die("Passwords do not match.");
            }

            // validation for whether matricsNumber already exists
            $idQuery = "SELECT * FROM account WHERE matricNumber='".$matricNumber."' LIMIT 1";
            $result = mysqli_query($conn, $idQuery);
            $insertFlag = 0;

            if (mysqli_num_rows($result) == 1) {    // a row is returned, so a row with this ID already exists
                echo "
                    <script>
                        popup('ERROR: A user with this Matric Number already exists. Please register using a new Matric Number.', '../userAuthenticationModule/register.php');
                    </script>
                ";
            }
            else {  // no row was returned, so this ID does not exist in the database yet
                $pwdHash = trim(password_hash($_POST["accountPassword"], PASSWORD_DEFAULT));
                $pushToDBQuery = "INSERT INTO account (matricNumber, accountEmail, accountPwd) VALUES
                ('$matricNumber', '$accountEmail', '$pwdHash');";
                if (mysqli_query($conn, $pushToDBQuery)) {    // if the connection to DB is successful,
                    echo "
            
                    <main>
                        <p style='font-size:24px; text-align: center;'>Registration successful!</p>
                        <p style='font-size:20px; text-align: center;'><a href='../userAuthenticationModule/login.php'>Back to login menu</a></p>
                    </main>
                    <footer style='position: fixed; bottom: 0;'>
                        <h5>© Christopher Wong Sen Li | BI21110070 | KK34703 Individual Project</h5>
                    </footer>
                    ";
                    $insertFlag = 1;
                }
                if ($insertFlag == 1) {
                    $lastInsertedID = mysqli_insert_id($conn);

                    $pushToProfileQuery = "INSERT INTO profile (username, program, intakeBatch, phoneNumber, mentor, motto, profileImagePath, accountID)
                    VALUES ('', '', '', '', '', '', '../uploads/profileImages/defaultProfile.png', '$lastInsertedID');";

                    if (mysqli_query($conn, $pushToProfileQuery)) {
                        // echo "New user profile created successfully."
                    }
                    else {
                        echo "ERROR: ".$pushToProfileQuery."<br>".mysqli_error($conn);
                    }

                    $pushToIndicatorQuery = "INSERT INTO indicator (indicatorSem, indicatorYear, indicatorCGPA, indicatorLeadership, indicatorGraduateAim, indicatorProfCert, indicatorEmployability, indicatorMobProg, accountID) VALUES 
                        (1, 1, 0.00, 0, 'On Time', 0, 1, 0, $lastInsertedID),
                        (2, 1, 0.00, 0, 'On Time', 0, 1, 0, $lastInsertedID),
                        (1, 2, 0.00, 0, 'On Time', 0, 1, 0, $lastInsertedID),
                        (2, 2, 0.00, 0, 'On Time', 0, 1, 0, $lastInsertedID),
                        (1, 3, 0.00, 0, 'On Time', 0, 1, 0, $lastInsertedID),
                        (2, 3, 0.00, 0, 'On Time', 0, 1, 0, $lastInsertedID),
                        (1, 4, 0.00, 0, 'On Time', 0, 1, 0, $lastInsertedID),
                        (2, 4, 0.00, 0, 'On Time', 0, 1, 0, $lastInsertedID);
                    ";

                    if (mysqli_query($conn, $pushToIndicatorQuery)) {
                        // indicator rows added successfully.
                    }
                    else {
                        echo "
                            <script>
                                popup(\"Oops. Something went wrong: ".mysqli_error($conn)."\", \"../aboutme_edit_personal.php\");
                            </script>
                        ";
                    }
                }
            }
        }

        mysqli_close($conn);
    ?>
</body>

</html>
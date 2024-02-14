<?php
    session_start();
    include("../config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Action</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../siteJavascript.js"></script>
</head>
<body>
    <?php
        $loginMatric = $_POST["loginMatric"];
        $loginPassword = $_POST["loginPassword"];

        $loginQuery = "SELECT * FROM account WHERE matricNumber='$loginMatric' LIMIT 1;";
        $result = mysqli_query($conn, $loginQuery);

        if (mysqli_num_rows($result) == 1) {    // a row with the same data is found
            // check password hash
            $row = mysqli_fetch_assoc($result);

            // verify matching passwords
            // why not (password_verify($loginPassword, $row["accountPwd"])) {}?
            if (password_verify($_POST["loginPassword"], $row["accountPwd"])) {
                echo "Login was successful.";
                // bind the current session to 
                $_SESSION["UID"] = $row["accountID"];
                $_SESSION["userName"] = $row["matricNumber"];
                // set log-in time
                $_SESSION["loginTime"] = time();
                header("location: ../index.php");
            }
            else {
                echo "
                    <script>
                        popup('Login error: Matric Number or Password are incorrect. Please try again.', '../login.php');
                    </script>
                ";
            }
        }
        else {
            echo "
                <script>
                    popup('Login error: User with Matric Number ".$loginMatric." does not exist. Please try again.', '../login.php');
                </script>
            ";
        }
        mysqli_close($conn);
    ?>
</body>
</html>

<footer>
            <h5>© Christopher Wong Sen Li | BI21110070 | KK34703 Individual Project</h5>
    </footer>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | MyStudyKPI</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../siteJavascript.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        main {
            font-size: 22px;
        }
        #fieldlogin{
            width: 250px;
            height: 40px;
            font-size: 18px;
            margin-bottom: 10px;
        }

        #btnlogin {
            width: 150px;
            height: 40px;
            font-size: 18px; 
        }
    </style>
</head>

<body>
<div class="header">
    <img class="header" src="../images/loginBanner.png">
        <h1 class="banner-text">My Study KPI Website</h1>
</div>

<nav class="topnav" id="myTopnav">
        <a href="userAuthenticationModule/login.php" class="active">Login</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
<main>
        <center>
            <h4>Login to view all your information</h4>
            <div id="logindiv">
                <form id="loginform" action="loginAction.php" method="post">
                    <input id="fieldlogin" name="loginMatric" type="text" placeholder="Matric Number" required></textarea><br>
                    <input id="fieldlogin" name="loginPassword" type="password" placeholder="Password" required><br>
                    <input id="btnlogin" name="loginSubmit" type="submit" value="LOGIN">
                    <input id="btnlogin" name="loginReset" type="reset" value="CLEAR"><br>
                </form>
            </div>

            <p>No account?
            <a href="register.php">Register here.</a>
            </p>
        </center>
    </main>
    <footer style="position: fixed; bottom: 0;">
        <h5>© Christopher Wong Sen Li | BI21110070 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>
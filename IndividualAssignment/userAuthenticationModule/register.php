<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | MyStudyKPI</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../siteJavascript.js"></script>

    <style>
        main {
            text-align: center;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .regMatric,
        .regPassword,
        #fieldreg {
            width: 250px;
            height: 40px; 
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        label {
        width: 200px;
        }

        #btnreg {
            width: 150px;
            height: 40px;
            font-size: 18px;
        }
    </style>
</head>

<body>
<script type="text/javascript">
        function checkMatric(matric) {
            let passFlag = 1;
            let errorMessage = "";
            
            // check: matric number follows constraint
            var pattern = /^B[A-Z]\d{8}$/;
            if (!pattern.test(matric)) {
                passFlag = 0;
                let error = "ERROR: Matric number does not follow required format.\n";
                errorMessage = errorMessage.concat(error);
            }
            
            return [passFlag, errorMessage];
        }

        function checkPassword(password) {
                let passFlag = 1;
                let errorMessage = "";

                // check: password length is 8 or more
                if (password.length < 8) {
                    passFlag = 0;
                    let error = "ERROR: Password is shorter than minimum required length.\n";
                    errorMessage = errorMessage.concat(error);
                }

                // check: password contains at least one number
                if (!/\d/.test(password)) {
                    passFlag = 0;
                    let error = "ERROR: Password requires at least one number.\n";
                    errorMessage = errorMessage.concat(error);
                }

                return [passFlag, errorMessage];
        }

        function doValidation(event) {
            event.preventDefault();	// prevent the form from submitting by default
            
            // get the string at regMatric then check it
            var accountMatricField = document.getElementById("regMatric");
            var matric = accountMatricField.value;
            var matricResult = checkMatric(matric);
            let mFlag = matricResult[0];
            let mMessage = matricResult[1];
            
            // get the string at regPassword then check it
            var accountPasswordField = document.getElementById("regPassword");
            var password = accountPasswordField.value;
            var passwordResult = checkPassword(password);
            let pFlag = passwordResult[0];
            let pMessage = passwordResult[1];
            
            if (!(pFlag && mFlag)) {
                let errorMessage = mMessage.concat(pMessage);
                popup(errorMessage, "register.php");
            }
            else {
                document.getElementById("regform").submit();
            }
        }
    </script>

    <div class="header">
        <img class="header" src="../images/loginBanner.png">
            <h1 class="banner-text">My Study KPI Website</h1>
    </div>

    <nav class="topnav" id="myTopnav">
        <a href="../userAuthenticationModule/login.php" class="active">Login</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>

<main>
        
        <h1>Registration</h1>
        <h4>Required fields are marked with (*)</h4>
        <div id="regformdiv">
            <form id="regform" onsubmit="doValidation(event);" action="registerAction.php" method="post">
                <label for="matricNumber">Matric Number(*)</label><br>
                <input class="regMatric" id="regMatric" name="matricNumber" type="text" required placeholder="BXXXXXXXXX">
                <br>
                <br>
                <label for="accountEmail">E-mail Address(*)</label><br>
                <input id="fieldreg" name="accountEmail" type="email" required placeholder="user@email.com"><br>
                <br>
                
                <label for="accountPassword">Password (*)</label><br>
                <input class="regPassword" id="regPassword" name="accountPassword" type="password" required placeholder="Create Password">
                <br>
                <br>
                <label for="confirmPassword">Confirm Password (*)</label><br>
                <input id="fieldreg" name="confirmPassword" type="password" required placeholder="Confirm your Password"><br> 
                <br>
                <div>
                    <input id="btnreg" name="signupsubmit" type="submit" value="REGISTER">
                    <input id="btnreg" name="signupreset" type="reset" value="CLEAR">
                </div>
                <br><br>
            </form>
        </div>
        
    </main>
    <footer style="position: fixed; bottom: 0;">
        <h5>© Christopher Wong Sen Li | BI21110070 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>
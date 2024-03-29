<?php
    session_start();
    include("../config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Edit Confirmation</title>
    <script src="../siteJavaScript.js"></script>

    <script>
    function popup(message, target) {
	let text = message;
	alert(text);
	redirect(target);
    }
    </script>
</head>

<body>
    <div>
    <?php
        // commit to the database the data from the editable fields ONLY
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $target = $_SESSION["UID"];
            $newUsername = mysqli_real_escape_string($conn, $_POST["username"]);
            $newProgram = mysqli_real_escape_string($conn, $_POST["program"]);
            $newIntakeBatch = mysqli_real_escape_string($conn, $_POST["intakeBatch"]);
            $newPhoneNumber = mysqli_real_escape_string($conn, $_POST["phoneNumber"]);
            $newMentor = mysqli_real_escape_string($conn, $_POST["mentor"]);
            $newMotto = mysqli_real_escape_string($conn, $_POST["motto"]);

            // for image upload
            $pfpUploadFlag = 0;

            // IF THERE IS NO NEW IMAGE
            if (isset($_FILES["pfpToUpload"]) && $_FILES["pfpToUpload"]["name"] == "") {
                $pushToDBQuery = "
                    UPDATE profile
                    SET username = '$newUsername', program = '$newProgram', intakeBatch = '$newIntakeBatch',
                    phoneNumber = '$newPhoneNumber', mentor = '$newMentor', motto = '$newMotto'
                    WHERE accountID = '$target';
                ";

                if (mysqli_query($conn, $pushToDBQuery)) {
                    echo "
                        <script>
                            popup(\"Personal info updated successfully.\", \"aboutme.php\");
                        </script>
                    ";
                }
                else {
                    echo "
                        <script>
                            popup(\"Oops. Something went wrong: ".mysqli_error($conn)."\", \"aboutme_edit_personal.php\");
                        </script>
                    ";
                }

                mysqli_close($conn);
            }
            else if (isset($_FILES["pfpToUpload"]) && $_FILES["pfpToUpload"]["error"] == UPLOAD_ERR_OK) {
                $pfpUploadFlag = 1;
                $targetDirectory = "uploads/profileImages/";
                $targetFile = '';
                $filetmp = $_FILES["pfpToUpload"];
                $pfpFileName = $filetmp["name"];

                $targetFile = "../".$targetDirectory.$target."_".basename($_FILES["pfpToUpload"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // check: if file already exists
                if (file_exists($targetFile)) {
                    echo "
                        <script>
                            popup(\"ERROR-1: File already exists.\", \"..\aboutme_edit_personal.php\");
                        </script>
                    ";
                    $pfpUploadFlag = 0;
                }
                // check: if file size <= 2MiB or 2097152 bytes
                if ($_FILES["pfpToUpload"]["size"] > 2097152) {
                    echo "
                        <script>
                            popup(\"ERROR-2: File size exceeds allowed limit.\", \"../aboutMeModule/aboutme_edit_personal.php\");
                        </script>
                    ";
                    $pfpUploadFlag = 0;
                }
                // check: if file follows file format constraints
                if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png") {
                    echo "
                        <script>
                            popup(\"ERROR-3: File does not follow file type constraints.\", \"../aboutMeModule/aboutme_edit_personal.php\");
                        </script>
                    ";
                    $pfpUploadFlag = 0;
                }

                if ($pfpUploadFlag) {
                    // first, unlink the current image
                    $imgPathSeekQuery = "SELECT * FROM profile WHERE accountID='$target'";
                    $return = mysqli_query($conn, $imgPathSeekQuery);
                    $row = mysqli_fetch_assoc($return);
                    $imgToDelete = "../".$row["profileImagePath"];
                    if ($imgToDelete != "") {
                        unlink($imgToDelete);
                    }

                    // push the updated data to the DB first
                    $imgName = $target."_".$pfpFileName;
                    $fullPath = $targetDirectory.$imgName;
                    $pushToDBQuery = "
                        UPDATE profile
                        SET username = '$newUsername', program = '$newProgram', intakeBatch = '$newIntakeBatch',
                        phoneNumber = '$newPhoneNumber', mentor = '$newMentor', motto = '$newMotto',
                        profileImagePath = '$fullPath'
                        WHERE accountID = '$target';
                    ";

                    if (mysqli_query($conn, $pushToDBQuery)) {
                        // then, move a copy of the image to uploads/profile_images
                        if (move_uploaded_file($_FILES["pfpToUpload"]["tmp_name"], $targetFile)) {
                            echo "
                                <script>
                                    popup(\"Personal info updated successfully.\", \"../aboutMeModule/aboutme.php\"); 
                                </script>
                            ";
                        }
                        else {
                            echo "
                                <script>
                                    popup(\"Oops. Something went wrong: ".mysqli_error($conn)."\", \"../aboutMeModule/aboutme_edit_personal.php\");
                                </script>
                            ";
                        }
                    }
                    else {
                        echo "
                            <script>
                                popup(\"Oops. Something went wrong: ".mysqli_error($conn)."\", \"../aboutMeModule/aboutme_edit_personal.php\");
                            </script>
                        ";
                    }

                    mysqli_close($conn);
                }
            }
        }
    ?>
</body>

</html>
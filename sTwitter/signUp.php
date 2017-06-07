<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="style.css" rel="stylesheet">
    <title>PHP</title>
</head>
<body>
<?php
include "navbar.php";
if (isset($_SESSION['userId']) != "") {
    header("index.php");
    exit;
}

$error = false;
$errMsg = "Er is iets fout gegaan";

if (isset($_POST["submit"])) {
    //ADD VALIDATE FORM
    require_once "inc_connect.php";
    $db_table = "stenden_users";

    $username = trim($_POST['username']);
    $username = strip_tags($username);
    $username = htmlspecialchars($username);

    $password = trim($_POST['password']);
    $password = strip_tags($password);
    $password = htmlspecialchars($password);


    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    if (empty($username)) {
        $error = true;
        $errMsg = "Geen gebruikersnaam opgegeven";
    } else if (strlen($username) < 3) {
        $error = true;
        $errMsg = "Wachtwoord moet minimaal 6 tekens zijn";
    } else if (!preg_match("/^[a-zA-Z ]+$/", $username)) {
        $error = true;
        $errMsg = "Alleen alfabetische tekens toegestaan";
    }

    if (empty($password)) {
        $error = true;
        $errMsg = "Geen wachtwoord opgegeven";
    } else if (strlen($password) < 6) {
        $error = true;
        $errMsg = "Wachtwoord moet minimaal 7 tekens zijn";
    }

    if (empty($email)) {
        $error = true;
        $errMsg = "Geen email opgegeven";
    } else if (strlen($email) < 4) {
        $error = true;
        $errMsg = "Wachtwoord moet minimaal 5 tekens zijn";
    }

    $passhash = password_hash($password, PASSWORD_BCRYPT);


    if (!$error) {
        $target_dir = "avatars";
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if ($check !== false) {
           // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
//        if (file_exists($target_file)) {
//            echo "Sorry, file already exists.";
//            $uploadOk = 0;
//        }

        // Check file size
        if ($_FILES["avatar"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        $fileCount = count(glob('avatars/*'));
        $newName = $target_dir . '/' . ($fileCount + 1) . '.' . $imageFileType;
        $dataName = ($fileCount + 1) . '.' . $imageFileType;

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $newName)) {
                //echo "$newName The file " . basename($_FILES["avatar"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }


        $query = "INSERT INTO $db_table VALUES (NULL, '$username', '$passhash', '$email', '$dataName')";
        $res = mysqli_query($DBConnect, $query);
        if ($res) {
            $errMSG = "Successfully registered, you may login now";
        } else {
            $errMSG = "Something went wrong, try again later...";
        }

        echo "<h2>User aangemaakt! U wordt automatisch naar de hoofdpagina gebracht</h2>";
        header('Refresh: 3; URL=index.php');
    } else {
        echo "<h2>$errMsg</h2>";
    }
} else {
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <p>Username: <input type="text" name="username" required minlength="4"></p>
        <p>Password: <input type="password" name="password" required minlength="7"></p>
        <p>Email: <input type="email" name="email" required minlength="5"></p>
        <!--	required bij avatar zetten wanneer klaar-->
        <p>Avatar: <input type="file" name="avatar" id="avatar" required></p>
        <p><input type="submit" name="submit"></p>
    </form>

    <?php
}
?>
</body>
</html>
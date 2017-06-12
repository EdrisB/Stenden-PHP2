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

$error = FALSE;
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

    if (empty($username)) {
        $error = true;
    }

    if (empty($password)) {
        $error = true;
    }
    if (!$error) {
        $query = "SELECT userId, userName, userPass FROM stenden_users WHERE userName='$username'";
        $res = mysqli_query($DBConnect, $query);
        $row = mysqli_fetch_array($res);
        $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

        if ($count == 1 && password_verify($password, $row['userPass'])) {
            $_SESSION['userId'] = $row['userId'];
            $_SESSION['userName'] = $row['userName'];
            echo "<h2>U bent ingelogd! U wordt automatisch naar de hoofdpagina gebracht</h2>";
            header('Refresh: 3; URL=index.php');
            exit;
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }mysqli_close($DBConnect);
    }
}
if (isset($errMSG)) {
    echo $errMSG;
}
?>
<div class="main">
<form action="" method="post" enctype="multipart/form-data">
    <p>Username: <input type="text" name="username" required minlength="4"></p>
    <p>Password: <input type="password" name="password" required minlength="7"></p>
    <p><input type="submit" name="submit"></p>
</form>
</div>


</body>
</html>
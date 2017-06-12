<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link href="style.css" rel="stylesheet">
    <title>PHP</title>
</head>
<body>
<?php
require_once "inc_connect.php";
include "navbar.php";
if (!isset($_SESSION['userId'])) {
    header("index.php");
    exit;
}

if (isset($_POST['submit'])){
	$message = trim($_POST['message']);
	$message = strip_tags($message);
	$message = htmlspecialchars($message);

    $query = "INSERT INTO stenden_messages VALUES ('NULL', '" . $_SESSION['userId'] . "', ' " . $message . "')";
    mysqli_query($DBConnect, $query);
    echo "<h2>Bedankt voor het bericht u wordt automatisch terug gebracht.</h2>";
    header('Refresh: 3; URL=index.php');
	mysqli_close($DBConnect);
    exit;
}
?>

<div class="main">
    <form action="" method="post" enctype="multipart/form-data">
        <p><textarea name="message" cols="60" rows="7" required maxlength="320" minlength="5"></textarea></p>
        <p><input type="submit" name="submit"></p>
    </form>
</div>
</body>
</html>
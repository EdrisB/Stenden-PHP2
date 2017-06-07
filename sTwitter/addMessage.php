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
    $query = "INSERT INTO stenden_messages VALUES ('NULL', '" . $_SESSION['userId'] . "', ' " . $_POST['message'] . "')";
    mysqli_query($DBConnect, $query);
    echo "<h2>Bedankt voor het bericht</h2>";
    header('Refresh: 3; URL=index.php');
}
?>

<div class="main">
    <form action="" method="post" enctype="multipart/form-data">
        <p><textarea name="message" cols="60" rows="7" required></textarea></p>
        <p><input type="submit" name="submit"></p>
    </form>
</div>
</body>
</html>
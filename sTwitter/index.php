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

$SQLstring = "SELECT `stenden_messages`.`message`, `stenden_users`.`userName`, `stenden_users`.`userImagePath`, `stenden_users`.`userId`
FROM `stenden_users`
LEFT JOIN `stenden_messages` ON `stenden_users`.`userId` = `stenden_messages`.`userId` 
ORDER BY `msgId` DESC";

$QueryResult = mysqli_query($DBConnect, $SQLstring);
if (mysqli_num_rows($QueryResult) == 0) {
    echo "<p>There are no entries in the database!</p>";
} else {
    ?>

    <div class="main">
        <?php
        while ($Row = mysqli_fetch_assoc($QueryResult)) {
            echo "<div class=\"messagebody\">
            <div class=\"avatar\">
                <img class=\"avatar\" src=\"avatars\/{$Row['userImagePath']}\" alt=\"avatar\">
            </div>
            <div class=\"username\">
                {$Row['userName']}
            </div>
            <div class=\"messagetext\">
                <span>{$Row['message']}</span>
            </div>
        </div>";
        }
        ?>

    </div>
    <?php
}
?>
</body>
</html>
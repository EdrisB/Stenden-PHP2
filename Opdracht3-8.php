<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>PHP</title>
</head>
<body>
<?php
	include "inc_connect.php";
	$db_table = "zodiacfeedback";

	$SQLstring = "SELECT * FROM $db_table WHERE public_message LIKE 'Y'";
	$QueryResult = mysqli_query($DBConnect, $SQLstring);
	if (mysqli_num_rows($QueryResult) == 0) {
		echo "<p>There are no entries in the database!</p>";
	} else {
		echo "<table width='100%' border='1'>";
		echo "<tr><th>Date</th><th>Time</th><th>Sender</th><th>Message</th></tr>";
		while ($Row = mysqli_fetch_assoc($QueryResult)) {
			echo "<tr><td>{$Row['message_date']}</td>";
			echo "<td>{$Row['message_time']}</td>";
			echo "<td>{$Row['sender']}</td>";
			echo "<td>{$Row['message']}</td></tr>";
		}
		echo "</table>";
	}
?>
</body>
</html>
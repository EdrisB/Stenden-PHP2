<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Sign Guest Book</title>
</head>
<body>
<?php
	if (empty($_POST['first_name']) || empty($_POST['last_name'])) {
		echo "<p>You must enter your first and last name! Click your browser's Back button to return to the Guest Book form.</p>";
	} else {
		$DBConnect = mysqli_connect("127.0.0.1", "root", "");
		if ($DBConnect === FALSE) {
			echo "<p>Unable to connect to the database server.</p>"
				. "<p>Error code " . mysqli_errno() . ": "
				. mysqli_error() . "</p>";
		} else {
			$DBName = "guestbook";
			if (!mysqli_select_db($DBConnect, $DBName)) {
				$SQLstring = "CREATE DATABASE $DBName";
				$QueryResult = mysqli_query($DBConnect,
					$SQLstring);
				if ($QueryResult === FALSE) {
					echo "<p>Unable to execute the query.</p>"
						. "<p>Error code "
						. mysqli_errno($DBConnect)
						. ": " . mysqli_error($DBConnect) . "</p>";
				} else {
					echo "<p>You are the first visitor!</p>";
				}
			}
			mysqli_select_db($DBConnect, $DBName);

			$TableName = "visitors";
			$SQLstring = "SHOW TABLES LIKE '$TableName'";
			$QueryResult = mysqli_query($DBConnect, $SQLstring);
			if (mysqli_num_rows($QueryResult) == 0) {
				$SQLstring = "CREATE TABLE $TableName(countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, last_name VARCHAR(40),first_name VARCHAR(40))";
				$QueryResult = mysqli_query($DBConnect, $SQLstring);
				if ($QueryResult === FALSE) {
					echo "<p>Unable to create the table.</p>"
						. "<p>Error code "
						. mysqli_errno($DBConnect)
						. ": " . mysqli_error($DBConnect) . "</p>";
				}
			}
			$LastName = stripslashes($_POST['last_name']);
			$FirstName = stripslashes($_POST['first_name']);
			$SQLstring2 = "INSERT INTO $TableName VALUES(NULL,'$LastName', '$FirstName')";
			$QueryResult2 = mysqli_query($DBConnect, $SQLstring2);
			if ($QueryResult2 === FALSE) {
				echo "<p>Unable to execute the query.</p>"
					. "<p>Error code " . mysqli_errno($DBConnect)
					. ": " . mysqli_error($DBConnect) . "</p>";
			} else {
				echo "<h1>Thank you for signing our guestbook!</h1>";
			}
			mysqli_close($DBConnect);
		}
	}
?>
</body>
</html>
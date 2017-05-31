<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>PHP</title>
</head>
<body>
<?php
	$public = "N";
	if (isset($_POST['submit'])) {
		if (empty($_POST['sender']) || empty($_POST['message'])){
			echo "Fill in all the fields";
		}
		else {
			include "inc_connect.php";
			$db_table = "zodiacfeedback";
			$date = date("Y-m-d");
			$time = date("H:i:s");
			$sender = $_POST['sender'];
			$message = $_POST['message'];
			if (isset($_POST['public'])){
				$public = $_POST['public'];
			}

			// INSERT INTO $TableName VALUES('DATE HIER', 'TIME HIER', '$_POST["sender"]', '$_POST["message"]', '$_POST["public"]')
			$query = "INSERT INTO $db_table VALUES ('$date', '$time', '$sender', '$message', '$public')";
			mysqli_query($DBConnect, $query);
			echo "<h2>Thanks for entering a message.</h2>";
		}
	}

?>
</body>
</html>
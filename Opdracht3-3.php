<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>PHP</title>
</head>
<body>
<h2>Have you tried turning it off and on again?</h2>
<?php
	$DBConnect = mysqli_connect("127.0.0.1", "root", "");
	if ($DBConnect === FALSE) {
		echo "<p>Unable to connect to the database server.</p>"
			. "<p>Error code " . mysqli_errno() . ": " . mysqli_error()
			. "</p>";
	} else {
		$DBName = "supportdb";
		if (!mysqli_select_db($DBConnect, $DBName)) {
			echo "<p>There are no problems at the moment!</p>";
		} else {
			$TableName = "problems";
			$SQLstring = "SELECT * FROM $TableName";
			$QueryResult = mysqli_query($DBConnect, $SQLstring);
			if (mysqli_num_rows($QueryResult) == 0) {
				echo "<p>There are no entries in the database!</p>";
			} else {
				echo "<table width='100%' border='1'>";
				echo "<tr><th>Product name</th><th>Type of hardware</th><th>Operating system</th><th>Frequency</th><th>Solution</th><th>Edit</th></tr>";
				while ($Row = mysqli_fetch_assoc($QueryResult)) {
					echo "<td>{$Row['name']}</td>";
					echo "<td>{$Row['hardware']}</td>";
					echo "<td>{$Row['os']}</td>";
					echo "<td>{$Row['frequency']}</td>";
					echo "<td>{$Row['solution']}</td>";
					echo "<td><form action='Opdracht3-3-Edit.php' method='post'><input type='hidden' name='problemid' value='{$Row['problemID']}'><input type='submit' name='edit' value='edit'></form></td></tr>";
				}
				echo "</table>";
			}
			mysqli_free_result($QueryResult);
		}
		mysqli_close($DBConnect);
	}
?>

<a href="Opdracht3-3-Add.php">Add</a>

</body>
</html>
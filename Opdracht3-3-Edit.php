<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>PHP</title>
</head>
<body>
<?php
	$DBConnect = mysqli_connect("127.0.0.1", "root", "");

	if (isset($_POST['edit'])) {
		echo "<h2>Have you tried turning it off and on again?</h2>";
		$problemID = $_POST['problemid'];
		if ($DBConnect === FALSE) {
			echo "<p>Unable to connect to the database server.</p>"
				. "<p>Error code " . mysqli_errno() . ": "
				. mysqli_error() . "</p>";
		} else {
			$DBName = "supportdb";
			mysqli_select_db($DBConnect, $DBName);

			$TableName = "problems";
			$SQLstring = "SELECT * FROM $TableName WHERE problemID = '$problemID'";
			$QueryResult = mysqli_query($DBConnect, $SQLstring);
			if (mysqli_num_rows($QueryResult) == 0) {
				echo "<p>Something went wrong :(</p>";
			} else {
				echo "<table width='100%' border='1'>";
				echo "<tr><th>Product name</th><th>Type of hardware</th><th>Operating system</th><th>Frequency</th><th>Solution</th><th>Edit</th></tr>";
				echo "<form action='Opdracht3-3-Edit.php' method='post'>";
				while ($Row = mysqli_fetch_assoc($QueryResult)) {
					echo "<td><input type='text' name='name' value='{$Row['name']}' required></td>";
					echo "<td><input type='text' name='hardware' value='{$Row['hardware']}' required></td>";
					echo "<td><input type='text' name='os' value='{$Row['os']}' required></td>";
					echo "<td><input type='number' min='1' name='frequency' value='{$Row['frequency']}' required></td>";
					echo "<td><textarea name='solution' cols='50' rows='4' required>{$Row['solution']}</textarea></td>";
					echo "<td><input type='submit' name='submit' value='submit'></td></tr>";
					echo "<input type='hidden' name='problemid' value='{$Row['problemID']}'>";
				}
				echo "</form>";
				echo "</table>";
			}
			mysqli_free_result($QueryResult);
		}
		mysqli_close($DBConnect);

	} elseif (isset($_POST['submit'])  && !empty($_POST['name']) && !empty($_POST['hardware']) && !empty($_POST['os']) && !empty($_POST['frequency']) && !empty($_POST['solution'])) {
		$problemID = $_POST['problemid'];

		$Name = stripslashes($_POST['name']);
		$Hardware = stripslashes($_POST['hardware']);
		$Os = stripslashes($_POST['os']);
		$Frequency = stripslashes($_POST['frequency']);
		$Solution = stripslashes($_POST['solution']);
		//$SQLstring2 = "UPDATE $TableName SET(NULL,'$Name', '$Hardware', '$Os', '$Frequency', '$Solution')";
		$DBName = "supportdb";
		mysqli_select_db($DBConnect, $DBName);
		$TableName = "problems";
		$SQLstring2 = "UPDATE $TableName SET name='$Name', hardware='$Hardware', os='$Os', frequency='$Frequency', solution='$Solution' WHERE ProblemID='$problemID'";
		$QueryResult2 = mysqli_query($DBConnect, $SQLstring2);
		if ($QueryResult2 === FALSE) {
			echo "<p>Unable to execute the query.</p>"
				. "<p>Error code " . mysqli_errno($DBConnect)
				. ": " . mysqli_error($DBConnect) . "</p>";
		} else {
			echo "<h1>Thank you for updating the problem!</h1>";
			echo "<a href='Opdracht3-3.php'>Return</a>";
		}
		mysqli_close($DBConnect);

	} else {
		echo "<h1>NO INPUT GO BACK</h1>";
	}
?>
</body>
</html>
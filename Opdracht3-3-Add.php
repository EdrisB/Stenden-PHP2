<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>PHP</title>
</head>
<body>
<?php
	$Name = $Hardware = $Os = $Frequency = $Solution = "";

	if (isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['hardware']) && !empty($_POST['os']) && !empty($_POST['frequency']) && !empty($_POST['solution'])) {
		$DBConnect = mysqli_connect("127.0.0.1", "root", "");
		if ($DBConnect === FALSE) {
			echo "<p>Unable to connect to the database server.</p>"
				. "<p>Error code " . mysqli_errno() . ": "
				. mysqli_error() . "</p>";
		} else {
			$DBName = "supportdb";
			if (!mysqli_select_db($DBConnect, $DBName)) {
				$SQLstring = "CREATE DATABASE $DBName";
				$QueryResult = mysqli_query($DBConnect,
					$SQLstring);
				if ($QueryResult === FALSE) {
					echo "<p>Unable to execute the query.</p>"
						. "<p>Error code "
						. mysqli_errno($DBConnect)
						. ": " . mysqli_error($DBConnect) . "</p>";
				}
			}
			mysqli_select_db($DBConnect, $DBName);

			$TableName = "problems";
			$SQLstring = "SHOW TABLES LIKE '$TableName'";
			$QueryResult = mysqli_query($DBConnect, $SQLstring);
			if (mysqli_num_rows($QueryResult) == 0) {
				$SQLstring = "CREATE TABLE $TableName(problemID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(40),hardware VARCHAR(40),os VARCHAR(40),frequency INT,solution VARCHAR(255))";
				$QueryResult = mysqli_query($DBConnect, $SQLstring);
				if ($QueryResult === FALSE) {
					echo "<p>Unable to create the table.</p>"
						. "<p>Error code "
						. mysqli_errno($DBConnect)
						. ": " . mysqli_error($DBConnect) . "</p>";
				}
			}
			$Name = stripslashes($_POST['name']);
			$Hardware = stripslashes($_POST['hardware']);
			$Os = stripslashes($_POST['os']);
			$Frequency = stripslashes($_POST['frequency']);
			$Solution = stripslashes($_POST['solution']);
			$SQLstring2 = "INSERT INTO $TableName VALUES(NULL,'$Name', '$Hardware', '$Os', '$Frequency', '$Solution')";
			$QueryResult2 = mysqli_query($DBConnect, $SQLstring2);
			if ($QueryResult2 === FALSE) {
				echo "<p>Unable to execute the query.</p>"
					. "<p>Error code " . mysqli_errno($DBConnect)
					. ": " . mysqli_error($DBConnect) . "</p>";
			} else {
				echo "<h1>Thank you for reporting the problem!</h1>";
				echo "<a href='Opdracht3-3.php'>Return</a>";
			}
			mysqli_close($DBConnect);
		}
	}else {
		?>
		<h2>Have you tried turning it off and on again?</h2>
		<form action="Opdracht3-3-Add.php" method="post">


			<table width='100%' border='1'>
				<tr>
					<th>Product name</th>
					<th>Type of hardware</th>
					<th>Operating system</th>
					<th>Frequency</th>
					<th>Solution</th>
				</tr>
				<tr>
					<td><input type="text" name="name" required></td>
					<td><input type="text" name="hardware" required></td>
					<td><input type="text" name="os" required></td>
					<td><input type="number" min="1" name="frequency" required></td>
					<td><textarea name="solution" rows="4" cols="50" required></textarea></td>
				</tr>
			</table>
			<input type="submit" name="submit" value="submit">
		</form>
		<?php
	}
?>
</body>
</html>
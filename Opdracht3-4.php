<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>PHP</title>
</head>
<style>
	td {
		width: 100px;
		text-align: center;
	}

	;
</style>
<body>
<?php
	$DBConnect = mysqli_connect("127.0.0.1", "root", "");
	if (isset($_POST['view'])) {
		if ($DBConnect === FALSE) {
			echo "<p>Unable to connect to the database server.</p>"
				. "<p>Error code " . mysqli_errno() . ": " . mysqli_error()
				. "</p>";
		} else {
			$DBName = "airlines";
			if (!mysqli_select_db($DBConnect, $DBName)) {
				echo "<p>There are no opinions!</p>";
			} else {
				$TableName = "opinions";
				$SQLstring = "SELECT * FROM $TableName";
				$QueryResult = mysqli_query($DBConnect, $SQLstring);
				if (mysqli_num_rows($QueryResult) == 0) {
					echo "<p>There are no entries in the database!</p>";
				} else {
					echo "<table width='100%' border='1'>";
					echo "<tr><th>Date</th><th>Time</th><th>Flight</th><th>Flight number</th><th>Airline</th><th>Op1</th><th>Op2</th><th>Op3</th><th>Op4</th><th>Op5</th></tr>";
					while ($Row = mysqli_fetch_assoc($QueryResult)) {
						echo "<tr>";
						echo "<td>{$Row['date']}</td>";
						echo "<td>{$Row['time']}</td>";
						echo "<td>{$Row['flight']}</td>";
						echo "<td>{$Row['fNumber']}</td>";
						echo "<td>{$Row['airline']}</td>";
						echo "<td>{$Row['op1']}</td>";
						echo "<td>{$Row['op2']}</td>";
						echo "<td>{$Row['op3']}</td>";
						echo "<td>{$Row['op4']}</td>";
						echo "<td>{$Row['op5']}</td>";
						echo "</tr>";
					}
					echo "</table>";
				}
				mysqli_free_result($QueryResult);
			}
			mysqli_close($DBConnect);
		}
	} elseif (isset($_POST['submit'])) {
		$fields = array('date', 'time', 'flight', 'fNumber', 'airline', 'op1', 'op2', 'op3', 'op4', 'op5');
		$error = false; //No errors yet
		foreach ($fields AS $fieldname) { //Loop trough each field
			if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
				echo 'Field ' . $fieldname . ' misses!<br />'; //Display error with field
				$error = true; //Yup there are errors
			}
		}
		if (!$error) {
			if ($DBConnect === FALSE) {
				echo "<p>Unable to connect to the database server.</p>"
					. "<p>Error code " . mysqli_errno() . ": "
					. mysqli_error() . "</p>";
			} else {
				$DBName = "airlines";
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

				$TableName = "opinions";
				$SQLstring = "SHOW TABLES LIKE '$TableName'";
				$QueryResult = mysqli_query($DBConnect, $SQLstring);
				if (mysqli_num_rows($QueryResult) == 0) {
					$SQLstring = "CREATE TABLE $TableName(opinionID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, date DATE, time TIME, flight VARCHAR(40), fNumber INT, airline VARCHAR(40), op1 VARCHAR(20), op2 VARCHAR(20), op3 VARCHAR(20), op4 VARCHAR(20), op5 VARCHAR(20))";
					$QueryResult = mysqli_query($DBConnect, $SQLstring);
					if ($QueryResult === FALSE) {
						echo "<p>Unable to create the table.</p>"
							. "<p>Error code "
							. mysqli_errno($DBConnect)
							. ": " . mysqli_error($DBConnect) . "</p>";
					}
				}
				$Date = stripslashes($_POST['date']);
				$Time = stripslashes($_POST['time']);
				$Flight = stripslashes($_POST['flight']);
				$FNumber = stripslashes($_POST['fNumber']);
				$Airline = stripslashes($_POST['airline']);
				$Op1 = stripslashes($_POST['op1']);
				$Op2 = stripslashes($_POST['op2']);
				$Op3 = stripslashes($_POST['op3']);
				$Op4 = stripslashes($_POST['op4']);
				$Op5 = stripslashes($_POST['op5']);
				$SQLstring2 = "INSERT INTO $TableName VALUES(NULL,'$Date', '$Time', '$Flight', '$FNumber', '$Airline', '$Op1', '$Op2', '$Op3', '$Op4', '$Op5')";
				$QueryResult2 = mysqli_query($DBConnect, $SQLstring2);
				if ($QueryResult2 === FALSE) {
					echo "<p>Unable to execute the query.</p>"
						. "<p>Error code " . mysqli_errno($DBConnect)
						. ": " . mysqli_error($DBConnect) . "</p>";
				} else {
					echo "<h1>Thank you for Giving your opinion!</h1>";
					echo "<a href='Opdracht3-4.php'>Return</a>";
				}
				mysqli_close($DBConnect);
			}
		}
		?>

		<?php
	} else {
		?>
		<h2>OPINIONS!</h2>
		<form action="Opdracht3-4.php" method="post">
			<p>Date: <input type="date" name="date"></p>
			<p>Time: <input type="time" name="time"></p>
			<p>Flight: <input type="text" name="flight"></p>
			<p>Flight number: <input type="number" name="fNumber"></p>
			<p>Airline: <input type="text" name="airline"></p>
			<p>Please give your opinion on the following</p>
			<table>
				<tr>
					<th></th>
					<th>No opinion</th>
					<th>Poor</th>
					<th>Fair</th>
					<th>Good</th>
					<th>Excellent</th>
				</tr>
				<tr>
					<th>Friendliness of customer staff</th>
					<td><input type="radio" name="op1" value="No opinion"></td>
					<td><input type="radio" name="op1" value="Poor"></td>
					<td><input type="radio" name="op1" value="Fair"></td>
					<td><input type="radio" name="op1" value="Good"></td>
					<td><input type="radio" name="op1" value="Excellent"></td>
				</tr>
				<tr></tr>
				<tr>
					<th>Space for luggage storage</th>
					<td><input type="radio" name="op2" value="No opinion"></td>
					<td><input type="radio" name="op2" value="Poor"></td>
					<td><input type="radio" name="op2" value="Fair"></td>
					<td><input type="radio" name="op2" value="Good"></td>
					<td><input type="radio" name="op2" value="Excellent"></td>
				</tr>
				<tr></tr>
				<tr>
					<th>Comfort of seating</th>
					<td><input type="radio" name="op3" value="No opinion"></td>
					<td><input type="radio" name="op3" value="Poor"></td>
					<td><input type="radio" name="op3" value="Fair"></td>
					<td><input type="radio" name="op3" value="Good"></td>
					<td><input type="radio" name="op3" value="Excellent"></td>
				</tr>
				<tr></tr>
				<tr>
					<th>Cleanliness of aircraft</th>
					<td><input type="radio" name="op4" value="No opinion"></td>
					<td><input type="radio" name="op4" value="Poor"></td>
					<td><input type="radio" name="op4" value="Fair"></td>
					<td><input type="radio" name="op4" value="Good"></td>
					<td><input type="radio" name="op4" value="Excellent"></td>
				</tr>
				<tr></tr>
				<tr>
					<th>Noise level of aircraft</th>
					<td><input type="radio" name="op5" value="No opinion"></td>
					<td><input type="radio" name="op5" value="Poor"></td>
					<td><input type="radio" name="op5" value="Fair"></td>
					<td><input type="radio" name="op5" value="Good"></td>
					<td><input type="radio" name="op5" value="Excellent"></td>
				</tr>
			</table>
			<p><input type="submit" name="submit" value="Submit opinion"></p>
			<p><input type="submit" name="view" value="View previous results"></p>
		</form>
		<?php
	}
?>

</body>
</html>
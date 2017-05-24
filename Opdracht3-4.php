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
	};
</style>
<body>
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
			<tr> </tr>
			<tr>
				<th>Space for luggage storage</th>
				<td><input type="radio" name="op2" value="No opinion"></td>
				<td><input type="radio" name="op2" value="Poor"></td>
				<td><input type="radio" name="op2" value="Fair"></td>
				<td><input type="radio" name="op2" value="Good"></td>
				<td><input type="radio" name="op2" value="Excellent"></td>
			</tr>
			<tr> </tr>
			<tr>
				<th>Comfort of seating</th>
				<td><input type="radio" name="op3" value="No opinion"></td>
				<td><input type="radio" name="op3" value="Poor"></td>
				<td><input type="radio" name="op3" value="Fair"></td>
				<td><input type="radio" name="op3" value="Good"></td>
				<td><input type="radio" name="op3" value="Excellent"></td>
			</tr>
				<tr> </tr>
			<tr>
				<th>Cleanliness of aircraft</th>
				<td><input type="radio" name="op4" value="No opinion"></td>
				<td><input type="radio" name="op4" value="Poor"></td>
				<td><input type="radio" name="op4" value="Fair"></td>
				<td><input type="radio" name="op4" value="Good"></td>
				<td><input type="radio" name="op4" value="Excellent"></td>
			</tr>
			<tr> </tr>
			<tr>
				<th>Noise level of aircraft</th>
				<td><input type="radio" name="op5" value="No opinion"></td>
				<td><input type="radio" name="op5" value="Poor"></td>
				<td><input type="radio" name="op5" value="Fair"></td>
				<td><input type="radio" name="op5" value="Good"></td>
				<td><input type="radio" name="op5" value="Excellent"></td>
			</tr>
		</table>
	<p><input type="submit" name="submit" value="submit"></p>
</form>
<?php

?>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>PHP</title>
</head>
<body>
<?php
	if (isset($_POST["submit"])){
		//ADD VALIDATE FORM
		include "inc_connect.php";
		$db_table = "stenden_users";
		$username = $_POST["username"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		// $avatar = $_POST["avatar"];
		$query = "INSERT INTO $db_table VALUES (NULL, '$username', '$password', '$email', '')";
		mysqli_query($DBConnect, $query);
		echo "<h2>Thanks for entering a message.</h2>";
	} else {
		?>

		<form action="signup.php" method="post">
			<p>Username: <input type="text" name="username" required></p>
			<p>Password: <input type="password" name="password" required></p>
			<p>Email: <input type="email" name="email" required></p>
			<!--	required bij avatar zetten wanneer klaar-->
			<p>Avatar: <input type="file" name="avatar"></p>
			<p><input type="submit" name="submit"></p>
		</form>

		<?php
	}
?>
</body>
</html>
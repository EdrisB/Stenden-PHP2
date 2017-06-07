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

		$target_dir = "avatars/";
		$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["avatar"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["avatar"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["avatar"]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}

		$query = "INSERT INTO $db_table VALUES (NULL, '$username', '$password', '$email', '')";
		mysqli_query($DBConnect, $query);
		echo "<h2>Thanks for entering a message.</h2>";
	} else {
		?>

		<form action="signup.php" method="post" enctype="multipart/form-data">
			<p>Username: <input type="text" name="username" required></p>
			<p>Password: <input type="password" name="password" required></p>
			<p>Email: <input type="email" name="email" required></p>
			<!--	required bij avatar zetten wanneer klaar-->
			<p>Avatar: <input type="file" name="avatar" id="avatar"></p>
			<p><input type="submit" name="submit"></p>
		</form>

		<?php
	}
?>
</body>
</html>
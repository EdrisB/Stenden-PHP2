<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title></title>
</head>
<body>
<h1>Song Organizer</h1>
<?php
	if (isset($_GET['action']))
	{
		if ((file_exists("SongOrganizer/songs.txt")) &&
			(filesize("SongOrganizer/songs.txt")!= 0))
		{
			$SongArray = file("SongOrganizer/songs.txt");
			switch ($_GET['action']) {
				case 'Remove Duplicates':
					$SongArray = array_unique($SongArray);
					$SongArray = array_values($SongArray);
					break;
				case 'Sort Ascending':
					sort($SongArray);
					break;
                case 'Sort Descending':
                    rsort($SongArray);
                    break;
				case 'Shuffle':
					shuffle($SongArray);
					break;
                case 'Remove First':
                    array_shift($SongArray);
                    break;
                case 'Remove Last':
                    array_pop($SongArray);
                    break;
			} // End of the switch statement
			if (count($SongArray)>0)
			{
				$NewSongs = implode($SongArray);
				$SongStore = fopen("SongOrganizer/songs.txt","wb");
				if ($SongStore === false)
				{
					echo "There was an error updating the song file\n";
				} else {
					fwrite($SongStore, $NewSongs);
					fclose($SongStore);
				}
			} else {
				unlink("SongOrganizer/songs.txt");
			}
		}
	}
	if (isset($_POST['submit']))
	{
	    //check for input
		if (!empty($_POST['SongName']) || !empty($_POST['SongArtist'])){
			$SongToAdd = stripslashes($_POST['SongName']) . "-" . stripslashes($_POST['SongArtist']) . "\n";
			$ExistingSongs = array();
			if (file_exists("SongOrganizer/songs.txt") &&
				filesize("SongOrganizer/songs.txt") > 0)
			{
				$ExistingSongs = file("SongOrganizer/songs.txt");
			}
			if (in_array($SongToAdd, $ExistingSongs))
			{
				echo "<p>The song you entered already exists!<br>\n";
				echo "Your song was not added to the list.</p>";
			}
			else {
				$SongFile = fopen("SongOrganizer/songs.txt", "ab");
				if ($SongFile === false)
				{
					echo "There was an error saving your message!\n";
				} else {
					fwrite($SongFile, $SongToAdd);
					fclose($SongFile);
					echo "Your song has been added to the list.\n";
				}
			}
		}else{
			echo "Fill in songname";
		}
	}
	if ((!file_exists("SongOrganizer/songs.txt")) ||
		(filesize("SongOrganizer/songs.txt") == 0))
	{
		echo "<p>There are no songs in the list.</p>\n";
	} else {
		$SongArray = file("SongOrganizer/songs.txt");
		echo "<table border=\"1\" width=\"50%\" style=\"background-color:lightgray\">\n";
		echo "<th>Song</th> ";
        echo "<th>Artist</th> ";
		foreach ($SongArray as $Song)
		{
		    $SongExplode = explode("-",$Song);
			echo "<tr>\n";
			    echo "<td>" . htmlentities($SongExplode[0]) ."</td>";
                echo "<td>" . htmlentities($SongExplode[1]) ."</td>";
			echo "</tr>\n";
		}
		echo "</table>\n";
	}
?>
<p>
	<a href="Opdracht1-3.php?action=Sort%20Ascending">
		Sort Songs A-Z</a><br>
    <a href="Opdracht1-3.php?action=Sort%20Descending">
        Sort Songs Z-A</a><br>
	<a href="Opdracht1-3.php?action=Remove%20Duplicates">
		Remove Duplicate Songs</a><br>
	<a href="Opdracht1-3.php?action=Shuffle">
		Randomize Song list</a><br>
    <a href="Opdracht1-3.php?action=Remove%20First">
        Delete First Song</a><br>
    <a href="Opdracht1-3.php?action=Remove%20Last">
        Delete Last Song</a><br>
</p>
<form action="Opdracht1-3.php" method="post">
	<p><b>Add a New Song</b></p>
	<p>Song Name: <input title="SongName" type="text" name="SongName"/></p>
	<p>
    <p>Song Artist: <input title="SongArtist" type="text" name="SongArtist"/></p>
    <p>
		<input type="submit" name="submit"
			   value="Add Song to List" />
		<input type="reset" name="reset"
			   value="Reset Song Name" />
	</p>
</form>
</body>
</html>
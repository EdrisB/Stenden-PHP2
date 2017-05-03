<!DOCTYPE html>
<html>
<head>
	<title>PHP</title>
</head>
<style>

	.zodiacs{
		width: 100px;
		float: left;
		height: 120px;
		text-align: center;
	}
</style>
<body>
<?php

	$zodiacs = array(
		"zodiac1.png"=>"Aquarius",
		"zodiac2.png"=>"Capricorn",
		"zodiac3.png"=>"Sagittarius",
		"zodiac4.png"=>"Scorpio",
		"zodiac5.png"=>"Libra",
		"zodiac6.png"=>"Virgo",
		"zodiac7.png"=>"Leo",
		"zodiac8.png"=>"Cancer",
		"zodiac9.png"=>"Gemini",
		"zodiac10.png"=>"Taurus",
		"zodiac11.png"=>"Aries",
		"zodiac12.png"=>"Pisces",
	);
?>

<?php
	foreach ($zodiacs as $key => $value) {
		echo "<div class=\"zodiacs\">";
		echo "<a href='zodiacs/$key'><img width='100px' src='zodiacs/$key' alt='$value'></a>";
		echo "$value";
		echo "</div>";
	}
?>



</body>
</html>
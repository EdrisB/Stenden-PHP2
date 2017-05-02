<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title></title>
</head>
<body>
<?php
	$boxes = array(
		"smallBox" => array (
			"length" => 12,
			"width" => 10,
			"depth" => 2.5
		),

		"middleBox" => array (
			"length" => 30,
			"width" => 20,
			"depth" => 4
		),

		"largeBox" => array (
			"length" => 60,
			"width" => 40,
			"depth" => 11.5
		)
	);
foreach ($boxes as $key => $value) {
    echo "<p>The volume of the $key is:";
    $boxVolume = 1;
    foreach ($boxes[$key] as $boxSize){
        $boxVolume *= $boxSize;
    }
    echo "$boxVolume</p>";
}
?>
</body>
</html>
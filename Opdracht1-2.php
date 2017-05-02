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

	echo "The volume of the smallBox is: " . $boxes['smallBox']['length'] * $boxes['smallBox']['width'] * $boxes['smallBox']['depth']. " </br>";
	echo "The volume of the middleBox is: " . $boxes['middleBox']['length'] * $boxes['middleBox']['width'] * $boxes['middleBox']['depth']. " </br>";
	echo "The volume of the largeBox is: " . $boxes['largeBox']['length'] * $boxes['largeBox']['width'] * $boxes['largeBox']['depth']. " </br>";

?>
</body>
</html>
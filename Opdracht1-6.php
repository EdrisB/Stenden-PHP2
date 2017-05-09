<!DOCTYPE html>
<html>
<head>
	<title>PHP</title>
</head>
<style>
	th{
		width: 100px;
		text-align: left;
	}
</style>
<body>
<?php
	$totalAll = 0;
	$total = array(
	0,0,0,0,0
	);
	$quantity = array(
		0,0,0,0,0
	);
	$Products = array(
		array("Forhoja","Kistje set van 4","14.95"),
		array("Lagis","Muismat","0.99"),
		array("Skribent","Boekensteun","3.99"),
		array("Moppe","Miniladekast","11.95"),
		array("Dokument","Pennekoker","1.99"),
	);

	if (isset($_POST['update'])) {
		foreach ($Products as $key => $Product) {
			$quantity[$key] = $_POST['quantity-' . $key . ''];
			$total[$key] = $_POST['quantity-' . $key . ''] * $Products[$key][2];
			$totalAll = array_sum($total);
			//echo($_POST['quantity-' . $key . '']);
		};
	}
	if (isset($_POST['submit'])) {


		$date = date("Y-m-d-h-i-s");
		$orderFile = fopen("OnlineOrders\\$date.txt", "w") or die("Unable to open file!");
		foreach ($Products as $key => $Product) {
			$quantity[$key] = $_POST['quantity-' . $key . ''];
			$total[$key] = $_POST['quantity-' . $key . ''] * $Products[$key][2];
			$totalAll = array_sum($total);
			$txt = "Name:$Product[0] - Price:$Product[2] - Quantity:$quantity[$key] - Total:$total[$key]\n";
			fwrite($orderFile, $txt);

		};
		$txt = "Grand Total:$totalAll";
		fwrite($orderFile, $txt);
		fclose($orderFile);
	}
?>
<h1>Order Form</h1>
<hr>
<form action="Opdracht1-6.php" method="post">
	<table>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th></th>
			<th>Price</th>
			<th></th>
			<th>Quantity</th>
			<th></th>
			<th>Total</th>
		</tr>

			<?php
			foreach ($Products as $key => $Product){
				echo "<tr><td>";
				echo "$Product[0]";
				echo "</td><td>";
				echo "$Product[1]";
				echo "</td><td></td><td>";
				echo "€$Product[2]";
				echo "</td><td>";
				echo "x";
				echo "</td><td>";
				echo "<input type='number' name='quantity-$key' value='$quantity[$key]'";
				echo "</td><td>";
				echo "=";
				echo "</td><td>";
				echo "€$total[$key]";
				echo "</td><td>";
				echo "</td></tr>";
			}
			?>
		<tr>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
			<td><hr></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
			<td><?php echo "€$totalAll" ?></p></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
			<td><input type="submit" name="update" value="update"></td>
		</tr>
		<tr>
			<td></td><td></td><td></td><td></td><td></td><td></td><td></td>
			<td><b><input type="submit" name="submit" value="submit"></b></td>
		</tr>
	</table>
</form>


</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
</head>
<body>
<form action="Opdracht1-4.php" method="post">
    <textarea name="zodiacs" rows="4" cols="50"></textarea>
    <p><input type="submit" name="submit" value="Zodiacify"/></p>
</form>
<?php
$zodiacCheck = array('Capricorn', 'Aquarius', 'Pisces', 'Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo', 'Libra', 'Scorpio', 'Sagittarius');
$zodiacCheck = array_map('strtolower', $zodiacCheck);
sort($zodiacCheck);
if (isset($_POST['submit']))
{
    $zodiacArray = explode(",",$_POST['zodiacs']);
    $zodiacArray = array_map('strtolower', $zodiacArray);
    sort($zodiacArray);
    if ($zodiacArray == $zodiacCheck) {
        echo "<ol>";
        foreach ($zodiacArray as $zodiacSorted) {
            $zodiacSorted = ucfirst($zodiacSorted);
            echo "<li>$zodiacSorted</li>";
        };
        echo "</ol>";
    }
    else{
        echo "Enter al zodiac signs plox";
    }
}
?>

<p>TESTTEKST: Aquarius,Pisces,Libra,Scorpio,Sagittarius,Capricorn,Aries,Taurus,Gemini,Cancer,Leo,Virgo</p>
</body>
</html>
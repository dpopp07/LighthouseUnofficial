<?php

require_once 'header.php';
require_once 'connect.php';

/*

This script selects data from the orders table based on the current
user and displays it to the screen so that the user can view their
previous orders.

*/

$user = $_SESSION["user"];
$htmlText = "";

$sql = "SELECT DISTINCT drinkName FROM Orders WHERE user='$user' AND confirmed=true";

if ($listOfOrders = $conn->query($sql))
{
	if ($listOfOrders->num_rows > 0)
	{
		$htmlText = $htmlText . "<div class='sessionMessage'> Drinks I've Ordered: </div class='sessionMessage'>";
		$htmlText = $htmlText . "<ul>";

		while ($uniqueOrder = $listOfOrders->fetch_assoc())
		{
			$drinkNamePrint = $uniqueOrder["drinkName"];
			$drinkName = addQuotes($drinkNamePrint);
			$sql = "SELECT COUNT(*) AS count FROM Orders WHERE user='$user' AND drinkName=$drinkName AND confirmed=true";
			if ($thisDrinkCount = $conn->query($sql))
			{
				$countValue = $thisDrinkCount->fetch_assoc();
				$htmlText = $htmlText . "<li>" . $drinkNamePrint . " (" . $countValue["count"] . ")</li>";
			}
			else
			{
				echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
			}
		}

		$htmlText = $htmlText . "</ul>";
	}
	else
	{
		$htmlText = $htmlText . "<div class='sessionMessage'> You have not ordered any drinks. See the menu to place your first! </div class='sessionMessage'>";
	}
}
else
{
	echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
}

echo $htmlText;


?>
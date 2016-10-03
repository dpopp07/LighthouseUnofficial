<?php
require_once 'header.php';

/***********************************************************************

This script populates the bartender page with orders from the database.

************************************************************************/


require_once 'connect.php';

$sql = "SELECT * FROM Orders WHERE confirmed=false";
$block = "";

if ($orderList = $conn->query($sql))
{
	if ($orderList->num_rows > 0)
	{
		while ($order = $orderList->fetch_assoc())
		{
			$drinkName = $order["drinkName"];
			$sql = "SELECT ingredients FROM Drinks WHERE drinkName='$drinkName'";
			if ($ingredRow = $conn->query($sql))
			{
				$ingredients = $ingredRow->fetch_assoc();
			}
			else
			{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$block = $block . "<div class='firstDrinkUp'>";
			$block = $block . "<p class='bartender'> Drink: " . addQuotes($drinkName) . " </p>";
			$block = $block . "<p class='bartender'> Customer: " . $order["user"] . " </p>";
			$block = $block . "<p class='bartender'>" . $ingredients["ingredients"] . "</p>";
			$block = $block . "<p class='bartender'> Order ID: " . $order["orderId"] . " </p>";
			$block = $block . "<input type='button' name='confirmOrder' value='Confirm' id='" . $order["orderId"] . "'>";
			$block = $block . "<input type='button' name='cancel' value='Cancel' id='" . $order["orderId"] . "'>";
			$block = $block . "</div>";
			// will block get too long? do strings have a character limit??
			// the limit is 2gb - this is probably fine
		}
	}
	else
	{
		// there are no orders in the queue
		$block = "<div class='sessionMessage'> There are no orders at this time. </div>";
	}

	echo $block;
}
else
{
	// add the sql error statement
	echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
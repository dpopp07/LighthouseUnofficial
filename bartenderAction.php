<?php
require_once 'header.php';

/***********************************************************************

This script processes the bartenders action on an order in the queue.
The order is either confirmed, or cancelled. If confirmed, the database
will be updated to record the confirmation. If cancelled, the order
will be removed from the database.

************************************************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$result = array();

	$action = $_POST["action"];
	$id = $_POST["orderId"];

	require_once 'connect.php';

	if (strcmp($action, "confirm") == 0)
	{
		// confirm the order
		
		// update orders table so that the order with this id has (confirmed = true)
		// update users table so that drinkCount increments by one

		$username = $_SESSION["user"];

		$sqlOrders = "UPDATE Orders SET confirmed=true WHERE orderId=$id";
		$sqlUsers = "UPDATE Users SET drinkCount = drinkCount + 1 WHERE name='$username'";

		if ($conn->query($sqlOrders) && $conn->query($sqlUsers)) // should these be separated?
		{
			$result["outcome"] = "Successfully updated two tables!";
		}
		else
		{
			$result["outcome"] = "Error: " . $conn->error;
		}
	}
	elseif (strcmp($action, "cancel") == 0)
	{
		// cancel the order

		// remove the row with this id from the orders database
		// decrement the session variable drink count by one, since we added one when order was placed

		$sql = "DELETE FROM Orders WHERE orderId=$id";

		if ($conn->query($sql))
		{
			$result["outcome"] = "Successfully removed from database."; // dont say database here, thats dumb
			$_SESSION["drinks"]--;
		}
		else
		{
			$result["outcome"] = "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	// else this form shouldnt have been called!

	echo json_encode($result);
}

?>
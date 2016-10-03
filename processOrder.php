<?php
require_once 'header.php';

/***********************************************************************

This script sends a drink order to the Orders database. It sends the
order as unconfirmed. The bartender will have to confirm the drink for
it to change to 'confirmed' and stay in the database. if the bartender
cancels the order, it will be removed from the database.

************************************************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$result = array();

	$drinkName  = addQuotes($_POST["drinkName"]);
	$user 		= addQuotes($_SESSION["user"]);

	// date: d for day, m for month, Y for year
	$date = addQuotes(date("Y\-m\-d"));

	require_once 'connect.php';

	$sql = "INSERT INTO Orders (drinkName, user, confirmed, dateOrdered) VALUES ($drinkName, $user, false, $date";

	if ($conn->query($sql))
	{
		// great it went in!
		$result["outcome"] = "Your order has successfully been placed!";
		$_SESSION["drinks"]++; // increase the session id so user sees the order was processed. 
	}//							  however, users database will not be updated until order is confirmed
	else
	{
		$result["outcome"] = "A problem occurred while trying to place your order. Please try again.";
	}

	echo json_encode($result);

}


?>
<?php
require_once 'header.php';

/*

This script selects data from the orders table based on the current
user and displays it to the screen so that the user can view their
previous orders.

*/

$user = addQuotes($_SESSION["user"]);

$result = array();
$html = "";

// ***
$message = ""; // delete this and only use $html once its figured out
// ***

require_once 'connect.php';

$sql = "SELECT drinkName, dateOrdered FROM Orders WHERE user=$user AND confirmed=true";

if ($orders = $conn->query($sql))
{
	if ($orders->num_rows > 0)
	{
		// print the orders in html format
	}
	else
	{
		$message = "You have not yet ordered any drinks.";
		// provide link to menu here???
	}
}
else
{
	$result["outcome"] = "Error: " . $sql . "<br>" . $conn->error . "<br>";
}


?>
<?php
require_once 'header.php';

/***********************************************************************

This script populates account request page with accounts that are
waiting to be approved.

************************************************************************/


require_once 'connect.php';

$sql = "SELECT * FROM Users WHERE approved=false";
$block = "";

if ($userList = $conn->query($sql))
{
	if ($userList->num_rows > 0)
	{
		while ($user = $userList->fetch_assoc())
		{
			$username = $user["name"];

			$block = $block . "<div class='firstDrinkUp'>"; // change the class (double on css if need be)!
			$block = $block . "<p class='bartender'>" . $username . "</p>";
			$block = $block . "<input type='button' name='approve' value='Approve' id='" . $username . "'>";
			$block = $block . "<input type='button' name='reject' value='Reject' id='" . $username . "'>";
			$block = $block . "</div>";
		}
	}
	else
	{
		// there are no users in the queue
		$block = "<div class='sessionMessage'> There are no pending requests at this time. </div>";
	}

	echo $block;
}
else
{
	// add the sql error statement
	echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
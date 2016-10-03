<?php
require_once 'header.php';

/***********************************************************************

This script processes the admin action on an account request. If the
admin approves the account, then the Users database is updated so that
the user can log in with that account. If rejected, the user is removed
from the database.

************************************************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$result = array();

	$action = $_POST["action"];
	$username = $_POST["username"];

	require_once 'connect.php';

	if (strcmp($action, "approve") == 0)
	{
		// approve the user
		// update orders table so that the user with this username has (approved = true)

		$sql = "UPDATE Users SET approved=true WHERE name='$username'";

		if ($conn->query($sql))
		{
			$result["outcome"] = "Successfully approved account for " . $username;
		}
		else
		{
			$result["outcome"] = "Error: " . $conn->error;
		}
	}
	elseif (strcmp($action, "reject") == 0)
	{
		// reject the account
		// remove this user from the database

		$sql = "DELETE FROM Users WHERE name='$username'";

		if ($conn->query($sql))
		{
			$result["outcome"] = "Successfully removed from database."; // dont say database here, thats dumb
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
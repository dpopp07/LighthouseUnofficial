<?php
require_once "header.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$username = "";
	$password = "";
	
	$loginSuccessful = false;

	$result = array();

	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$adminStatus = false;
	$drinkCount = 0;


	if (good_username($username) && good_password($password))
	{
		// these are clean and are potentially valid credentials

		require_once 'connect.php'; // this could possibly be a way to make the drink page one html file

		// check username
		$sql = "SELECT * FROM Users WHERE name='".$username."'"; // get any entries with this username
		if (! $existingData = $conn->query($sql))
		{
			// Error selecting data
		}
		else
		{
			if ($existingData->num_rows > 0) // username exists already, num rows should always equal 1 here
			{
				// get the password from this entry
				// continue w process
				$row = $existingData->fetch_assoc();
				$existingPass = $row["pass"];
				
				$approved = $row["approved"];

				if ($approved)
				{
					$password = sha1($password);

					if (strcmp($password, $existingPass) == 0)
					{
						$loginSuccessful = true;
						$adminStatus = boolval($row["admin"]);
						$drinkCount = intval($row["drinkCount"]);

						$_SESSION["loggedIn"] = true;
						$_SESSION["user"] = $username;
						$_SESSION["admin"] = $adminStatus;
						$_SESSION["drinks"] = $drinkCount;
					}
					// else the passwords do not match					
				}
				// else the account has not been approved yet, login fails
			}
			// else no user with that name exists
		}
	}
	// else, username or password couldnt exist anyways

	$result["success"] = $loginSuccessful;

	if ($loginSuccessful)
	{
		// make the result array
		$result["admin"] = $adminStatus;
		$result["drinks"] = $drinkCount;
		$result["username"] = $username;
	}
	else
	{
		$result["errors"] = "Either the username or password is incorrect, or this account has not been approved.";
	}

	// return the result
	echo json_encode($result);
}

?>
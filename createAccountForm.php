<?php
require_once "header.php";

//header('Content-Type: application/json'); // this isnt necessary but might be good to throw in later

error_reporting(E_ALL);
ini_set('display_errors', 1);

/*************************************************************************

This script takes user input from the create account page, validates the
input, checks that password criteria is met and that the requested
username doesnt already exist, and stores the user in the Users database
as an unapproved user. The account will need to be approved later on
by an admin.

*************************************************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

	// define variables
	$numDrinks = 0;
	$username = '';
	$password = '';
	$confirm = '';
	$inputIsGood = true;

	$result = array();
	$errors = array();

	$confirm = $_POST["confirm"]; // dont think i need to check this because its only being used for the comparison, never used as sql

	// check the username
	if (empty($_POST["username"]))
	{
		// need to enter a username
		$errors["username"] = "You must enter a username.";
		$inputIsGood = false;
	}
	else if (good_username($_POST["username"]))
	{
		$username = $_POST["username"];
	}
	else
	{
		// username did not meet validation criteria
		$inputIsGood = false;
		$errors["username"] = "Username must consist of letters, numbers, periods, or underscores. Cannot exceed 50 characters.";
	}

	// check the password
	if (empty($_POST["password"]))
	{
		// must enter a password
		$inputIsGood = false;
		$errors["password"] = "You must enter a password.";
	}
	else if (good_password($_POST["password"]))
	{
		$password = $_POST["password"];
	}
	else
	{
		// password did not meet the criteria
		$inputIsGood = false;
		$errors["password"] = "
		Password must be at least 6 characters long. 
		Must contain one letter and one number. 
		May only consist of letters, numbers, and the characters {. , ! , @ , # , $ , %}.";
	}

	// check the confirmation
	if (strcmp($password, $confirm) != 0) // if 0, than strings are equal
	{
		$errors["confirm"] = "Passwords do not match.";
		$inputIsGood = false;
	}

	$password = sha1($password);

	// put data into database
	require 'connect.php';

	// check username
	$sql = "SELECT * FROM Users WHERE name='".$username."'"; // get any entries with this username
	if (! $existingData = $conn->query($sql))
	{
		//echo "Error selecting data.\n"; // commenting for now to avoid screwing up the ajax
	}
	else
	{
		if ($existingData->num_rows > 0) // username exists already
		{
			$errors["username"] = "This username is not available.";
			$inputIsGood = false;
		}		
	}


	/****	At this point, if any errors have occured, go back to the create account page and print the errors	****/


	if ($inputIsGood)
	{
		// prepare and bind
		$sql = "INSERT INTO Users (name, pass, drinkCount, admin, approved) VALUES (?, ?, ?, ?, ?)";

		if ($stmt = $conn->prepare($sql))
		{
			$falseAsInt = intval(false);
			$stmt->bind_param("ssiii", $username, $password, $numDrinks, $falseAsInt, $falseAsInt);
			$stmt->execute();		
		}
		else
		{
			$error = $conn->errno . ' ' . $conn->error;
		    echo $error;
		}

		// entries that don't work are still getting indexed, so the IDs are WAY off
		//	actually, maybe not. should look into later

		$stmt->close();

		$result["success"] = true;
		$result["message"] = "Account successfully created.";
	}
	else
	{
		$result["success"] = false;
		$result["errors"] = $errors;
	}

	// return statement
	echo json_encode($result);
}

?>
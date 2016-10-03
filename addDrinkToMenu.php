<?php
require_once 'header.php';
checkAdminAccess();

/****************************************************************

This script receives input from the admins 'add drink' form and
sends it to the database as a new drink on the menu.

****************************************************************/

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	// ignore validation for now because we trust admins,
	// but add later

	$drinkName   = addQuotes($_POST["drinkName"]);
	$description = addQuotes($_POST["description"]);
	$ingredients = addQuotes($_POST["ingredients"]);
	$category    = addQuotes($_POST["category"]);

	$picture  = standardize($drinkName);
	$category = standardize($category);

	$result = array();

	// add to database

	require_once "connect.php";

	$sql = "SELECT * FROM Drinks WHERE drinkName=$drinkName";

	if (! $existingDrink = $conn->query($sql))
	{
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	if ($existingDrink->num_rows == 0)
	{
		// if anything is empty, there should be error messages
		
		// add the drink to the database
		$sql = "INSERT INTO Drinks (drinkName, description, picture, ingredients, category) 
				VALUES ($drinkName,$description,$picture,$ingredients,$category)";
	}
	else
	{
		$oldValues = $existingDrink->fetch_assoc();

		// if values are left blank, dont update them
		// saves the admin from filling out every field every time
		if (empty($_POST["description"])) $description = addQuotes($oldValues["description"]);
		if (empty($_POST["ingredients"])) $ingredients = addQuotes($oldValues["ingredients"]);
		if (empty($_POST["category"]))    $category    = addQuotes($oldValues["category"]);

		// drink exists, but we will update it with the new info
		$sql = "UPDATE Drinks 
				SET description=$description,ingredients=$ingredients,category=$category
				WHERE drinkName=$drinkName";
	}

	if ($conn->query($sql))
	{
		$result["outcome"] = "Drink successfully added to the menu.";
	}
	else
	{
		$result["outcome"] = "Error: " . $sql . "<br>" . $conn->error;
	}

	echo json_encode($result);
}

?>
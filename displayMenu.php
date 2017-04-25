<?php
require_once 'header.php';
require_once 'connect.php';

// define an ordered array for the drink categories
$categories = array("original", "whiskey", "gin", "brandy", "rum", "special", "vodka", "tequila");
$drinkHtml = "";

foreach ($categories as $category)
{
	// check database for drinks of each category
	$sql = "SELECT * FROM Drinks WHERE category='$category'";

	if ($listOfDrinks = $conn->query($sql))
	{
		if ($listOfDrinks->num_rows > 0)
		{
			$drinkHtml = $drinkHtml . "<h2 class='category'>" . $category . "</h2>"; # to capitalize category name, would add a function here just to change the string one time
			while ($drink = $listOfDrinks->fetch_assoc())
			{
				$pic = "pics/" . $drink["picture"] . ".jpg";

				// format ingredients for previewing

				$drinkHtml = $drinkHtml . "<div class='mainMenuDiv' id=" . addQuotes($drink["drinkName"]) . ">";
				$drinkHtml = $drinkHtml . "<img class='mainMenu' id='pic' src=" . $pic . ">";
				$drinkHtml = $drinkHtml . "<p class='mainMenu'>" . $drink["drinkName"] . "</p>";
				//$drinkHtml = $drinkHtml . "<p class='previewIngredients'>" . $drink["ingredients"] . "</p>";
				$drinkHtml = $drinkHtml . "<div hidden id=description> " . $drink["description"] . " </div>";
				$drinkHtml = $drinkHtml . "<div hidden id=ingredients> " . $drink["ingredients"] . " </div>";
				$drinkHtml = $drinkHtml . "</div><br>";
			}
		}
	}
	else
	{
		echo "Error: " . $sql . "<br>" . $conn->error . "<br>";
	}
}

echo $drinkHtml;

?> 
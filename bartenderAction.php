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

// ***********************************************************************************************************
// ********** 		inventory tracker: update the inventory table to account for ordered drink 		**********
// ***********************************************************************************************************

		$result["id"] = $id;
		$sql_getOrderedDrinkName = "SELECT drinkName FROM Orders WHERE orderId=$id";

		if ($orderRow = $conn->query($sql_getOrderedDrinkName)->fetch_assoc())
		{
			$drinkName = addQuotes($orderRow["drinkName"]);
			$sql_getIngredientsAndRecipe = "SELECT ingredients, recipe FROM Drinks WHERE drinkName=$drinkName";

			if ($drinkRow = $conn->query($sql_getIngredientsAndRecipe))
			{
				$drinkRow = $drinkRow->fetch_assoc();

				$ingredients = $drinkRow["ingredients"];
				$ingredients = explode(",", $ingredients);

				$recipe = $drinkRow["recipe"];
				$recipe = explode(",", $recipe);

				if (count($ingredients) != count($recipe))
				{
					// throw an error
					$result["outcome"] = "Error: ingredients and recipe have different number of elements!";
				}
				else
				{
					for ($i = 0; $i < count($ingredients); $i++)
					{
						$ingredient = addQuotes(strtolower($ingredients[$i]));
						$sql_lookupInventory = "SELECT * FROM Inventory WHERE bottleName=$ingredient";

						if ($inventoryItem = $conn->query($sql_lookupInventory))
						{
							if ($inventoryItem->num_rows > 0)
							{
								// then we are tracking this ingredient
								$item = $inventoryItem->fetch_assoc();
								$newAmount = $item["amountRemaining"] - floatval($recipe[$i]);
								if ($newAmount < 0.0)
								{
									// negative volumes are not real
									$newAmount = 0.0;
								}
								$sql_updateInventory = "UPDATE Inventory SET amountRemaining=$newAmount WHERE bottleName=$ingredient";
								if ($conn->query($sql_updateInventory))
								{
									$result["outcome"] = "Inventory update successful for " . $ingredient;
								}
								else
								{
									$result["outcome"] = "Error: " . $sql_updateInventory . "   " . $conn->error;
								}
							}
						}
						else
						{
							$result["outcome"] = "Error: " . $sql_lookupInventory . "   " . $conn->error;
						}
					}
				}
			}
			else
			{
				$result["outcome"] = "Error: " . $sql_getIngredientsAndRecipe . "   " . $conn->error;
			}
		}
		else
		{
			$result["outcome"] = "Error: " . $sql_getOrderedDrinkName . "   " . $conn->error;
		}

// ***********************************************************************************************************
// ********** 		                          end inventory tracker 		                        **********
// ***********************************************************************************************************

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
			$result["outcome"] = "Error: " . $sql . "   " . $conn->error;
		}
	}
	// else this form shouldnt have been called!

	echo json_encode($result);
}

?>
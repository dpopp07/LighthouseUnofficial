<?php
	require_once 'header.php';
	checkAdminAccess();
?>
<html>
	<head>
		<title>Manage Drink Menu</title>
		<link rel="stylesheet" type="text/css" href="styles.css"/>
		<script src="jquery-3.1.0.min.js"></script>
		<script src="sendNewDrink.js"></script>

	</head>
	<body id="manageDrinks">
		
		<!-- All we have for now is add a drink. Put in remove a drink later -->

		<?php backToAdminMenu(); ?> 

		<h1 class="admin"> Add A Drink To The Menu</h1>

		<form method="post" id="addDrink" class="manageMenu">

			<div id="drinkName" class="manageMenu">
				Drink Name:<br>
				<input class="manageMenu" type="text" name="drinkName"> <br>
			</div>
			<br>
			<div id="description" class="manageMenu">
				Description:<br>
				<textarea rows="4" cols="50" name="description" maxlength="400" ></textarea> <!-- check this before uploading -->
				<br>
			</div>
			<br>
			<div id="ingredients" class="manageMenu">
				Ingredients (enter as CSV):<br>
				<textarea rows="3" cols="50" name="ingredients"></textarea>
				<br>
			</div>
			<br>
			<div id="category" class="manageMenu">
				Drink Category:<br>
				<input class="manageMenu" type="text" name="category"> <br>
			</div>

			<input type="submit" id="addDrink" value="Add Drink To Menu"> <br>		

		</form>

	</body>
</html>
<?php
	require_once 'header.php';
	checkAccess();
?>
<html>

	<head>

		<title> Main Menu </title>

		<link rel="stylesheet"
			  type="text/css"
			  href="styles.css"
		      />

		<script src="jquery-3.1.0.min.js"></script>
		<script src="selectAndOrderDrink.js"></script>
	<!--  	<script src="refreshOnBack.js"></script>-->

	</head>
	<body id="menu">

		<!-- <input type="hidden" id="refresh" value="no"> --> <!-- for refreshing on back button -->

		<?php welcomeUser(); ?> 

		<a href='index.php'>
			<div class='logout'>Logout</div>
		</a>

		<?php backToAdminMenu(); ?> <!-- gives an option back to the admin menu, only if user is admin -->

		<h1> Classic Cocktails </h1>

		<?php require_once 'displayMenu.php'; ?>
	
	</body>

</html>


<!-- 

For the menu:


<h2 class='category'> $category </h2>

<div class='mainMenuDiv' id='$drinkName'>
	<img class='mainMenu' id='pic' src='$pic'>
	<p class='mainMenu'> $drinkName </p>
	<div hidden id=description> $description </div>
	<div hidden id=ingredients> $ingredients </div>
</div>
<br>


For the single drink page:


<body id='drinkPage'>
	<a class='reloadMenu' href='menu.php'>
		<div class='reloadMenu'>Back To Main Menu</div>
	</a>
	<img class='oneDrink' src="pic">
	<h2> "drinkSelected"</h2>
	<p class='description'>"description"</p>
	<h3> Ingredients: </h3>
	<ul>
		<li>"ingredList[i]"</li>
	</ul>
	<input type='button' id='placeOrder' name='" + drinkSelected + "' value='Order This Drink'>
</body>";

 -->
<?php
	require_once 'header.php';
	checkAdminAccess();
?>
<html>
	<head>
		<title> Bartender </title>
		
		<link rel="stylesheet"
			  type="text/css"
			  href="styles.css"
			  />

		<script src="jquery-3.1.0.min.js"></script>
		<script src="orderAction.js"></script>

	</head>
	<body id="bartender">

		<?php backToAdminMenu(); ?> 
		
		<h1 class="admin"> Drinks To Make: </h1>

		 <?php
		 	require_once 'processOrderQueue.php';
		 ?>


<!-- 	FORMAT

		<div class="firstDrinkUp">
			<p class="bartender"> Drink: Old Fashioned </p>
			<p class="bartender"> Customer: TestUser123 </p>
			<p class="bartender"> Simple, bitters, whiskey, orange peel, cherry </p>
			<input type="button" name="confirmOrder" value="Confirm" id='<orderId>'>
			<input type="button" name="cancel" value="Cancel" id='<orderId>'>
		</div>

-->


	</body>
</html>
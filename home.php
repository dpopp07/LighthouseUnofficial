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
	</head>
    <body>

		<?php welcomeUser(); ?> 

		<a href='about.html'>
			<div class='logout'>About Us</div>
		</a>
		<br>
		<a href='menu.php'>
			<div class='logout'>Cocktail Menu</div>
		</a>
		<br>
		<a href='orderHistoryPage.php'>
			<div class='logout'>View Order History</div>
		</a>
		<br>
		<a href='index.php'>
			<div class='logout'>Logout</div>
		</a>
		<br>

		<img class="home" src="pics/jarnacsour.jpg">
		<img class="home" src="pics/noreaster.jpg">
		<img class="home" src="pics/plano.jpg">

	</body>

</html>
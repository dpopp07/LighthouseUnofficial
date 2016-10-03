<?php
	require_once 'header.php';
	checkAdminAccess();
?>
<html>
	<head>
		<title>Admin Interface</title>

		<link rel="stylesheet" type="text/css" href="styles.css"/>
		<script src="jquery-3.1.0.min.js"></script>
		<script src="selectPage.js"></script>
	
	</head>

	<body>

		<!-- for refreshing on back button -->
		<!-- <input type="hidden" id="refresh" value="no"> for some reason, this isnt working on this page -->

		<?php welcomeUser(); ?>

		<a href='index.php'>
			<div class='logout'>Logout</div>
		</a>

		<h1 class="admin">What would you like to do?</h1>
		
		<div class="admin" id="bartender">
			Bartend
		</div>

		<br>
		
		<div class="admin" id="manageDrinkMenu">
			Add/Remove Drinks
		</div>
		
		<br>
		
		<div class="admin" id="accountRequests">
			Manage Account Requests
		</div>
		
		<br>
		
		<div class="admin" id="menu">
			Go To Menu
		</div>

	</body>
</html>
<?php
	require_once 'header.php';
	checkAccess();
?>

<html>

	<head>

		<title> Order History </title>

		<link rel="stylesheet"
			  type="text/css"
			  href="styles.css"
		      />

		<script src="jquery-3.1.0.min.js"></script>

	</head>
	<body>

		<?php welcomeUser(); ?> 

		<br><br>
<!-- 		<a href='index.php'>
			<div class='logout'>Logout</div>
		</a>
 -->
<!-- 		<a href='menu.php'>
			<div class='logout'>Main Menu</div>
		</a> -->

		<?php backToAdminMenu(); ?> <!-- gives an option back to the admin menu, only if user is admin -->

		<?php require_once 'displayPreviousOrders.php'; ?>
	
	</body>

</html>
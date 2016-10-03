<?php
	require_once 'header.php';
	checkAdminAccess();
?>
<html>
	<head>
		<title> Requested Accounts </title>
		
		<link rel="stylesheet"
			  type="text/css"
			  href="styles.css"
			  />

		<script src="jquery-3.1.0.min.js"></script>
		<script src="accountApproval.js"></script>

	</head>
	<body id="accounts">

		<?php backToAdminMenu(); ?> 

		<h1 class="admin"> Requested Accounts: </h1>

		<!-- include a php script for showing the orders -->
		<?php require_once 'generateAccountRequests.php'; ?>


<!-- 	FORMAT

		<div class="firstDrinkUp"> 								// change this class, you can double up in css
			<p class="bartender"> Users desired name </p>
			<input type="button" name="approve" value="Approve" id="Users desired name">
			<input type="button" name="reject" value="Reject" id="Users desired name">
		</div>

-->


	</body>
</html>
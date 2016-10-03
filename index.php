<?php
require_once "header.php";
?>
<html>
	
	<head>
		<title> Log In </title>

		<link rel="stylesheet"
			  type="text/css"
			  href="styles.css"
		      />

		<script src="jquery-3.1.0.min.js"></script>

		<script src="loginAttempt.js"></script>
		<script src="refreshOnBack.js"></script>

	</head>

	<body class="logon" id="knock">
		
		

		<!-- <input type="hidden" id="refresh" value="no"> --> <!-- for refreshing on back button, this method doesnt work. maybe safari dependent -->
		
		<?php
			// IF USER USES THE 'BACK' BUTTON, IT DOES NOT LOG THEM OUT
			// ensure logout
			logout();
		?>

		<div class="logon">
			Knock, Knock
		</div>

		<form method="post" id="login">

			<input class="logon" type="text" name="username" placeholder="Username..."> <br>

			<input class="logon" type="password" name="password" placeholder="Password..."> <br>

			<!-- <input type="text" name="speakpas" placeholder="? ? ? ? ..."> <br> -->

			<input class="logon" type="submit" value="Knock"> <br>

		</form>

		<br><br>
		<div class="center">
			<a class="logon" href="createAccount.php">
				<p class="logon">Become A Member</p>
			</a>
		</div>

	</body>

</html>

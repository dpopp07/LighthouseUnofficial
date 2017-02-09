<!-- should log out user when they access this page -->
<?php
require_once "header.php";
?>

<html>

	<head>
		<title>Become A Member</title>

		<link rel="stylesheet"
			  type="text/css"
			  href="styles.css"
		      />

		<!-- include jquery, might want to include from CDN when site goes live -->
		<script src="jquery-3.1.0.min.js"></script>

		<script src="accountCreation.js"></script>

	</head>

	<body class="logon">

		<?php
			// ensure logout
			logout();
		?>

		<div class="create">
			Fill Out The Form Below. <br>You Can Login Once Your Account Is Approved.
		</div>

		<form method="post" id="createAccount">

			<div id="user" class="form-group">
				Enter A Username
				<input type="text" name="username" placeholder="Username..."> <br>
				<!-- username errors here -->
			</div>

			<div id="pass" class="form-group"> <!-- might want to salt the password -->
				Enter A Password
				<input type="password" name="password" placeholder="Password..."> <br>
				<!-- password errors here -->
			</div>

			<div id="confirm" class="form-group">
				Confirm Password
				<input type="password" name="confirm" placeholder="Password..."> <br>
				<!-- passwords dont match error here -->
			</div>

			<input type="submit" value="Submit For Approval"> <br>
		
		</form>

		<p class="disclaimer"> Passwords must be at least 6 characters long <br>and must contain at least one letter and one number.</div>
		<br><br>
		<p class="disclaimer">By creating an account, I acknowledge that I am at least 21 years of age.</p>
		
		<br>

		<div class="center">
			<a class="logon" href="index.php">
				<p class="logon">Back To Login</p>
			</a>
		</div>

			


		
	</body>

</html>
<?php
session_start();

function good_username($data)
{
	$good = true;

	if (!preg_match("/^[.\w]{1,50}$/", $data))
	{
		// error here, username should be between 1 and 50 chars and
		// should have letters, numbers, periods, or underscores only

		$good = false;
	}

	return $good;
}

function good_password($data)
{
	$good = true;

	if (!preg_match("/^(?=.*\d)(?=.*[a-z]|[A-Z])[.!@#$%\w]{6,50}$/", $data))
	{
		// password should have between 6 and 50 chars,
		// should have at least one letter and one number,
		// can be letters, numbers, or chars {. , ! , @ , # , $ , %}

		$good = false;
	}

	return $good;
}

// log out of a session, prevent viewing of restricted pages
// 	for now, just using the one variable, but maybe session should be ended?? 
function logout()
{
	if (isset($_SESSION["loggedIn"]))
	{
		if ($_SESSION["loggedIn"])
		{
			// print that user has been logged out
			echo "<div class='errorText'> You have been logged out. </div>";
		}
	}

	$_SESSION["loggedIn"] = false;

	// unset the session variables, if they are set
	if (isset($_SESSION["user"]))
	{
		unset($_SESSION["user"]);
	}
	if (isset($_SESSION["admin"]))
	{
		unset($_SESSION["admin"]);
	}
	if (isset($_SESSION["drinks"]))
	{
		unset($_SESSION["drinks"]);
	}
}

function checkAccess()
{
	if (isset($_SESSION["loggedIn"]))
	{
		if (! $_SESSION["loggedIn"])
		{
			// user does not have access
			header("Location: accessDenied.html"); // this should be an absolute path
			exit();
		}
	}
	else
	{
		// this should never happen, but if it does - treat "loggedIn" as false. couldnt it happen though...?
		header("Location: accessDenied.html"); // this should be an absolute path
		exit();
	}
}

function checkAdminAccess()
{
	checkAccess();

	if (! $_SESSION["admin"])
	{
		// user does not have admin access
		header("Location: accessDenied.html"); // this should be an absolute path
		exit();
	}
}

function welcomeUser()
{
	// this function will never be called unless user is logged in, so no need to check
	$user = $_SESSION["user"];
	$drinks = $_SESSION["drinks"];

	// echo "<div class='sessionMessage'> Welcome, " . $user . ". You have had " . $drinks . " drink(s) total. </div>"; // add when drink count is fixed
	echo "<div class='sessionMessage'> Welcome, " . $user . "</div>";
}

function addQuotes($string)
{
	$quote = '"';
	$string = $quote . $string . $quote;
	return $string;
}

function standardize($string)
{
	// remove any white space
	$string = preg_replace('/\s+/','',$string);

	// remove any special characters (just single quotes for now)
	$string = preg_replace("/'/", "", $string);

	// make lower case
	$string = strtolower($string);

	return $string;
}

function backToAdminMenu()
{
	if ($_SESSION["admin"])
	{
		echo "<a href='admin.php'><div class='logout'>Back To Admin</div></a>";
	}
}

if (!function_exists('boolval'))
{
	function boolval($val)
	{
		return (bool) $val;
	}
}

?>
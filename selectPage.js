/*

Formatting <a> links in HTML was really starting to bother me, so
I am creating this page to handle clicking divs as a replacement
for traditional links. 

*/

$(document).ready(function() {

	/***   admin pages   ***/

	// go to bartender page
	$("#bartender").click(function() {

		window.location = "bartender.php";
	});

	// go to add/remove drink page
	$("#manageDrinkMenu").click(function() {

		window.location = "manageDrinkMenu.php";
	});

	// go to account requests page
	$("#accountRequests").click(function() {

		window.location = "accountRequests.php";
	});

	// go to menu page
	$("#menu").click(function() {

		window.location = "menu.php";
	});

	// go to home page
	$("#home").click(function() {

		window.location = "home.php";
	});
});

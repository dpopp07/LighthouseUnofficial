// this file is very unnecessary i think
// verify and then delete

$(document).ready(function() {
	
	// user places an order from the menu
	$("#placeOrder").click(function() {
		
		// send order to orders database for storage and population of the bartender page

		var data = {
			"drinkName" : this.name

		};

		$.post("processOrder.php", data, function(result) {
			console.log(result);

			//window.location = "menu.php";
			$("#drinkPage").append("<div> <br> <br>" + result.outcome + "</div>");

		}, "json")

		// remove for production
		.fail(function(textStatus, errorThrown) {
			console.log(4);
			console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
		});
	});
});

$(document).ready(function() {

/*
This script now contains the functionality that was in orderDrink.js
*/
	
	$(".mainMenuDiv").click(function() {
		
		var drinkSelected = this.id;
		var pic           = $(this).children("#pic").attr("src");
		var description   = $(this).children("#description").text();
		var ingredients   = $(this).children("#ingredients").text();

		var ingredList = ingredients.split(",");
		var i;

		var newHtml ="<body id='drinkPage'>";

		newHtml += "<a class='reloadMenu' href='menu.php'><div class='reloadMenu'>Back To Menu</div></a>";
		newHtml += "<img class='oneDrink' src=" + pic + ">";
		newHtml += "<h2 class='oneDrink'> " + drinkSelected + " </h2>";
		newHtml += "<p class='description'>" + description + "</p>";
		newHtml += "<h3> Ingredients: </h3>";
		newHtml += "<ul>";
		
		for (i = 0; i < ingredList.length; i++)
		{ 
			newHtml += "<li>" + ingredList[i] + "</li>";
		}

		newHtml += "</ul><input type=\"button\" id=\"placeOrder\" name=\"" + drinkSelected + "\" value=\"Order This Drink\"></body>";

		$("#menu").html(newHtml);
		$("body").attr("id", "drinkPage");
		$("title").replaceWith("<title>" + drinkSelected + "</title>")


		/*															 *															 */
		/* After selecting a drink to view, the user can click the place order button and the order will be sent to the database */
		/*															 *															 */
		$("#placeOrder").click(function() {
			
			// send order to orders database for storage and population of the bartender page

			var data = { "drinkName" : this.name };

			$.post("processOrder.php", data, function(result) {
				console.log(result);

				if ($('#message').length)
				{
				     $("#message").replaceWith("<div id='message'>" + result.outcome + "</div>");
				}
				else
				{
					$("#drinkPage").append("<br><br><div id='message'>" + result.outcome + "</div>");
				}

			}, "json")

			// remove for production
			.fail(function(textStatus, errorThrown) {
				console.log(4);
				console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
			});
		});

	});
});
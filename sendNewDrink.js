$(document).ready(function() {

	$("#addDrink").submit(function() {

		$(".addDrink").remove();

		var formData = {
			"drinkName"		: $("input[name=drinkName]").val(),
			"description" 	: $("textarea[name=description]").val(),
			"ingredients"	: $("textarea[name=ingredients]").val(),
			"category" 		: $("input[name=category]").val()
		};

		if (formData.drinkName)
		{
		    $.post('addDrinkToMenu.php', formData, function(result) {

				// log data to the console so we can see
				console.log(result);

				$("#manageDrinks").append("<p class='addDrink'>" + result.outcome + "</p>");

		    }, "json")


			// best to remove for production --- REMOVE THIS EVENTUALLY !!!
			.fail(function(textStatus, errorThrown)
			{
				console.log(4);
				console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
			});
		}
		else
		{
			// no value for drink name
			$("#drinkName").append("<p class='addDrink'> You must enter a name for the drink.</p>");
		}

		event.preventDefault();
	});
});
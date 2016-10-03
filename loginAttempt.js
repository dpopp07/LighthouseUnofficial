$(document).ready(function () {
	
	$("#login").submit(function(event) {

		$(".errorText").remove(); // remove the error messages

		var formData = {
			"username" : $("input[name=username]").val(),
			"password" : $("input[name=password]").val()
		};

		$.post("processLoginAttempt.php", formData, function(result) {

			console.log(result);

			if (result.success)
			{
				if (result.admin)
				{
					// go to bartender page
					window.location = "admin.php";
				}
				else
				{
					// go to menu page
					window.location = "menu.php"
				}
			}
			else // login failed
			{
				$("#login").append("<div class='errorText'>" + result.errors + "</div>");
			}

		}, "json")

		// best to remove for production --- REMOVE THIS EVENTUALLY !!!
		.fail(function(textStatus, errorThrown)
		{
			console.log(4);
			console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
		});

		event.preventDefault();

	})
});
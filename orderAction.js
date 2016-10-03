$(document).ready(function() {

	// bartender confirms that drink was made
	$("input[name=confirmOrder]").click(function() {

		var data = {
			"orderId" : this.id,
			"action" : "confirm"
		};

		$.post("bartenderAction.php", data, function(result) {
			console.log(result);

			// reload bartender page
			location.reload();

		}, "json")

		// remove for production
		.fail(function(textStatus, errorThrown) {
			console.log(5);
			console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
		});
	});

	// bartender cancels drink order if it was never made
	$("input[name=cancel]").click(function() {

		var data = {
			"orderId" : this.id,
			"action" : "cancel"
		};

		$.post("bartenderAction.php", data, function(result) {
			console.log(result);

			// reload bartender page
			location.reload();

		}, "json")

		// remove for production
		.fail(function(textStatus, errorThrown) {
			console.log(6);
			console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
		});
	});
});
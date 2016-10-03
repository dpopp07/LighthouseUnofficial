$(document).ready(function() {

	// admin approves the account
	$("input[name=approve]").click(function() {

		var data = {
			"username" : this.id,
			"action" : "approve"
		};

		$.post("processAccountAction.php", data, function(result) {
			console.log(result);

			// reload page
			location.reload();

		}, "json")

		// remove for production
		.fail(function(textStatus, errorThrown) {
			console.log(5);
			console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
		});
	});

	// admin rejects the account
	$("input[name=reject]").click(function() {

		var data = {
			"username" : this.id,
			"action" : "reject"
		};

		$.post("processAccountAction.php", data, function(result) {
			console.log(result);

			// reload page
			location.reload();

		}, "json")

		// remove for production
		.fail(function(textStatus, errorThrown) {
			console.log(6);
			console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
		});
	});
});
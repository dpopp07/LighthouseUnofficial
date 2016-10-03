$(document).ready(function() {
	// process the form
	$('#createAccount').submit(function(event) {

		//$('.form').removeClass('has-error'); // remove the error class <-- this is from the scotch tutorial guy
		$('.errorText').remove(); // remove the error text

		var formData = {
			"username"	: $("input[name=username]").val(),
			"password" 	: $("input[name=password]").val(),
			"confirm"	: $("input[name=confirm]").val()
		};

	    $.post('createAccountForm.php', formData, function(result) {
	        
			// log data to the console so we can see
			console.log(result);

	        // place success code here
	        if (result.success)
	        {
	        	$("#knock").append("<div class='form-group'>" + result.message + "</div>"); // this doesnt do anything
	        	window.location = "index.php";
	        }
	        else // there was some error with the input
	        {
	        	if (result.errors.username)
	        	{
	        		// there was a username problem
	        		$("#user").append("<div class='errorText'>" + result.errors.username + "</div>");
	        	}

	        	if (result.errors.password)
	        	{
	        		// there was a problem with the password
	        		$("#pass").append("<div class='errorText'>" + result.errors.password + "</div>");
	        	}

	        	if (result.errors.confirm)
	        	{
	        		// passwords did not match
	        		$("#confirm").append("<div class='errorText'>" + result.errors.confirm + "</div>");
	        	}
	        }
	    }, "json")



		// best to remove for production --- REMOVE THIS EVENTUALLY !!!
		.fail(function(textStatus, errorThrown)
		{
			console.log(4);
			console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
		});

		// stop the form from submitting the normal way and refreshing the page
		event.preventDefault();
	})
});

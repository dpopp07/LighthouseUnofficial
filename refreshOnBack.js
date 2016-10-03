// this sort of works. i dont love it but it will have to do for now

// it actually still allows using the forward button to get back to drinks

$(document).ready(function(e) {

	window.onpageshow = function(event) {
		if (event.persisted)
		{
			window.location.reload() 
		}
	};

});

// this isnt working. guy on stack overflow said he couldnt get it to work in safari
/*$(document).ready(function() {

    var input = $("#refresh").val();

    console.log(input);

    if (input == "yes") // then the back button was used to get back
    {
    	//location.href = location.href;
    	location.reload(true);
    }

    $("#refresh").attr("value", "yes"); // set to yes upon loading page

});*/
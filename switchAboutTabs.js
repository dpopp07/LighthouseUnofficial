$(document).ready(function(){

	$("#about").click(function(){

		$("#aboutus").show();
		$("#wemake").hide();
		$("#bios").hide();

		$("#about").css("font-weight","bold");
		$("#make").css("font-weight","normal");
		$("#bio").css("font-weight","normal");
	});

	$("#make").click(function(){

		$("#wemake").show();
		$("#aboutus").hide();
		$("#bios").hide();

		$("#make").css("font-weight","bold");
		$("#about").css("font-weight","normal");
		$("#bio").css("font-weight","normal");
	});

	$("#bio").click(function(){

		$("#bios").show();
		$("#aboutus").hide();
		$("#wemake").hide();

		$("#bio").css("font-weight","bold");
		$("#about").css("font-weight","normal");
		$("#make").css("font-weight","normal");
	});

});

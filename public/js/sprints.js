$(document).ready(function() {
	var id;
	$(".defects_tip").bind('hover',function(event) {
		id = $(this).attr('id');

		var sprId = id.split("_");
		$(this).simpletip({
			content : $("#defects_tooltip_" + sprId[2]).html(),
			fixed : true,
			position : [ "-200", "-185" ]
		});
	});
	
	$(".hours_tip").bind('hover',function(event) {
		id = $(this).attr('id');

		var sprId = id.split("_");
		$(this).simpletip({
			content : $("#hours_tooltip_" + sprId[2]).html(),
			fixed : true,
			position : [ "-200", "-220" ]
		});
	});
	
	$("#blueButton").click(function(){
		
	})
	
	
});
$(document).ready(function() {
	var id;
	$(".tip").bind('hover',function(event) {
		id = $(this).attr('id');

		var sprId = id.split("_");
		$(this).simpletip({
			content : $("#tooltip_" + sprId[1]).html(),
			fixed : true,
			position : [ "-200", "-185" ]
		});
	});
	
	
});
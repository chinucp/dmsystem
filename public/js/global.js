$(document).ready(function() {
	var id; 
	$("#dialog:ui-dialog").dialog("destroy");
	$("#dialog-delete-project").dialog({
		autoOpen : false,
		resizable : false,
		height : 140,
		modal : true,
		buttons : {
			"Delete" : function() {
				$(this).dialog("close");
				$("#"+id).fadeOut(300, function(){$("#"+id).remove();}); 
			},
			Cancel : function() {
				$(this).dialog("close");
			}
		}

	});

	$(".uiCloseButton").button().click(function() {
		id = $(this).parent().attr('id');
		$("#dialog-delete-project").dialog("open");
	});

	
	
	$("#dialog-delete-milestone").dialog({
		autoOpen : false,
		resizable : false,
		height : 140,
		modal : true,
		buttons : {
			"Delete" : function() {
				$(this).dialog("close");
				$("#"+id).fadeOut(300, function(){$("#"+id).remove();}); 
			},
			Cancel : function() {
				$(this).dialog("close");
			}
		}

	});
	$(".uiCloseButton").button().click(function() {
		id = $(this).parent().attr('id');
		$("#dialog-delete-milestone").dialog("open");
	});

});

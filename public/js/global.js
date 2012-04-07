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
				$("#" + id).fadeOut(300, function() {
					$("#" + id).remove();
				});
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
				$("#" + id).fadeOut(300, function() {
					$("#" + id).remove();
				});
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

	$("#selectProject").change(function() {
		document.location = "/home?projectId=" + $("#selectProject").val();
	});

	$("#addProjectBut").click(function() {
		document.location = "/projects/add";
	});

	$("#sview").click(function() {
		$("#rviewInfo").hide();
		$("#sviewInfo").show();
	});

	$("#rview").click(function() {
		$("#rviewInfo").show();
		$("#sviewInfo").hide();
	});
	
	
	/**
	 *  Add Project
	 *  ===============================================
	 */   
	 
	// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
	$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
	var name = $( "#name" ),
		email = $( "#email" ),
		password = $( "#password" ),
		allFields = $( [] ).add( name ).add( email ).add( password ),
		tips = $( ".validateTips" );

	function updateTips( t ) {
		tips
			.text( t )
			.addClass( "ui-state-highlight" );
		setTimeout(function() {
			tips.removeClass( "ui-state-highlight", 1500 );
		}, 500 );
	}

	function checkLength( o, n, min, max ) {
		if ( o.val().length > max || o.val().length < min ) {
			o.addClass( "ui-state-error" );
			updateTips( "Length of " + n + " must be between " +
				min + " and " + max + "." );
			return false;
		} else {
			return true;
		}
	}

	function checkRegexp( o, regexp, n ) {
		if ( !( regexp.test( o.val() ) ) ) {
			o.addClass( "ui-state-error" );
			updateTips( n );
			return false;
		} else {
			return true;
		}
	}
	
	$( "#dialog-form" ).dialog({
		autoOpen: false,
		resizable : false,
		height: 530,
		width: 590,
		modal: true,
		buttons: {
			"Add Project": function() {
				$('#projectAddForm').submit();
			},
			Cancel: function() {
				$( this ).dialog( "close" );
			}
		},
		close: function() {
			allFields.val( "" ).removeClass( "ui-state-error" );
		}
	});
	
	$("#addProjectButton").button().hover(function(){
		$("#addProjectButton").removeClass("ui-state-hover");
	});

	$( "#addProjectButton" )
		.button()
		.click(function() {
			$( "#dialog-form" ).dialog( "open" );
		});
	
	$("#addProjectButton").removeClass("ui-button");
	$("#addProjectButton").removeClass("ui-corner-all");
	$("#addProjectButton").removeClass("ui-state-default");
	$("#addProjectButton").removeClass("ui-widget");
	
	// Datepickers
	
	$(function() {
		$( "#startDate" ).datepicker();
	});
	
	$(function() {
		$( "#endDate" ).datepicker();
	});
	
	/**********************************************************************/
});

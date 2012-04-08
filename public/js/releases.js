$(document).ready(function() {
	// Give this as empty string if required.
	
	// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
	$( "#dialog:ui-dialog" ).dialog( "destroy" );
	var modalHeightTextView = 380;
	var modalWidthTextView = 350;
	
	var modalHeightTextView = 450;
	var modalWidthTextView = 450;
	
	var modalHeightGraphView = 450;
	var modalWidthGraphView = 450;
	
	$( "#dialog-modal" ).dialog({
		autoOpen : false,
		resizable : false,
		height: modalHeightTextView,
		width: modalWidthTextView,
		modal: true,
		maxHeight: $(window).height(),
		maxWidth: $(window).width(),
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
			}
		}
	});
	
	 // Resize the dialog 
		
	$('.viewReleaseInfo').click(function() {
		
		$("#graphContainer"). hide();
		$("#dialog-modal").dialog('option', 'height', modalHeightTextView); 
		$("#dialog-modal").dialog('option', 'width', modalWidthTextView); 
		$("#dialog-modal").dialog('option', 'position', 'center'); 
		$("#releaseInfoContainer").show("slow");
		
		var baseUrl = document.getElementById("baseUrl").value;
		if(baseUrl.substr(-1)!="/") {
			baseUrl = baseUrl + "/";
		}
		// ajax call and set the details to modal div.
		$.ajax({
			  type: 'POST',
			  url: baseUrl + 'ajax/releasemodal',
			  data: {releaseid:$(this).attr('id') },
			  beforeSend:function(){
				  
			    // this is where we append a loading image
			    //$('#ajax-panel').html('<div class="loading"><img src="/images/loading.gif" alt="Loading..." /></div>');
			  },
			  success:function(data){
				  // successful request; do something with the data
				  //  var obj = jQuery.parseJSON(data);

				  $('#totalStories').html(data.totalStories);
				  $('#totalDevHours').html(data.totalDevHours);
				  $('#totalTestHours').html(data.totalTestHours);
				  $('#totalReworkHours').html(data.totalReworkHours);
				  $('#totalDefects').html(data.totalDefects);
				  $('#totalMajorDefects').html(data.totalMajorDefects);
				  $('#totalNonSpeHours').html(data.totalNonSpeHours);
				  
				  $("#dialog-modal").dialog("open" );
			  },
			  error:function(){
			    // failed request; give feedback to user
			    
			  }
			});
	});
	
	$("#viewGraph").click(function(){

		// ajax call - get the graph and rsize modal window.
		$.ajax({
			  type: 'POST',
			  url: '/DMS/ajax/releasemodal',
			  data: {releaseid:2 },
			  beforeSend:function(){
				  
			    // this is where we append a loading image
			    //$('#ajax-panel').html('<div class="loading"><img src="/images/loading.gif" alt="Loading..." /></div>');
			  },
			  success:function(data){
				  $("#releaseInfoContainer").hide("slow");
				  $("#dialog-modal").dialog('option', 'height', modalHeightGraphView); 
				  $("#dialog-modal").dialog('option', 'width', modalWidthGraphView); 
				  $("#dialog-modal").dialog('option', 'position', 'center'); 
				  $("#graphContainer").show("slow");
			  },
			  error:function(){
			    // failed request; give feedback to user
			  }
			});
	});
	
	$("#viewTextDetail").click(function(){

		// ajax call - get the graph and rsize modal window.
		$.ajax({
			  type: 'POST',
			  url: '/DMS/ajax/releasemodal',
			  data: {releaseid:2 },
			  beforeSend:function(){
				  
			    // this is where we append a loading image
			    //$('#ajax-panel').html('<div class="loading"><img src="/images/loading.gif" alt="Loading..." /></div>');
			  },
			  success:function(data){
				  	$("#graphContainer"). hide();
					$("#dialog-modal").dialog('option', 'height', modalHeightTextView); 
					$("#dialog-modal").dialog('option', 'width', modalWidthTextView); 
					$("#dialog-modal").dialog('option', 'position', 'center'); 
					$("#releaseInfoContainer").show("slow");
			  },
			  error:function(){
			    // failed request; give feedback to user
			  }
			});
	});
	
});
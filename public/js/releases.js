$(document).ready(function() {
	// Give this as empty string if required.
	
	// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
	$( "#dialog:ui-dialog" ).dialog( "destroy" );
	var modalHeightTextView = 560;
	var modalWidthTextView = 560;
	
	//var modalHeightTextView = 450;
	//var modalWidthTextView = 450;
	
	var modalHeightGraphView = 560;
	var modalWidthGraphView = 560;
	
	var baseUrl = document.getElementById("baseUrl").value;
	if(baseUrl.substr(-1)!="/") {
		baseUrl = baseUrl + "/";
	}
	
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
	
	$('.ui-dialog-titlebar-close').click(function(){
		$("#graphContainer").hide();
		$("#releaseInfoContainer").show();
	});
	 // Resize the dialog 
		
	$('.viewReleaseInfo').click(function() {
		
		$("#graphContainer").fadeOut();
		$("#dialog-modal").dialog('option', 'height', modalHeightTextView); 
		$("#dialog-modal").dialog('option', 'width', modalWidthTextView); 
		$("#dialog-modal").dialog('option', 'position', 'center'); 
		$("#releaseInfoContainer").fadeIn();
		id = $(this).attr('id');
		
		// ajax call and set the details to modal div.
		$.ajax({
			  type: 'POST',
			  url: baseUrl + 'ajax/releasemodal',
			  data: {rid:$(this).attr('id') },
			  beforeSend:function(){
				  
			    // this is where we append a loading image
			    //$('#ajax-panel').html('<div class="loading"><img src="/images/loading.gif" alt="Loading..." /></div>');
			  },
			  success:function(data){
				  // successful request; do something with the data
				  //  var obj = jQuery.parseJSON(data);

				  $('#totalStories').html(data.totalStories);
				  $('#totalStoryPoints').html(data.totalStoryPoints);
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
		var imgWidth = parseInt(modalWidthGraphView) - 60;
		var imgHeight = parseInt(modalHeightGraphView)- 180;
		
		// ajax call - get the graph and rsize modal window.
		$.ajax({
			  type: 'POST',
			  url: baseUrl + 'ajax/generate-graph',
			  data: {rid:id},
			  beforeSend:function(){
				  
			    // this is where we append a loading image
			    //$('#ajax-panel').html('<div class="loading"><img src="/images/loading.gif" alt="Loading..." /></div>');
			  },
			  success:function(data){
				 
				  $("#dialog-modal").dialog('option', 'height', modalHeightGraphView); 
				  $("#dialog-modal").dialog('option', 'width', modalWidthGraphView); 
				  $("#dialog-modal").dialog('option', 'position', 'center'); 
				  $("#releaseInfoContainer").fadeOut();
				  var graphContainerHtml = "<div class='modalGraphImg'><img id='graph' src='"+ 
				  					baseUrl + 
				  					"tmp/" + data.graph+"' width='" + 
				  					imgWidth + "' height='" + 
				  					imgHeight + "'/></div>";
				  setTimeout(function() {$("#graphContainer").html(graphContainerHtml).fadeIn();} , 1000);
				  
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
			  url: baseUrl + 'ajax/releasemodal',
			  data: {rid: id },
			  beforeSend:function(){
				  
			    // this is where we append a loading image
			    //$('#ajax-panel').html('<div class="loading"><img src="/images/loading.gif" alt="Loading..." /></div>');
			  },
			  success:function(data){
				  $("#graphContainer").fadeOut(800).hide();
				  $("#dialog-modal").dialog('option', 'height', modalHeightTextView); 
				  $("#dialog-modal").dialog('option', 'width', modalWidthTextView); 
				  $("#dialog-modal").dialog('option', 'position', 'center'); 
					
				  $('#totalStories').html(data.totalStories);
				  $('#totalStoryPoints').html(data.totalStoryPoints);
				  $('#totalDevHours').html(data.totalDevHours);
				  $('#totalTestHours').html(data.totalTestHours);
				  $('#totalReworkHours').html(data.totalReworkHours);
				  $('#totalDefects').html(data.totalDefects);
				  $('#totalMajorDefects').html(data.totalMajorDefects);
				  $('#totalNonSpeHours').html(data.totalNonSpeHours);
				  
				  $("#releaseInfoContainer").fadeIn(800).show();
			  },
			  complete:function(){
				  
			  },
			  error:function(){
			    // failed request; give feedback to user
			  }
			});
	});
	
});
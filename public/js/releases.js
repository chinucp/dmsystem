$(document).ready(function() {
	// Give this as empty string if required.
	
	// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
	$( "#dialog:ui-dialog" ).dialog( "destroy" );

	$( "#dialog-modal" ).dialog({
		autoOpen : false,
		resizable : false,
		height: 360,
		width: 350,
		modal: true,
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
			}
		}
	});
	
	$('.viewReleaseInfo').click(function() {
		var baseUrl = document.getElementById("baseUrl").value;
		//var l = window.location;
		//var baseUrl = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
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
				  var obj = jQuery.parseJSON(data);

				  $('#totalStories').html(obj.totalStories);
				  $('#totalDevHours').html(obj.totalDevHours);
				  $('#totalTestHours').html(obj.totalTestHours);
				  $('#totalReworkHours').html(obj.totalReworkHours);
				  $('#totalDefects').html(obj.totalDefects);
				  $('#totalMajorDefects').html(obj.totalMajorDefects);
				  $('#totalNonSpeHours').html(obj.totalNonSpeHours);
				  
				  $("#dialog-modal").dialog( "open" );
			  },
			  error:function(){
			    // failed request; give feedback to user
			    
			  }
			});
		
		
	});
	
});
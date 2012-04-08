$(document).ready(function() {
	// Give this as empty string if required.
		
	
	$('.selectbox-class').change(function() {
		var baseUrl = document.getElementById("baseUrl").value;
		
		// ajax call and set the details to modal div.
		requestData =  {pid:$('#graphProjectSelect').val(),rid:$('#graphReleaseSelect').val(),gtype:$('#graphTypeSelect').val()};
		
		$.ajax({
			url : baseUrl + '/ajax/generate-graph',
			data:requestData,
			type : 'get',
			beforeSend: function() {
				$('#graphContainer').html('Generating graph...Please Wait...');
				//$('#changePassMsg').removeClass().html(ajaxProcessMsg);
			},
			success : function(data) {
				var img= '<img src="../tmp/'+data+'" alt="" />';
				$('#graphContainer').html(img);
			},
			error : function() {
				$('#graphContainer').html('Error in Generating graph...Please try after sometime...');
			}

		});
		
		
	});
	
});
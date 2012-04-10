$(document).ready(function() {
	// Give this as empty string if required.
		
	
	$('.selectbox-class').change(function() {
		var baseUrl = document.getElementById("baseUrl").value;
		var setNewReleases = false;
		// ajax call and set the details to modal div.
		requestData =  {pid:$('#graphProjectSelect').val(),rid:$('#graphReleaseSelect').val(),gtype:$('#graphTypeSelect').val()};
	
		if ($(this).attr('id') == 'graphProjectSelect') {
			// remove the releases listbox optaions to populate new set specific to selected project.
			$("#graphReleaseSelect").children().remove();
			setNewReleases = true;
		}
		
		$.ajax({
			url : baseUrl + '/ajax/generate-graph',
			data:requestData,
			type : 'get',
			beforeSend: function() {
				$('#graphContainer').html('Generating graph...Please Wait...');
				//$('#changePassMsg').removeClass().html(ajaxProcessMsg);
			},
			success : function(data) {
				if (setNewReleases) {
					$('#graphReleaseSelect').append('<option value="all">All</option>');
					if ($('#graphProjectSelect').val() != 'all') {
						for (var i in data.releases) {
							$('#graphReleaseSelect').append('<option value="' + data.releases[i].dms_releases_id + '">' + data.releases[i].dms_releases_name + '</option>');
						}
					}
				}				
				var img= '<img src="'+baseUrl+'/tmp/'+data.graph+'" alt="" />';
				$('#graphContainer').html(img);
			},
			error : function() {
				$('#graphContainer').html('Error in Generating graph...Please try after sometime...');
				window.location.href = baseUrl + '/graphs';
			}

		});
		
		
	});
	
});
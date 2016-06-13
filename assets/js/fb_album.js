	$(document).ready(function() {
   		$("#loading").hide();
   	});

	function getPhotos(id)
	{
		$("#loading").show();
		$(document).ready(function () {
	        var form_data={
	        	album_id: id,
	        };
	     	$.ajax({
	           	url: baseURL+'Fb_Login/album_photos',
	            type: "POST",
	            data: form_data,
	            success: function (data){
	            	var obj = jQuery.parseJSON(data);
	            	if(obj['album_photos_url'])
	            	{
	            		$("#loading").hide();
	            		album_photos_url=obj['album_photos_url'];
	            		photos_name=obj['photos_name'];
	            		// alert(photos_name);
	            		// alert(album_photos[0]);
	            		if(album_photos_url=="")
	            		{
							alertify.alert('No photos found in this album..!!').set('basic', true); 
	            			alertify.error("No photos found in this album..!!");
	            		}

	            		if(album_photos_url!="")
	            		{
		            		var add=""
		            		for(i=0;i<album_photos_url.length;i++)
		            		{
								add+="<a "
								if(i==0) add+="id=\"photos\" "
								add+="href=\""+album_photos_url[i]+"\" title=\""+photos_name[i]+"\" data-gallery>"
								add+="<img src=\""+album_photos_url[i]+"\">"
								add+="</a>"
								
							}
								$('#links').html(add);
			            		document.getElementById('photos').click();
	            		}
	            	}
	              	
	              	}
	            });
	     });
	}

	function download_Album(id,album_name)
	{
		$("#loading").show();
		// Pace.track(function(){
		$(document).ready(function () {
	        var form_data={
	        	album_id: id,
	        	album_name:album_name
	        };
	     	$.ajax({
	           	url: baseURL+'Fb_Login/download_Album',
	            type: "POST",
	            data: form_data,
	            success: function (data){
	            	var obj = jQuery.parseJSON(data);
	              
	              	if(obj['no_photos_in_side_album'])
	              	{
						$("#loading").hide();
						alertify.alert('No photos to download from this empty album.').set('basic', true); 
	            		alertify.error("No photos found in this album.");						
	              	}

	              	if(obj['download_zip_file_name'])
	            	{
	            		$("#loading").hide();
						window.location='<?php echo base_url(); ?>Fb_Login/';
	              	}
	              }
	            });
	     });
		//});
	}


	function download_All_Album()
	{
		$("#loading").show();
		// Pace.track(function(){
		$(document).ready(function () {
			var download_All_Album_value="download_All_Album_value";
	        var form_data={
	        	download_All_Album_value: download_All_Album_value
	        };
	     	$.ajax({
	           	url: baseURL+'Fb_Login/download_All_Album',
	            type: "POST",
	            data: form_data,
	            success: function (data){
	            	var obj = jQuery.parseJSON(data);
	              
	              	if(obj['download_all_album_zip_file_name'])
	            	{
	            		$("#loading").hide();
						window.location='<?php echo base_url(); ?>Fb_Login/';
	              	}
	              }
	            });
	     });
		// });
	}	

	function download_selected_albums()
	{
		var album_id_array=[];
		$("input:checkbox[name=album_id]:checked").each(function(){
    		album_id_array.push($(this).val());
		});
		if(album_id_array=='')
		{
			alertify.alert('Please select alteast one album for download..!!').set('basic', true); 
	        alertify.error("Please select alteast one album for download..!!");			
		}

		if(album_id_array!='')
		{
			$(document).ready(function () {
				$("#loading").show();
				var download_selected_albums_value="download_selected_albums_value";
		        var form_data={
		        	download_selected_albums_value: download_selected_albums_value,
		        	album_id_array: album_id_array
		        };
		     	$.ajax({
		           	url: baseURL+'Fb_Login/download_selected_albums',
		            type: "POST",
		            data: form_data,
		            success: function (data){
		            	var obj = jQuery.parseJSON(data);

		              	if(obj['download_selected_albums'])
		            	{
		            		$("#loading").hide();
							window.location='<?php echo base_url(); ?>Fb_Login/';
		              	}
		              }
		            });
		     });
		}
	}	
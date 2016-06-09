    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.2.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
	<script src="<?php echo base_url('assets/blueimp/js/bootstrap-image-gallery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/alertifyjs/alertify.js'); ?>" type="text/javascript" /></script>
    <script type="text/javascript">


   	$("#loading").hide();	
	function getPhotos(id)
	{
		$("#loading").show();
		$(document).ready(function () {
	        var form_data={
	        	album_id: id,
	        };
	     	$.ajax({
	           	url: "<?php echo base_url('Fb_Login/album_photos'); ?>",
	            type: "POST",
	            data: form_data,
	            success: function (data){
	            	var obj = jQuery.parseJSON(data);
	            	if(obj['album_photos_url'])
	            	{
	            		$("#loading").hide();
	            		album_photos_url=obj['album_photos_url'];
	            		// photos_name=obj['photos_name'];
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
								if(i==0) add+="id=\"abcd\" "
								add+="href=\""+album_photos_url[i]+"\" title='lolmlol' data-gallery>"
								add+="<img src=\""+album_photos_url[i]+"\">"
								add+="</a>"
								
							}
								$('#links').html(add);
			            		document.getElementById('abcd').click();
	            		}
	            	}
	              	
	              	}
	            });
	     });
	}
	</script>
</body>
</html>
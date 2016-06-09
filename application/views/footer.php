    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.2.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/jquery.bxslider/jquery.bxslider.min.js'); ?>"></script>

    <script type="text/javascript">

   	$("#loading").hide();	
	function getPhotos(id)
	{
		$("#loading").show();
		$(document).ready(function () {
			// alert(id);
	        var form_data={
	        	album_id: id,
	        };
	     	$.ajax({
	           	url: "<?php echo base_url('Fb_Login/album_photos'); ?>",
	            type: "POST",
	            data: form_data,
	            // dataType: "JSON",
	            success: function (data){
	            	var obj = jQuery.parseJSON(data);
	            	if(obj['album_photos'])
	            	{
	            		$("#loading").hide();
	            		// data: { album_photos : obj['album_photos'] }
	            		// $('#album_photos').html(obj['album_photos']);
	            		var text='<ul>';
	            		album_photos=obj['album_photos'];
	            		for(i=0;i<album_photos.length;i++)
	            		{
	            			text+="<li><img src=\""+album_photos[i] + "\"/></li>";
	            		}
	            		text+="</ul>";
	            		$('#album_photos').html(text);

	            	}
	            	if(!obj['album_photos'])
	            	{
	    				$('#album_photos').html("lol thai gayu...");
	            	}
	              	
	              	}
	            });
	     });
	}
// $("#getPhotosOfAlbum").on('click', function() {
//    alert ("inside onclick");
//    // window.location = "http://www.google.com";
// });
     	// function getPhotos(cid)
      //   {
      //                   $(document).ready(function () {
      //                       //alert(cid);
      //                       /*$('input[type=text],input[type=textarea],input[type=file]').each(function() {
      //                        $(this).val('');
      //                        });*/
      //                       $('#updateCatName,#updateCatDetail,#updateFileName').each(function () {
      //                           $(this).val('');
      //                           $('#uploadError').html('');
      //                       });

      //                       $.ajax({
      //                           url: "<?php echo base_url('Admin/getCategoryData'); ?>",
      //                           type: "POST",
      //                           data: "cid=" + cid,
      //                           dataType: "JSON",
      //                           success: function (data)
      //                           {
      //                               $('[name="updateCatId"]').val(data.id);
      //                               $('[name="cat_name"]').val(data.name);
      //                               $('#catImgName').val(data.catImg);
      //                               $('#catImgSRC').html('<img src="<?php echo base_url(); ?>assets/uploads/category/' + data.catImg + '" width="400" />');
      //                               $('[name="cat_detail"]').val(data.details);

      //                               $('#updateModal').modal('show'); // show bootstrap modal when complete loaded
      //                               //$('.modal-title').text('Update Category Data'); // Set title to Bootstrap modal title
      //                           }
      //                       });
      //                   });
      //               }
	</script>
</body>
</html>
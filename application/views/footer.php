    
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.2.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
	<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
	<script src="<?php echo base_url('assets/blueimp/js/bootstrap-image-gallery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/alertifyjs/alertify.js'); ?>" type="text/javascript" /></script>
    <!--<script src="<?php echo base_url('assets/js/loaders/pace.min.js'); ?>" type="text/javascript" ></script> -->

    <script type="text/javascript">
   	$("#loading").hide();	
   	// $('#myModal').modal({backdrop: 'static', keyboard: false});
// $(document).ready(function(){
//         $("#abc").modal({
//             backdrop: 'static',
//             keyboard: false
//     });
// });
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
								if(i==0) add+="id=\"abcd\" "
								add+="href=\""+album_photos_url[i]+"\" title=\""+photos_name[i]+"\" data-gallery>"
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

	function download_Album(id,album_name)
	{
		$("#loading").show();
		$(document).ready(function () {
	        var form_data={
	        	album_id: id,
	        	album_name:album_name
	        };
	     	$.ajax({
	           	url: "<?php echo base_url('Fb_Login/download_Album'); ?>",
	            type: "POST",
	            data: form_data,
	            success: function (data){
	            	var obj = jQuery.parseJSON(data);
	              
	              	if(obj['download_zip_file_name'])
	            	{
	            		$("#loading").hide();
						window.location='<?php echo base_url(); ?>Fb_Login/';
	              	}
	              }
	            });
	     });
	}


	function download_All_Album()
	{
		$("#loading").show();
		$(document).ready(function () {
			var download_All_Album_value="download_All_Album_value";
	        var form_data={
	        	download_All_Album_value: download_All_Album_value
	        };
	     	$.ajax({
	           	url: "<?php echo base_url('Fb_Login/download_All_Album'); ?>",
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
				// alert(album_id_array);
				var download_selected_albums_value="download_selected_albums_value";
		        var form_data={
		        	download_selected_albums_value: download_selected_albums_value,
		        	album_id_array: album_id_array
		        };
		     	$.ajax({
		           	url: "<?php echo base_url('Fb_Login/download_selected_albums'); ?>",
		            type: "POST",
		            data: form_data,
		            success: function (data){
		            	var obj = jQuery.parseJSON(data);
		              
		              	if(obj['download_selected_album_zip_file_name'])
		            	{
		            		$("#loading").hide();
							window.location='<?php echo base_url(); ?>Fb_Login/';
		              	}
		              }
		            });
		     });
		}
	}	

	</script>



<?php 
	if($this->session->userdata('download_zip_file_link'))
	{
?>
	    <script type="text/javascript">
	        $(document).ready(function (){
	            $('#download_file_modal').modal('show');
	        });
	    </script>

	<!-- Download zip file modal -->
	    <div class="modal fade modal" id="download_file_modal" data-keyboard="false" data-backdrop="static" aria-hidden="true" data-use-bootstrap-modal="false">
	        <div class="modal-dialog">
	            <div class="modal-content"><br>
	                <div class="modal-header">
	          			<button type="button" class="close" data-dismiss="modal">&times;</button>
	          			<h4 class="modal-title">Download Album</h4>
	        		</div>
	                <div class="modal-body">
	                    <form action="" method="POST" name="">
	                        <table width="" height="" align="center">
	                            <tr> 
	                                <td> 
	                                    <?php 
											$download_zip_file_link=$this->session->userdata('download_zip_file_link');
	                                        echo "Your album photos are ready to download.<br>";
	                                        echo "<a href='".$download_zip_file_link."' >Click Here </a> to download.";
	                                        // $album_name=$this->session->userdata('album_name');
	                                        // $path = $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album_name;
	                                        // echo $path;
	                                        // chmod($path, 0777);
	                                        // rmdir($path);
	                                    ?> 
	                                </td>
	                            </tr>

	                            <tr>
	                                <td>
	                                    <div style="text-align:center" align="center">
	                                        <input class="btn btn-success btn-md" type="button" name="ok" id="ok" value="OK" style="width: 100px;"
	                                        data-dismiss="modal" value="Close" onclick="javascript:window.location='<?php echo base_url('Fb_Login') ;?>';" />
	                                    </div><br>
	                                </td>
	                            </tr>                            
	                          
	                        </table>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	<!-- Download zip file modal -->
<?php
		$this->session->unset_userdata('download_zip_file_link');
    }
    else
    {
        echo "";
    }
?>


</body>
</html>

    <script src="<?php echo base_url('assets/js/jquery-2.2.4.min.js'); ?>" type="text/javascript" ></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>" ></script>
	<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
	<script src="<?php echo base_url('assets/blueimp/js/bootstrap-image-gallery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/alertifyjs/alertify.js'); ?>" type="text/javascript" /></script>
    <script src="<?php echo base_url('assets/js/fb_album.js'); ?>" type="text/javascript" ></script>
    <script type="text/javascript"> var baseURL = "<?php echo base_url(); ?>"; </script>
    <script src="<?php echo base_url('assets/vegas/js/zepto.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vegas/js/vegas.js'); ?>" type="text/javascript" ></script>
    <script src="<?php echo base_url('assets/vegas/js/vegas.min.js'); ?>" type="text/javascript" ></script>

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
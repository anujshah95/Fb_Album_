
    <div class="container">
            <?php if(isset($user_profile))
            {
            ?>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div id="album_photos">
                            <div id="blueimp-gallery" class="blueimp-gallery modal" data-use-bootstrap-modal="false">
                                <div class="slides"></div>
                                <h3 class="title"></h3>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="close">×</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>
                                <div class="modal fade" id="modal" role="dialog" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title"></h4>
                                            </div>
                                            <div class="modal-body next"></div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left prev">
                                                    <i class="glyphicon glyphicon-chevron-left"></i>
                                                    Previous
                                                </button>
                                                <button type="button" class="btn btn-primary next">
                                                    Next
                                                    <i class="glyphicon glyphicon-chevron-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="links" class="links"></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <div class='pull-right albums_list'>
                            <a href='#' onClick="download_selected_albums()">
                                <button type='button' class='btn btn-primary btn-md'>
                                    <span class='glyphicon glyphicon-download-alt'></span> 
                                    Download Selected
                                </button>
                            </a>
                            <a href='#' onClick="download_All_Album()">
                                <button type='button' class='btn btn-primary btn-md'>
                                    <span class='glyphicon glyphicon-download-alt'></span> 
                                    Download All Albums
                                </button>
                            </a>
                        </div>
                        <?php
                            if(isset($albums))
                            {
                                $counter=1;
                                echo "<table class='table albums_list'><tbody>";
                                foreach($albums['data'] as $album)  
                                {
                                    if ($counter == 1) {
                                        echo "<tr>";
                                    }
                                            echo "<td style='text-align:center'>";
                                                $id=$album['id'];
                                                $album_name=$album['name'];
                                                echo "<a href='#' onClick='getPhotos(".$id.")'> 
                                                        <img class='img-thumbnail img-responsive img-fluid' alt=".$album['name']." src=".$album['picture']['data']['url']." style='width: 200px; height: 200px;'>
                                                    </a><br><br>";
                                                echo "<div class='checkbox'><input type='checkbox' value='".$id."' name='album_id'>";
                                                echo "<a href='#' onClick='getPhotos(".$id.")' >".$album['name']." (".$album['count'].")"."</a>";
                                                echo "</div><br>";
                                                echo "<a href='#' onClick=\"download_Album(".$id.",'".$album['name']."')\"><button type='button' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-download-alt'></span> Download This Album</button></a>";
                                            echo "</td>";

                                        if ($counter == 4) 
                                        { 
                                            echo("</tr>");
                                            $counter = 1;
                                        } 
                                        else 
                                        {
                                            $counter++;
                                        }
                                }

                                if ($counter > 1) 
                                { 
                                    echo("<td colspan='". (4 - $counter) ."'>&nbsp;</td></tr>"); 
                                }
                                echo "</tbody></table>";    
                            }
                         ?>
                    </div> <!--class col -->
                </div> <!--row-->
                <?php } ?>


                <?php if(!isset($user_profile)) { ?>
                    <script type="text/javascript"> var background_slideshow=true; </script>
                    <div class="row col-xs-12 col-sm-12 col-lg-12">
                        <div id="background-slideshow" class="img-responsive" style="max-width: 100%;height: auto;display:block;"></div>
                        <h2 class="login-text">Login with Facebook</h2>
                        <?php if(isset($login_url)) { ?> <a href="<?php echo $login_url; ?>" class="btn btn-lg btn-primary btn-block login-button" role="button">Login</a> <?php } ?>
                    </div>
                <?php } ?>

        <?php if(isset($user_profile)) { ?>
            <div class="row">
                <footer>            
                    <h3> By Anuj Shah </h3>
                    <a href="http://anujshah.in" target="_blank"><h4>anujshah.in</h4></a>
                </footer>
            </div>
        <?php } ?>   
    </div> <!-- /container -->



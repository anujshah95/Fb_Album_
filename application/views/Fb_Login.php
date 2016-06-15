
    <div class="container">
        <form class="form-signin" role="form">
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

                        <div class="albums_list">
                        <?php
                            echo "<div class='row pull-right'>";
                                echo "<a href='#' onClick=\"download_selected_albums()\">
                                        <button type='button' class='btn btn-primary btn-md'>
                                            <span class='glyphicon glyphicon-download-alt'></span> 
                                            Download Selected
                                        </button>
                                        </a>";
                                echo "<a href='#' onClick=\"download_All_Album()\">
                                        <button type='button' class='btn btn-primary btn-md'>
                                            <span class='glyphicon glyphicon-download-alt'></span> 
                                            Download All Albums
                                        </button>
                                        </a>";
                            echo "</div>";
                                  
                            if(isset($albums))
                            {
                                $counter=1;
                                echo "<table><tbody>";

                                foreach($albums['data'] as $album)  
                                {
                                    if ($counter == 1) {
                                        echo "<tr>";
                                    }
                                            echo "<td style='text-align:center' class='user_albums'>";
                                                $id=$album['id'];
                                                $album_name=$album['name'];
                                                echo "<a href='#' onClick='getPhotos(".$id.")'> 
                                                        <img class='img-thumbnail ' alt=".$album['name']." src=".$album['picture']['data']['url']." style='width: 200px; height: 200px;'>
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
                         </div>
                    <!-- </div> -->
                </div>


                    <?php                        
                            }
                        ?>
                <?php if(!isset($user_profile))
                    {
                ?>
                <script type="text/javascript"> var background_slideshow=true; </script>
                <div class="row">
                    <div id="background-slideshow" ></div>
                    <h2 class="form-signin-heading login-text">Login with Facebook</h2>
                    <?php if(isset($login_url)) { ?> <a href="<?= $login_url ?>" class="btn btn-lg btn-primary btn-block loginButton" role="button">Login</a> <?php } ?>
                </div>
                <?php 
                    } 
                ?>

        </form>

                <?php if(isset($user_profile))
                {
                ?>
                    <div class="row">
                    <footer>            
                        <h3> By Anuj Shah </h3>
                        <a href="http://anujshah.in" target="_blank"><h4>anujshah.in</h4></a>
                    </footer>
                    </div>
                <?php
                    }
                ?>   
    </div> <!-- /container -->



<body>
    <div class="container">
        <div id="loading" class="loadingPage"></div>
        <div id="pace" class="pace"></div>

        <form class="form-signin" role="form">
            <?php if (@$user_profile): ?>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <img class="img-thumbnail" data-src="holder.js/140x140" alt="140x140" src="https://graph.facebook.com/<?=$user_profile['id']?>/picture?type=large" 
                            style="width: 140px; height: 140px;">
                        <h2><?=$user_profile['name']?></h2>

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

                        <div class="user_details">
                        <?php
                            // if(isset($albums))
                            //     echo "<pre>";
                            //       print_r($albums);
                            //     echo "</pre>";
                            echo "<div class='row pull-right'>";
                                // echo "<div class='checkbox'><label><input type='checkbox' class='check' id='selectAll_Albums'>Select All</label>";
                                // echo "  <button type='button' class='btn btn-primary btn-md'>
                                //             <span class='glyphicon'></span> 
                                //             Select All
                                //         </button>";
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
                            // echo "</div>";
                            echo "</div>";
                            // echo "<a href='#' onClick=\"download_All_Album1()\">
                            //         <button type='button' class='btn btn-primary btn-lg'>
                            //             <span class='glyphicon glyphicon-download-alt'></span> 
                            //             Download All1
                            //         </button>
                            //         </a>";                                    
                            if(isset($albums))
                            {
                                $counter=1;
                                echo "<table><tbody>";

                                foreach($albums['data'] as $album)  
                                {
                                    if ($counter == 1) {
                                        echo "<tr>";
                                    }
                                            echo "<td style='text-align:center'>";
                                                $id=$album['id'];
                                                $album_name=$album['name'];
                                                // echo "<a href='Fb_Login/album_photos1/$id'>".$id."</a>";
                                                echo "<a href='#' onClick='getPhotos(".$id.")'> 
                                                        <img class='img-thumbnail' alt=".$album['name']." src=".$album['picture']['data']['url']." style='width: 200px; height: 200px;'>
                                                    </a><br><br>";
                                                echo "<div class='checkbox'><input type='checkbox' value='".$id."' name='album_id'>";
                                                echo "<a href='#' onClick='getPhotos(".$id.")'>".$album['name']." (".$album['count'].")"."</a></div><br><br>";
                                                echo "<a href='#' onClick=\"download_Album(".$id.",'".$album['name']."')\"><button type='button' class='btn btn-primary btn-sm'><span class='glyphicon glyphicon-download-alt'></span> Download This Album</button></a>";
                                            echo "</td>";

                                        if ($counter == 4) { 
                                        echo("</tr>");
                                        $counter = 1;
                                        } else {
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

                        <a href="<?=$user_profile['link']?>" target="_blank" class="btn btn-lg btn-default btn-block" role="button">View Profile</a>
                        <?php if(isset($logout_url)) { ?> <a href="<?= $logout_url ?>" class="btn btn-lg btn-primary btn-block" role="button">Logout</a> <?php } ?>
                    </div>
                </div>
            <?php else: ?>
                <h2 class="form-signin-heading">Login with Facebook</h2>
                <?php if(isset($login_url)) { ?> <a href="<?= $login_url ?>" class="btn btn-lg btn-primary btn-block" role="button">Login</a> <?php } ?>
            <?php endif; ?>
        </form>
    </div> <!-- /container -->



<body>
    <div class="container">
        <div id="loading" class="loadingPage"></div>

        <form class="form-signin" role="form">
            <?php if (@$user_profile): ?>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <img class="img-thumbnail" data-src="holder.js/140x140" alt="140x140" src="https://graph.facebook.com/<?=$user_profile['id']?>/picture?type=large" 
                            style="width: 140px; height: 140px;">
                        <h2><?=$user_profile['name']?></h2>

                        <div id="album_photos">
                            <div id="blueimp-gallery" class="blueimp-gallery" data-use-bootstrap-modal="false" >
                                <div class="slides"></div>
                                <h3 class="title"></h3>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="close">×</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>
                                <div class="modal fade">
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
                            // if(isset($user_profile))
                            //     echo "<pre>";
                            //       print_r($user_profile);
                            //     echo "</pre>";
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
                                                echo "<a href='Fb_Login/album_photos1/$id'>".$id."</a>";
                                                
                                                echo "<a href='#' onClick='getPhotos(".$id.")'> 
                                                        <img class='img-thumbnail' alt=".$album['name']." src=".$album['picture']['data']['url']." style='width: 200px; height: 200px;'>
                                                    </a><br><br>";
                                                echo "<a href='#' onClick='getPhotos(".$id.")'>".$album['name']." (".$album['count'].")"."</a><br><br>";
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
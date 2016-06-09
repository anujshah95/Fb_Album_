<body>
    <div class="container">
        <div id="loading" class="loadingPage">
            <!-- <i class="fa fa-spinner fa-spin fa-3x"></i> -->
        </div>

        <form class="form-signin" role="form">
            <?php if (@$user_profile): ?>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <img class="img-thumbnail" data-src="holder.js/140x140" alt="140x140" src="https://graph.facebook.com/<?=$user_profile['id']?>/picture?type=large" 
                            style="width: 140px; height: 140px;">
                        <h2><?=$user_profile['name']?></h2>
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
                                                echo "<img class='img-thumbnail' alt=".$album['name']." src=".$album['picture']['data']['url']." style='width: 200px; height: 200px;' onClick='getPhotos(".$id.")'><br><br>";
                                                echo $album['name']."<br><br>";
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

                         <div id="album_photos">


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
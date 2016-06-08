<html>
<head>
    <title>Login with Facebook</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>

<body>
    <div class="container">
        <form class="form-signin" role="form">
            <?php if (@$user_profile): ?>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <img class="img-thumbnail" data-src="holder.js/140x140" alt="140x140" src="https://graph.facebook.com/<?=$user_profile['id']?>/picture?type=large" 
                            style="width: 140px; height: 140px;">
                        <h2><?=$user_profile['name']?></h2>
                        <div class="user_details">
                        <?php
                            if(isset($user_profile))
                                echo "<pre>";
                                  print_r($user_profile);
                                echo "</pre>";
                         ?>
                         </div>

                        <a href="<?=$user_profile['link']?>" target="_blank" class="btn btn-lg btn-default btn-block" role="button">View Profile</a>
                        <a href="<?= $logout_url ?>" class="btn btn-lg btn-primary btn-block" role="button">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <h2 class="form-signin-heading">Login with Facebook</h2>
                <a href="<?= $login_url ?>" class="btn btn-lg btn-primary btn-block" role="button">Login</a>
            <?php endif; ?>
        </form>
    </div> <!-- /container -->

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.2.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>

</body>
</html>
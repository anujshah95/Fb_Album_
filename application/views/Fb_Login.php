<html>
<head>
    <title>Login with Facebook</title>
<<<<<<< HEAD
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
</head>

<body>
=======
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <style type="text/css">
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee;
    }

    .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
    }
    .form-signin .form-signin-heading{
        padding-bottom: 10px;
        margin-bottom: 20px;
        border-bottom: 1px #ccc dotted;
        text-align: center;
    }
    .form-signin .footer{
        padding-top: 10px;
        margin-top: 20px;
        border-top: 1px #ccc dotted;
        font-weight: 600;
    }
    .fa {
        color: #cc0000;
    }
    .user_details{
        width: 1300px;
        margin-left: -500px;
    }
    </style>
</head>
<body>

>>>>>>> 16880e025fc55b6c27584eaf89ab19873c1cb0ed
    <div class="container">
        <form class="form-signin" role="form">
            <?php if (@$user_profile): ?>
                <div class="row">
                    <div class="col-lg-12 text-center">
<<<<<<< HEAD
                        <img class="img-thumbnail" data-src="holder.js/140x140" alt="140x140" src="https://graph.facebook.com/<?=$user_profile['id']?>/picture?type=large" 
                            style="width: 140px; height: 140px;">
=======
                        <img class="img-thumbnail" data-src="holder.js/140x140" alt="140x140" src="https://graph.facebook.com/<?=$user_profile['id']?>/picture?type=large" style="width: 140px; height: 140px;">
>>>>>>> 16880e025fc55b6c27584eaf89ab19873c1cb0ed
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
<<<<<<< HEAD

=======
>>>>>>> 16880e025fc55b6c27584eaf89ab19873c1cb0ed
            <?php else: ?>
                <h2 class="form-signin-heading">Login with Facebook</h2>
                <a href="<?= $login_url ?>" class="btn btn-lg btn-primary btn-block" role="button">Login</a>
            <?php endif; ?>
        </form>
<<<<<<< HEAD
    </div> <!-- /container -->

    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-2.2.4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
=======


    </div> <!-- /container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
>>>>>>> 16880e025fc55b6c27584eaf89ab19873c1cb0ed
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Facebook Album</title>

    <link href="<?php echo base_url(); ?>assets/images/fb_icon.png" rel='shortcut icon' >
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
	<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
	<link rel="stylesheet" href="<?php echo base_url('assets/blueimp/css/bootstrap-image-gallery.min.css'); ?>" >
    <link rel="stylesheet" href="<?php echo base_url('assets/alertifyjs/css/alertify.css'); ?>" type="text/css" />
    
    <style type="text/css">
    .loadingPage {
    background-color: #333;
    opacity: 0.8;
    position: absolute;
    left: 0px;
    top: 0px;
    z-index: 100;
    height: 2000px;
    width: 100%;
    overflow: hidden;
    background-image: url("<?php echo base_url('assets/images/loading.gif'); ?>");
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    }

    /*    
    .user_albums a:hover:after {
    content: url("<?php //echo base_url('assets/images/loading.gif'); ?>");
    display: block;
    }
    */
   </style>
</head>

<body>
    <div id="loading" class="loadingPage"></div>
    <nav class="navbar navbar-inverse navbar-fixed-top fb_navbar">
        <div class="container-fluid">
            <div class="navbar-header" >
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>" style='color:white;font-size: 20px;'>Facebook Album</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: white;">
                        <?php if(isset($user_profile)) { ?>
                            <img alt="<?php echo $user_profile['name'] ?>" src="https://graph.facebook.com/<?=$user_profile['id']?>/picture?type=large" style="width: 30px; height: 30px;">
                            <?php echo $user_profile['name']; ?> <span class="caret"></span></a>
                        <?php } ?>
                    
                    <ul class="dropdown-menu" >
                        <li><a href="<?php echo base_url('Fb_Login/Profile'); ?>"><i class="glyphicon glyphicon-user"> Profile </i></a></li>
                        <li role="separator" class="divider"></li>
                        <?php if(isset($logout_url)) { ?>
                            <li><a href="<?php echo $logout_url; ?>"><i class="glyphicon glyphicon-log-out"> Logout</i></a></li>
                        <?php } ?>
                    </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
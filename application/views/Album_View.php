<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" href="<?php echo base_url('assets/jquery.bxslider/jquery.bxslider.css'); ?>">

</head>
<body>
<!-- Start WOWSlider.com BODY section -->

<script type="text/javascript" src="engine1/wowslider.js"></script>
<script type="text/javascript" src="engine1/script.js"></script>
<!-- End WOWSlider.com BODY section -->


<?php

if(isset($album_photos))
{
	echo "<ul class='bxslider'>";
	foreach ($album_photos['data'] as $album_photo)
	{
		echo "<li><img class='img-thumbnail' alt='yeah' src=".$album_photo['source']." ><li><br><br>";
		// echo "<img class='img-thumbnail' alt='yeah' src=".$album_photo['source']." style='width: 200px; height: 200px;'><br><br>";
	}
	echo "</ul>";
}

// if(isset($album_photos))
// {
// 	foreach ($album_photos['data'] as $album_photo)
// 	{
// 		echo "<li><img class='img-thumbnail' alt='yeah' src=".$album_photo['source']." ><li><br><br>";
// 		// echo "<img class='img-thumbnail' alt='yeah' src=".$album_photo['source']." style='width: 200px; height: 200px;'><br><br>";
// 	}
// }

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/jquery.bxslider/jquery.bxslider.min.js'); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('.bxslider').bxSlider();
});
</script>
    </body>
</html>

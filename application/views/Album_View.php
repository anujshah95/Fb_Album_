<?php
	if(isset($album_photos))
{
	echo "<pre>";
		// print_r($album_photos);
		// echo "<img class='img-thumbnail' alt='yeah' src=".$album_photos['data'][0]['picture']." style='width: 200px; height: 200px;'><br><br>";
	echo "</pre>";

	foreach ($album_photos['data'] as $album_photo)
	{
		echo "<img class='img-thumbnail' alt='yeah' src=".$album_photo['source']." style='width: 200px; height: 200px;'><br><br>";
		// echo "<pre>";
		// print_r($album_photo);
		// echo "</pre>";
	}
}

?>
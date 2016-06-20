 <?php

/**
* File: Profile.php
* 
* PHP version 5.5.9
*
* @category View
* @package  Fb_Album_
* @author   Anuj Shah <anuj.shah95@gmail.com>
* @license  anujshah.in http://anujshah.in/Fb_Album/
* @link     http://anujshah.in/Fb_Album/
*/

?>
<?php if (isset($user_profile)) { ?>
    <div class="container">
	  	<div class="row">
			<img alt="Cover_Photo" src="<?php if(isset($user_profile['cover']['source'])) echo $user_profile['cover']['source'] ?>" class="img-responsive cover_photo"><br>
			<img class="profile_picture img-thumbnail img-responsive" alt="<?php if(isset($user_profile['first_name'])) echo $user_profile['first_name'] ?>" 
				src="https://graph.facebook.com/<?php echo $user_profile['id']; ?>/picture?type=large">
			<h2 class="profile_name"><?php if(isset($user_profile['name'])) echo $user_profile['name'] ?></h2>
		</div>

		<div class="row">
			<table align="center" class="col-lg-12 table basic_information">
				<thead>        
					<tr align="center"><th colspan="2"><h2 class="text-center">Basic Information</h2></th></tr>
				</thead>
				        
				<tbody>
					<tr><td>User id </td><td><?php if (isset($user_profile['id'])) echo $user_profile['id'] ?></td></tr>
			        <tr><td>First Name </td><td><?php if (isset($user_profile['first_name'])) echo $user_profile['first_name'] ?></td></tr>
					<tr><td>Last Name </td><td><?php if (isset($user_profile['last_name'])) echo $user_profile['last_name'] ?></td></tr>				
					<tr><td>Age Range </td><td><?php if (isset($user_profile['age_range'])) echo $user_profile['age_range']['min'] ?></td></tr>            
			        <tr><td>Gender </td><td><?php if (isset($user_profile['gender'])) echo $user_profile['gender'] ?></td></tr>     
					<tr><td>Verfied </td><td><?php if (isset($user_profile['verified'])) {if($user_profile['verified']==1) echo "Yes";}?></td></tr>     
			        <tr><td>Total Albums </td><td><?php if (isset($user_profile['albums'])) echo count($user_profile['albums']['data']) ?></td></tr>                 
			        <tr><td>Total Photos </td><td><?php if (isset($user_photos)) echo count($user_photos['data']) ?></td></tr>
			        <tr><td>Currency </td><td><?php if (isset($user_profile['currency'])) echo $user_profile['currency']['user_currency'] ?></td></tr>
			        <tr><td>Email </td><td><?php if (isset($user_profile['email'])) echo $user_profile['email'] ?></td></tr>
			        <tr><td>Currency </td><td><?php if (isset($user_profile['currency'])) echo $user_profile['currency']['user_currency'] ?></td></tr>
				</tbody>
			 </table>
	    </div><br><br>
		
		<?php if (isset($user_profile['link'])) { ?>
			<div class="view_profile_btn"><a href="<?php echo $user_profile['link']; ?>" target="_blank" class="btn btn-lg btn-default btn-block" role="button">View Profile</a></div>
		<?php } ?>

	    <div>
	    	<footer>
				<h3> By Anuj Shah </h3>
				<a href="http://anujshah.in" target="_blank"><h4>anujshah.in</h4></a>
			 </footer>
	    </div>
    </div><!-- containe -->
	<?php } ?>
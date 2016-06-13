  	<?php if(isset($user_profile)) { ?>
  	<div class="my_profile"> 
		<img alt="Cover_Photo" src="<?php if(isset($user_profile['cover']['source'])) echo $user_profile['cover']['source'] ?>" class="cover_photo"><br>
		<img class="profile_picture img-thumbnail" alt="<?php if(isset($user_profile['first_name'])) echo $user_profile['first_name'] ?>" 
			src="https://graph.facebook.com/<?=$user_profile['id']?>/picture?type=large">
		<h2 class="profile_name"><?php if(isset($user_profile['name'])) echo $user_profile['name'] ?></h2>
	</div>	

	<div class="user_information table-responsive">
		<table class="table">
			<thead class="basic_information">        
				<tr><th colspan="2"><h2>Basic Information</h2></th></tr>
			</thead>
		        
			<tbody class="basic_information">
				<tr><td width="200px;">User id </td><td style="width: 500px;"><?php if(isset($user_profile['id'])) echo $user_profile['id'] ?></td></tr>
	            <tr><td>First Name </td><td><?php if(isset($user_profile['first_name'])) echo $user_profile['first_name'] ?></td></tr>
				<tr><td>Last Name </td><td><?php if(isset($user_profile['last_name'])) echo $user_profile['last_name'] ?></td></tr>				
				<tr><td>Age Range </td><td><?php if(isset($user_profile['age_range'])) echo $user_profile['age_range']['min'] ?></td></tr>            
	            <tr><td>Gender </td><td><?php if(isset($user_profile['gender'])) echo $user_profile['gender'] ?></td></tr>     
	            <tr><td>Verfied </td><td><?php if(isset($user_profile['verified'])) { if($user_profile['verified']==1) echo "Yes"; } ?></td></tr>     
	            <tr><td>Total Albums </td><td><?php if(isset($user_profile['albums'])) echo count($user_profile['albums']['data']) ?></td></tr>                 
	            <tr><td>Total Photos </td><td><?php if(isset($user_photos)) echo count($user_photos['data']) ?></td></tr>
	            <tr><td>Currency </td><td><?php if(isset($user_profile['currency'])) echo $user_profile['currency']['user_currency'] ?></td></tr>
	            <tr><td>Email </td><td><?php if(isset($user_profile['email'])) echo $user_profile['email'] ?></td></tr>
	            <tr><td>Currency </td><td><?php if(isset($user_profile['currency'])) echo $user_profile['currency']['user_currency'] ?></td></tr>
			</tbody>
		</table>
		<?php if(isset($user_profile['link'])) { ?><a href="<?= $user_profile['link'] ?>" target="_blank" class="btn btn-lg btn-default btn-block basic_information" role="button">View Profile</a>
		<?php } ?>
    </div>                         		
	<?php 
	} 
	?>
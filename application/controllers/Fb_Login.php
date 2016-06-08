<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fb_Login extends CI_Controller {

	public function __construct()
    {
		parent::__construct();

	}

	public function index()
    {   
		$this->load->library('facebook'); // Automatically picks appId and secret from config
		$user = $this->facebook->getUser();

<<<<<<< HEAD
        
=======
>>>>>>> 16880e025fc55b6c27584eaf89ab19873c1cb0ed
        if ($user) 
        {
            try 
            {
                $data['user_profile'] = $this->facebook->api('/me?fields=id,name,first_name,last_name,age_range,link,gender,locale,picture,timezone,updated_time,verified,albums');
                if(isset($_GET['code'])) $data['code']=$_GET['code'];

<<<<<<< HEAD


    // $albums = $this->facebook->api('/me/albums');
    // $totalPhotoOfAlbum = array(); // To store total number of photos of each Album

    // print_r($albums);
    // echo $this->facebook->getAccessToken();
    // echo "<br>";
    // print_r($this->facebook->api('/me/albums'));
    //  Counting Total photos of each Album and storing in an array
    // foreach($albums['data'] as $album){
        
    //     $count = 0;
    //     $photos = $facebook->api("/{$album['id']}/photos");
        
    //     foreach($photos['data'] as $photo)
    //         $count = $count + 1;
            
    //     $totalPhotoOfAlbum[] = $count; // store no. of photos in array of an album

// $access_token=$this->facebook->getAccessToken();
// $yo=$this->facebook->api('/me/albums?access_token='.$access_token); 

// echo "<pre>";
// print_r($yo);
// echo "</pre>";
// echo "<br><br>";

// echo "<pre>";
// $per = $this->facebook->api('/me/permissions'); 
// print_r($per);
// echo "</pre>";
// echo "<br><br>";

 // $albums = $this->facebook->api('/me/albums?fields=id'); 
 // echo "<pre>";
 // print_r( $this->facebook->api('/me/albums?fields=id'));
 // echo "</pre>";
 //  $pictures = array();
 //  foreach ($albums['data'] as $album) {
 //    $pics = $this->facebook->api('/'.$album['id'].'/photos?fields=source,picture');
 //    $pictures[$album['id']] = $pics['data'];
 //  }

 //  //display the pictures url
 //  $output="";
 //  foreach ($pictures as $album) {
 //    //Inside each album
 //    foreach ($album as $image) {

 //      $output .= $image['source'] . '<br />';
 //    }
 //  }
 //  print_r($output);

        // $albums1 = $this->facebook->api('/me/photos');
        // echo "<br>";
        // echo "<pre>";
        // print_r($albums1);
        // echo "</pre>";
        // foreach($albums1['data'] as $album)  
        // {
        //     print ('<a href="albumPhotos.php?album_id='.$album['id'].'">'.$album['name'].'</a>'.'</br>' ) ;
        // }
=======
                // $albums = $this->facebook->api('/me/albums');
                // $totalPhotoOfAlbum = array(); // To store total number of photos of each Album
                // echo "<br>";
                // print_r($this->facebook->api('/me/albums'));
                //  Counting Total photos of each Album and storing in an array
                // foreach($albums['data'] as $album){
                //     $count = 0;
                //     $photos = $facebook->api("/{$album['id']}/photos");
                
                //     foreach($photos['data'] as $photo)
                //         $count = $count + 1;
                //     $totalPhotoOfAlbum[] = $count; // store no. of photos in array of an album

                // $access_token=$this->facebook->getAccessToken();
                // $access_token_Help=$this->facebook->api('/me/albums?access_token='.$access_token); 
                // print_r($access_token_Help);
                // echo "<br><br>";
                
                // echo "<pre>";
                //     $perm = $this->facebook->api('/me/permissions'); 
                //     print_r($perm);
                // echo "</pre>";
                // echo "<br><br>";

                // $albums = $this->facebook->api('/me/albums?fields=id'); 
                // print_r($this->facebook->api('/me/albums?fields=id'));
                // $pictures = array();
                
                // foreach ($albums['data'] as $album) 
                // {
                //     $pics = $facebook->api('/'.$album['id'].'/photos?fields=source,picture');
                //     $pictures[$album['id']] = $pics['data'];
                // }

                // //display the pictures url
                // foreach ($pictures as $album) 
                // {
                //     //Inside each album
                //     foreach ($album as $image) 
                //     {
                //         $output .= $image['source'] . '<br />';
                //         print_r($output);
                //     }
                // }
>>>>>>> 16880e025fc55b6c27584eaf89ab19873c1cb0ed
            } 
            catch (FacebookApiException $e) 
            {
                $user = null;
            }
        }
        else 
        {
<<<<<<< HEAD
            // Solves first time login issue. (Issue: #10)
=======
>>>>>>> 16880e025fc55b6c27584eaf89ab19873c1cb0ed
            //$this->facebook->destroySession();
        }
      
        if ($user) 
        {
            $data['logout_url'] = base_url('Fb_Login/logout');
        } 
        else 
        {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => base_url('Fb_Login'),
<<<<<<< HEAD
                // 'scope' => array("email,user_friends,user_likes,user_photos,publish_actions") // permissions here
                'scope' => array("user_photos") // permissions here
=======
                // 'scope' => array("email,user_friends,user_likes,user_photos,publish_actions") // permissions 
                'scope' => array("user_photos") // permissions 
>>>>>>> 16880e025fc55b6c27584eaf89ab19873c1cb0ed
            ));
        }
        $this->load->view('Fb_Login',$data);
	}

    function logout()
    {
        $this->load->library('facebook');
        $this->facebook->destroySession();
        redirect('Fb_Login');
    }
}

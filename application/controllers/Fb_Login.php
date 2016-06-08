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
        
        if ($user) 
        {
            try 
            {
                $data['user_profile'] = $this->facebook->api('/me?fields=id,name,first_name,last_name,age_range,link,gender,locale,picture,timezone,updated_time,verified,albums');
                // if(isset($_GET['code'])) $data['code']=$_GET['code'];
                
                //--------------------------------------------------------------------------------------------------------------------------

                // // Fetch through accessToken 
                // $access_token=$this->facebook->getAccessToken();
                // $albums=$this->facebook->api('/me/albums?access_token='.$access_token); 
                // $albums = $this->facebook->api('/me/albums');
                // echo "<pre>";
                // print_r($albums);
                // echo "</pre>";
                //--------------------------------------------------------------------------------------------------------------------------

                // To display all permissions which are granted or declined
                // echo "<pre>";
                    // $per = $this->facebook->api('/me/permissions'); 
                    // print_r($per);
                // echo "</pre>";

                //--------------------------------------------------------------------------------------------------------------------------

                // $albums = $this->facebook->api('/me/albums?fields=id'); 
                // echo "<pre>";
                //     print_r( $this->facebook->api('/me/albums?fields=id'));
                // echo "</pre>";
                //  $pictures = array();
                //  foreach ($albums['data'] as $album) {
                //    $pics = $this->facebook->api('/'.$album['id'].'/photos?fields=source,picture');
                //    $pictures[$album['id']] = $pics['data'];
                //  }

                // //display the pictures url
                // $output="";
                // foreach ($pictures as $album) 
                // {
                //     //Inside each album
                //     foreach ($album as $image) 
                //     {
                //       $output .= $image['source'] . '<br />';
                //     }
                // }
                // echo "<pre>";
                // print_r($output);
                // echo "</pre>";

                //--------------------------------------------------------------------------------------------------------------------------
                
                $albums = $this->facebook->api('/me/albums?fields=id,name,created_time,picture');
                $data['albums']=$albums;
                // echo "<br>";
                // echo "<pre>";
                // print_r($albums);
                // echo "</pre>";
                // foreach($albums['data'] as $album)  
                // {
                //     print ('<a href="albumPhotos.php?album_id='.$album['id'].'">'.$album['name'].'</a>'.'</br>' ) ;
                // }

            } 
            catch (FacebookApiException $e) 
            {
                $user = null;
            }
        }
        else 
        {
            // Solves first time login issue. (Issue: #10)

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
                // 'scope' => array("email,user_friends,user_likes,user_photos,publish_actions") // permissions here
                'scope' => array("user_photos") // permissions here
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

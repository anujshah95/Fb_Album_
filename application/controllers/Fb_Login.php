<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fb_Login extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
        $this->load->library('facebook'); // Automatically picks appId and secret from config
	}

	public function index()
    {   
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

                // $albums = $this->facebook->api('/me/albums?fields=id,name'); 
                // $pictures = array();
                //  foreach ($albums['data'] as $album) 
                //  {
                //    $pics = $this->facebook->api('/'.$album['id'].'/photos?fields=name.limit(5),source.limit(5),picture.limit(5)');
                //    echo "<pre>";
                //    print_r($pics);
                //    echo "</pre>";
                //    $pictures[$album['id']] = $pics['data'];
                //  }

                //  // echo "<pre>";
                //  // // print_r($this->facebook->api('/'.$albums['id'].'/photos?fields=source,picture'));
                //  // echo "</pre>";

                //  $data['pictures']=$pictures;
                // // display the pictures url
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
                
                $albums = $this->facebook->api('/me/albums?fields=id,name,created_time,picture,source,count');
                // echo "<pre>";
                //     print_r($albums);
                // echo "</pre>";
                $data['albums']=$albums;
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
        $this->load->view('header');
        $this->load->view('Fb_Login',$data);
        $this->load->view('footer');
	}

    function album_photos()
    {
        $album_id=$_POST['album_id'];
        $user = $this->facebook->getUser();
        $album_photos=$this->facebook->api('/'.$album_id.'/photos?fields=name,source,picture');
        $album_photos_url = array();
        // $photos_name = array();
        
        foreach ($album_photos['data'] as $album_photo)
        {
            // if(isset($album_photo['name']))
            // {
            //     $photos_name[]=$album_photo['name']; 
            // }
            // if(!isset($album_photo['name']))
            // {
            //     // $album['name']='';
            //     $photos_name[]="";
            //     continue;
            // }

            $album_photos_url[]=$album_photo['source'];
        }        
        // $this->output->set_header('Content-Type: application/json; charset=utf-8');
        // echo json_encode(array('album_photos_url' => $album_photos_url,'photos_name' => $photos_name));
        echo json_encode(array('album_photos_url' => $album_photos_url));
    }

    function download_Album($album_id)
    {
        $user = $this->facebook->getUser();
        $album_photos=$this->facebook->api('/'.$album_id.'/photos?fields=name,source,picture');
        $album_photos_url = array();
        
        if (!file_exists('assets/downloads/'.$album_id)) {
            mkdir('assets/downloads/'.$album_id, 0777, true);
        }

        foreach ($album_photos['data'] as $album_photo)
        {
            $album_photos_url[]=$album_photo['source'];
            $name = $album_photo['id'].".jpg";
            copy($album_photo['source'],$_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album_id."/".$album_photo['id'].".jpg");
        }        
            $current_time=date('Y-m-d_H:i:s');
            $path = $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album_id;
            $this->zip->read_dir($path); 
            $this->zip->archive($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/zip_files/'.$album_id.'_'.$current_time.'.zip');
    }

    function logout()
    {
        $this->load->library('facebook');
        $this->facebook->destroySession();
        redirect('Fb_Login');
    }
}

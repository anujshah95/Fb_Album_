<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fb_Login extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
        $this->load->library('facebook'); 
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
                
                $albums = $this->facebook->api('/me/albums?fields=id,name,created_time,picture,count&limit=100');
                $data['albums']=$albums;
            } 

            catch (FacebookApiException $e) 
            {
                $user = null;
            }
        }
        else 
        {
            //$this->facebook->destroySession();
        }
      
        if ($user) 
        {
            $data['logout_url'] = base_url('Fb_Login/logout');
        } 
        else 
        {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => base_url('Fb_Login')
                // 'scope' => array("email,user_friends,user_likes,user_photos,publish_actions") // permissions here
                // 'scope' => array("user_photos") // permissions here
            ));
        }

        $this->load->view('header',$data);
        $this->load->view('Fb_Login',$data);
        $this->load->view('footer');
	}

    function album_photos()
    {
        $album_id=$_POST['album_id'];
        if(!$album_id)
            redirect('Fb_Login');
        $user = $this->facebook->getUser();
        $album_photos=$this->facebook->api('/'.$album_id.'/photos?fields=name,source,picture&limit=1000');
        $album_photos_url = array();
        $photos_name = array();
        
        foreach ($album_photos['data'] as $album_photo)
        {
            $album_photos_url[]=$album_photo['source'];
            if(isset($album_photo['name']))
            {
                $photos_name[]=$album_photo['name']; 
            }
            if(!isset($album_photo['name']))
            {
                // $album['name']='';
                $photos_name[]="";
                continue;
            }
        }        
        // $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array('album_photos_url' => $album_photos_url,'photos_name' => $photos_name));
        // echo json_encode(array('album_photos_url' => $album_photos_url));
    }

    function download_Album()
    {
        $album_id=$_POST['album_id'];
        if(!$album_id)
            redirect('Fb_Login');        
        $album_name=$_POST['album_name'];
        $album_name = str_replace(' ', '_', $album_name);

        $user = $this->facebook->getUser();
        $album_photos=$this->facebook->api('/'.$album_id.'/photos?fields=name,source,picture&limit=1000');

        $album_photos = array_filter($album_photos);

        if (empty($album_photos)) 
        {
           echo json_encode(array('no_photos_in_side_album' => 'no_photos_in_side_album'));
           exit();
        }

        $album_photos_url = array();
        
        if (!file_exists('assets/downloads/'.$album_name)) {
            mkdir('assets/downloads/'.$album_name, 0777, true);
        }

        foreach ($album_photos['data'] as $album_photo)
        {
            $album_photos_url[]=$album_photo['source'];
            $name = $album_photo['id'].".jpg";
            copy($album_photo['source'],$_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album_name."/".$album_photo['id'].".jpg");
            chmod($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album_name,0777);            
            chmod($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album_name."/".$album_photo['id'].".jpg",0777);            
        }        
            $current_time=date('Y-m-d_H:i:s');
            $download_zip_file_name=$album_name."_".$current_time;
            
            $path = $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album_name;
            $this->zip->read_dir($path,FALSE); 
            $this->zip->archive($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/zip_files/'.$download_zip_file_name.'.zip');

            $path = $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album_name;
            chmod($path, 0777);
            delete_files($path, true);
            rmdir($path);
            
            $data = array(
                'download_zip_file_link' => base_url()."assets/downloads/zip_files/".$download_zip_file_name.".zip"
            );

            $this->session->set_userdata($data);  

        echo json_encode(array('download_zip_file_name' => 'download_zip_file_name'));
    }

    function download_All_Album()
    {
        $download_All_Album_value=$_POST['download_All_Album_value'];

        if(!$download_All_Album_value)
            redirect('Fb_Login');

        $user = $this->facebook->getUser();
        $albums = $this->facebook->api('/me/albums?fields=id,name,created_time,picture,count&limit=100');
        
        foreach ($albums['data'] as $album) 
        {
            if (!file_exists('assets/downloads/'.$album['name'])) 
            {
                mkdir('assets/downloads/'.$album['name'], 0777, true);
            }

            $pics = $this->facebook->api('/'.$album['id'].'/photos?fields=name,source,picture&limit=1000');

            foreach($pics['data'] as $pic)
            {
                $name = $album['id'].".jpg";
                copy($pic['source'],$_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name']."/".$pic['id'].".jpg");
                chmod($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name'],0777);                
                chmod($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name']."/".$pic['id'].".jpg",0777);
            }

            $path = $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name'];
            $this->zip->read_dir($path,FALSE); 
        }
        
        $current_time=date('Y-m-d_H:i:s');
        $download_all_album_zip_file_name="download_all_albums"."_".$current_time;
        $this->zip->archive($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/zip_files/'.$download_all_album_zip_file_name.'.zip');

        foreach($albums['data'] as $album) 
        {
            $path = $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name'];
            chmod($path, 0777);
            delete_files($path, true);
            rmdir($path);
        }

            $data = array(
                'download_zip_file_link' => base_url()."assets/downloads/zip_files/".$download_all_album_zip_file_name.".zip"
            );

            $this->session->set_userdata($data);  

        echo json_encode(array('download_all_album_zip_file_name' => 'download_all_album_zip_file_name'));        
    }

    function download_selected_albums()
    {
        $download_selected_albums_value=$_POST['download_selected_albums_value'];
        if(!$download_selected_albums_value)
            redirect('Fb_Login');

        $album_id_array=$_POST['album_id_array'];
        // $album_id_array=explode(',', $album_id_array);
        $user = $this->facebook->getUser();
        
        foreach($album_id_array as $album_id)
        {
            $album = $this->facebook->api('/'.$album_id.'?fields=id,name,created_time,picture,count');

            if (!file_exists('assets/downloads/'.$album['name'])) 
            {
                mkdir('assets/downloads/'.$album['name'], 0777, true);
            }            
            $pics = $this->facebook->api('/'.$album['id'].'/photos?fields=name,source,picture&limit=1000');                    

            foreach($pics['data'] as $pic)
            {   
                $name = $album['id'].".jpg";
                copy($pic['source'],$_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name']."/".$pic['id'].".jpg");
                chmod($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name'],0777);                
                chmod($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name']."/".$pic['id'].".jpg",0777);
            }
            $path = $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name'];
            $this->zip->read_dir($path,FALSE); 
        }

        $current_time=date('Y-m-d_H:i:s');
        $download_selected_album_zip_file_name="download_selected_albums"."_".$current_time;
        $this->zip->archive($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/zip_files/'.$download_selected_album_zip_file_name.'.zip'); 


        foreach($album_id_array as $album_id)
        {
            $album = $this->facebook->api('/'.$album_id.'?fields=id,name,created_time,picture,count');
            $path = $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name'];
            chmod($path, 0777);
            delete_files($path, true);
            rmdir($path);
        }

        $data = array(
            'download_zip_file_link' => base_url()."assets/downloads/zip_files/".$download_selected_album_zip_file_name.".zip"
        );

        $this->session->set_userdata($data);  

        echo json_encode(array('download_selected_albums' => 'download_selected_albums'));                  

    }   

    // function download_zip_file()
    // {
    //     $download_zip_file_name=$this->session->userdata('download_zip_file_name').'.zip';
    //     $data = file_get_contents(base_url('assets/downloads/zip_files/'.$download_zip_file_name)); // Read the file's contents
    //     $name = $download_zip_file;
    //     force_download($name, $data);  
    //     $this->session->unset_userdata('download_zip_file_name');
    // }

    function Profile()
    {
     
        // $data['user_profile'] = $this->facebook->api('/me?fields=id,name,first_name,last_name,email,age_range,link,gender,locale,picture,timezone,updated_time,verified,albums,birthday,friends,about,bio,context,cover,currency,devices,education,favorite_athletes,favorite_teams,hometown,inspirational_people,installed,languages,location,middle_name,name_format,political,quotes,relationship_status,religion,significant_other,third_party_id,is_verified,website,work&limit=5000');
        // $data['user_photos'] = $this->facebook->api('/me/photos?&limit=5000');          
        $data['user_profile'] = $this->facebook->api('/me?fields=id,name,first_name,last_name,email,age_range,link,gender,locale,picture,timezone,updated_time,verified,albums,cover,currency,hometown&limit=5000');
        $data['user_photos'] = $this->facebook->api('/me/photos?&limit=5000'); 
        $data['logout_url'] = base_url('Fb_Login/logout');
        $user = $this->facebook->getUser();
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => base_url('Fb_Login'),
                // 'scope' => array("email,public_profile,user_friendsuser_about_me,user_photos,user_birthday,user_friends,user_location,user_likes,user_photos,publish_actions,user_education_history,user_hometown,user_location,user_website,user_work_history,manage_friendlists") // permissions here
                'scope' => array("email,public_profile,user_friends,user_hometown") // permissions here                
            ));           

        $this->load->view('header',$data);
        $this->load->view('Profile',$data);
        $this->load->view('footer');

    }

    function _404()
    {
        redirect('Fb_Login');
    }

    function logout()
    {
        $this->load->library('facebook');
        $this->facebook->destroySession();
        redirect('Fb_Login');
    }
}

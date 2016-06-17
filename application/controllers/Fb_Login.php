<?php 
/**
* File: Fb_Login.php
* 
* PHP version 5.5.9
*
* @category Controller
* @package  Fb_Album_
* @author   Anuj Shah <anuj.shah95@gmail.com>
* @license  anujshah.in http://anujshah.in/Fb_Album/
* @link     http://anujshah.in/Fb_Album/
*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class Fb_Login
 *
 * @category Class
 * @package  Fb_Album_
 * @author   Anuj Shah <anuj.shah95@gmail.com>
 * @license  anujshah.in http://anujshah.in/Fb_Album/
 * @link     http://anujshah.in/Fb_Album/
 *
 */
class Fb_Login extends CI_Controller
{
    /**
        * function __construct() 
        * allocating resources used in entire class ex. $this->load
        *
        * @return array
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('facebook/facebook'); 
    }

    /**
        * Function Name : index
        * index function to ask for login with facebook or display albums
        *
        * @return array
    */
    public function index()
    {
        $user = $this->facebook->getUser();
        if ($user) {
            try {
                $data['user_profile']=$this->facebook->api('/me?fields=id,name,first_name,last_name,age_range,link,gender,locale,picture,timezone,updated_time,verified,albums');
                $albums = $this->facebook->api('/me/albums?fields=id,name,created_time,picture,count&limit=100');
                $data['albums']=$albums;
            } 
            catch (FacebookApiException $e) {
                $user = null;
            }
        }

        if ($user) {
            $data['logout_url'] = base_url('Fb_Login/logout');
        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array('redirect_uri' => base_url('Fb_Login'),'scope' => array("email,user_photos"))); // permissions here   
        }

        $this->load->view('header', $data);
        $this->load->view('Fb_Login', $data);
        $this->load->view('footer');
    }

    /**
        * Function Name : albumPhotos
        * fetch the photos of album which is clicked by user.
        *
        * @return json
    */
    public function albumPhotos()
    {
        $album_id=$_POST['album_id'];
        if (!$album_id) {
            redirect('Fb_Login');
        }
        $user = $this->facebook->getUser();
        $album_photos=$this->facebook->api('/'.$album_id.'/photos?fields=name,source,picture&limit=1000');
        $album_photos_url = array();
        $photos_name = array();
        
        foreach ($album_photos['data'] as $album_photo) {
            $album_photos_url[]=$album_photo['source'];
            if (isset($album_photo['name'])) {
                $photos_name[]=$album_photo['name']; 
            }
            if (!isset($album_photo['name'])) {
                // $album['name']='';
                $photos_name[]="";
                continue;
            }
        }        
        echo json_encode(array('album_photos_url' => $album_photos_url,'photos_name' => $photos_name));
    }

    /**
        * Function Name : downloadAlbum
        * download single album to the server,create a zip of it and delete the folder.
        *
        * @return json
    */
    function downloadAlbum()
    {
        $album_id=$_POST['album_id'];
        if (!$album_id) {
            redirect('Fb_Login');        
        }
        $album_name=$_POST['album_name'];
        $album_name = str_replace(' ', '_', $album_name);

        $user = $this->facebook->getUser();
        $album_photos=$this->facebook->api('/'.$album_id.'/photos?fields=name,source,picture&limit=1000');

        $album_photos = array_filter($album_photos);

        if (empty($album_photos)) {
            echo json_encode(array('no_photos_in_side_album' => 'no_photos_in_side_album'));
            exit();
        }

        $album_photos_url = array();
        
        if (!file_exists('assets/downloads/'.$album_name)) {
            mkdir('assets/downloads/'.$album_name, 0777, true);
        }

        foreach ($album_photos['data'] as $album_photo) {
            $album_photos_url[]=$album_photo['source'];
            $name = $album_photo['id'].".jpg";
            copy($album_photo['source'], $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album_name."/".$album_photo['id'].".jpg");
            chmod($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album_name, 0777);            
            chmod($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album_name."/".$album_photo['id'].".jpg", 0777);            
        }        
            $current_time=date('Y-m-d_H:i:s');
            $download_zip_file_name=$album_name."_".$current_time;
            
            $path = $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album_name;
            $this->zip->read_dir($path, false); 
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

    /**
        * Function Name : downloadAllAlbum
        * download all albums of the user,create a zip of it and delete all folder.
        *
        * @return json
    */
    function downloadAllAlbum()
    {
        $download_All_Album_value=$_POST['download_All_Album_value'];

        if (!$download_All_Album_value) {
            redirect('Fb_Login');
        }

        $user = $this->facebook->getUser();
        $albums = $this->facebook->api('/me/albums?fields=id,name,created_time,picture,count&limit=100');

        if (empty($albums['data'])) {
            echo json_encode(array('no_albums_found' => 'no_albums_found'));
            exit();
        }
        
        foreach ($albums['data'] as $album) {
            if (!file_exists('assets/downloads/'.$album['name'])) {
                mkdir('assets/downloads/'.$album['name'], 0777, true);
            }

            $pics = $this->facebook->api('/'.$album['id'].'/photos?fields=name,source,picture&limit=1000');

            foreach ($pics['data'] as $pic) {
                $name = $album['id'].".jpg";
                copy($pic['source'], $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name']."/".$pic['id'].".jpg");
                chmod($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name'], 0777);                
                chmod($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name']."/".$pic['id'].".jpg", 0777);
            }

            $path = $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name'];
            $this->zip->read_dir($path, false); 
        }
        
        $current_time=date('Y-m-d_H:i:s');
        $download_all_album_zip_file_name="download_all_albums"."_".$current_time;
        $this->zip->archive($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/zip_files/'.$download_all_album_zip_file_name.'.zip');

        foreach ($albums['data'] as $album) {
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

    /**
        * Function Name : downloadSelectedAlbums
        * download selected albums of the user,create a zip of it and delete all folder.
        *
        * @return json
    */
    function downloadSelectedAlbums()
    {
        $download_selected_albums_value=$_POST['download_selected_albums_value'];
        if (!$download_selected_albums_value) {
            redirect('Fb_Login');
        }

        $album_id_array=$_POST['album_id_array'];
        // $album_id_array=explode(',', $album_id_array);
        $user = $this->facebook->getUser();
        
        foreach ($album_id_array as $album_id) {
            $album = $this->facebook->api('/'.$album_id.'?fields=id,name,created_time,picture,count');

            if (!file_exists('assets/downloads/'.$album['name'])) {
                mkdir('assets/downloads/'.$album['name'], 0777, true);
            }            
            $pics = $this->facebook->api('/'.$album['id'].'/photos?fields=name,source,picture&limit=1000');                    

            foreach ($pics['data'] as $pic) {   
                $name = $album['id'].".jpg";
                copy($pic['source'], $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name']."/".$pic['id'].".jpg");
                chmod($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name'], 0777);                
                chmod($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name']."/".$pic['id'].".jpg", 0777);
            }
            $path = $_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/'.$album['name'];
            $this->zip->read_dir($path, false); 
        }

        $current_time=date('Y-m-d_H:i:s');
        $download_selected_album_zip_file_name="download_selected_albums"."_".$current_time;
        $this->zip->archive($_SERVER['DOCUMENT_ROOT'].'/Fb_Album_/assets/downloads/zip_files/'.$download_selected_album_zip_file_name.'.zip'); 


        foreach ($album_id_array as $album_id) {
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

    /**
        * Function Name : Profile
        * fetch all basic information of user and display it.
        *
        * @return array
    */
    function profile()
    {
        $user = $this->facebook->getUser();
        if (empty($user) || $user==0 || $user=='') {
            redirect('Fb_Login');
        }
        $data['user_profile'] = $this->facebook->api('/me?fields=id,name,first_name,last_name,email,age_range,link,gender,locale,picture,timezone,updated_time,verified,albums,cover,currency,hometown&limit=5000');
        $data['user_photos'] = $this->facebook->api('/me/photos?&limit=5000'); 
        $data['logout_url'] = base_url('Fb_Login/logout');
        $user = $this->facebook->getUser();
        $data['login_url'] = $this->facebook->getLoginUrl(array('redirect_uri' => base_url('Fb_Login'),'scope' => array("email,public_profile,user_friends,user_hometown")));           

        $this->load->view('header', $data);
        $this->load->view('Profile', $data);
        $this->load->view('footer');

    }

    /**
        * Function Name : notFound
        * any bad url found then redirect to the homepage
        *
        * @return redirect
    */
    function notFound()
    {
        redirect('Fb_Login');
    }

    /**
        * Function Name : logout
        * destroy session and logout
        *
        * @return redirect
    */    
    function logout()
    {
        $this->load->library('facebook');
        $this->facebook->destroySession();
        redirect('Fb_Login');
    }
}

<?php

class Fb_Album extends CI_Controller 
{
	public $user = "";
	
	public function __construct() 
	{
		parent::__construct();
		// Load facebook library and pass associative array which contains appId and secret key
		// $this->load->library('Facebook', array('appId' => '1028581290556884', 'secret' => 'd6785950ea053ada147184363df77373'));
		$this->config->load('Facebook');

		// Get user's login information
		// $this->load->library('facebook');
		$this->user = $this->facebook->getUser();
	}

	// Store user information and send to profile page
	public function index() 
	{
		if ($this->user) 
		{
			$data['user_profile'] = $this->Facebook->api('/me/');

			// Get logout url of facebook
			$data['logout_url'] = $this->Facebook->getLogoutUrl(array('next' => base_url() . 'index.php/oauth_login/logout'));

			// Send data to profile page
			$this->load->view('profile', $data);
		} 
		else 
		{
		// Store users facebook login url
		$data['login_url'] = $this->Facebook->getLoginUrl();
		$this->load->view('Facebook_Album_View', $data);
		}
	}

	// Logout from facebook
	public function logout() 
	{

		// Destroy session
		session_destroy();

		// Redirect to baseurl
		redirect(base_url());
	}

}
?>
<?php
class Site_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	// Redirect the User to the Admin Login Page if Not Logged In
	public function user_is_logged_in()
	{
		if( ( !$this->session->userdata('email') || $this->session->userdata('user_type_id') != 1 ) && $this->uri->segment( 2 ) != 'login' )
		{
			redirect('/login');
		}
	}

}
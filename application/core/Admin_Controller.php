<?php
class Admin_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		// Check if The User is Logged In
		$this->user_is_logged_in();
	}

	// Redirect the User to the Admin Login Page if Not Logged In
	private function user_is_logged_in()
	{
		if( !$this->session->userdata('email') && $this->uri->segment( 2 ) != 'login' )
		{
			redirect('admin/login');
		}
	}

}
<?php
class Site_Controller extends MY_Controller
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

	// Redirect the User to the Admin Login Page if Not An Admin or A Ref
	public function user_is_ref()
	{
		if( ( !$this->session->userdata('email') || ( $this->session->userdata('user_type_id') != 2 && $this->session->userdata('user_type_id') != 1 ) ) && $this->uri->segment( 2 ) != 'login' )
		{
			redirect('/login');
		}
	}

	// Redirect the User to the Admin Login Page if Not An Admin or A Captain
	public function user_is_captain()
	{
		if( ( !$this->session->userdata('email') || ( $this->session->userdata('user_type_id') != 4 && $this->session->userdata('user_type_id') != 1 ) ) && $this->uri->segment( 2 ) != 'login' )
		{
			redirect('/login');
		}
	}

}
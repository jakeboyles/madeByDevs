<?php
class Site_Controller extends CI_Controller
{

	public $site_data;
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model( 'Notification_model' );
		$stuff = $this->Notification_model->get_records($this->session->userdata('user_id'));
		if(!empty($stuff)) 
		{
		$this->site_data = sizeof($stuff);
		}

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
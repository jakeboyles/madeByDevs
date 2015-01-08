<?php
class Home extends Site_Controller
{
	// Set Class Vars
	var $user; // Set in correctLogin()

	function __construct()
	{
		parent::__construct();
	}

	// Display Login Page or Log the User In
	public function index()
	{
		// // If the Login Form Was Submitted
		// if($this->input->post())
		// {
		// 	$this->_validation();
		// }

		// // Load Login Form View
		// //$this->load->view('admin/login');
		$data = array();
		$this->load->site_template( 'home', $data );
	}


}
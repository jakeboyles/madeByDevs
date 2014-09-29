<?php
class Register extends Site_Controller
{
	function __construct()
	{
		parent::__construct();

		// Load Model Sample
		//$this->load->model('Division_model');
	}

	// Display the register page
	public function index()
	{
		$this->load->site_template( 'register', $data );
	}
}
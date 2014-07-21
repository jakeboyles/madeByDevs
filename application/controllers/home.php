<?php
class Home extends Site_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index( $slug = FALSE )
	{
		// Store Data to Pass to View
		$data = array();

		// Load View
		$this->load->site_template( 'home', $data );
	}

}
<?php
class Directions extends Site_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// Store Data to Pass to View
		$data = array();

		// Load View
		$this->load->site_template( 'directions_search', $data );
	}

}
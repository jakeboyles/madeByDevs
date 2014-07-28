<?php
class History extends Site_Controller
{
	function __construct()
	{
		parent::__construct();

		// Load Models Needed
		$this->load->model('Division_model');
	}

	// Display the Location Search
	public function index()
	{
		// Store Data to Pass to View
		//$data['divisions'] = $this->Division_model->get_records();

		// Load View
		//$data['page_title'] = 'Divisions';
		$data = array();
		$this->load->site_template( 'history', $data );
	}
}
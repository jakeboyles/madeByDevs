<?php
class Divisions extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	// Display Divisions in a Table Format
	public function index()
	{
		// Set Vars
		$limit = 2;

		// Retrieve a List of Records and Store them to the Data Array
		$this->load->model( 'Divisions_model' );
		$data['divisions'] = $this->Divisions_model->get_divisions( $limit, $this->uri->segment(4) );

		// Setup and Intialize Pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url( 'admin/divisions/index' );
		$config['total_rows'] = 7;
		$config['per_page'] = $limit ;
		$config['uri_segment'] = 4;
		$this->pagination->initialize($config);

		// Load Divisions View
		$this->load->admin_template( 'divisions', $data );
	}

}
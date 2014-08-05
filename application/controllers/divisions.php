<?php
class Divisions extends Site_Controller
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
		$data['divisions'] = $this->Division_model->get_records();

		// Load View
		$data['page_title'] = 'Divisions';
		$this->load->site_template( 'divisions_search', $data );
	}

	// Find a List of Divisions 
	public function ajax_search_divisions()
	{
		$search = $this->input->post('search');

		if( $search )
		{
			$atts = array( 'where' => 'd.name LIKE \'%' . $search . '%\'' );
			$divisions = $this->Division_model->get_records( $atts );

			if( $divisions )
			{
				$data['divisions'] = $divisions;
				$this->load->view( 'site/ajax-parts/division-search-results.php', $data );
			}
			else
			{
				echo 'No results found.';
			}
		}

		return false;
	}

	// Dispaly History of Division
	public function history()
	{
		// Store Data to Pass to View
		$data['divisions'] = $this->Division_model->get_records();

		$data['page_title'] = 'Divisions';
		$this->load->site_template( 'divisions_history', $data );
	}
}
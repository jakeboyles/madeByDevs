<?php
class Teams extends Site_Controller
{
	
	function __construct()
	{
		parent::__construct();

		// Load Models Needed
		$this->load->model('Team_model');
	}

	// Display the Location Search
	public function index( $id = FALSE )
	{
		// Store Data to Pass to View
		$data['teams'] = $this->Team_model->get_records();

		// Load View
		$data['page_title'] = 'Team Search';
		$this->load->site_template( 'teams_search', $data );
	}

	// Find a List of Locations 
	public function ajax_search_teams()
	{
		$search = $this->input->post('search');

		if( $search )
		{
			$atts = array( 'where' => 't.name LIKE \'%' . $search . '%\'' );
			$teams = $this->Team_model->get_records( $atts );

			if( $teams )
			{
				$data['teams'] = $teams;
				$this->load->view( 'site/ajax-parts/team-search-results.php', $data );
			}
			else
			{
				echo 'No results found.';
			}
		}

		return false;
	}

	// Display Individual Team Page
	public function page( $id = FALSE )
	{
		$data = array();

		if( $id && is_numeric( $id ) )
		{
			// Get This Team Data
			$atts = array( 'where' => 't.id = ' . $id, 'single' => TRUE );
			$data['team'] = $this->Team_model->get_records( $atts );
		}

		// Set Page Title
		if( !empty( $data['team']['name'] ) )
		{
			$data['page_title'] = $data['team']['name'];
		}

		// Load Location View
		$this->load->site_template( 'teams_single_page', $data );
	}

}
<?php
class Divisions extends Site_Controller
{
	function __construct()
	{
		parent::__construct();

		// Load Models Needed
		$this->load->model('League_model');
		$this->load->model('Division_model');
		$this->load->model('Team_model');
		$this->load->model('Season_model');
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
	public function history( $division_id )
	{
		// Get Individual Division
		$atts = array( 'where' => 'd.id = ' . $division_id, 'single' => true );
		$data['division'] = $this->Division_model->get_records( $atts );

		// Get Current Season ID
		$atts = array( 'where' => 'l.id = 1', 'single' => true );
		$data['league'] = $this->League_model->get_records( $atts );

		$data['history'] = $this->Division_model->get_team_stats( $division_id, '5' );

		// Get Current Season's Teams and Stats
		//$data['current_season_teams'] = $this->Team_model->get_current_season_teams();

		// Load Division History View
		$data['page_title'] = $data['division']['name'] . ' Division';
		$this->load->site_template( 'divisions_history', $data );
	}

	// Dispaly History of Division
	public function page( $division_id )
	{
		// Get Individual Division
		$atts = array( 'where' => 'd.id = ' . $division_id, 'single' => true );
		$data['division'] = $this->Division_model->get_records( $atts );

		// Get Current Season ID
		$atts = array( 'where' => 'l.id = 1', 'single' => true );
		$data['league'] = $this->League_model->get_records( $atts );

		$data['season'] = $this->Season_model->get($data['league']['current_season_id']);

		$data['champions'] = $this->Division_model->get_champions($division_id);

		$data['current_season_teams'] = $this->Team_model->get_current_season_teams($data['league']['current_season_id'],$division_id);

		$data['leaders'] = $this->Division_model->get_team_stats( $division_id, $data['league']['current_season_id'] );

		// Load Division History View
		$data['page_title'] = $data['division']['name'] . ' Division';
		$this->load->site_template( 'divisions_page', $data );
	}
}
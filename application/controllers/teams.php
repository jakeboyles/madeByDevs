<?php
class Teams extends Site_Controller
{
	
	function __construct()
	{
		parent::__construct();

		// Load Models Needed
		$this->load->model('Team_model');
		$this->load->model('League_model');
		$this->load->model('Session_model');
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


	// Display the Location Search
	public function edit( $id = FALSE )
	{
		$this->user_is_captain();

		$data['record'] = $this->Team_model->get( $id );

		$data['logo'] = $this->Team_model->get_logo( $id );

		$data['roster'] = $this->Team_model->get_team_roster( $id );

		$atts = array( 'where' => 'l.id = 1', 'single' => true );
		$data['league'] = $this->League_model->get_records( $atts );

		$this->load->site_template( 'teams_edit', $data );
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

			if( $data['team'] )
			{
				// Get Current Season ID
				$atts = array( 'where' => 'l.id = 1', 'single' => true );
				$data['league'] = $this->League_model->get_records( $atts );

				$data['logo'] = $this->Team_model->get_logo( $id );

				// Get Active Sessions By Division (For Team)
				$data['active_sessions'] = $this->Session_model->get_active_sessions_by_division( $data['league']['current_season_id'], $data['team']['division_id'] );

				if( $data['active_sessions'] )
				{
					// Fetch Game Schedule for All Sessions in the Current Season for this Team
					$data['games'] = $this->Team_model->get_current_schedule( $data['team']['id'], $data['active_sessions'] );

					// Fetch Roster for All Sessions in the Current Season for this Team
					$data['roster'] = $this->Team_model->get_team_roster( $data['team']['id'] );
				}

				// Fetch Photos for this Team
				//$data['photos'] = $this->Team_model->get_team_photos();
			}
		}

		// Set Page Title
		if( !empty( $data['team']['name'] ) )
		{
			$data['page_title'] = $data['team']['name'];
		}

		// Load Location View
		$this->load->site_template( 'teams_single_page', $data );
	}


		// Add New Logo
	public function add_logo($id = FALSE)
	{

			// If Form is Submitted Validate Form Data and Add Record to Database
			if( $this->input->post() )
			{
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->load->library('upload', $config);

			// The field name for the file upload would be logo
			if ( ! $this->upload->do_upload('logo'))
			{
				return false;

			}
			else
			{
				$image = array('upload_data' => $this->upload->data());

				$data = array(
					'filename' => $image['upload_data']['file_name'],
					'mime_type' => $image['upload_data']['file_type']
				);

				$image = $this->db->insert('media',$data);

				$image = $this->db->insert_id();

				$data2 = array(
					'team_logo' => $image,
				);

				$this->db->where('id',$id);

				$this->db->update('teams',$data2); 

				redirect('teams/edit/'.$id);

			}
		}
	}

}
<?php
class Teams extends Site_Controller
{
	
	function __construct()
	{
		parent::__construct();

		// Load Models Needed
		$this->load->model('Team_model');
		$this->load->model('League_model');
		$this->load->model('User_model');
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

		//var_dump($this->db->last_query());
		$data['players'] = $this->User_model->get_players();

		// Create Data for Position Dropdown
		$data['positions'] = $this->Team_model->dropdown( 'positions', 'id', 'name' );

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
				return $this->upload->display_errors('<p>', '</p>');
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

				$this->add_image($id);

				redirect('teams/edit/'.$id);

			}
		}
	}


	// Add New Image
	public function add_image( $id = FALSE )
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
				return $this->upload->display_errors('<p>', '</p>');
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

				return $image;

			}
		}
	}

	private function _user_validation()
	{
		// Load Validation Library
		$this->load->library('form_validation');
		
		// Validation Rules
		$this->form_validation->set_rules('user_type_id', 'User Type', 'required');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('birthday', 'Birthday', 'required');
		$this->form_validation->set_rules('number', 'Number', 'required|min_length[1]|max_length[3]|');

		// Custom Validation Messages
		$this->form_validation->set_message( 'is_unique' , 'That Email Address is already registered to another user.' );

		// Email Validation
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

		// Password Validation
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password_confirm', 'Re-Type Password', 'required|matches[password]');

		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}


	private function _user_validation_edit()
	{
		// Load Validation Library
		$this->load->library('form_validation');
		
		// Validation Rules
		$this->form_validation->set_rules('user_type_id', 'User Type', 'required');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('birthday', 'Birthday', 'required');
		$this->form_validation->set_rules('number', 'Number', 'required|min_length[1]|max_length[3]|');

		// Custom Validation Messages
		$this->form_validation->set_message( 'is_unique' , 'That Email Address is already registered to another user.' );

		// Password Validation
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password_confirm', 'Re-Type Password', 'required|matches[password]');

		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}


	// Add New Logo
	public function add_player($id = FALSE)
	{

		if( $this->input->post() && $this->_user_validation() )
		{
			// Insert Record Into Database
			// Create JSON For DataTable View
			$data = $this->User_model->insert_record( $this->input->post() );

			$post = $this->input->post();

			$post = array(
				'player_id' => $data,
				'team_id' => $id,
				'position' => $post['position'],
				'number' => $post['number'], 
			);

			$data = $this->Team_model->insert_roster_record_frontend( $post );

		}
		else
		{
			$data = array(
				'result' => 'error',
				'errors' => validation_errors( '<li>','</li>' )
			);
		}

		echo json_encode( $data );
		
	}

	public function edit_player( $id = FALSE ) 
	{

		$data['divisions'] = $this->Team_model->dropdown( 'divisions', 'id', 'name' );

		// Create Data (Pull Users) for Team Captain Dropdown
		$data['users'] = $this->Team_model->dropdown( 'users', 'id', 'first_name' );

		// Create Data for Roster Dropdown
		$data['players'] = $this->User_model->get_players();

		// Create Data for Position Dropdown
		$data['positions'] = $this->Team_model->dropdown( 'positions', 'id', 'name' );

		// Create roster data
		$data['roster'] = $this->Team_model->get_team_roster( $id );

		// Retrieve Record Data From Database
		$data['record'] = $this->Team_model->get( $id );


		// If Form is Submitted Validate Form Data and Updated Record in Database
		if( $this->input->post() )
		{
			$data = array();

			// If Validation Passed
			if( $this->_user_validation_edit() )
			{
				// Update Record in Database
				// Create JSON For DataTable View
				$data = $this->User_model->update_record($id, $this->input->post() );

				$post = $this->input->post();

				$post = array(
					'position' => $post['position'],
					'number' => $post['number'], 
				);

				$data = $this->Team_model->update_roster_record_frontend($id, $post );

			}
			// If Validation Failed Send Errors
			else
			{
				$data = array(
					'result' => 'error',
					'errors' => validation_errors( '<li>','</li>' )
				);
			}

			echo json_encode( $data );
		}
		else
		{
			// Retrieve Record Data From Database
			$data['record'] = $this->User_model->get( $id );

			$data['player_info'] = $this->Team_model->get_player_info_by_user_id( $id );


			// Load Edit Record Form
			$this->load->view('site/ajax-parts/team-edit-ajax', $data);
		}


	}



	public function delete_player( $id = FALSE ) 
	{

			$data = array();

			$data = $this->Team_model->delete_roster_record_frontend($id);

			echo json_encode( $data );
		}

}
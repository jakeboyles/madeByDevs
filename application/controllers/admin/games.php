<?php
class Games extends Admin_Controller
{
	// Run Class Construct
	function __construct()
	{
		// Inherit Parent Classes Methods and Properties
		parent::__construct();

		// Load Database Model to Be Used in Methods
		$this->load->model( 'Game_model' );
		$this->load->model( 'Team_model' );
		$this->load->model( 'Location_model' );
		$this->load->model( 'Session_model' );

	}

	// Display All Records View
	public function index()
	{
		$data['games'] = $this->Game_model->get_records();
		$this->load->admin_template( 'games', $data );
	}



	public function add()
	{
		// If Form is Submitted Validate Form Data and Add Record to Database
		if( $this->input->post() && $this->_validation() )
		{
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->Game_model->insert_record( $this->input->post() ) )
			{
				redirect('admin/games');
			}
		}

		// // Create Data for Divisions Dropdown
		$data['related_divisions'] = $this->Team_model->dropdown( 'divisions', 'id', 'name' );

		$data['locations'] = $this->Location_model->dropdown( 'locations', 'id', 'name', null, 'parent_id IS NULL' );

		$data['sessions'] = $this->Session_model->dropdown( 'sessions', 'id', 'name' );


		// // Create Data for Team Captain Dropdown
		// $data['users'] = $this->Team_model->dropdown( 'users', 'id', 'first_name' );

		// Load Add Record Form View
		$this->load->admin_template( 'games_add', $data );
	}

	// Edit Record View
	public function edit( $id = FALSE )
	{

		if( $this->input->post() && $id )
		{
			$this->Game_model->update_record( $id, $this->input->post() );
			redirect('admin/games');

		}

		// Load User Agent Library for Referrer Add Record Message
		$this->load->library('user_agent');

		// Retrieve Record Data From Database
		$data['record'] = $this->Game_model->get( $id );

		$time = explode(" ", $data['record']['game_date_time']);

		$data['time']['date'] = date("m-d-Y", strtotime($time[0]));

		$data['time']['hour'] = date("g:i A", strtotime($time[1]));

		$data['divisions'] = $this->Team_model->dropdown( 'divisions', 'id', 'name' );

		$data['locations'] = $this->Location_model->dropdown( 'locations', 'id', 'name', null, 'parent_id IS NULL' );

		$data['locationfields'] = $this->Location_model->dropdown( 'locations', 'id', 'name', null, 'parent_id IS NOT NULL' );

		$data['sessions'] = $this->Session_model->dropdown( 'sessions', 'id', 'name' );

		$data['teams'] = $this->Team_model->dropdown( 'teams', 'id', 'name' );

		// Load Edit Record Form
		$this->load->admin_template( 'games_edit', $data );
	}

	// Delete a Record
	public function delete( $id = FALSE )
	{

		if( $id )
		{
			$this->Game_model->delete_record( $id );

			return true;
		}

		return false;
	}

	// Run Validation on Create / Edit Forms
	private function _validation()
	{
		// Load Validation Library
		$this->load->library('form_validation');
		
		// Validation Rules
		$this->form_validation->set_rules('session_id', 'Session', 'required');
		$this->form_validation->set_rules('division_id', 'Division', 'required');
		$this->form_validation->set_rules('location_id', 'Location', 'required');
		$this->form_validation->set_rules('location_field_id', 'Location Field', '');
		$this->form_validation->set_rules('team_home_id', 'Home Team', 'required');
		$this->form_validation->set_rules('team_away_id', 'Away Team', 'required|callback_valid_teams');
		$this->form_validation->set_rules('game_date', 'Game Date', 'required');
		$this->form_validation->set_rules('game_time', 'Game Time', 'required');
		$this->form_validation->set_rules('score_home', 'Home Score', 'numeric');
		$this->form_validation->set_rules('score_away', 'Away Score', 'numeric');
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}

	// Validation Rule to Make Sure Two Seperate Teams were Selected
	public function valid_teams( $str )
	{
		$team_home_id = $this->input->post( 'team_home_id' );
		$team_away_id = $this->input->post( 'team_away_id' );

		if( !empty( $team_home_id ) && !empty( $team_away_id ) )
		{
			if( $team_home_id == $team_away_id )
			{
				$this->form_validation->set_message( 'valid_teams', 'You must select two seperate teams.' );
				return false;
			}
			else
			{
				return true;
			}
		}

		return true;
	}

	// Add New Record via AJAX
	public function add_ajax()
	{
		if( $this->input->post('add_game') && $this->_validation() )
		{
			// Insert Record Into Database
			// Create JSON For DataTable View
			$data = $this->Game_model->insert_game_ajax( $this->input->post() );
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

	// Edit Record via AjAX
	public function edit_ajax( $id = FALSE )
	{
		if( $this->input->post('edit_game') && $id )
		{
			$data = array();

			// If Validation Passed
			if( $this->_validation() )
			{
				// Update Record in Database
				// Create JSON For DataTable View
				$data = $this->Game_model->update_game_ajax( $id, $this->input->post() );
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
		// Display View
		else
		{
			// Retrieve Record Data From Database
			$data['record'] = $this->Game_model->get( $id );

			// Set Variables
			$session_id = $data['record']['session_id'];
			$division_id = $data['record']['division_id'];

			// Store Games in this Session to the Data Array
			$data['games'] = $this->Game_model->get_records( array( 'where' => array( 'session_id' => $session_id ) ) );

			// Get a List of Seasons for Dropdown
			$data['seasons'] = $this->Game_model->dropdown( 'seasons', 'id', 'name' );

			// Get a List of Divisions for Checkboxes
			$data['divisions'] = $this->Game_model->dropdown( 'divisions', 'id', 'name' );

			// Return a List of Usable Teams
			$this->load->model( 'Team_model' );
			$data['teams'] = $this->Team_model->get_teams_by_division( $division_id );

			// Get a list of divisions this Session has a relationship with
			$this->load->model( 'Session_model' );
			$data['related_divisions'] = $this->Session_model->get_related_divisions( $session_id );

			// Get a list of Locations
			$data['locations'] = $this->Game_model->dropdown( 'locations', 'id', 'name', 'name ASC', 'parent_id IS NULL' );
			$data['location_fields'] = $this->Game_model->dropdown( 'locations', 'id', 'name', 'name ASC', 'parent_id = ' . $data['record']['location_id'] );

			// Load View
			$this->load->view( 'admin/parts/session_game_edit_form', $data );
		}

		return false;
	}

}
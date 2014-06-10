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
	}

	// Display All Records View
	public function index()
	{
		$data['games'] = $this->Game_model->get_records();
		$this->load->admin_template( 'games', $data );
	}

	// Add New Record View
	public function add()
	{
		// If Form is Submitted Validate Form Data and Add Record to Database
		if( $this->input->post() && $this->_validation() )
		{
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->Game_model->insert_record( $this->input->post() ) )
			{
				redirect('admin/games/edit/' . $insert_id);
			}
		}

		// Load Add Record Form View
		$this->load->admin_template( 'games_add' );
	}

	// Edit Record View
	public function edit( $id = FALSE )
	{
		// If Form is Submitted Validate Form Data and Updated Record in Database
		if( $this->input->post() && $this->_validation() && $id )
		{
			$this->Game_model->update_record( $id, $this->input->post() );
		}

		// Load User Agent Library for Referrer Add Record Message
		$this->load->library('user_agent');

		// Retrieve Record Data From Database
		$data['record'] = $this->Game_model->get( $id );

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

}
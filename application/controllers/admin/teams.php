<?php
class Teams extends Admin_Controller
{
	// Run Class Construct
	function __construct()
	{
		// Inherit Parent Classes Methods and Properties
		parent::__construct();

		// Load Database Model to Be Used in Methods
		$this->load->model( 'Team_model' );
		$this->load->model( 'User_model' );
	}

	// Display All Records View
	public function index()
	{
		$data['records'] = $this->Team_model->get_records();
		$this->load->admin_template( 'teams', $data );
	}

	// Add New Record View
	public function add()
	{
		// If Form is Submitted Validate Form Data and Add Record to Database
		if( $this->input->post() && $this->_validation() )
		{
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->Team_model->insert_record( $this->input->post() ) )
			{
				redirect('admin/teams/edit/' . $insert_id);
			}
		}

		// Create Data for Divisions Dropdown
		$data['divisions'] = $this->Team_model->dropdown( 'divisions', 'id', 'name' );

		// Create Data for Team Captain Dropdown
		$data['users'] = $this->Team_model->dropdown( 'users', 'id', 'first_name' );


		// Load Add Record Form View
		$this->load->admin_template( 'teams_add', $data );
	}

	// Edit Record View
	public function edit( $id = FALSE )
	{
		// If Form is Submitted Validate Form Data and Updated Record in Database
		if( $this->input->post() && $this->_validation() && $id )
		{
			$this->Team_model->update_record( $id, $this->input->post() );
		}

		// Load User Agent Library for Referrer Add Record Message
		$this->load->library('user_agent');

		// Create Data for Divisions Dropdown
		$data['divisions'] = $this->Team_model->dropdown( 'divisions', 'id', 'name' );

		// Create Data (Pull Users) for Team Captain Dropdown
		$data['users'] = $this->Team_model->dropdown( 'users', 'id', 'first_name' );

		// Create Data for Roster Dropdown
		//$data['players'] = $this->Team_model->dropdown( 'users', 'id', 'first_name','id ASC',array('user_type_id'=>3));
		//var_dump($this->db->last_query());
		$data['players'] = $this->User_model->get_players();

		// Create Data for Position Dropdown
		$data['positions'] = $this->Team_model->dropdown( 'positions', 'id', 'name' );

		$data['roster'] = $this->Team_model->get_team_roster( $id );

		// Retrieve Record Data From Database
		$data['record'] = $this->Team_model->get( $id );

		// Load Edit Record Form
		$this->load->admin_template( 'teams_edit', $data );
	}


	// Add a Player
	public function add_player($parent_id = FALSE)
	{
		if( $this->input->post() )
		{
			// Insert Record Into Database
			// Create JSON For DataTable View
			$data = $this->Team_model->insert_roster_record( $this->input->post() );
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



	// Player Validation
	private function _player_validation()
	{
		// Load Validation Library
		$this->load->library('form_validation');
		
		// Validation Rules
		$this->form_validation->set_rules('player_id', 'Add Player', 'required');
		$this->form_validation->set_rules('position', 'Position', 'required');
		$this->form_validation->set_rules('parent_id', 'Team ID', 'required');

		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}





	// Edit a Team Roster
	public function edit_roster( $id = FALSE )
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
			if( $this->_player_validation() )
			{
				// Update Record in Database
				// Create JSON For DataTable View
				$data = $this->Team_model->update_roster_field( $id, $this->input->post() );

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
			$data['record'] = $this->Team_model->getPlayer( $id );

			// Load Edit Record Form
			$this->load->view('admin/parts/teams_roster_edit_form', $data);
		}
	}


	// Delete a Person From The Roster
	public function delete_roster( $id = FALSE )
	{

		if( $id )
		{
			$this->Team_model->delete_roster( $id );

			return true;
		}

		return false;
	}




	// Delete a Record
	public function delete( $id = FALSE )
	{

		if( $id )
		{
			$this->Team_model->delete_record( $id );

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
		$this->form_validation->set_rules('name', 'Team Name', 'required');
		$this->form_validation->set_rules('division_id', 'Division', 'required');
		$this->form_validation->set_rules('captain_user_id', 'Team Captain', '');
		$this->form_validation->set_rules('description', 'Team Description', '');
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}

}
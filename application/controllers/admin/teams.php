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
		$data['users'] = $this->Team_model->dropdown( 'users', 'id', 'email' );

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
		$data['users'] = $this->Team_model->dropdown( 'users', 'id', 'email' );

		// Retrieve Record Data From Database
		$data['record'] = $this->Team_model->get( $id );

		// Load Edit Record Form
		$this->load->admin_template( 'teams_edit', $data );
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
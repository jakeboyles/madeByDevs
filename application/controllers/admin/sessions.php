<?php
class Sessions extends Admin_Controller
{
	// Run Class Construct
	function __construct()
	{
		// Inherit Parent Classes Methods and Properties
		parent::__construct();

		// Load Database Model to Be Used in Methods
		$this->load->model( 'Session_model' );
	}

	// Display All Records View
	public function index()
	{
		$data['records'] = $this->Session_model->get_records();
		$this->load->admin_template( 'sessions', $data );
	}

	// Add New Record View
	public function add()
	{
		// If Form is Submitted Validate Form Data and Add Record to Database
		if( $this->input->post() && $this->_validation() )
		{
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->Session_model->insert_record( $this->input->post() ) )
			{
				redirect('admin/sessions/edit/' . $insert_id);
			}
		}

		// Get a List of Seasons for Dropdown
		$data['seasons'] = $this->Session_model->dropdown( 'seasons', 'id', 'name' );

		// Load Add Record Form View
		$this->load->admin_template( 'sessions_add', $data );
	}

	// Edit Record View
	public function edit( $id = FALSE )
	{
		// If Form is Submitted Validate Form Data and Updated Record in Database
		if( $this->input->post() && $this->_validation() && $id )
		{
			$this->Session_model->update_record( $id, $this->input->post() );
		}

		// Load User Agent Library for Referrer Add Record Message
		$this->load->library('user_agent');

		// Get a List of Seasons for Dropdown
		$data['seasons'] = $this->Session_model->dropdown( 'seasons', 'id', 'name' );

		// Get a List of Divisions for Checkboxes
		$data['divisions'] = $this->Session_model->dropdown( 'divisions', 'id', 'name' );

		// Retrieve Record Data From Database
		$data['record'] = $this->Session_model->get( $id );

		// Load Edit Record Form
		$this->load->admin_template( 'sessions_edit', $data );
	}

	// Delete a Record
	public function delete( $id = FALSE )
	{

		if( $id )
		{
			$this->Season_model->delete_record( $id );

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
		$this->form_validation->set_rules('name', 'Session Name', 'required');
		$this->form_validation->set_rules('season_id', 'Season', 'required');
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}

}
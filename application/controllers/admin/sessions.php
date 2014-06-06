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

		// Get a List of Divisions for Checkboxes
		$data['divisions'] = $this->Session_model->dropdown( 'divisions', 'id', 'name' );

		// Get a list of divisions this Session has a relationship with
		$data['related_divisions'] = $this->_get_related_divisions();

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

		// Store Games in this Session to the Data Array
		$this->load->model( 'Game_model' );
		$args = array(
			'where' => array( 'session_id' => $id )
		);
		$data['games'] = $this->Game_model->get_records( $args );

		// Get a List of Seasons for Dropdown
		$data['seasons'] = $this->Session_model->dropdown( 'seasons', 'id', 'name' );

		// Get a List of Divisions for Checkboxes
		$data['divisions'] = $this->Session_model->dropdown( 'divisions', 'id', 'name' );

		// Get a list of divisions this Session has a relationship with
		$data['related_divisions'] = $this->_get_related_divisions( $id );

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
			$this->Session_model->delete_record( $id );

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

	// Get a list of divisions this Session has a relationship with
	private function _get_related_divisions( $id = FALSE )
	{
		// For Edit A Session
		if( $id )
		{
			// If Form Was Submitted, Use Selected Divisions
			if( !empty( $this->input->post('divisions') ) )
			{
				$related_divisions = $this->input->post('divisions');
			}
			// Else Load the related divisions from the database
			else
			{
				$related_divisions = $this->Session_model->select_divisions( $id );
			}
		}
		// For Add a Session
		else
		{
			// If Form Was Submitted, Use Selected Divisions
			if( !empty( $this->input->post('divisions') ) )
			{
				$related_divisions = $this->input->post('divisions');
			}
		}

		// If Related Divisions Are Set, Return Them
		if( !empty( $related_divisions ) )
		{
			return $related_divisions;
		}

		// Else Return False
		return false;
	}

}
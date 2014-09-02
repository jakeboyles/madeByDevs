<?php
class Leagues extends Admin_Controller
{
	// Run Class Construct
	function __construct()
	{
		// Inherit Parent Classes Methods and Properties
		parent::__construct();

		// Load Database Model to Be Used in Methods
		$this->load->model( 'League_model' );
		$this->load->model( 'Season_model' );
	}

	// Display All Records View
	public function index()
	{
		$data['records'] = $this->League_model->get_records();
		$this->load->admin_template( 'leagues', $data );
	}

	// Add New Record View
	public function add()
	{
		// If Form is Submitted Validate Form Data and Add Record to Database
		if( $this->input->post() && $this->_validation() )
		{
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->League_model->insert_record( $this->input->post() ) )
			{
				redirect('admin/leagues/edit/' . $insert_id);
			}
		}

		// Load Add Record Form View
		$this->load->admin_template( 'leagues_add' );
	}

	// Edit Record View
	public function edit( $id = FALSE )
	{
		// If Form is Submitted Validate Form Data and Updated Record in Database
		if( $this->input->post() && $this->_validation() && $id )
		{
			$this->League_model->update_record( $id, $this->input->post() );
		}

		// Load User Agent Library for Referrer Add Record Message
		$this->load->library('user_agent');

		// Retrieve Record Data From Database
		$data['record'] = $this->League_model->get_records( $id, 'id=1' );
		$data['record'] = $data['record'][0];

		$data['seasons'] = $this->Season_model->dropdown( 'seasons', 'id', 'name' );

		// Load Edit Record Form
		$this->load->admin_template( 'leagues_edit', $data );
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
		$this->form_validation->set_rules('name', 'Season Name', 'required');
		$this->form_validation->set_rules('current_season_id', 'Current Season', 'required');;

		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}

}
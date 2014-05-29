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
			if( $insert_id = $this->Season_model->insert_record( $this->input->post() ) )
			{
				redirect('admin/seasons/edit/' . $insert_id);
			}
		}

		// Load Add Record Form View
		$this->load->admin_template( 'seasons_add' );
	}

	// Edit Record View
	public function edit( $id = FALSE )
	{
		// If Form is Submitted Validate Form Data and Updated Record in Database
		if( $this->input->post() && $this->_validation() && $id )
		{
			$this->Season_model->update_record( $id, $this->input->post() );
		}

		// Load User Agent Library for Referrer Add Record Message
		$this->load->library('user_agent');

		// Retrieve Record Data From Database
		$data['record'] = $this->Season_model->get( $id );

		// Load Edit Record Form
		$this->load->admin_template( 'seasons_edit', $data );
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
		$this->form_validation->set_rules('year_start', 'Year Start', 'required|exact_length[4]|numeric');
		$this->form_validation->set_rules('year_end', 'Year End', 'required|exact_length[4]|numeric');
		$this->form_validation->set_rules('description', 'Description', '');
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}

}
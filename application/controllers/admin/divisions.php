<?php
class Divisions extends Admin_Controller
{
	// Run Class Construct
	function __construct()
	{
		// Inherit Parent Classes Methods and Properties
		parent::__construct();

		// Load Database Model to Be Used in Methods
		$this->load->model( 'Division_model' );
	}

	// Display All Records View
	public function index()
	{
		
		$data['records'] = $this->Division_model->get_records();
		$this->load->admin_template( 'divisions', $data );
	}

	// Add New Record View
	public function add()
	{
		// If Form is Submitted Validate Form Data and Add Record to Database
		if( $this->input->post() && $this->_validation() )
		{
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->Division_model->add_record( $this->input->post() ) )
			{
				redirect('admin/divisions/edit/' . $insert_id);
			}
		}

		// Load Add Record Form View
		$this->load->admin_template( 'divisions_add' );
	}

	// Edit Record View
	public function edit( $id = FALSE )
	{
		$this->load->admin_template( 'divisions_edit' );
	}

	// Delete a Record
	public function delete( $id = FALSE )
	{
		// delete functionality will go here
	}

	// Run Validation on Create / Edit Forms
	private function _validation()
	{
		// Load Validation Library
		$this->load->library('form_validation');
		
		// Validation Rules
		$this->form_validation->set_rules('name', 'Division Name', 'required');
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}

}
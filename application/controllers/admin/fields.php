<?php
class Fields extends Admin_Controller
{
	// Run Class Construct
	function __construct()
	{
		// Inherit Parent Classes Methods and Properties
		parent::__construct();

		// Load Database Model to Be Used in Methods
		$this->load->model( 'Location_fields_model' );

		// Load State Helepr
		$this->load->helper('state');
	}

	// Display All Records View
	public function index()
	{
		$data['records'] = $this->Location_model->get_records();
		$this->load->admin_template( 'locations', $data );
	}

	// Add New Record View
	public function add()
	{
		// If Form is Submitted Validate Form Data and Add Record to Database
		if( $this->input->post() && $this->_validation() )
		{
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->Location_model->insert_record( $this->input->post() ) )
			{
				redirect('admin/locations/edit/' . $insert_id);
			}
		}

		// Load Add Record Form View
		$this->load->admin_template( 'locations_add' );
	}

	// Edit Record View
	public function edit( $id = FALSE )
	{
		// If Form is Submitted Validate Form Data and Updated Record in Database
		if( $this->input->post() && $this->_validation() && $id )
		{
			$this->Location_model->update_record( $id, $this->input->post() );
		}

		// Load User Agent Library for Referrer Add Record Message
		$this->load->library('user_agent');

		// Retrieve Record Data From Database
		$data['record'] = $this->Location_model->get( $id );

		// Load Edit Record Form
		$this->load->admin_template( 'locations_edit', $data );
	}

	// Delete a Record
	public function delete( $id = FALSE )
	{

		if( $id )
		{
			$this->Location_model->delete_record( $id );

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
		$this->form_validation->set_rules('name', 'Location Name', 'required');
		$this->form_validation->set_rules('phone', 'Phone', '');
		$this->form_validation->set_rules('website', 'Website', '');
		$this->form_validation->set_rules('street_address', 'Street Address', '');
		$this->form_validation->set_rules('street_address_2', 'Street Address 2', '');
		$this->form_validation->set_rules('city', 'City', '');
		$this->form_validation->set_rules('state', 'State', '');
		$this->form_validation->set_rules('postal', 'Postal', '');
		$this->form_validation->set_rules('map_latitude', 'Map Latitude', '');
		$this->form_validation->set_rules('map_longitude', 'Map Longitude', '');
		$this->form_validation->set_rules('map_zoom', 'Map Zoom', '');
		$this->form_validation->set_rules('description', 'Location Description', '');
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}

}
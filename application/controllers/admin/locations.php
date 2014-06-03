<?php
class Locations extends Admin_Controller
{
	// Run Class Construct
	function __construct()
	{
		// Inherit Parent Classes Methods and Properties
		parent::__construct();

		// Load Database Model to Be Used in Methods
		$this->load->model( 'Location_model' );

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
		if( $this->input->post('add-location') && $this->_validation() )
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
		if( $this->input->post('edit-location') && $this->_validation() && $id )
		{
			$this->Location_model->update_record( $id, $this->input->post() );
		}

		// Load User Agent Library for Referrer Add Record Message
		$this->load->library('user_agent');

		// Get a List of Location Fields for this Location
		$data['fields'] = $this->Location_model->get_records( $id );

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
		$this->form_validation->set_rules('map_zoom', 'Map Zoom', 'numeric');
		$this->form_validation->set_rules('description', 'Location Description', '');
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}

	// Retrieve Fields
	public function get_fields( $parent_id = FALSE )
	{

	}

	// Add a Field
	public function add_field( $parent_id = FALSE )
	{
		if( $this->input->post('add_field') && $this->_field_validation() )
		{
			// Insert Record Into Database
			// Create JSON For DataTable View
			$data = $this->Location_model->insert_location_field( $this->input->post() );
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

	// Location Field Validation
	private function _field_validation()
	{
		// Load Validation Library
		$this->load->library('form_validation');
		
		// Validation Rules
		$this->form_validation->set_rules('name', 'Field Name', 'required');
		$this->form_validation->set_rules('map_latitude', 'Map Latitude', '');
		$this->form_validation->set_rules('map_longitude', 'Map Longitude', '');
		$this->form_validation->set_rules('map_zoom', 'Map Zoom', 'numeric');

		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}

}
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

	// AJAX Add Record
	public function add_ajax()
	{
		//$this->load->view()
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
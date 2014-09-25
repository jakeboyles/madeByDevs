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
		$this->load->model( 'Session_model' );
		$this->load->model( 'Team_model' );
		$this->load->model( 'Location_model' );
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
			if( $insert_id = $this->Division_model->insert_record( $this->input->post() ) )
			{
				redirect('admin/divisions/edit/' . $insert_id);
			}
		}

		$data['sessions'] = $this->Session_model->get_records_checkboxs();

		// Get a List of Division Types for Dropdown
		$data['division_types'] = $this->Division_model->dropdown( 'division_types', 'id', 'type' );

		// Load Add Record Form View
		$this->load->admin_template( 'divisions_add', $data );
	}

	// Edit Record View
	public function edit( $id = FALSE )
	{
		// If Form is Submitted Validate Form Data and Updated Record in Database
		if( $this->input->post() && $this->_validation() && $id )
		{
			$this->Division_model->update_record( $id, $this->input->post() );
		}

		// Load User Agent Library for Referrer Add Record Message
		$this->load->library('user_agent');

		// Get a List of Division Types for Dropdown
		$data['division_types'] = $this->Division_model->dropdown( 'division_types', 'id', 'type' );

		$data['sessions'] = $this->Session_model->get_records_checkboxs();

		$data['related_sessions'] = $this->Session_model->get_related_sessions($id);

		// Retrieve Record Data From Database
		$data['record'] = $this->Division_model->get( $id );

		$data['seasons'] = $this->Session_model->get_seasons();

		$data['teams'] = $this->Team_model->get_team_by_division($id);

		// Load Edit Record Form
		$this->load->admin_template( 'divisions_edit', $data );
	}

	// Delete a Record
	public function delete( $id = FALSE )
	{

		if( $id )
		{
			$this->Division_model->delete_record( $id );

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
		$this->form_validation->set_rules('name', 'Division Name', 'required');
		$this->form_validation->set_rules('division_type', 'Division Type', '');
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}


		// Run Validation on Create / Edit Forms
	private function _champion_validation()
	{
		// Load Validation Library
		$this->load->library('form_validation');
		
		// Validation Rules
		$this->form_validation->set_rules('session_id', 'Session ID', 'required');
		$this->form_validation->set_rules('team', 'Team ID', 'required');
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}


	// AJAX Load Teams
	public function get_divisions_by_sessions( $session_id = FALSE )
	{
		// Return a List of Usable Teams
		$this->load->model( 'Session_model' );
		$data['divisions'] = $this->Session_model->get_divisions_by_session( $session_id );
		// Load Teams Form View
		$this->load->view( 'admin/parts/divisions_dropdown', $data );
	}



	// For updating sessions related to a division
	public function assign_session( $division_id = FALSE )
	{

		// Load User Agent Library for Referrer Add Record Message
		$this->load->library('user_agent');

		$this->load->helper('url');

		// Return a List of Usable Teams
		$this->load->model( 'Session_model' );

		// Update selected sessions to this division
		$data['divisions'] = $this->Session_model->update_sessions( $division_id );

		$this->load->library('user_agent');

		// Get a List of Division Types for Dropdown
		$data['division_types'] = $this->Division_model->dropdown( 'division_types', 'id', 'type' );

		$data['sessions'] = $this->Session_model->get_records_checkboxs();

		$data['related_sessions'] = $this->Session_model->get_related_sessions($division_id);

		$data['all_sessions'] = $this->Session_model->get_related_sessions($division_id);

		$data['teams'] = $this->Team_model->get_team_by_division($division_id);

		// Retrieve Record Data From Database
		$data['record'] = $this->Division_model->get( $division_id );

		// Load Edit Record Form
		$this->load->admin_template( 'divisions_edit', $data );

	}


	// public function add_champion( $division_id = FALSE )
	// {

	// 	// If Form is Submitted Validate Form Data and Updated Record in Database
	// 	if( $this->input->post() )
	// 	{
	// 		$add_Champ = $this->Division_model->add_champion( $division_id, $this->input->post() );

	// 		redirect('/admin/divisions/edit/'. $division_id, 'refresh');
	// 	}

	// }

		// Edit a Location Field
	public function add_champion( $id = FALSE )
	{

		// If Form is Submitted Validate Form Data and Updated Record in Database
		if( $this->input->post() && $id )
		{
			$data = array();

			// Update Record in Database
			// Create JSON For DataTable View
			$errors = $this->Division_model->add_champion( $id, $this->input->post() );

			if($errors!="TRUE")
			{
				echo $errors;
			}
			else 
			{
				redirect('/admin/divisions/edit/'. $id, 'refresh');
			}
		}
		else
		{

			$ids = explode("-", $id);

			$id = $ids[0];
			$season_id = $ids[1];

			// Retrieve Record Data From Database
			$data['record'] = $this->Location_model->get( $id );

			// Retrieve Record Data From Database
			$data['record'] = $this->Division_model->get( $id );

			$data['season'] = $season_id;

			$data['editing'] = $this->Division_model->get_season_champion( $id, $season_id );

			$data['seasons'] = $this->Session_model->get_seasons_dropdown($id);

			$data['teams'] = $this->Team_model->get_team_by_division($id);

			// Load Edit Record Form
			$this->load->view('admin/parts/divisions_champ', $data);
		}
	}

}
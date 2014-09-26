<?php
class Users extends Site_Controller
{
	// Run Class Construct
	function __construct()
	{
		// Inherit Parent Classes Methods and Properties
		parent::__construct();

		// Load Database Model to Be Used in Methods
		$this->load->model( 'User_model' );
		$this->load->model( 'Division_model' );
	}

	// Display All Records View
	public function index()
	{
		
		$data['records'] = $this->User_model->get_records();
		$this->load->admin_template( 'users', $data );
	}

	// Add New Record View
	public function add()
	{
		// If Form is Submitted Validate Form Data and Add Record to Database
		if( $this->input->post() && $this->_team_validation() )
		{
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->User_model->insert_record_and_team( $this->input->post() ) )
			{
				redirect('/');
			}
		}
		$this->load->library('Dob_dropdown');
		$data['months']= $this->dob_dropdown->buildMonthDropdown('drop_month', 'drop_month');
		$data['days']= $this->dob_dropdown->buildDayDropdown('drop_day', 'drop_day');
		$data['years']= $data['dropyear'] = $this->dob_dropdown->buildYearDropdown('drop_year', 'drop_year');
		$data['divisions'] = $this->Division_model->dropdown( 'divisions', 'id', 'name' );
		$this->load->site_template( 'register', $data );

	}


	// Edit Record View
	public function edit( $id = FALSE )
	{
		// If Form is Submitted Validate Form Data and Updated Record in Database
		if( $this->input->post() && $this->_validation() && $id )
		{
			$this->User_model->update_record( $id, $this->input->post() );
		}

		// Load User Agent Library for Referrer Add Record Message
		$this->load->library('user_agent');

		// Get a List of User Types for Dropdown
		$data['user_types'] = $this->User_model->dropdown( 'user_types', 'id', 'type' );

		// Retrieve Record Data From Database
		$data['record'] = $this->User_model->get( $id );

		// Load Edit Record Form
		$this->load->admin_template( 'users_edit', $data );
	}

	// Delete a Record
	public function delete( $id = FALSE )
	{

		if( $id )
		{
			$this->User_model->delete_record( $id );

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
		$this->form_validation->set_rules('user_type_id', 'User Type', 'required');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('gender', 'Gender', '');
		$this->form_validation->set_rules('postal', 'Postal Code', '');
		$this->form_validation->set_rules('birthday', 'Birthday', 'required');

		// Custom Validation Messages
		$this->form_validation->set_message( 'is_unique' , 'That Email Address is already registered to another user.' );

		// Only Run this Validation on Add User
		if( $this->uri->segment(3) == 'add' )
		{
			// Email Validation
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

			// Password Validation
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password_confirm', 'Re-Type Password', 'required|matches[password]');
		}
		// Only Run this Validation on Edit User
		elseif( $this->uri->segment(3) == 'edit' )
		{	
			// Email Validation
			if( $this->input->post( 'email' ) == $this->input->post( 'original_email' ) )
			{
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			}
			else
			{
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
			}

			// Run Password Validation if Password Fields are Not Empty
			if( $this->input->post('password') || $this->input->post('password_confirm') )
			{
				$this->form_validation->set_rules('password', 'Password', '');
				$this->form_validation->set_rules('password_confirm', 'Re-Type Password', 'matches[password]');
			}
		}
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}

	private function _team_validation()
	{
		// Load Validation Library
		$this->load->library('form_validation');
		
		// Validation Rules
		$this->form_validation->set_rules('user_type_id', 'User Type', 'required');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('gender', 'Gender', '');
		$this->form_validation->set_rules('postal', 'Postal Code', '');
		$this->form_validation->set_rules('month', 'Month', 'required|numeric|min_length[2]|max_length[2]|');
		$this->form_validation->set_rules('day', 'Day', 'required|numeric|min_length[1]|max_length[2]|');
		$this->form_validation->set_rules('year', 'Year', 'required|numeric|min_length[4]|max_length[4]|');
		$this->form_validation->set_rules('name', 'Team Name', 'required');

		// Custom Validation Messages
		$this->form_validation->set_message( 'is_unique' , 'That Email Address is already registered to another user.' );

		// Only Run this Validation on Add User
	
			// Email Validation
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

			// Password Validation
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password_confirm', 'Re-Type Password', 'required|matches[password]');


		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}


	// Run Validation on Create / Edit Forms
	private function _info_validation()
	{
		// Load Validation Library
		$this->load->library('form_validation');
		
		// Validation Rules
		$this->form_validation->set_rules('yellows', 'Yellow Cards', 'numeric');
		$this->form_validation->set_rules('reds', 'Red Cards', 'numeric');
		$this->form_validation->set_rules('score', 'Score', 'numeric');
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}


	// Run Validation on Create / Edit Forms
	private function _game_validation()
	{
		// Load Validation Library
		$this->load->library('form_validation');
		
		// Validation Rules
		$this->form_validation->set_rules('score_home', 'Score Home', 'required | numeric');
		$this->form_validation->set_rules('score_away', 'Score Away', 'required | numeric');
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}

	// Add New Record View
	public function add_game_record()
	{
		// If Form is Submitted Validate Form Data and Add Record to Database
		if( $this->input->post() && $this->_game_validation() )
		{
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->User_model->add_game_record( $this->input->post() ) )
			{
				redirect('cms/official');
			}
		}
	}

	public function add_player_record( $id = FALSE ) 
	{
		if( $this->input->post() && $this->_info_validation() )
		{
			$this->User_model->add_game_record_ajax($this->input->post(), $id);
		}
		else
		{
			return $this->input->post();
		}
	}

	public function edit_player_record( $id = FALSE ) 
	{
		if( $this->input->post() && $this->_info_validation() )
		{
			$post = $this->input->post();
			$this->User_model->edit_game_record_ajax($this->input->post(), $id, $post['game_player_id']);
		}
		else
		{
			return $this->input->post();
		}
	}

}
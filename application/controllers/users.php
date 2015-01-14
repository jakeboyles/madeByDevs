<?php
class Users extends Site_Controller
{
		var $user; // Set in correctLogin()
	// Run Class Construct
	function __construct()
	{
		// Inherit Parent Classes Methods and Properties
		parent::__construct();

		$this->load->model( 'User_model' );
		$this->load->model( 'Project_model' );
		$this->load->model( 'Comment_model' );
				$this->load->helper('text');


		// Load Database Model to Be Used in Methods
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
		if( $this->input->post() && $this->_login_validation() )
		{	

			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->User_model->insert_record( $this->input->post() ) )
			{
				$this->_login_validation($this->input->post());
				redirect('/home');
			}
		}
		$this->load->site_template( 'register' );

	}

	public function update($id = false)
	{

		if( $this->input->post() )
		{	

			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->User_model->update_record($id, $this->input->post() ) )
			{
				redirect('/home');
			}
		}

	}



	public function profile($id = false)
	{
		$data['user'] = $this->User_model->get( $id );
		$data['projects'] = $this->Project_model->get_records( array("p.author_id"=>$id) );
		$data['comments'] = $this->Comment_model->get_records( array("c.author_id"=>$id) );

		$this->load->site_template( 'profile', $data );

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
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');

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


	// Run Validation on Form Submission
	private function _login_validation($post = FALSE)
	{
		// Set Vars
		$email = $post['email'];
		$password = $post['password'];
		// Validation Rules	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email Address', 'valid_email|required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');
		
		// Check to See if Email/Password Combo Work
		if( !empty($email) && !empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL) )
		{
			// Check to Make Sure the Username/Password Combo work
			// & Make Sure the User is an Admin
			$this->form_validation->set_rules('email','Email Address','callback_can_log_in');
		}

		// Form Validation and Login Validation Passed
		if ( $this->form_validation->run() )
		{
			// Log the User In	
			$this->_login($post);

			return true;

		}
	}


	// Make sure the user can Login
	public function can_log_in()
	{			
		// Store User ID
		$this->load->model('Authenticate_model');
		$this->user = $this->Authenticate_model->login( $this->input->post('email'), $this->input->post('password') );

		// Has the a correct username/password combo
		if( empty( $this->user['id'] ) )
		{
			$this->form_validation->set_message('can_log_in', 'You have either entered an incorrect username or password.');
			return false;
		}

		// Passed Login Validation
		else
		{
			return true;
		}
	}



	// Log The User In
	private function _login($post = FALSE)
	{			
		// Store Session
		$this->session->set_userdata( array(
			'email' => $post['email'],
			'user_id' => $this->user['id'],
		) );

		return true;

	}


}
<?php
class Login extends Admin_Controller
{
	// Set Class Vars
	var $user_id; // Set in correctLogin()

	function __construct()
	{
		parent::__construct();
	}

	// Display Login Page or Log the User In
	public function index()
	{
		// If the Login Form Was Submitted
		if($this->input->post())
		{
			$this->_validation();
		}

		// Load Login Form View
		$this->load->view('admin/login');
	}

	// Run Validation on Form Submission
	private function _validation()
	{
		// Set Vars
		$email = $this->input->post('email');
		$password = $this->input->post('password');
					
		// Validation Rules	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email Address', 'valid_email|required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		// Check to See if Email/Password Combo Work
		if( !empty($email) && !empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL) )
		{
			$this->form_validation->set_rules('email','Email Address','callback_correct_login');
		}

		// Form Validation and Login Validation Passed
		if ( $this->form_validation->run() )
		{
			// Log the User In		
			$this->_login();
			
			// Redirect User
			redirect('admin');
		}
	}

	// Check for Correct Username and Password
	public function correct_login()
	{			
		// Store User ID
		$this->load->model('Authenticate_model');
		$this->user_id = $this->Authenticate_model->login( $this->input->post('email'), $this->input->post('password') );

		if(!$this->user_id)
		{
			$this->form_validation->set_message('correct_login', 'You have either entered an incorrect username or password.');
			return false;
		}
		else
		{
			return true;
		}
	}

	// Log The User In
	private function _login()
	{			
		// Store Session
		$this->session->set_userdata( array(
			'email' => $this->input->post('email'),
			'user_id' => $this->user_id
		) );
	}

	// Log The User Out
	public function logout()
	{
		// Destory The Session
		$this->session->sess_destroy();

		// Send the User to the Login Page
		redirect('admin/login');
	}

}
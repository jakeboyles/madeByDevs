<?php
class Login extends Site_Controller
{
	// Set Class Vars
	var $user; // Set in correctLogin()

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
		//$this->load->view('admin/login');
		$data = array();
		$this->load->site_template( 'login', $data );
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
			// Check to Make Sure the Username/Password Combo work
			// & Make Sure the User is an Admin
			$this->form_validation->set_rules('email','Email Address','callback_can_log_in');
		}

		// Form Validation and Login Validation Passed
		if ( $this->form_validation->run() )
		{
			// Log the User In		
			$this->_login();
			
			// Redirect User
			redirect('/');
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
	private function _login()
	{			
		// Store Session
		$this->session->set_userdata( array(
			'email' => $this->input->post('email'),
			'user_id' => $this->user['id'],
			'user_type_id' => '1',

		) );
	}


	// Log The User Out
	public function logout()
	{
		// Destory The Session
		$this->session->sess_destroy();

		// Send the User to the Login Page
		redirect('login');
	}

}
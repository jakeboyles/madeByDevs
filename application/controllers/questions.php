<?php
class Questions extends Site_Controller
{
	// Set Class Vars
	var $user; // Set in correctLogin()

	function __construct()
	{
		parent::__construct();
		$this->load->model( 'Project_model' );
		$this->load->model( 'Comment_model' );
		$this->load->model( 'Question_model' );
		$this->load->model( 'Leader_model' );
		$this->load->helper('text');
	}

	// Display Login Page or Log the User In
	public function index()
	{
		die("TEST");
	}


	// Display Login Page or Log the User In
	public function addQuestion( $id = FALSE )
	{

		if( $this->input->post() && $this->_question_validation() )
		{	
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->Question_model->add_question($id, $this->input->post() ) )
			{
				return true;
			}

		}
	}


	private function _question_validation()
	{
		// Load Validation Library
		$this->load->library('form_validation');
		
		// Validation Rules
		$this->form_validation->set_rules('question', 'Question', 'required');
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}


}
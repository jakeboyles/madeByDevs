<?php
class Projects extends Admin_Controller
{
	// Set Class Vars
	var $user; // Set in correctLogin()

	function __construct()
	{
		parent::__construct();
		$this->load->model( 'Project_model' );
		$this->load->model( 'Comment_model' );
		$this->load->helper('text');
	}

	

	// Add New Record View
	public function add()
	{
		// If Form is Submitted Validate Form Data and Add Record to Database
		if( $this->input->post() && $this->_project_validation() )
		{	
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->Project_model->insert_record( $this->input->post() ) )
			{
				redirect('/projects/view/'.$insert_id);
			}

		}
		$data['tech']  = $this->Project_model->dropdown( 'technology', 'id', 'name' );
		$this->load->site_template( 'add_project', $data );

	}


	public function add_vote($id = false)
	{
		if( $this->input->post() )
		{	
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->Comment_model->add_vote( $this->input->post(), $id ) )
			{
				die(json_encode($insert_id));
			}

			die();
		}

	}


	public function down_vote($id = false)
	{
		if( $this->input->post() )
		{	
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->Comment_model->add_vote( $this->input->post(), $id, true ) )
			{
				die(json_encode($insert_id));
			}

			die();
		}

	}


	public function addComment($id = false)
	{
		if( $this->input->post() )
		{	
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->Project_model->add_comment($this->input->post(), $id ) )
			{
				return true;
			}

			die();
		}
	}


	private function _project_validation()
	{
		// Load Validation Library
		$this->load->library('form_validation');
		
		// Validation Rules
		$this->form_validation->set_rules('description', 'Description', 'required');
		$this->form_validation->set_rules('technology', 'Technology', 'required');
		$this->form_validation->set_rules('github', 'GitHub', 'required');
		$this->form_validation->set_rules('title', 'Title', 'required');
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}




}
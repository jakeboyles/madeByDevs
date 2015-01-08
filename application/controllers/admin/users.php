<?php
class Users extends Admin_Controller
{
	// Run Class Construct
	function __construct()
	{
		// Inherit Parent Classes Methods and Properties
		parent::__construct();

		// Load Database Model to Be Used in Methods
		$this->load->model( 'User_model' );
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
		if( $this->input->post() && $this->_validation() )
		{
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->User_model->insert_record( $this->input->post() ) )
			{
				redirect('admin/users/edit/' . $insert_id);
			}
		}

		// Load Add Record Form View
		$this->load->admin_template( 'users_add', $data );
	}

	public function profile($id = FALSE)
	{

		if($this->session->userdata('user_id')==$id)
		{
			$data['user'] = $this->User_model->get_records($id);
			$data['user'] = $data['user'][0];
			$this->load->site_template( 'user_profile',$data );	
		}
		else
		{
			redirect("login");
		}
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

}
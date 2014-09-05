<?php
class Posts extends Admin_Controller
{
	// Run Class Construct
	function __construct()
	{
		// Inherit Parent Classes Methods and Properties
		parent::__construct();

		// Load Database Models to Be Used in Methods
		$this->load->model( 'Post_model' );
		$this->load->model('Category_model');
	}

	// Display All Records View
	public function index()
	{
		$data['records'] = $this->Post_model->get_records( 'post' );
		$this->load->admin_template( 'posts', $data );
	}

	// Add New Record View
	public function add()
	{
		// If Form is Submitted Validate Form Data and Add Record to Database
		if( $this->input->post() && $this->_validation() )
		{
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->Post_model->insert_record( $this->input->post(), 'post' ) )
			{
				redirect('admin/posts/edit/' . $insert_id);
			}
		}

		// Get a List of Categories
		$data['categories'] = $this->Category_model->get_records();

		// Load Add Record Form View
		$this->load->admin_template( 'posts_add', $data );
	}

	// Edit Record View
	public function edit( $id = FALSE )
	{
		// If Form is Submitted Validate Form Data and Updated Record in Database
		if( $this->input->post() && $this->_validation() && $id )
		{
			$this->Post_model->update_record( $id, $this->input->post() );
		}

		// Load User Agent Library for Referrer Add Record Message
		$this->load->library('user_agent');

		// Retrieve Record Data From Database
		$data['record'] = $this->Post_model->get( $id );

		// Get a List of Categories
		$data['categories'] = $this->Category_model->get_records();

		// Get A List of Post Categories Assigned to This Post
		$data['post_categories'] = $this->Post_model->get_post_categories( $id );

		// Load Edit Record Form
		$this->load->admin_template( 'posts_edit', $data );
	}

	// Delete a Record
	public function delete( $id = FALSE )
	{

		if( $id )
		{
			$this->Post_model->delete_record( $id );

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
		$this->form_validation->set_rules('title', 'Post Title', 'required');
		$this->form_validation->set_rules('content', 'Content', '');
		$this->form_validation->set_rules('post_date', 'Post Date', '');

		// Slug Validation
		if( $this->uri->segment(3) == 'edit' && ( $this->input->post( 'slug' ) == $this->input->post( 'original_slug' ) ) )
		{
			$this->form_validation->set_rules('slug', 'Post Slug', 'required|alpha_dash');
		}
		else
		{
			$this->form_validation->set_rules('slug', 'Post Slug', 'required|alpha_dash|is_unique[posts.slug]');
		}
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}

}
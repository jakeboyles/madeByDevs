<?php
class Pages extends Admin_Controller
{
	// Run Class Construct
	function __construct()
	{
		// Inherit Parent Classes Methods and Properties
		parent::__construct();

		// Load Database Model to Be Used in Methods
		$this->load->model( 'Post_model' );
	}

	// Display All Records View
	public function index()
	{
		$data['records'] = $this->Post_model->get_records( 'page' );
		$this->load->admin_template( 'pages', $data );
	}

	// Add New Record View
	public function add()
	{
		// If Form is Submitted Validate Form Data and Add Record to Database
		if( $this->input->post() && $this->_validation() )
		{
			// If Successfully Inserted to DB, Redirect to Edit
			if( $insert_id = $this->Post_model->insert_record( $this->input->post(), 'page' ) )
			{
				redirect('admin/pages/edit/' . $insert_id);
			}
		}

		// Load Add Record Form View
		$this->load->admin_template( 'pages_add' );
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

		// Load Edit Record Form
		$this->load->admin_template( 'pages_edit', $data );
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
		$this->form_validation->set_rules('title', 'Page Title', 'required');
		$this->form_validation->set_rules('content', 'Content', '');

		// Slug Validation
		if( $this->uri->segment(3) == 'edit' && ( $this->input->post( 'slug' ) == $this->input->post( 'original_slug' ) ) )
		{
			$this->form_validation->set_rules('slug', 'Page Slug', 'required|alpha_dash');
		}
		else
		{
			$this->form_validation->set_rules('slug', 'Page Slug', 'required|alpha_dash|is_unique[posts.slug]');
		}
		
		// Return True if Validation Passes
		if ($this->form_validation->run())
		{
			return true;
		}
		
		return false;
	}

	// Image Upload for Redactor WYSIWYG
	public function image_upload()
	{
		$config = array(
			'upload_path' => './uploads/admin_uploads/images/',
			'upload_url' => base_url()  . './uploads/admin_uploads/images/',
			'allowed_types' => 'jpg|gif|png',
			'overwrite' => false,
			'max_size' => 512000,
		);

		$this->load->library('upload', $config);

		if( $this->upload->do_upload('file') ) 
		{
			$data = $this->upload->data();
			$array = array(
				'filelink' => $config['upload_url'] . $data['file_name']
			);
			echo stripslashes( json_encode( $array ) );
		} 
		else 
		{
			echo json_encode( array( 'error' => $this->upload->display_errors( '', '' ) ) );
		}
	}

	// Get a List of Previously Uploaded Images
	public function get_images()
	{
		$images = array();
		$files = glob( 'uploads/admin_uploads/images/*.*' );
		foreach( $files as $file )
		{
			$images[] = array( 'thumb' => base_url() . '/' . $file, 'image' => base_url() . '/' . $file );
 		}

 		echo json_encode( $images );
	}

}
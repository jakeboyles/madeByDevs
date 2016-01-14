<?php
class Projects extends Site_Controller
{
	// Set Class Vars
	var $user; // Set in correctLogin()

	function __construct()
	{
		parent::__construct();
		$this->load->model( 'Project_model' );
		$this->load->model( 'Comment_model' );
		$this->load->model( 'Question_model' );
		$this->load->helper('text');
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
		$data['tech']  = $this->Project_model->dropdown( 'technology', 'id', 'name' );
		$data['projects'] = $this->Project_model->get_records();

		$this->load->site_template( 'projects', $data );
	}


	// Display Login Page or Log the User In
	public function view( $id = FALSE )
	{

		// Load Login Form View
		//$this->load->view('admin/login');
		$data['tech']  = $this->Project_model->dropdown( 'technology', 'id', 'name' );
		$data['project'] = $this->Project_model->get_records(array("p.id"=>$id));
		$data['project'] = $data['project'][0];
		$data['comments'] = $this->Comment_model->get_records(array("c.post"=>$id));
		$data['questions'] = $this->Question_model->get_records(array("q.project_id"=>$id));
		$this->load->site_template( 'project', $data );
	}


	// Display Login Page or Log the User In
	public function search( $search = FALSE )
	{
		// Load Login Form View
		//$this->load->view('admin/login');
		$data['projects'] = $this->Project_model->search($this->input->post('search'));
		$data['tech']  = $this->Project_model->dropdown( 'technology', 'id', 'name' );
		$this->load->site_template( 'projects', $data );

	}


	public function get_by_id()
	{

		$data['tech']  = $this->Project_model->dropdown( 'technology', 'id', 'name' );
		$data['projects'] = $this->Project_model->get_by_tech( $this->input->post());
		echo $this->load->view( 'site/all_projects', $data );

	}



}
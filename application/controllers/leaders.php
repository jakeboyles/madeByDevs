<?php
class Leaders extends Site_Controller
{
	// Set Class Vars
	var $user; // Set in correctLogin()

	function __construct()
	{
		parent::__construct();
		$this->load->model( 'Project_model' );
		$this->load->model( 'Comment_model' );
		$this->load->model( 'Leader_model' );
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
		$data['techs']  = $this->Leader_model->get_leader();
		$this->load->site_template( 'leaders', $data );
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
		$this->load->site_template( 'project', $data );
	}




	public function get_by_id()
	{

		$data['tech']  = $this->Project_model->dropdown( 'technology', 'id', 'name' );
		$data['projects'] = $this->Project_model->get_by_tech( $this->input->post());
		echo $this->load->view( 'site/all_projects', $data );

	}



}
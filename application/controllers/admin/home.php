<?php
class Home extends Admin_Controller
{
	// Set Clas Vars
	protected $_table;

	function __construct()
	{
		parent::__construct();
		// Load Model Sample
		//$this->load->model('Dashboard_model');
	}

	public function index()
	{
		// Load View Sample
		// $this->load->admin_template( 'dashboard', $data );
	}

}
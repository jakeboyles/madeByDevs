<?php
class Divisions extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	// Display Divisions in a Table Format
	public function index()
	{
		$this->load->model( 'Divisions_model' );
		$data['divisions'] = $this->Divisions_model->get_divisions();
		$this->load->admin_template( 'divisions', $data );
	}

}
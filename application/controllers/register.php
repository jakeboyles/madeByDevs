<?php
class Register extends Site_Controller
{
	function __construct()
	{
		parent::__construct();

		// Load Models Needed
		$this->load->model('Division_model');
	}

	// Display the Location Search
	public function index()
	{
		$this->load->library('Dob_dropdown');
		// Store Data to Pass to View
		//$data['divisions'] = $this->Division_model->get_records();

		// Load View
		//$data['page_title'] = 'Divisions';
		$data = array();
		$data['divisions'] = $this->Division_model->dropdown( 'divisions', 'id', 'name' );

		$data['months']= $this->dob_dropdown->buildMonthDropdown('drop_month', 'drop_month');
		$data['days']= $this->dob_dropdown->buildDayDropdown('drop_day', 'drop_day');
		$data['years']= $data['dropyear'] = $this->dob_dropdown->buildYearDropdown('drop_year', 'drop_year');
		$this->load->site_template( 'register', $data );
	}
}
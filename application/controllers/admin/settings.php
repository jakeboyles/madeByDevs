<?php
class Settings extends Admin_Controller
{
	// Run Class Construct
	function __construct()
	{
		// Inherit Parent Classes Methods and Properties
		parent::__construct();

		// Load Database Model to Be Used in Methods
		$this->load->model( 'settings_model' );
	}

	// Display All Records View
	public function index()
	{
		$this->load->admin_template( 'settings');
	}


}
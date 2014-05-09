<?php
class Home extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['animals'] = array( 'cat','dog','mouse' );
		$this->load->admin_template('dashboard', $data);
	}

}
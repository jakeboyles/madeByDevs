<?php
class Divisions extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->admin_template('divisions');
	}

}
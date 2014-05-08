<?php
class Admin extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo 'admin view here';
	}

}
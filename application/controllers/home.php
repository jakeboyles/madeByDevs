<?php
class Home extends Site_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo 'site view here<br>';
	}

}
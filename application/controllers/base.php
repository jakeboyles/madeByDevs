<?php
class Base extends Base_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo 'base view here';
	}

}
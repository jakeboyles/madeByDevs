<?php
class Base_Controller extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		echo 'coming from base controller';
	}

}
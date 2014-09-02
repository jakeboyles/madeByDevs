<?php
class Home extends Site_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('Game_model');

	}

	public function index( $slug = FALSE )
	{
		// Store Data to Pass to View
		$data = array();

		// Get last 10 games that have a score reported
		$data['games'] = $this->Game_model->get_slider_games();

		// Load View
		$this->load->site_template( 'home', $data );
	}

}
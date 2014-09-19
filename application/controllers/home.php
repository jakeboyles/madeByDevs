<?php
class Home extends Site_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('Division_model');
		$this->load->model('League_model');
		$this->load->model('Post_model');
	}

	public function index( $slug = FALSE )
	{
		// Store Data to Pass to View
		$data = array();

		$data['league'] = $this->League_model->get_records();

		$data['sliders'] = $this->Post_model->fetch_posts_by_category(5,9);

		$data['headlines'] = $this->Post_model->fetch_posts_by_category(1,10);

		$data['post'] = $this->Post_model->fetch_posts(1,0,'post');
		$data['post'] = $data['post'][0];

		$data['leaders'] = $this->Division_model->get_division_leaders($data['league'][0]['current_season_id']);

		// Load View
		$this->load->site_template( 'home', $data );
	}

}
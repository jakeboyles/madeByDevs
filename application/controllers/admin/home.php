<?php
class Home extends Admin_Controller
{
	// Set Clas Vars
	protected $_table;

	function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
	}

	public function index()
	{
		// User Data
		$data['users_total'] = $this->Dashboard_model->count_all( 'users' );
		$data['users_this_month'] = $this->Dashboard_model->count_by( 
			array( 'table' => 'users', 'where' => 'YEAR(created_at) = YEAR(NOW()) AND MONTH(created_at) = MONTH(NOW())' ) 
		);

		// Games Data
		$data['games_total'] = $this->Dashboard_model->count_all( 'games' );
		$data['games_this_month'] = $this->Dashboard_model->count_by( 
			array( 'table' => 'games', 'where' => 'YEAR(game_date_time) = YEAR(NOW()) AND MONTH(game_date_time) = MONTH(NOW())' ) 
		);

		// Teams Data
		$data['teams_total'] = $this->Dashboard_model->count_all( 'teams' );
		$data['teams_this_month'] = $this->Dashboard_model->count_by( 
			array( 'table' => 'teams', 'where' => 'YEAR(created_at) = YEAR(NOW()) AND MONTH(created_at) = MONTH(NOW())' ) 
		);

		// Seasons Data
		$data['seasons_total'] = $this->Dashboard_model->count_all( 'seasons' );

		// Sessions Data
		$data['sessions_total'] = $this->Dashboard_model->count_all( 'sessions' );

		// Post Data
		$data['post_total'] = $this->Dashboard_model->count_by( 
			array( 'table' => 'posts', 'where' => 'post_type = "post"' ) 
		);

		// Page Data
		$data['page_total'] = $this->Dashboard_model->count_by( 
			array( 'table' => 'posts', 'where' => 'post_type = "page"' )
		);

		// Load View
		$this->load->admin_template( 'dashboard', $data );
	}

}
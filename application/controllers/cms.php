<?php
class Cms extends Site_Controller
{
	function __construct()
	{
		parent::__construct();

		// Load Content Model
		$this->load->model('Content_model');
		$this->load->model('Post_model');
		$this->load->model('Game_model');
		$this->load->model('Team_model');
	}

	// Figure Out How to Route the Content
	public function index()
	{
		// Set Vars
		$uri_segment_count = $this->uri->total_segments();
		$first_segment = $this->uri->segment(1);

		// Load Category Archive
		if( ( $uri_segment_count == 2 || ( $uri_segment_count == 3 && is_numeric( $this->uri->segment(3) ) ) ) && $first_segment == 'category' )
		{
			$this->category();
		}
		// Load Page
		elseif ( $uri_segment_count == 1 && $first_segment != 'category' )
		{
			$this->page();
		}
		// Load 404 Page
		else
		{
			$this->not_found();
		}
	}

	// Page or Post Display
	public function page()
	{
		// Get Page
		$page_slug = $this->uri->segment(1);
		$data['page'] = $this->Content_model->get_page( $page_slug );

		// Load Page If One was Found
		if( $data['page'])
		{
			// Store Page Title
			$data['page_title'] = $data['page']['title'];

			// Load Page View
			if( $data['page']['post_type'] == 'page' )
			{
				$this->load->site_template( 'page', $data );
			}
			// Load Post View 
			elseif( $data['page']['post_type'] == 'post' )
			{
				$this->load->site_template( 'post', $data );
			}
		}
		// Else Load 404 Page
		else
		{
			$this->not_found();
		}
	}

	// Category Archive Display
	public function category()
	{
		// Get Category
		$category_slug = $this->uri->segment(2);

		// See If This Category Slug Exists
		$category = $this->Content_model->get_category_by_slug( $category_slug );

		// If Category Was found Load Archive View
		if( $category )
		{
			// Grab Post Count
			$post_count = $this->Content_model->get_post_count( $category['id'] );

			// Set Query Vars
			$posts_per_page = 2;
			$offset = $this->uri->segment(3) ? $this->uri->segment(3) : 0;

			// Create Pagination
			$this->load->library('pagination');
			$config['base_url'] = base_url( 'category/' . $category_slug );
			$config['total_rows'] = $post_count;
			$config['per_page'] = $posts_per_page;

			$config['full_tag_open'] = '<div class="pagination"><ul>';
			$config['full_tag_close'] = '</ul></div>';
			$config['first_tag_open'] = '<li class="prev page">';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li class="next page">';
			$config['last_tag_close'] = '</li>';
			$config['next_link'] = '&gt;';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_link'] = '&lt;';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><span>';
			$config['cur_tag_close'] = '</span></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';

			$this->pagination->initialize( $config );
			$data['pagination_links'] = $this->pagination->create_links();

			// Load Posts
			$limit = array( $posts_per_page, $offset );
			$data['posts'] = $this->Content_model->get_posts_by_category_id( $category['id'], $limit );

			// Store Category
			$data['category'] = $category;

			// Store Page Title
			$data['page_title'] = $data['category']['name'] . ' Archive';

			// Load View
			$this->load->site_template( 'archive', $data );
		}
		// Else Load 404 Page
		else
		{
			$this->not_found();
		}
	}

	// Load Blog Page
	public function blog()
	{
		$data['page_title'] = 'Blog';

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$this->load->library('pagination');

		//Set base url for the blog 
		$config['base_url'] =  base_url() . '/cms/blog';

		
		// How many show per page?
		$config['per_page'] = 5;

		// Get all posts in pagination style (Number per page, page number, type of content)
		$data['blogs'] = $this->Post_model->fetch_posts($config["per_page"], $page,'post');

		$config['total_rows'] = count($this->Post_model->count_posts('post'));

		$this->pagination->initialize($config);

		// Build the pagination links
		$data["links"] = $this->pagination->create_links();

		$this->load->site_template( 'blog', $data );
	}


	// Load Blog Page
	public function official()
	{
		$this->user_is_ref();
		
		$data['page_title'] = 'Official Dashboard';

		$data['games'] = $this->Game_model->get_games_dropdown();

		$data['teams'] = $this->Team_model->dropdown( 'teams', 'id', 'name', 'name ASC' );

		$this->load->site_template( 'official', $data );
	}



	// Load 404 Page
	public function not_found()
	{
		$data['page_title'] = 'Page Not Found';
		$this->load->site_template( '404', $data );
	}

	// Load Sample/Boilerplate Page
	// To Do: Remove this and make via CMS
	public function sample()
	{
		$this->load->site_template( 'sample' );
	}
}
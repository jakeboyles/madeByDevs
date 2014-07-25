<?php
class Cms extends Site_Controller
{
	function __construct()
	{
		parent::__construct();

		// Load Content Model
		$this->load->model('Content_model');
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
				$this->load->site_template( 'page', $data );
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
<?php
class Post_model extends MY_Model
{
	// Callbacks to MY_Model class to Run Before Record Inserts
	public $before_create = array( 'created_at', 'created_by' );
	public $before_update = array( 'modified_by' );
	public $return_type = 'array';
	//public $before_dropdown = array( 'order_by(name)' );

	// Get Records
	public function get_records( $post_type = false, $id = false )
	{
		// Construct Query
		$this->db->select( 'p.id, p.post_type,c.name as category, p.author_id,m.filename as featured_image_filename, p.title, p.content,p.featured_image, p.slug, p.created_at, p.modified_at, u.first_name as author_first_name, u.last_name as author_last_name' );
		$this->db->join( 'users u', 'u.id = p.author_id', 'left outer' );
		$this->db->join( 'media m', 'm.id = p.featured_image', 'left outer' );
		$this->db->join( 'post_categories pc', 'pc.post_id = p.id', 'left outer' );
		$this->db->join( 'categories c', 'c.id = pc.category_id', 'left outer' );

		if( $post_type )
		{
			$this->db->where( 'post_type', $post_type );
		}

		// Run Query
		$query = $this->db->get( 'posts p' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

		return false;
	}


		// Get Records
	public function get_by_id( $id = false )
	{
		// Construct Query
		$this->db->select( 'p.id, p.post_type,p.post_date, p.author_id,m.filename as featured_image_filename, p.title, p.content,p.featured_image, p.slug, p.created_at, p.modified_at, u.first_name as author_first_name, u.last_name as author_last_name' );
		$this->db->join( 'users u', 'u.id = p.author_id', 'left outer' );
		$this->db->join( 'media m', 'm.id = p.featured_image', 'left outer' );

		if( $id )
		{
			$this->db->where( 'p.id', $id);
		}

		$atts['single'] = TRUE;

		// Run Query
		$query = $this->db->get( 'posts p' );

		if($query->num_rows > 0)
		{
			if( !empty( $atts['single'] ) )
			{
				$row = $query->row_array();
				return $row;
			}
			else
			{
				$rows = $query->result_array();
				return $rows;
			}
			
		}

		return false;
	}

	// Add Record
	public function insert_record( $post = FALSE, $post_type = FALSE )
	{
		if( $post && $post_type )
		{

			if($_FILES['featured_image']['error'] == '0')
			{
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '5000';
				$config['max_width']  = '2000';
				$config['max_height']  = '2000';

				$this->load->library('upload', $config);

				$error = array();


					// The field name for the file upload would be logo
					if ( ! $this->upload->do_upload('featured_image'))
					{
						$error['errors'] = $this->upload->display_errors();
						return $error;
					}
					else
					{
						$imagefile = array('upload_data' => $this->upload->data());

						$data = array(
							'filename' => $imagefile['upload_data']['file_name'],
							'mime_type' => $imagefile['upload_data']['file_type']
						);

						$image = $this->db->insert('media',$data);

						$image = $this->db->insert_id();

						$this->load->library('image_lib');

						for( $i = 2; $i < 4; $i++ )
						{
							if($i==2) 
							{
								$config['image_library'] = 'GD2';
								$config['source_image'] = 'uploads/'.$imagefile['upload_data']['file_name'];
								$config['new_image'] = 'uploads/'."slider-".$imagefile['upload_data']['file_name'];
								$config['maintain_ratio'] = TRUE;
								$config['width'] = 800;
								$config['height'] = 350;
								$config['create_thumb'] = false;

								$this->image_lib->initialize($config);  

								if ( ! $this->image_lib->fit())
								{
								    echo $this->image_lib->display_errors();
								}
							}
							elseif($i==3)
							{
								$config['image_library'] = 'GD2';
								$config['source_image'] = 'uploads/'.$imagefile['upload_data']['file_name'];
								$config['new_image'] = 'uploads/'."slider-small-".$imagefile['upload_data']['file_name'];
								$config['maintain_ratio'] = TRUE;
								$config['width'] = 800;
								$config['height'] = 450;
								$config['create_thumb'] = false;
								 $this->image_lib->clear();

								 $this->image_lib->initialize($config);  

								if ( ! $this->image_lib->fit())
								{
								    echo $this->image_lib->display_errors();
								}
							}
						}

					}		
			}

			// Determine URL Slug
			$slug = empty( $post['slug'] ) ? $post['title'] : $post['slug'];
			$slug = str_replace(' ', '-', $slug); // Replaces all spaces with hyphens.
			$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug); // Removes special chars
			$slug = strtolower( $slug ); // conver the string to all lower case

			// Insert Data
			$data = array(
				'post_type' => $post_type,
				'author_id' => $this->session->userdata('user_id'),
				'title' => empty( $post['title'] ) ? NULL : $post['title'],
				'post_date' => empty( $post['post_date'] ) ? $this->mysql_datetime() : $this->mysql_datetime($post['post_date']),
				'slug' => $slug,
				'content' => empty( $post['content'] ) ? NULL : $post['content'],
				'featured_image' => empty( $image ) ? NULL : $image,
			);

			// Insert to Database and Store Insert ID
			$insert_id = $this->insert( $data );

			// Assign Categories to the Post
			if( !empty( $post['categories'] ) )
			{
				foreach( $post['categories'] as $category_id )
				{
					$post_categories[] = array(
						'post_id' => $insert_id,
						'category_id' => $category_id,
						'created_at' => $this->mysql_datetime(),
						'created_by' => $this->session->userdata( 'user_id' )
					);
				}
				$this->db->insert_batch( 'post_categories', $post_categories ); 
			}

			// Return Insert ID
			return $insert_id;
		}

		return false;
	}

	// Edit Record
	public function update_record( $id = FALSE, $post = FALSE )
	{
		if( $id && $post )
		{

			if($_FILES['featured_image']['error'] == '0')
			{
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '5000';
				$config['max_width']  = '2000';
				$config['max_height']  = '2000';

				$this->load->library('upload', $config);

					// The field name for the file upload would be logo
					if ( ! $this->upload->do_upload('featured_image'))
					{
						return $this->upload->display_errors();
					}
					else
					{
						$imagefile = array('upload_data' => $this->upload->data());

						$data = array(
							'filename' => $imagefile['upload_data']['file_name'],
							'mime_type' => $imagefile['upload_data']['file_type']
						);

						$image = $this->db->insert('media',$data);

						$image = $this->db->insert_id();


						$this->load->library('image_lib');

						for( $i = 2; $i < 4; $i++ )
						{
							if($i==2) 
							{
								$config['image_library'] = 'GD2';
								$config['source_image'] = 'uploads/'.$imagefile['upload_data']['file_name'];
								$config['new_image'] = 'uploads/'."slider-".$imagefile['upload_data']['file_name'];
								$config['maintain_ratio'] = TRUE;
								$config['width'] = 800;
								$config['height'] = 350;
								$config['create_thumb'] = false;

								$this->image_lib->initialize($config);  

								if ( ! $this->image_lib->fit())
								{
								    echo $this->image_lib->display_errors();
								}
							}
							elseif($i==3)
							{
								$config['image_library'] = 'GD2';
								$config['source_image'] = 'uploads/'.$imagefile['upload_data']['file_name'];
								$config['new_image'] = 'uploads/'."slider-small-".$imagefile['upload_data']['file_name'];
								$config['maintain_ratio'] = TRUE;
								$config['width'] = 800;
								$config['height'] = 450;
								$config['create_thumb'] = false;
								 $this->image_lib->clear();

								 $this->image_lib->initialize($config);  

								if ( ! $this->image_lib->fit())
								{
								    echo $this->image_lib->display_errors();
								}
							}
						}


						//die($config2['source_image']);

					}		
			}

			// Determine URL Slug
			$slug = empty( $post['slug'] ) ? $post['title'] : $post['slug'];
			$slug = str_replace(' ', '-', $slug); // Replaces all spaces with hyphens.
			$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug); // Removes special chars
			$slug = strtolower( $slug ); // conver the string to all lower case

			$oldImage = NULL;

			if(!empty($post['featured_image_edit']))
			{
				$oldImage = $post['featured_image_edit'];
			}

			// Update Data
			$data = array(
				'title' => empty( $post['title'] ) ? NULL : $post['title'],
				'slug' => $slug,
				'content' => empty( $post['content'] ) ? NULL : $post['content'],
				'post_date' => empty( $post['post_date'] ) ? $this->mysql_datetime() : $this->mysql_datetime($post['post_date']),
				'featured_image' => empty( $image ) ? $oldImage : $image,
			);

			// Update Record in Database
			$this->update( $id, $data );

			// Delete Previous Categories From this Post
			$this->db->where( 'post_id', $id );
			$this->db->delete( 'post_categories' );

			// Assign Categories to the Post
			if( !empty( $post['categories'] ) )
			{
				foreach( $post['categories'] as $category_id )
				{
					$post_categories[] = array(
						'post_id' => $id,
						'category_id' => $category_id,
						'created_at' => $this->mysql_datetime(),
						'created_by' => $this->session->userdata( 'user_id' )
					);
				}
				$this->db->insert_batch( 'post_categories', $post_categories ); 
			}		

			// Return True
			return true;
		}

		return false;
	}

	// Delete record
	public function delete_record( $id = FALSE )
	{
		// If an ID Was Found in URL
		if( $id )
		{
			// Delete Relationships from the post_categories table First
			$this->db->where( 'post_id', $id );
			$this->db->delete( 'post_categories' );

			// Delete Actual Post
			$this->delete( $id );
		}

		return false;
	}

	// Get Categories By Post ID
	public function get_post_categories( $post_id = FALSE )
	{	
		$this->db->select( 'c.id, c.name, c.slug, c.created_at, c.created_by, c.modified_at, c.modified_by' );
		$this->db->join( 'categories c', 'c.id = pc.category_id', 'left outer' );
		$this->db->where( 'post_id', $post_id );
		$query = $this->db->get( 'post_categories pc' );

		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();

			$categories = array();
			foreach( $rows as $row )
			{
				$categories[$row['id']] = $row;
			}
			return $categories;
		}

		return false;
	}

	public function record_count($post_type) {
		if( $post_type )
		{
			$this->db->where( 'post_type', $post_type );
			$this->db->where('post_date <=',date("Y-m-d H:i:s",strtotime("0 day")));
		}
        return $this->db->count_all_results("posts p");
    }


	public function fetch_posts($limit = FALSE, $start = FALSE, $post_type = FALSE) {
		var_dump($post_type);
		$this->db->limit($limit, $start);
        $this->db->select( 'p.id, p.post_type,pc.category_id,m.filename,c.name as category, p.author_id, p.title, p.content, p.slug, p.created_at, p.modified_at, u.first_name as author_first_name, u.last_name as author_last_name' );
		$this->db->join( 'users u', 'u.id = p.author_id', 'left outer' );
		$this->db->join( 'post_categories pc', 'pc.post_id = p.id', 'left outer' );
		$this->db->join( 'categories c', 'c.id = pc.category_id', 'left outer' );
		$this->db->join( 'media m', 'm.id = p.featured_image', 'left outer' );
		$this->db->order_by( 'p.post_date', 'DESC' );
		$this->db->where('post_date <=',date("Y-m-d H:i:s",strtotime("0 day")));
		$names = array(10,9);
		$this->db->where('category_id', NULL);
		if( !empty($post_type) )
		{	
			$this->db->where( 'post_type', $post_type );
		}

		$this->db->or_where_not_in('category_id', $names);


		// Run Query
		$query = $this->db->get( 'posts p' );

		var_dump($this->db->last_query());
		exit();

 
		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

		return false;
	}



	public function count_posts($post_type = FALSE) {

        $this->db->select( 'p.id, p.post_type,pc.category_id,c.name as category, p.author_id, p.title, p.content, p.slug, p.created_at, p.modified_at, u.first_name as author_first_name, u.last_name as author_last_name' );
		$this->db->join( 'users u', 'u.id = p.author_id', 'left outer' );
		$this->db->join( 'post_categories pc', 'pc.post_id = p.id', 'left outer' );
		$this->db->join( 'categories c', 'c.id = pc.category_id', 'left outer' );
		$this->db->order_by( 'p.post_date', 'DESC' );
		$this->db->where('post_date <=',date("Y-m-d H:i:s",strtotime("0 day")));
		$names = array(10,9);
		$this->db->where('category_id', NULL);
		$this->db->or_where_not_in('category_id', $names);

		if( $post_type )
		{
			$this->db->where( 'post_type', $post_type );
		}

		// Run Query
		$query = $this->db->get( 'posts p' );

 
		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

		return false;
	}


	public function fetch_posts_by_category($limit, $category) {

		$this->db->limit($limit);
        $this->db->select( 'p.id, p.post_type, p.author_id, p.title,m.filename, p.content,p.featured_image, p.slug, p.created_at, p.modified_at' );
		$this->db->join( 'posts p', 'p.id = pc.post_id', 'left outer' );
		$this->db->join( 'media m', 'm.id = p.featured_image', 'left outer' );
		$this->db->where('pc.category_id', $category);
		$this->db->order_by( 'id', 'DESC' );

		// Run Query
		$query = $this->db->get( 'post_categories pc' );

 
		// If Rows Were Found, Return Them
		if($query->num_rows > 0)
		{
			$rows = $query->result_array();
			return $rows;
		}

		return false;
	}

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
	}

	public function index($rowno=0,$ajax='call',$serach='')
	{
		// $users_data = $this->custom_model->my_where('users','*',array('id!=' =>'1'));		

		$this->load->library('pagination');  

   		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}		
		 // Row per page
    	$rowperpage = 10;
    	$page_no=0;

    	// Row position
    	if($rowno != 0)
    	{
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}
    	if($ajax=='call')
		{
   			$users_data = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school ,users.username  FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id INNER JOIN users ON users.id = posts.user_id  WHERE posts.status='active' AND posts.type != '' ORDER BY posts.id DESC LIMIT $rowno,$rowperpage ");


   			$users_count = $this->custom_model->get_data_array("SELECT id  FROM users WHERE id!='1'  Order BY id DESC ");   			

   		}else 
   		{
			if(empty($serach))
			{
				$users_data = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school,users.username FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id INNER JOIN users ON users.id = posts.user_id  WHERE  posts.status='active' AND posts.type != ''  ORDER BY posts.id DESC LIMIT $rowno,$rowperpage ");
				
				$users_count = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school,users.username FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id INNER JOIN users ON users.id = posts.user_id  WHERE  posts.status='active' AND posts.type != ''    ");

			}
			else 
			{
				$users_data = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school,users.username FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id INNER JOIN users ON users.id = posts.user_id  WHERE posts.type != ''  AND  posts.status='active' AND  ( users.username LIKE '%$serach%'  OR posts.created_at LIKE '%$serach%' OR university_schools.name LIKE '%$serach%' OR posts.type LIKE '%$serach%'  )  ORDER BY posts.id DESC LIMIT $rowno,$rowperpage ");


				$users_count = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school,users.username FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id INNER JOIN users ON users.id = posts.user_id  WHERE posts.type != ''  AND   posts.status='active' AND  ( users.username LIKE '%$serach%'  OR posts.created_at LIKE '%$serach%' OR university_schools.name LIKE '%$serach%' OR posts.type LIKE '%$serach%'  )  ORDER BY posts.id DESC ");

			}
		}



		$config['base_url'] = base_url().'admin/post/index';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = count($users_count);
	    $config['per_page'] = $rowperpage;   
	    $config['page_query_string'] = FALSE;             
	    $config['enable_query_strings'] = FALSE;             
	    $config['reuse_query_string']  = FALSE;             
	    $config['cur_page'] = $page_no;  
	    
	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $users_data;
	    $data['row'] = $rowno;
	    $data['total_rows'] = count($users_count);
	    // $this->mViewData['pagination'] = $this->pagination->create_links();	
	    // this for when page load	     				
	    if($ajax =='call' && $rowno==0 && empty($post_data)){			    	
	    	$this->mViewData['pagination'] = $this->pagination->create_links();		     				
		}elseif($serach !='') {  // this for search button pagination
			echo json_encode($data);
 			exit;    				 
		}else { // this for pagination-
 			echo json_encode($data);
 			exit; 	
		}
		// $users_data = $this->custom_model->get_data_array("SELECT * FROM users WHERE id!='1' ORDER BY id desc ");

		// echo "<pre>";
		// print_r($users_data);
		// die;

		$this->mViewData['users_data'] = $users_data;

		$this->mPageTitle = 'Post listing';
		$this->render('post/listing');
	}


	public function admin($rowno=0,$ajax='call',$serach='')
	{
		// $users_data = $this->custom_model->my_where('users','*',array('id!=' =>'1'));		

		$this->load->library('pagination');  

   		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}		
		 // Row per page
    	$rowperpage = 10;
    	$page_no=0;

    	// Row position
    	if($rowno != 0)
    	{
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}
    	if($ajax=='call')
		{
   			$users_data = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school   FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id   WHERE posts.status='active' AND posts.admin_id = '1' AND posts.type != '' ORDER BY posts.id DESC LIMIT $rowno,$rowperpage ");

   			// echo $this->db->last_query();

   			$users_count = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school   FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id   WHERE posts.status='active' AND posts.admin_id = '1' AND posts.type != '' ");		

   		}else 
   		{
			if(empty($serach))
			{
				$users_data = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id   WHERE  posts.status='active' AND posts.type != '' AND posts.admin_id = '1'  ORDER BY posts.id DESC LIMIT $rowno,$rowperpage ");
				
				$users_count = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id   WHERE  posts.status='active' AND posts.admin_id = '1' AND posts.type != ''    ");

			}
			else 
			{
				$users_data = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id   WHERE posts.type != '' AND posts.admin_id = '1'  AND  posts.status='active' AND  (  posts.created_at LIKE '%$serach%' OR university_schools.name LIKE '%$serach%' OR posts.type LIKE '%$serach%'  )  ORDER BY posts.id DESC LIMIT $rowno,$rowperpage ");


				$users_count = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id  WHERE posts.type != ''  AND posts.admin_id = '1' AND   posts.status='active' AND  ( posts.created_at LIKE '%$serach%' OR university_schools.name LIKE '%$serach%' OR posts.type LIKE '%$serach%'  )  ORDER BY posts.id DESC ");

			}
		}

		
		// echo "<br>";


		$config['base_url'] = base_url().'admin/users/index';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = count($users_count);
	    $config['per_page'] = $rowperpage;   
	    $config['page_query_string'] = FALSE;             
	    $config['enable_query_strings'] = FALSE;             
	    $config['reuse_query_string']  = FALSE;             
	    $config['cur_page'] = $page_no;  
	    
	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $users_data;
	    $data['row'] = $rowno;
	    $data['total_rows'] = count($users_count);
	    // $this->mViewData['pagination'] = $this->pagination->create_links();	
	    // this for when page load	     				
	    if($ajax =='call' && $rowno==0 && empty($post_data)){			    	
	    	$this->mViewData['pagination'] = $this->pagination->create_links();		     				
		}elseif($serach !='') {  // this for search button pagination
			echo json_encode($data);
 			exit;    				 
		}else { // this for pagination-
 			echo json_encode($data);
 			exit; 	
		}
		// $users_data = $this->custom_model->get_data_array("SELECT * FROM users WHERE id!='1' ORDER BY id desc ");

		// echo "<pre>";
		// print_r($users_data);
		// die;

		$this->mViewData['users_data'] = $users_data;

		$this->mPageTitle = 'Admin Post Listing';
		$this->render('post/admin_listing');
	}


	public function poll_create()
	{
		// $form = $this->form_builder->create_form();
		$form = $this->form_builder->create_form('','','id="create_post" class=""');

		$post_data = $this->input->post();
		if ( !empty($post_data) )
		{
			$user_id = $post_data['user_id'];

			// echo "<pre>";
			// print_r($post_data);
			// die;		

			$group_id 			= @$post_data['group_id'];
			$post_through_group = $post_data['post_through_group'];
			$university_post_id = $post_data['university_post_id'];
			$question = $post_data['question'];
			$options = $post_data['options'];


			if ($post_data['post_through_group'] == 'no') 
			{
	   	 		$group_id = '';
			}

			$additional_data = array();

			if(!empty($group_id)) $additional_data['group_id'] 								= $group_id;
			if(!empty($post_through_group)) $additional_data['post_through_group'] 			= $post_through_group;
			if(!empty($question)) $additional_data['question'] 								= $question;
			if(!empty($university_post_id)) $additional_data['university_post_id'] 			= $university_post_id;
			$additional_data['type'] 														= 'poll';
			$additional_data['status'] 														= 'active';

			if ($user_id == 1) 
			{
				$additional_data['admin_id'] 													= '1';
			}
			else
			{
				$additional_data['user_id'] 													= $user_id;
			}

			// echo "<pre>";
			// print_r($additional_data);
			// die;

			$post_id = $this->custom_model->my_insert($additional_data,"posts");

			if (!empty($options)) 
			{
				$add_data = array();
				foreach ($options as $key => $value) 
				{
					if(!empty($user_id)) $add_data['user_id'] 			= $user_id;
					$add_data['options'] 								= $value;
					$add_data['post_id'] 								= $post_id;

					$response = $this->custom_model->my_insert($add_data,"posts_options");
				}
			}
			
			if ($response)
			{
				// success
				$this->system_message->set_success('Post added successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
		
		
		refresh();
		}


		$university_schools = $this->custom_model->my_where("university_schools","id,name,status",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );
		$this->mViewData['university_schools'] = $university_schools;


		$users = $this->custom_model->my_where("users","id,username",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );
		$this->mViewData['users'] = $users;

		// echo "<pre>";
		// print_r($users);
		// die;	


		$this->mPageTitle = 'Create Post';

		$this->mViewData['form'] = $form;
		$this->render('post/poll_create');
	}

	public function check_group_available_not($user_id = '',$group_id = '')
	{
		if (!empty($user_id) && !empty($group_id)) 
		{
			$data = $this->custom_model->my_where('groups','id',array('id'=>$group_id),array(),"","","","", array(), "",array(),false );

			if (!empty($data)) 
			{
				$check = $this->custom_model->my_where('group_users','id',array('group_id'=>$group_id,"user_id" => $user_id),array(),"","","","", array(), "",array(),false );
				if (empty($check)) 
				{
					return "invalid_group_selection";
					// echo json_encode(array("status" => false  ,"message" =>"invalid_group_selection" )); die;
				}
			}
			else
			{
				return "invalid_group_selection";
				// echo json_encode(array("status" => false  ,"message" =>"Invalid group selection" )); die;
			}
		}
	}


	public function poll_edit($post_id)
	{
		$form = $this->form_builder->create_form('','','id="edit_post" class=""');

		$post_data = $this->input->post();
		
		if ( !empty($post_data) )
		{
			$group_checkk = '';
			$user_id = $post_data['user_id'];

			// echo "<pre>";
			// print_r($post_data);
			// die;	

			$post_through_group = $post_data['post_through_group'];
			$university_post_id = $post_data['university_post_id'];
			$question = $post_data['question'];
			$options = 	$post_data['options'];
			$group_id = @$post_data['group_id'];


			if ($post_data['post_through_group'] == 'no') 
			{
	   	 		$group_id = '';
			}

			if ($post_data['post_through_group'] == 'yes') 
			{

				if (empty($group_id)) 
				{
					$post_through_group = 'no';
				}
				else
				{
				}
			}
			
			if ($user_id != 1) 
			{
				$group_checkk = $this->check_group_available_not($user_id,$group_id);
			}

			// echo $group_checkk;
			// echo "<br>";
			// die;
			
			if ($group_checkk == '') 
			{
				$additional_data = array();

				$additional_data['group_id'] 													= $group_id;
				if(!empty($post_through_group)) $additional_data['post_through_group'] 			= $post_through_group;
				if(!empty($question)) $additional_data['question'] 								= $question;
				if(!empty($university_post_id)) $additional_data['university_post_id'] 			= $university_post_id;
				$additional_data['type'] 														= 'poll';
				$additional_data['status'] 														= 'active';

				if ($user_id == 1) 
				{
					$additional_data['admin_id'] 													= '1';
					$additional_data['user_id'] 													= '';
				}
				else
				{
					$additional_data['user_id'] 													= $user_id;
					$additional_data['admin_id'] 													= '';
				}


				// echo "<pre>";
				// print_r($additional_data);
				// die;

				$response = $this->custom_model->my_update($additional_data,array('id' => $post_id),'posts');

				if (!empty($options)) 
				{
					$this->custom_model->my_delete(array("post_id" => $post_id),"posts_options");

					$add_data = array();
					foreach ($options as $key => $value) 
					{
						if (!empty($value)) 
						{
							if(!empty($user_id)) $add_data['user_id'] 			= $user_id;
							$add_data['options'] 								= $value;
							$add_data['post_id'] 								= $post_id;
							$response = $this->custom_model->my_insert($add_data,"posts_options");
						}
					}
				}			

				if ($response)
				{
					// success
					$this->system_message->set_success('Post updated successfully');
				}
				else
				{
					// failed
					$this->system_message->set_error('Something went wrong');
				}
			}
			else
			{
				$this->system_message->set_error('Invalid group selection');
			}

			
			refresh();
		}


		$university_schools = $this->custom_model->my_where("university_schools","id,name,status",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );
		$this->mViewData['university_schools'] = $university_schools;


		$users = $this->custom_model->my_where("users","id,username",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );
		$this->mViewData['users'] = $users;


		$post = $this->custom_model->my_where('posts','*',array('id' => $post_id));
		$post[0]['options'] = $this->custom_model->my_where('posts_options','*',array('post_id' => $post_id));


		$group_id 	= $post[0]['group_id'];
		$user_id 	= $post[0]['user_id'];
		$admin_id 	= $post[0]['admin_id'];

		$group_users = array();

		if (!empty($group_id) && empty($admin_id)) 
		{
			$group_users = $this->custom_model->my_where('group_users','group_id',array('user_id'=> $user_id));
			if ($group_users) 
			{
				foreach ($group_users as $dkey => $valfue) 
				{
					$check_g = $this->custom_model->my_where('groups','group_name',array('id' => $valfue['group_id']),array(),"","","","", array(), "",array(),false );
					if ($check_g) 
					{
						$group_users[$dkey]['group_name'] = $check_g[0]['group_name'];
					}
					else
					{
						$group_users[$dkey]['group_name'] = 'Girish No group';
					}
				}
			}
		}
		else
		{
			$group_users = $this->custom_model->my_where('groups','*',array('university_group_id' => $post[0]['university_post_id']),array(),"","","","", array(), "",array(),false );
			if (!empty($group_users)) 
			{
				foreach ($group_users as $dkey => $valfue) 
				{
					$group_users[$dkey]['group_id'] = $valfue['id'];
				}
			}

		}

		$this->mViewData['group_id'] 	= $group_id;
		$this->mViewData['select_group'] = $group_users;
		
		// echo "<pre>";
		// print_r($admin_id);
		// print_r($post);
		// die;

		$this->mPageTitle = 'Edit post';
		$this->mViewData['edit'] = $post[0];
		$this->mViewData['form'] = $form;
		$this->render('post/poll_edit');
	}


	public function get_user_school_uni()
	{
		$post_data = $this->input->post();			
		if(!empty($post_data))
		{
			$uid = $post_data['u_id'];
			$users = $this->custom_model->my_where('users','id,university_school_id',array('id'=>$uid));
			
			$university_id = @$users[0]['university_school_id'];

			// echo "<pre>";
			// print_r($post_data);
			// print_r($users);
			// die;	

			if ($uid != 1) 
			{
				$school = $this->custom_model->my_where('university_schools','id,name',array('id'=> $university_id));
			}
			else
			{
				$school = $this->custom_model->my_where('university_schools','id,name',array('status'=> 'active'));
			}


			if(!empty($school))
			{
				echo json_encode($school);			
				die;
			}
			else 
			{
				echo "not_found";
				die;
			}	
										
		}
		else 
		{
			echo 0;
			die;
		}			
	}

	public function get_user_groups()
	{
		$post_data = $this->input->post();			
		if(!empty($post_data))
		{
			$user_id = $post_data['user_id'];

			$check = $this->custom_model->my_where('group_users','id',array("user_id" => $user_id),array(),"","","","", array(), "",array(),false );

			// echo "<pre>";
			// print_r($check);
			// print_r($post_data);
			// die;	

			if ($user_id != 1) 
			{
				$group_users = $this->custom_model->my_where('group_users','group_id',array('user_id'=> $user_id));

				if (!empty($group_users)) 
				{
					foreach ($group_users as $dkey => $valfue) 
					{
						$check_g = $this->custom_model->my_where('groups','group_name',array('id' => $valfue['group_id']),array(),"","","","", array(), "",array(),false );
						if ($check_g) 
						{
							$group_users[$dkey]['group_name'] = $check_g[0]['group_name'];
						}
						else
						{
							$group_users[$dkey]['group_name'] = 'Girish No group';
						}
					}

					echo json_encode($group_users);
					die;
				}
				else
				{
					echo 'not_found';
					die;
				}

				// echo "<pre>";
				// print_r($check);
				// print_r($group_users);
				// die;
			}
			else
			{
				$check = $this->custom_model->my_where('groups','*',array('university_group_id' => $post_data['university_post_id']),array(),"","","","", array(), "",array(),false );
				if (!empty($check)) 
				{
					foreach ($check as $dkey => $valfue) 
					{
						$check[$dkey]['group_id'] = $valfue['id'];
					}

					echo json_encode($check);
					die;
				}
			}
			
			echo "not_found";
			die;
				
										
		}
		else 
		{
			echo "not_found";
			die;
		}			
	}


	public function event_create()
	{
		// $form = $this->form_builder->create_form();
		$form = $this->form_builder->create_form('','','id="create_event" class="create_event"');

		$post_data = $this->input->post();
		if ( !empty($post_data) )
		{

			// echo "<pre>";
			// print_r($post_data);
			// die;		

			$user_id 				= $post_data['user_id'];
			$event_title 			= @$post_data['event_title'];
			$event_link 			= @$post_data['event_link'];
			$event_description 		= @$post_data['event_description'];
			$post_through_group 	= $post_data['post_through_group'];
			$university_post_id 	= $post_data['university_post_id'];
			$event_images 			= $post_data['event_images'];


			if ($post_data['post_through_group'] == 'no') 
			{
	   	 		$group_id = '';
			}

			$additional_data = array();

			if(!empty($event_title)) $additional_data['event_title'] 						= $event_title;
			if(!empty($event_link)) $additional_data['event_link'] 							= $event_link;
			if(!empty($event_description)) $additional_data['event_description'] 			= $event_description;
			if(!empty($group_id)) $additional_data['group_id'] 								= $group_id;
			if(!empty($post_through_group)) $additional_data['post_through_group'] 			= $post_through_group;
			if(!empty($university_post_id)) $additional_data['university_post_id'] 			= $university_post_id;
			$additional_data['type'] 														= 'event';


			if ($user_id == 1) 
			{
				$additional_data['admin_id'] 													= '1';
			}
			else
			{
				$additional_data['user_id'] 													= $user_id;
			}

			// echo "<pre>";
			// print_r($additional_data);
			// die;

			$post_id = $this->custom_model->my_insert($additional_data,"posts");

			if (!empty($event_images)) 
			{
				$event_images = trim($event_images,',');
				$lists = explode(',', $event_images); 
				foreach ($lists as $key => $value) 
				{
					// if(!empty($user_id)) $add_data['user_id'] 		= $user_id;
					$add_data['attachment'] 							= $value;
					$add_data['post_id'] 								= $post_id;
					$add_data['attachment_type'] 						= 'image';
					$this->custom_model->my_insert($add_data,"post_attachments");
				}
			}


			
			if ($post_id)
			{
				// success
				$this->system_message->set_success('Event added successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
		
		
		refresh();
		}


		$university_schools = $this->custom_model->my_where("university_schools","id,name,status",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );
		$this->mViewData['university_schools'] = $university_schools;


		$users = $this->custom_model->my_where("users","id,username",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );
		$this->mViewData['users'] = $users;

		// echo "<pre>";
		// print_r($users);
		// die;	


		$this->mPageTitle = 'Create Post';

		$this->mViewData['form'] = $form;
		$this->render('post/event_create');
	}

	public function event_edit($post_id)
	{
		$form = $this->form_builder->create_form('','','id="edit_event" class=""');

		$post_data = $this->input->post();
		
		if ( !empty($post_data) )
		{
			$group_checkk = '';
			$user_id = $post_data['user_id'];

			// echo "<pre>";
			// print_r($post_data);
			// die;	

			$event_images = $post_data['event_images'];
			$post_through_group = $post_data['post_through_group'];
			$university_post_id = $post_data['university_post_id'];
			$group_id = @$post_data['group_id'];

			$event_title = $post_data['event_title'];
			$event_link = 	$post_data['event_link'];
			$event_description = 	$post_data['event_description'];

			if ($post_data['post_through_group'] == 'no') 
			{
	   	 		$group_id = '';
			}

			if ($post_data['post_through_group'] == 'yes') 
			{
				if (empty($group_id)) 
				{
					$post_through_group = 'no';
				}				
			}
			
			if ($user_id != 1) 
			{
				$group_checkk = $this->check_group_available_not($user_id,$group_id);
			}

			// echo $group_checkk;
			// echo "<br>";
			// die;
			
			if ($group_checkk == '') 
			{
				$additional_data = array();

				$additional_data['group_id'] 													= $group_id;
				if(!empty($post_through_group)) $additional_data['post_through_group'] 			= $post_through_group;

				if(!empty($event_title)) $additional_data['event_title'] 						= $event_title;
				if(!empty($event_link)) $additional_data['event_link'] 							= $event_link;
				if(!empty($event_description)) $additional_data['event_description'] 			= $event_description;

				if(!empty($university_post_id)) $additional_data['university_post_id'] 			= $university_post_id;
				$additional_data['type'] 														= 'event';
				$additional_data['status'] 														= 'active';

				if ($user_id == 1) 
				{
					$additional_data['admin_id'] 													= '1';
					$additional_data['user_id'] 													= '';
				}
				else
				{
					$additional_data['user_id'] 													= $user_id;
					$additional_data['admin_id'] 													= '';
				}


				// echo "<pre>";
				// print_r($event_images);
				// die;

				$response = $this->custom_model->my_update($additional_data,array('id' => $post_id),'posts');

				$this->custom_model->my_delete(array("post_id" => $post_id),"post_attachments");
				if (!empty($event_images)) 
				{

					$event_images = trim($event_images,',');
					$lists = explode(',', $event_images); 
					foreach ($lists as $key => $value) 
					{
						// if(!empty($user_id)) $add_data['user_id'] 		= $user_id;
						$add_data['attachment'] 							= $value;
						$add_data['post_id'] 								= $post_id;
						$add_data['attachment_type'] 						= 'image';

						$this->custom_model->my_insert($add_data,"post_attachments");
					}
				}		

				if ($response)
				{
					// success
					$this->system_message->set_success('Event updated successfully');
				}
				else
				{
					// failed
					$this->system_message->set_error('Something went wrong');
				}
			}
			else
			{
				$this->system_message->set_error('Invalid group selection');
			}

			
			refresh();
		}


		$university_schools = $this->custom_model->my_where("university_schools","id,name,status",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );
		$this->mViewData['university_schools'] = $university_schools;


		$users = $this->custom_model->my_where("users","id,username",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );
		$this->mViewData['users'] = $users;


		$post = $this->custom_model->my_where('posts','*',array('id' => $post_id));
		$post[0]['options'] = $this->custom_model->my_where('posts_options','*',array('post_id' => $post_id));


		$group_id 	= $post[0]['group_id'];
		$user_id 	= $post[0]['user_id'];
		$admin_id 	= $post[0]['admin_id'];

		$group_users = array();

		if (!empty($group_id) && empty($admin_id)) 
		{
			$group_users = $this->custom_model->my_where('group_users','group_id',array('user_id'=> $user_id));
			if ($group_users) 
			{
				foreach ($group_users as $dkey => $valfue) 
				{
					$check_g = $this->custom_model->my_where('groups','group_name',array('id' => $valfue['group_id']),array(),"","","","", array(), "",array(),false );
					if ($check_g) 
					{
						$group_users[$dkey]['group_name'] = $check_g[0]['group_name'];
					}
					else
					{
						$group_users[$dkey]['group_name'] = 'Girish No group';
					}
				}
			}
		}
		else
		{
			$group_users = $this->custom_model->my_where('groups','*',array('university_group_id' => $post[0]['university_post_id']),array(),"","","","", array(), "",array(),false );
			if (!empty($group_users)) 
			{
				foreach ($group_users as $dkey => $valfue) 
				{
					$group_users[$dkey]['group_id'] = $valfue['id'];
				}
			}
		}

		$this->mViewData['group_id'] 	= $group_id;
		$this->mViewData['select_group'] = $group_users;
		

		$post_attachments = $this->custom_model->my_where("post_attachments","attachment",array("post_id" =>$post_id),array(),"","","","", array(), "",array(),false  );

		$event_images = "";
		if ($post_attachments) 
		{
			foreach ($post_attachments as $size) {
			    $event_images .= $size['attachment'].',';
			}
			$event_images = substr($event_images, 0,-1);
		}


		$this->mViewData['event_images'] = $event_images;

		// echo "<pre>";
		// print_r($event_images);
		// print_r($post_attachments);
		// die;

		$this->mPageTitle = 'Edit post';
		$this->mViewData['edit'] = $post[0];
		$this->mViewData['form'] = $form;
		$this->render('post/event_edit');
	}

	public function media_create()
	{
		// $form = $this->form_builder->create_form();
		$form = $this->form_builder->create_form('','','id="create_media" class="create_media" enctype="multipart/form-data" ');

		


		$post_data = $this->input->post();
		if ( !empty($post_data) )
		{
			// echo "<pre>";
			// print_r($_FILES);
			// die;

			$details = array( "caption" => "My Logo", "action" => "fiu_upload_file", "path" => "/public/post_imgs/" );
			$path = $details['path'];
			$upl_dir =  ASSETS_PATH;
			$up_dir =   strstr($upl_dir, '/api', true);

			$upl_dir = $up_dir.$path;

			$videos = array();
			$countfiles = count($_FILES['video']['name']);

			for($i=0; $i<$countfiles; $i++)
			{
				$file_name = $_FILES['video']['name'][$i];
				if (!empty($file_name)) 
				{
					$random_digit = rand(0000, 9999);
					$target_file  = $upl_dir . basename($_FILES['video']['name'][$i]);
					$ext          = pathinfo($target_file, PATHINFO_EXTENSION);
					$new_file_name = $random_digit . "." . $ext;
					$path          = $upl_dir . $new_file_name;
					move_uploaded_file($_FILES['video']['tmp_name'][$i],$path);
					$videos[] = $new_file_name;
				}
			}

			// echo "<pre>";
			// print_r($videos);
			// print_r($post_data);
			// die;
	

			$user_id 				= $post_data['user_id'];
			$caption 				= @$post_data['caption'];
			$post_through_group 	= $post_data['post_through_group'];
			$university_post_id 	= $post_data['university_post_id'];
			$event_images 			= $post_data['event_images'];


			if ($post_data['post_through_group'] == 'no') 
			{
	   	 		$group_id = '';
			}

			$additional_data = array();

			if(!empty($caption)) $additional_data['caption'] 								= $caption;
			if(!empty($group_id)) $additional_data['group_id'] 								= $group_id;
			if(!empty($post_through_group)) $additional_data['post_through_group'] 			= $post_through_group;
			if(!empty($university_post_id)) $additional_data['university_post_id'] 			= $university_post_id;
			$additional_data['type'] 														= 'normal';


			if ($user_id == 1) 
			{
				$additional_data['admin_id'] 													= '1';
			}
			else
			{
				$additional_data['user_id'] 													= $user_id;
			}

			// echo "<pre>";
			// print_r($additional_data);
			// die;

			$post_id = $this->custom_model->my_insert($additional_data,"posts");

			if (!empty($event_images)) 
			{
				$event_images = trim($event_images,',');
				$lists = explode(',', $event_images); 
				foreach ($lists as $key => $value) 
				{
					$add_data['attachment'] 							= $value;
					$add_data['post_id'] 								= $post_id;
					$add_data['attachment_type'] 						= 'image';
					$this->custom_model->my_insert($add_data,"post_attachments");
				}
			}

			if (!empty($videos)) 
			{
				foreach ($videos as $dkey => $dvalue) 
				{
					$add_data['attachment'] 							= $dvalue;
					$add_data['post_id'] 								= $post_id;
					$add_data['attachment_type'] 						= 'video';
					$add_data['thumbnail'] 								= 'thumbnail.png';
					$this->custom_model->my_insert($add_data,"post_attachments");
				}
			}



			
			if ($post_id)
			{
				// success
				$this->system_message->set_success('Media event added successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
		
		
		refresh();
		}


		$university_schools = $this->custom_model->my_where("university_schools","id,name,status",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );
		$this->mViewData['university_schools'] = $university_schools;


		$users = $this->custom_model->my_where("users","id,username",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );
		$this->mViewData['users'] = $users;

		// echo "<pre>";
		// print_r($users);
		// die;	


		$this->mPageTitle = 'Create Post';

		$this->mViewData['form'] = $form;
		$this->render('post/media_create');
	}

	public function media_edit($post_id)
	{
		$form = $this->form_builder->create_form('','','id="edit_event" class="edit_event" enctype="multipart/form-data" ');

		$post_data = $this->input->post();
		
		if ( !empty($post_data) )
		{
			$group_checkk = '';
			$user_id = $post_data['user_id'];

			// echo "<pre>";
			// print_r($post_data);
			// die;
			$details = array( "caption" => "My Logo", "action" => "fiu_upload_file", "path" => "/public/post_imgs/" );
			$path = $details['path'];
			$upl_dir =  ASSETS_PATH;
			$up_dir =   strstr($upl_dir, '/api', true);

			$upl_dir = $up_dir.$path;

			$videos = array();
			$countfiles = count($_FILES['video']['name']);

			for($i=0; $i<$countfiles; $i++)
			{
				$file_name = $_FILES['video']['name'][$i];
				if (!empty($file_name)) 
				{
					$random_digit = rand(0000, 9999);
					$target_file  = $upl_dir . basename($_FILES['video']['name'][$i]);
					$ext          = pathinfo($target_file, PATHINFO_EXTENSION);
					$new_file_name = $random_digit . "." . $ext;
					$path          = $upl_dir . $new_file_name;
					move_uploaded_file($_FILES['video']['tmp_name'][$i],$path);
					$videos[] = $new_file_name;
				}
			}	


			$event_images = $post_data['event_images'];
			$post_through_group = $post_data['post_through_group'];
			$university_post_id = $post_data['university_post_id'];
			$group_id = @$post_data['group_id'];

			$caption = 	$post_data['caption'];

			if ($post_data['post_through_group'] == 'no') 
			{
	   	 		$group_id = '';
			}

			if ($post_data['post_through_group'] == 'yes') 
			{
				if (empty($group_id)) 
				{
					$post_through_group = 'no';
				}				
			}
			
			if ($user_id != 1) 
			{
				$group_checkk = $this->check_group_available_not($user_id,$group_id);
			}

			// echo $group_checkk;
			// echo "<br>";
			// die;
			
			if ($group_checkk == '') 
			{
				$additional_data = array();

				if(!empty($caption)) $additional_data['caption'] 								= $caption;
				$additional_data['group_id'] 													= $group_id;
				if(!empty($post_through_group)) $additional_data['post_through_group'] 			= $post_through_group;
				if(!empty($university_post_id)) $additional_data['university_post_id'] 			= $university_post_id;
				$additional_data['type'] 														= 'normal';
				$additional_data['status'] 														= 'active';

				if ($user_id == 1) 
				{
					$additional_data['admin_id'] 													= '1';
					$additional_data['user_id'] 													= '';
				}
				else
				{
					$additional_data['user_id'] 													= $user_id;
					$additional_data['admin_id'] 													= '';
				}


				// echo "<pre>";
				// print_r($additional_data);
				// die;

				$response = $this->custom_model->my_update($additional_data,array('id' => $post_id),'posts');

				$this->custom_model->my_delete(array("post_id" => $post_id,"attachment_type"=> 'image'),"post_attachments");
				if (!empty($event_images)) 
				{

					$event_images = trim($event_images,',');
					$lists = explode(',', $event_images); 
					foreach ($lists as $key => $value) 
					{
						// if(!empty($user_id)) $add_data['user_id'] 		= $user_id;
						$add_data['attachment'] 							= $value;
						$add_data['post_id'] 								= $post_id;
						$add_data['attachment_type'] 						= 'image';

						$this->custom_model->my_insert($add_data,"post_attachments");
					}
				}

				if (!empty($videos)) 
				{
					foreach ($videos as $dkey => $dvalue) 
					{
						$add_data['attachment'] 							= $dvalue;
						$add_data['post_id'] 								= $post_id;
						$add_data['attachment_type'] 						= 'video';
						$add_data['thumbnail'] 								= 'thumbnail.png';
						$this->custom_model->my_insert($add_data,"post_attachments");
					}
				}

		

				if ($response)
				{
					// success
					$this->system_message->set_success('Media event updated successfully');
				}
				else
				{
					// failed
					$this->system_message->set_error('Something went wrong');
				}
			}
			else
			{
				$this->system_message->set_error('Invalid group selection');
			}
			
			refresh();
		}


		$university_schools = $this->custom_model->my_where("university_schools","id,name,status",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );
		$this->mViewData['university_schools'] = $university_schools;


		$users = $this->custom_model->my_where("users","id,username",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );
		$this->mViewData['users'] = $users;


		$post = $this->custom_model->my_where('posts','*',array('id' => $post_id));
		$post[0]['options'] = $this->custom_model->my_where('posts_options','*',array('post_id' => $post_id));


		$group_id 	= $post[0]['group_id'];
		$user_id 	= $post[0]['user_id'];
		$admin_id 	= $post[0]['admin_id'];

		$group_users = array();

		if (!empty($group_id) && empty($admin_id)) 
		{
			$group_users = $this->custom_model->my_where('group_users','group_id',array('user_id'=> $user_id));
			if ($group_users) 
			{
				foreach ($group_users as $dkey => $valfue) 
				{
					$check_g = $this->custom_model->my_where('groups','group_name',array('id' => $valfue['group_id']),array(),"","","","", array(), "",array(),false );
					if ($check_g) 
					{
						$group_users[$dkey]['group_name'] = $check_g[0]['group_name'];
					}
					else
					{
						$group_users[$dkey]['group_name'] = 'Girish No group';
					}
				}
			}
		}
		else
		{
			$group_users = $this->custom_model->my_where('groups','*',array('university_group_id' => $post[0]['university_post_id']),array(),"","","","", array(), "",array(),false );
			if (!empty($group_users)) 
			{
				foreach ($group_users as $dkey => $valfue) 
				{
					$group_users[$dkey]['group_id'] = $valfue['id'];
				}
			}
		}

		$this->mViewData['group_id'] 	= $group_id;
		$this->mViewData['select_group'] = $group_users;
		

		$post_attachments = $this->custom_model->my_where("post_attachments","*",array("post_id" =>$post_id,"attachment_type"=> 'image'),array(),"","","","", array(), "",array(),false  );

		$event_images = "";
		if ($post_attachments) 
		{
			foreach ($post_attachments as $size) {
			    $event_images .= $size['attachment'].',';
			}
			$event_images = substr($event_images, 0,-1);
		}


		$this->mViewData['event_images'] = $event_images;

		$post_video = $this->custom_model->my_where("post_attachments","*",array("post_id" =>$post_id,"attachment_type"=> 'video'),array(),"","","","", array(), "",array(),false  );
		$this->mViewData['post_video'] 	 = $post_video;

		// echo "<pre>";
		// print_r($event_images);
		// print_r($post_video);
		// die;

		$this->mPageTitle = 'Edit post';
		$this->mViewData['edit'] = $post[0];
		$this->mViewData['form'] = $form;
		$this->render('post/media_edit');
	}

	public function delete_video()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$video_id = $post_data['video_id'];

    		$this->custom_model->my_delete(['id' => $video_id], 'post_attachments');
    		echo 1;
    		die;
    	}
    	else 
    	{
    		echo 0;
    		die;
    	}
    }

    public function delete_post()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$post_id = $post_data['post_id'];
    		$this->custom_model->my_delete(['id' => $post_id], 'posts');
    		echo 1;
    		die;
    	}
    	else 
    	{
    		echo 0;
    		die;
    	}
    }

    public function delete_all_post()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		// echo "<pre>";
    		// print_r($post_data);
    		// die;

    		$post_id = $post_data['post_id'];
    		$this->custom_model->my_delete(['id !=' => ''], 'posts');
    		$this->custom_model->my_delete(['id !=' => ''], 'posts_options');
    		$this->custom_model->my_delete(['id !=' => ''], 'post_attachments');
    		$this->custom_model->my_delete(['id !=' => ''], 'post_comment_likes');
    		$this->custom_model->my_delete(['id !=' => ''], 'post_options_select_by_user');
    		$this->custom_model->my_delete(['id !=' => ''], 'post_tag_groups');
    		$this->custom_model->my_delete(['id !=' => ''], 'report_user_post');
    		echo 1;
    		die;
    	}
    	else 
    	{
    		echo 0;
    		die;
    	}
    }

    public function edit($p_id )
    {
    	$post = $this->custom_model->my_where('posts','type',array('id' => $p_id));
    	
    	if (!empty($post)) 
    	{
    		$type = $post[0]['type'];

    		if ($type == 'poll') 
    		{
    			$asd =  base_url("admin/post/poll_edit/".$p_id);
    			redirect($asd);
    		}

    		if ($type == 'event') 
    		{
    			$asd =  base_url("admin/post/event_edit/".$p_id);
    			redirect($asd);
    		}    		
    		else
    		{
    			$asd =  base_url("admin/post/media_edit/".$p_id);
    			redirect($asd);
    		}
    	}
    	else
    	{
    		// redirect(404)
    	}


    	echo "<pre>";
    	print_r($post);
    	echo $p_id;
    	die;

    }
}

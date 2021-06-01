<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');

		// $this->users_id_check();
	}


	public function users_id_check()
	{
		$check = $this->custom_model->get_data_array("SELECT id, university_school_email ,university_school_id,email_domain FROM  users ");

		echo "<pre>";
		// print_r($check);
		// die;
		

	

 		if ($check) 
 		{

 			foreach ($check as $key => $value) 
 			{
 				$user_id = $value['id'];
 				$email_domain = $value['email_domain'];
 				$university_school_email = $value['university_school_email'];

 				$email_domain = substr($university_school_email, strpos($university_school_email, "@") + 1);    


 				$d_domain = '@'.$email_domain;

				$sd_check = $this->custom_model->get_data_array("SELECT university_id FROM domains WHERE `domain` = '$d_domain' ");

				echo "<pre>";
				print_r($email_domain);

				echo "<br>";
				print_r($sd_check);

				echo "<br>";
				echo $this->db->last_query();
				echo "<br>";
				die;


				if ($sd_check) 
				{
					$additional_data['university_school_id'] = $sd_check[0]['university_id'];
					$additional_data['email_domain'] = $email_domain;

					$result = $this->custom_model->my_update($additional_data,array("id" => $user_id),"users");

					$check[$key]['university_id_match'] = $sd_check[0]['university_id'];
				}
				else
				{
					$name =  preg_replace('/[^A-Za-z0-9\-]/', ' ', $email_domain);

					// echo "<pre>";
					// print_r($sd_check);
					// echo ">>>";
					// print_r($d_domain);
					// die;

		 			$data['name'] 				= $name;
		 			$data['dean_name'] 			= 'John Doe';
		 			$data['no_of_students'] 	= '10000';
		 			$data['status'] 			= 'active ';

		 			$university_id = $this->custom_model->my_insert($data,"university_schools");

		 			$domain_insert['university_id'] 		= $university_id;
		 			$domain_insert['domain'] 				= $d_domain;
		 			$domain_insert['status'] 				= 'active ';

		 			$domain_id = $this->custom_model->my_insert($domain_insert,"domains");

				}
 			}
	 	}
 		
 	}


	public function deleted_users()
	{
		$crud = $this->generate_crud('delete_users');
		$crud->columns('id','username' , 'university_school_email','university_school_id' ,'created_at');
		
		// $crud->set_field_upload('image', UPLOAD_BLOG_POST);

		$crud->set_relation('university_school_id','university_schools','name');



		$crud->display_as('university_school_id','University/Schools');
		$crud->display_as('university_school_email','Email');
		$crud->display_as('created_at','Delete date');
		
		$crud->set_theme('datatables');

		// disable direct create / delete Category
		$crud->unset_add();
		// $crud->unset_delete();
		$crud->unset_edit();
		$crud->unset_read();
		// $crud->unset_operations();

		// $crud->add_action('translate', '', 'admin/application/tedit', '');
		// $crud->add_action('edit', '', 'admin/application/edit', '');


		$this->mPageTitle = 'Deleted user';
		$this->render_crud();
	}

	public function post($rowno=0,$ajax='call',$serach='')
	{
		$uid = $rowno;
		$rowno=0;

		// echo $rowno;
		// die;

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
    	$rowperpage = 150;
    	$page_no=0;

    	// Row position
    	if($rowno != 0)
    	{
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}
    	if($ajax=='call')
		{
   			$users_data = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school,users.username   FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id INNER JOIN users ON users.id = posts.user_id    WHERE posts.status='active' AND posts.user_id = '$uid' AND posts.type != '' ORDER BY posts.id DESC LIMIT $rowno,$rowperpage ");

   			// echo $this->db->last_query();

   			$users_count = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school,users.username   FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id INNER JOIN users ON users.id = posts.user_id   WHERE posts.status='active' AND posts.user_id = '$uid' AND posts.type != '' ");		

   		}else 
   		{
			if(empty($serach))
			{
				$users_data = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school,users.username FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id  INNER JOIN users ON users.id = posts.user_id WHERE  posts.status='active' AND posts.type != '' AND posts.user_id = '$uid'  ORDER BY posts.id DESC LIMIT $rowno,$rowperpage ");
				
				$users_count = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school,users.username FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id INNER JOIN users ON users.id = posts.user_id  WHERE  posts.status='active' AND posts.user_id = '$uid' AND posts.type != ''    ");

			}
			else 
			{
				$users_data = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school,users.username FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id  INNER JOIN users ON users.id = posts.user_id WHERE posts.type != '' AND posts.user_id = '$uid'  AND  posts.status='active' AND  (  posts.created_at LIKE '%$serach%' OR university_schools.name LIKE '%$serach%' OR posts.type LIKE '%$serach%'  )  ORDER BY posts.id DESC LIMIT $rowno,$rowperpage ");


				$users_count = $this->custom_model->get_data_array("SELECT posts.user_id,posts.id,posts.admin_id,posts.university_post_id,posts.post_through_group,posts.status,posts.type,posts.created_at , university_schools.name as university_school FROM posts INNER JOIN university_schools ON university_schools.id = posts.university_post_id  INNER JOIN users ON users.id = posts.user_id WHERE posts.type != ''  AND posts.user_id = '$uid'  AND   posts.status='active' AND  ( posts.created_at LIKE '%$serach%' OR university_schools.name LIKE '%$serach%' OR posts.type LIKE '%$serach%'  )  ORDER BY posts.id DESC ");

			}
		}

		
		// echo "<br>";


		$config['base_url'] = base_url().'admin/users/post';
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

		// echo "<pre>";
		// print_r($users_data);
		// die;

		$this->mViewData['users_data'] = $users_data;

		$this->mPageTitle = 'User Post Listing';
		$this->render('users/user_post_listing');
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
    	$rowperpage = 30;
    	$page_no=0;

    	// Row position
    	if($rowno != 0){
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}
    	if($ajax=='call')
		{
   			$users_data = $this->custom_model->get_data_array("SELECT id,created_at,username,university_school_email,user_type,university_school_id,status,email_domain  FROM users WHERE  id!='1'  Order BY id DESC limit $rowno,$rowperpage ");   			
   			$users_count = $this->custom_model->get_data_array("SELECT id  FROM users WHERE id!='1'  Order BY id DESC ");   			

   		}else 
   		{
			if(empty($serach))
			{
				$users_data = $this->custom_model->get_data_array("SELECT id,created_at,username,university_school_email,user_type,university_school_id,status,email_domain  FROM users WHERE  id!='1'  Order BY id DESC limit $rowno,$rowperpage ");

   				$users_count = $this->custom_model->get_data_array("SELECT id  FROM users WHERE id!='1'  Order BY id DESC ");  
			}
			else 
			{				
				
				$users_data = $this->custom_model->get_data_array("SELECT id,created_at,username,university_school_email,user_type,university_school_id,status,email_domain FROM users WHERE (username LIKE '%$serach%' OR `created_at` LIKE '%$serach%'  OR username LIKE '%$serach%'  OR user_type LIKE '%$serach%' ) AND id!='1'  ORDER BY `id` DESC LIMIT $rowno,$rowperpage ");

				$users_count = $this->custom_model->get_data_array("SELECT id FROM users WHERE (username LIKE '%$serach%'  OR created_at LIKE '%$serach%' OR username LIKE '%$serach%' OR user_type LIKE '%$serach%' ) AND  id!='1'  ORDER BY `id` DESC ");			
			}
		}
		if(!empty($users_data))
		{
			foreach ($users_data as $ud_key => $ud_val) 
			{
				$users_data[$ud_key]['created_at'] = date('M-d-Y' ,strtotime($ud_val['created_at']));

				$user_id=$ud_val['id'];
				$user_type = $ud_val['user_type'];

				$university_school_id = $ud_val['university_school_id'];

				$university_school = $this->custom_model->get_data_array("SELECT name FROM university_schools WHERE `id` ='$university_school_id' ");
				$users_data[$ud_key]['university_school'] = @$university_school[0]['name'];

				

				if ($user_type ==0) 
				{
					$users_data[$ud_key]['user_type'] = 'Student';
				}
				else if ($user_type == 1) 
				{
					$users_data[$ud_key]['user_type'] = 'Faculty';
				}
				else if ($user_type == 2) 
				{
					$users_data[$ud_key]['user_type'] = 'Teacher';
				}

				$order_count = $this->custom_model->get_data_array("SELECT COUNT(id) as post_count FROM posts WHERE `user_id` ='$user_id' ");
				$users_data[$ud_key]['post_count'] = $order_count[0]['post_count'];
			}
		}

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

		$this->mPageTitle = 'User List' ;		
		$this->mViewData['users_data'] = $users_data;
		$this->render('users/listing');
	}
	
	public function create()
	{
		$form = $this->form_builder->create_form('','','id="validation" class=""');

		$post_data = $this->input->post();

		if ($post_data) 
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;

			$username = $post_data['username'];
			$university_school_email = $post_data['university_school'].''.$post_data['university_school_email'];
			
			$check_uname = $this->custom_model->my_where("users","*",array("username" => $username ),array(),"","","","", array(), "",array(),false  );
			if (!empty($check_uname)) 
			{
				echo 'username';
    			die;
			}

			$check_email = $this->custom_model->my_where("users","*",array("university_school_email" => $university_school_email ),array(),"","","","", array(), "",array(),false  );
			if (!empty($check_uname)) 
			{
				echo 'email';
    			die;
			}

			$password = password_hash($post_data['password'], PASSWORD_BCRYPT);


			// $ass['user_type']    		 = 0;
			$ass['username'] 			 = $post_data['username'];
			$ass['university_school_id'] = $post_data['university_school_id'];
			$ass['university_school_email'] = $university_school_email;
			$ass['status'] 				= $post_data['status'];
			$ass['password'] 			= $password;
			$ass['decoded_password'] 	= $post_data['password'];

			$response = $this->custom_model->my_insert($ass,'users');
			echo 'success';
    		die;
		}

		
		$university_schools = $this->custom_model->my_where("university_schools","id,name,status",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );



		$this->mPageTitle = 'Create User';

		// echo "<pre>";
		// print_r($data); 
		// die;

		// print_r($data_master); die;

		$this->mViewData['university_schools'] = $university_schools;
		$this->mViewData['form'] = $form;
		$this->render('admin/users/create');
	}

	public function user_edit($user_id)
	{
		$form = $this->form_builder->create_form('','','id="validation" class=""');

		$post_data = $this->input->post();

		if ($post_data) 
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;

			$username = $post_data['username'];
			$university_school_email = $post_data['university_school'].''.$post_data['university_school_email'];
			
			$check_uname = $this->custom_model->my_where("users","*",array("username" => $username , "id !=" => $user_id ),array(),"","","","", array(), "",array(),false  );
			if (!empty($check_uname)) 
			{
				echo 'username';
    			die;
			}

			$check_email = $this->custom_model->my_where("users","*",array("university_school_email" => $university_school_email , "id !=" => $user_id ),array(),"","","","", array(), "",array(),false  );
			if (!empty($check_uname)) 
			{
				echo 'email';
    			die;
			}

			if ($post_data['password']) 
			{
				$password = password_hash($post_data['password'], PASSWORD_BCRYPT);
				$ass['password'] 			= $password;
				$ass['decoded_password'] 	= $post_data['password'];
			}

			
			$ass['username'] 			 = $post_data['username'];
			$ass['university_school_id'] = $post_data['university_school_id'];
			$ass['university_school_email'] = $university_school_email;
			$ass['status'] 				= $post_data['status'];
			

			$response = $this->custom_model->my_update($ass, array("id" => $user_id),'users');
			echo 'success';
    		die;
		}

		
		$university_schools = $this->custom_model->my_where("university_schools","id,name,status",array("status" =>'active'),array(),"","","","", array(), "",array(),false  );

		$data = $this->custom_model->my_where("users","*",array("id" =>$user_id) );

		$this->mPageTitle = 'Edit user';

		$domains = $this->custom_model->my_where("domains",'domain',array("university_id" =>$data[0]['university_school_id']),array(),"","","","", array(), "",array(),false  );

		$university_school_email = $data[0]['university_school_email'];

		// echo "<pre>";
		// print_r($university_school_email); 
		// print_r($data); 
		// print_r($domains); 

		$s = 'Posted On jan 3rd By Some Dude';
		$data[0]['email'] = strstr($university_school_email, $domains[0]['domain'], true);

		// print_r($data); die;

		$this->mViewData['domains'] = $domains[0]['domain'];
		$this->mViewData['university_schools'] = $university_schools;
		$this->mViewData['edit'] = $data[0];
		$this->mViewData['form'] = $form;
		$this->render('admin/users/user_edit');
	}

	public function show_friends($user_id)
	{
		$form = $this->form_builder->create_form('','','id="validation" class=""');

		$post_data = $this->input->post();

		
		$data = $this->custom_model->my_where("users","*",array("id" =>$user_id) );


		$friend_lists = $this->custom_model->my_where("friend_lists",'id,friend_id',array("user_id" =>$user_id),array(),"","","","", array(), "",array(),false  );
		if (!empty($friend_lists)) 
		{
			foreach ($friend_lists as $key => $value) 
			{
				$friend_id = $value['friend_id'];
				$friend_data= $this->custom_model->my_where("users",'*',array("id" =>$friend_id) );
				if ($friend_data) 
				{
					$friend_lists[$key]['username'] = $friend_data[0]['username'];
					$friend_lists[$key]['university_school_email'] = $friend_data[0]['university_school_email'];
					$friend_lists[$key]['profile_image'] = $this->get_profile_path($friend_data[0]['profile_image']);
				}
				else
				{
					$friend_lists[$key]['username'] = '';
					$friend_lists[$key]['university_school_email'] = '';
				}
			}
		}


		// echo "<pre>";
		// print_r($friend_lists); 
		// die;

		$this->mPageTitle = 'Friend List';
		$this->mViewData['friend_lists'] = $friend_lists;
		$this->mViewData['form'] = $form;
		$this->render('admin/users/friend_listing');
	}

	public function get_profile_path($image)
	{
		if (!empty($image))
		{
			$str = "http://15.206.103.14/public/profile_imgs/".$image;
			return $str;
		}
   	}

	public function edit($uid)
	{
		$form = $this->form_builder->create_form('','','id="wizard_with_validation" class="wizard clearfix"');

		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		$data = $this->custom_model->my_where("users","*",array("id" => $uid),array(),"","","","", array(), "",array(),false  );


		$user_highlights = $this->custom_model->get_data_array("SELECT *  FROM user_highlights WHERE  `user_id` = '$uid'  Order BY id DESC "); 
		if (empty($user_highlights)) 
		{
			$p_data['user_id'] = $uid;
			$this->custom_model->my_insert($p_data,'user_highlights');
			$user_highlights = $this->custom_model->get_data_array("SELECT *  FROM user_highlights WHERE  `user_id` = '$uid'  Order BY id DESC ");
		}


		$user_education = $this->custom_model->get_data_array("SELECT *  FROM user_education WHERE  `user_id`='$uid'  Order BY id DESC "); 
		$user_experience = $this->custom_model->get_data_array("SELECT *  FROM user_experience WHERE  `user_id`='$uid'  Order BY id DESC "); 
		$user_achievements = $this->custom_model->get_data_array("SELECT *  FROM user_achievements WHERE  `user_id`='$uid'  Order BY id DESC "); 

		$user_social_profile = $this->custom_model->my_where("user_social_profile","*",array("user_id" => $uid),array(),"","","","", array(), "",array(),false  );
		if (empty($user_social_profile)) 
		{
			$s_data['user_id'] = $uid;
			$this->custom_model->my_insert($s_data,'user_social_profile');
			$user_social_profile = $this->custom_model->get_data_array("SELECT *  FROM user_social_profile WHERE  `user_id` = '$uid'  Order BY id DESC ");
		}


		$user_interest = $this->custom_model->my_where("user_interest","*",array("user_id" => $uid),array(),"","","","", array(), "",array(),false  );
		if ($user_interest)
		{
			foreach ($user_interest as $key => $value)
			{
				$ins_name[] = $value['interest_name'];
			}
			$user_interest = implode(", ", $ins_name);
			// echo $comma_separated ;
		}
		else
		{
			$user_interest = '';
		}


		$user_course = $this->custom_model->my_where("user_course","*",array("user_id" => $uid),array(),"","","","", array(), "",array(),false  );
		if ($user_course)
		{
			foreach ($user_course as $skey => $cvalue)
			{
				$cor_name[] = $cvalue['name'];
			}

			$user_course = implode(", ", $cor_name);
			// echo $comma_separated ;
		}
		else
		{
			$user_course = '';
		}

		$user_languages = $this->custom_model->my_where("user_languages","*",array("user_id" => $uid),array(),"","","","", array(), "",array(),false  );
		if ($user_languages)
		{
			foreach ($user_languages as $skey => $cvalue)
			{
				$lan_name[] = $cvalue['language_name'];
			}
			
			$user_languages = implode(", ", $lan_name);
			// echo $comma_separated ;
		}
		else
		{
			$user_languages = '';
		}



		


		// $data_master = $this->custom_model->my_where("order_master","*",array("user_id" => $uid),array(),"","","","", array(), "",array(),false  );
		// if (!empty($data_master)) 
		// {
		// 	foreach ($data_master as $kcey => $vcalue) 
		// 	{
		// 		$oid = $vcalue['order_master_id'];
		// 		$o_item = $this->custom_model->my_where("order_items","product_name,quantity,price",array("order_no" => $oid),array(),"","","","", array(), "",array(),false  );
			
		// 		$data_master[$kcey]['order_item'] = $o_item;
		// 	}

			
		// }

		$this->mPageTitle = 'Edit details';

		// echo "<pre>";
		// print_r($user_course); 
		// print_r($user_interest); 
		// print_r($user_social_profile); 
		// print_r($user_achievements); 
		// print_r($user_education); 
		// print_r($user_highlights); 
		// print_r($data); 
		// die;

		// print_r($data_master); die;

		$this->mViewData['form'] = $form;
		$this->mViewData['edit'] = $data[0];
		$this->mViewData['user_languages'] = $user_languages;
		$this->mViewData['user_course'] = $user_course;
		$this->mViewData['user_interest'] = $user_interest;
		$this->mViewData['user_social_profile'] = $user_social_profile;
		$this->mViewData['user_achievements'] = $user_achievements;
		$this->mViewData['user_education'] = $user_education;
		$this->mViewData['user_experience'] = $user_experience;
		$this->mViewData['user_highlights'] = $user_highlights;
		// $this->mViewData['products'] = $data_master;
		$this->render('admin/users/edit');
	}

    public function delete_achievements()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$aid = $post_data['aid'];

    		$this->custom_model->my_delete(['id' => $aid], 'user_achievements');
    		echo 1;
    		die;
    	}
    	else 
    	{
    		echo 0;
    		die;
    	}
    }

    public function delete_education()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$e_id = $post_data['e_id'];
    		$this->custom_model->my_delete(['id' => $e_id], 'user_education');
    		echo 1;
    		die;
    	}
    	else 
    	{
    		echo 0;
    		die;
    	}
    }

    public function delete_experience()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$ue_id = $post_data['ue_id'];
    		$this->custom_model->my_delete(['id' => $ue_id], 'user_experience');
    		echo 1;
    		die;
    	}
    	else 
    	{
    		echo 0;
    		die;
    	}
    }

    public function update_self_introduction()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$username = $post_data['username'];
			$user_id = $post_data['user_id'];
			
			$check_uname = $this->custom_model->my_where("users","*",array("id !=" => $user_id,"username" => $username ),array(),"","","","", array(), "",array(),false  );
			if (!empty($check_uname)) 
			{
				echo 'username';
    			die;
			}
			$associative['username'] = $post_data['username'];
			$associative['designation'] = $post_data['designation'];
			$associative['organisation'] = $post_data['organisation'];
			$response = $this->custom_model->my_update($associative,array('id' => $user_id),'users');
			echo 'success';
    		die;
		}
	}

	public function update_personal_mission_statement()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$user_id = $post_data['user_id'];
			
			$associ_ative['personal_mission'] = $post_data['personal_mission'];
			$associ_ative['personal_description'] = $post_data['personal_description'];

			$response = $this->custom_model->my_update($associ_ative,array('id' => $user_id),'users');
			echo 'success';
    		die;
		}
	}

	public function update_personal_highlights()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$user_id 								= $post_data['user_id'];			
			$associ_ative['currently_working'] 		= $post_data['currently_working'];
			$associ_ative['currently_studying'] 	= $post_data['currently_studying'];
			$associ_ative['graduated_from'] 		= $post_data['graduated_from'];
			$associ_ative['complete_highschool_at'] = $post_data['complete_highschool_at'];
			$associ_ative['lives_in'] 				= $post_data['lives_in'];
			$associ_ative['from'] 					= $post_data['from'];

			$response = $this->custom_model->my_update($associ_ative,array('user_id' => $user_id),'user_highlights');
			echo 'success';
    		die;
		}
	}

	public function update_social_media()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$user_id 								= $post_data['user_id'];			
			$associ_ative['facebook'] 				= $post_data['facebook'];
			$associ_ative['instagram'] 				= $post_data['instagram'];
			$associ_ative['snapchat'] 				= $post_data['snapchat'];
			$associ_ative['twitter'] 				= $post_data['twitter'];
			$associ_ative['linkedIn'] 				= $post_data['linkedIn'];

			$response = $this->custom_model->my_update($associ_ative,array('user_id' => $user_id),'user_social_profile');
			echo 'success';
    		die;
		}
	}

	public function update_interest()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$user_id 					= $post_data['user_id'];			
			$user_interest 				= $post_data['user_interest'];

			$str_arr = explode (",", $user_interest); 

			$this->custom_model->my_delete(['user_id' => $user_id], 'user_interest');
			$p_data = array();

			foreach ($str_arr as $key => $value) 
			{
				$p_data['interest_name'] = $value;
				$p_data['user_id'] = $user_id;

				$this->custom_model->my_insert($p_data,'user_interest');
			}

			echo 'success';
    		die;
		}
	}

	public function update_course()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$user_id 					= $post_data['user_id'];			
			$user_course 				= $post_data['u_course'];

			$str_arr = explode (",", $user_course); 

			$this->custom_model->my_delete(['user_id' => $user_id], 'user_course');
			$p_data = array();

			foreach ($str_arr as $key => $value) 
			{
				$p_data['name'] = $value;
				$p_data['user_id'] = $user_id;

				$this->custom_model->my_insert($p_data,'user_course');
			}

			echo 'success';
    		die;
		}
	}

	public function update_languages()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$user_id 						= $post_data['user_id'];			
			$user_languages 				= $post_data['u_languages'];

			$str_arr = explode (",", $user_languages); 

			$this->custom_model->my_delete(['user_id' => $user_id], 'user_languages');
			$p_data = array();

			foreach ($str_arr as $key => $value) 
			{
				$p_data['language_name'] = $value;
				$p_data['user_id'] = $user_id;

				$this->custom_model->my_insert($p_data,'user_languages');
			}

			echo 'success';
    		die;
		}
	}

	public function get_university_email()
	{
		$post_data = $this->input->post();			
		if(!empty($post_data))
		{

			// echo "<pre>";
			// print_r($post_data);
			// die;	

			$category = $this->custom_model->my_where('domains','domain',array('university_id'=>$post_data['uni_id']));
			if(!empty($category))
			{
				echo json_encode($category[0]['domain']);			
				die;
			}else {
				echo "not_found";
				die;
			}	
										
		}else {
			echo 0;
			die;
		}			
	}

	public function csv_dwonload()
	{
		
		$data = $this->custom_model->my_where("users","username,university_school_email,profile_status,university_school_id,created_at,id,status",array(),array(),"id","DESC");		
		
		if (!empty($data)) 
		{
			foreach ($data as $key => $value) 
			{
				$university_school_id = $value['university_school_id'];

				$university_schools = $this->custom_model->my_where("university_schools","name",array("id" => $university_school_id ),array(),"","","","", array(), "",array(),false  );
				
				if (!empty($university_schools)) 
				{
					$data[$key]['university_schools'] = $university_schools[0]['name'];
				}
				else
				{
					$data[$key]['university_schools'] = '';
				}
			}
		}

		// echo "<pre>";
		// print_r($data);
		// die;
		
		
		$file_name='Customr_info'.date("d-m-Y").'.csv';
		

		if (!empty($data))
		{
			header('Content-Type:text/csv');
			header("Content-Disposition: attachment; filename=\"$file_name\";");
			// header("Content-Disposition: attachment; filename=" );


			$str = 'Id,Username,university/school ,University/School Email ,Profile Status , Status , Date(Joined on) ';

			$fp = fopen('php://output', 'wb');


			$i = 0;
			$header = explode(",", $str);
			fputcsv($fp, $header);

			foreach ($data as $key => $value)
			{
			 	$username  =  $value['username'];
			 	$date=date('M-d-Y' ,strtotime($value['created_at']));
				$DATACSV[] = $value['id'];
				$DATACSV[] = $username;
				$DATACSV[] = $value['university_schools'];
				$DATACSV[] = $value['university_school_email'];
				$DATACSV[] = $value['profile_status'];
				$DATACSV[] = $value['status'];
				$DATACSV[] = $date;

				fputcsv($fp, $DATACSV);
				$DATACSV = array();
			}
		}
		else
		{
			$lang['ALERT'] =" No data found";
			echo "<script>alert('" . $lang['ALERT'] . "')</script>";
		}

		die;
	}

	public function delete_user()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$uid = $post_data['u_id'];

    		$users_data = $this->custom_model->get_data_array("SELECT username,university_school_email,user_type,university_school_id,profile_image  FROM users WHERE  id ='$uid' ");

    		$insert_data['user_type'] = $users_data[0]['user_type'];
    		$insert_data['username'] = $users_data[0]['username'];
    		$insert_data['profile_image'] = $users_data[0]['profile_image'];
    		$insert_data['university_school_id'] = $users_data[0]['university_school_id'];
    		$insert_data['university_school_email'] = $users_data[0]['university_school_email'];
    		$this->custom_model->my_insert($insert_data,"delete_users");

    		$university_school_email = $users_data[0]['university_school_email'];    		
    		$this->custom_model->my_delete(['email' => $university_school_email], 'otp_verify');

    		$this->custom_model->my_delete(['id' => $uid], 'users');
    		$this->custom_model->my_delete(['user_id' => $uid], 'posts');
    		$this->custom_model->my_delete(['user_id' => $uid], 'posts_options');
    		$this->custom_model->my_delete(array("user_id" => $uid),"post_comment_likes");
    		$this->custom_model->my_delete(array("user_id" => $uid),"post_options_select_by_user");
    		echo 1;
    		die;
    	}
    	else 
    	{
    		echo 0;
    		die;
    	}
    }


}




?>	
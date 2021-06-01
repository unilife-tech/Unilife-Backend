<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content_management extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
	}

	public function about()
	{
		$crud = $this->generate_crud('about_us');
		$crud->columns('id','about_us');
		
		// $crud->set_field_upload('image', UPLOAD_BLOG_POST);

		// $crud->display_as('editor','editor');
		// $crud->display_as('title','Pages');
		
		$crud->set_theme('datatables');

		// disable direct create / delete Category
		$crud->unset_add();
		$crud->unset_delete();
		// $crud->unset_edit();
		$crud->unset_read();
		// $crud->unset_operations();

		// $crud->add_action('translate', '', 'admin/application/tedit', '');
		// $crud->add_action('edit', '', 'admin/application/edit', '');


		// $category = $this->custom_model->my_where("category","id,display_name",array("status" => 'active'));
		// if(!empty($category))
		// {
		// 	$cat = array();
		// 	foreach ($category as $ckey => $cvalue) 
		// 	{
		// 		$cat[$cvalue['id']]= $cvalue['display_name'];
		// 	}
		// }

		$crud->field_type('category','hidden');
		$crud->set_rules('about_us','about us','required');
		$this->mPageTitle = 'About Us';
		$this->render_crud();
	}

	public function feedback()
	{
		$crud = $this->generate_crud('feedback');
		$crud->columns('id','user_id','rating','feedback');
		
		// $crud->set_field_upload('image', UPLOAD_BLOG_POST);

		$crud->set_relation('user_id','users','username');


		$crud->display_as('user_id','User name');
		// $crud->display_as('title','Pages');
		
		$crud->set_theme('datatables');

		// disable direct create / delete Category
		$crud->unset_add();
		// $crud->unset_delete();
		$crud->unset_edit();
		// $crud->unset_read();
		// $crud->unset_operations();

		// $crud->add_action('translate', '', 'admin/application/tedit', '');
		// $crud->add_action('edit', '', 'admin/application/edit', '');


		// $category = $this->custom_model->my_where("category","id,display_name",array("status" => 'active'));
		// if(!empty($category))
		// {
		// 	$cat = array();
		// 	foreach ($category as $ckey => $cvalue) 
		// 	{
		// 		$cat[$cvalue['id']]= $cvalue['display_name'];
		// 	}
		// }

		// $crud->field_type('category','hidden');
		$crud->set_rules('about_us','about us','required');

		$this->mPageTitle = 'Feedback';
		$this->render_crud();
	}

	public function terms()
	{
		$crud = $this->generate_crud('term&conditions');
		$crud->columns('id','term_condition');
		
		// $crud->set_field_upload('image', UPLOAD_BLOG_POST);

		// $crud->display_as('editor','editor');
		// $crud->display_as('title','Pages');
		
		$crud->set_theme('datatables');

		// disable direct create / delete Category
		$crud->unset_add();
		$crud->unset_delete();
		// $crud->unset_edit();
		$crud->unset_read();
		// $crud->unset_operations();

		// $crud->add_action('translate', '', 'admin/application/tedit', '');
		// $crud->add_action('edit', '', 'admin/application/edit', '');


		// $category = $this->custom_model->my_where("category","id,display_name",array("status" => 'active'));
		// if(!empty($category))
		// {
		// 	$cat = array();
		// 	foreach ($category as $ckey => $cvalue) 
		// 	{
		// 		$cat[$cvalue['id']]= $cvalue['display_name'];
		// 	}
		// }

		$crud->field_type('category','hidden');
		$crud->set_rules('term_condition','term condition','required');
		$this->mPageTitle = 'About Us';
		$this->render_crud();
	}

	public function faq()
	{
		$crud = $this->generate_crud('faqs');
		$crud->columns('id','questions','answer','status');
		
		// $crud->set_field_upload('image', UPLOAD_BLOG_POST);

		// $crud->display_as('editor','editor');
		// $crud->display_as('title','Pages');
		
		$crud->set_theme('datatables');

		// disable direct create / delete Category
		// $crud->unset_add();
		// $crud->unset_delete();
		// $crud->unset_edit();
		$crud->unset_read();
		// $crud->unset_operations();

		// $crud->add_action('translate', '', 'admin/application/tedit', '');
		// $crud->add_action('edit', '', 'admin/application/edit', '');


		// $category = $this->custom_model->my_where("category","id,display_name",array("status" => 'active'));
		// if(!empty($category))
		// {
		// 	$cat = array();
		// 	foreach ($category as $ckey => $cvalue) 
		// 	{
		// 		$cat[$cvalue['id']]= $cvalue['display_name'];
		// 	}
		// }

		$crud->field_type('category','hidden');
		$crud->set_rules('questions','Question','required');
		$crud->set_rules('answer','Answer','required');
		$crud->set_rules('status','Status','required');
		$this->mPageTitle = 'FAQ\'s List';
		$this->render_crud();
	}

	public function team()
	{
		
		$form = $this->form_builder->create_form('','','id="create_team" class="create_team" enctype="multipart/form-data" ');


		$post_data = $this->input->post();
		

		// Parent category 
		$our_teams = $this->custom_model->my_where('our_teams','*',array(),array(),"id","asc","","",array(),"");
		
		$this->mViewData['data'] = $our_teams;

		// echo "<pre>";
		// print_r($our_teams);
		// die;


		$this->mPageTitle = 'Team List';

		$this->mViewData['form'] = $form;
		$this->render('team/listing');
	}

	public function contact()
	{
		$form = $this->form_builder->create_form('','','id="create_category" class="categoryy" enctype="multipart/form-data" ');


		$post_data = $this->input->post();
		

		// Parent category 
		$data = $this->custom_model->my_where('contact_us','*',array("post_id" => null),array(),"id","asc","","",array(),"");
		if ($data) 
		{
			foreach ($data as $key => $value) 
			{
				$user_id = $value['user_id'];

				$u_data = $this->custom_model->get_data_array("SELECT user_type,university_school_id,username  FROM users WHERE id = '$user_id'  Order BY id DESC "); 
				if ($u_data) 
				{
					$user_type = $u_data[0]['user_type'];
					$university_school_id = $u_data[0]['university_school_id'];

					$university_school = $this->custom_model->get_data_array("SELECT name FROM university_schools WHERE `id` ='$university_school_id' ");
					$data[$key]['university_school'] 	= @$university_school[0]['name'];
					$data[$key]['username']				= @$u_data[0]['username'];

					if ($user_type ==0) 
					{
						$data[$key]['user_type'] = 'Student';
					}
					else if ($user_type == 1) 
					{
						$data[$key]['user_type'] = 'Faculty';
					}
					else if ($user_type == 2) 
					{
						$data[$key]['user_type'] = 'Teacher';
					}
				}				
			}
		}
		$this->mViewData['data'] = $data;

		// echo "<pre>";
		// print_r($data);
		// die;


		$this->mPageTitle = 'Contact Us';

		$this->mViewData['form'] = $form;
		$this->render('contact/listing');
	}

	public function delete_contact()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$cid = $post_data['cid'];

    		$this->custom_model->my_delete(['id' => $cid], 'contact_us');
    		echo 1;
    		die;
    	}
    	else 
    	{
    		echo 0;
    		die;
    	}
    }

    public function csv_dwonload()
	{
		$data = $this->custom_model->my_where('contact_us','*',array("post_id" => null),array(),"id","asc","","",array(),"");
		if ($data) 
		{
			foreach ($data as $key => $value) 
			{
				$user_id = $value['user_id'];

				$u_data = $this->custom_model->get_data_array("SELECT user_type,university_school_id,username  FROM users WHERE id = '$user_id'  Order BY id DESC "); 
				if ($u_data) 
				{
					$university_school_id = $u_data[0]['university_school_id'];

					$university_school = $this->custom_model->get_data_array("SELECT name FROM university_schools WHERE `id` ='$university_school_id' ");
					$data[$key]['university_school'] 	= @$university_school[0]['name'];
					$data[$key]['username']				= @$u_data[0]['username'];
				}				
			}
		}


		// echo "<pre>";
		// print_r($data);
		// die;
		
		
		$file_name='Contact_'.date("d-m-Y").'.csv';
		

		if (!empty($data))
		{
			header('Content-Type:text/csv');
			header("Content-Disposition: attachment; filename=\"$file_name\";");
			// header("Content-Disposition: attachment; filename=" );


			$str = 'Id,Username,University school ,Description ,Type of concern , Status , Date(Joined on) ';

			$fp = fopen('php://output', 'wb');


			$i = 0;
			$header = explode(",", $str);
			fputcsv($fp, $header);

			foreach ($data as $key => $value)
			{
			 	$date=date('M-d-Y' ,strtotime($value['created_at']));
				$DATACSV[] = $value['id'];
				$DATACSV[] = $value['username'];
				$DATACSV[] = $value['university_school'];
				$DATACSV[] = $value['description'];
				$DATACSV[] = $value['type_of_concern'];
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



	public function team_create()
	{
		$form = $this->form_builder->create_form('','','id="team_create" class="team_create" enctype="multipart/form-data" ');


		$post_data = $this->input->post();
		if ( !empty($post_data) )
		{
			// echo "<pre>";
			// print_r($_FILES);
			// print_r($post_data);
			// die;

			$FILES=$_FILES['image'];
		    $image = $this->uploads($FILES);

		    if (!empty($image)) 
		    {
		    	$post_data['image'] = $image;


				//proceed to create Category
				$response = $this->custom_model->my_insert($post_data,'our_teams');
				
				if ($response)
				{
					// success
					$this->system_message->set_success('Team member created successfully');
				}
				else
				{
					// failed
					$this->system_message->set_error('Something went wrong');
				}

		    }
		    else
			{
				// failed
				$this->system_message->set_error('Please attach image .');
			}
		
			refresh();
		}

		// // Parent category 
		// $category = $this->custom_model->my_where('ta','*',array('status' => 'active'),array(),"id","asc","","",array(),"");
		// $this->mViewData['category'] = $category;

		$this->mPageTitle = 'Add Team';

		$this->mViewData['form'] = $form;
		$this->render('team/create');
	}

	public function team_edit($team_id)
	{
		$form = $this->form_builder->create_form('','','id="team_edit" class="team_edit" enctype="multipart/form-data" ');


		$post_data = $this->input->post();
		if ( !empty($post_data) )
		{
			// echo "<pre>";
			// print_r($_FILES);
			// print_r($post_data);
			// die;

			$FILES = $_FILES['image'];
		    $image = $this->uploads($FILES);
		    
	    	if (!empty($image)) 
	    	{
	    		$post_data['image'] = $image;
	    	}


			//proceed to create Category
			$response = $this->custom_model->my_update($post_data , array("id" => $team_id) ,'our_teams');
			
			if ($response)
			{
				// success
				$this->system_message->set_success('Team data updated successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
		
			refresh();
		}


		$our_teams = $this->custom_model->my_where('our_teams','*',array('id' => $team_id),array(),"id","asc","","",array(),"");
		$this->mViewData['edit'] = $our_teams[0];

		$this->mPageTitle = 'Edit team';

		$this->mViewData['form'] = $form;
		$this->render('team/create');
	}

	public function uploads($FILES)
    {
        if (isset($FILES['name'])) 
        {
			$details = array( "caption" => "My Logo", "action" => "fiu_upload_file", "path" => "/public/profile_imgs/" );
			$path = $details['path'];

			$upl_dir =  ASSETS_PATH;

			$up_dir =   strstr($upl_dir, '/api', true);

			$upload_dir = $up_dir.$path;

            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $file_name    = $FILES['name'];
            $random_digit = rand(0000, 9999);
            $target_file  = $upload_dir . basename($FILES["name"]);
            $ext          = pathinfo($target_file, PATHINFO_EXTENSION);
            
            $new_file_name = $random_digit . "." . $ext;
            $path          = $upload_dir . $new_file_name;
            if (move_uploaded_file($FILES['tmp_name'], $path)) {
                return $new_file_name;
            } else {
                return false;
            }
        } else {
            return false;
            
        }
    }

    public function delete_team_member()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$tid 				= $post_data['tid'];
			$this->custom_model->my_delete(['id' => $tid], 'our_teams');
			echo 'success';
    		die;
		}
	}

}

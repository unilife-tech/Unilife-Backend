<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
	}

	public function index()
	{
		$form = $this->form_builder->create_form('','','id="create_category" class="categoryy" enctype="multipart/form-data" ');


		$post_data = $this->input->post();
		if ( !empty($post_data) )
		{

		}

		$groups = $this->custom_model->my_where('groups','*',array(),array(),"id","asc","","",array(),"");
		if (!empty($groups)) 
		{
			foreach ($groups as $key => $value) 
			{
				$group_id = $value['id'];

				$count_member = $this->custom_model->my_where('group_users','id',array("group_id" => $group_id));
				$groups[$key]['count_member'] = count($count_member);

				$posts_posted = $this->custom_model->my_where('posts','id',array("group_id" => $group_id));
				$groups[$key]['posts_posted'] = count($posts_posted);


				$university_group_id = $value['university_group_id'];
				$created_by = $value['created_by'];
				$data = $this->custom_model->my_where('users','username',array("id" => $created_by),array(),"id","asc","","",array(),"");
				if ($data) 
				{
					$groups[$key]['username'] = $data[0]['username'];
				}
				else
				{
					$groups[$key]['username'] = '';
				}

				/*$university_schools = $this->custom_model->my_where('university_schools','name',array("id" => $university_group_id),array(),"id","asc","","",array(),"");
				if ($university_schools) 
				{
					$groups[$key]['university_schools_name'] = $university_schools[0]['name'];
				}
				else
				{
					$groups[$key]['university_schools_name'] = '';
				}*/

			}
		}

		// echo "<pre>";
		// print_r($groups);
		// die;

		$this->mViewData['groups'] = $groups;

		$this->mPageTitle = 'Group List';

		$this->mViewData['form'] = $form;
		$this->render('groups/listing');
	}

	public function create()
	{
		$form = $this->form_builder->create_form('','','id="create_group" class="create_group" enctype="multipart/form-data" ');


		$post_data = $this->input->post();
		if ( !empty($post_data) )
		{
			// echo "<pre>";
			// print_r($_FILES);
			// print_r($post_data);
			// die;

			$FILES=$_FILES['group_image'];
			$image = $this->uploads($FILES);

		    if (!empty($image)) 
		    {
		    	$group_data['group_image'] = $image;
		    	$user_id = $post_data['user_id'];

		    	$group_data['group_name'] = $post_data['group_name'];
		    	$group_data['created_by'] = $post_data['group_admin_add'];
		    	$group_data['university_group_id'] = $post_data['university_school_id'];
		    	$group_data['status'] = $post_data['status'];



				//proceed to create Category
				$response = $this->custom_model->my_insert($group_data,'groups');
				
				// $response = '111';

				if (!empty($user_id)) 
		    	{
		    		foreach ($user_id as $ckey => $cvalue) 
		    		{
		    			$p_data['user_id'] 		= $cvalue;
		    			$p_data['group_admin'] 	= 'no';
		    			$p_data['group_id'] 	= $response;

						// print_r($p_data);
						// die;

		    			$this->custom_model->my_insert($p_data,'group_users');
		    		}
		    	}

		    	$admin_check_user_list = $this->custom_model->my_where('group_users','*',array("user_id" => $group_data['created_by']),array(),"id","asc","","",array(),"");
		    	if (empty($admin_check_user_list)) 
		    	{
		    		$admin_data['user_id'] 		= $group_data['created_by'];
		    		$admin_data['group_id'] 	= $response;
		    		$admin_data['group_admin'] 		= 'yes';

		    		$this->custom_model->my_insert($admin_data,'group_users');
		    	}
		    	else
		    	{
		    		$admin_data['user_id'] 		= $group_data['created_by'];
		    		$admin_data['group_id'] 	= $response;
		    		$admin_data['group_admin'] 	= 'yes';

		    		$this->custom_model->my_update($admin_data, array("id" => $admin_check_user_list[0]['id']),'group_users');
		    	}



				if ($response)
				{
					// success
					$this->system_message->set_success('Category created successfully');
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
				$this->system_message->set_error('Please attach image also .');
			}
		
			refresh();
		}

		// Parent category 
		$university_schools = $this->custom_model->my_where('university_schools','*',array('status' => 'active'),array(),"id","asc","","",array(),"");
		$this->mViewData['university_schools'] = $university_schools;


		$this->mPageTitle = 'Add Groups';

		$this->mViewData['form'] = $form;
		$this->render('groups/create');
	}

	public function edit($group_id)
	{
		$form = $this->form_builder->create_form('','','id="edit_groups" class="edit_groups" enctype="multipart/form-data" ');


		$post_data = $this->input->post();
		if ( !empty($post_data) )
		{
			// echo "<pre>";
			// print_r($_FILES);
			// print_r($post_data);
			// die;

			$FILES=$_FILES['group_image'];
			$image = $this->uploads($FILES);


	    	$user_id = $post_data['user_id'];

	    	$group_data['group_name'] = $post_data['group_name'];
	    	$group_data['created_by'] = $post_data['group_admin_add'];
	    	$group_data['university_group_id'] = $post_data['university_school_id'];
	    	$group_data['status'] = $post_data['status'];
		    
	    	if (!empty($image)) 
	    	{
	    		$group_data['group_image'] = $image;

	    	}


			//proceed to create Category
			$response = $this->custom_model->my_update($group_data , array("id" => $group_id) ,'groups');

			$this->custom_model->my_delete(['group_id' => $group_id], 'group_users');

			if (!empty($user_id)) 
	    	{
	    		foreach ($user_id as $ckey => $cvalue) 
	    		{
	    			$p_data['user_id'] 		= $cvalue;
	    			$p_data['group_admin'] 	= 'no';
	    			$p_data['group_id'] 	= $group_id;

					// print_r($p_data);
					// die;

	    			$this->custom_model->my_insert($p_data,'group_users');
	    		}
	    	}

			$admin_check_user_list = $this->custom_model->my_where('group_users','*',array("user_id" => $group_data['created_by']),array(),"id","asc","","",array(),"");
	    	if (empty($admin_check_user_list)) 
	    	{
	    		$admin_data['user_id'] 		= $group_data['created_by'];
	    		$admin_data['group_id'] 	= $group_id;
	    		$admin_data['group_admin'] 		= 'yes';

	    		$this->custom_model->my_insert($admin_data,'group_users');
	    	}
	    	else
	    	{
	    		$admin_data['user_id'] 		= $group_data['created_by'];
	    		$admin_data['group_id'] 	= $group_id;
	    		$admin_data['group_admin'] 	= 'yes';

	    		$this->custom_model->my_update($admin_data, array("id" => $admin_check_user_list[0]['id']),'group_users');
	    	}

			
			if ($response)
			{
				// success
				$this->system_message->set_success('Groups updated successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
		
			refresh();
		}

		$university_schools = $this->custom_model->my_where('university_schools','*',array('status' => 'active'),array(),"id","asc","","",array(),"");
		$this->mViewData['university_schools'] = $university_schools;


		

		$groups = $this->custom_model->my_where('groups','*',array('id' => $group_id),array(),"id","asc","","",array(),"");
		$this->mViewData['edit'] = $groups[0];

		

		// members of that school / university
		$school_uni = $this->custom_model->my_where('users','id,username',array("university_school_id" => $groups[0]['university_group_id']));
		$this->mViewData['school_uni'] = $school_uni;


		$admin_dtaa =  $this->custom_model->my_where('group_users','user_id',array("group_id" => $groups[0]['id']),array(),"id","asc","","",array(),"");

		$selected_sizes_comma_seprated = "";
		foreach ($admin_dtaa as $size) {
		    $selected_sizes_comma_seprated .= $size['user_id'].',';
		}
		// Remove last comma in string
		$selected_sizes_comma_seprated = substr($selected_sizes_comma_seprated, 0,-1);

		$selected_sizes_comma_seprated = preg_split ("/\,/", $selected_sizes_comma_seprated);  


		$this->mViewData['admin_dtaa'] = $selected_sizes_comma_seprated;

		// echo "<pre>";
		// print_r($admin_dtaa);
		// print_r($selected_sizes_comma_seprated);
		// die;



		$this->mPageTitle = 'Edit group';

		$this->mViewData['form'] = $form;
		$this->render('groups/edit');
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

    public function delete_group()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$group_id 				= $post_data['group_id'];

			$this->custom_model->my_delete(['group_id' => $group_id], 'group_users');
			$this->custom_model->my_delete(['id' => $group_id], 'groups');
			echo 'success';
    		die;
		}
	}

	public function get_member()
	{
		$post_data = $this->input->post();

		
		
		if (!empty($post_data)) 
		{
			$uni_id 				= $post_data['uni_id'];

			$data = $this->custom_model->my_where('users','id,username',array("university_school_id" => $uni_id));

			if(!empty($data))
			{
				echo json_encode($data);			
				die;
			}
			else 
			{
				echo "not_found";
				die;
			}	

			echo "<pre>";
			print_r($data);
			die;		
		}
	}

	public function csv_dwonload()
	{

		$groups = $this->custom_model->my_where('groups','*',array(),array(),"id","asc","","",array(),"");
		if (!empty($groups)) 
		{
			foreach ($groups as $key => $value) 
			{
				$group_id = $value['id'];

				$count_member = $this->custom_model->my_where('group_users','id',array("group_id" => $group_id));
				$groups[$key]['count_member'] = count($count_member);

				$posts_posted = $this->custom_model->my_where('posts','id',array("group_id" => $group_id));
				$groups[$key]['posts_posted'] = count($posts_posted);


				$university_group_id = $value['university_group_id'];

				$school_uni = $this->custom_model->my_where('university_schools','name',array("id" => $university_group_id));
				if ($school_uni) 
				{
					$groups[$key]['school_name'] = $school_uni[0]['name'];
				}
				else
				{
					$groups[$key]['school_name'] = '';
				}



				$created_by = $value['created_by'];
				$data = $this->custom_model->my_where('users','username',array("id" => $created_by),array(),"id","asc","","",array(),"");
				if ($data) 
				{
					$groups[$key]['username'] = $data[0]['username'];
				}
				else
				{
					$groups[$key]['username'] = '';
				}

			}
		}

		

		// echo "<pre>";
		// print_r($groups);
		// die;
		
		
		$file_name='Group_'.date("d-m-Y").'.csv';
		

		if (!empty($groups))
		{
			header('Content-Type:text/csv');
			header("Content-Disposition: attachment; filename=\"$file_name\";");
			// header("Content-Disposition: attachment; filename=" );


			$str = 'Id, Group Name ,Created BY  ,University/School , Status ,  Date(Joined on) ';

			$fp = fopen('php://output', 'wb');


			$i = 0;
			$header = explode(",", $str);
			fputcsv($fp, $header);

			foreach ($groups as $key => $value)
			{
			 	$username  =  $value['username'];
			 	$group_name  =  $value['group_name'];

			 	$date=date('M-d-Y' ,strtotime($value['created_at']));

				$DATACSV[] = $value['id'];
				$DATACSV[] = $group_name;
				$DATACSV[] = $username;
				$DATACSV[] = $value['school_name'];
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

}

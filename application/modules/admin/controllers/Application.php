<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Application extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
	}

	public function category()
	{
		$form = $this->form_builder->create_form('','','id="create_category" class="categoryy" enctype="multipart/form-data" ');


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
				$response = $this->custom_model->my_insert($post_data,'categories');
				
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
		// $category = $this->custom_model->my_where('categories','*',array('status' => 'active','parent'=>'0'),array(),"parent","asc","","",array(),"");
		// $this->mViewData['category'] = $category;

		$this->mPageTitle = 'Add Categories';

		$this->mViewData['form'] = $form;
		$this->render('category/create');
	}

	public function category_edit($cid)
	{
		$form = $this->form_builder->create_form('','','id="create_category" class="categoryy" enctype="multipart/form-data" ');


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
		    }

			//proceed to create Category
			$response = $this->custom_model->my_update($post_data, array("id" => $cid) , 'categories');
			
			if ($response)
			{
				// success
				$this->system_message->set_success('Category updated successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}


		   
		
		
		refresh();
		}

		// Parent category 
		$category = $this->custom_model->my_where('categories','*',array('id' => $cid),array(),"id","asc","","",array(),"");
		$this->mViewData['edit'] = $category[0];

		$this->mPageTitle = 'Edit Categories';

		$this->mViewData['form'] = $form;
		$this->render('category/create');
	}


	public function category_listing()
	{
		$form = $this->form_builder->create_form('','','id="create_category" class="categoryy" enctype="multipart/form-data" ');


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
				$response = $this->custom_model->my_insert($post_data,'categories');
				
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
		$category = $this->custom_model->my_where('categories','*',array(),array(),"id","asc","","",array(),"");
		$this->mViewData['category'] = $category;

		$this->mPageTitle = 'Categories List';

		$this->mViewData['form'] = $form;
		$this->render('category/category_listing');
	}


	public function uploads($FILES)
    {
        if (isset($FILES['name'])) 
        {
			$details = array( "caption" => "My Logo", "action" => "fiu_upload_file", "path" => "/public/admin/brand/" );
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

    public function category_delete()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$cid 				= $post_data['cid'];
			$this->custom_model->my_delete(['id' => $cid], 'categories');
			echo 'success';
    		die;
		}
	}


	


}

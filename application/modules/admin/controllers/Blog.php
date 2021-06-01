<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends Admin_Controller {

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

		$blogs = $this->custom_model->my_where('blogs','id,categories_id,title,image,shared_by,writer_image,video_link,status,created_at',array(),array(),"id","asc","","",array(),"");
		if (!empty($blogs)) 
		{
			foreach ($blogs as $key => $value) 
			{
				$categories_id = $value['categories_id'];
				$categories = $this->custom_model->my_where('blog_categories','*',array("id" => $categories_id),array(),"id","asc","","",array(),"");
				if ($categories) 
				{
					$blogs[$key]['category_name'] = $categories[0]['categories_name'];
				}
				else
				{
					$blogs[$key]['category_name'] = '';
				}
			}
		}

		// echo "<pre>";
		// print_r($blogs);
		// die;

		$this->mViewData['blogs'] = $blogs;

		$this->mPageTitle = 'Blog List';

		$this->mViewData['form'] = $form;
		$this->render('blog/listing');
	}

	public function create()
	{
		$form = $this->form_builder->create_form('','','id="blog_create" class="blog_create" enctype="multipart/form-data" ');


		$post_data = $this->input->post();
		if ( !empty($post_data) )
		{
			// echo "<pre>";
			// print_r($_FILES);
			// print_r($post_data);
			// die;

			$FILES=$_FILES['image'];
		    $image = $this->uploads($FILES);

			$W_FILES=$_FILES['writer_image'];
		    $writer_image = $this->uploads($W_FILES);

		    if (!empty($image)) 
		    {
		    	$post_data['image'] = $image;
		    	$post_data['writer_image'] = $writer_image;

				//proceed to create Category
				$response = $this->custom_model->my_insert($post_data,'blogs');
				
				if ($response)
				{
					// success
					$this->system_message->set_success('Blogs created successfully');
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

		$blog_categories = $this->custom_model->my_where('blog_categories','*',array('status' => 'active'),array(),"id","asc","","",array(),"");
		$this->mViewData['category'] = $blog_categories;

		$this->mPageTitle = 'Add Blog';

		$this->mViewData['form'] = $form;
		$this->render('blog/create');
	}

	public function edit($bid)
	{
		$form = $this->form_builder->create_form('','','id="edit_brands" class="edit_brands" enctype="multipart/form-data" ');


		$post_data = $this->input->post();
		if ( !empty($post_data) )
		{
			// echo "<pre>";
			// print_r($_FILES);
			// print_r($post_data);
			// die;

			$FILES = $_FILES['image'];
		    $image = $this->uploads($FILES);
		    
		    $w_image = $_FILES['writer_image'];
		    $writer_image = $this->uploads($w_image);

	    	if (!empty($image)) 
	    	{
	    		$post_data['image'] = $image;
	    	}

	    	if (!empty($writer_image)) 
	    	{
	    		$post_data['writer_image'] = $writer_image;
	    	}


			// echo "<pre>";
			// print_r($_FILES);
			// print_r($post_data);
			// die;


			//proceed to create Category
			$response = $this->custom_model->my_update($post_data , array("id" => $bid) ,'blogs');
			
			if ($response)
			{
				// success
				$this->system_message->set_success('Blog updated successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
		
			refresh();
		}

		$category = $this->custom_model->my_where('blog_categories','*',array(),array(),"id","asc","","",array(),"");
		$this->mViewData['category'] = $category;

		$blog = $this->custom_model->my_where('blogs','*',array('id' => $bid),array(),"id","asc","","",array(),"");
		$this->mViewData['edit'] = $blog[0];

		$this->mPageTitle = 'Edit blog';

		$this->mViewData['form'] = $form;
		$this->render('blog/create');
	}

	public function uploads($FILES)
    {
        if (isset($FILES['name'])) 
        {
			$details = array( "caption" => "My Logo", "action" => "fiu_upload_file", "path" => "/public/blog_imgs/" );
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

    public function delete_blog()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$bid 				= $post_data['bid'];
			$this->custom_model->my_delete(['id' => $bid], 'blogs');
			echo 1;
    		die;
		}
	}

	public function banner()
	{
		$crud = $this->generate_crud('blog_banner');
		$crud->columns('id','image' ,'status');
		
		$crud->set_field_upload('image', UPLOAD_BLOG_POST);

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


		/*$category = $this->custom_model->my_where("category","id,display_name",array("status" => 'active'));
		if(!empty($category))
		{
			$cat = array();
			foreach ($category as $ckey => $cvalue) 
			{
				$cat[$cvalue['id']]= $cvalue['display_name'];
			}
		}		
		$crud->field_type('category','dropdown', $cat);*/

		$cat['active'] = 'Active';
		$cat['deactive'] = 'Deactive';

		$crud->field_type('status','dropdown', $cat);

		$crud->field_type('created_date','hidden');
		
		$crud->set_rules('status','status','required');		
		$crud->set_rules('image','image','required');
		$this->mPageTitle = 'Add Blog Banner';
		$this->render_crud();
	}

	public function csv_dwonload()
	{

		$blogs = $this->custom_model->my_where('blogs','id,categories_id,title,image,shared_by,writer_image,video_link,status,created_at',array(),array(),"id","asc","","",array(),"");
		if (!empty($blogs)) 
		{
			foreach ($blogs as $key => $value) 
			{
				$categories_id = $value['categories_id'];
				$categories = $this->custom_model->my_where('blog_categories','*',array("id" => $categories_id),array(),"id","asc","","",array(),"");
				if ($categories) 
				{
					$blogs[$key]['category_name'] = $categories[0]['categories_name'];
				}
				else
				{
					$blogs[$key]['category_name'] = '';
				}
			}
		}

		// echo "<pre>";
		// print_r($blogs);
		// die;
		
		
		$file_name='Blog_'.date("d-m-Y").'.csv';
		

		if (!empty($blogs))
		{
			header('Content-Type:text/csv');
			header("Content-Disposition: attachment; filename=\"$file_name\";");
			// header("Content-Disposition: attachment; filename=" );


			$str = 'Id, Blog Category ,Title  ,Writer Name , Link , Status ,  Date(Joined on) ';

			$fp = fopen('php://output', 'wb');


			$i = 0;
			$header = explode(",", $str);
			fputcsv($fp, $header);

			foreach ($blogs as $key => $value)
			{
			 	$category_name  =  $value['category_name'];
			 	$date=date('M-d-Y' ,strtotime($value['created_at']));

				$DATACSV[] = $value['id'];
				$DATACSV[] = $category_name;
				$DATACSV[] = $value['title'];
				$DATACSV[] = $value['shared_by'];
				$DATACSV[] = $value['video_link'];
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

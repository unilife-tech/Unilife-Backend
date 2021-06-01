<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
	}

	public function index()
	{
		$form = $this->form_builder->create_form('','','id="create_offers" class="offers" enctype="multipart/form-data" ');


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
				$response = $this->custom_model->my_insert($post_data,'offers');
				
				if ($response)
				{
					// success
					$this->system_message->set_success('Offers created successfully');
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

		$offers = $this->custom_model->my_where('offers','*',array(),array(),"id","asc","","",array(),"");
		if (!empty($offers)) 
		{
			foreach ($offers as $key => $value) 
			{
				$brand_id = $value['brand_id'];
				$brands = $this->custom_model->my_where('brands','brand_name,categories_id',array("id" => $brand_id),array(),"id","asc","","",array(),"");
				if ($brands) 
				{
					$offers[$key]['brand_name'] = $brands[0]['brand_name'];
				}
				else
				{
					$offers[$key]['category_name'] = '';
				}

				$categories_id = @$brands[0]['categories_id'];
				$categories = $this->custom_model->my_where('categories','*',array("id" => $categories_id),array(),"id","asc","","",array(),"");
				if ($categories) 
				{
					$offers[$key]['category_name'] = $categories[0]['name'];
				}
				else
				{
					$offers[$key]['category_name'] = '';
				}


			}
		}

		// echo "<pre>";
		// print_r($offers);
		// die;

		$this->mViewData['offers'] = $offers;

		$this->mPageTitle = 'Offers List';

		$this->mViewData['form'] = $form;
		$this->render('coupon/coupon_listing');
	}


	public function create()
	{
		$form = $this->form_builder->create_form('','','id="offers_create" class="offers_create" enctype="multipart/form-data" ');


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
				$response = $this->custom_model->my_insert($post_data,'offers');
				
				if ($response)
				{
					// success
					$this->system_message->set_success('Coupon created successfully');
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

		// Parent category 
		$category = $this->custom_model->my_where('categories','*',array('status' => 'active'),array(),"id","asc","","",array(),"");
		$this->mViewData['category'] = $category;

		$this->mPageTitle = 'Add Coupons';

		$this->mViewData['form'] = $form;
		$this->render('coupon/create');
	}

	public function edit($bid)
	{
		$form = $this->form_builder->create_form('','','id="edit_coupons" class="edit_coupons" enctype="multipart/form-data" ');


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
			$response = $this->custom_model->my_update($post_data , array("id" => $bid) ,'offers');
			
			if ($response)
			{
				// success
				$this->system_message->set_success('Coupon updated successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
		
			refresh();
		}

		$category = $this->custom_model->my_where('categories','*',array('status' => 'active'),array(),"id","asc","","",array(),"");
		$this->mViewData['category'] = $category;


		$offers = $this->custom_model->my_where('offers','*',array('id' => $bid),array(),"id","asc","","",array(),"");

		if(empty($offers))
		{
			// echo "<script>alert('Coupon code is deleted')</script>";
			// redirect('admin/coupon/redeem_coupon');

			echo "<script>
				alert('Coupon code is deleted');
				 window.close();
				</script>";


		}
		$this->mViewData['edit'] = $offers[0];

		$selected_brand = $this->custom_model->my_where('brands','*',array('categories_id' => $offers[0]['categories_id']),array(),"id","asc","","",array(),"");
		$this->mViewData['selected_brand'] = $selected_brand;

		$this->mPageTitle = 'Update coupons';

		$this->mViewData['form'] = $form;
		$this->render('coupon/create');
	}

	public function get_brands_using_category()
	{
		$post_data = $this->input->post();			
		if(!empty($post_data))
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;	

			$brands = $this->custom_model->my_where('brands','id,brand_name',array('categories_id'=>$post_data['cat_id']));
			if(!empty($brands))
			{
				echo json_encode($brands);			
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


	public function uploads($FILES)
    {
        if (isset($FILES['name'])) 
        {
			$details = array( "caption" => "My Logo", "action" => "fiu_upload_file", "path" => "/public/offer_imgs/" );
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

    public function delete_coupon()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$cid 				= $post_data['cid'];
			$this->custom_model->my_delete(['id' => $cid], 'offers');
			echo 'success';
    		die;
		}
	}

    public function delete_redeem_coupon()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$r_id 				= $post_data['r_id'];
			$this->custom_model->my_delete(['id' => $r_id], 'redeem_coupon');
			echo 'success';
    		die;
		}
	}

	public function redeem_coupon()
	{
		$form = $this->form_builder->create_form('','','id="create_offers" class="offers" enctype="multipart/form-data" ');
		$post_data = $this->input->post();
		

		$coupon = $this->custom_model->my_where('redeem_coupon','*',array(),array(),"id","asc","","",array(),"");
		if (!empty($coupon)) 
		{
			foreach ($coupon as $key => $value) 
			{
				$user_id 	= $value['user_id'];
				$coupon_id 	= $value['coupon_id'];
				

				$offers = $this->custom_model->my_where('offers','discount_code,discount_type,discount_percent,brand_id',array("id" => $coupon_id),array(),"id","asc","","",array(),"");
				
				if ($offers) 
				{
					$coupon[$key]['discount_code'] = $offers[0]['discount_code'];
					$coupon[$key]['discount_type'] = $offers[0]['discount_type'];
					$coupon[$key]['discount_amount'] = $offers[0]['discount_percent'];
				}
				else
				{
					$coupon[$key]['discount_code'] = '';
					$coupon[$key]['discount_type'] = '';
					$coupon[$key]['discount_amount'] = '';
				}

				$uname = $this->custom_model->my_where('users','username',array("id" => $user_id),array(),"id","asc","","",array(),"");
				if ($uname) 
				{
					$coupon[$key]['username'] = $uname[0]['username'];
				}
				else
				{
					$coupon[$key]['username'] = '';
				}

				$brand_id 	= @$offers[0]['brand_id'];
				$brand_name = $this->custom_model->my_where('brands','brand_name',array("id" => $brand_id),array(),"id","asc","","",array(),"");
				if ($brand_name) 
				{
					$coupon[$key]['brand_name'] = $brand_name[0]['brand_name'];
				}
				else
				{
					$coupon[$key]['brand_name'] = '';
				}



			}
		}


		// echo "<pre>";
		// print_r($coupon);
		// die;

		$this->mViewData['coupon'] = $coupon;
		$this->mPageTitle = 'Offers List';
		$this->mViewData['form'] = $form;

		$this->render('coupon/redeem_coupon_listing');
	}

}

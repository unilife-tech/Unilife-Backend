<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends Admin_Controller {

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

			$FILES = $_FILES['image'];
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

		$brands = $this->custom_model->my_where('brands','*',array(),array(),"id","asc","","",array(),"");
		if (!empty($brands)) 
		{
			foreach ($brands as $key => $value) 
			{
				$categories_id = $value['categories_id'];
				$categories = $this->custom_model->my_where('categories','*',array("id" => $categories_id),array(),"id","asc","","",array(),"");
				if ($categories) 
				{
					$brands[$key]['category_name'] = $categories[0]['name'];
				}
				else
				{
					$brands[$key]['category_name'] = '';
				}
			}
		}

		// echo "<pre>";
		// print_r($brands);
		// die;

		$this->mViewData['brands'] = $brands;

		$this->mPageTitle = 'Brand List';

		$this->mViewData['form'] = $form;
		$this->render('brands/brands_listing');
	}

	public function create()
	{
		$form = $this->form_builder->create_form('','','id="c_brands" class="c_brands" enctype="multipart/form-data" ');


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
		    	$brands_data['image'] 			= $image;
		    	$brands_data['categories_id'] 	= $post_data['categories_id'];
		    	$brands_data['brand_name'] 		= $post_data['brand_name'];
		    	$brands_data['type'] 			= $post_data['type'];
		    	$brands_data['description'] 	= $post_data['brand_description'];
		    	$brands_data['status'] 			= $post_data['status'];
		    	$brands_data['facebook'] 		= $post_data['facebook'];
		    	$brands_data['instagram'] 		= $post_data['instagram'];
		    	$brands_data['twitter'] 		= $post_data['twitter'];


				//proceed to create Category
				$brand_id = $this->custom_model->my_insert($brands_data,'brands');
				
				if(!empty($post_data['heading']) && !empty($post_data['discount_message'])  && !empty($post_data['terms_condition']) )
				{					
					foreach ($post_data['heading'] as $key => $value) 
					{
						if(!empty($post_data['heading'][$key]) && !empty($post_data['description'][$key]) && !empty($post_data['terms_condition'][$key]) )
						{
							$online_data['heading'] 		= $post_data['heading'][$key];
							$online_data['discount_message'] = $post_data['discount_message'][$key];
							$online_data['description'] 	= $post_data['description'][$key];
							$online_data['terms_condition'] = $post_data['terms_condition'][$key];

							$online_data['online_redeem_link'] = $post_data['online_redeem_link'][$key];
							// $online_data['facebook'] = $post_data['online_facebook'][$key];
							// $online_data['twitter'] = $post_data['online_twitter'][$key];
							// $online_data['instagram'] = $post_data['online_instagram'][$key];


							$online_data['brand_id'] 		= $brand_id;

							$randstring =  $this->generateRandomString();

							// print_r($randstring);
							// die;

							$online_data['code'] 			= $randstring;
							$online_data['type'] 			= 'online';
							
							$this->custom_model->my_insert($online_data,'brands_online_instore');							
						}	
					}
				}


				if(!empty($post_data['instore_head']) && !empty($post_data['instore_discount_message'])  && !empty($post_data['instore_discount_code'])&& !empty($post_data['instore_desc']) )
				{
					foreach ($post_data['instore_head'] as $key => $value) 
					{
						
						if(!empty($post_data['instore_head'][$key]) && !empty($post_data['instore_desc'][$key]) && !empty($post_data['instore_terms_condition'][$key]) )
						{
							$instore_data['heading'] 		= $post_data['instore_head'][$key];
							$instore_data['discount_message']	= $post_data['instore_discount_message'][$key];

							$instore_data['code'] = $post_data['instore_discount_code'][$key];

							$instore_data['description'] = $post_data['instore_desc'][$key];

							$instore_data['terms_condition'] 		= $post_data['instore_terms_condition'][$key];
							$instore_data['use_type'] 		= $post_data['use_type'][$key];

							$instore_data['brand_id'] 		= $brand_id;
							$instore_data['type'] 			= 'instore';

							
							$this->custom_model->my_insert($instore_data,'brands_online_instore');							
						}	
					}
				}

				if ($brand_id)
				{
					echo 1;
					die;
					// success
					// $this->system_message->set_success('Brand created successfully');
				}
				else
				{
					echo 0;
					die;
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

		$this->mPageTitle = 'Add Brand';

		$this->mViewData['form'] = $form;
		$this->render('brands/create');
	}

	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
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

			$FILES=$_FILES['image'];
		    $image = $this->uploads($FILES);
		    
	    	if (!empty($image)) 
	    	{
	    		$brands_data['image'] 			= $image;
	    	}

	    	$brands_data['categories_id'] 	= $post_data['categories_id'];
	    	$brands_data['brand_name'] 		= $post_data['brand_name'];
	    	$brands_data['type'] 			= $post_data['type'];
	    	$brands_data['description'] 	= $post_data['brand_description'];
	    	$brands_data['status'] 			= $post_data['status'];
	    	$brands_data['facebook'] 		= $post_data['facebook'];
	    	$brands_data['instagram'] 		= $post_data['instagram'];
	    	$brands_data['twitter'] 		= $post_data['twitter'];

			//proceed to create Category
			$response = $this->custom_model->my_update($brands_data , array("id" => $bid) ,'brands');

			if(!empty($post_data['heading']) && !empty($post_data['discount_message'])  && !empty($post_data['terms_condition']) )
				{					
					foreach ($post_data['heading'] as $key => $value) 
					{
						if(!empty($post_data['heading'][$key]) && !empty($post_data['description'][$key]) && !empty($post_data['terms_condition'][$key]) )
						{

							// echo "<pre>";
							// print_r($post_data['online_id']);
							// die;

							$onl_check = $this->custom_model->my_where('brands_online_instore','*',array('id' =>@$post_data['online_id'][$key]));


							$online_data['heading'] 		= $post_data['heading'][$key];
							$online_data['discount_message'] = $post_data['discount_message'][$key];
							$online_data['description'] 	= $post_data['description'][$key];
							$online_data['terms_condition'] = $post_data['terms_condition'][$key];

							$online_data['online_redeem_link'] = $post_data['online_redeem_link'][$key];
							// $online_data['facebook'] = $post_data['online_facebook'][$key];
							// $online_data['twitter'] = $post_data['online_twitter'][$key];
							// $online_data['instagram'] = $post_data['online_instagram'][$key];

							$online_data['brand_id'] 		= $bid;

							$randstring =  $this->generateRandomString();

							// print_r($randstring);
							// die;

							$online_data['code'] 			= $randstring;
							$online_data['type'] 			= 'online';
							
							if(!empty($onl_check))
							{
								unset($online_data['code']);
								$this->custom_model->my_update($online_data,array('id' =>$post_data['online_id'][$key]),'brands_online_instore');
							}
							else{							
								$this->custom_model->my_insert($online_data,'brands_online_instore');
							}

							// $this->custom_model->my_insert($online_data,'brands_online_instore');							
						}	
					}
				}


			if(!empty($post_data['instore_head']) && !empty($post_data['instore_discount_message'])  && !empty($post_data['instore_discount_code'])&& !empty($post_data['instore_desc']) )
			{					
				foreach ($post_data['instore_head'] as $ikey => $dfvalue) 
				{
					// echo "<pre>";
					// print_r($post_data['instore_head'][$ikey]);
					// echo ">>>";

					if(!empty($post_data['instore_head'][$ikey]) )
					{
						$ins_check = $this->custom_model->my_where('brands_online_instore','*',array('id' =>@$post_data['instore_id'][$ikey]));

						$o_data['heading'] 		= $post_data['instore_head'][$ikey];
						$o_data['discount_message']	= $post_data['instore_discount_message'][$ikey];

						$o_data['code'] 		= $post_data['instore_discount_code'][$ikey];

						$o_data['description'] = $post_data['instore_desc'][$ikey];

						$o_data['terms_condition'] 		= $post_data['instore_terms_condition'][$ikey];
						$o_data['use_type'] 			= $post_data['use_type'][$ikey];

						$o_data['brand_id'] 		= $bid;
						$o_data['type'] 			= 'instore';

						
						// print_r($o_data);

						if(!empty($ins_check))
						{
							unset($o_data['use_type']);
							
							$this->custom_model->my_update($o_data,array('id' =>$post_data['instore_id'][$ikey]),'brands_online_instore');
						}
						else
						{
							$this->custom_model->my_insert($o_data,'brands_online_instore');
						}
					}	
				}
			}

			// die;

			
			if ($response)
			{
				echo 1;
				die;
				// success
				$this->system_message->set_success('Brand updated successfully');
			}
			else
			{
				echo 0;
				die;
				// failed
				$this->system_message->set_error('Something went wrong');
			}
		
			refresh();
		}

		$category = $this->custom_model->my_where('categories','*',array('status' => 'active'),array(),"id","asc","","",array(),"");
		$this->mViewData['category'] = $category;

		$brands = $this->custom_model->my_where('brands','*',array('id' => $bid),array(),"id","asc","","",array(),"");
		$this->mViewData['edit'] = $brands[0];

		$this->mPageTitle = 'Add Brand';

		$online = $this->custom_model->get_data_array("SELECT * FROM brands_online_instore WHERE `brand_id` = '$bid' AND `type` = 'online' ");
		$this->mViewData['online'] = $online;

		$instore = $this->custom_model->get_data_array("SELECT * FROM brands_online_instore WHERE `brand_id` = '$bid' AND `type` = 'instore' ");
		$this->mViewData['instore'] = $instore;


		// echo "<pre>";
		// echo $this->db->last_query();
		// print_r($online);
		// die;

		$this->mViewData['form'] = $form;
		$this->render('brands/edit');
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

    public function delete_brands_online_store()
    {
    	$post_data=$this->input->post();
    	
    	if(!empty($post_data))
    	{
    		$pid = $post_data['pid']; 
    		// print_r($pid);
    		// die;

    		$this->custom_model->my_delete(array('id' => $pid),'brands_online_instore');   		    		    		
    		echo 1;
    		die;
    	}
    	else 
    	{
    		echo 0;
    		die;
    	}
    }

    public function delete_brands()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$bid 				= $post_data['bid'];
			$this->custom_model->my_delete(['id' => $bid], 'brands');
			echo 'success';
    		die;
		}
	}

	public function banner()
	{
		$crud = $this->generate_crud('brand_banner');
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
		$this->mPageTitle = 'Add Brand Banner';
		$this->render_crud();
	}


	public function redeem_user_list()
	{
		/*$online = $this->custom_model->get_data_array("SELECT id,brands_online_instore_id FROM brands_redeem_user WHERE `offer_type` = '' ");

		if (!empty($online)) 
		{
			foreach ($online as $xkey => $xvalue) 
			{
				$brands_online_instore_id = $xvalue['brands_online_instore_id'];
				$data = $this->custom_model->get_data_array("SELECT type FROM brands_online_instore WHERE `id` = '$brands_online_instore_id' ");
				if ($data) 
				{
					$additional_data['offer_type'] = $data[0]['type'];
					$this->custom_model->my_update($additional_data,array("id" => $xvalue['id']),"brands_redeem_user");
				}
			}
		}*/


		$crud = $this->generate_crud('brands_redeem_user');
		$crud->columns('id','user_id','brand_id','code','created_date','receipt_number','branch_name_location','offer_type');

		$crud->set_relation('user_id','users','username');
		$crud->set_relation('brand_id','brands','brand_name');

		$crud->display_as('user_id','User name');
		$crud->display_as('created_date','Date');
		$crud->display_as('brand_id','Brand name');
		$crud->display_as('brands_online_instore_id','Store name');
		$crud->display_as('branch_name_location','Branch name');

		// $crud->set_relation('sid','shop','name');


		// $crud->display_as('uid','User name');
		// $crud->display_as('sid','Shop name');

		// $date = date('Y-m-d h:i:s');
		// $crud->field_type('created_date', 'hidden', $date);


		$crud->set_theme('datatables');

		// $crud->unset_operations();
		$crud->unset_read();
		$crud->unset_edit();
		$crud->unset_add();

		// $crud->set_field_upload('image', UPLOAD_BLOG_POST);



		// echo "<pre>";
		// print_r($online);
		// die;


		// $crud->set_rules('question','Question','required');
		// $crud->set_rules('answer','Answer','required');

		// $crud->field_type('created_date', 'hidden');

		$crud->order_by('id','desc');

		// $crud->add_action('edit', '', 'admin/options/edit', '');
		// $crud->add_action('translate', '', 'admin/attribute/tedit', '');
		//$crud->add_action('delete', '', 'admin/attribute/delete', '');

		$this->mPageTitle = 'Redeem user Listing';
		$this->render_crud();
	}

}

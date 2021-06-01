<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class University extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
	}

	public function index()
	{
		$form = $this->form_builder->create_form('','','id="create_university_schools" class="university_schools" enctype="multipart/form-data" ');


		$university_schools = $this->custom_model->my_where('university_schools','*',array(),array(),"id","asc","","",array(),"");
		if (!empty($university_schools)) 
		{
			foreach ($university_schools as $key => $value) 
			{
				$university_school_id = $value['id'];

				$users = $this->custom_model->my_where('users','id',array("university_school_id" => $university_school_id),array(),"id","asc","","",array(),"");				
				$university_schools[$key]['student_count'] = count($users);
				
				$domains = $this->custom_model->my_where('domains','domain',array("university_id" => $university_school_id),array(),"id","asc","","",array(),"");
				if ($domains) 
				{
					$university_schools[$key]['domain'] = $domains[0]['domain'];
				}
				else
				{
					$university_schools[$key]['domain'] = '';
				}			

				
			}
		}

		// echo "<pre>";
		// print_r($university_schools);
		// die;

		$this->mViewData['university_schools'] = $university_schools;

		$this->mPageTitle = 'University/School List';

		$this->mViewData['form'] = $form;
		$this->render('university/listing');
	}

	public function create()
	{
		$form = $this->form_builder->create_form('','','id="university_create" class="university_create" enctype="multipart/form-data" ');


		$post_data = $this->input->post();
		if ( !empty($post_data) )
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;

	    	$domain = $post_data['domain'];
	    	$domain_check = $this->custom_model->my_where('domains','*',array("domain" => $domain),array(),"id","asc","","",array(),"");
	    	if ($domain_check) 
	    	{
	    		$this->system_message->set_error('Domain is already available so kindly change that');
	    	}
	    	else
	    	{
	    		$p_data['name'] = $post_data['name'];
		    	$p_data['dean_name'] = $post_data['dean_name'];
		    	$p_data['no_of_students'] = $post_data['no_of_students'];
		    	$p_data['status'] = $post_data['status'];

				//proceed to create Category
				$response = $this->custom_model->my_insert($p_data,'university_schools');

				$domain_data['domain'] = $domain;
				$domain_data['university_id'] = $response;
				$response = $this->custom_model->my_insert($domain_data,'domains');
				
				if ($response)
				{
					// success
					$this->system_message->set_success('University/School created successfully');
				}
				else
				{
					// failed
					$this->system_message->set_error('Something went wrong');
				}
	    	}
	    	refresh();
		}

		// $blog_categories = $this->custom_model->my_where('blog_categories','*',array('status' => 'active'),array(),"id","asc","","",array(),"");
		// $this->mViewData['category'] = $blog_categories;

		$this->mPageTitle = 'Add University/School';

		$this->mViewData['form'] = $form;
		$this->render('university/create');
	}

	public function edit($uni_id)
	{
		$form = $this->form_builder->create_form('','','id="edit_university" class="edit_university" enctype="multipart/form-data" ');


		$post_data = $this->input->post();
		if ( !empty($post_data) )
		{
			// echo "<pre>";
			// print_r($_FILES);
			// print_r($domain_check);
			// die;
			

			$domain = $post_data['domain'];
	    	$domain_check = $this->custom_model->my_where('domains','*',array("domain" => $domain,"university_id !=" => $uni_id),array(),"id","asc","","",array(),"");

	    	if ($domain_check) 
	    	{
	    		$this->system_message->set_error('Domain is already available so kindly change that');
	    	}
	    	else
	    	{
	    		$p_data['name'] = $post_data['name'];
		    	$p_data['dean_name'] = $post_data['dean_name'];
		    	$p_data['no_of_students'] = $post_data['no_of_students'];
		    	$p_data['status'] = $post_data['status'];

		    	$this->custom_model->my_update($p_data , array("id" => $uni_id) ,'university_schools');

				$domain_data['domain'] = $domain;
				$domain_data['university_id'] = $uni_id;

				$response = $this->custom_model->my_update($domain_data , array("university_id" => $uni_id) ,'domains');

				if ($response)
				{
					// success
					$this->system_message->set_success('University/School updated successfully');
				}
				else
				{
					// failed
					$this->system_message->set_error('Something went wrong');
				}


	    	}


			
		
			refresh();
		}

		// $category = $this->custom_model->my_where('blog_categories','*',array(),array(),"id","asc","","",array(),"");
		// $this->mViewData['category'] = $category;

		$domain = $this->custom_model->my_where('domains','*',array("university_id" => $uni_id),array(),"id","asc","","",array(),"");


		$university = $this->custom_model->my_where('university_schools','*',array('id' => $uni_id),array(),"id","asc","","",array(),"");
		$university[0]['domain'] = @$domain[0]['domain'];
		$this->mViewData['edit'] = $university[0];

		$this->mPageTitle = 'Edit blog';

		$this->mViewData['form'] = $form;
		$this->render('university/create');
	}

    public function delete_university()
	{
		$post_data = $this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;
		
		if (!empty($post_data)) 
		{
			$u_id 				= $post_data['u_id'];
			$this->custom_model->my_delete(['id' => $u_id], 'university_schools');
			$this->custom_model->my_delete(['university_id' => $u_id], 'domains');
			echo 1;
    		die;
		}
	}

	public function csv_dwonload()
	{
		

		$university = $this->custom_model->my_where('university_schools','*',array(),array(),"id","asc","","",array(),"");
		if (!empty($university)) 
		{
			foreach ($university as $key => $value) 
			{
				$domain = $this->custom_model->my_where('domains','*',array("university_id" => $value['id']),array(),"id","asc","","",array(),"");

				$university[$key]['domain'] = @$domain[0]['domain'];
			}
		}
		


		// echo "<pre>";
		// print_r($university);
		// die;
		
		
		$file_name='School_university_'.date("d-m-Y").'.csv';
		

		if (!empty($university))
		{
			header('Content-Type:text/csv');
			header("Content-Disposition: attachment; filename=\"$file_name\";");
			// header("Content-Disposition: attachment; filename=" );


			$str = 'Id, University/School ,Dean Name  ,Domain , Total Student , Status ,  Date(Joined on) ';

			$fp = fopen('php://output', 'wb');


			$i = 0;
			$header = explode(",", $str);
			fputcsv($fp, $header);

			foreach ($university as $key => $value)
			{
			 	$date=date('M-d-Y' ,strtotime($value['created_at']));

				$DATACSV[] = $value['id'];
				$DATACSV[] = $value['name'];
				$DATACSV[] = $value['dean_name'];
				$DATACSV[] = $value['domain'];
				$DATACSV[] = $value['no_of_students'];
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

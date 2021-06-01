<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Education extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
	}

	public function create($user_id = '')
	{
		// $form = $this->form_builder->create_form();
		$form = $this->form_builder->create_form('','','id="create_banner" class=""');

		$post_data = $this->input->post();
		if ( !empty($post_data) )
		{
			$post_data['user_id'] = $user_id;

			// echo "<pre>";
			// print_r($post_data);
			// die;			

			// proceed to create Category
			$response = $this->custom_model->my_insert($post_data,'user_education');
			
			if ($response)
			{
				// success
				$this->system_message->set_success('Education created successfully');
			}
			else
			{
				// failed
				$this->system_message->set_error('Something went wrong');
			}
		
		
		refresh();
		}

		$this->mPageTitle = 'Create education';

		$this->mViewData['form'] = $form;
		$this->render('education/create');
	}

	public function edit($cate_id)
	{
		$form = $this->form_builder->create_form();

		$post_data = $this->input->post();
		
		if ( !empty($post_data) )
		{
			$cate_data = $this->custom_model->my_where('user_education','*',array('id' => $cate_id));
			
			
			// $count = $this->custom_model->record_count('banner',array('banner_name' => $post_data['banner_name'], 'id !=' => $cate_id));
			// // $count = 0;
			// if ($count)
			// {
			// 	// failed 
			// 	$this->system_message->set_error('banner Already present<br>Unable to Create banner');
			// }
			// else
			// {
				// proceed to create Category
				$response = $this->custom_model->my_update($post_data,array('id' => $cate_id),'user_education');
				
				if ($response)
				{
					// success
					$this->system_message->set_success('Education Edited successfully');
				}
				else
				{
					// failed
					$this->system_message->set_error('Something went wrong');
				}
			// }
			
			refresh();
		}



		$cate_data = $this->custom_model->my_where('user_education','*',array('id' => $cate_id));
		$this->mViewData['edit'] = $cate_data[0];

		$this->mPageTitle = 'Edit education';

		$this->mViewData['form'] = $form;
		$this->render('education/create');
	}

}

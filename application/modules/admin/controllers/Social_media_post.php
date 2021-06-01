<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Social_media_post extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
	}

	public function index($rowno=0,$ajax='call',$serach='')
	{

		$data = $this->custom_model->get_data_array("SELECT social_media_post.post ,social_media_post.type,social_media_post.status,social_media_post.created_date ,social_media_post.category_id,social_media_post.id , blog_categories.categories_name as category_name  FROM social_media_post INNER JOIN blog_categories ON blog_categories.id = social_media_post.category_id   WHERE social_media_post.status='active'  ORDER BY social_media_post.id DESC  ");


		// echo "<pre>";
		// print_r($data);
		// die;	

		$this->mPageTitle = 'Social media post list' ;		
		$this->mViewData['data'] = $data;
		$this->render('social_media_post/listing');
	}
	
	public function create()
	{
		$form = $this->form_builder->create_form('','','id="social_create" class="social_create" ');

		$post_data = $this->input->post();

		if ($post_data) 
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;

			

			$ass['post'] 	= $post_data['post'];
			$ass['category_id'] 	= $post_data['category_id'];
			$ass['status'] 	= $post_data['status'];
			$ass['type'] 	= 'Blog';
			$ass['created_date'] 	= 'Blog';

			$response = $this->custom_model->my_insert($ass,'social_media_post');
			echo 'success';
    		die;
		}


		$blog_categories = $this->custom_model->my_where("blog_categories","*",array("status" =>'active') );

		$this->mPageTitle = 'Create Social media post';

		// echo "<pre>";
		// print_r($data); 
		// die;

		$this->mViewData['blog_categories'] = $blog_categories;
		$this->mViewData['form'] = $form;
		$this->render('admin/social_media_post/create');
	}

	public function edit($post_id = '')
	{
		$form = $this->form_builder->create_form('','','id="social_edit" class="social_edit" ');

		$post_data = $this->input->post();

		if ($post_data) 
		{
			// echo "<pre>";
			// print_r($post_data);
			// die;

			$ass['post'] 			= $post_data['post'];
			$ass['category_id'] 	= $post_data['category_id'];
			$ass['status'] 			= $post_data['status'];
			$ass['type'] 			= 'Blog';
			

			$response = $this->custom_model->my_update($ass, array("id" => $post_id),'social_media_post');
			echo 'success';
    		die;
		}

		$data = $this->custom_model->my_where("social_media_post","*",array("id" =>$post_id) );

		// print_r($data); die;
		$blog_categories = $this->custom_model->my_where("blog_categories","*",array("status" =>'active') );

		$this->mViewData['blog_categories'] = $blog_categories;
		$this->mViewData['edit'] = $data[0];
		$this->mViewData['form'] = $form;
		$this->mPageTitle = 'Edit social media post';
		$this->render('admin/social_media_post/create');
	}

	public function detete_post()
    {
    	$post_data=$this->input->post();
    	if(!empty($post_data))
    	{
    		$p_id = $post_data['p_id'];
			$this->custom_model->my_delete(['id' => $p_id], 'social_media_post');

    		echo 1;
    		die;
    	}else {
    		echo 0;
    		die;
    	}
    }

}




?>	
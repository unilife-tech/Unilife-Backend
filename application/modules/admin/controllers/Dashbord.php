<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashbord extends Admin_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		date_default_timezone_set('Europe/London');
		$dateTime = date("Y:m:d-H:i:s");

	}



	public function index()
	{		

		$coupon = $this->custom_model->get_data_array("SELECT * FROM redeem_coupon WHERE `id` != '' ORDER BY id desc limit 5 ");
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

		$users = $this->custom_model->get_data_array("SELECT COUNT(id) as users FROM users  ");
		$this->mViewData['users'] = $users[0]['users'];

		$delete_users = $this->custom_model->get_data_array("SELECT COUNT(id) as delete_users FROM delete_users  ");
		$this->mViewData['delete_users'] = $delete_users[0]['delete_users'];
		
		$offers = $this->custom_model->get_data_array("SELECT COUNT(id) as offers FROM offers  ");
		$this->mViewData['offers'] = $offers[0]['offers'];
		
		$blogs = $this->custom_model->get_data_array("SELECT COUNT(id) as blogs FROM blogs  ");
		$this->mViewData['blogs'] = $blogs[0]['blogs'];
		
		$brands = $this->custom_model->get_data_array("SELECT COUNT(id) as brands FROM brands  ");
		$this->mViewData['brands'] = $brands[0]['brands'];

		$posts = $this->custom_model->get_data_array("SELECT COUNT(id) as posts FROM posts  ");
		$this->mViewData['posts'] = $posts[0]['posts'];
		
		$groups = $this->custom_model->get_data_array("SELECT COUNT(id) as groups FROM groups  ");
		$this->mViewData['groups'] = $groups[0]['groups'];
		
		$university_schools = $this->custom_model->get_data_array("SELECT COUNT(id) as university_schools FROM university_schools  ");
		$this->mViewData['university_schools'] = $university_schools[0]['university_schools'];

		// echo "<pre>";
		// print_r($count_user);
		// die;

		$this->mViewData['coupon'] = $coupon;

		$this->mPageTitle = 'Dashbord';
		$this->render('admin/dashbord', 'plain');			
	}
}
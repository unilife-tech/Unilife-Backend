<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
	}


	// Create Frontend Category
	public function index()
	{
		$this->mPageTitle = 'USER API';
		$this->render('admin/api/list');
	}
}
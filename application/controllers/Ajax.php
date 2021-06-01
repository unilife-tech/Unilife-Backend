<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Ajax
 */
class Ajax extends MY_Controller {

	public function __construct()
	{
		$this->load->model('admin/Custom_model','custom_model');
	}
}


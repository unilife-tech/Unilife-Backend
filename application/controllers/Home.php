<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home page
 */
class Home extends MY_Controller {

	public function __construct()
	{
		$this->load->model('User_model');
		$this->load->model('admin/Custom_model','custom_model');
	}


	public function index()
	{
		$emails = 'accounts@unilifeapp.com';
		$subject = 'Subject to s';

		$name = "Girish";

		$message = "<p style='font-size: 12px;'>Hi $name,</p>
				<p style='font-size: 12px; color:#696969; margin-top: -15px;'>
				Your OTP is 1234.</p>
				<p style='font-size: 12px; color:#696969; margin-top: -10px;'>
				If you didn't make the request just ignore this email. Otherwise, you can enter your OTP.</p><br/>";

		send_email_using_postmark($emails,$subject,$message);

	}

}
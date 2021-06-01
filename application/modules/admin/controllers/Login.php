<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// NOTE: this controller inherits from MY_Controller instead of Admin_Controller,
// since no authentication is required
class Login extends MY_Controller {

	/**
	 * Login page and submission
	 */
	public function index()
	{
		$user_session = $this->session->all_userdata();
		if(!empty($user_session))
		{
			@$user_id = $user_session['user_id'];
			if (!empty($user_id))
			{
				redirect('/admin');
			}

		}

		
		// echo "<pre>";
		// print_r($user_session);
		// die;

		$this->load->library('form_builder');
		$form = $this->form_builder->create_form();

		if ($form->validate())
		{
			$this->load->model('custom_model');
			$identity = $this->input->post('username');
			$password = $this->input->post('password');
			$remember = ($this->input->post('remember')=='on');
			 
			if ($this->ion_auth->login($identity, $password, $remember))
			{
				// login 
				$user_session = $this->session->all_userdata();
				$user_id = $user_session['user_id'];
				$query = "SELECT b.group_id FROM admin_users as a INNER JOIN admin_users_groups as b ON a.id = b.user_id WHERE a.id='$user_id' ";
				$datacheck = $this->custom_model->get_data($query);


				// echo "<pre>";
				// print_r($datacheck);
				// die;

				$group_id = $datacheck[0]->group_id;
				// die;
				$store_type = $datacheck[0]->store_type;

				if($group_id != 1 && $group_id != 9){

					$errors = '<p>login credential is not authenticated.</p>';
					$this->system_message->set_error($errors);
					refresh();
				}else{
					$rand=(rand(10,1000));
					$token=en_de_crypt($rand);
					$this->session->set_userdata('token',$token);					
					$this->custom_model->my_update(array('token'=>$token),array('id' => $user_id),'admin_users');
					$messages = $this->ion_auth->messages();
					$this->system_message->set_success($messages);
					
					redirect($this->mModule);
				}				
			}
			else
			{
				// login failed
				$errors = $this->ion_auth->errors();
				$this->system_message->set_error($errors);
				refresh();
			}
		}
		
		// display form when no POST data, or validation failed
		$this->mViewData['form'] = $form;
		$this->mBodyClass = 'login-page';
		$this->render('login', 'empty');
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Panel management, includes: 
 * 	- Admin Users CRUD
 * 	- Admin User Groups CRUD
 * 	- Admin User Reset Password
 * 	- Account Settings (for login user)
 */
class Panel extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
	}
	
	public function index()
	{
		$crud = $this->generate_crud('admin_users');
		
		$crud->columns('id','first_name','phone', 'email');

		// $this->unset_crud_fields('ip_address', 'last_login');
		//$crud->set_relation('country_code', 'country', 'name', 'phonecode');
		$crud->set_theme('datatables');
		//$crud->display_as('country_code','Country');

		// only webmaster and admin can change member groups
		if ($crud->getState()=='list' || $this->ion_auth->in_group(array('webmaster', 'admin')))
		{
			//$crud->set_relation_n_n('groups', 'users_groups', 'groups', 'user_id', 'group_id', 'name');
		}

		// only webmaster and admin can reset user password
		if ($this->ion_auth->in_group(array('webmaster', 'admin')))
		{
		//	$crud->add_action('refresh', '', 'admin/user/reset_password', 'fa fa-repeat');
		}

		// disable direct create / delete Frontend User

		$crud->where('group_id','9');
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_edit();
		$crud->unset_operations();

		$crud->order_by('id','desc');
		$crud->add_action('remove_red_eye', '', 'admin/panel/admin_user_reset_password', '');
		
		$this->mPageTitle = 'Partner List';
		$this->render_crud();
	}

	public function account()
	{
		// Update Info form
		$form1 = $this->form_builder->create_form($this->mModule.'/panel/account_update_info');
		$form1->set_rule_group('panel/account_update_info');
		$this->mViewData['form1'] = $form1;

		// Change Password form
		$form2 = $this->form_builder->create_form($this->mModule.'/panel/account_change_password');
		$form1->set_rule_group('panel/account_change_password');
		$this->mViewData['form2'] = $form2;

		$admin_users = $this->custom_model->my_where('admin_users','id,logo',array('id' => $this->mUser->id));
		// echo "<pre>";
		// print_r($admin_users);
		// die;
		$this->mViewData['admin_users'] = $admin_users;
		$this->mPageTitle = "Account Settings";
		$this->render('panel/account');
	}

	public function account_update_info()
	{
		$data = $this->input->post();
		if ($this->ion_auth->update($this->mUser->id, $data))
		{
			$messages = $this->ion_auth->messages();
			$this->system_message->set_success($messages);
		}
		else
		{
			$errors = $this->ion_auth->errors();
			$this->system_message->set_error($errors);
		}

		redirect($this->mModule.'/panel/account');
	}


		// Submission of Change Password form
	public function account_change_password()
	{
		$user_session = $this->session->all_userdata();
		$user_id = $user_session['user_id'];
		
		// print_r($user_id);
		// die;

		$new_password = $this->input->post('new_password');
		$retype_password = $this->input->post('retype_password');

		if ($new_password != $retype_password)
		{
			$this->system_message->set_error("Password Miss Match");

		}
		else{
			$data = array('password' => $this->input->post('new_password'));
			if (!empty($new_password) && !empty($retype_password))
			{
				if ($this->ion_auth->update($this->mUser->id, $data))
				{
					$this->custom_model->my_update(array('password_show'=>$new_password),array('id' => $user_id),'admin_users');
					echo "success"; die;
				}
				else
				{
					echo "error"; die;
				}
			}
			else
			{
				echo "error"; die;
			}
		}
		
	}
	

	
	// Admin User Groups CRUD
	public function admin_user_group()
	{
		$crud = $this->generate_crud('admin_groups');
		$crud->set_theme('datatables');
		$this->mPageTitle = 'Admin User Groups';
		$this->render_crud();
	}

	

	/**
	 * Logout user
	 */
	public function logout()
	{
		$this->ion_auth->logout();
		redirect($this->mConfig['login_url']);
	}

	public function delete($id)
	{
		$this->custom_model->my_delete(array("id" => $id),"admin_users",false);
		$this->custom_model->my_delete(array("id" => $id),"admin_users_trans",false);
		header( "Location: ".base_url()."admin/panel/vendor_user" );die;
	}

	public function upload_logo()
	{
		if(!empty($this->mUser->id))
		{
			if(isset($_FILES) and $_FILES['logo']['name']!='')
			{
				@$FILES = $_FILES["logo"];
				$folder_name='admin/usersdata/';
				@$image_name = $this->uploads($FILES,$folder_name);
				$this->custom_model->my_update(array('logo' =>$image_name),array('id' =>$this->mUser->id),'admin_users');
				echo 1;
				die;											
			}else{
				echo 2;
				die;
			}	
		}
		echo 0;
		die;	
	}

	public function uploads($FILES,$folder_name='')
    {    	
        if (isset($FILES['name'])) {
            //$upload_dir = ASSETS_PATH . "/admin/category/";
            $upload_dir = ASSETS_PATH .$folder_name;
            // print_r($upload_dir);
            // die;
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

}
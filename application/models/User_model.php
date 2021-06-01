<?php 

class User_model extends MY_Model {


	function validate_user($user_name, $password,$table='users',$group_id="9")
	{
		$this->db->select('id,password,first_name,last_name,email,mobile,group_id,social,active');
		$this->db->where('username', $user_name);
		// if(!empty($group_id)) $this->db->where('group_id', $group_id);
		$this->db->or_where('mobile', $user_name);
		$re = $this->db->get($table)->result_array();
		$data = 0;
		foreach ($re as $krey => $userdata) {
			if(!empty($userdata))
			{
				
				$pass_word = $userdata['password'];
				if ($userdata['active'] == 0) {
					$data = 11;
				}
				elseif(password_verify ( $password ,$pass_word ))
				{
					// $data = array('firstname' => $firstname, 'uid' => $id, 'email' => $username, 'phone' => $phone,"last_name" => $last_name, "group_id" => $group_id);
					$userdata['uid'] = $userdata['id'];
				//	$userdata['logo_url'] = base_url("assets/admin/seller_img/").$userdata['logo'];
				//$userdata['banner_url'] = base_url("assets/admin/seller_img/").$userdata['banner'];
					unset($userdata['password']);
					unset($userdata['id']);
					return $userdata;
				}
				else{
					$data = 1;
				}
			}
			else{
				$data = 0;
			}	
		}	
		return $data;
	}	
	
	function create_member($new_member_insert_data)
	{
		$this->db->where('username', $new_member_insert_data['username']);
		$query = $this->db->get('users')->result();

		if (!empty($new_member_insert_data['invite_code']))
		{
			$check = $this->custom_model->record_count('users', ['own_refere_id' => $new_member_insert_data['invite_code']]);
			// print_r($check); die;
			if (empty($check))
			{
				return 'invite_code';
			}
		}

        if(!empty($query)){ 
        	return 'email';
		}else{
  			
			$this->db->where('mobile', $new_member_insert_data['mobile']);
			$query = $this->db->get('users')->result();

	        if(!empty($query)){
	        	return 'mobile';
			}else{

				$insert = $this->db->insert('users', $new_member_insert_data);
			    return $this->db->insert_id();
			}
		}
	      
	}

	function forget_password($username){
		$this->db->select('id,password,first_name,email');
		$this->db->where('username', $username);
		$this->db->or_where('mobile', $username);
		$this->db->or_where('email', $username);
		$q = $this->db->get('users');
		$userdata = $q->row();
		if(!empty($userdata))
		{	$forgotten_password_code = uniqid();
			$this->db->where("id", $userdata->id);
			$this->db->update("users",array("forgotten_password_code" => $forgotten_password_code));
			$userdata->forgotten_password_code = $forgotten_password_code;
			return $userdata;
		}else{
			return false;
		}
	}
}
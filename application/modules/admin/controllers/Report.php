<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_builder');
		$this->load->model('custom_model');
		$this->load->model('category_model');
	}

	public function index($rowno=0,$ajax='call',$serach='')
	{
		// $users_data = $this->custom_model->my_where('users','*',array('id!=' =>'1'));		

		$this->load->library('pagination');  

   		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}		
		 // Row per page
    	$rowperpage = 20;
    	$page_no=0;

    	// Row position
    	if($rowno != 0){
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}
    	if($ajax=='call')
		{
   			$users_data = $this->custom_model->get_data_array("SELECT report_user_post.user_id,report_user_post.id,report_user_post.created_at,report_user_post.report_user_id,report_user_post.report_post_id,report_user_post.type,report_user_post.reason,users.username  FROM report_user_post  INNER JOIN users ON users.id = report_user_post.user_id  WHERE report_user_post.report_post_id = ''   ORDER BY report_user_post.id DESC LIMIT $rowno,$rowperpage ");

   			$users_count = $this->custom_model->get_data_array("SELECT report_user_post.user_id,report_user_post.id,report_user_post.created_at,report_user_post.report_user_id,report_user_post.report_post_id,report_user_post.type,report_user_post.reason,users.username  FROM report_user_post  INNER JOIN users ON users.id = report_user_post.user_id  WHERE report_user_post.report_post_id = ''  ");
 			
   		}else 
   		{
			if(empty($serach))
			{
				$users_data = $this->custom_model->get_data_array("SELECT report_user_post.user_id,report_user_post.id,report_user_post.created_at,report_user_post.report_user_id,report_user_post.report_post_id,report_user_post.type,report_user_post.reason,users.username  FROM report_user_post  INNER JOIN users ON users.id = report_user_post.user_id  WHERE report_user_post.report_post_id = ''   ORDER BY report_user_post.id DESC LIMIT $rowno,$rowperpage ");

	   			$users_count = $this->custom_model->get_data_array("SELECT report_user_post.user_id,report_user_post.id,report_user_post.created_at,report_user_post.report_user_id,report_user_post.report_post_id,report_user_post.type,report_user_post.reason,users.username  FROM report_user_post  INNER JOIN users ON users.id = report_user_post.user_id  WHERE report_user_post.report_post_id = ''  ");   			
			}
			else 
			{				
				$users_data = $this->custom_model->get_data_array("SELECT report_user_post.user_id,report_user_post.created_at,report_user_post.id,report_user_post.report_user_id,report_user_post.report_post_id,report_user_post.type,report_user_post.reason,users.username  FROM report_user_post  INNER JOIN users ON users.id = report_user_post.user_id  WHERE report_user_post.report_post_id = '' AND ( report_user_post.type LIKE '%$serach%' OR report_user_post.reason LIKE '%$serach%'  OR username LIKE '%$serach%'  OR report_user_post.id LIKE '%$serach%' )    ORDER BY report_user_post.id DESC LIMIT $rowno,$rowperpage ");

				$users_count = $this->custom_model->get_data_array("SELECT report_user_post.user_id,report_user_post.created_at,report_user_post.id,report_user_post.report_user_id,report_user_post.report_post_id,report_user_post.type,report_user_post.reason,users.username  FROM report_user_post  INNER JOIN users ON users.id = report_user_post.user_id  WHERE report_user_post.report_post_id = '' AND (report_user_post.type LIKE '%$serach%' OR report_user_post.reason LIKE '%$serach%'  OR username LIKE '%$serach%'  OR report_user_post.id LIKE '%$serach%' )    ORDER BY report_user_post.id DESC ");
			}
		}

		if(!empty($users_data))
		{
			foreach ($users_data as $ud_key => $ud_val) 
			{
				$u_id = $ud_val['report_user_id'];
				$us_data = $this->custom_model->get_data_array("SELECT username FROM users WHERE id ='$u_id' ORDER BY id desc ");
				if ($us_data) 
				{
					$users_data[$ud_key]['againt_complain'] = $us_data[0]['username'];
				}
				else
				{
					$users_data[$ud_key]['againt_complain'] = '';
				}


				$users_data[$ud_key]['created_at'] = date('M-d-Y' ,strtotime($ud_val['created_at']));
				$user_id=$ud_val['id'];
			}
		}

		$config['base_url'] = base_url().'admin/report/index';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = count($users_count);
	    $config['per_page'] = $rowperpage;   
	    $config['page_query_string'] = FALSE;             
	    $config['enable_query_strings'] = FALSE;             
	    $config['reuse_query_string']  = FALSE;             
	    $config['cur_page'] = $page_no;  
	    
	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $users_data;
	    $data['row'] = $rowno;
	    $data['total_rows'] = count($users_count);
	    // $this->mViewData['pagination'] = $this->pagination->create_links();	
	    // this for when page load	     				
	    if($ajax =='call' && $rowno==0 && empty($post_data)){			    	
	    	$this->mViewData['pagination'] = $this->pagination->create_links();		     				
		}elseif($serach !='') {  // this for search button pagination
			echo json_encode($data);
 			exit;    				 
		}else { // this for pagination-
 			echo json_encode($data);
 			exit; 	
		}
		// $users_data = $this->custom_model->get_data_array("SELECT * FROM users WHERE id!='1' ORDER BY id desc ");




		// echo $this->db->last_query();
		// echo "<pre>";
		// print_r($users_data);
		// die;	

		$this->mPageTitle = 'Report user' ;		
		$this->mViewData['users_data'] = $users_data;
		$this->render('report/listing');
	}
	

	public function post($rowno=0,$ajax='call',$serach='')
	{
		// $users_data = $this->custom_model->my_where('users','*',array('id!=' =>'1'));		

		$this->load->library('pagination');  

   		$post_data = $this->input->post();

		if (!empty($post_data))
		{
			$rowno = $post_data['pagno'];
			$ajax 	= $post_data['ajax'];
			$serach = $post_data['serach'];
		}		
		 // Row per page
    	$rowperpage = 20;
    	$page_no=0;

    	// Row position
    	if($rowno != 0){
    		$page_no=$rowno;
      		$rowno = ($rowno-1) * $rowperpage;
    	}
    	if($ajax=='call')
		{
   			$users_data = $this->custom_model->get_data_array("SELECT report_user_post.user_id,report_user_post.id,report_user_post.created_at,report_user_post.report_user_id,report_user_post.report_post_id,report_user_post.type,report_user_post.reason,users.username  FROM report_user_post  INNER JOIN users ON users.id = report_user_post.user_id  WHERE report_user_post.report_post_id != ''   ORDER BY report_user_post.id DESC LIMIT $rowno,$rowperpage ");

   			$users_count = $this->custom_model->get_data_array("SELECT report_user_post.user_id,report_user_post.id,report_user_post.created_at,report_user_post.report_user_id,report_user_post.report_post_id,report_user_post.type,report_user_post.reason,users.username  FROM report_user_post  INNER JOIN users ON users.id = report_user_post.user_id  WHERE report_user_post.report_post_id != ''  ");
 			
   		}else 
   		{
			if(empty($serach))
			{
				$users_data = $this->custom_model->get_data_array("SELECT report_user_post.user_id,report_user_post.id,report_user_post.created_at,report_user_post.report_user_id,report_user_post.report_post_id,report_user_post.type,report_user_post.reason,users.username  FROM report_user_post  INNER JOIN users ON users.id = report_user_post.user_id  WHERE report_user_post.report_post_id != ''   ORDER BY report_user_post.id DESC LIMIT $rowno,$rowperpage ");

	   			$users_count = $this->custom_model->get_data_array("SELECT report_user_post.user_id,report_user_post.id,report_user_post.created_at,report_user_post.report_user_id,report_user_post.report_post_id,report_user_post.type,report_user_post.reason,users.username  FROM report_user_post  INNER JOIN users ON users.id = report_user_post.user_id  WHERE report_user_post.report_post_id = ''  ");   			
			}
			else 
			{				
				$users_data = $this->custom_model->get_data_array("SELECT report_user_post.user_id,report_user_post.created_at,report_user_post.id,report_user_post.report_user_id,report_user_post.report_post_id,report_user_post.type,report_user_post.reason,users.username  FROM report_user_post  INNER JOIN users ON users.id = report_user_post.user_id  WHERE report_user_post.report_post_id != '' AND ( report_user_post.type LIKE '%$serach%' OR report_user_post.reason LIKE '%$serach%'  OR username LIKE '%$serach%'  OR report_user_post.id LIKE '%$serach%' )    ORDER BY report_user_post.id DESC LIMIT $rowno,$rowperpage ");

				$users_count = $this->custom_model->get_data_array("SELECT report_user_post.user_id,report_user_post.created_at,report_user_post.id,report_user_post.report_user_id,report_user_post.report_post_id,report_user_post.type,report_user_post.reason,users.username  FROM report_user_post  INNER JOIN users ON users.id = report_user_post.user_id  WHERE report_user_post.report_post_id != '' AND (report_user_post.type LIKE '%$serach%' OR report_user_post.reason LIKE '%$serach%'  OR username LIKE '%$serach%'  OR report_user_post.id LIKE '%$serach%' )    ORDER BY report_user_post.id DESC ");
			}
		}

		if(!empty($users_data))
		{
			foreach ($users_data as $ud_key => $ud_val) 
			{
				$pid = $ud_val['report_post_id'];
				$pdata = $this->custom_model->get_data_array("SELECT user_id FROM posts WHERE id ='$pid' ORDER BY id desc ");

				if ($pdata) 
				{
					$users_data[$ud_key]['pdata'] = $pdata[0]['user_id'];

					$u_id = $pdata[0]['user_id'];
				
					$us_data = $this->custom_model->get_data_array("SELECT username FROM users WHERE id ='$u_id' ORDER BY id desc ");
					if ($us_data) 
					{
						$users_data[$ud_key]['againt_complain'] = $us_data[0]['username'];
					}
					else
					{
						$users_data[$ud_key]['againt_complain'] = '';
					}
				}
				else
				{
					$users_data[$ud_key]['pdata'] = '';
					$users_data[$ud_key]['againt_complain'] = '';
				}


				$users_data[$ud_key]['created_at'] = date('M-d-Y' ,strtotime($ud_val['created_at']));
				$user_id=$ud_val['id'];
			}
		}

		$config['base_url'] = base_url().'admin/report/post';
	    $config['use_page_numbers'] = TRUE;
	    $config['total_rows'] = count($users_count);
	    $config['per_page'] = $rowperpage;   
	    $config['page_query_string'] = FALSE;             
	    $config['enable_query_strings'] = FALSE;             
	    $config['reuse_query_string']  = FALSE;             
	    $config['cur_page'] = $page_no;  
	    
	     // Initialize
	    $this->pagination->initialize($config);
	     // Initialize $data Array
	    $data['pagination'] = $this->pagination->create_links();
	    $data['result'] = $users_data;
	    $data['row'] = $rowno;
	    $data['total_rows'] = count($users_count);
	    // $this->mViewData['pagination'] = $this->pagination->create_links();	
	    // this for when page load	     				
	    if($ajax =='call' && $rowno==0 && empty($post_data)){			    	
	    	$this->mViewData['pagination'] = $this->pagination->create_links();		     				
		}elseif($serach !='') {  // this for search button pagination
			echo json_encode($data);
 			exit;    				 
		}else { // this for pagination-
 			echo json_encode($data);
 			exit; 	
		}
		// $users_data = $this->custom_model->get_data_array("SELECT * FROM users WHERE id!='1' ORDER BY id desc ");




		// echo $this->db->last_query();
		// echo "<pre>";
		// print_r($users_data);
		// die;	

		$this->mPageTitle = 'Report user post' ;		
		$this->mViewData['users_data'] = $users_data;
		$this->render('report/post_listing');
	}

    public function delete_complain_user()
    {
    	$post_data=$this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;	

    	if(!empty($post_data))
    	{
    		$c_uid 	= $post_data['c_uid'];
    		$c_id 	= $post_data['c_id'];

    		$this->custom_model->my_delete(['id' => $c_uid], 'users');
    		$this->custom_model->my_delete(['id' => $c_id], 'report_user_post');
    		echo 1;
    		die;
    	}
    	else 
    	{
    		echo 0;
    		die;
    	}
    }

    public function delete_report()
    {
    	$post_data=$this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;	
		
    	if(!empty($post_data))
    	{
    		$report_id 	= $post_data['report_id'];

    		$this->custom_model->my_delete(['id' => $report_id], 'report_user_post');
    		echo 1;
    		die;
    	}
    	else 
    	{
    		echo 0;
    		die;
    	}
    }

    public function delete_post()
    {
    	$post_data=$this->input->post();

		// echo "<pre>";
		// print_r($post_data);
		// die;	

    	if(!empty($post_data))
    	{
    		$p_id 	= $post_data['p_id'];
    		$r_id 	= $post_data['r_id'];

    		$this->custom_model->my_delete(['id' => $r_id], 'report_user_post');
    		$this->custom_model->my_delete(['id' => $p_id], 'posts');
    		echo 1;
    		die;
    	}
    	else 
    	{
    		echo 0;
    		die;
    	}
    }

}




?>	
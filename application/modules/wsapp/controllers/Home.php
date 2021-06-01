<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function __construct()
	{
		$this->load->model('default_model');
		$this->load->model('admin/custom_model');
		$this->load->library("Jwt_client");
		$this->load->model('admin/User_model');
	    $this->token_id = "s56by73212343289fdsfitdsdne";
	}

	public function textlocal_smss($value='')
	{
		// Account details
		$apiKey = urlencode('b9lP8qUQ/Fc-M8smYrLdfOyBdszbXsBTFyzwdqZlBS	');
		
		// Message details
		$numbers = array(918149169115);
		$sender = urlencode('chickf');
		$message = rawurlencode('Dear customer , your otp for login is 123333');
	 
		$numbers = implode(',', $numbers);
	 
		// Prepare data for POST request
		$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
	 
		// Send the POST request with cURL
		$ch = curl_init('https://api.textlocal.in/send/');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		
		// Process your response here
		echo $response;

	}
	public function user_highlights()
	{
		$json = file_get_contents('php://input');
		
		// $json 		= '{"currently_working":"Persausive Technology", "currently_studying":"No","graduated_from":"Pune University","complete_highschool_at":"Ahmednagar College AHmednagar","lives_in":"Pune Maharashtra","from":"Ahmednagar India","personal_information":"What is Lorem Ipsum Lorem Ipsum is simply dummy text of the printing and typesetting industry Lorem Ipsum has been the industry " 
		
		$jsonobj 					= json_decode($json);
		$currently_working 			= @$jsonobj->currently_working;
		$currently_studying 		= @$jsonobj->currently_studying;
		$graduated_from 			= @$jsonobj->graduated_from;
		$complete_highschool_at 	= @$jsonobj->complete_highschool_at;
		$lives_in 					= @$jsonobj->lives_in;
		$from 						= @$jsonobj->from;
		$personal_information 		= @$jsonobj->personal_information;
		$lives_in 					= @$jsonobj->lives_in;

		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'user_highlights':$ws;
		$string 	= @$jsonobj->string;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		$data = $this->custom_model->get_data_array("SELECT * FROM  `user_highlights` WHERE `user_id` = '$user_id' ");

   	 		if (empty($data) && empty($currently_working))
   	 		{
   	 			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'No highlight found') )); die;
			}

   	 		// $data = $this->custom_model->get_data_array("SELECT * FROM  `users` WHERE `id` = '$user_id' ");

   	 		$additional_data = array();

			$additional_data['user_id'] 								= $user_id;
			$additional_data['currently_working'] 			= $currently_working;
			$additional_data['currently_studying'] 			= $currently_studying;
			$additional_data['graduated_from'] 				= $graduated_from;
	        $additional_data['complete_highschool_at'] 		= $complete_highschool_at;
	        $additional_data['lives_in'] 					= $lives_in;
	        $additional_data['from'] 						= $from;
	        $additional_data['personal_information'] 		= $personal_information;

   	 		// echo "<pre>";
   	 		// echo $this->db->last_query();
   	 		// print_r($additional_data);
   	 		// die;

   	 		if (empty($data))
   	 		{
   	 			$result = $this->custom_model->my_insert($additional_data,"user_highlights");
			}
   	 		else
   	 		{
   	 			$result = $this->custom_model->my_update($additional_data,array("user_id" => $user_id),"user_highlights");
   	 		}

   	 		$data = $this->custom_model->get_data_array("SELECT * FROM `user_highlights` WHERE `user_id` = '$user_id' ");

   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data[0] ,"message" => ($language == 'ar'? '':'Highlight add  Successfully') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}
   	
   	public function user_experience()
	{
		$json = file_get_contents('php://input');
		
		// $json 		= '{"image":"d926c4f0bd2e66b34eddf33a20d62845.jpg","company_name":"Persausive Technology", "designation":"PHP Developer","emp_type":"Permanant","start_date":"2019/01/29","end_date":"2020/01/29","industry":"IT","location":"Pune","type":"save"}';

		// $json 		= '{"image":"d926c4f0bd2e66b34eddf33a20d62845.jpg","company_name":"Persausive Technology", "designation":"PHP Developer","emp_type":"Permanant","start_date":"2019/01/29","end_date":"2020/01/29","industry":"IT","location":"Pune","type":"update","id":"1"}';

		// $json 		= '{"type":"delete","id":"2"}';
		
		$jsonobj 					= json_decode($json);
		$image 						= @$jsonobj->image;
		$company_name 				= @$jsonobj->company_name;
		$designation 				= @$jsonobj->designation;

		$emp_type 					= @$jsonobj->emp_type;
		$industry 					= @$jsonobj->industry;

		$start_date 				= @$jsonobj->start_date;
		$end_date 					= @$jsonobj->end_date;
		$location 					= @$jsonobj->location;
		$id 						= @$jsonobj->id;
		$type 						= @$jsonobj->type;


		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'user_experience':$ws;
		$string 	= @$jsonobj->string;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		$data = $this->custom_model->get_data_array("SELECT id FROM  `user_experience` WHERE `user_id` = '$user_id' ");

   	 		if (empty($data) && empty($company_name))
   	 		{
   	 			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'No user experience found') )); die;
			}

   	 		// $data = $this->custom_model->get_data_array("SELECT * FROM  `users` WHERE `id` = '$user_id' ");

   	 		$additional_data = array();

			if(!empty($user_id)) $additional_data['user_id'] 								= $user_id;
			if(!empty($image)) $additional_data['image'] 									= $image;
			if(!empty($company_name)) $additional_data['company_name'] 						= $company_name;

			if(!empty($emp_type)) $additional_data['emp_type'] 								= $emp_type;
			if(!empty($industry)) $additional_data['industry'] 								= $industry;

			if(!empty($designation)) $additional_data['designation'] 						= $designation;
			if(!empty($start_date)) $additional_data['start_date'] 							= $start_date;
	        if(!empty($end_date)) $additional_data['end_date'] 								= $end_date;
	        if(!empty($location)) $additional_data['location'] 								= $location;

   	 		// echo "<pre>";
   	 		// echo $this->db->last_query();
   	 		// print_r($additional_data);
   	 		// die;

   	 		if ($type == 'save')
   	 		{
   	 			$result = $this->custom_model->my_insert($additional_data,"user_experience");
			}
   	 		else if ($type == 'update')
   	 		{
   	 			$result = $this->custom_model->my_update($additional_data,array("id" => $id),"user_experience");
   	 		}
   	 		else if ($type == 'delete')
   	 		{
   	 			$result = $this->custom_model->my_delete(array("id" => $id),"user_experience");

   	 			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Delete Successfully') )); die;
   	 		}

   	 		$data = $this->custom_model->get_data_array("SELECT id,image,company_name,designation,start_date,end_date,location,emp_type,industry FROM `user_experience` WHERE `user_id` = '$user_id' ");

   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Experience add Successfully') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}

	public function user_skills()
	{
		$json = file_get_contents('php://input');
		
		// $json 		= '{"skill_name":"Dancer,artist","search":"kids"}';
		
		$jsonobj 					= json_decode($json);
		$skill_name 				= @$jsonobj->skill_name;


		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'user_skills':$ws;
		$search 	= @$jsonobj->search;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		if (!empty($search))
   	 		{
   	 			$data = $this->custom_model->get_data_array("SELECT skill_name FROM user_skills WHERE `skill_name` LIKE '%$search%' order by id asc  LIMIT 5 ");
   	 			
   	 			if (!empty($data)) 
   	 			{
   	 				echo json_encode(array("status" => true ,"ws" => $ws  ,"data" => $data ,"message" => ($language == 'ar'? '':'Successfully') )); die;
   	 			}
   	 			else
   	 			{
   	 				echo json_encode(array("status" => true ,"data" => $data  ,"ws" => $ws ,"message" => ($language == 'ar'? '':'No user skills found') )); die;
   	 			}
			}

			if (empty($skill_name)) 
 			{
 				// $result = $this->custom_model->my_delete(array("user_id" => $user_id),"user_skills");
 				$data = $this->custom_model->get_data_array("SELECT id,skill_name FROM `user_skills` WHERE `user_id` = '$user_id' ");

   	 			echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Skiils add successfully') )); die;
 			}

 			

			$data_skills = explode (",", $skill_name);  


   	 		// echo "<pre>";
   	 		// echo $this->db->last_query();
   	 		// print_r($data_skills);
   	 		// die;

 			$additional_data = array();
 			
 			$result = $this->custom_model->my_delete(array("user_id" => $user_id),"user_skills");

 			foreach ($data_skills as $key => $value) 
 			{
 				if (!empty($value))
 				{
	 				if(!empty($user_id)) $additional_data['user_id'] 	= $user_id;
					if(!empty($value)) $additional_data['skill_name'] 	= $value;
	 				$result = $this->custom_model->my_insert($additional_data,"user_skills");
 				}
 			}   	 		

   	 		$data = $this->custom_model->get_data_array("SELECT skill_name FROM `user_skills` WHERE `user_id` = '$user_id' ");

   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Skiils add successfully') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}


	public function user_languages()
	{
		$json = file_get_contents('php://input');
		
		// $json 		= '{"search":"English"}';
		// $json 		= '{"language_name":"Dancer"}';

		
		$jsonobj 					= json_decode($json);
		$search 					= @$jsonobj->search;
		$language_name 				= @$jsonobj->language_name;

		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'user_languages':$ws;
		$string 	= @$jsonobj->string;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		if (!empty($search))
   	 		{
   	 			$data = $this->custom_model->get_data_array("SELECT language_name FROM user_languages WHERE `language_name` LIKE '%$search%' order by id asc  LIMIT 1 ");
   	 			
   	 			if (!empty($data)) 
   	 			{
   	 				echo json_encode(array("status" => true ,"ws" => $ws  ,"data" => $data ,"message" => ($language == 'ar'? '':'Successfully') )); die;
   	 			}
   	 			else
   	 			{
   	 				echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'No user skills found') )); die;
   	 			}
			}


			if (empty($language_name)) 
 			{
 				// $result = $this->custom_model->my_delete(array("user_id" => $user_id),"user_languages");
 				$data = $this->custom_model->get_data_array("SELECT id,language_name FROM `user_languages` WHERE `user_id` = '$user_id' ");

   	 			echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Successfully') )); die;
 			}

   	 		// echo "<pre>";
   	 		// echo $this->db->last_query();
   	 		// print_r($additional_data);
   	 		// die;

			$data_lang = explode (",", $language_name); 

			$additional_data = array();
 			
 			$result = $this->custom_model->my_delete(array("user_id" => $user_id),"user_languages");

 			foreach ($data_lang as $key => $value) 
 			{
 				if (!empty($value))
 				{
	 				if(!empty($user_id)) $additional_data['user_id'] 		= $user_id;
					if(!empty($value)) $additional_data['language_name'] 	= $value;
	 				$result = $this->custom_model->my_insert($additional_data,"user_languages");
 				}
 			}

   	 		$data = $this->custom_model->get_data_array("SELECT language_name FROM `user_languages` WHERE `user_id` = '$user_id' ");

   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Language add successfully') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}

	public function user_course()
	{
		$json = file_get_contents('php://input');
		
		// $json 		= '{"search":"English"}';
		// $json 		= '{"name":"Arebic"}';

		
		$jsonobj 					= json_decode($json);
		$search 					= @$jsonobj->search;
		$name 						= @$jsonobj->name;

		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'user_course':$ws;
		$string 	= @$jsonobj->string;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		if (!empty($search))
   	 		{
   	 			$data = $this->custom_model->get_data_array("SELECT name FROM user_course WHERE `name` LIKE '%$search%' order by id asc  LIMIT 5 ");
   	 			
   	 			if (!empty($data)) 
   	 			{
   	 				echo json_encode(array("status" => true ,"ws" => $ws  ,"data" => $data ,"message" => ($language == 'ar'? '':'Course added Successfully') )); die;
   	 			}
   	 			else
   	 			{
   	 				echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'No user skills found') )); die;
   	 			}
			}


			if (empty($name)) 
 			{
 				// $result = $this->custom_model->my_delete(array("user_id" => $user_id),"user_course");
 				$data = $this->custom_model->get_data_array("SELECT id,name FROM `user_course` WHERE `user_id` = '$user_id' ");

   	 			echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Course added Successfully') )); die;
 			}

   	 		// echo "<pre>";
   	 		// echo $this->db->last_query();
   	 		// print_r($additional_data);
   	 		// die;

			$data_lang = explode (",", $name); 

			$additional_data = array();
 			
 			$result = $this->custom_model->my_delete(array("user_id" => $user_id),"user_course");

 			foreach ($data_lang as $key => $value) 
 			{
 				if (!empty($value))
 				{
	 				if(!empty($user_id)) $additional_data['user_id'] 		= $user_id;
					if(!empty($value)) $additional_data['name'] 	= $value;
	 				$result = $this->custom_model->my_insert($additional_data,"user_course");
 				}
 			}

   	 		$data = $this->custom_model->get_data_array("SELECT name FROM `user_course` WHERE `user_id` = '$user_id' ");

   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Course added Successfully') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}

	public function user_achievements()
	{
		$json = file_get_contents('php://input');
		
		// $json 		= '{"certificate_name":"Best Teacher Of the Year","offered_by":"BBA International Management ","offered_date":"2020","duration":"1 Month","type":"save"}';
		// $json 		= '{"certificate_name":"Best Teacher Of the Year","offered_by":"BBA International Management " ,"offered_date" :"2020/01/3","duration":"1 Month","id":"1","type":"update"}';
		// $json 		= '{"id":"1","type":"delete"}';

		
		$jsonobj 					= json_decode($json);
		$certificate_name 			= @$jsonobj->certificate_name;
		$offered_by 				= @$jsonobj->offered_by;
		$offered_date 				= @$jsonobj->offered_date;
		$duration 					= @$jsonobj->duration;

		$id 						= @$jsonobj->id;
		$type 						= @$jsonobj->type;


		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'user_achievements':$ws;
		$string 	= @$jsonobj->string;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		$data = $this->custom_model->get_data_array("SELECT id FROM  `user_achievements` WHERE `user_id` = '$user_id' ");

   	 		if (empty($data) && empty($certificate_name))
   	 		{
   	 			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'No user achievements found') )); die;
			}

   	 		// $data = $this->custom_model->get_data_array("SELECT * FROM  `users` WHERE `id` = '$user_id' ");

   	 		$additional_data = array();

			if(!empty($user_id)) $additional_data['user_id'] 								= $user_id;
			if(!empty($certificate_name)) $additional_data['certificate_name']			 	= $certificate_name;
			if(!empty($offered_by)) $additional_data['offered_by']			 				= $offered_by;
			if(!empty($offered_date)) $additional_data['offered_date']			 			= $offered_date;
			if(!empty($duration)) $additional_data['duration']			 					= $duration;

			if(!empty($year)) $additional_data['year']			 							= $year;

   	 		// echo "<pre>";
   	 		// echo $this->db->last_query();
   	 		// print_r($additional_data);
   	 		// die;

   	 		if ($type == 'save')
   	 		{
   	 			$result = $this->custom_model->my_insert($additional_data,"user_achievements");
			}
   	 		else if ($type == 'update')
   	 		{
   	 			$result = $this->custom_model->my_update($additional_data,array("id" => $id),"user_achievements");
   	 		}
   	 		else if ($type == 'delete')
   	 		{
   	 			$result = $this->custom_model->my_delete(array("id" => $id),"user_achievements");

   	 			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Delete Successfully') )); die;
   	 		}

   	 		$data = $this->custom_model->get_data_array("SELECT * FROM `user_achievements` WHERE `user_id` = '$user_id' order by `id` desc ");

   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Achievements add successfully') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}

	public function user_education()
	{
		$json = file_get_contents('php://input');
		
		// $json 		= '{"image":"d926c4f0bd2e66b34eddf33a20d62845.jpg","college_name":"MCOE Pune","concentration":"BBA","degree":"Engg","club_society":"Club","grade":"A","start_date":"2020/01/28","end_date":"2020/05/28","type":"save"}';

		// $json 		= '{"college_name":"MCOE  Pune","concentration":"BBA", "degree":"Engg","club_society":"Club","grade":"A", "start_date":"2020/01/28","end_date":"2020/05/28","type":"update","id":"1"}';

		// $json 		= '{"id":"1","type":"delete"}';

		
		$jsonobj 					= json_decode($json);
		$college_name 				= @$jsonobj->college_name;
		$concentration 				= @$jsonobj->concentration;
		$degree 					= @$jsonobj->degree;
		$club_society 				= @$jsonobj->club_society;
		$grade 						= @$jsonobj->grade;
		$start_date 				= @$jsonobj->start_date;
		$end_date 					= @$jsonobj->end_date;
		$image 						= @$jsonobj->image;

		$id 						= @$jsonobj->id;
		$type 						= @$jsonobj->type;


		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'user_education':$ws;
		$string 	= @$jsonobj->string;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		$data = $this->custom_model->get_data_array("SELECT id FROM  `user_education` WHERE `user_id` = '$user_id' ");

   	 		if (empty($data) && empty($college_name))
   	 		{
   	 			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'No user education found') )); die;
			}

   	 		$additional_data = array();

			if(!empty($user_id)) $additional_data['user_id'] 							= $user_id;
			if(!empty($image)) $additional_data['image'] 								= $image;
			if(!empty($college_name)) $additional_data['college_name']			 		= $college_name;
			if(!empty($concentration)) $additional_data['concentration']			 	= $concentration;
			if(!empty($degree)) $additional_data['degree']			 					= $degree;
			if(!empty($club_society)) $additional_data['club_society']			 		= $club_society;
			if(!empty($grade)) $additional_data['grade']			 					= $grade;
			if(!empty($start_date)) $additional_data['start_date']			 			= $start_date;
			if(!empty($end_date)) $additional_data['end_date']			 				= $end_date;


   	 		// echo "<pre>";
   	 		// echo $this->db->last_query();
   	 		// print_r($additional_data);
   	 		// die;

   	 		if ($type == 'save')
   	 		{
   	 			$result = $this->custom_model->my_insert($additional_data,"user_education");
			}
   	 		else if ($type == 'update')
   	 		{
   	 			$result = $this->custom_model->my_update($additional_data,array("id" => $id),"user_education");
   	 		}
   	 		else if ($type == 'delete')
   	 		{
   	 			$result = $this->custom_model->my_delete(array("id" => $id),"user_education");

   	 			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Delete Successfully') )); die;
   	 		}

   	 		$data = $this->custom_model->get_data_array("SELECT * FROM `user_education` WHERE `user_id` = '$user_id' order by `id` desc ");

   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Education add  Successfully') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}

	public function user_interest()
	{
		$json = file_get_contents('php://input');
		
		// $json 		= '{"interest_name":"Dancer,swimming","string":""}';
		// $json 		= '{"interest_name":"","string":"Dancer"}';

		
		$jsonobj 					= json_decode($json);
		$interest_name 				= @$jsonobj->interest_name;
		$search 					= @$jsonobj->search;


		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'user_interest':$ws;
		$string 	= @$jsonobj->string;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{

   	 		if (!empty($search))
   	 		{
   	 			$data = $this->custom_model->get_data_array("SELECT interest_name FROM user_interest WHERE `interest_name` LIKE '%$search%' order by id asc  LIMIT 5 ");
   	 			
   	 			if (!empty($data)) 
   	 			{
   	 				echo json_encode(array("status" => true ,"ws" => $ws  ,"data" => $data ,"message" => ($language == 'ar'? '':'Successfully') )); die;
   	 			}
   	 			else
   	 			{
   	 				echo json_encode(array("status" => true ,"data" => $data  ,"ws" => $ws ,"message" => ($language == 'ar'? '':'No user interest found') )); die;
   	 			}
			}


			if (empty($interest_name)) 
 			{
 				// $result = $this->custom_model->my_delete(array("user_id" => $user_id),"user_skills");
 				$data = $this->custom_model->get_data_array("SELECT id,interest_name FROM `user_interest` WHERE `user_id` = '$user_id' ");

   	 			echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Successfully') )); die;
 			}


 			$data_interest = explode (",", $interest_name);  


 			$additional_data = array();
 			
 			$result = $this->custom_model->my_delete(array("user_id" => $user_id),"user_interest");

 			foreach ($data_interest as $key => $value) 
 			{
 				if (!empty($value))
 				{
	 				if(!empty($user_id)) $additional_data['user_id'] 		= $user_id;
					if(!empty($value)) $additional_data['interest_name'] 	= $value;
	 				$result = $this->custom_model->my_insert($additional_data,"user_interest");
 				}
 			}   	

   	 		$data = $this->custom_model->get_data_array("SELECT id,interest_name FROM `user_interest` WHERE `user_id` = '$user_id' ");

   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Interest add successfully') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}


	public function user_social_profile()
	{
		$json = file_get_contents('php://input');
		
		// $json 		= '{"facebook":"facebook","instagram":"instagram","snapchat":"snapchat","twitter":"twitter","linkedIn":"linkedIn"}';

		
		$jsonobj 						= json_decode($json);
		$facebook 						= @$jsonobj->facebook;
		$instagram 						= @$jsonobj->instagram;
		$snapchat 						= @$jsonobj->snapchat;
		$twitter 						= @$jsonobj->twitter;
		$linkedIn 						= @$jsonobj->linkedIn;

		$language 						= @$jsonobj->language;
		$ws 							= @$jsonobj->ws;
		$language 						= empty($language)? 'en':$language;
		$ws 							= empty($ws)? 'user_social_profile':$ws;
		$string 						= @$jsonobj->string;

		$user_id = $this->validate_token_new($language ,$ws);
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		$data = $this->custom_model->get_data_array("SELECT id FROM  `user_social_profile` WHERE `user_id` = '$user_id' ");

   	 		if (empty($data) && empty($facebook))
   	 		{
   	 			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'No data found. ') )); die;
			}

   	 		// $data = $this->custom_model->get_data_array("SELECT * FROM  `users` WHERE `id` = '$user_id' ");

   	 		$additional_data = array();

			if(!empty($user_id)) $additional_data['user_id'] 								= $user_id;
			if(!empty($facebook)) $additional_data['facebook'] 								= $facebook;
			if(!empty($instagram)) $additional_data['instagram'] 							= $instagram;
			if(!empty($snapchat)) $additional_data['snapchat'] 								= $snapchat;
			if(!empty($twitter)) $additional_data['twitter'] 								= $twitter;
			if(!empty($linkedIn)) $additional_data['linkedIn'] 								= $linkedIn;

   	 		// echo "<pre>";
   	 		// echo $this->db->last_query();
   	 		// print_r($additional_data);
   	 		// die;

   	 		if (empty($data))
   	 		{
   	 			$result = $this->custom_model->my_insert($additional_data,"user_social_profile");
			}
   	 		else 
   	 		{
   	 			$result = $this->custom_model->my_update($additional_data,array("user_id" => $user_id),"user_social_profile");
   	 		}
   	 		

   	 		$data = $this->custom_model->get_data_array("SELECT * FROM `user_social_profile` WHERE `user_id` = '$user_id' ");

   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data[0] ,"message" => ($language == 'ar'? '':'Social updated successfully') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}


	public function profile_update()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"full_name":"Girish Bhumkar","email":"girishbhumkar5@gmail.com","designation":"PHP Developer", "organisation":"Persausive Technology","profile_image":"f46bb8867f9d456a96e8e4a925e2617d.jpeg","phone":"8149169115","profile_banner_image":"7079c04762faf0a567aba72911e55a9b.jpeg"}';

		
		$jsonobj 					= json_decode($json);

		$first_name 		= @$jsonobj->full_name;
		// $last_name 		= @$jsonobj->last_name;
		$email 				= @$jsonobj->email;
		$designation 		= @$jsonobj->designation;
		$organisation 		= @$jsonobj->organisation;
		$profile_image 		= @$jsonobj->profile_image;
		$phone 				= @$jsonobj->phone;
		$profile_banner_image 				= @$jsonobj->profile_banner_image;

		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'profile_update':$ws;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		$already = $this->custom_model->get_data_array("SELECT username FROM  `users` WHERE `id` != '$user_id' AND `username` = '$first_name' ");
   	 		if ($already) 
   	 		{
   	 			echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Username already available so please change .') )); die;
   	 		}

   	 		if (!empty($phone)) 
   	 		{
	   	 		$already_phone = $this->custom_model->get_data_array("SELECT phone FROM  `users` WHERE `id` != '$user_id' AND `phone` = '$phone' ");
	   	 		if ($already) 
	   	 		{
	   	 			echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Phone already available so please change .') )); die;
	   	 		}
   	 		}


   	 		// echo "<pre>";
   	 		// echo $this->db->last_query();
   	 		// print_r($data);
   	 		// die;

   	 		$additional_data = array();

			if(!empty($phone)) $additional_data['phone'] 					= $phone;
			if(!empty($first_name)) $additional_data['username'] 			= $first_name;
			if(!empty($email)) $additional_data['university_school_email'] 	= $email;
			if(!empty($designation)) $additional_data['designation'] 		= $designation;
			if(!empty($organisation)) $additional_data['organisation'] 		= $organisation;
			if(!empty($profile_image)) $additional_data['profile_image'] 	= $profile_image;
			if(!empty($profile_banner_image)) $additional_data['profile_banner_image'] 	= $profile_banner_image;

   	 		$result = $this->custom_model->my_update($additional_data,array("id" => $user_id),"users");

   	 		$data = $this->custom_model->get_data_array("SELECT id,university_school_email,username,profile_image,user_type,personal_mission,personal_description,profile_banner_image,phone FROM  `users` WHERE `id` = '$user_id' ");

   	 		$data[0]['profile_logo'] 			= $data[0]['profile_image'];
   	 		$data[0]['profile_image']			= $this->get_profile_path($data[0]['profile_image']);
   	 		$data[0]['profile_banner_image']	= $this->get_profile_path($data[0]['profile_banner_image']);

   	 		$user_type = $data[0]['user_type'];

   	 		if ($user_type == 0) 
   	 		{
   	 			$data[0]['user_type'] = 'Student';
   	 		}
   	 		else if ($user_type == 1) 
   	 		{
   	 			$data[0]['user_type'] = 'Facility';
   	 		}
   	 		else if ($user_type == 2) 
   	 		{
   	 			$data[0]['user_type'] = 'Teacher';
   	 		}

   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data[0] ,"message" => ($language == 'ar'? '':'Profile update successfully') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}

	public function personal_mission_update()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"personal_mission":"Personal Mission Statemant","personal_description":"Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book","profile_banner_image":"f46bb8867f9d456a96e8e4a925e2617d.jpeg"}';
		
		$jsonobj 					= json_decode($json);
		$personal_mission 			= @$jsonobj->personal_mission;
		$personal_description 		= @$jsonobj->personal_description;
		$profile_banner_image 		= @$jsonobj->profile_banner_image;


		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'personal_mission_update':$ws;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		$additional_data = array();

   	 		if(!empty($personal_mission)) $additional_data['personal_mission'] 				= $personal_mission;
   	 		if(!empty($personal_description)) $additional_data['personal_description'] 		= $personal_description;
   	 		if(!empty($profile_banner_image)) $additional_data['profile_banner_image'] 		= $profile_banner_image;


			// $additional_data['personal_mission'] 			= $personal_mission;
			// $additional_data['personal_description']		= $personal_description;
			// $additional_data['profile_banner_image'] 		= $profile_banner_image;

   	 		$result = $this->custom_model->my_update($additional_data,array("id" => $user_id),"users");

   	 		$data = $this->custom_model->get_data_array("SELECT id,university_school_email,username,profile_image,user_type,personal_mission,personal_description,profile_banner_image FROM  `users` WHERE `id` = '$user_id' ");

   	 		$data[0]['profile_logo'] 			= $data[0]['profile_image'];
   	 		$data[0]['profile_image']			= $this->get_profile_path($data[0]['profile_image']);
   	 		$data[0]['profile_banner_image']	= $this->get_profile_path($data[0]['profile_banner_image']);

   	 		$user_type = $data[0]['user_type'];

   	 		if ($user_type == 0) 
   	 		{
   	 			$data[0]['user_type'] = 'Student';
   	 		}
   	 		else if ($user_type == 1) 
   	 		{
   	 			$data[0]['user_type'] = 'Facility';
   	 		}
   	 		else if ($user_type == 2) 
   	 		{
   	 			$data[0]['user_type'] = 'Teacher';
   	 		}

   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data[0] ,"message" => ($language == 'ar'? '':'Profile update successfully') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}


	public function get_all_profile_data()
	{
		$json = file_get_contents('php://input');

		// $json 		= '';
		
		$jsonobj 			= json_decode($json);

		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'profile_update':$ws;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		$data = $this->custom_model->get_data_array("SELECT id,university_school_email,username,profile_image,user_type,university_school_id,designation,organisation,personal_mission,personal_description,profile_banner_image FROM  `users` WHERE `id` = '$user_id' ");
   	 		$university_school_id = $data[0]['university_school_id'];
   	 		$username = $data[0]['username'];

   	 		$username = str_replace(" ",".",strtolower($username));

   	 		$data[0]['unilife_user_name'] = 'https://unilifeapp.com/'.$username.'.'.$user_id;

   	 		// echo "<pre>";
   	 		// print_r($unilife_name);
   	 		// die;

   	 		$data[0]['profile_banner_image']	= $this->get_profile_path($data[0]['profile_banner_image']);


   	 		$uni = $this->custom_model->get_data_array("SELECT * FROM  `university_schools` WHERE `id` = '$university_school_id' ");
   	 		if ($uni) 
   	 		{
   	 			$data[0]['university_schools_name'] = $uni[0]['name'];
   	 		}
   	 		else
   	 		{
   	 			$data[0]['university_schools_name'] = '';
   	 		}

   	 		$data[0]['profile_logo'] 	= $data[0]['profile_image'];
   	 		$data[0]['profile_image'] 	= $this->get_profile_path($data[0]['profile_image']);
   	 		$user_type = $data[0]['user_type'];

   	 		if ($user_type == 0) 
   	 		{
   	 			$data[0]['user_type'] = 'Student';
   	 		}
   	 		else if ($user_type == 1) 
   	 		{
   	 			$data[0]['user_type'] = 'Facility';
   	 		}
   	 		else if ($user_type == 2) 
   	 		{
   	 			$data[0]['user_type'] = 'Teacher';
   	 		}

   	 		$respoonse['user_highlights'] = $this->custom_model->get_data_array("SELECT * FROM  `user_highlights` WHERE `user_id` = '$user_id' ORDER BY `id` desc ");


   	 		$respoonse['user_experience'] = $this->custom_model->get_data_array("SELECT * FROM  `user_experience` WHERE `user_id` = '$user_id' ORDER BY `id` desc ");

   	 		if (!empty($respoonse['user_experience'])) 
   	 		{
   	 			foreach ($respoonse['user_experience'] as $key => $value) 
   	 			{
   	 				$respoonse['user_experience'][$key]['image'] = $this->get_profile_path($value['image']);
   	 			}
   	 		}
   	 		
   	 		$respoonse['user_education'] = $this->custom_model->get_data_array("SELECT * FROM  `user_education` WHERE `user_id` = '$user_id' ORDER BY `id` desc ");
   	 		if (!empty($respoonse['user_education'])) 
   	 		{
   	 			foreach ($respoonse['user_education'] as $ekey => $evalue) 
   	 			{
   	 				$respoonse['user_education'][$ekey]['image'] = $this->get_profile_path($evalue['image']);
   	 			}
   	 		}


   	 		$respoonse['user_skills'] = $this->custom_model->get_data_array("SELECT * FROM  `user_skills` WHERE `user_id` = '$user_id' ");

   	 		$respoonse['user_languages'] = $this->custom_model->get_data_array("SELECT * FROM  `user_languages` WHERE `user_id` = '$user_id' ");

   	 		$respoonse['user_achievements'] = $this->custom_model->get_data_array("SELECT * FROM  `user_achievements` WHERE `user_id` = '$user_id' ");

   	 		$respoonse['user_interest'] = $this->custom_model->get_data_array("SELECT * FROM  `user_interest` WHERE `user_id` = '$user_id' ");

   	 		$respoonse['user_social_profile'] = $this->custom_model->get_data_array("SELECT * FROM  `user_social_profile` WHERE `user_id` = '$user_id' ");
   	 		
   	 		$respoonse['user_course'] = $this->custom_model->get_data_array("SELECT * FROM  `user_course` WHERE `user_id` = '$user_id' ");



   	 		echo json_encode(array("status" => true ,"ws" => $ws , "respoonse" => $respoonse ,"self_intoduction" => $data[0] ,"message" => ($language == 'ar'? '':'Successfully') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}


	public function create_poll()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"question":"Lorem Ipsum is simply dummy text ?", "group_id" :"" , "options":{"1":"Yes","2":"No"}}';
		
		$jsonobj 		= json_decode($json);

		$group_id 		= @$jsonobj->group_id;

		$question 		= @$jsonobj->question;
		$options 		= @$jsonobj->options;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'create_poll':$ws;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		
   	 		if (!empty($group_id))
   	 		{
   	 			$group = $this->check_group_available_not($user_id,$group_id);
   	 			$post_through_group = 'yes';
   	 		}
   	 		else
   	 		{
   	 			$post_through_group = 'no';
   	 		}
   	 		
   	 		if (empty($options)) 
   	 		{
   	 			echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
   	 		}

   	 		$logged_in = $this->custom_model->my_where('users','university_school_id',array('id'=>$user_id),array(),"","","","", array(), "",array(),false );

			// echo "<pre>";
			// print_r($question);
			// print_r($options);
			// die;

			$university_school_id = $logged_in[0]['university_school_id'];

			$additional_data = array();

			if(!empty($group_id)) $additional_data['group_id'] 								= $group_id;
			if(!empty($post_through_group)) $additional_data['post_through_group'] 			= $post_through_group;


			if(!empty($user_id)) $additional_data['user_id'] 								= $user_id;
			if(!empty($question)) $additional_data['question'] 								= $question;
			if(!empty($university_school_id)) $additional_data['university_post_id'] 		= $university_school_id;
			// $additional_data['location_name'] 												= 'poll';
			$additional_data['type'] 														= 'poll';

			$post_id = $this->custom_model->my_insert($additional_data,"posts");

			if (!empty($options)) 
			{
				$add_data = array();
				foreach ($options as $key => $value) 
				{
					if(!empty($user_id)) $add_data['user_id'] 			= $user_id;
					$add_data['options'] 								= $value;
					$add_data['post_id'] 								= $post_id;

					$this->custom_model->my_insert($add_data,"posts_options");
				}
			}

			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Post added successfully') )); die;


   	 	}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}

	public function create_event()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"event_title":"Lorem Ipsum is simply " , "event_link":"asd" ,"event_description":"asd" ,"event_images":"asd" , "group_id" :""}';
		
		$jsonobj 				= json_decode($json);
		$event_title 			= @$jsonobj->event_title;
		$event_link 			= @$jsonobj->event_link;
		$event_description 		= @$jsonobj->event_description;
		$event_images 			= @$jsonobj->event_images;
		$group_id 				= @$jsonobj->group_id;

		$language 				= @$jsonobj->language;
		$ws 					= @$jsonobj->ws;
		$language 				= empty($language)? 'en':$language;
		$ws 					= empty($ws)? 'create_event':$ws;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		
   	 		if (!empty($group_id))
   	 		{
   	 			$group = $this->check_group_available_not($user_id,$group_id);
   	 			$post_through_group = 'yes';
   	 		}
   	 		else
   	 		{
   	 			$post_through_group = 'no';
   	 		}

   	 		$logged_in = $this->custom_model->my_where('users','university_school_id',array('id'=>$user_id),array(),"","","","", array(), "",array(),false );

			// echo "<pre>";
			// print_r($question);
			// print_r($options);
			// die;

			$university_school_id = $logged_in[0]['university_school_id'];

			$additional_data = array();

			if(!empty($event_title)) $additional_data['event_title'] 						= $event_title;
			if(!empty($event_link)) $additional_data['event_link'] 							= $event_link;
			if(!empty($event_description)) $additional_data['event_description'] 			= $event_description;

			if(!empty($group_id)) $additional_data['group_id'] 								= $group_id;
			if(!empty($post_through_group)) $additional_data['post_through_group'] 			= $post_through_group;


			if(!empty($user_id)) $additional_data['user_id'] 								= $user_id;
			if(!empty($question)) $additional_data['question'] 								= $question;
			if(!empty($university_school_id)) $additional_data['university_post_id'] 		= $university_school_id;
			// $additional_data['location_name'] 												= 'event';
			$additional_data['type'] 														= 'event';

			$post_id = $this->custom_model->my_insert($additional_data,"posts");

			if (!empty($event_images)) 
			{
				$lists = explode(',', $event_images); 

				// echo "<pre>";
				// print_r($lists);
				// die;

				foreach ($lists as $key => $value) 
				{
					// if(!empty($user_id)) $add_data['user_id'] 			= $user_id;
					$add_data['attachment'] 								= $value;
					$add_data['post_id'] 								= $post_id;
					$add_data['attachment_type'] 						= 'image';
					$this->custom_model->my_insert($add_data,"post_attachments");
				}
			}

			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Post added successfully') )); die;
   	 	}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuestcd') )); die;
 		}
	}

	public function check_group_available_not($user_id = '',$group_id = '')
	{
		$data = $this->custom_model->my_where('groups','id',array('id'=>$group_id),array(),"","","","", array(), "",array(),false );

		if (!empty($data)) 
		{
			$check = $this->custom_model->my_where('group_users','id',array('group_id'=>$group_id,"user_id" => $user_id),array(),"","","","", array(), "",array(),false );
			if (empty($check)) 
			{
				echo json_encode(array("status" => false  ,"message" =>"Invalid group selection" )); die;
			}
		}
		else
		{
			echo json_encode(array("status" => false  ,"message" =>"Invalid group selection" )); die;
		}
	}

	public function home_data()
	{
		$json = file_get_contents('php://input');

		// $json 		= '';
		
		$jsonobj 			= json_decode($json);

		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'home_data':$ws;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://15.206.103.14:3006/show_post/".$user_id,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "Content-Type: application/json",
			    "Cookie: ci_session_admin=2svvhaigi5rfrnr63bn9bjben5bf4q2m"
			  ),
			));

			$response = curl_exec($curl);

			curl_close($curl);

			$json = json_decode($response, true);
			
			// echo "<pre>";
			// print_r($json);
			// die;
			// echo "<pre>";

			if ($json['response'] == '1') 
			{
				$data = $json['data'];

				foreach ($data as $key => $value) 
				{
					$type = @$value['location_name'];
					if ($type == 'poll')
					{
						// $data[$key]['post_options'] = $this->custom_model->my_where('posts_options','id,options',array('post_id'=>$value['id']) );

						$selected_opt = $this->custom_model->my_where('posts_options','id,options',array('post_id'=>$value['id']) );
						if (!empty($selected_opt))
						{
							foreach ($selected_opt as $okey => $ovalue) 
							{
								$op_id = $ovalue['id'];
								$option = $this->custom_model->my_where('post_options_select_by_user','*',array('post_id'=>$value['id'],"user_id"=> $user_id,"option_id"=> $op_id) );
								if ($option) 
								{
									$selected_opt[$okey]['selected'] = 'yes';
								}
								else
								{
									$selected_opt[$okey]['selected'] = 'no';									
								}
								$selected_opt[$okey]['post_id'] = $value['id'];
							}
							$data[$key]['post_options'] = $selected_opt;
						}

						$event = $this->custom_model->my_where('posts','event_title,event_link,event_description,type',array('id'=>$value['id']) );
						if (!empty($event))
						{
							$data[$key]['type'] 				= $event[0]['type'];
						}

						// print_r($value);
					}
					if ($type == 'event')
					{
						// $data[$key]['post_options'] = $this->custom_model->my_where('posts_options','id,options',array('post_id'=>$value['id']) );

						$event = $this->custom_model->my_where('posts','event_title,event_link,event_description,type',array('id'=>$value['id']) );
						if (!empty($event))
						{
							$data[$key]['type'] 				= $event[0]['type'];
							$data[$key]['event_title'] 			= $event[0]['event_title'];
							$data[$key]['event_link'] 			= $event[0]['event_link'];
							$data[$key]['event_description'] 	= $event[0]['event_description'];
						}
						// print_r($value);
					}
					if ($type == 'normal')
					{
						$data[$key]['type'] 				= 'normal';
					}
					if ($type == 'opinion')
					{
						$data[$key]['type'] 				= 'opinion';
					}
				}
				

			
				$check = $this->custom_model->my_where('group_users','group_id',array("user_id" => $user_id),array(),"","","","", array(), "",array(),false );
				if (!empty($check)) 
				{
					foreach ($check as $gkey => $gvalue) 
					{
						$group_id = $gvalue['group_id'];
						$group = $this->custom_model->my_where('groups','group_name',array('id'=>$group_id),array(),"","","","", array(), "",array(),false );

						if (!empty($group)) 
						{
							$check[$gkey]['group_name'] = $group[0]['group_name'];
						}
					}
				}

				echo json_encode(array("status" => true,"data"=> $data,"group"=> $check ,"ws" => $ws ,"message" => ($language == 'ar'? '':'successfully') )); die;

				// print_r($data);
				// die;

			}
			else
			{
				echo $response ; 
			}
			
   	 	}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}



	public function is_in_wish_list_parent($user_id , $post_id)
   	{
   		$dataa = $this->custom_model->get_data_array("SELECT id,user_id,created_at,post_comment_id FROM  `post_comment_likes` WHERE `post_comment_id` = '$post_id' AND `user_id` = '$user_id'  AND `type` = 'P' ");  
		
   		if ($dataa) 
   		{
   			$data = true;
   		}
   		else
   		{
   			$data = false;
   		}

		return $data;
   	}

   	public function is_report_post($user_id , $post_id)
   	{
   		$dataa = $this->custom_model->get_data_array("SELECT id FROM  `report_user_post` WHERE `user_id` = '$user_id' AND `report_post_id` = '$post_id'  AND `report_user_id` = '0' ");  
		
   		if ($dataa) 
   		{
   			$data = true;
   		}
   		else
   		{
   			$data = false;
   		}

		return $data;
   	}



   	public function is_in_wish_list_child($user_id , $post_id)
   	{
   		$dataa = $this->custom_model->get_data_array("SELECT id,user_id,created_at,post_comment_id FROM  `post_comment_likes` WHERE `post_comment_id` = '$post_id' AND `user_id` = '$user_id' AND `type` = 'C' ");  
		
		// echo $this->db->last_query(); die;
   		if ($dataa) 
   		{
   			$data = true;
   		}
   		else
   		{
   			$data = false;
   		}

		return $data;
   	}

   	public function is_in_wish_list_child_reply($user_id , $post_id)
   	{
   		$dataa = $this->custom_model->get_data_array("SELECT id,user_id,created_at,post_comment_id FROM  `post_comment_likes` WHERE `post_comment_id` = '$post_id' AND `user_id` = '$user_id' AND `type` = 'R' ");  
		
		// echo $this->db->last_query(); die;
   		if ($dataa) 
   		{
   			$data = true;
   		}
   		else
   		{
   			$data = false;
   		}

		return $data;
   	}

	public function homepage_data()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"pagination":"1","source":"android","version" :"2"}';
		
		$jsonobj 			= json_decode($json);

		$source 		= @$jsonobj->source;
		$version 		= @$jsonobj->version;
		$language 		= @$jsonobj->language;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'homepage_data':$ws;
		$pagination = @$jsonobj->pagination;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

		// $array1 = array("a" => "616", "625" );
		// $array2 = array("b" => "625", "1");
		// $result = array_diff($array1, $array2);

		// print_r($result);


		// die;


   	 	if (!empty($user_id))
   	 	{
   	 		$this->check_version($user_id , $source , $version);

   	 		$data = array();

	        if (empty($pagination))
			{
				echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? '':'Add pagination') ) );die;
			}

			if(empty($pagination)) $pagination = 1;
			$limit = 15;
			$pagination = $limit * ( $pagination - 1);



   	 		$university = $this->custom_model->get_data_array("SELECT university_school_id FROM users WHERE `id` = '$user_id'  ORDER BY `id` DESC ");

   	 		if (!empty($user_id)) 
   	 		{
   	 			$up_id = $university[0]['university_school_id'];
   	 			$f_list = $user_id;

   	 			$friends = $this->custom_model->get_data_array("SELECT friend_id FROM friend_lists WHERE `user_id` = '$user_id'  ORDER BY `id` DESC ");
   	 			// if (!empty($friends))
   	 			// {
   	 			// 	$comma_string = array();
   	 			// 	foreach ($friends as $key => $value) 
   	 			// 	{
   	 			// 		$comma_string[] = $value['friend_id'];
   	 			// 	}

   	 			// 	$comma_separated = implode(",", $comma_string);
   	 			// 	$f_list = $comma_separated.','.$user_id;
   	 			// }


   	 			$same_domain = $this->custom_model->get_data_array("SELECT id FROM users WHERE `university_school_id` = '$up_id'  ORDER BY `id` DESC ");
   	 			if (!empty($same_domain))
   	 			{
   	 				$comma_string = array();
   	 				foreach ($same_domain as $key => $value) 
   	 				{
   	 					$comma_string[] = $value['id'];
   	 				}

   	 				$comma_separated = implode(",", $comma_string);
   	 				$f_list = $comma_separated.','.$user_id;
   	 			}
   	 			
   	 			
   	 			/*$report_user = $this->custom_model->get_data_array("SELECT report_user_id FROM report_user_post WHERE `user_id` = '$user_id' AND `report_post_id` = '0'  ORDER BY `id` DESC ");

   	 			if (!empty($report_user))
   	 			{
   	 				$comma_report_user = array();
   	 				foreach ($report_user as $skey => $dvalue) 
   	 				{
   	 					$comma_report_user[] = $dvalue['report_user_id'];
   	 				}

   	 				$comma_sepa_report_user = implode(",", $comma_report_user);
   	 				$r_list = $comma_sepa_report_user;

   	 				// Combine kele 2 array same removed kele parat tyala comma seprate kele
   	 				$e_list = array_diff($comma_string, $comma_report_user);
   	 				$f_list = implode(",", $e_list);
   	 			}*/


				// print_r($result);
				// print_r($array);



   	 			// echo "<pre>";
   	 			// print_r($f_list);
   	 			// echo ">>>";
   	 			// print_r($r_list);
   	 			// die;

   	 			// $data = $this->custom_model->get_data_array("SELECT id,admin_id,user_id,university_post_id,caption,location_name,post_through_group,group_id,status,type,question,event_title,event_link,event_description FROM posts WHERE `user_id` = '$user_id' AND `user_id` IN ($f_list) AND `type` != '' OR (`admin_id` = '1' AND `university_post_id` = $up_id) ORDER BY `id` DESC LIMIT $pagination,$limit ");

   	 			// $data = $this->custom_model->get_data_array("SELECT id,admin_id,user_id,university_post_id,caption,location_name,post_through_group,group_id,status,type,question,event_title,event_link,event_description,created_at FROM posts WHERE `user_id` = '$user_id' AND `user_id` IN ($f_list) AND `type` != '' ORDER BY `id` DESC LIMIT $pagination,$limit ");

   	 			$data = $this->custom_model->get_data_array("SELECT id,admin_id,user_id,university_post_id,caption,location_name,post_through_group,group_id,status,type,question,event_title,event_link,event_description,created_at FROM posts WHERE  `user_id` IN ($f_list) AND `type` != '' OR (`admin_id` = '1' AND `university_post_id` = '$up_id' AND `type` != '' )  ORDER BY `id` DESC LIMIT $pagination,$limit ");


				// echo $this->db->last_query();
				// echo "<pre>";
				// print_r($data);
				// die;			

   	 			if (!empty($data)) 
   	 			{
   	 				foreach ($data as $gkey => $gvalue) 
   	 				{
   	 					$post_uid = $gvalue['user_id'];

   	 					// user own data 
   	 					$get_udata = $this->get_user_data($post_uid);
   	 					if (!empty($get_udata)) 
   	 					{
   	 						$data[$gkey]['user_uploading_post'] = $get_udata;
   	 					}
   	 					else
   	 					{
   	 						$get_udata = array();
   	 						$data[$gkey]['user_uploading_post'] = $get_udata;   	 						
   	 					}
   	 					
   	 					// echo "<pre>";
   	 					// print_r($get_udata);
   	 					// die;

   	 					$post_id = $gvalue['id'];

   	 					$is_in_wish_list 	= $this->is_in_wish_list_parent($user_id,$post_id);
   	 					$data[$gkey]['is_like'] = $is_in_wish_list;

   	 					$is_report_post 				= $this->is_report_post($user_id,$post_id);
   	 					$data[$gkey]['is_report_post'] 	= $is_report_post;


   	 					$type = $gvalue['type'];
						if ($type == 'poll')
						{
							$selected_opt = $this->custom_model->my_where('posts_options','id,options',array('post_id'=>$gvalue['id']) );
							if (!empty($selected_opt))
							{
								foreach ($selected_opt as $okey => $ovalue) 
								{
									$op_id = $ovalue['id'];
									$option = $this->custom_model->my_where('post_options_select_by_user','*',array('post_id'=>$gvalue['id'],"user_id"=> $user_id,"option_id"=> $op_id) );
									if ($option) 
									{
										$selected_opt[$okey]['selected'] = 'yes';
									}
									else
									{
										$selected_opt[$okey]['selected'] = 'no';									
									}

									$option_a = $this->custom_model->my_where('post_options_select_by_user','*',array('post_id'=>$gvalue['id'],"option_id"=> $op_id) );

									if ($option_a) 
									{
										$selected_opt[$okey]['selected_count'] = count($option_a);
									}
									else
									{
										$selected_opt[$okey]['selected_count'] = 0;									
									}
								
									$selected_opt[$okey]['post_id'] = $gvalue['id'];
								}
								$data[$gkey]['post_options'] = $selected_opt;
							}
						}

						if ($type == 'event')
						{
							$ava = 'no';
							$e_id = $gvalue['id'];
	   	 					$reg_link_count = $this->custom_model->get_data_array("SELECT count,user_id FROM event_link_user_list WHERE `event_id` = '$e_id' ; ");
	   	 					if ($reg_link_count) 
	   	 					{
	   	 						$HiddenProducts = explode(',',$reg_link_count[0]['user_id']);
								if (in_array($user_id, $HiddenProducts)) 
								{
								  $ava = 'yes';
								}
	   	 						$data[$gkey]['event_register_count'] = $reg_link_count[0]['count'];
	   	 					}
	   	 					else
	   	 					{
	   	 						$data[$gkey]['event_register_count'] = "0";
	   	 					}

	   	 					$data[$gkey]['already_hit_button'] = $ava;


						}

   	 					$attachments = $this->custom_model->get_data_array("SELECT id,attachment_type,attachment,thumbnail FROM post_attachments WHERE `post_id` = '$post_id'  ORDER BY `id` DESC ");
   	 					if (!empty($attachments))
		   	 			{
		   	 				foreach ($attachments as $aakey => $aavalue) 
		   	 				{
		   	 					$att = $aavalue['attachment'];
		   	 					$attachments[$aakey]['attachment']	= $this->get_attachment_image($att);
		   	 				}
		   	 			}


   	 					$data[$gkey]['post_attachments'] = $attachments;


   	 					$comments = $this->custom_model->get_data_array("SELECT id FROM comments WHERE `post_id` = '$post_id'  ORDER BY `id` DESC ");
   	 	   	 			$data[$gkey]['post_comments_count'] = count($comments);


   	 					$likes = $this->custom_model->get_data_array("SELECT id FROM  `post_comment_likes` WHERE `post_comment_id` = '$post_id' AND `type` = 'p' ");  
   	 					$data[$gkey]['post_like_count'] = count($likes);


   	 				}
   	 			}		   	

   	 		}

   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Successfully') )); die;

			// echo $this->db->last_query();
			// echo "<pre>";
			// print_r($data);
			// die;			
   	 	}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}

	public function event_link_counter_hit()
	{
		$json = file_get_contents('php://input');

		// $json 				= '{"event_id":"1"}';
		$jsonobj 				= json_decode($json);
		$event_id 				= @$jsonobj->event_id;
		$language 				= @$jsonobj->language;
		$ws 					= @$jsonobj->ws;
		$language 				= empty($language)? 'en':$language;
		$ws 					= empty($ws)? 'event_link_counter_hit':$ws;
		$user_id = $this->validate_token_new();

		if (!empty($user_id) && !empty($event_id))
		{
			$old_users = $this->custom_model->get_data_array("SELECT user_id,count FROM event_link_user_list WHERE `event_id` = '$event_id' ");
			
			if ($old_users) 
			{
				$count = $old_users[0]['count'];
				$u_id = $old_users[0]['user_id'];
				$myArray = explode(',', $u_id);
				$new_count = $count + 1;

				if (!in_array($user_id, $myArray)) 
				{
					$u_id = $old_users[0]['user_id'].','.$user_id;
					$additional_data['user_id'] = $u_id;
				}

				$additional_data['count'] 	= $new_count;
				$result = $this->custom_model->my_update($additional_data,array("event_id" => $event_id),"event_link_user_list");
			}
			else
			{
				$additional_data['count'] 	= 1 ;
				$additional_data['user_id'] = $user_id;
				$additional_data['event_id'] = $event_id;
				$result = $this->custom_model->my_insert($additional_data,"event_link_user_list");
			}

			echo json_encode( array("status" => true,"message" => ($language == 'ar'? "":'Successfully.' ) , "ws" => $ws ) );die;

		}

		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
		
   	}


	public function select_poll_option()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"option_id":"1"}';
		
		$jsonobj 		= json_decode($json);

		$option_id 		= @$jsonobj->option_id;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'select_poll_option':$ws;

		$user_id = $this->validate_token_new();

		if($user_id)
	    {	    	
	    	if (!empty($option_id))
   	 		{
			    $data = $this->custom_model->get_data_array("SELECT post_id FROM  `posts_options` WHERE `id` = '$option_id' ");
	   	 		if ($data) 
	   	 		{
	   	 			$additional_data = array();
	   	 			$post_id = $data[0]['post_id'];

					if(!empty($user_id)) $additional_data['user_id'] 				= $user_id;
					if(!empty($post_id)) $additional_data['post_id'] 				= $post_id;
					if(!empty($option_id)) $additional_data['option_id'] 			= $option_id;

	   	 			$op_data = $this->custom_model->get_data_array("SELECT option_id FROM  `post_options_select_by_user` WHERE `post_id` = '$post_id' AND `user_id` = '$user_id'  ");

	   	 			// echo "<pre>";
	   	 			// print_r($op_data);
	   	 			// die;

	   	 			if ($op_data) 
		   	 		{
		   	 			$result = $this->custom_model->my_update($additional_data,array("user_id" => $user_id),"post_options_select_by_user");
		   	 		}
		   	 		else
		   	 		{
		   	 			$result = $this->custom_model->my_insert($additional_data,"post_options_select_by_user");
		   	 		}

		   	 		echo json_encode( array("status" => true,"message" => ($language == 'ar'? "":'Option selected successfully.' ) , "ws" => $ws ) );die;

	   	 		}
	   	 		else
	   	 		{
	   	 			echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ),"ws" => $ws ) );die;
	   	 		}
   	 		}
   	 		else
   	 		{
   	 			echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ) , "ws" => $ws ) );die;
   	 		}
   	 	}

   	 	echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ),"ws" => $ws ) );die;
	}


	public function report_post()
	{
		$json = file_get_contents('php://input');

		// $json 				= '{"report_post_id":"1","type":"Spam","reason":"Invalid post are there"}';
		$jsonobj 				= json_decode($json);
		$report_post_id 		= @$jsonobj->report_post_id;
		$type 					= @$jsonobj->type;
		$reason 				= @$jsonobj->reason;
		$language 				= @$jsonobj->language;
		$ws 					= @$jsonobj->ws;
		$language 				= empty($language)? 'en':$language;
		$ws 					= empty($ws)? 'report_post':$ws;

		$user_id = $this->validate_token_new();

		if($user_id)
	    {
   	 			$data = $this->custom_model->get_data_array("SELECT id,user_id,type FROM  `posts` WHERE  `id` = '$report_post_id' ");

   	 			if (empty($user_id)) 
   	 			{
   	 				echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid post id request.' ),"ws" => $ws ) );die;
   	 			}

   	 			if ($data[0]['user_id'] == $user_id) 
   	 			{
   	 				echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'You can not report by your self .' ),"ws" => $ws ) );die;
   	 			}

			    $data = $this->custom_model->get_data_array("SELECT * FROM  `report_user_post` WHERE  `report_post_id` = '$report_post_id' AND `user_id` = '$user_id' ");

			    if (empty($data)) 
			    {
				    $additional_data = array();
					if(!empty($user_id)) $additional_data['user_id'] 					= $user_id;
					if(!empty($report_post_id)) $additional_data['report_post_id'] 		= $report_post_id;
					if(!empty($type)) $additional_data['type'] 							= $type;
					if(!empty($reason)) $additional_data['reason'] 						= $reason;


				    $result = $this->custom_model->my_insert($additional_data,"report_user_post");

				    echo json_encode( array("status" => true,"message" => ($language == 'ar'? '':'Thanks for letting us know , Your feedback is important in helping us keep the unilife community safe.' ) , "ws" => $ws ) );die;
			    }
			    else
			    {
			    	echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'You already reported this post so cant add again.' ) , "ws" => $ws ) );die;
			    }
   	 	}

   	 	echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ),"ws" => $ws ) );die;
	}

	public function delete_post()
	{
		$json = file_get_contents('php://input');

		// $json 				= '{"post_id":"1"}';
		$jsonobj 				= json_decode($json);
		$post_id 				= @$jsonobj->post_id;
		$language 				= @$jsonobj->language;
		$ws 					= @$jsonobj->ws;
		$language 				= empty($language)? 'en':$language;
		$ws 					= empty($ws)? 'delete_post':$ws;

		$user_id = $this->validate_token_new();

		if($user_id)
	    {	    	
		    $data = $this->custom_model->get_data_array("SELECT id,user_id,type FROM  `posts` WHERE  `id` = '$post_id' ");

		    if (!empty($data)) 
		    {
		    	$type = $data[0]['type'];
		    	$post_user_id = $data[0]['user_id'];

		    	if ($post_user_id != $user_id) 
		    	{
		    		echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'This post is not yours so u cant delete this post .' ),"ws" => $ws ) );die;
		    	}

				$result = $this->custom_model->my_delete(array("id" => $post_id),"posts");
				$result = $this->custom_model->my_delete(array("post_id" => $post_id),"posts_options");
				$result = $this->custom_model->my_delete(array("post_id" => $post_id),"post_attachments");
				$result = $this->custom_model->my_delete(array("post_id" => $post_id),"post_options_select_by_user");
				$result = $this->custom_model->my_delete(array("post_id" => $post_id),"post_tag_groups");
				$result = $this->custom_model->my_delete(array("post_id" => $post_id),"post_tag_users");
				$result = $this->custom_model->my_delete(array("post_id" => $post_id),"comments");

			    echo json_encode( array("status" => true,"message" => ($language == 'ar'? '':'Post deleted successfully. ' ) , "ws" => $ws ) );die;
		    }
		    else
		    {
		    	echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid delete request ' ) , "ws" => $ws ) );die;
		    }
   	 	}

   	 	echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ),"ws" => $ws ) );die;
	}

	public function report_user()
	{
		$json = file_get_contents('php://input');

		// $json 				= '{"report_user_id":"1","type":"Spam","reason":"Invalid post are there"}';
		$jsonobj 				= json_decode($json);
		$report_user_id 		= @$jsonobj->report_user_id;
		$type 					= @$jsonobj->type;
		$reason 				= @$jsonobj->reason;
		$language 				= @$jsonobj->language;
		$ws 					= @$jsonobj->ws;
		$language 				= empty($language)? 'en':$language;
		$ws 					= empty($ws)? 'report_user':$ws;

		$user_id = $this->validate_token_new();

		if($user_id)
	    {	    	
	    	if ($report_user_id != $user_id)
   	 		{
			    $check_re_uid = $this->custom_model->get_data_array("SELECT id FROM  `users` WHERE `id` = '$report_user_id' ");
			    if (empty($check_re_uid)) 
			    {
			    	echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid report user id request.' ),"ws" => $ws ) );die;
			    }


			    $data = $this->custom_model->get_data_array("SELECT * FROM  `report_user_post` WHERE  `report_post_id` = '$report_user_id' AND `user_id` = '$user_id' ");

			    if (empty($data)) 
			    {
				    $additional_data = array();
					if(!empty($user_id)) $additional_data['user_id'] 					= $user_id;
					if(!empty($report_user_id)) $additional_data['report_user_id'] 		= $report_user_id;
					if(!empty($type)) $additional_data['type'] 							= $type;
					if(!empty($reason)) $additional_data['reason'] 						= $reason;


				    $result = $this->custom_model->my_insert($additional_data,"report_user_post");

				    echo json_encode( array("status" => true,"message" => ($language == 'ar'? '':'Thanks for letting us know , Your feedback is important in helping us keep the unilife community safe.' ) , "ws" => $ws ) );die;
			    }
			    else
			    {
			    	echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'You already reported this user so cant add again.' ) , "ws" => $ws ) );die;
			    }
   	 		}
   	 		else
   	 		{
   	 			echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'You can not report by your self.' ) , "ws" => $ws ) );die;
   	 		}
   	 	}

   	 	echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ),"ws" => $ws ) );die;
	}
	/*public function create_post()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"caption":"Lorem Ipsum is simply" ,"event_images":"asd" , "group_id" :""}';
		
		$jsonobj 				= json_decode($json);
		$caption 				= @$jsonobj->caption;
		$event_images 			= @$jsonobj->event_images;
		$group_id 				= @$jsonobj->group_id;

		$language 				= @$jsonobj->language;
		$ws 					= @$jsonobj->ws;
		$language 				= empty($language)? 'en':$language;
		$ws 					= empty($ws)? 'create_post':$ws;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{   	 		
   	 		if (!empty($group_id))
   	 		{
   	 			$group = $this->check_group_available_not($user_id,$group_id);
   	 			$post_through_group = 'yes';
   	 		}
   	 		else
   	 		{
   	 			$post_through_group = 'no';
   	 		}

   	 		$logged_in = $this->custom_model->my_where('users','university_school_id',array('id'=>$user_id),array(),"","","","", array(), "",array(),false );

			// echo "<pre>";
			// print_r($question);
			// print_r($options);
			// die;

			$university_school_id = $logged_in[0]['university_school_id'];

			$additional_data = array();

			if(!empty($caption)) $additional_data['caption'] 								= $caption;

			if(!empty($group_id)) $additional_data['group_id'] 								= $group_id;
			if(!empty($post_through_group)) $additional_data['post_through_group'] 			= $post_through_group;

			if(!empty($user_id)) $additional_data['user_id'] 								= $user_id;
			if(!empty($question)) $additional_data['question'] 								= $question;
			if(!empty($university_school_id)) $additional_data['university_post_id'] 		= $university_school_id;
			$additional_data['location_name'] 												= 'normal';
			$additional_data['type'] 														= 'normal';

			$post_id = $this->custom_model->my_insert($additional_data,"posts");

			if (!empty($event_images)) 
			{
				$lists = explode(',', $event_images); 

				// echo "<pre>";
				// print_r($lists);
				// die;

				foreach ($lists as $key => $value) 
				{
					// if(!empty($user_id)) $add_data['user_id'] 			= $user_id;
					$add_data['attachment'] 								= $value;
					$add_data['post_id'] 									= $post_id;
					$add_data['attachment_type'] 							= 'image';
					$this->custom_model->my_insert($add_data,"post_attachments");
				}
			}

			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Post added successfully') )); die;
   	 	}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuestcd') )); die;
 		}
	}*/


	public function create_post()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"caption":"Lorem Ipsum is simply" ,"event_images":"asd.png" , "group_id" :"" , "event_video":{"1":"a50a159a2ce9523cb225cffbec11c0bb.mp4,hci5ckb2Unilife_156904749141570.jpeg","2":"a50a159a2ce9523cb225cffbec11c0bb.mp4,hci5ckb2Unilife_156904749141570.jpeg"}}';
		
		$jsonobj 				= json_decode($json);
		$caption 				= @$jsonobj->caption;
		$event_images 			= @$jsonobj->event_images;
		$event_video 			= @$jsonobj->event_video;
		$group_id 				= @$jsonobj->group_id;

		$language 				= @$jsonobj->language;
		$ws 					= @$jsonobj->ws;
		$language 				= empty($language)? 'en':$language;
		$ws 					= empty($ws)? 'create_post':$ws;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{

   	 		


   	 		if (!empty($group_id))
   	 		{
   	 			$group = $this->check_group_available_not($user_id,$group_id);
   	 			$post_through_group = 'yes';
   	 		}
   	 		else
   	 		{
   	 			$post_through_group = 'no';
   	 		}

   	 		$logged_in = $this->custom_model->my_where('users','university_school_id',array('id'=>$user_id),array(),"","","","", array(), "",array(),false );

			// echo "<pre>";
			// print_r($question);
			// print_r($options);
			// die;

			$university_school_id = $logged_in[0]['university_school_id'];

			$additional_data = array();

			if(!empty($caption)) $additional_data['caption'] 								= $caption;

			if(!empty($group_id)) $additional_data['group_id'] 								= $group_id;
			if(!empty($post_through_group)) $additional_data['post_through_group'] 			= $post_through_group;

			if(!empty($user_id)) $additional_data['user_id'] 								= $user_id;
			if(!empty($question)) $additional_data['question'] 								= $question;
			if(!empty($university_school_id)) $additional_data['university_post_id'] 		= $university_school_id;
			// $additional_data['location_name'] 												= 'normal';
			$additional_data['type'] 														= 'normal';

			$post_id = $this->custom_model->my_insert($additional_data,"posts");

			if (!empty($event_images)) 
			{
				$lists = explode(',', $event_images); 

				// echo "<pre>";
				// print_r($lists);
				// die;

				foreach ($lists as $key => $value) 
				{
					// if(!empty($user_id)) $add_data['user_id'] 			= $user_id;
					$add_data['attachment'] 								= $value;
					$add_data['post_id'] 									= $post_id;
					$add_data['attachment_type'] 							= 'image';
					$this->custom_model->my_insert($add_data,"post_attachments");
				}
			}

			if (!empty($event_video)) 
			{
				$video_data = array();
				
				if (!empty($event_video)) 
				{
					foreach ($event_video as $key => $value) 
					{
						$vid_data = explode(',', $value); 

						$video 			= $vid_data[0];
						$video_thumnail = $vid_data[1];

						// if(!empty($user_id)) $video_data['user_id'] 				= $user_id;
						if(!empty($video)) $video_data['attachment'] 				= $video;
						if(!empty($video_thumnail)) $video_data['thumbnail'] 		= $video_thumnail;
						$video_data['attachment_type'] 								= 'video';
						$video_data['post_id'] 										= $post_id;

						// print_r($video_data);

						$this->custom_model->my_insert($video_data,"post_attachments");
					}
				}
			}
			

			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Post added successfully') )); die;
   	 	}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuestcd') )); die;
 		}
	}


	public function create_opinion()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"caption":"Lorem Ipsum is simply" ,"event_images":"asd.png" , "group_id" :"" , "event_video":{"1":"a50a159a2ce9523cb225cffbec11c0bb.mp4,hci5ckb2Unilife_156904749141570.jpeg","2":"a50a159a2ce9523cb225cffbec11c0bb.mp4,hci5ckb2Unilife_156904749141570.jpeg"}}';
		
		$jsonobj 				= json_decode($json);
		$caption 				= @$jsonobj->caption;
		$event_images 			= @$jsonobj->event_images;
		$event_video 			= @$jsonobj->event_video;
		$group_id 				= @$jsonobj->group_id;

		$language 				= @$jsonobj->language;
		$ws 					= @$jsonobj->ws;
		$language 				= empty($language)? 'en':$language;
		$ws 					= empty($ws)? 'create_post':$ws;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		if (!empty($group_id))
   	 		{
   	 			$group = $this->check_group_available_not($user_id,$group_id);
   	 			$post_through_group = 'yes';
   	 		}
   	 		else
   	 		{
   	 			$post_through_group = 'no';
   	 		}

   	 		$logged_in = $this->custom_model->my_where('users','university_school_id',array('id'=>$user_id),array(),"","","","", array(), "",array(),false );

			// echo "<pre>";
			// print_r($question);
			// print_r($options);
			// die;

			$university_school_id = $logged_in[0]['university_school_id'];

			$additional_data = array();

			if(!empty($caption)) $additional_data['caption'] 								= $caption;

			if(!empty($group_id)) $additional_data['group_id'] 								= $group_id;
			if(!empty($post_through_group)) $additional_data['post_through_group'] 			= $post_through_group;

			if(!empty($user_id)) $additional_data['user_id'] 								= $user_id;
			if(!empty($question)) $additional_data['question'] 								= $question;
			if(!empty($university_school_id)) $additional_data['university_post_id'] 		= $university_school_id;
			// $additional_data['location_name'] 												= 'opinion';
			$additional_data['type'] 														= 'opinion';

			$post_id = $this->custom_model->my_insert($additional_data,"posts");

			if (!empty($event_images)) 
			{
				$lists = explode(',', $event_images); 

				// echo "<pre>";
				// print_r($lists);
				// die;

				foreach ($lists as $key => $value) 
				{
					// if(!empty($user_id)) $add_data['user_id'] 			= $user_id;
					$add_data['attachment'] 								= $value;
					$add_data['post_id'] 									= $post_id;
					$add_data['attachment_type'] 							= 'image';
					$this->custom_model->my_insert($add_data,"post_attachments");
				}
			}

			if (!empty($event_video)) 
			{
				$video_data = array();
				
				if (!empty($event_video)) 
				{
					foreach ($event_video as $key => $value) 
					{
						$vid_data = explode(',', $value); 

						$video 			= $vid_data[0];
						$video_thumnail = $vid_data[1];

						// if(!empty($user_id)) $video_data['user_id'] 				= $user_id;
						if(!empty($video)) $video_data['attachment'] 				= $video;
						if(!empty($video_thumnail)) $video_data['thumbnail'] 		= $video_thumnail;
						$video_data['attachment_type'] 								= 'video';
						$video_data['post_id'] 										= $post_id;

						$this->custom_model->my_insert($video_data,"post_attachments");
					}
				}
			}


			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Post added successfully') )); die;
   	 	}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuestcd') )); die;
 		}
	}

	public function upload_post_images()
   	{
   		$uid = 0;
        $language = 'en';
        $ws = 'upload_post_images';
   		$uid = $this->validate_token_new($language,$ws);

    	/*	$id = uniqid();
    	$req_dump = "<br/>---------".$id."---------<br/>".print_r( $_REQUEST, true );
    	file_put_contents( 'logs/'.$id.'_request.log', $req_dump );
    	$ser_dump = "<br/>---------".$id."---------<br/>".print_r( $_SERVER, true );
    	file_put_contents( 'logs/'.$id.'_server.log', $ser_dump );
    	$file_dump = "<br/>---------".$id."---------<br/>".file_get_contents( 'php://input' );
    	file_put_contents( 'logs/'.$id.'_file.log', $file_dump );
    	$fil_dump = "<br/>---------".$id."---------<br/>".print_r( $_FILES, true );
    	file_put_contents( 'logs/'.$id.'_fil.log', $fil_dump );*/
    	
   	    $type 	= @$_POST['type'];

   	   	$type   = empty($type)? 'image':$type;


   	    // print_r($_POST);
   	    // print_r($_FILES);
   	    // die;

   	    
   	    $FILES = @$_FILES['club_image'];
    	if(!empty($FILES))
    	{
			if($type == 'image')
			{
				$details = array( "caption" => "My Logo", "action" => "fiu_upload_file", "path" => "/public/post_imgs/" );
				$path = $details['path'];
				
				$upl_dir =  ASSETS_PATH;

				$up_dir =   strstr($upl_dir, '/api', true);

				$upload_dir = $up_dir.$path;


				// echo "<pre>";
				// print_r($upload_dir);
				// die;

				if (!file_exists($upload_dir)) {
					mkdir($upload_dir, 0777, true);
				}
				$newFileName = md5(time());
				$target_file = $upload_dir . basename($FILES["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$newFileName = $newFileName.".".$imageFileType;
				$target_file = $upload_dir.$newFileName;

				list($width, $height, $type, $attr)= getimagesize($FILES["tmp_name"]);
				$type1 = $FILES['type'];  

				if ( ( ($imageFileType == "gif") || ($imageFileType == "jpeg") || ($imageFileType == "jpg") || ($imageFileType == "png") ) )
				{

					if (move_uploaded_file($FILES["tmp_name"], $target_file)) 
					{
						$post_data = array('name' => $newFileName,
											'path' => $path,
											'note' => 'user,app',
											'user_id' => $uid);
						// $img_id = $this->custom_model->my_insert($post_data,'image_master');

						$update_p['logo'] = $newFileName;

						// $this->custom_model->my_update($update_p,array('id' => $uid),'admin_users');

						// echo $this->db->last_query();
						// die;

						$upl_dir =  base_url();

						$up_dir =   strstr($upl_dir, '/api', true);
						$up_dir =   $up_dir.'/public/post_imgs/';

						// echo json_encode( array( "status" => true,"data" => $newFileName, "url" => $up_dir.$newFileName ) );die;

						echo json_encode( array( "status" => true,"data" => $newFileName ) );die;
					}
					else
					{
						echo json_encode( array( "status" => false,"data" => ($language == 'ar'? 'حاول مرة اخرى.':'Please try again.') ) );die;
					}
				}
				else
				{ 
					echo json_encode( array( "status" => false,"data" => ($language == 'ar'? 'الرجاء تحميل صورة صالحة.':'Please upload valid image.') ) );die;
				}
			}
			else
			{
				$details = array( "caption" => "My Logo", "action" => "fiu_upload_file", "path" => "/public/post_imgs/" );
				$path = $details['path'];
				
				$upl_dir =  ASSETS_PATH;

				$up_dir =   strstr($upl_dir, '/api', true);

				$upload_dir = $up_dir.$path;


				// echo "<pre>";
				// print_r($upload_dir);
				// die;

				if (!file_exists($upload_dir)) {
					mkdir($upload_dir, 0777, true);
				}
				$newFileName = md5(time());
				$target_file = $upload_dir . basename($FILES["name"]);
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$newFileName = $newFileName.".".$imageFileType;
				$target_file = $upload_dir.$newFileName;

				list($width, $height, $type, $attr)= getimagesize($FILES["tmp_name"]);
				$type1 = $FILES['type'];  

				// echo "<pre>";
				// print_r($imageFileType);
				// die;

				if (move_uploaded_file($FILES["tmp_name"], $target_file)) 
				{
					$post_data = array('name' => $newFileName,
										'path' => $path,
										'note' => 'user,app',
										'user_id' => $uid);
					// $img_id = $this->custom_model->my_insert($post_data,'image_master');

					$update_p['logo'] = $newFileName;

					// $this->custom_model->my_update($update_p,array('id' => $uid),'admin_users');
					// echo $this->db->last_query();
					// die;

					$upl_dir =  base_url();

					$up_dir =   strstr($upl_dir, '/api', true);
					$up_dir =   $up_dir.'/public/post_imgs/';

					// echo json_encode( array( "status" => true,"data" => $newFileName, "url" => $up_dir.$newFileName ) );die;

					echo json_encode( array( "status" => true,"data" => $newFileName ) );die;
				}
				else
				{
					echo json_encode( array( "status" => false,"data" => ($language == 'ar'? 'حاول مرة اخرى.':'Please try again.') ) );die;
				}
				
			}
    	}
    	else
    	{
    		echo json_encode( array( "status" => false,"data" => ($language == 'ar'? 'الرجاء تحميل صورة صالحة.':'Please upload valid image.') ) );die;
    	}	    
   	}


	public function upload_image()
   	{
   		$uid = 0;
        $language = 'en';
        $ws = 'upload_image';
   		// $uid = $this->validate_token_new($language,$ws);

    	/*	$id = uniqid();
    	$req_dump = "<br/>---------".$id."---------<br/>".print_r( $_REQUEST, true );
    	file_put_contents( 'logs/'.$id.'_request.log', $req_dump );
    	$ser_dump = "<br/>---------".$id."---------<br/>".print_r( $_SERVER, true );
    	file_put_contents( 'logs/'.$id.'_server.log', $ser_dump );
    	$file_dump = "<br/>---------".$id."---------<br/>".file_get_contents( 'php://input' );
    	file_put_contents( 'logs/'.$id.'_file.log', $file_dump );
    	$fil_dump = "<br/>---------".$id."---------<br/>".print_r( $_FILES, true );
    	file_put_contents( 'logs/'.$id.'_fil.log', $fil_dump );*/
    	
   	    //$image_type = $_POST['image_type'];
   	    
   	    $FILES = @$_FILES['club_image'];
    	if(!empty($FILES)){
    				if(isset($FILES["type"]))
    				{
    					$details = array( "caption" => "My Logo", "action" => "fiu_upload_file", "path" => "/public/profile_imgs/" );
						$path = $details['path'];
						
						$upl_dir =  ASSETS_PATH;

						$up_dir =   strstr($upl_dir, '/api', true);

						$upload_dir = $up_dir.$path;


    					// echo "<pre>";
    					// print_r($upload_dir);
    					// die;

    					if (!file_exists($upload_dir)) {
    						mkdir($upload_dir, 0777, true);
    					}
    					$newFileName = md5(time());
    					$target_file = $upload_dir . basename($FILES["name"]);
    					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    					$newFileName = $newFileName.".".$imageFileType;
    					$target_file = $upload_dir.$newFileName;

    					list($width, $height, $type, $attr)= getimagesize($FILES["tmp_name"]);
    					$type1 = $FILES['type'];  

    					if ( ( ($imageFileType == "gif") || ($imageFileType == "jpeg") || ($imageFileType == "jpg") || ($imageFileType == "png") ) )
    					{ 

    						if (move_uploaded_file($FILES["tmp_name"], $target_file)) 
    						{
    							$post_data = array('name' => $newFileName,
    												'path' => $path,
													'note' => 'user,app',
    												'user_id' => $uid);
    							// $img_id = $this->custom_model->my_insert($post_data,'image_master');

    							$update_p['profile_image'] = $newFileName;

								// $this->custom_model->my_update($update_p,array('id' => $uid),'users');

								// echo $this->db->last_query();
								// die;

    							$upl_dir =  base_url();

								$up_dir =   strstr($upl_dir, '/api', true);
								$up_dir =   $up_dir.'/public/profile_imgs/';

								echo json_encode( array( "status" => true,"data" => $newFileName, "url" => $up_dir.$newFileName ) );die;

								// echo json_encode( array( "status" => true,"data" => $newFileName ) );die;
    						}
    						else
    						{
    							echo json_encode( array( "status" => false,"data" => ($language == 'ar'? 'حاول مرة اخرى.':'Please try again.') ) );die;
    						}
    					}
    					else
    					{ 
    						echo json_encode( array( "status" => false,"data" => ($language == 'ar'? 'الرجاء تحميل صورة صالحة.':'Please upload valid image.') ) );die;
    					}
    				}
    	}else{
    		echo json_encode( array( "status" => false,"data" => ($language == 'ar'? 'الرجاء تحميل صورة صالحة.':'Please upload valid image.') ) );die;
    	}	    
   	}


   	public function get_post_comment()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"post_id":""}';
		
		$jsonobj 				= json_decode($json);
		$post_id 				= @$jsonobj->post_id;

		$language 				= @$jsonobj->language;
		$ws 					= @$jsonobj->ws;
		$language 				= empty($language)? 'en':$language;
		$ws 					= empty($ws)? 'get_post_comment':$ws;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
   	 		$post_data = $this->custom_model->my_where('posts','id',array('id'=>$post_id),array(),"","","","", array(), "",array(),false );


			if (!empty($post_data)) 
			{
				$comments = $this->custom_model->get_data_array("SELECT id,comment,created_at,user_id FROM comments WHERE `post_id` = '$post_id'  ORDER BY `id` DESC ");

				if (!empty($comments)) 
				{
					$get_udata = '';

					foreach ($comments as $ckey => $cvalue) 
					{
						$comment_user_data = $this->get_user_data($cvalue['user_id']);
						$comments[$ckey]['user_data'] 	= $comment_user_data;

						// echo "<pre>";
						// print_r($comment_user_data);
						// die;

						$get_likes = $this->get_comment_likes($cvalue['id']);
						$comments[$ckey]['like_users'] 			= $get_likes;
						$comments[$ckey]['like_users_count'] 	= count($get_likes);
						
						$comment_id = $cvalue['id'];
   	 					$is_in_wish_list 			= $this->is_in_wish_list_child($cvalue['user_id'],$comment_id);
   	 					$comments[$ckey]['is_like'] = $is_in_wish_list;


						$reply = $this->custom_model->get_data_array("SELECT id,user_id,reply,comment_id FROM comment_replies WHERE `comment_id` = '$comment_id'  ORDER BY `id` ASC ");
						if (!empty($reply))
						{
							foreach ($reply as $rkey => $rvalue) 
							{
								$reply_uid = $rvalue['user_id'];
								$reply_cid = $rvalue['id'];

								$is_in_wis_child = $this->is_in_wish_list_child_reply($reply_uid,$reply_cid);
								$reply[$rkey]['is_like'] = $is_in_wis_child;

								$reply_user_data = $this->get_user_data($reply_uid);
								$reply[$rkey]['user_data'] 	= $reply_user_data;

								$get_nlikes = $this->get_comment_likes($rvalue['comment_id']);
								$reply[$rkey]['like_users_reply'] 	= $get_nlikes;
								$reply[$rkey]['like_users_count_reply'] 	= count($get_nlikes);

								
							}
						}

						$comments[$ckey]['reply_count'] = count($reply);
						$comments[$ckey]['reply_comment'] = $reply;
					}

					echo json_encode(array("status" => true ,"data" => $comments ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Successfully') )); die;

					// echo "<pre>";
					// print_r($comments);
					// die;
				}
				else
				{
					echo json_encode(array("status" => true ,"data" => '' ,"ws" => $ws ,"message" => ($language == 'ar'? '':'No comments available') )); die;
				}
			}
			else
			{
				echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid request') )); die;
			}
   	 	}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid request') )); die;
 		}
	}



   	public function validate_token_new()
	{
		$uid = 0;

		$user_id = $this->getAuthorizationHeader();

   	    // echo "<pre>";
   	    // print_r($headers);
   	    // die;


		$language  	= 'en';
		$ws  		= 'Validate user';

	    if($user_id)
	    {
	    	$logged_in = $this->custom_model->my_where('users','id',array('id'=>$user_id),array(),"","","","", array(), "",array(),false );
	    	
	    	if (!empty($logged_in))
   	 		{
			    $id = $logged_in[0]['id'];
				return $id;
   	 		}
   	 	}

   	 	echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid authentication.' ),"language"=> $language , "ws" => $ws ) );die;
   	}

    public function get_attachment_image($image)
	{
		if (!empty($image))
		{
			$str = "http://15.206.103.14/public/post_imgs/".$image;
			return $str;
		}
   	}

    public function get_profile_path($image)
	{
		if (!empty($image))
		{
			$str = "http://15.206.103.14/public/profile_imgs/".$image;
			return $str;
		}
   	}

   	public function get_blog_banner($image)
	{
		if (!empty($image))
		{
			$str = base_url('assets/admin/images/blog_banner/').$image;
			return $str;
		}
   	}

   	public function get_brand_image($image)
	{
		if (!empty($image))
		{
			$str = "http://15.206.103.14/public/admin/brand/".$image;
			return $str;
		}
   	}


   	public function get_uploded_image($image)
	{
		if (!empty($image))
		{
			$str = "http://15.206.103.14/api/assets/admin/usersdata/".$image;
			return $str;
		}
   	}

   	

   	public function validate_token_vender($language = 'en',$ws='')
	{
		$uid = 0;
		$token = $this->getBearerToken();
		// print_r($token); die;
   	    $Jwt_client = new Jwt_client();
   	    $token = $Jwt_client->decode($token);
   	    if($token){
   	       if(@$token['api_key'] != $this->token_id ){
   	       		$uid = $this->check_user_login_vender($language,$ws);
   	       }
   	    }else{
   	        $uid = $this->check_user_login_vender($language,$ws);
   	    }

   	    return $uid;
   	}

   	public function check_user_login_vender($language = 'en',$ws)
	{
		$token1 = $this->getBearerToken();
	    $Jwt_client = new Jwt_client(); 
	    $token = $Jwt_client->decode($token1);

	    // print_r($token);
	    // die;


	    if($token)
	    {
	    	$aData = array();
	    	$id = @$token['id'];
	    	$password = @$token['password'];
	    	// $this->logout();
	    	$logged_in = $this->custom_model->my_where('admin_users','password,token',array('id'=>$id),array(),"","","","", array(), "",array(),false );
	    	
	    	if (!empty($logged_in))
   	 		{
   	 			if(password_verify ( $password ,$logged_in[0]['password'] ))
				{
					if ($logged_in[0]['token'] == $token1) {
						return $id;
					}
				}
				elseif ($password == $logged_in[0]['password'] )
				{
				    if ($logged_in[0]['token'] == $token1) {
						return $id;
					}
				}
   	 		}
   	 	}

   	 	echo json_encode( array("status" => false,"message" => ($language == 'ar'? "مصادقة غير صالحة.":'Invalid authentication.' ),  "language"=> $language , "ws" => $ws ) );die;
   	}


	public function validate_token($language = 'en',$ws='')
	{
		$uid = 0;
		$token = $this->getBearerToken();
		// print_r($token); die;
   	    $Jwt_client = new Jwt_client();
   	    $token = $Jwt_client->decode($token);
   	    if($token){
   	       if(@$token['api_key'] != $this->token_id ){
   	       		$uid = $this->check_user_login($language,$ws);
   	       }
   	    }else{
   	        $uid = $this->check_user_login($language,$ws);
   	    }

   	    return $uid;
   	}

   	public function check_user_login($language = 'en',$ws)
	{
		$token1 = $this->getBearerToken();
	    $Jwt_client = new Jwt_client(); 
	    $token = $Jwt_client->decode($token1);

	    if($token)
	    {
	    	$aData = array();
	    	$id = @$token['id'];
	    	$password = @$token['password'];
	    	// $this->logout();
	    	$logged_in = $this->custom_model->my_where('users','password,token',array('id'=>$id),array(),"","","","", array(), "",array(),false );
	    	
	    	if (!empty($logged_in))
   	 		{
   	 			if(password_verify ( $password ,$logged_in[0]['password'] ))
				{
					if ($logged_in[0]['token'] == $token1) {
						return $id;
					}
				}
				elseif ($password == $logged_in[0]['password'] )
				{
				    if ($logged_in[0]['token'] == $token1) {
						return $id;
					}
				}
   	 		}
   	 	}

   	 	echo json_encode( array("status" => false,"message" => ($language == 'ar'? "مصادقة غير صالحة.":'Invalid authentication.' ),  "language"=> $language , "ws" => $ws ) );die;
   	}

	/** 
	 * Get hearder Authorization
	 * */

	function getAuthorizationHeader()
	{
	        $headers = null;
	        if (isset($_SERVER['Token'])) {
	            $headers = trim($_SERVER["Token"]);
	        }
	        else if (isset($_SERVER['HTTP_TOKEN'])) { //Nginx or fast CGI
	            $headers = trim($_SERVER["HTTP_TOKEN"]);
	        } elseif (function_exists('apache_request_headers')) {
	            $requestHeaders = apache_request_headers();
	            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
	            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
	            if (isset($requestHeaders['Token'])) {
	                $headers = trim($requestHeaders['Token']);
	            }
	        }
	        return $headers;
	}

	function getBearerToken() {
	   $headers = $this->getAuthorizationHeader();
	    // HEADER: Get the access token from the header
	    if (!empty($headers)) {
	        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
	            return trim($matches[1]);
	        }
	    }
	    return null;
	}


	public function get_user_data($user_id = '')
	{
		$data = '';

   	 	if (!empty($user_id))
   	 	{
   	 		$data = $this->custom_model->get_data_array("SELECT profile_image,username,created_at FROM  `users` WHERE `id` = '$user_id' ");   	 		

   	 		if ($data) 
   	 		{
   	 			// $data[0]['profile_logo'] 	= $data[0]['profile_image'];
	 			$data[0]['profile_image']	= $this->get_profile_path($data[0]['profile_image']);

   	 		}
   	 		return $data;
   		}
 		else
 		{
   	 		return $data;
 		}
	}

	public function get_comment_likes($coment_id = '')
	{
		$data = '';

   	 	if (!empty($coment_id))
   	 	{
   	 		$data = $this->custom_model->get_data_array("SELECT id,user_id,created_at,post_comment_id FROM  `post_comment_likes` WHERE `post_comment_id` = '$coment_id' ");  
   	 		if (!empty($data)) 
   	 		{
   	 			$g_udata = '';
   	 			foreach ($data as $key => $value)
   	 			{
   	 				$user_id = $value['user_id'];
					$g_udata = $this->get_user_data($user_id);

					$data[$key]['like_username'] 		= $g_udata[0]['username'];

					if (!empty($g_udata[0]['profile_image']))
					{
						$data[$key]['like_user_image'] 		= $g_udata[0]['profile_image'];
					}
					else
					{
						$data[$key]['like_user_image'] 		= '';
					}
					


   	 			}
   	 		}
   	 		// $data[0]['user_like_count'] = count($data);		

   			// echo "<pre>";
			// print_r($value);
			// die;

   	 		return $data;
   		}
 		else
 		{
   	 		return $data;
 		}
	}

	public function get_banner()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"type":"blog"}';
		// $json 		= '{"type":"brand"}';

		
		$jsonobj 		= json_decode($json);

		$type 			= @$jsonobj->type;

		$category_id 		= @$jsonobj->category_id;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'get_banner':$ws;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($type))
   	 	{

   	 		if ($type == 'brand') 
   	 		{
	   	 		$data = $this->custom_model->get_data_array("SELECT image FROM  `brand_banner` WHERE `status` = 'active' ");
	   	 		if ($data) 
	   	 		{
	   	 			foreach ($data as $key => $value) 
	   	 			{
			   	 		$data[$key]['image']	= $this->get_blog_banner($value['image']);
	   	 				
	   	 			}
	   	 		}

	   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Successfully') )); die;   	 		
   	 		}

   	 		if ($type == 'blog') 
   	 		{
	   	 		$data = $this->custom_model->get_data_array("SELECT image FROM  `blog_banner` WHERE `status` = 'active' ");
	   	 		if ($data) 
	   	 		{
	   	 			foreach ($data as $key => $value) 
	   	 			{
			   	 		$data[$key]['image']	= $this->get_blog_banner($value['image']);
	   	 				
	   	 			}
	   	 		}

	   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Successfully') )); die;   	 		
   	 		}


   	 		


   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}

	public function get_social_media_post()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"category_id":"22"}';

		
		$jsonobj 		= json_decode($json);

		$category_id 	= @$jsonobj->category_id;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'get_social_media_post':$ws;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($category_id))
   	 	{
   	 		$social_media_post = $this->custom_model->get_data_array("SELECT social_media_post.post ,social_media_post.category_id,social_media_post.id , blog_categories.categories_name as category_name  FROM social_media_post INNER JOIN blog_categories ON blog_categories.id = social_media_post.category_id   WHERE social_media_post.status='active'  ORDER BY social_media_post.id DESC  ");

   	 		if (!empty($category_id)) 
   	 		{
   	 			$social_media_post = $this->custom_model->get_data_array("SELECT social_media_post.post ,social_media_post.category_id,social_media_post.id , blog_categories.categories_name as category_name  FROM social_media_post INNER JOIN blog_categories ON blog_categories.id = social_media_post.category_id   WHERE social_media_post.status='active' AND social_media_post.category_id = '$category_id'  ORDER BY social_media_post.id DESC  ");
   	 		}

   	 		echo json_encode(array("status" => true,'data'=> $social_media_post ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Successfully') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}


	public function remove_member_from_group()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"group_id":"1","remove_user_id":"1"}';
		
		$jsonobj 		= json_decode($json);

		$group_id 		= @$jsonobj->group_id;
		$remove_user_id 		= @$jsonobj->remove_user_id;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'remove_member_from_group':$ws;

		$user_id = $this->validate_token_new();

		if (!empty($group_id))
 		{
	   		$data = $this->custom_model->get_data_array("SELECT id FROM  `groups` WHERE `id` = '$group_id' ");
	 		if ($data) 
	 		{
	 			$op_data = $this->custom_model->get_data_array("SELECT id,group_id,user_id,group_admin FROM  `group_users` WHERE `group_id` = '$group_id' AND `user_id` = '$remove_user_id'  ");

	 			// echo "<pre>";
	 			// print_r($op_data);
	 			// die;

		 		if ($op_data) 
	   	 		{
	   	 			$result = $this->custom_model->my_delete(array("id" => $op_data[0]['id']),"group_users");

	   	 			$o_data = $this->custom_model->get_data_array("SELECT id FROM  `group_users` WHERE `group_id` = '$group_id'  ");
	   	 			if (empty($o_data)) 
	   	 			{
	   	 				$this->custom_model->my_delete(array("id" => $group_id),"groups");
	   	 				$ws = 'group_deleted';
	   	 			}

	   	 			echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Delete Successfully') )); die;

	   	 		}

	   	 		echo json_encode( array("status" => true,"message" => ($language == 'ar'? "":'Invalid group user selection for remove.' ) , "ws" => $ws ) );die;

		 		}
	 		else
	 		{
	 			echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid group id request.' ),"ws" => $ws ) );die;
	 		}
 		}
 		else
 		{
 			echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ) , "ws" => $ws ) );die;
 		}
 	}
   	

   	public function friend_req_listing()
	{
		$json = file_get_contents('php://input');

		// $json 		= '';
		
		$jsonobj 		= json_decode($json);

		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'friend_req_listing':$ws;

		$user_id = $this->validate_token_new();

		if (!empty($user_id))
 		{
	   		$normal_req = $this->custom_model->get_data_array("SELECT id,user_id,friend_id,group_id,status,type FROM  `friend_requests` WHERE `friend_id` = '$user_id' AND `group_id` IS NULL  ");
	   		
		 	$group_req = $this->custom_model->get_data_array("SELECT id,user_id,friend_id,group_id,status,type FROM  `friend_requests` WHERE `user_id` = '$user_id' AND `group_id` != ''  ");

		 	$data = array_merge($normal_req , $group_req);

		 	if ($data) 
	 		{
	 			foreach ($data as $key => $value) 
	 			{
	 				$sender_id = $value['user_id'];
	 				$fid = $value['friend_id'];
	 				$group_id = $value['group_id'];

		 			$request = $this->custom_model->get_data_array("SELECT id,university_school_email,username,profile_image FROM  `users` WHERE `id` = '$sender_id' ");
		 			if ($request) 
		 			{
		   	 			$request[0]['profile_image']			= $this->get_profile_path($request[0]['profile_image']);
			 			$data[$key]['user_university_school_email'] = $request[0]['university_school_email'];
			 			$data[$key]['user_username'] = $request[0]['username'];
			 			$data[$key]['user_profile_image'] = $request[0]['profile_image'];
		 			}
		 			else
		 			{
		 				$data[$key]['user_university_school_email'] = '';
			 			$data[$key]['user_username'] = '';
			 			$data[$key]['user_profile_image'] = '';
		 			}

		 			$gdata = $this->custom_model->my_where('groups','group_name,group_image',array('id'=>$group_id),array(),"","","","", array(), "",array(),false );

					if (!empty($gdata)) 
					{
						$data[$key]['group_name'] = $gdata[0]['group_name'];
						$data[$key]['group_image'] = $this->get_profile_path($gdata[0]['group_image']);
					}
					else
					{
						$data[$key]['group_name'] = '';
						$data[$key]['group_image'] = '';
					}
	 			}

	 			// echo "<pre>";
	 			// print_r($data);
	 			// die;

	   	 		echo json_encode( array("status" => true, "data" => $data ,"message" => ($language == 'ar'? "":'Successfully' ) , "ws" => $ws ) );die;

		 	}
	 		else
	 		{
	 			echo json_encode( array("status" => true,"message" => ($language == 'ar'? "":'No request found' ),"ws" => $ws ) );die;
	 		}
 		}
 		else
 		{
 			echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ) , "ws" => $ws ) );die;
 		}
 	}

 	public function friend_req_accept_reject()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"type":"reject","request_id":"1"}';
		// $json 		= '{"type":"accept","request_id":"1"}';
		
		$jsonobj 		= json_decode($json);

		$request_id		= @$jsonobj->request_id;
		$type 			= @$jsonobj->type;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'friend_req_accept_reject':$ws;

		$user_id = $this->validate_token_new();

		if (!empty($user_id))
 		{
	   		$data = $this->custom_model->get_data_array("SELECT id,friend_id,group_id,status,type,user_id FROM  `friend_requests` WHERE `id` = '$request_id' ");
	 		
			// echo "<pre>";
			// print_r($data);
			// die;

	 		if ($data) 
	 		{
 				$user_id = $data[0]['user_id'];
 				$fid = $data[0]['friend_id'];
 				$group_id = $data[0]['group_id'];

 				if (!empty($group_id)) 
 				{
 					if ($type == 'accept') 
 					{
						$al_data['group_admin'] 			= 'No';
						$al_data['group_id'] 				= $group_id;
						$al_data['user_id'] 				= $user_id;
		   	 			$this->custom_model->my_insert($al_data,"group_users");

		   	 			$this->custom_model->my_delete(array("id" => $request_id),"friend_requests");
		   	 			
						echo json_encode( array("status" => true, "message" => ($language == 'ar'? "":'Request accepted successfully' ) , "ws" => $ws ) );die;

 					}

 					if ($type == 'reject') 
 					{
						$this->custom_model->my_delete(array("id" => $request_id),"friend_requests");

						echo json_encode( array("status" => true, "message" => ($language == 'ar'? "":'Request rejected successfully' ) , "ws" => $ws ) );die;
 					} 					
 				}
 				else
 				{
 					if ($type == 'accept') 
 					{
	 					$additional_data['user_id'] 		= $user_id;
						$additional_data['friend_id'] 		= $fid;
		   	 			$this->custom_model->my_insert($additional_data,"friend_lists");


		   	 			$a_data['friend_id'] 			= $user_id;
						$a_data['user_id'] 				= $fid;
		   	 			$this->custom_model->my_insert($a_data,"friend_lists");

						$this->custom_model->my_delete(array("id" => $request_id),"friend_requests");

						echo json_encode( array("status" => true, "message" => ($language == 'ar'? "":'Request accepted successfully' ) , "ws" => $ws ) );die;

 					}

 					if ($type == 'reject') 
 					{
						$this->custom_model->my_delete(array("id" => $request_id),"friend_requests");

						echo json_encode( array("status" => true, "message" => ($language == 'ar'? "":'Request rejected successfully' ) , "ws" => $ws ) );die;
 					}

 				}
 			}
	 		else
	 		{
	 			echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'No request found' ),"ws" => $ws ) );die;
	 		}
 		}
 		else
 		{
 			echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ) , "ws" => $ws ) );die;
 		}
 	}

 	public function create_group()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"group_name":"Gang","group_image":"image.png",'friend_id':"1,2,3"}';
		
		$jsonobj 		= json_decode($json);

		$group_image		= @$jsonobj->group_image;
		$group_name		= @$jsonobj->group_name;
		$friend_id		= @$jsonobj->friend_id;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'create_group':$ws;

		$user_id = $this->validate_token_new();

		if (!empty($user_id))
 		{
   	 		$data = $this->custom_model->get_data_array("SELECT id,university_school_id FROM  `users` WHERE `id` = '$user_id' ");

	 		
			// echo "<pre>";
			// print_r($data);
			// die;

	 		if (!empty($friend_id)) 
	 		{
	 			$university_school_id = $data[0]['university_school_id'];

				$al_data['status'] 					= 'active';
				$al_data['created_by'] 				= $user_id;
				$al_data['university_group_id'] 	= $university_school_id;
				$al_data['group_image'] 			= $group_image;
				$al_data['group_name'] 				= $group_name;

   	 			$group_id = $this->custom_model->my_insert($al_data,"groups");


   	 			$gu_data['group_id'] 				= $group_id;
   	 			$gu_data['user_id'] 				= $user_id;
   	 			$gu_data['group_admin'] 			= 'yes';
   	 			$this->custom_model->my_insert($gu_data,"group_users");


   	 			$data_frd = explode (",", $friend_id);  

   	 			foreach ($data_frd as $key => $value) 
	 			{
	 				if (!empty($value))
	 				{
		 				$f_data['friend_id'] 			= $user_id;
		 				$f_data['user_id'] 				= $value;
		   	 			$f_data['group_id'] 			= $group_id;
		   	 			$f_data['status'] 				= 'P';
		   	 			$f_data['type'] 				= 'group';

		   	 			// echo "<pre>";
		   	 			// print_r($f_data);

		   	 			$this->custom_model->my_insert($f_data,"friend_requests");

	 				}
	 			}

				echo json_encode( array("status" => true, "message" => ($language == 'ar'? "":'Group created successfully' ) , "ws" => $ws ) );die;
 				
 			}
 		}

 		echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ) , "ws" => $ws ) );die;
 		
 	}

 	public function send_emoji()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"room_id":"4627593560","message":"😜😃","receiver_id":"616"}';
		
		$jsonobj 		= json_decode($json);

		$room_id		= @$jsonobj->room_id;
		$message		= @$jsonobj->message;
		$receiver_id		= @$jsonobj->receiver_id;
		$group_id		= @$jsonobj->group_id;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'send_emoji':$ws;

		$user_id = $this->validate_token_new();

		if (!empty($user_id))
 		{
 			$additional_data = array();

			if(!empty($room_id)) $additional_data['room_id'] 			= $room_id;
			if(!empty($message)) $additional_data['message'] 			= utf8_decode($message);
			$additional_data['sender_id'] 								= $user_id;
			if(!empty($receiver_id)) $additional_data['receiver_id'] 		= $receiver_id;
			if(!empty($group_id)) $additional_data['group_id'] 			= $group_id;


			$additional_data['date'] 					= date("Y/m/d h:i:s");
			$additional_data['seen'] 					= '0';
			$additional_data['is_deleted'] 				= '00';
			$additional_data['message_type'] 			= 'text';

			// echo "<pre>";
			// print_r($additional_data);
			// die;

	 		$this->custom_model->my_insert($additional_data,"chat");

			echo json_encode( array("status" => true, "message" => ($language == 'ar'? "":'Successfully' ) , "ws" => $ws ) );die;
				
 			
 		}

 		echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ) , "ws" => $ws ) );die;
 		
 	}

 	public function email_verify()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"email":"girishbhumkar5@gmail.com"}';

		$jsonobj 		= json_decode($json);

		$email 			= @$jsonobj->email;

		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'email_verify':$ws;

		// $user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($email))
   	 	{
   	 		$already = $this->custom_model->get_data_array("SELECT id FROM `users` WHERE `university_school_email` = '$email'  ");

   	 		if ($already) 
   	 		{
   	 			echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Email already available so please change .') )); die;
   	 		}

   	 		$user_check = $this->custom_model->my_where("otp_verify","otp,verify",array("email" => $email,"otp !=" => ''),array(),"","","","", array(), "",array(),false  );

			if (!empty($user_check)) 
			{
				$otp = $user_check[0]['otp'];			
			}
			else
			{
				$digits = 4;
				$otp = rand(pow(10, $digits-1), pow(10, $digits)-1);

				$additional_data['otp']  = $otp;
	   	 		$additional_data['email']  = $email;
	   	 		$additional_data['created_date'] 	=  date("Y/m/d h:i:s");

	   	 		$this->custom_model->my_insert($additional_data,"otp_verify");
			}

   	 		$subject = 'Unilife OTP';

			$message = "<p style='font-size: 12px;'>Hi $email,</p>
				<p style='font-size: 12px; color:#696969; margin-top: -15px;'>
				Your OTP is $otp .</p>
				<p style='font-size: 12px; color:#696969; margin-top: -10px;'>
				If you didn't make the request just ignore this email. Otherwise, you can enter your OTP.</p><br/>";

			send_email_using_postmark($email,$subject,$message);

   	 		// echo "<pre>";
   	 		// echo $this->db->last_query();
   	 		// print_r($data);
   	 		// die;
   	 		
   	 		echo json_encode(array("status" => true ,"ws" => $ws  ,"message" => ($language == 'ar'? '':'Otp Send successfully to your email address .') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}

	public function otp_verify()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"email":"girishbhumkar5@gmail.com","otp":"1234"}';

		$jsonobj 		= json_decode($json);

		$email 			= @$jsonobj->email;
		$new_otp 		= @$jsonobj->otp;

		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'email_verify':$ws;

		// $user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($email))
   	 	{
   	 		$user_check = $this->custom_model->my_where("otp_verify","otp,verify",array("email" => $email,"verify" => ''),array(),"","","","", array(), "",array(),false  );

			if (empty($user_check)) 
			{
				echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ) , "ws" => $ws ) );die;
			}

			$old_check = $user_check[0]['otp'];

			if ($new_otp != $old_check) 
			{
				echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? '':'Please enter valid OTP.') ) );die;
			}


			$this->custom_model->my_update(['verify' => 'yes'], ['email' => $email], 'otp_verify');
			echo json_encode( array("status" => true, "ws" => $ws ,"message" => ($language == 'ar'? '':'Otp accepted successfully. ') ) );die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}

 	public function university_schools_list()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"string":"dubai"}';

		$jsonobj 		= json_decode($json);
		$string 		= @$jsonobj->string;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'university_schools_list':$ws;

		// $user_id = $this->validate_token_new();

   	 	if (!empty($language))
   	 	{
   	 		// $uni = $this->custom_model->get_data_array("SELECT name,id FROM `university_schools` WHERE  `name` LIKE '%$string%' ");

   	 		$uni = $this->custom_model->get_data_array("SELECT name,id FROM `university_schools` WHERE  `status` = 'active' ");
   	 		if (!empty($uni)) 
   	 		{
   	 			foreach ($uni as $key => $value) 
   	 			{
   	 				$uni_id = $value['id'];
   	 				$doma_ins = $this->custom_model->my_where('domains','domain',array('university_id'=>$uni_id),array(),"","","","", array(), "",array(),false );
   	 				if ($doma_ins) 
   	 				{
   	 					$uni[$key]['domains'] = $doma_ins[0]['domain'];
   	 				}
   	 				else
   	 				{
   	 					$uni[$key]['domains'] = '';
   	 				}
   	 			}
   	 		}

   	 		// echo "<pre>";
   	 		// echo $this->db->last_query();
   	 		// print_r($uni);
   	 		// die;

   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $uni ,"message" => ($language == 'ar'? '':'Successfully .') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}

	public function add_university()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"name": "Girish University","domain": "@girish.in"}';

		$jsonobj 		= json_decode($json);
		$name 			= @$jsonobj->name;
		$domain 		= @$jsonobj->domain;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'add_university':$ws;

		// $user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($name))
   	 	{
			if(!empty($name)) $additional_data['name'] 		= $name;
			$additional_data['dean_name'] 					= 'John Doe';
			$additional_data['no_of_students'] 				= '10000';
			$additional_data['status'] 						= 'active';

			$university_id = $this->custom_model->my_insert($additional_data,"university_schools");


   	 		
   	 		if(!empty($university_id)) $a_data['university_id'] 		= $university_id;
			$a_data['domain'] 											= $domain;
			$a_data['status'] 											= 'active';

			$this->custom_model->my_insert($a_data,"domains");


   	 		// echo "<pre>";
   	 		// echo $this->db->last_query();
   	 		// print_r($uni);
   	 		// die;
   	 		
   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"university_id" => $university_id ,"message" => ($language == 'ar'? '':'Successfully .') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid resuest') )); die;
 		}
	}

	public function register()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"university_id":"1","email":"girishbhumkar5@gmail.com","username":"Girish Bhumkar","gender":"male","date_of_birth":"17-01-1992","password":"123123","profile_image":"e69b5eddf8044f5e2e8d6ae78e33a105.jpg"}';
		
		$a_data['request'] 			= $json;
		$a_data['api_name'] 		= 'register';
		$a_data['created_date'] 	=  date("Y/m/d h:i:s");
		$this->custom_model->my_insert($a_data,"json_request");


		$jsonobj 		= json_decode($json);

		$university_id		= @$jsonobj->university_id;
		$email				= @$jsonobj->email;
		$username			= @$jsonobj->username;
		$gender				= @$jsonobj->gender;
		$date_of_birth		= @$jsonobj->date_of_birth;
		$password			= @$jsonobj->password;
		$profile_image		= @$jsonobj->profile_image;

		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'register':$ws;

		// $user_id = $this->validate_token_new();

		if (!empty($university_id))
 		{

 			$already = $this->custom_model->get_data_array("SELECT id FROM  `users` WHERE `university_school_email` = '$email'  ");

   	 		if ($already) 
   	 		{
   	 			echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Email already available so please change .') )); die;
   	 		}


   	 		$uname = $this->custom_model->get_data_array("SELECT id FROM  `users` WHERE `username` = '$username'  ");

   	 		if ($uname) 
   	 		{
   	 			echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Username already exist .') )); die;
   	 		}



 			$additional_data = array();

			if(!empty($university_id)) $additional_data['university_school_id'] 	= $university_id;
			if(!empty($email)) $additional_data['university_school_email'] 			= $email;
			if(!empty($username)) $additional_data['username'] 						= $username;
			if(!empty($gender)) $additional_data['gender'] 							= $gender;
			if(!empty($date_of_birth)) $additional_data['date_of_birth'] 			= $date_of_birth;
			if(!empty($profile_image)) $additional_data['profile_image'] 			= $profile_image;

			$additional_data['otp_verify'] 					= 'yes';
			$additional_data['otp'] 						= '';

			// $additional_data['date'] 					= date("Y/m/d h:i:s");
			$additional_data['decoded_password'] 			= $password;
			$additional_data['password'] 					= password_hash($password, PASSWORD_BCRYPT);

			// echo "<pre>";
			// print_r($additional_data);
			// die;

	 		$id = $this->custom_model->my_insert($additional_data,"users");

			echo json_encode( array("status" => true, "message" => ($language == 'ar'? "":'Register successfully' ) , "ws" => $ws, "id" => $id ) );die;
				
 			
 		}

 		echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ) , "ws" => $ws ) );die;
 		
 	}

 	public function friend_request_send_listing()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"pagination":"1"}';

		$jsonobj 		= json_decode($json);
		$university_id	= @$jsonobj->university_id;
		$university_id	= @$jsonobj->university_id;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'register':$ws;

		$user_id = $this->validate_token_new();
		$this->email_domain_update();

		$pagination = @$jsonobj->pagination;

		if (empty($pagination))
		{
			echo json_encode( array("status" => false, "ws" => $ws ,"message" => ($language == 'ar'? '':'Add pagination') ) );die;
		}

		if(empty($pagination)) $pagination = 1;
		$limit = 100;
		$pagination = $limit * ( $pagination - 1);



		$u_data = $this->custom_model->get_data_array("SELECT university_school_id,email_domain FROM  users WHERE `id` = '$user_id' ");

		$data = $this->custom_model->get_data_array("SELECT university_school_id,email_domain FROM  users WHERE `otp_verify` = 'yes' ");
 		
		// echo "<pre>";
		// print_r($users_data);
		// die;

 		if ($data) 
 		{
 			$email_domain = $u_data[0]['email_domain'];

 			// $column = 'university_school_id';
			// $myGoal = implode(',', array_map(function($n) use ($column) {return $n[$column];}, $data));

			// $users_data = $this->custom_model->get_data_array("SELECT id,username,university_school_id,profile_image FROM `users` WHERE `university_school_id` IN ($myGoal) ORDER BY `id` DESC LIMIT $pagination,$limit ");

			$users_data = $this->custom_model->get_data_array("SELECT id,username,university_school_id,profile_image,email_domain FROM `users` WHERE `id`  != '$user_id' AND `otp_verify` = 'yes' ORDER BY `id` DESC LIMIT $pagination,$limit ");

			// echo "<pre>";
			// print_r($users_data);
			// die;

			

			if (!empty($users_data)) 
			{			
	 			foreach ($users_data as $key => $value) 
	 			{
	 				/*$uni_id = $value['university_school_id'];
	 				if ($uni_id == $university_id) 
	 				{
	 					$users_data[$key]['school'] = 'same';
	 				}
	 				else
	 				{
	 					$users_data[$key]['school'] = 'different';
	 				}*/

	 				$uni_email_domain = $value['email_domain'];
	 				if ($email_domain == $uni_email_domain) 
	 				{
	 					$users_data[$key]['school'] = 'same';
	 				}
	 				else
	 				{
	 					$users_data[$key]['school'] = 'different';
	 				}

	 				$users_data[$key]['profile_image']	= $this->get_profile_path($users_data[$key]['profile_image']);	 				
	 			}
	 		}

 			// echo "<pre>";
 			// print_r($data);
 			// die;

   	 		echo json_encode( array("status" => true, "data" => $users_data ,"message" => ($language == 'ar'? "":'Successfully' ) , "ws" => $ws ) );die;

	 	}
 		else
 		{
 			echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'No data found' ),"ws" => $ws ) );die;
 		}

 		echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ) , "ws" => $ws ) );die;
 		
 	}

 	public function get_uni_id_using_domain()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"domain":"gmail.com"}';

		$jsonobj 		= json_decode($json);
		$domain			= @$jsonobj->domain;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'get_uni_id_using_domain':$ws;

		// $user_id = $this->validate_token_new();
		$this->email_domain_update();

		$d_domain = '@'.$domain;

		$check = $this->custom_model->get_data_array("SELECT university_id FROM  domains WHERE `domain` = '$d_domain' ");

		// echo "<pre>";
		// print_r($check);
		// die;

 		if ($check) 
 		{
 			$university_id = $check[0]['university_id'];

   	 		echo json_encode( array("status" => true, "university_id" => $university_id ,"message" => ($language == 'ar'? "":'Successfully' ) , "ws" => $ws ) );die;

	 	}
 		else
 		{

 			$name =  preg_replace('/[^A-Za-z0-9\-]/', ' ', $domain); 

 			$data['name'] 				= $name;
 			$data['dean_name'] 			= 'John Doe';
 			$data['no_of_students'] 	= '10000';
 			$data['status'] 			= 'active ';

 			$university_id = $this->custom_model->my_insert($data,"university_schools");

 			$domain_insert['university_id'] 		= $university_id;
 			$domain_insert['domain'] 				= $d_domain;
 			$domain_insert['status'] 				= 'active ';

 			$domain_id = $this->custom_model->my_insert($domain_insert,"domains");


 			echo json_encode( array("status" => true, "university_id" => "$university_id" ,"message" => ($language == 'ar'? "":'Successfully' ) , "ws" => $ws ) );die;
 		}

 		echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ) , "ws" => $ws ) );die;
 		
 	}

 	public function phone_number_get_univ_wise()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"university_id":"10"}';

		$jsonobj 		= json_decode($json);
		$university_id	= @$jsonobj->university_id;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'phone_number_get_univ_wise':$ws;

		$user_id = $this->validate_token_new();

		$this->email_domain_update();
		
		$u_data = $this->custom_model->get_data_array("SELECT university_school_id,email_domain FROM  users WHERE `id` = '$user_id' ");

		$data = $this->custom_model->get_data_array("SELECT id,phone,university_school_id,email_domain FROM  users Where `phone` != '0' AND `id` != '$user_id' ");
 		
		// echo "<pre>";
		// print_r($data);
		// die;

 		if ($data) 
 		{
 			

 			if (!empty($data)) 
			{
				$email_domain = $u_data[0]['email_domain'];
	
	 			foreach ($data as $key => $value) 
	 			{
	 				$uni_email_domain = $value['email_domain'];
	 				if ($email_domain == $uni_email_domain) 
	 				{
	 					$data[$key]['school'] = 'same';
	 				}
	 				else
	 				{
	 					$data[$key]['school'] = 'different';
	 				}
	 			}
	 		}

   	 		echo json_encode( array("status" => true, "data" => $data ,"message" => ($language == 'ar'? "":'Successfully' ) , "ws" => $ws ) );die;
	 	}
 		else
 		{
 			echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'No data found' ),"ws" => $ws ) );die;
 		}

 		echo json_encode( array("status" => false,"message" => ($language == 'ar'? "":'Invalid request.' ) , "ws" => $ws ) );die;
 		
 	}


 	public function brand_detail()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"brand_id":"1"}';

		
		$jsonobj 		= json_decode($json);

		$type 			= @$jsonobj->type;

		$brand_id 		= @$jsonobj->brand_id;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'brand_detail':$ws;

		$user_id = $this->validate_token_new();
		// $user_id = $this->validate_token($language ,$ws);

   	 	if (!empty($user_id))
   	 	{
	   	 	$data = $this->custom_model->get_data_array("SELECT id,categories_id,brand_name,image,type,description,facebook,instagram,twitter FROM `brands` WHERE `status` = 'active' AND `id` = '$brand_id' ");

   	 		if ($data) 
   	 		{
   	 			$data[0]['image']	= 'http://15.206.103.14/public/admin/brand/'.$data[0]['image'];

   	 			$data[0]['online'] = $this->custom_model->get_data_array("SELECT * FROM `brands_online_instore` WHERE `brand_id` = '$brand_id' AND `type` = 'online' ");
   	 			if (!empty($data[0]['online'])) 
   	 			{
   	 				$r_id = $data[0]['online'];
   	 				foreach ($r_id as $skey => $svalue) 
   	 				{
   	 					$brands_online_instore_id = $svalue['id'];
   	 					$check = $this->custom_model->get_data_array("SELECT id FROM `brands_redeem_user` WHERE `brands_online_instore_id` = '$brands_online_instore_id' AND `user_id` = '$user_id' ");
   	 					if ($check) 
   	 					{
   	 						$data[0]['online'][$skey]['used_voucher'] = 'yes';
   	 					}
   	 					else
   	 					{
   	 						$data[0]['online'][$skey]['used_voucher'] = 'no';
   	 					}
   	 				}
   	 			}

   	 			$data[0]['store'] = $this->custom_model->get_data_array("SELECT * FROM `brands_online_instore` WHERE `brand_id` = '$brand_id' AND `type` = 'instore' ");

   	 			if (!empty($data[0]['store'])) 
   	 			{
   	 				$r_id = $data[0]['store'];
   	 				foreach ($r_id as $fkey => $fvalue) 
   	 				{
   	 					$brands_online_instore_id = $fvalue['id'];
   	 					$check = $this->custom_model->get_data_array("SELECT id FROM `brands_redeem_user` WHERE `brands_online_instore_id` = '$brands_online_instore_id' AND `user_id` = '$user_id' ");
   	 					if ($check) 
   	 					{
   	 						$data[0]['store'][$fkey]['used_voucher'] = 'yes';
   	 					}
   	 					else
   	 					{
   	 						$data[0]['store'][$fkey]['used_voucher'] = 'no';
   	 					}
   	 				}
   	 			}


	   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"data" => $data ,"message" => ($language == 'ar'? '':'Successfully') )); die;   	 		
   	 		}

   	 		

   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid request') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid request') )); die;
 		}
	}

	public function redeem_voucher()
	{
		$json = file_get_contents('php://input');

		// $json 		= '{"type":"online","code":"mzHVPRwPfH","brand_id":"48"}';
		// $json 		= '{"type":"instore","code":"mzHVPRwPfH","brand_id":"48","receipt_number":"123654","branch_name_location" :"Pune Test"}';

		
		$jsonobj 		= json_decode($json);
		$type 			= @$jsonobj->type;
		$code 			= @$jsonobj->code;
		$brand_id 		= @$jsonobj->brand_id;
		$receipt_number 	= @$jsonobj->receipt_number;
		$branch_name_location = @$jsonobj->branch_name_location;
		$language 		= @$jsonobj->language;
		$ws 			= @$jsonobj->ws;
		$language 		= empty($language)? 'en':$language;
		$ws 			= empty($ws)? 'redeem_voucher':$ws;

		$user_id = $this->validate_token_new();

   	 	if (!empty($user_id))
   	 	{
   	 		

   	 		$check = $this->custom_model->get_data_array("SELECT id,use_type FROM  `brands_online_instore` WHERE `brand_id` = '$brand_id' AND `code` = '$code' AND `type` = '$type' ");
   	 		if (empty($check)) 
   	 		{
   	 			echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid voucher redeem request') )); die;
   	 		}


   	 		if ($type == 'online') 
   	 		{
   	 			$additional_data['offer_type'] = $type;

	   	 		$additional_data['user_id'] = $user_id;
	   	 		$additional_data['brand_id'] = $brand_id;
	   	 		$additional_data['brands_online_instore_id'] = $check[0]['id'];
	   	 		$additional_data['code'] = $code;
	   	 		$additional_data['created_date'] =  date("Y/m/d h:i:s");
	   	 		$this->custom_model->my_insert($additional_data,"brands_redeem_user");

	   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Voucher redeem successfully') )); die;
   	 		}
   	 		else
   	 		{
   	 			$use_type = $check[0]['use_type'];

   	 			if ($use_type == 'single') 
   	 			{
   	 				$check_a = $this->custom_model->get_data_array("SELECT id FROM  `brands_redeem_user` WHERE `brand_id` = '$brand_id' AND `code` = '$code' AND `user_id` = '$user_id' ");

		   	 		if (!empty($check_a)) 
		   	 		{
		   	 			echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Voucher redeem already') )); die;
		   	 		}
   	 			} 			

	   	 		$additional_data['user_id'] = $user_id;
	   	 		$additional_data['brand_id'] = $brand_id;
	   	 		$additional_data['brands_online_instore_id'] = $check[0]['id'];
	   	 		$additional_data['code'] = $code;
	   	 		$additional_data['offer_type'] = $type;
	   	 		$additional_data['created_date'] =  date("Y/m/d h:i:s");

	   	 		$additional_data['receipt_number'] = $receipt_number;
	   	 		$additional_data['branch_name_location'] = $branch_name_location;

	   	 		$this->custom_model->my_insert($additional_data,"brands_redeem_user");

	   	 		echo json_encode(array("status" => true ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Voucher redeem successfully') )); die;

   	 		}

   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid request') )); die;
 		}
 		else
 		{
   	 		echo json_encode(array("status" => false ,"ws" => $ws ,"message" => ($language == 'ar'? '':'Invalid request') )); die;
 		}
	}



 	public function girish()
 	{
 		$apikey = "ZDcyODIwMTMtN2NhZS00NzFkLWJlZTItNDI3MjQ0NGJkODVjOjk2NmFkODNlLWFlM2ItNDVmMS04ZjkzLTg1NWRhOWZjOWY1MQ==";     // enter your API key here
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, "https://api-gateway.sandbox.ngenius-payments.com/identity/auth/access-token"); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    "accept: application/vnd.ni-identity.v1+json",
		    "authorization: Basic ".$apikey,
		    "content-type: application/vnd.ni-identity.v1+json"
		  )); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS,  "{\"realmName\":\"ni\"}"); 
		$output = json_decode(curl_exec($ch)); 
		$access_token = $output->access_token;

		

		echo $access_token;


		// order create code 
		// https://docs.ngenius-payments.com/reference#create-an-order-paypage

		$postData = new StdClass(); 
		$postData->action = "SALE"; 
		$postData->amount = new StdClass();
		$postData->amount->currencyCode = "AED"; 
		$postData->amount->value = 100; 

		$outlet = "c24e01c8-61ee-4c19-9823-669bbb05cc90";
		$token = $access_token;
		 
		$json = json_encode($postData);
		$ch = curl_init(); 
		 
		curl_setopt($ch, CURLOPT_URL, "https://api-gateway.sandbox.ngenius-payments.com/transactions/outlets/".$outlet."/orders"); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    "Authorization: Bearer ".$token, 
		    "Content-Type: application/vnd.ni-payment.v2+json", 
		    "Accept: application/vnd.ni-payment.v2+json")); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);   
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json); 
		 
		$output = json_decode(curl_exec($ch)); 
		$order_reference = $output->reference; 
		$order_paypage_url = $output->_links->payment->href; 
		 
		curl_close ($ch);

		echo "<pre>";
		print_r($output);


 	}

 	public function email_domain_update()
 	{
		$data = $this->custom_model->get_data_array("SELECT id,university_school_email FROM `users` WHERE `email_domain` = '' ");
		if (!empty($data)) 
		{
			$additional_data = array();
			foreach ($data as $key => $value) 
			{
				$email = $value['university_school_email'];
				$additional_data['email_domain'] = substr($email, strpos($email, "@") + 1);    
				// print_r ($additional_data);
				// echo "<br>";

				$result = $this->custom_model->my_update($additional_data,array("id" => $value['id']),"users");
			}
		}


 	}


 	public function users_id_check()
	{
		$check = $this->custom_model->get_data_array("SELECT id, university_school_email ,university_school_id,email_domain FROM  users ");

	

 		if ($check) 
 		{

 			foreach ($check as $key => $value) 
 			{
 				$user_id = $value['id'];
 				$email_domain = $value['email_domain'];
 				$university_school_email = $value['university_school_email'];

 				$email_domain = substr($university_school_email, strpos($university_school_email, "@") + 1);    


 				$d_domain = '@'.$email_domain;

				$sd_check = $this->custom_model->get_data_array("SELECT university_id FROM domains WHERE `domain` = '$d_domain' ");

				// echo "<pre>";
				// print_r($email_domain);

				// echo "<br>";
				// print_r($sd_check);

				// echo "<br>";
				// echo $this->db->last_query();
				// echo "<br>";
				// die;


				if ($sd_check) 
				{
					$additional_data['university_school_id'] = $sd_check[0]['university_id'];
					$additional_data['email_domain'] = $email_domain;

					$result = $this->custom_model->my_update($additional_data,array("id" => $user_id),"users");

					$check[$key]['university_id_match'] = $sd_check[0]['university_id'];
				}
				else
				{
					$name =  preg_replace('/[^A-Za-z0-9\-]/', ' ', $email_domain);

					// echo "<pre>";
					// print_r($sd_check);
					// echo ">>>";
					// print_r($d_domain);
					// die;

		 			$data['name'] 				= $name;
		 			$data['dean_name'] 			= 'John Doe';
		 			$data['no_of_students'] 	= '10000';
		 			$data['status'] 			= 'active ';

		 			$university_id = $this->custom_model->my_insert($data,"university_schools");

		 			$domain_insert['university_id'] 		= $university_id;
		 			$domain_insert['domain'] 				= $d_domain;
		 			$domain_insert['status'] 				= 'active ';

		 			$domain_id = $this->custom_model->my_insert($domain_insert,"domains");

				}
 			}
	 	}

	 // 	echo "<pre>";
		// print_r($check);
		// die;	

 		
 	}


 	public function brand_data()
	{
		$json = file_get_contents('php://input');
		//	$json 		= '{}';
		$jsonobj 	= json_decode($json);
		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'brand_data':$ws;
        
		// $user_id = 1;
		$user_id = $this->validate_token_new();

   	 	if (!empty($user_id))
   	 	{
 			$products = $this->custom_model->get_data_array("SELECT categories_id FROM brands where  `status` = 'active' GROUP BY categories_id ORDER BY categories_id DESC LIMIT 5 ;");

			// echo "<pre>";
			// print_r($products);
			// die;

 			$data = array();
 			if (!empty($products))
 			{
 				foreach ($products as $qkey => $qvalue)
	 			{	 				
	 				$category_id = $qvalue['categories_id'];

	 				$category_name = $this->custom_model->get_data_array("SELECT * FROM categories  where `id` = '$category_id' ");

	 				if (!empty($category_name))
	 				{
	 					$products[$qkey]['image'] = $this->get_brand_image($category_name[0]['image']);
	 					$products[$qkey]['category'] = $category_name[0]['name'];
	 					$products[$qkey]['type'] 	 = 'brands';

	 					$data = $this->custom_model->get_data_array("SELECT brand_name,image,type,description,id FROM brands WHERE `categories_id` = '$category_id' ORDER BY RAND() LIMIT 5;");

	 					if (!empty($data)) {
	 						foreach ($data as $gkey => $gvalue) {
	 							$data[$gkey]['image'] = $this->get_brand_image($gvalue['image']);

	 						}
	 					}
	 					$products[$qkey]['categories_brand'] = $data;
	 				}
	 				else
	 				{
	 					unset($products[$qkey]);
	 				}			
	 			}
 			}



 			// echo "<pre>";
 			// print_r($products);
 			// die;

 			$banner = $this->custom_model->get_data_array("SELECT image FROM  `brand_banner` WHERE `status` = 'active' ");
   	 		if ($banner) 
   	 		{
   	 			foreach ($banner as $bkey => $bvalue) 
   	 			{
		   	 		$banner[$bkey]['image']	= $this->get_blog_banner($bvalue['image']);
   	 				
   	 			}
   	 		}

 			$categories = $this->custom_model->get_data_array("SELECT image,name,id FROM  `categories` WHERE `status` = 'active' ORDER BY id ASC LIMIT 4 ");

   	 		if ($categories) 
   	 		{
   	 			foreach ($categories as $ckey => $cvalue) 
   	 			{
		   	 		$categories[$ckey]['image']	= $this->get_brand_image($cvalue['image']);
   	 				
   	 			}
   	 		}


   	 		echo json_encode(array("status" => true, "offer" => $products, "banner" => $banner, "categories" => $categories,"message" => "successfully")); die;   	 		
 		}
 		else
 		{
 			echo json_encode(array("status" => false,"ws" => $ws ,"message" => ($language == 'ar'? 'طلب غير صالح':'Invalid request') )); die;
 		}
	}

	public function categories_view_all_in_brand()
	{
		$json = file_get_contents('php://input');
		//	$json 		= '{}';
		$jsonobj 	= json_decode($json);
		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'categories_view_all_in_brand':$ws;
        
		// $user_id = 1;
		$user_id = $this->validate_token_new();

   	 	if (!empty($language))
   	 	{

 			$categories = $this->custom_model->get_data_array("SELECT image,name,id FROM  `categories` WHERE `status` = 'active' ORDER BY id ASC ");

   	 		if ($categories) 
   	 		{
   	 			foreach ($categories as $ckey => $cvalue) 
   	 			{
		   	 		$categories[$ckey]['image']	= $this->get_brand_image($cvalue['image']);
   	 				
   	 			}
   	 		}


   	 		echo json_encode(array("status" => true, "categories" => $categories,"message" => "successfully")); die;   	 		
 		}
 		else
 		{
 			echo json_encode(array("status" => false,"ws" => $ws ,"message" => ($language == 'ar'? 'طلب غير صالح':'Invalid request') )); die;
 		}
	}

	public function categories_wise_offers_data()
	{
		$json = file_get_contents('php://input');
		//	$json 		= '{"category_id":"1"}';
		$jsonobj 	= json_decode($json);
		$category_id 	= @$jsonobj->category_id;
		$language 	= @$jsonobj->language;
		$ws 		= @$jsonobj->ws;
		$language 	= empty($language)? 'en':$language;
		$ws 		= empty($ws)? 'categories_wise_offers_data':$ws;
        
		// $user_id = 1;
		$user_id = $this->validate_token_new();

   	 	if (!empty($category_id))
   	 	{
			$category_name = $this->custom_model->get_data_array("SELECT id,name,image FROM categories  where `id` = '$category_id' ");

			if (!empty($category_name))
			{
				$category_name[0]['image']	= $this->get_brand_image($category_name[0]['image']);

				$data = $this->custom_model->get_data_array("SELECT brand_name,image,type,description,id FROM brands WHERE `categories_id` = '$category_id' ORDER BY id desc ;");

				if (!empty($data)) {
					foreach ($data as $gkey => $gvalue) {
						$data[$gkey]['image'] = $this->get_brand_image($gvalue['image']);

					}
				}
				$category_name[0]['offers'] = $data;
			}
 			// echo "<pre>";
 			// print_r($category_name);
 			// die;

   	 		echo json_encode(array("status" => true, "categories" => $category_name,"message" => "successfully")); die;   	 		
 		}
 		else
 		{
 			echo json_encode(array("status" => false,"ws" => $ws ,"message" => ($language == 'ar'? 'طلب غير صالح':'Invalid request') )); die;
 		}
	}

	public function check_version($user_id = '',$source = '',$version = '')
	{
		$user_data = $this->custom_model->my_where('users','source,version',array('id'=>$user_id),array(),"","","","", array(), "",array(),false );

		if (!empty($user_data)) 
		{
			$check_version = $this->custom_model->my_where('version','*',array('id'=>'1'));
			
			$android_v 	= $check_version[0]['android'];
			$ios_v 		= $check_version[0]['ios'];

			if ($source == 'android') 
			{
				if ($version < $android_v) 
				{
					// echo json_encode(array("status" => false  ,"message" =>"New version is available in store kindly update" )); die;
				}

				if ($version > $android_v) 
				{
					$additional_data['android'] = $version;
					$result = $this->custom_model->my_update($additional_data,array("id" => '1'),"version");					
				}
			}
			else if ($source >= 'ios') 
			{				
				if ($version < $ios_v) 
				{
					// echo json_encode(array("status" => false  ,"message" =>"New version is available in store kindly update" )); die;
				}

				if ($version > $ios_v) 
				{
					$additional_data['ios'] = $version;
					$result = $this->custom_model->my_update($additional_data,array("id" => '1'),"version");
				}
			}

			$a_data['source'] = $source;
			$a_data['version'] = $version;
			$this->custom_model->my_update($a_data,array("id" => $user_id),"users");

		}		
	}


}
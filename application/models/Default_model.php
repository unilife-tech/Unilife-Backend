<?php 

class Default_model extends MY_Model {

	public function get_social()
	{
		$social = $this->db->get('social')->result_array();
		return $social;
	}

	public function services_footer()
	{
		$services_footer = $this->db->get('services')->result_array();
		return $services_footer;
	}
	public function contact_info()
	{
		$contact_info = $this->db->get('contact_info')->result_array();
		return $contact_info;
	}
}
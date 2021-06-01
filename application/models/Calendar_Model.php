<?php

class Calendar_Model extends CI_Model
{

	public function get_events($start, $end, $uid)
	{
		// return $this->db->where("date >=", $start)->where("date <=", $end)->where("doc_id", $uid)->get("order_item");
		return $this->db->where("date >=", $start)->where("date <=", $end)->where("maid_id !=",'')->get("order_item");
	}
	
	public function get_events_driver($start, $end, $uid)
	{
		// return $this->db->where("date >=", $start)->where("date <=", $end)->where("doc_id", $uid)->get("order_item");
		return $this->db->where("date >=", $start)->where("date <=", $end)->where("driver_id !=",'')->get("order_item");
	}

	public function get_all_events($start, $end)
	{
		// return $this->db->where("btime >=", $start)->where("btime <=", $end)->get("order_item");
		return $this->db->where("date >=", $start)->where("date <=", $end)->where("maid_id !=",'')->get("order_item");
	}
}

?>
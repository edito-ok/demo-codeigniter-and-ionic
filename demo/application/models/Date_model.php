<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Date_model extends CI_Model {
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function getDate()
	{
		$query = $this->db->get('datetable');
		if($query->num_rows() == 0){
			return $this->create();
		}
		return $query->result();
	}
	function create()
	{
		$date = date('Y-m-d H:i:s');
		$this->db->insert('datetable',array('date' => $date));
		$query = $this->db->get('datetable');
		return $query->result();
	}
	function update($request)
	{
		$datetime = $request['date'];
		$id = $request['id'];
		$time = strtotime($datetime);
		$final = date("Y-m-d h:i:s", strtotime("+8 days", $time));
		$query = $this->db->set('date', $final);
		$this->db->where('id_table', $id);
		$this->db->update('datetable');
	}
}

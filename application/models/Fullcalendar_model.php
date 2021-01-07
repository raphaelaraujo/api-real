<?php

defined('BASEPATH') OR exit('Ação não permitida');

class Fullcalendar_model extends CI_Model{

	function fetch_all_event(){
		$this->db->order_by('id');
		return $this->db->get('events');
	}
}
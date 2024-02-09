<?php

class Save{

	private $con;

	function __construct($con){
		$this->con = $con->db_connect();	
	}


	public function saveClient($str){
		$sqlQuery = $this->con->query($str);
		$id_event = $this->con->insert_id;
		return $id_event;
	}
	
}
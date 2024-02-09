<?php

	class Page{

		private $con;

		function __construct($con){
			$this->con = $con;	
		}

		public function get_pages(){
			$result = array();
			$sql= "SELECT * FROM paginas";
			$ejecutar= $this->con->executeQuery($sql);
			if( count($ejecutar)>0 ){
				$result = $ejecutar;
			}
			return $result;
		}

		public function get_metas(){
			$result = array();
			$sql= "SELECT name,id_meta,title,description FROM paginas INNER JOIN meta_tags ON paginas.id_pagina = meta_tags.id_paginafk";
			$ejecutar= $this->con->executeQuery($sql);
			if( count($ejecutar)>0 ){
				$result = $ejecutar;
			}
			return $result;
		}

	}

?>
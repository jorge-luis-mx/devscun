<?php

	class Blog{

		private $con;

		function __construct(){
			$this->con = new Config();
		}
		

		public function get_categoria(){
			
			$result = array();
			$sql= "SELECT * FROM categorias";
			$ejecutar= $this->con->executeQuery($sql);
			if( count($ejecutar)>0 ){
				$result = $ejecutar;
			}
			return $result;
		}


		/*=============================================
		Mostrar artículos y categorías con inner join
		=============================================*/

		public function mdlMostrarConInnerJoin($tabla1, $tabla2, $desde, $cantidad){

			$sql = "SELECT $tabla1.*, $tabla2.*, DATE_FORMAT(fecha_articulo, '%Y-%m-%d h%:%i%:%s') AS fecha_articulo FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_categoria = $tabla2.id_cat ORDER BY $tabla2.id_articulo DESC LIMIT $desde, $cantidad";
			$ejecutar= $this->con->executeQuery($sql);
			if( count($ejecutar)>0 ){
					$result = $ejecutar;
			}
			return $result;

			
		}


	/*=============================================
	Mostrar total articulos
	=============================================*/

	public function mdlMostrarTotalArticulos($tabla, $item, $valor){

		if($item == null && $valor == null){

			$sql = "SELECT * FROM $tabla";
			$ejecutar= $this->con->executeQuery($sql);
			if( count($ejecutar)>0 ){
				$result = $ejecutar;
			}
			return $result;

		}else{

			$sql = "SELECT * FROM $tabla WHERE $item = $valor ORDER BY id_articulo DESC";

			$ejecutar= $this->con->executeQuery($sql);
			if( count($ejecutar)>0 ){
				$result = $ejecutar;
			}
			return $result;

		}


	}


	}

?>
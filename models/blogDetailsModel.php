<?php

	class Details{

		private $con;

		function __construct(){
			$this->con = new Config();
		}

		/*=============================================
		Mostrar artículos y categorías con inner join
		=============================================*/

		public function mdlMostrarConInnerJoin($tabla1, $tabla2, $desde, $cantidad, $item, $valor){

			$sql ="SELECT $tabla1.*, $tabla2.*, DATE_FORMAT(fecha_articulo, '%d.%m.%Y') AS fecha_articulo FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_categoria = $tabla2.id_cat WHERE $item = '".$valor."' ORDER BY $tabla2.id_articulo DESC LIMIT $desde, $cantidad";
			
			$ejecutar= $this->con->executeQuery($sql);
			if( count($ejecutar)>0 ){
				$result = $ejecutar;
			}
			return $result;

		}


		public function mdlMostrarTotalArticulos($tabla, $item, $valor){

			$sql ="SELECT * FROM $tabla WHERE $item = '".$valor."' ORDER BY id_articulo DESC";
			$ejecutar= $this->con->executeQuery($sql);
			if( count($ejecutar)>0 ){
				$result = $ejecutar;
			}
			return $result;
			

	
		}
      
   }



?>
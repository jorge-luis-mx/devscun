<?php

	class Categoria{

		private $con;

		function __construct(){
			$this->con = new Config();
		}
		
		/*=============================================
		Mostrar artículos y categorías con inner join
		=============================================*/

		public function mdlMostrarConInnerJoin($tabla1, $tabla2, $desde, $cantidad, $item, $valor){

			$sql = "SELECT categorias.*, articulos.*, DATE_FORMAT(fecha_articulo, '%d.%m.%Y') AS fecha_articulo FROM categorias INNER JOIN articulos ON categorias.id_categoria = articulos.id_cat WHERE ruta_categoria = '".$valor."' ORDER BY articulos.id_articulo DESC LIMIT ".$desde.",".$cantidad;
			
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


		/*=============================================
		Articulos Destacados
		=============================================*/

		public function mdlArticulosDestacados($tabla, $item, $valor){
		
			$sql = "SELECT * FROM $tabla WHERE $item = '".$valor."' ORDER BY vistas_articulo DESC LIMIT 3";

			$ejecutar= $this->con->executeQuery($sql);
			if( count($ejecutar)>0 ){
				$result = $ejecutar;
			}
			return $result;

		}

	}
?>
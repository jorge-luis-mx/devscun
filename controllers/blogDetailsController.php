<?php 

require_once 'models/blogDetailsModel.php';

class blogDetailsController{


	public function index(){

		$rutas = explode("/", $_GET["route"]);
		
		$objcategoria = new Details;
		
		$tabla1 = "categorias";
		$tabla2 = "articulos";
		$articulo = $objcategoria->mdlMostrarConInnerJoin($tabla1, $tabla2, 0, 1,'ruta_articulo',$rutas[2]);

		$tabla = "articulos";
		$totalArticulos = $objcategoria->mdlMostrarTotalArticulos($tabla, "id_cat", $articulo[0]["id_cat"]);
		$totalPaginas = ceil(count($totalArticulos)/5);

		require_once 'views/components/blog/detailsBlog.php';
	}




}

?>
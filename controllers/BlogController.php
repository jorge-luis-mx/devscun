<?php 

require_once 'models/blogModel.php';

class blogController{


	public function index(){

		
		$rutas = explode("/", $_GET["route"]);
		
		$objcategoria = new Blog;
		$categorias = $objcategoria->get_categoria();

		$tabla1 = "categorias";
		$tabla2 = "articulos";
		$articulos = $objcategoria->mdlMostrarConInnerJoin($tabla1, $tabla2, 0, 5);

		$tabla = "articulos";
		$totalArticulos = $objcategoria->mdlMostrarTotalArticulos($tabla, null, null);
		$totalPaginas = ceil(count($totalArticulos)/5);
	
		if(isset($rutas[1])){

			if(is_numeric($rutas[1])){

				$desde = ($rutas[1] -1)* 5;
	
				$cantidad = 5;
	
				$articulos = $objcategoria->mdlMostrarConInnerJoin($tabla1, $tabla2, $desde, $cantidad);
				
				$paginaActual = $rutas[1];
			}else{
				$paginaActual = 1;
			}
		}else{

			if(isset($rutas[1]) && is_numeric($rutas[1])){

				$paginaActual = $rutas[1];

			}else{

				$paginaActual = 1;

			}
		}


		require_once 'views/components/blog/blog.php';
	}




}

?>
<?php

require_once 'models/blogCategoriaModel.php';

class blogCategoriaController{
	
	
	public function index(){
		
		$rutas = explode("/", $_GET["route"]);
		
		$objcategoria = new Categoria;
		$tabla1 = "categorias";
		$tabla2 = "articulos";
		$articulos = $objcategoria->mdlMostrarConInnerJoin($tabla1, $tabla2, 0, 5, "ruta_categoria", $rutas[1]);


		$tabla = "articulos";
		$totalArticulos = $objcategoria->mdlMostrarTotalArticulos($tabla, "id_cat", $articulos[0]["id_cat"]);
		$totalPaginas = ceil(count($totalArticulos)/5);

		$articulosDestacados = $objcategoria->mdlArticulosDestacados($tabla,"id_cat", $articulos[0]["id_cat"]);


		if(isset($rutas[2])){

			if(is_numeric($rutas[2])){
		
				if($rutas[2] > $totalPaginas){
		
					echo '<script>
		
						
					window.location = "'.base_url.'404";

					</script>';
		
					return;
		
				}
		
				$paginaActual = $rutas[2];
		
				$desde = ($rutas[2] - 1)*5;
				$cantidad = 5;
		

				$articulos = $objcategoria->mdlMostrarConInnerJoin($tabla1, $tabla2, $desde, $cantidad, "ruta_categoria", $rutas[1]);
		
		
			}else{
		
				echo '<script>
		
				window.location = "'.base_url.'404";
		
				</script>';
		
				return;
			}
		
		
		}else{
		
			$paginaActual = 1;
		
		}
		
		

		require_once 'views/components/blog/categoriaBlog.php';
		
	}



}

?>
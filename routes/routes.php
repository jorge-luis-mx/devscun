<?php 

$validarRuta = "";
if(isset($_GET['route'])){


	$rutas = explode("/", $_GET["route"]);

	if ($rutas!=null && count($rutas)<=3) {

		//rutas normales o navegacion normal
		if(isset($rutas[0])){

			if ($_GET['route']=="paginas-web-cancun") {

				$objController = new paginaCancunController;
				$objController->index();

			}else if($_GET['route']== "servicios-de-paginas-web-cancun"){

				$objController = new serviciosController;
				$objController->index();

			}else if ($_GET['route']=="precios-de-paginas-web-cancun") {

				$objController = new preciosController;
				$objController->index();

			}else if ($_GET['route']=="portafolio") {

				$objController = new portafolioController;
				$objController->index();

			}else if ($_GET['route']=="diseno-de-paginas-web-ocosingo") {

				$objController = new portafolioController;
				$objController->index();

			}else if ($_GET['route']=="blog") {

				$objController = new blogController;
				$objController->index();


			}else if ($_GET['route']=="nosotros") {

				$objController = new nosotrosController;
				$objController->index();
				
			}else if ($_GET['route']=="contacto") {

				$objController = new contactoController;
				$objController->index();
					
			}else if ($_GET['route']=="politicas-de-privacidad") {

				$objController = new politicasPrivacidadController;
				$objController->index();
					
			}else if ($_GET['route']=="terminos-y-condiciones") {

				$objController = new terminosCondicionesController;
				$objController->index();
					
			}else {

				if (!isset($rutas[1])) {

					pagina404();
				}

			}

		}
		
		//diseño web ocosingo chiapas
		//creadores de paginas web en ocosingo chiapas

		//rutas mas de dos parametros como blog y paginacion
		if(isset($rutas[1])){

			if(is_numeric($rutas[1])){

				if ($rutas[1] <= $totalPaginas) {

					$objController = new blogController;
					$objController->index();
					
				}else{
					pagina404();
				}
			}

			if (is_string($rutas[1])) {
				foreach ($categorias as $key => $value) {

					if($rutas[1] == $value["ruta_categoria"]){
	
						$validarRuta = "categorias";
	
						break;
	
					}else{
	
						$validarRuta = "buscador";
					}
				}
				
			}else{

				pagina404();
			}

		}


		/*=============================================
		Indice 1: Rutas de Artículos o Paginación de categorías
		=============================================*/

		if(isset($rutas[2])){

			if(is_numeric($rutas[2])){

				$desde = ($rutas[2] -1)* 5;

				$cantidad = 5;

			}else{

				foreach ($totalArticulos as $key => $value) {
				
					if($rutas[2] == $value["ruta_articulo"]){

						$validarRuta = "articulos";

						break;

					}
				}

			}


		}



		/*=============================================
		Validar las rutas
		=============================================*/
		if($validarRuta == "categorias"){

			$objController = new blogCategoriaController;
			$objController->index();

		}else if($validarRuta == "articulos"){

			$objController = new blogDetailsController;
			$objController->index();
			
		}



	}else {


		pagina404();
	}


}else{


	$controller = controller_default;
	$objController = new $controller();
	$objController->index();
}

function pagina404(){

	$objController = new pagina404Controller;
	$objController->index();
}
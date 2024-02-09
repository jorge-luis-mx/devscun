<?php

class Route{
	public function route(){

		if(!isset($_GET['route'])){
			$controller = controller_default;
			$controllerMetod='inicio';
		}
		if(isset($_GET['route'])){
			switch ($_GET['route']) {
				case "servicios-de-paginas-web-cancun":
		
					$controller='serviciosController';
					$controllerMetod='servicios';
					 break;
				case "precios-de-paginas-web-cancun":
					$controller='preciosController';
					$controllerMetod='precios';
					 break;
				case "nosotros-desenamos-paginas-web-cancun":
		
					$controller='nosotrosController';
					$controllerMetod='nosotros';
					break;
				case "contacto-de-diseno-paginas-web-cancun":
		
					$controller='contactoController';
					$controllerMetod='contacto';
					break;
		
				default:
					$controller='inicioController';
					$controllerMetod='inicio';
			}
		
		}

		$array=[
			'classController'=>$controller,
			'metodoController'=>$controllerMetod
		];
		return $array;

	}
}
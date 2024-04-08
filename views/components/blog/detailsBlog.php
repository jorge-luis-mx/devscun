<?php 


/*=============================================
Función para limitar foreach
=============================================*/
function limitarForeach($array, $limite){

	foreach ($array as $key => $value) {
		
		if(!$limite--)	break;

		yield $key => $value;
	}

}



?>

<!--=====================================
CONTENIDO ARTÍCULO
======================================-->

<div class="container-fluid bg-white contenidoInicio py-2 py-md-4" style="margin-top: 130px;">
	
	<div class="container">

		<!-- BREADCRUMB -->

		<a href="<?php echo base_url. $articulo[0]["ruta_categoria"]; ?>">
			
			<button class="d-block d-sm-none btn btn-info btn-sm mb-2">
			
				REGRESAR 

			</button>

		</a>

		<ul class="breadcrumb bg-white p-0 mb-2 mb-md-4 breadArticulo">

			<li class="breadcrumb-item inicio"><a href="<?php echo base_url.$rutas[0]?>">Inicio</a></li>

			<li class="breadcrumb-item"><a href="<?php echo base_url.$rutas[0].'/'.$articulo[0]["ruta_categoria"]; ?>"><?php echo $articulo[0]["descripcion_categoria"]; ?></a></li>

			<li class="breadcrumb-item active"><?php echo $articulo[0]["titulo_articulo"]; ?></li>

		</ul>

		<div class="row">
			
			<!-- COLUMNA IZQUIERDA -->
			<div class="col-12 col-md-8 col-lg-9 p-0 pr-lg-5">
				
				<!-- ARTÍCULO 01 -->
				<div class="container">

					<div class="">
					
						<div class="fechaArticulo"><?php
							$fecha_formateada = date('Y-m-d', strtotime(str_replace('.', '/', $articulo[0]["fecha_articulo"])));
						 	echo $fecha_formateada; 
						 ?></div>

						<h3 class="tituloArticulo  text-muted pl-3 pt-lg-2"><?php echo $articulo[0]["titulo_articulo"]; ?></h3>

					</div>
					

					<?php 

						echo $articulo[0]["contenido_articulo"];
					
					?>

					 
					<!-- COMPARTIR EN REDES -->

					<div class="float-right my-3 btnCompartir">
						
						<div class="btn-group text-secondary">

							Si te gustó compártelo:

						</div>
						
						<div class="btn-group">
							
							<button type="button" class="btn border-0 text-white social-share" style="background: #1475E0" data-share="facebook">
								
								<span class="fab fa-facebook pr-1"></span>

								Facebook

							</button>

						</div>

						<!-- <div class="btn-group">
							
							<button type="button" class="btn border-0 text-white social-share" style="background: #00A6FF" data-share="twitter">
								
								<span class="fab fa-twitter pr-1"></span>

								Twitter

							</button>

						</div> -->

					</div>


				</div>
			</div>

			<!-- COLUMNA DERECHA -->
			<div class="d-none d-md-block pt-md-4 pt-lg-0 col-md-4 col-lg-3">		
				<!-- ARTÍCULOS RECIENTES -->
				<div class="my-4">
					
					<h4>Artículos Recientes</h4>

					<?php foreach (limitarForeach($totalArticulos, 3) as $key => $value): ?>

						<div class="d-flex my-3">
						
							<div class="w-100 w-xl-50 pr-3 pt-2">
								
								<a href="<?php echo base_url.$rutas[0].'/'.$articulo[0]["ruta_categoria"]."/".$value["ruta_articulo"]; ?>">

									<img src="<?php echo base_url.server.$value["portada_articulo"];?>" alt="<?php echo $value["titulo_articulo"]; ?>" class="img-fluid">

								</a>

							</div>

							<div>

								<a href="<?php echo base_url.'blog/'.$articulo[0]["ruta_categoria"]."/".$value["ruta_articulo"] ?>" class="text-secondary">

									<p class="small"><?php echo substr($value["descripcion_articulo"], 0, -150)."..."; ?></p>

								</a>

							</div>

						</div>
						
					<?php endforeach ?>

				</div>
			</div>

		</div>

	</div>

</div>







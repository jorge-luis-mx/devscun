

<!--=====================================
CONTENIDO CATEGORIA
======================================-->

<div class="container-fluid bg-white contenidoInicio py-2 py-md-4" style="margin-top: 140px;">
	
	<div class="container">

		<!-- BREADCRUMB -->

		<ul class="breadcrumb bg-white p-0 mb-2 mb-md-4">

			<li class="breadcrumb-item inicio"><a href="<?php echo base_url;?>blog">Inicio</a></li>

			<li class="breadcrumb-item active"><?php echo $articulos[0]["descripcion_categoria"];?></li>

		</ul>
		
		<div class="row">
			
			<!-- COLUMNA IZQUIERDA -->

			<div class="col-12 col-md-8 col-lg-9 p-0 pr-lg-5">
				
				<?php foreach ($articulos as $key => $value): ?>
				

					<!-- ARTÍCULOS -->

					<div class="row">
						
						<div class="col-12 col-lg-5">

							<a href="<?php echo base_url.$value["ruta_categoria"]."/".$value["ruta_articulo"]; ?>"><h5 class="d-block d-lg-none py-3"><?php echo $value["titulo_articulo"]; ?></h5></a>
				
							<a href="<?php echo base_url.$rutas[0].'/'.$value["ruta_categoria"]."/".$value["ruta_articulo"]; ?>"><img src="<?php echo base_url.server;?><?php echo $value["portada_articulo"]; ?>" alt="<?php echo $value["titulo_articulo"]; ?>" class="img-fluid" width="100%"></a>

						</div>

						<div class="col-12 col-lg-7 introArticulo">
							
							<a href="<?php echo base_url.$rutas[0].'/'.$value["ruta_categoria"]."/".$value["ruta_articulo"]; ?>"><h4 class="d-none d-lg-block"><?php echo $value["titulo_articulo"]; ?></h4></a>
							
							<p class="my-2 my-lg-5"><?php echo $value["descripcion_articulo"]; ?></p>

							<a href="<?php echo base_url.$rutas[0].'/'.$value["ruta_categoria"]."/".$value["ruta_articulo"]; ?>" class="float-right">Leer Más</a>

							<div class="fecha"><?php 
								$fecha_formateada_articulo = date('Y-m-d', strtotime(str_replace('.', '/', $value["fecha_articulo"])));
								echo $fecha_formateada_articulo; 
							?></div>

						</div>

					</div>

					<hr class="mb-4 mb-lg-5" style="border: 1px solid #c7c7c7">
					
				<?php endforeach ?>

				<div class="container d-none d-md-block">
					
					<ul class="pagination justify-content-center" totalPaginas="<?php echo $totalPaginas; ?>" paginaActual="<?php echo $paginaActual; ?>" rutaPagina="<?php echo $articulos[0]["ruta_categoria"]; ?>"></ul>

				</div>

			</div>

			<!-- COLUMNA DERECHA -->

			<div class="d-none d-md-block pt-md-4 pt-lg-0 col-md-4 col-lg-3">

				<!-- ETIQUETAS -->	

				<div>

					<h4>Etiquetas</h4>
					
										
				</div>	

				<!-- Artículos Destacados -->



				<!-- PUBLICIDAD -->


				
			</div>

		</div>

	</div>

</div>
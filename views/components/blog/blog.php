<?php require_once 'views/components/banner/banner.php' ?>


<!--=====================================
GRID DE CATEGORÍAS
======================================-->

<div class="container-fluid py-2 py-md-5 bg-white grid">

	<div class="container p-0">

		<div class="d-flex">

			<div class="d-flex flex-column columna1">
			
				<figure class="p-2 photo1" vinculo="<?php echo base_url.$rutas[0].'/'.$categorias[0]["ruta_categoria"] ?>" style="background:url(<?php echo base_url.server.$categorias[0]["img_categoria"] ?>)">
					
					<p class="text-uppercase p-1 p-md-3 p-xl-4"><?php echo $categorias[0]["descripcion_categoria"] ?></p>

				</figure>

				<figure class="p-2 photo2" vinculo="<?php echo base_url.$rutas[0].'/'.$categorias[4]["ruta_categoria"] ?>" style="background:url(<?php echo base_url.server.$categorias[4]["img_categoria"] ?>)">
					
					<p class="text-uppercase p-1 p-md-3 p-xl-4"><?php echo $categorias[4]["descripcion_categoria"] ?></p>

				</figure>

				<figure class="d-block d-md-none p-2 photo6" vinculo="<?php echo base_url.$rutas[0].'/'.$categorias[5]["ruta_categoria"] ?>" style="background:url(<?php echo base_url.server.$categorias[5]["img_categoria"] ?>)">
					
					<p class="text-uppercase p-1 p-md-3 p-xl-4"><?php echo $categorias[5]["descripcion_categoria"] ?></p>

				</figure>

			</div>

			<div class="d-flex flex-column flex-fill columna2">

				<div class="d-block d-md-flex">

					<figure class="p-2 flex-fill photo3" vinculo="<?php echo base_url.$rutas[0].'/'.$categorias[1]["ruta_categoria"] ?>" style="background:url(<?php echo base_url.server.$categorias[1]["img_categoria"] ?>)">

						<p class="text-uppercase p-1 p-md-3 p-xl-4"><?php echo $categorias[1]["descripcion_categoria"] ?></p>
						
					</figure>

					<figure class="p-2 flex-fill photo4" vinculo="<?php echo base_url.$rutas[0].'/'.$categorias[3]["ruta_categoria"] ?>" style="background:url(<?php echo base_url.server.$categorias[3]["img_categoria"] ?>)">
						
						<p class="text-uppercase p-1 p-md-3 p-xl-4"><?php echo $categorias[3]["descripcion_categoria"] ?></p>

					</figure>

				</div>

				<figure class="p-2 photo5" vinculo="<?php echo base_url.$rutas[0].'/'.$categorias[2]["ruta_categoria"] ?>" style="background:url(<?php echo base_url.server.$categorias[2]["img_categoria"] ?>)">

					<p class="text-uppercase p-1 p-md-3 p-xl-4"><?php echo $categorias[2]["descripcion_categoria"] ?></p>
					
				</figure>

			</div>

		</div>

	</div>

</div>


<!--=====================================
CONTENIDO INICIO
======================================-->

<div class="container-fluid bg-white contenidoInicio pb-4">
	
	<div class="container">
		
		<div class="row">
			
			<!-- COLUMNA IZQUIERDA -->

			<div class="col-12 col-md-8 col-lg-9 p-0 pr-lg-5">


				<?php foreach ($articulos as $key => $value): ?>
				

					<!-- ARTÍCULOS -->

					<div class="row">
						
						<div class="col-12 col-lg-5">

							<a href="<?php echo base_url.$rutas[0].'/'.$value["ruta_categoria"]."/".$value["ruta_articulo"]; ?>"><h5 class="d-block d-lg-none py-3"><?php echo $value["titulo_articulo"]; ?></h5></a>
				
							<a href="<?php echo base_url.$rutas[0].'/'.$value["ruta_categoria"]."/".$value["ruta_articulo"]; ?>"><img src="<?php echo base_url.server;?><?php echo $value["portada_articulo"]; ?>" alt="<?php echo $value["titulo_articulo"]; ?>" class="img-fluid" width="100%"></a>

						</div>

						<div class="col-12 col-lg-7 introArticulo">
							
							<a href="<?php echo base_url.$rutas[0].'/'.$value["ruta_categoria"]."/".$value["ruta_articulo"]; ?>"><h4 class="d-none d-lg-block"><?php echo $value["titulo_articulo"]; ?></h4></a>
							
							<p class="my-2 my-lg-5"><?php echo $value["descripcion_articulo"]; ?></p>

							<a href="<?php echo base_url.$rutas[0].'/'.$value["ruta_categoria"]."/".$value["ruta_articulo"]; ?>" class="float-right">Leer Más</a>

							<div class="fecha"><?php echo date($value["fecha_articulo"]); ?></div>

						</div>


					</div>

					<hr class="mb-4 mb-lg-5" style="border: 1px solid #c7c7c7">
					
				<?php endforeach ?>

				<div class="container d-none d-md-block">
					
					<ul class="pagination justify-content-center" totalPaginas="<?php echo $totalPaginas; ?>" paginaActual="<?php echo $paginaActual; ?>" rutaPagina></ul>

				</div>

			</div>

		</div>

	</div>

</div>
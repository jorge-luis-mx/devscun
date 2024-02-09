<?php 

    require_once 'config/db.php';
    require_once 'models/pageModel.php';
    require_once 'models/blogModel.php';
    require_once 'config/route.php';

    $objCon = new Config();
    $objPages = new Page($objCon);
    $pages = $objPages->get_pages();
    $arrayPages = [];
    foreach ($pages as $key => $value) {

        array_push($arrayPages, $value['name']);
    }

    $tabla = "articulos";
    $objBlog = new Blog($objCon);
    


    $title = null;
    $description = null;
    $metas = $objPages->get_metas();
   

	if(isset($_GET["route"])){
     

		$rutas = explode("/", $_GET["route"]);
        
        if ($rutas!=null && count($rutas)<=3) {

            
            if(isset($rutas[0]) && !isset($rutas[1])){

                if (in_array($rutas[0],$arrayPages)) {

                    foreach ($metas as $key => $value) {

                        if ($rutas[0]==$value['name']) {
                        
                            $title = $value['title'];
                            $description = $value['description'];
                        }
                    }

                }else{
                    $objController = new pagina404Controller;
                    $objController->index();
                }
                
            }
            

            if(isset($rutas[1])){
              
                $categorias = $objBlog->get_categoria();
                $totalArticulos = $objBlog->mdlMostrarTotalArticulos($tabla, null, null);
                $totalPaginas = ceil(count($totalArticulos)/5);

                

                if(is_numeric($rutas[1])){
    
                    
                    foreach ($categorias as $key => $value) {
                        
                        $title =" DevsCUN | ".$value["descripcion_categoria"];
                        $description = $value["descripcion_categoria"];
    
                        break;
                    }		
                    
                }else{
                    
                    $rutaCategoria = null;

                    if (!is_numeric($rutas[1])) {
                        
                        foreach ($categorias as $key => $value) {

                        
                            if($rutas[1] == $value["ruta_categoria"]){
                                $rutaCategoria = $value["ruta_categoria"];

                                break;
                               
                            }
                           
                        }	

                        if($rutaCategoria!=null){
                            
                            $title = "DevsCUN | ".$value["titulo_categoria"];
                            $description = $value["descripcion_categoria"];

                        }else{
                            
                            $objController = new pagina404Controller;
                            $objController->index();
                        }
                    }

    
                }

            }

            if(isset($rutas[2])){
                

                if(is_numeric($rutas[2])){
    
                    foreach ($categorias as $key => $value) {
                                
                        $title = "DevsCUN | ".$value["descripcion_categoria"];
                        $description = $value["descripcion_categoria"];
    
                        break;
                    }		
                    
                }else{
    
                    foreach ($totalArticulos as $key => $value) {
         
                        if(!is_numeric($rutas[2]) && $rutas[2] == $value["ruta_articulo"]){
                        
                            $title ="DevsCUN | ".$value["titulo_articulo"];
                            $description = $value["descripcion_articulo"];
                            
                            break;
                        }		
                    
                    }
    
                }
    
            }

        }

	}else{

        $title = $metas[0]['title'];
        $description = $metas[0]['description'];
    }

?>
<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title?></title>
    <meta name="description" content="<?=$description?>"/>
    <meta name="keywords" content="DevsCun, Páginas web a la medida, Paginas web en cancun, Paginas web cancun, Creación de paginas web en cancun, Diseño de paginas web en cancun,Tienda online en cancun"/>
    <meta property="og:site_name" content="DevsCun">
    <meta property="og:title" content="<?=$title?>">
    <meta property="og:description" content="<?=$description?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://www.devscun.com/assets/img/logo-devscun.png">
    <meta property="og:url" content="https://www.devscun.com/">

    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url?>assets/img/favicon.ico" /> 
    <link rel="stylesheet" href="<?=base_url?>assets/build/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
    <?php
    //si es blog se carga su propio css y js
	if(isset($_GET["route"])){

        if ($rutas!=null && count($rutas)<=3) {

            if(isset($rutas[0]) && !isset($rutas[1])){

                if (in_array($rutas[0],$arrayPages)) {

                    if ($rutas[0]==='blog') {?>
                        <!--=====================================
                        PLUGINS DE CSS
                        ======================================-->
                        <!-- Latest compiled and minified CSS -->
                        <link rel="stylesheet" href="<?=base_url?>assets/scrip_blog/css/plugins/bootstrap.css">
                        <!-- JdSlider -->
                        <link rel="stylesheet" href="<?php echo  base_url?>assets/scrip_blog/css/plugins/jquery.jdSlider.css">
                        <!--=====================================
                        PLUGINS DE JS
                        ======================================-->
                        <!-- sweetalert -->
                        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <!-- jQuery library -->
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                        <!-- JdSlider -->
                        <script src="<?php echo base_url;?>assets/scrip_blog/js/plugins/jquery.jdSlider-latest.js"></script>
                        <!-- pagination -->
                        <script src="<?php echo base_url?>assets/scrip_blog/js/plugins/pagination.min.js"></script>
                        <!-- Shape Share -->
                        <script src="<?php echo base_url; ?>assets/scrip_blog/js/plugins/shape.share.js"></script>
                        <?php

                    }

                }
                
            }
            if(isset($rutas[1])||isset($rutas[2])){?>
                <!--=====================================
                PLUGINS DE CSS
                ======================================-->
                <!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="<?=base_url?>assets/scrip_blog/css/plugins/bootstrap.css">
                <!-- JdSlider -->
                <link rel="stylesheet" href="<?php echo  base_url?>assets/scrip_blog/css/plugins/jquery.jdSlider.css">
                <!--=====================================
                PLUGINS DE JS
                ======================================-->
                <!-- sweetalert -->
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <!-- jQuery library -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <!-- JdSlider -->
                <script src="<?php echo base_url;?>assets/scrip_blog/js/plugins/jquery.jdSlider-latest.js"></script>
                <!-- pagination -->
                <script src="<?php echo base_url?>assets/scrip_blog/js/plugins/pagination.min.js"></script>
                <!-- Shape Share -->
                <script src="<?php echo base_url; ?>assets/scrip_blog/js/plugins/shape.share.js"></script>
            <?php
            }
        }
	}
    
    
    ?>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9Y3JXMPHFH"></script>
    <script async>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-9Y3JXMPHFH');
    </script>

</head>

<body>
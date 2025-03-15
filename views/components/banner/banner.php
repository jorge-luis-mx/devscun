<?php
$name=null;
if(isset($_GET['route'])){
    
    $rutas = explode("/", $_GET["route"]);

    switch ($_GET['route']) {
        case "paginas-web-cancun":
            $name='Páginas web en cancún';
            $title="Paginas web o Tienda online en Cancún";
            break;
        case "servicios-de-paginas-web-cancun":
            $name='Servicios profesionales
            de diseño web';
            $title="Sevicios de paginas web o tienda online en Cancún";
            break;
        case "precios-de-paginas-web-cancun":
            $name='Precios y Costos de  Desarrollo Web en Cancún';
            $title="Costos de Diseño y Desarrollo Web en Cancún – Tiendas Online y Más";
            break;
        case "nosotros":
            $name='Nosotros';
            $title="Nosotros DevsCun";
            break;
        case "portafolio":
            $name='Portafolio de Diseño y Desarrollo Web - Devscun';
            $title="Portafolio de Diseño y Desarrollo Web en Cancún | DevsCun";
            break;

        case "blog":
            $name='Blog';
            $title="Blog DevsCun";
            break;
        case "contacto":
            $name='Contacto';
            $title="Contacto DevsCun";
            break;
        default:
            $name='Hemos perdido esta pagina';
    }

    if(isset($rutas[1])){
        if(is_numeric($rutas[1])){
            $name='Blog';
            $title="Blog DevsCun";
        }
    }
}

?>
<div class="banner">
    <div class="contenido-banner contenedor">
        <h1 title="<?=$title??null?>"><?=$name;?></h1>
    </div>
</div>
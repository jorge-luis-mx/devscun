<?php
$name=null;
if(isset($_GET['route'])){
    
    switch ($_GET['route']) {
        case "paginas-web-cancun":
            $name='Páginas Web en Cancún';
            $title="Paginas web o Tienda online en Cancún";
            break;
        case "servicios-de-paginas-web-cancun":
            $name='Servicios profesionales
            de diseño web';
            $title="Sevicios de paginas web o tienda online en Cancún";
            break;
        case "precios-de-paginas-web-cancun":
            $name='Precios de paginas web';
            $title="Precios de paginas web o tienda online en Cancún";
            break;
        case "nosotros":
            $name='Nosotros';
            $title="Nosotros DevsCun";
            break;
        case "portafolio":
            $name='Portafolio';
            $title="Portafolio DevsCun";
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
}

?>
<div class="banner">
    <div class="contenido-banner contenedor">
        <h1 title="<?=$title??null?>"><?=$name;?></h1>
    </div>
</div>
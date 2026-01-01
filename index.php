<?php

//controllers
require_once 'controllers/InicioController.php';
require_once 'controllers/ServiciosController.php';
require_once 'controllers/PreciosController.php';
require_once 'controllers/PortafolioController.php';
require_once 'controllers/NosotrosController.php';
require_once 'controllers/PoliticasPrivacidadController.php';
require_once 'controllers/TerminosCondicionesController.php';
require_once 'controllers/ContactoController.php';
require_once 'controllers/EmailController.php';
require_once 'controllers/Pagina404Controller.php';
require_once 'controllers/PaginaCancunController.php';
//blog
require_once 'controllers/BlogController.php';
require_once 'controllers/BlogCategoriaController.php';
require_once 'controllers/blogDetailsController.php';
// require_once 'autoload.php';

require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'views/layout/tag.php';
require_once 'views/components/header/header.php';

//routes
require_once 'routes/routes.php';

require_once 'views/components/footer/footer.php';
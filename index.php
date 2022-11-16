<?php
// Start Session
session_start();
if (!defined('PHPUNIT_COMPOSER_INSTALL')) {
    define('PHPUNIT_COMPOSER_INSTALL', __DIR__ . '/path/to/composer/vendors/dir/autoload.php');
}

// Include Config
require('config.php');

require('classes/Messages.php');
require('classes/Bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');

require('controllers/home.php');
require('controllers/users.php');
require('controllers/menu.php');
require('controllers/solicitudes.php');
require('controllers/oficina.php');
require('controllers/proveedor.php');
require('controllers/orden.php');
require('controllers/factura.php');





require('models/home.php');
require('models/user.php');
require('models/menu.php');
require('models/solicitudes.php');
require('models/oficina.php');
require('models/proveedor.php');
require('models/orden.php');
require('models/factura.php');





$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();
if($controller){
	$controller->executeAction();
}
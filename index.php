<?php

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
*/

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE');
header('content-type: application/json; charset=utf-8');

use src\api\controllers\RepositoryController;
use src\api\controllers\MoneyController;
use src\api\Helpers;

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) require __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
});


$jsondata = file_get_contents('php://input');
$request = isset($jsondata) && !empty($jsondata) ? @json_decode($jsondata, TRUE) : array();

if (isset($jsondata) && !empty($jsondata) && json_last_error() !== JSON_ERROR_NONE) {
    Helpers::returnToAction(Helpers::formatResponse(404, 'Incorrect JSON Format', []));
    return;
}

/*
|--------------------------------------------------------------------------
| Routing
|--------------------------------------------------------------------------
*/
$router = new src\core\Router();

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

$router->any(RepositoryController::class . '::noActionFound');
$router->get('/', RepositoryController::class . '::indexAction');

$router->post('/money/coinchange', MoneyController::class . '::postCoinChange');

// Run
$router->run($request, $_SERVER['REQUEST_METHOD']);

/* Sample routes
$router->get('/products', ProductsController::class . '::getList');
$router->post('/products', ProductsController::class . '::addNew');
$router->post('/', RepositoryController::class . '::indexAction');
*/

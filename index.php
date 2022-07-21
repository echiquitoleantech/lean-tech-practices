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
use src\api\controllers\MathsController;
use src\api\controllers\GeometricFiguresController;
use src\api\controllers\StringsController;
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
| Router
|--------------------------------------------------------------------------
*/

$router = new src\core\Router();

$router->any(RepositoryController::class . '::noActionFound');
$router->get('/', RepositoryController::class . '::indexAction');
$router->get('/money', RepositoryController::class . '::indexAction');
$router->get('/maths', RepositoryController::class . '::indexAction');
$router->get('/strings', RepositoryController::class . '::indexAction');

$router->get('/money/coinchange', MoneyController::class . '::getCoinChange');
$router->get('/maths/calculator', MathsController::class . '::getBasicCalculator');
$router->get('/maths/calcForXNumber', MathsController::class . '::calcMultiplyTableForXNumber');
$router->get('/figures', GeometricFiguresController::class . '::getGeometricFigureData');

$router->get('/strings/phrasevocals', StringsController::class . '::getVocalsData');
$router->get('/strings/reversestring', StringsController::class . '::getReverseString');

$router->run($request, $_SERVER['REQUEST_METHOD']);

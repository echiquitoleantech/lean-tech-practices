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

const ROOT_API_PATH = __DIR__ . '/';

use src\api\controllers\RepositoryController;
use src\api\controllers\MoneyController;
use src\api\controllers\MathsController;
use src\api\controllers\StringsController;
use src\api\controllers\GeometricFiguresController;
use src\api\controllers\ShoppingCartController;
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
$router->get('/figures', RepositoryController::class . '::indexAction');

$router->get('/money/coinchange', MoneyController::class . '::getCoinChange');

$router->get('/maths/calculator', MathsController::class . '::getBasicCalculator');
$router->get('/maths/calcforxnumber', MathsController::class . '::getCalcMultiplicateTableForXNumber');
$router->get('/maths/reordernumbers', MathsController::class . '::getReorderNumbers');

$router->get('/figures/calculateareaandperimeter', GeometricFiguresController::class . '::getCalculateAreaAndPerimeter');

$router->get('/strings/phrasevocals', StringsController::class . '::getVocalsData');
$router->get('/strings/reversestring', StringsController::class . '::getReverseString');
$router->get('/strings/chrtodechexoct', StringsController::class . '::getHexOctBinFromCharacter');
$router->get('/strings/pronunciation', StringsController::class . '::getStringPronunciation');

$router->get('/shoppingcart/details', ShoppingCartController::class . '::getDetails');
$router->post('/shoppingcart/additem', ShoppingCartController::class . '::postItem');
$router->put('/shoppingcart/edititem', ShoppingCartController::class . '::putItem');
$router->patch('/shoppingcart/edititem', ShoppingCartController::class . '::patchItem');
$router->delete('/shoppingcart/delete', ShoppingCartController::class . '::deleteItem');

$router->run($request, $_SERVER['REQUEST_METHOD']);

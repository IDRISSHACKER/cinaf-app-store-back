<?php
declare(strict_types = 1);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Credentials: true');
// header('Access-Control-Max-Age: 86400');  
header("Access-Control-Allow-Methods: *");

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use MyApp\Handlers\MyErrorHandler;
use Slim\Exception\HttpNotFoundException;

use Controller\MainController;
use Controller\SoftwareController;
use Controller\MediaController;
use Controller\CoverController;
use Controller\DownloadedController;
use Controller\VersionController;
use Controller\Auth\LoginController;

require dirname(__DIR__) . '/vendor/autoload.php';


$app = AppFactory::create();

$app->addRoutingMiddleware();
$logger = new Logger('app');
$streamHandler = new StreamHandler(dirname(__DIR__) . '/logs', 100);
$logger->pushHandler($streamHandler);
$app->addErrorMiddleware(true, true, false);

$mainRoutesController = MainController::init()->mainRoutes($app);
$softwareRoutesController = SoftwareController::init()->softwaresRoutes($app);
$mediaRoutesController = MediaController::init()->mediasRoutes($app);
$coverController = CoverController::init()->coverRoutes($app);
$downloadedController = DownloadedController::init()->downloadedRoutes($app);
$versionController = VersionController::init()->versionsRoutes($app);
$loginController = LoginController::init()->authRoutes($app);
/*
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});*/

$app->run();

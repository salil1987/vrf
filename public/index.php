<?php
//die("asdf");
declare(strict_types=1);

use App\Application\Handlers\HttpErrorHandler;
use App\Application\Handlers\ShutdownHandler;
use App\Application\ResponseEmitter\ResponseEmitter;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

require __DIR__ . '/../vendor/autoload.php';
ini_set('display_errors','On');
error_reporting(E_ALL);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/guzzleHelper.php';


$app = AppFactory::create();
$config = new vrConfig();
$ghHelper = new guzzleHelper();

$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Define app routes
$app->get('/{action}', function (Request $request, Response $response, $args) use($config, $ghHelper){

	$guzzlRespose = $ghHelper->send($request, 'GET');
	$response->getBody()->write((string)$guzzlRespose);
	$response = $response->withHeader('Content-Type', 'application/xml');
	return $response;

});

$app->post('/{action}', function (Request $request, Response $response, $args) use($config, $ghHelper){

	$guzzlRespose = $ghHelper->send($request, 'POST');
	$response->getBody()->write((string)$guzzlRespose);
	$response = $response->withHeader('Content-Type', 'application/xml');
	return $response;

});

///TODO make PUT and DELETE calls if required.


$app->run();

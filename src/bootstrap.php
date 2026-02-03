<?php

declare(strict_types=1);


use Doctrine\ORM\EntityManagerInterface;
use Framework\Template\PlatesRenderer;
use Framework\Template\Renderer;
use Framework\Template\RendererInterface;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Router;
use App\Controllers\HomeController;
use App\Controllers\InstellingenController;
use App\Controllers\ProductController;
use App\Controllers\WegenController;
use League\Route\Strategy\ApplicationStrategy;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseFactoryInterface;
use GuzzleHttp\Psr7\HttpFactory;
use League\Route\Strategy\AbstractStrategy;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;
;


ini_set("display_errors", 1);

define("APP_ROOT", dirname(__DIR__));


require APP_ROOT . "/vendor/autoload.php";
$dotenv = Dotenv::createImmutable(APP_ROOT);
$dotenv->load();


$request = ServerRequest::fromGlobals();
$builder = new DI\ContainerBuilder;
$builder->addDefinitions(APP_ROOT . "/config/definitions.php");

$builder->useAttributes(true);
$container = $builder->build();


$router = new Router;

$strategy = new ApplicationStrategy;
$strategy->setContainer($container);
$router->setStrategy($strategy);

$routes = require APP_ROOT . "/config/routes.php";
$routes($router);

$response = $router->dispatch($request);

$emitter = new SapiEmitter();

$emitter->emit($response);

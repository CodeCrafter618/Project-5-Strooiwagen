<?php

declare(strict_types=1);


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
;


ini_set("display_errors", 1);

require dirname(__DIR__) . "/vendor/autoload.php";



$request = ServerRequest::fromGlobals();

$container = new DI\Container([
    ResponseFactoryInterface::class => DI\create(HttpFactory::class)
]);




$router = new Router;

$strategy = new ApplicationStrategy;
$strategy->setContainer($container);
$router->setStrategy($strategy);

$router->get("/", [HomeController::class, "index"]);





$router->get("/products", [ProductController::class, "index"]);

$router->get("/product/{id:number}", [ProductController::class, "show"]);



$router->get("/wegen", [WegenController::class, "wegen"]);




$response = $router->dispatch($request);

$emitter = new SapiEmitter();

$emitter->emit($response);

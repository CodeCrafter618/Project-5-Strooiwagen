<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Router;

ini_set("display_errors", 1);

require dirname(__DIR__) . "/vendor/autoload.php";

$request = ServerRequest::fromGlobals();

$router = new Router;

$router->get("/", function () {
    $stream = Utils::streamFor("homepagina");

    $response = new Response();

    $response = $response->withBody($stream);

    return $response;

});


$router->get("/products", function () {
    $stream = Utils::streamFor("List of Products");

    $response = new Response();

    $response = $response->withBody($stream);

    return $response;

});

$router->get("/product/{id:number}", function ($request, $args) {

    $id = $args["id"];

    $stream = Utils::streamFor("Single product with product ID $id");

    $response = new Response();

    $response = $response->withBody($stream);

    return $response;

});

$router->get("/wegen", function () {
    $stream = Utils::streamFor("Maak hier jouw wegen aan");

    $response = new Response();

    $response = $response->withBody($stream);

    return $response;

});

$router->get("/instellingen", function () {
    $stream = Utils::streamFor("Instelling om te regelen wat er aangepast moet worden hoevaak er gestrooid moet worden");

    $response = new Response();

    $response = $response->withBody($stream);

    return $response;

});


$response = $router->dispatch($request);

$emitter = new SapiEmitter();

$emitter->emit($response);

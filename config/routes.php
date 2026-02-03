<?php
use App\Controllers\HomeController;
use App\Controllers\InstellingenController;
use App\Controllers\ProductController;
use App\Controllers\WegenController;
use League\Route\Router;

return function (Router $router) {

    $router->get("/", [HomeController::class, "index"]);





    $router->get("/products", [ProductController::class, "index"]);

    $router->get("/product/{id:number}", [ProductController::class, "show"]);



    $router->get("/wegen", [WegenController::class, "wegen"]);
    $router->get("/instellingen", [InstellingenController::class, "Instellingen"]);


    $router->map(["GET", "POST"], "/product/new", [ProductController::class, "create"]);

};
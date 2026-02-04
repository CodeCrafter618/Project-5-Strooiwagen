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
    $router->map(["GET", "POST"], "/product/new", [ProductController::class, "create"]);

    // Routes voor Wegen
    $router->get("/wegen", [WegenController::class, "index"]);
    $router->map(["GET", "POST"], "/wegen/new", [WegenController::class, "create"]);
    $router->post("/wegen/edit/{id:number}", [WegenController::class, "update"]);
    $router->post("/wegen/delete/{id:number}", [WegenController::class, "delete"]);

    $router->get("/instellingen", [InstellingenController::class, "Instellingen"]);
};
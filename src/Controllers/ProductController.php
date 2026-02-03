<?php

declare(strict_types=1);

namespace App\Controllers;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Framework\Controller\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use PDO;
use App\Entities\Product;
use Doctrine\ORM\ORMSetup;


class ProductController extends AbstractController
{

    public function index(): ResponseInterface
    {
        $paths = [dirname(__DIR__) . "/src/Entities"];

        $config = ORMSetup::createAttributeMetadataConfiguration($paths, true);


        $params = [
            "driver" => "pdo_mysql",
            "host" => "localhost",
            "dbname" => "zoutstrooimanagment",
            "user" => "root",
            "password" => "ServBay.dev"
        ];
        $connection = DriverManager::getConnection($params, $config);

        $em = new EntityManager($connection, $config);
        $repo = $em->getRepository(Product::class);
        $products = $repo->findAll();

        return $this->render(
            "product/index",
            [
                "products" => $products
            ]
        );



    }

    public function show(ServerRequestInterface $request, array $args): ResponseInterface
    {
        return $this->render("product/show", [
            "id" => $args["id"]
        ]);

    }
}

<?php

declare(strict_types=1);

namespace App\Controllers;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;

class HomeController
{
    public function index(): ResponseInterface
    {
        $stream = Utils::streamFor("Homepage");

        $response = new Response();

        $response = $response->withBody($stream);

        return $response;
    }
}
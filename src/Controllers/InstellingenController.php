<?php

declare(strict_types=1);

namespace App\Controllers;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Utils;

class InstellingenController
{
    public function instellingen(): Response
    {
        $stream = Utils::streamFor("Hier kun je straks de instellingen aanpassen");

        $response = new Response();

        $response = $response->withBody($stream);

        return $response;
    }
}

<?php

declare(strict_types=1);

namespace App\Controllers;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Utils;

class WegenController
{
    public function wegen(): Response
    {
        $stream = Utils::streamFor("Hier zie je straks de wegen");

        $response = new Response();

        $response = $response->withBody($stream);

        return $response;
    }
}

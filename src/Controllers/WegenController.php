<?php

declare(strict_types=1);

namespace App\Controllers;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use GuzzleHttp\Psr7\Utils;
use Nyholm\Psr7\Response as NyholmResponse;
use Psr\Http\Message\ResponseInterface;

class WegenController
{
    public function wegen(): ResponseInterface
    {
        $stream = Utils::streamFor("Hier zie je straks de wegen");

        $response = new GuzzleResponse();

        $response = $response->withBody($stream);

        return $response;
    }
}
<?php

declare(strict_types=1);

namespace App\Controllers;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;


class WegenController
{

    public function __construct(private ResponseFactoryInterface $factory)
    {

    }

    public function wegen(): ResponseInterface
    {

        $stream = $this->factory->createStream("Hier komen straks de wegen te staan");


        $response = $this->factory->createResponse(200);

        $response = $response->withBody($stream);

        return $response;
    }
}
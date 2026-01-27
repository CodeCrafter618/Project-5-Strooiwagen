<?php

declare(strict_types=1);

namespace App\Controllers;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;


class InstellingenController
{

    public function __construct(private ResponseFactoryInterface $factory)
    {

    }

    public function instellingen(): ResponseInterface
    {

        $stream = $this->factory->createStream("Instellingen");


        $response = $this->factory->createResponse(200);

        $response = $response->withBody($stream);

        return $response;
    }
}
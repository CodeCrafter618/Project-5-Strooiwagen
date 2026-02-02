<?php
declare(strict_types=1);

namespace App\Controllers;


use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Framework\Template\RendererInterface;

class InstellingenController
{
    public function __construct(
        private ResponseFactoryInterface $factory,
        private RendererInterface $renderer
    ) {

    }
    public function instellingen(): ResponseInterface
    {
        $contents = $this->renderer->render("instellingen/index");

        $stream = $this->factory->createStream($contents);

        $response = $this->factory->createResponse(200);

        $response = $response->withBody($stream);

        return $response;
    }
}
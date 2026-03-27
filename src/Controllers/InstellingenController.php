<?php
declare(strict_types=1);

namespace App\Controllers;


use Framework\Controller\AbstractController;

use Psr\Http\Message\ResponseInterface;
class InstellingenController extends AbstractController
{
    public function __construct(

        private \DateTime $dt
    ) {

    }
    public function instellingen(): ResponseInterface
    {

        return $this->render("instellingen/index", [
            "name" => $this->dt->format("l")
        ]);
    }
}

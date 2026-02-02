<?php
declare(strict_types=1);

namespace App\Controllers;


use Framework\Controller\AbstractController;

use Psr\Http\Message\ResponseInterface;
class WegenController extends AbstractController
{
    public function __construct(

        private \DateTime $dt
    ) {

    }
    public function wegen(): ResponseInterface
    {

        return $this->render("wegen/index", [
            "name" => $this->dt->format("l")
        ]);
    }
}

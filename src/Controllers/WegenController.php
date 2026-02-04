<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Weg;
use App\Entities\Weersomstandigheid;
use Doctrine\ORM\EntityManagerInterface;
use Framework\Controller\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class WegenController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function index(): ResponseInterface
    {
        $wegen = $this->em->getRepository(Weg::class)->findAll();
        return $this->render("wegen/index", ["wegen" => $wegen]);
    }

    public function update(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $p = $request->getParsedBody();
        $weg = $this->em->find(Weg::class, $args["id"]);

        if ($weg) {
            $weg->setNaam($p['naam']);
            $weg->setLocatie($p['locatie']);
            $weg->setStrooiduur((int) $p['strooiduur']);

            // Verwijder de oude weersinstellingen
            foreach ($weg->getWeersomstandigheden() as $ws) {
                $this->em->remove($ws);
            }
            $this->em->flush();

            // Voeg de nieuwe 3 instellingen toe
            for ($i = 1; $i <= 3; $i++) {
                $ws = new Weersomstandigheid();
                $ws->setWeg($weg);
                $ws->setTemperatuur((int) $p["t$i"]);
                $ws->setFrequentie((int) $p["f$i"]);
                $this->em->persist($ws);
            }
            $this->em->flush();
        }
        return $this->redirect("/wegen");
    }

    public function create(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === "POST") {
            $p = $request->getParsedBody();

            // Check of de weg al bestaat
            $bestaandeWeg = $this->em->getRepository(Weg::class)->findOneBy(['naam' => trim($p['naam'])]);
            if ($bestaandeWeg) {
                return $this->redirect("/wegen");
            }

            $weg = new Weg();
            $weg->setNaam($p['naam']);
            $weg->setLocatie($p['locatie']);
            $weg->setStrooiduur((int) $p['strooiduur']);
            $this->em->persist($weg);
            $this->em->flush();

            for ($i = 1; $i <= 3; $i++) {
                $ws = new Weersomstandigheid();
                $ws->setWeg($weg);
                $ws->setTemperatuur((int) $p["t$i"]);
                $ws->setFrequentie((int) $p["f$i"]);
                $this->em->persist($ws);
            }
            $this->em->flush();

            // Na het opslaan terug naar de lijst
            return $this->redirect("/wegen");
        }
        return $this->render("wegen/new");
    }

    public function delete(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $weg = $this->em->find(Weg::class, $args["id"]);
        if ($weg) {
            $this->em->remove($weg);
            $this->em->flush();
        }
        return $this->redirect("/wegen");
    }
}
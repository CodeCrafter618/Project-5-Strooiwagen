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
        foreach ($wegen as $weg) {
            $temp = $this->fetchTemp($weg->getLocatie());
            if ($temp !== null) {
                $weg->setHuidigeTemperatuur($temp);
            }
        }
        $this->em->flush();
        return $this->render("wegen/index", ["wegen" => $wegen]);
    }

    private function fetchTemp(string $loc): ?float
    {
        $data = @file_get_contents("https://weerlive.nl/api/weerlive_api_v2.php?key=3184bf7422&locatie=" . urlencode($loc));
        $json = json_decode($data, true);
        return isset($json['liveweer'][0]['temp']) ? (float) $json['liveweer'][0]['temp'] : null;
    }

    public function update(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $p = $request->getParsedBody();
        /** @var Weg|null $weg */
        $weg = $this->em->find(Weg::class, $args["id"]);

        if ($weg) {
            // Basis gegevens updaten
            $weg->setNaam($p['naam']);
            $weg->setLocatie($p['locatie']);
            $weg->setWeglengte((int) $p['weglengte']);

            // Verwijder ' min' als die in de input zit (vanwege je view formatting)
            $duur = (int) str_replace(' min', '', (string) $p['strooiduur']);
            $weg->setStrooiduur($duur);

            // Haal de huidige drempels op en verwijder ze
            foreach ($weg->getWeersomstandigheden() as $ws) {
                $this->em->remove($ws);
            }

            // Belangrijk: eerst flushen om ruimte te maken voor de nieuwe drempels 
            // of de collectie legen om duplicate key errors te voorkomen
            $this->em->flush();

            // Voeg de 3 nieuwe drempels toe vanuit het formulier
            for ($i = 1; $i <= 3; $i++) {
                if (isset($p["t$i"]) && isset($p["f$i"])) {
                    $ws = new Weersomstandigheid();
                    $ws->setWeg($weg);
                    $ws->setTemperatuur((int) $p["t$i"]);
                    $ws->setFrequentie((int) $p["f$i"]);
                    $this->em->persist($ws);
                }
            }

            $this->em->flush();
        }

        return $this->redirect("/wegen");
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

    public function create(ServerRequestInterface $request): ResponseInterface
    {
        if ($request->getMethod() === "POST") {
            $p = $request->getParsedBody();

            if ($this->em->getRepository(Weg::class)->findOneBy(['naam' => $p['naam']])) {
                return $this->redirect("/wegen/new?error=exists");
            }

            $weg = new Weg();
            $weg->setNaam($p['naam']);
            $weg->setLocatie($p['locatie']);
            $weg->setWeglengte((int) $p['weglengte']);
            $weg->setStrooiduur((int) $p['strooiduur']);
            $weg->setHuidigeTemperatuur($this->fetchTemp($p['locatie']));

            $this->em->persist($weg);

            for ($i = 1; $i <= 3; $i++) {
                $ws = new Weersomstandigheid();
                $ws->setWeg($weg);
                $ws->setTemperatuur((int) $p["t$i"]);
                $ws->setFrequentie((int) $p["f$i"]);
                $this->em->persist($ws);
            }

            $this->em->flush();
            return $this->redirect("/wegen");
        }
        return $this->render("wegen/new");
    }
}
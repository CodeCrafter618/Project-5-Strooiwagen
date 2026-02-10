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
        $apiKey = $_ENV['WEERLIVE_API_KEY'];

        $url = "https://weerlive.nl/api/weerlive_api_v2.php?key=" . $apiKey . "&locatie=" . urlencode($loc);
        $response = @file_get_contents($url);

        if ($response === false || trim($response) === '') {
            error_log('WegenController::fetchTemp - empty response for URL: ' . $url);
            return null;
        }

        $json = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log('WegenController::fetchTemp - json_decode error: ' . json_last_error_msg());
            return null;
        }

        return isset($json['liveweer'][0]['temp']) ? (float) $json['liveweer'][0]['temp'] : null;
    }

    private function containsDigits(string $value): bool
    {
        return preg_match('/\d/', $value) === 1;
    }

    public function update(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $p = $request->getParsedBody();
        $naam = trim((string) ($p['naam'] ?? ''));
        $locatie = trim((string) ($p['locatie'] ?? ''));

        if ($naam === '' || $locatie === '' || $this->containsDigits($locatie)) {
            return $this->redirect("/wegen?error=invalid");
        }
        $weg = $this->em->find(Weg::class, $args["id"]);

        $existing = $this->em->getRepository(Weg::class)->findOneBy(['naam' => $naam]);
        if ($existing && $weg && $existing->getId() !== $weg->getId()) {
            return $this->redirect("/wegen?error=exists");
        }

        if ($weg) {
            $weg->setNaam($naam);
            $weg->setLocatie($locatie);
            $lengte = (int) str_replace(' km', '', (string) $p['weglengte']);
            $weg->setWeglengte($lengte);

            $duur = (int) str_replace(' min', '', (string) $p['strooiduur']);
            $weg->setStrooiduur($duur);

            foreach ($weg->getWeersomstandigheden() as $ws) {
                $this->em->remove($ws);
            }

            $this->em->flush();

            for ($i = 1; $i <= 3; $i++) {
                if (isset($p["t$i"]) && isset($p["f$i"])) {
                    $ws = new Weersomstandigheid();
                    $ws->setWeg($weg);
                    $ws->setTemperatuur((int) $p["t$i"]);
                    $freq = (int) str_replace(' x gestrooid worden', '', (string) $p["f$i"]);
                    $ws->setFrequentie($freq);
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
            $naam = trim((string) ($p['naam'] ?? ''));
            $locatie = trim((string) ($p['locatie'] ?? ''));

            if ($naam === '' || $locatie === '' || $this->containsDigits($locatie)) {
                return $this->redirect("/wegen/new?error=invalid");
            }

            if ($this->em->getRepository(Weg::class)->findOneBy(['naam' => $naam])) {
                return $this->redirect("/wegen/new?error=exists");
            }

            $weg = new Weg();
            $weg->setNaam($naam);
            $weg->setLocatie($locatie);
            $weg->setWeglengte((int) $p['weglengte']);
            $weg->setStrooiduur((int) $p['strooiduur']);
            $weg->setHuidigeTemperatuur($this->fetchTemp($locatie));

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
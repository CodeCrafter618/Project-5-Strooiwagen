<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Entities\Weg;
use Doctrine\ORM\EntityManagerInterface;
use Framework\Controller\AbstractController;
use Psr\Http\Message\ResponseInterface;

class HomeController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em, private \DateTime $dt)
    {
    }

    public function index(): ResponseInterface
    {
        $url = "https://weerlive.nl/api/weerlive_api_v2.php?key=3184bf7422&locatie=Sneek";
        $response = @file_get_contents($url);
        $data = json_decode($response, true);
        $weer = $data['liveweer'][0] ?? null;
        $huidigeTemp = (float) ($weer['temp'] ?? 0);

        $snelheid = 40;
        $totaalWagensExact = 0.0;
        $wegen = $this->em->getRepository(Weg::class)->findAll();

        foreach ($wegen as $weg) {
            $frequentie = 0;
            $wsCollectie = $weg->getWeersomstandigheden()->toArray();

            // Sorteren van hoog naar laag (bijv: 0, -5, -10)
            usort($wsCollectie, fn($a, $b) => $b->getTemperatuur() <=> $a->getTemperatuur());

            foreach ($wsCollectie as $ws) {
                // Pakt de frequentie als temp lager/gelijk is aan de drempel
                if ($huidigeTemp <= $ws->getTemperatuur()) {
                    $frequentie = $ws->getFrequentie();
                }
            }

            if ($frequentie > 0) {
                $tijdUur = $weg->getStrooiduur() / 60;
                $totaalWagensExact += $weg->getWeglengte() / ($snelheid * $tijdUur * $frequentie);
            }
        }

        return $this->render("home/index", [
            "weer" => $weer,
            "aantalWagens" => (int) ceil($totaalWagensExact),
            "datum" => $this->dt->format("d-m-Y")
        ]);
    }
}
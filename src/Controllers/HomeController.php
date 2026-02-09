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
        // De URL opbouwen met de gegevens uit de ENV
        $url = $_ENV['WEERLIVE_API_URL'] . "?key=" . $_ENV['WEERLIVE_API_KEY'] . "&locatie=" . $_ENV['WEERLIVE_LOCATIE'];
        $response = @file_get_contents($url);
        $data = json_decode($response, true);
        // Ensure $weer is always an array to avoid view errors (used for global/default display)
        $weer = $data['liveweer'][0] ?? [];

        $totaalWagensExact = 0.0;
        $wegen = $this->em->getRepository(Weg::class)->findAll();

        foreach ($wegen as $weg) {
            // Fetch weather for the specific road location; fall back to global if unavailable
            $wegUrl = $_ENV['WEERLIVE_API_URL'] . "?key=" . $_ENV['WEERLIVE_API_KEY'] . "&locatie=" . urlencode($weg->getLocatie());
            $wegResponse = @file_get_contents($wegUrl);
            $wegData = [];
            if ($wegResponse !== false && trim($wegResponse) !== '') {
                $wegData = json_decode($wegResponse, true) ?: [];
            }
            $wegWeer = $wegData['liveweer'][0] ?? [];
            $huidigeTemp = (float) ($wegWeer['temp'] ?? $weer['temp'] ?? 0);

            // Store the location-specific temperature on the entity
            $weg->setHuidigeTemperatuur($huidigeTemp);

            $frequentie = 0;
            $wsCollectie = $weg->getWeersomstandigheden()->toArray();

            // Sorteren van hoog naar laag (bijv: 0, -5, -10)
            usort($wsCollectie, fn($a, $b) => $b->getTemperatuur() <=> $a->getTemperatuur());

            foreach ($wsCollectie as $ws) {
                // Pakt de frequentie als temp lager/gelijk is aan de drempel
                if ($huidigeTemp <= $ws->getTemperatuur()) {
                    $frequentie = $ws->getFrequentie();
                    break; // use the first (highest) matching threshold
                }
            }

            if ($frequentie > 0) {
                $workdayMinutes = 480; // 8 uur = 480 minuten
                // $weg->getStrooiduur() geeft strooiduur in minuten
                $totaalWagensExact += ($frequentie * $weg->getStrooiduur()) / $workdayMinutes;
            }
        }

        return $this->render("home/index", [
            "weer" => $weer,
            "aantalWagens" => (int) ceil($totaalWagensExact),
            "datum" => $this->dt->format("d-m-Y")
        ]);
    }
}
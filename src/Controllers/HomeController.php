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
        $url = $_ENV['WEERLIVE_API_URL'] . "?key=" . $_ENV['WEERLIVE_API_KEY'] . "&locatie=" . $_ENV['WEERLIVE_LOCATIE'];
        $response = @file_get_contents($url);
        $data = json_decode($response, true);
        $weer = $data['liveweer'][0] ?? [];

        $totaalWagensExact = 0.0;
        $wegen = $this->em->getRepository(Weg::class)->findAll();

        foreach ($wegen as $weg) {
            $wegUrl = $_ENV['WEERLIVE_API_URL'] . "?key=" . $_ENV['WEERLIVE_API_KEY'] . "&locatie=" . urlencode($weg->getLocatie());
            $wegResponse = @file_get_contents($wegUrl);
            $wegData = [];
            if ($wegResponse !== false && trim($wegResponse) !== '') {
                $wegData = json_decode($wegResponse, true) ?: [];
            }
            $wegWeer = $wegData['liveweer'][0] ?? [];
            $huidigeTemp = (float) ($wegWeer['temp'] ?? $weer['temp'] ?? 0);

            $weg->setHuidigeTemperatuur($huidigeTemp);

            $frequentie = 0;
            $wsCollectie = $weg->getWeersomstandigheden()->toArray();

            usort($wsCollectie, fn($a, $b) => $b->getTemperatuur() <=> $a->getTemperatuur());

            foreach ($wsCollectie as $ws) {
                if ($huidigeTemp <= $ws->getTemperatuur()) {
                    $frequentie = $ws->getFrequentie();
                    break;
                }
            }

            if ($frequentie > 0) {
                $workdayMinutes = 480;
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
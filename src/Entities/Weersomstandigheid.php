<?php
declare(strict_types=1);

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "weersomstandigheden")]
class Weersomstandigheid
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Weg::class, inversedBy: "weersomstandigheden")]
    #[ORM\JoinColumn(name: "weg_id", referencedColumnName: "id")]
    private Weg $weg;

    #[ORM\Id] #[ORM\Column(type: "integer")]
    private int $temperatuur;

    #[ORM\Column(type: "integer")]
    private int $frequentie;

    public function getWeg(): Weg
    {
        return $this->weg;
    }
    public function setWeg(Weg $weg): void
    {
        $this->weg = $weg;
    }
    public function getTemperatuur(): int
    {
        return $this->temperatuur;
    }
    public function setTemperatuur(int $temp): void
    {
        $this->temperatuur = $temp;
    }
    public function getFrequentie(): int
    {
        return $this->frequentie;
    }
    public function setFrequentie(int $freq): void
    {
        $this->frequentie = $freq;
    }
}
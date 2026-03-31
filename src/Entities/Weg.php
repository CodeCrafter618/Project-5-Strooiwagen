<?php
declare(strict_types=1);

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "wegen")]
class Weg
{
    #[ORM\Id] #[ORM\GeneratedValue] #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", unique: true)]
    private string $naam;

    #[ORM\Column(type: "string")]
    private string $locatie;

    #[ORM\Column(type: "integer")]
    private int $weglengte = 0;

    #[ORM\Column(type: "integer")]
    private int $strooiduur;

    #[ORM\Column(type: "float", nullable: true)]
    private ?float $huidige_temperatuur = null;

    #[ORM\OneToMany(mappedBy: "weg", targetEntity: Weersomstandigheid::class, cascade: ["persist", "remove"])]
    private Collection $weersomstandigheden;

    public function __construct()
    {
        $this->weersomstandigheden = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getNaam(): string
    {
        return $this->naam;
    }
    public function setNaam(string $naam): void
    {
        $this->naam = $naam;
    }
    public function getLocatie(): string
    {
        return $this->locatie;
    }
    public function setLocatie(string $locatie): void
    {
        $this->locatie = $locatie;
    }
    public function getWeglengte(): int
    {
        return $this->weglengte;
    }
    public function setWeglengte(int $weglengte): void
    {
        $this->weglengte = $weglengte;
    }
    public function getStrooiduur(): int
    {
        return $this->strooiduur;
    }
    public function setStrooiduur(int $strooiduur): void
    {
        $this->strooiduur = $strooiduur;
    }
    public function getHuidigeTemperatuur(): ?float
    {
        return $this->huidige_temperatuur;
    }
    public function setHuidigeTemperatuur(?float $temp): void
    {
        $this->huidige_temperatuur = $temp;
    }
    public function getWeersomstandigheden(): Collection
    {
        return $this->weersomstandigheden;
    }
}
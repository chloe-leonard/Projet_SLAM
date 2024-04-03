<?php

namespace App\Entity;

use App\Repository\SignalementCompteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SignalementCompteRepository::class)]
class SignalementCompte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'signalementComptes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $IDSignaleur = null;

    #[ORM\ManyToOne(inversedBy: 'signalementComptes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $IDUserSignale = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDSignaleur(): ?User
    {
        return $this->IDSignaleur;
    }

    public function setIDSignaleur(?User $IDSignaleur): static
    {
        $this->IDSignaleur = $IDSignaleur;

        return $this;
    }

    public function getIDUserSignale(): ?User
    {
        return $this->IDUserSignale;
    }

    public function setIDUserSignale(?User $IDUserSignale): static
    {
        $this->IDUserSignale = $IDUserSignale;

        return $this;
    }
}

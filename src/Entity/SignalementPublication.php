<?php

namespace App\Entity;

use App\Repository\SignalementPublicationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SignalementPublicationRepository::class)]
class SignalementPublication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'signalementPublications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $IDSignaleur = null;

    #[ORM\ManyToOne(inversedBy: 'signalementPublications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Publication $IDPublication = null;

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

    public function getIDPublication(): ?Publication
    {
        return $this->IDPublication;
    }

    public function setIDPublication(?Publication $IDPublication): static
    {
        $this->IDPublication = $IDPublication;

        return $this;
    }
}

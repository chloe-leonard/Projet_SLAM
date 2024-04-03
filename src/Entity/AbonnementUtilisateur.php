<?php

namespace App\Entity;

use App\Repository\AbonnementUtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbonnementUtilisateurRepository::class)]
class AbonnementUtilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'abonnementUtilisateurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $IDUtilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'abonnementUtilisateurs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $IDAbonne = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDUtilisateur(): ?User
    {
        return $this->IDUtilisateur;
    }

    public function setIDUtilisateur(?User $IDUtilisateur): static
    {
        $this->IDUtilisateur = $IDUtilisateur;

        return $this;
    }

    public function getIDAbonne(): ?User
    {
        return $this->IDAbonne;
    }

    public function setIDAbonne(?User $IDAbonne): static
    {
        $this->IDAbonne = $IDAbonne;

        return $this;
    }
}

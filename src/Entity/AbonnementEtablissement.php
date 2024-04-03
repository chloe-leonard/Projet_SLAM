<?php

namespace App\Entity;

use App\Repository\AbonnementEtablissementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbonnementEtablissementRepository::class)]
class AbonnementEtablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'abonnementEtablissements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $IDUtilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'abonnementEtablissements')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etablissement $IDEtablissement = null;

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

    public function getIDEtablissement(): ?Etablissement
    {
        return $this->IDEtablissement;
    }

    public function setIDEtablissement(?Etablissement $IDEtablissement): static
    {
        $this->IDEtablissement = $IDEtablissement;

        return $this;
    }
}

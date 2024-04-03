<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LieuRepository::class)]
class Lieu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $CodePostal = null;

    #[ORM\Column(length: 200)]
    private ?string $Ville = null;

    #[ORM\Column(length: 150)]
    private ?string $Pays = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodePostal(): ?string
    {
        return $this->CodePostal;
    }

    public function setCodePostal(string $CodePostal): static
    {
        $this->CodePostal = $CodePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): static
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): static
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getAjoutEtablissement(): ?AjoutEtablissement
    {
        return $this->ajoutEtablissement;
    }

    public function setAjoutEtablissement(AjoutEtablissement $ajoutEtablissement): static
    {
        // set the owning side of the relation if necessary
        if ($ajoutEtablissement->getIDLieu() !== $this) {
            $ajoutEtablissement->setIDLieu($this);
        }

        $this->ajoutEtablissement = $ajoutEtablissement;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 250)]
    private ?string $NomEtablissement = null;

    #[ORM\ManyToOne(targetEntity: Lieu::class, cascade: ['persist'])]
    #[ORM\JoinColumn(name: "id_lieu", referencedColumnName: "id", nullable: false)]
    private ?Lieu $IDLieu = null;

    #[ORM\OneToMany(mappedBy: 'IDEtablissement', targetEntity: AbonnementEtablissement::class)]
    private Collection $abonnementEtablissements;

    public function __construct()
    {
        $this->abonnementEtablissements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtablissement(): ?string
    {
        return $this->NomEtablissement;
    }

    public function setNomEtablissement(string $NomEtablissement): static
    {
        $this->NomEtablissement = $NomEtablissement;

        return $this;
    }

    public function getIDLieu(): ?Lieu
    {
        return $this->IDLieu;
    }

    public function setIDLieu(Lieu $IDLieu): static
    {
        $this->IDLieu = $IDLieu;

        return $this;
    }

    /**
     * @return Collection<int, AbonnementEtablissement>
     */
    public function getAbonnementEtablissements(): Collection
    {
        return $this->abonnementEtablissements;
    }

    public function addAbonnementEtablissement(AbonnementEtablissement $abonnementEtablissement): static
    {
        if (!$this->abonnementEtablissements->contains($abonnementEtablissement)) {
            $this->abonnementEtablissements->add($abonnementEtablissement);
            $abonnementEtablissement->setIDEtablissement($this);
        }

        return $this;
    }

    public function removeAbonnementEtablissement(AbonnementEtablissement $abonnementEtablissement): static
    {
        if ($this->abonnementEtablissements->removeElement($abonnementEtablissement)) {
            // set the owning side to null (unless already changed)
            if ($abonnementEtablissement->getIDEtablissement() === $this) {
                $abonnementEtablissement->setIDEtablissement(null);
            }
        }

        return $this;
    }
}

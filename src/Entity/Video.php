<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Publication $IDPublication = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $Lien = null;

    #[ORM\Column]
    private ?int $NumLien = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLien(): ?string
    {
        return $this->Lien;
    }

    public function setLien(string $Lien): static
    {
        $this->Lien = $Lien;

        return $this;
    }

    public function getNumLien(): ?int
    {
        return $this->NumLien;
    }

    public function setNumLien(int $NumLien): static
    {
        $this->NumLien = $NumLien;

        return $this;
    }
}

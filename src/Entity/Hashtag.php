<?php

namespace App\Entity;

use App\Repository\HashtagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HashtagRepository::class)]
class Hashtag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $Nom = null;

    #[ORM\ManyToOne(inversedBy: 'hashtags')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Publication $IDPublication = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

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

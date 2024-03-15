<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Response;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity:"App\Entity\Publication", inversedBy: 'images', cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Publication $IDPublication = null;

    #[ORM\Column] //(type: Types::BINARY)
    private ?string $photo = null;

    #[ORM\Column]
    private ?int $num_image = null;

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

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): static
    {
        $this->photo = $photo;
        return $this;
    }

    public function getNumImage(): ?int
    {
        return $this->num_image;
    }

    public function setNumImage(int $num_image): static
    {
        $this->num_image = $num_image;

        return $this;
    }
}

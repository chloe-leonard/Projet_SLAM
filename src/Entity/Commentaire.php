<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $IDUtilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Publication $IDPublication = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
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

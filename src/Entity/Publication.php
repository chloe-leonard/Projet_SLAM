<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicationRepository::class)]
class Publication
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'publications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $IDUtilisateur = null;

    #[ORM\Column(length: 200)]
    private ?string $Titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $DateHeure = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $DureeRetard = null;

    #[ORM\OneToMany(mappedBy: 'IDPublication', targetEntity: Image::class, orphanRemoval: true)]
    private Collection $images;

    #[ORM\OneToMany(mappedBy: 'IDPublication', targetEntity: Hashtag::class)]
    private Collection $hashtags;

    #[ORM\OneToMany(mappedBy: 'IDPublication', targetEntity: Video::class, orphanRemoval: true)]
    private Collection $videos;

    #[ORM\OneToMany(mappedBy: 'IDPublication', targetEntity: Commentaire::class)]
    private Collection $commentaires;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->hashtags = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

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

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): static
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): static
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->DateHeure;
    }

    public function setDateHeure(\DateTimeInterface $DateHeure): static
    {
        $this->DateHeure = $DateHeure;

        return $this;
    }

    public function getDureeRetard(): ?\DateTimeInterface
    {
        return $this->DureeRetard;
    }

    public function setDureeRetard(\DateTimeInterface $DureeRetard): static
    {
        $this->DureeRetard = $DureeRetard;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function setImages(string $images): static
    {
        $this->Images = $images;

        return $this;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setIDPublication($this);
        }

        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getIDPublication() === $this) {
                $image->setIDPublication(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Hashtag>
     */
    public function getHashtags(): Collection
    {
        return $this->hashtags;
    }

    public function addHashtag(Hashtag $hashtag): static
    {
        if (!$this->hashtags->contains($hashtag)) {
            $this->hashtags->add($hashtag);
            $hashtag->setIDPublication($this);
        }

        return $this;
    }

    public function removeHashtag(Hashtag $hashtag): static
    {
        if ($this->hashtags->removeElement($hashtag)) {
            // set the owning side to null (unless already changed)
            if ($hashtag->getIDPublication() === $this) {
                $hashtag->setIDPublication(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Video>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): static
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
            $video->setIDPublication($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): static
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getIDPublication() === $this) {
                $video->setIDPublication(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setIDPublication($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getIDPublication() === $this) {
                $commentaire->setIDPublication(null);
            }
        }

        return $this;
    }

}

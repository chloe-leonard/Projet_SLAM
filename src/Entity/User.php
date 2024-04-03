<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Nom = null;

    #[ORM\Column(length: 50)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $Pseudo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $Bio = null;

    #[ORM\Column(type: Types::BINARY, nullable: true)]
    private $Avatar = null;

    #[ORM\Column(length: 150)]
    private ?string $mail = null;

    #[ORM\Column(length: 100)]
    private ?string $MotDePasse = null;

    #[ORM\Column(nullable: true)]
    private ?int $nb_signalement = null;

    #[ORM\Column(nullable: true)]
    private ?int $id_etablissement = null;
/*
    #[ORM\Column(nullable: true)]
    private ?int $Id_ajout_etablissmeent = null;

    #[ORM\Column(type: 'string', length: 100)]
    private $resetToken;
*/
    #[ORM\OneToMany(mappedBy: 'IDUtilisateur', targetEntity: Publication::class)]
    private Collection $publications;

    #[ORM\OneToMany(mappedBy: 'IDUtilisateur', targetEntity: Commentaire::class)]
    private Collection $commentaires;
/*
    #[ORM\OneToOne(mappedBy: 'IDUtilisateur', cascade: ['persist', 'remove'])]
    private ?AjoutEtablissement $ajoutEtablissement = null;
*/
    #[ORM\Column(type: Types::DATETIME_MUTABLE )]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\PrePersist]
    public function prePersist() : void
    {
        $this->dateCreation = new \DateTime();
    }

    #[ORM\OneToMany(mappedBy: 'IDSignaleur', targetEntity: SignalementPublication::class)]
    private Collection $signalementPublications;

    #[ORM\OneToMany(mappedBy: 'IDSignaleur', targetEntity: SignalementCompte::class)]
    private Collection $signalementComptes;

    #[ORM\OneToMany(mappedBy: 'IDUtilisateur', targetEntity: AbonnementUtilisateur::class)]
    private Collection $abonnementUtilisateurs;

    #[ORM\OneToMany(mappedBy: 'IDUtilisateur', targetEntity: AbonnementEtablissement::class)]
    private Collection $abonnementEtablissements;

    public function __construct()
    {
        $this->publications = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->signalementPublications = new ArrayCollection();
        $this->signalementComptes = new ArrayCollection();
        $this->abonnementUtilisateurs = new ArrayCollection();
        $this->abonnementEtablissements = new ArrayCollection();
    }

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

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->Pseudo;
    }

    public function setPseudo(string $Pseudo): static
    {
        $this->Pseudo = $Pseudo;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->Bio;
    }

    public function setBio(?string $Bio): static
    {
        $this->Bio = $Bio;

        return $this;
    }

    public function getAvatar()
    {
        return $this->Avatar;
    }

    public function setAvatar($Avatar): static
    {
        $this->Avatar = $Avatar;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->MotDePasse;
    }

    public function setMotDePasse(string $MotDePasse): static
    {
        $this->MotDePasse = $MotDePasse;

        return $this;
    }

    public function getNbSignalement(): ?int
    {
        return $this->nb_signalement;
    }

    public function setNbSignalement(?int $nb_signalement): static
    {
        $this->nb_signalement = $nb_signalement;

        return $this;
    }

    public function getIdEtablissement(): ?int
    {
        return $this->id_etablissement;
    }

    public function setIdEtablissement(int $id_etablissement): static
    {
        $this->id_etablissement = $id_etablissement;

        return $this;
    }
/*
    public function getIdAjoutEtablissmeent(): ?int
    {
        return $this->Id_ajout_etablissmeent;
    }

    public function setIdAjoutEtablissmeent(int $Id_ajout_etablissmeent): static
    {
        $this->Id_ajout_etablissmeent = $Id_ajout_etablissmeent;

        return $this;
    }
*/
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->mail;
    }

    public function eraseCredentials()
    {
        // Si vous stockez des données temporaires sensibles sur l'utilisateur, effacez-les ici
        // $this->plainPassword = null;
    }

    public function getPassword(): ?string
    {
        return $this->MotDePasse; // Assurez-vous que le nom de votre propriété est correct
    }

    public function getSalt(): ?string
    {
        // Vous pouvez retourner null si vous utilisez l'encoder de mot de passe par défaut de Symfony
        return null;
    }

    public function getUsername(): string
    {
        return $this->mail; // Assurez-vous que le nom de votre propriété est correct
    }
/*
    public function getResetToken(): ?string
    {
        return $this->resetToken;
    }

    public function setResetToken(?string $resetToken): self
    {
        $this->resetToken = $resetToken;

        return $this;
    }
*/
    /**
     * @return Collection<int, Publication>
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publication $publication): static
    {
        if (!$this->publications->contains($publication)) {
            $this->publications->add($publication);
            $publication->setIDUtilisateur($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): static
    {
        if ($this->publications->removeElement($publication)) {
            // set the owning side to null (unless already changed)
            if ($publication->getIDUtilisateur() === $this) {
                $publication->setIDUtilisateur(null);
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
            $commentaire->setIDUtilisateur($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getIDUtilisateur() === $this) {
                $commentaire->setIDUtilisateur(null);
            }
        }

        return $this;
    }

    public function getAjoutEtablissement(): ?AjoutEtablissement
    {
        return $this->ajoutEtablissement;
    }

    public function setAjoutEtablissement(AjoutEtablissement $ajoutEtablissement): static
    {
        // set the owning side of the relation if necessary
        if ($ajoutEtablissement->getIDUtilisateur() !== $this) {
            $ajoutEtablissement->setIDUtilisateur($this);
        }

        $this->ajoutEtablissement = $ajoutEtablissement;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * @return Collection<int, SignalementPublication>
     */
    public function getSignalementPublications(): Collection
    {
        return $this->signalementPublications;
    }

    public function addSignalementPublication(SignalementPublication $signalementPublication): static
    {
        if (!$this->signalementPublications->contains($signalementPublication)) {
            $this->signalementPublications->add($signalementPublication);
            $signalementPublication->setIDSignaleur($this);
        }

        return $this;
    }

    public function removeSignalementPublication(SignalementPublication $signalementPublication): static
    {
        if ($this->signalementPublications->removeElement($signalementPublication)) {
            // set the owning side to null (unless already changed)
            if ($signalementPublication->getIDSignaleur() === $this) {
                $signalementPublication->setIDSignaleur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, SignalementCompte>
     */
    public function getSignalementComptes(): Collection
    {
        return $this->signalementComptes;
    }

    public function addSignalementCompte(SignalementCompte $signalementCompte): static
    {
        if (!$this->signalementComptes->contains($signalementCompte)) {
            $this->signalementComptes->add($signalementCompte);
            $signalementCompte->setIDSignaleur($this);
        }

        return $this;
    }

    public function removeSignalementCompte(SignalementCompte $signalementCompte): static
    {
        if ($this->signalementComptes->removeElement($signalementCompte)) {
            // set the owning side to null (unless already changed)
            if ($signalementCompte->getIDSignaleur() === $this) {
                $signalementCompte->setIDSignaleur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AbonnementUtilisateur>
     */
    public function getAbonnementUtilisateurs(): Collection
    {
        return $this->abonnementUtilisateurs;
    }

    public function addAbonnementUtilisateur(AbonnementUtilisateur $abonnementUtilisateur): static
    {
        if (!$this->abonnementUtilisateurs->contains($abonnementUtilisateur)) {
            $this->abonnementUtilisateurs->add($abonnementUtilisateur);
            $abonnementUtilisateur->setIDUtilisateur($this);
        }

        return $this;
    }

    public function removeAbonnementUtilisateur(AbonnementUtilisateur $abonnementUtilisateur): static
    {
        if ($this->abonnementUtilisateurs->removeElement($abonnementUtilisateur)) {
            // set the owning side to null (unless already changed)
            if ($abonnementUtilisateur->getIDUtilisateur() === $this) {
                $abonnementUtilisateur->setIDUtilisateur(null);
            }
        }

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
            $abonnementEtablissement->setIDUtilisateur($this);
        }

        return $this;
    }

    public function removeAbonnementEtablissement(AbonnementEtablissement $abonnementEtablissement): static
    {
        if ($this->abonnementEtablissements->removeElement($abonnementEtablissement)) {
            // set the owning side to null (unless already changed)
            if ($abonnementEtablissement->getIDUtilisateur() === $this) {
                $abonnementEtablissement->setIDUtilisateur(null);
            }
        }

        return $this;
    }

}

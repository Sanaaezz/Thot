<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'Compte déja existant')]
#[UniqueEntity(fields: ['nomdeplume_utilisateur'], message: 'Nom de plume déjà pris')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $rgpd_utilisateur = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nom_utilisateur = null;

    #[ORM\Column(length: 50)]
    private ?string $nomdeplume_utilisateur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $presentation_utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    private ?Avatar $avoir = null;

    /**
     * @var Collection<int, Commentaire>
     */
    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'utilisateur')]
    private Collection $auteur;

    /**
     * @var Collection<int, Article>
     */
    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'utilisateur', orphanRemoval: true)]
    private Collection $ecrire;

    public function __construct()
    {
        $this->auteur = new ArrayCollection();
        $this->ecrire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getRgpdUtilisateur(): ?\DateTimeInterface
    {
        return $this->rgpd_utilisateur;
    }

    public function setRgpdUtilisateur(\DateTimeInterface $rgpd_utilisateur): static
    {
        $this->rgpd_utilisateur = $rgpd_utilisateur;

        return $this;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nom_utilisateur;
    }

    public function setNomUtilisateur(?string $nom_utilisateur): static
    {
        $this->nom_utilisateur = $nom_utilisateur;

        return $this;
    }

    public function getNomdeplumeUtilisateur(): ?string
    {
        return $this->nomdeplume_utilisateur;
    }

    public function setNomdeplumeUtilisateur(string $nomdeplume_utilisateur): static
    {
        $this->nomdeplume_utilisateur = $nomdeplume_utilisateur;

        return $this;
    }

    public function getPresentationUtilisateur(): ?string
    {
        return $this->presentation_utilisateur;
    }

    public function setPresentationUtilisateur(?string $presentation_utilisateur): static
    {
        $this->presentation_utilisateur = $presentation_utilisateur;

        return $this;
    }

    public function getAvoir(): ?Avatar
    {
        return $this->avoir;
    }

    public function setAvoir(?Avatar $avoir): static
    {
        $this->avoir = $avoir;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getAuteur(): Collection
    {
        return $this->auteur;
    }

    public function addAuteur(Commentaire $auteur): static
    {
        if (!$this->auteur->contains($auteur)) {
            $this->auteur->add($auteur);
            $auteur->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAuteur(Commentaire $auteur): static
    {
        if ($this->auteur->removeElement($auteur)) {
            // set the owning side to null (unless already changed)
            if ($auteur->getUtilisateur() === $this) {
                $auteur->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getEcrire(): Collection
    {
        return $this->ecrire;
    }

    public function addEcrire(Article $ecrire): static
    {
        if (!$this->ecrire->contains($ecrire)) {
            $this->ecrire->add($ecrire);
            $ecrire->setUtilisateur($this);
        }

        return $this;
    }

    public function removeEcrire(Article $ecrire): static
    {
        if ($this->ecrire->removeElement($ecrire)) {
            // set the owning side to null (unless already changed)
            if ($ecrire->getUtilisateur() === $this) {
                $ecrire->setUtilisateur(null);
            }
        }

        return $this;
    }
}

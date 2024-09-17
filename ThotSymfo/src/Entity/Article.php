<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups('api_recherche')]
    #[ORM\Column(length: 50)]
    private ?string $titre_article = null;

    #[Groups('api_recherche')]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $texte_article = null;

    #[Groups('api_recherche')]
    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_article = null;

    #[Groups('api_recherche')]
    #[ORM\ManyToOne(inversedBy: 'ecrire')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'articles')]
    private Collection $classer;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Genre $style = null;

    /**
     * @var Collection<int, Commentaire>
     */
    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'article')]
    private Collection $commenter;

    #[ORM\Column]
    private ?bool $statut_article = null;

    public function __construct()
    {
        $this->classer = new ArrayCollection();
        $this->commenter = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreArticle(): ?string
    {
        return $this->titre_article;
    }

    public function setTitreArticle(string $titre_article): static
    {
        $this->titre_article = $titre_article;

        return $this;
    }

    public function getTexteArticle(): ?string
    {
        return $this->texte_article;
    }

    public function setTexteArticle(string $texte_article): static
    {
        $this->texte_article = $texte_article;

        return $this;
    }

    public function getDateArticle(): ?\DateTimeInterface
    {
        return $this->date_article;
    }

    public function setDateArticle(\DateTimeInterface $date_article): static
    {
        $this->date_article = $date_article;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getClasser(): Collection
    {
        return $this->classer;
    }

    public function addClasser(Categorie $classer): static
    {
        if (!$this->classer->contains($classer)) {
            $this->classer->add($classer);
        }

        return $this;
    }

    public function removeClasser(Categorie $classer): static
    {
        $this->classer->removeElement($classer);

        return $this;
    }

    public function getStyle(): ?Genre
    {
        return $this->style;
    }

    public function setStyle(?Genre $style): static
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommenter(): Collection
    {
        return $this->commenter;
    }

    public function addCommenter(Commentaire $commenter): static
    {
        if (!$this->commenter->contains($commenter)) {
            $this->commenter->add($commenter);
            $commenter->setArticle($this);
        }

        return $this;
    }

    public function removeCommenter(Commentaire $commenter): static
    {
        if ($this->commenter->removeElement($commenter)) {
            // set the owning side to null (unless already changed)
            if ($commenter->getArticle() === $this) {
                $commenter->setArticle(null);
            }
        }

        return $this;
    }

    public function isStatutArticle(): ?bool
    {
        return $this->statut_article;
    }

    public function setStatutArticle(bool $statut_article): static
    {
        $this->statut_article = $statut_article;

        return $this;
    }
}

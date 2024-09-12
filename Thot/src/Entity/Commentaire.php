<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre_commentaire = null;

    #[ORM\Column(length: 255)]
    private ?string $texte_commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'auteur')]
    private ?Utilisateur $utilisateur = null;

    #[ORM\ManyToOne(inversedBy: 'commenter')]
    private ?Article $article = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreCommentaire(): ?string
    {
        return $this->titre_commentaire;
    }

    public function setTitreCommentaire(string $titre_commentaire): static
    {
        $this->titre_commentaire = $titre_commentaire;

        return $this;
    }

    public function getTexteCommentaire(): ?string
    {
        return $this->texte_commentaire;
    }

    public function setTexteCommentaire(string $texte_commentaire): static
    {
        $this->texte_commentaire = $texte_commentaire;

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

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): static
    {
        $this->article = $article;

        return $this;
    }
}

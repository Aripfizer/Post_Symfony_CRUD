<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    public function __construct()
    {
        $this->published_at = new \DateTimeImmutable();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: false)]
    private ?\DateTimeImmutable $published_at = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: "Le titre est requis")]
    #[Assert\Length(min: 3, minMessage: "Le titre doit etre au minimum {{limit}} caractères", max: 10, maxMessage: "Le titre ne doit pas dépasser {{limit}} caractères")]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le contenu est requis")]
    #[Assert\Length(min: 3, minMessage: "Le contenu doit etre au minimum {{limit}} caractères", max: 255, maxMessage: "Le contenu ne doit pas dépasser {{limit}} caractères")]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\Choice(
        choices: [1, 2],
        message: 'Vous devez selectionner au moins une catégorie',
    )]
    private ?Category $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->published_at;
    }

    public function setPublishedAt(?\DateTimeImmutable $published_at): self
    {
        $this->published_at = $published_at;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['article:read']],
    denormalizationContext: ['groups' => ['article:write']]
)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    #[Gedmo\Timestampable]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    #[Gedmo\Timestampable]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $publisher = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[Groups(['article:read'])]
    public function getTitle(): ?string
    {
        return $this->title;
    }

    #[Groups(['article:write'])]
    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    #[Groups(['article:read'])]
    public function getContent(): ?string
    {
        return $this->content;
    }

    #[Groups(['article:write'])]
    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    #[Groups(['article:read'])]
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    #[Groups(['article:read'])]
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    #[Groups(['article:read'])]
    public function getPublisher(): ?User
    {
        return $this->publisher;
    }

    public function setPublished(?User $publisher): static
    {
        $this->publisher = $publisher;

        return $this;
    }
}

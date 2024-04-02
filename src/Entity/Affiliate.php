<?php

namespace App\Entity;

use App\Repository\AffiliateRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: AffiliateRepository::class)]
#[ApiResource]
class Affiliate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "text")]
    private ?string $lien = null;

    #[ORM\ManyToOne(inversedBy: 'affiliates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Guides $guides = null;

    #[ORM\ManyToOne(inversedBy: 'affiliates')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SousCategories2 $sous_categories_2 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): static
    {
        $this->lien = $lien;

        return $this;
    }

    public function getGuides(): ?Guides
    {
        return $this->guides;
    }

    public function setGuides(?Guides $guides): static
    {
        $this->guides = $guides;

        return $this;
    }

    public function getSousCategories2(): ?SousCategories2
    {
        return $this->sous_categories_2;
    }

    public function setSousCategories2(?SousCategories2 $sous_categories_2): static
    {
        $this->sous_categories_2 = $sous_categories_2;

        return $this;
    }
}

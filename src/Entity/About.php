<?php

namespace App\Entity;

use App\Repository\AboutRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AboutRepository::class)]
class About
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_title = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_description = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $image_1 = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $paragraph_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $image_2 = null;

    #[ORM\Column(length: 255)]
    private ?string $slogan_logo = null;

    #[ORM\Column(length: 255)]
    private ?string $image_panoramique = null;

    #[ORM\Column(length: 255)]
    private ?string $paragraph_2 = null;

    #[ORM\Column(length: 255)]
    private ?string $image_3 = null;

    #[ORM\Column(length: 255)]
    private ?string $image_4 = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text_final = null;

    #[ORM\ManyToOne(inversedBy: 'abouts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sites $sites = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMetaTitle(): ?string
    {
        return $this->meta_title;
    }

    public function setMetaTitle(string $meta_title): static
    {
        $this->meta_title = $meta_title;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->meta_description;
    }

    public function setMetaDescription(string $meta_description): static
    {
        $this->meta_description = $meta_description;

        return $this;
    }

    public function getTitre1(): ?string
    {
        return $this->titre_1;
    }

    public function setTitre1(string $titre_1): static
    {
        $this->titre_1 = $titre_1;

        return $this;
    }

    public function getImage1(): ?string
    {
        return $this->image_1;
    }

    public function setImage1(string $image_1): static
    {
        $this->image_1 = $image_1;

        return $this;
    }

    public function getParagraph1(): ?string
    {
        return $this->paragraph_1;
    }

    public function setParagraph1(string $paragraph_1): static
    {
        $this->paragraph_1 = $paragraph_1;

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image_2;
    }

    public function setImage2(string $image_2): static
    {
        $this->image_2 = $image_2;

        return $this;
    }

    public function getSloganLogo(): ?string
    {
        return $this->slogan_logo;
    }

    public function setSloganLogo(string $slogan_logo): static
    {
        $this->slogan_logo = $slogan_logo;

        return $this;
    }

    public function getImagePanoramique(): ?string
    {
        return $this->image_panoramique;
    }

    public function setImagePanoramique(string $image_panoramique): static
    {
        $this->image_panoramique = $image_panoramique;

        return $this;
    }

    public function getParagraph2(): ?string
    {
        return $this->paragraph_2;
    }

    public function setParagraph2(string $paragraph_2): static
    {
        $this->paragraph_2 = $paragraph_2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image_3;
    }

    public function setImage3(string $image_3): static
    {
        $this->image_3 = $image_3;

        return $this;
    }

    public function getImage4(): ?string
    {
        return $this->image_4;
    }

    public function setImage4(string $image_4): static
    {
        $this->image_4 = $image_4;

        return $this;
    }

    public function getTextFinal(): ?string
    {
        return $this->text_final;
    }

    public function setTextFinal(string $text_final): static
    {
        $this->text_final = $text_final;

        return $this;
    }

    public function getSites(): ?Sites
    {
        return $this->sites;
    }

    public function setSites(?Sites $sites): static
    {
        $this->sites = $sites;

        return $this;
    }
}

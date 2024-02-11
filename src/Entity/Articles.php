<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SousCategories2 $sous_categories_2 = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $created_date = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?int $temps_lecture = null;

    #[ORM\Column(length: 255)]
    private ?string $paragraph_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $image_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_2 = null;

    #[ORM\Column(length: 255)]
    private ?string $paragraph_2 = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_3 = null;

    #[ORM\Column(length: 255)]
    private ?string $paragraph_3 = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_4 = null;

    #[ORM\Column(length: 255)]
    private ?string $paragraph_4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tab_item_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tab_item_2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tab_item_3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tab_item_4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tab_item_5 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tab_item_6 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tab_item_7 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tab_item_8 = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle_bouton_tab = null;

    #[ORM\Column(length: 255)]
    private ?string $tab_col_url_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $tab_col_url_2 = null;

    #[ORM\Column(length: 255)]
    private ?string $tab_col_url_3 = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sites $sites = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSites(): ?Sites
    {
        return $this->sites;
    }

    public function setSites(?Sites $sites): static
    {
        $this->sites = $sites;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

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

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->created_date;
    }

    public function setCreatedDate(\DateTimeInterface $created_date): static
    {
        $this->created_date = $created_date;

        return $this;
    }

    public function getTempsLecture(): ?int
    {
        return $this->temps_lecture;
    }

    public function setTempsLecture(?int $temps_lecture): static
    {
        $this->temps_lecture = $temps_lecture;

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

    public function getImage1(): ?string
    {
        return $this->image_1;
    }

    public function setImage1(string $image_1): static
    {
        $this->image_1 = $image_1;

        return $this;
    }

    public function getTitre2(): ?string
    {
        return $this->titre_2;
    }

    public function setTitre2(string $titre_2): static
    {
        $this->titre_2 = $titre_2;

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

    public function getTitre3(): ?string
    {
        return $this->titre_3;
    }

    public function setTitre3(string $titre_3): static
    {
        $this->titre_3 = $titre_3;

        return $this;
    }

    public function getParagraph3(): ?string
    {
        return $this->paragraph_3;
    }

    public function setParagraph3(string $paragraph_3): static
    {
        $this->paragraph_3 = $paragraph_3;

        return $this;
    }

    public function getTitre4(): ?string
    {
        return $this->titre_4;
    }

    public function setTitre4(string $titre_4): static
    {
        $this->titre_4 = $titre_4;

        return $this;
    }

    public function getParagraph4(): ?string
    {
        return $this->paragraph_4;
    }

    public function setParagraph4(string $paragraph_4): static
    {
        $this->paragraph_4 = $paragraph_4;

        return $this;
    }

    public function getTabItem1(): ?string
    {
        return $this->tab_item_1;
    }

    public function setTabItem1(?string $tab_item_1): static
    {
        $this->tab_item_1 = $tab_item_1;

        return $this;
    }

    public function getTabItem2(): ?string
    {
        return $this->tab_item_2;
    }

    public function setTabItem2(?string $tab_item_2): static
    {
        $this->tab_item_2 = $tab_item_2;

        return $this;
    }

    public function getTabItem3(): ?string
    {
        return $this->tab_item_3;
    }

    public function setTabItem3(?string $tab_item_3): static
    {
        $this->tab_item_3 = $tab_item_3;

        return $this;
    }

    public function getTabItem4(): ?string
    {
        return $this->tab_item_4;
    }

    public function setTabItem4(?string $tab_item_4): static
    {
        $this->tab_item_4 = $tab_item_4;

        return $this;
    }

    public function getTabItem5(): ?string
    {
        return $this->tab_item_5;
    }

    public function setTabItem5(?string $tab_item_5): static
    {
        $this->tab_item_5 = $tab_item_5;

        return $this;
    }

    public function getTabItem6(): ?string
    {
        return $this->tab_item_6;
    }

    public function setTabItem6(?string $tab_item_6): static
    {
        $this->tab_item_6 = $tab_item_6;

        return $this;
    }

    public function getTabItem7(): ?string
    {
        return $this->tab_item_7;
    }

    public function setTabItem7(?string $tab_item_7): static
    {
        $this->tab_item_7 = $tab_item_7;

        return $this;
    }

    public function getTabItem8(): ?string
    {
        return $this->tab_item_8;
    }

    public function setTabItem8(?string $tab_item_8): static
    {
        $this->tab_item_8 = $tab_item_8;

        return $this;
    }

    public function getLibelleBoutonTab(): ?string
    {
        return $this->libelle_bouton_tab;
    }

    public function setLibelleBoutonTab(string $libelle_bouton_tab): static
    {
        $this->libelle_bouton_tab = $libelle_bouton_tab;

        return $this;
    }

    public function getTabColUrl1(): ?string
    {
        return $this->tab_col_url_1;
    }

    public function setTabColUrl1(string $tab_col_url_1): static
    {
        $this->tab_col_url_1 = $tab_col_url_1;

        return $this;
    }

    public function getTabColUrl2(): ?string
    {
        return $this->tab_col_url_2;
    }

    public function setTabColUrl2(string $tab_col_url_2): static
    {
        $this->tab_col_url_2 = $tab_col_url_2;

        return $this;
    }

    public function getTabColUrl3(): ?string
    {
        return $this->tab_col_url_3;
    }

    public function setTabColUrl3(string $tab_col_url_3): static
    {
        $this->tab_col_url_3 = $tab_col_url_3;

        return $this;
    }

}

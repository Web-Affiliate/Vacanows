<?php

namespace App\Entity;

use App\Repository\ContentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContentRepository::class)]
class Content
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'contents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sites $sites = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_header = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(length: 255)]
    private ?string $navbar_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $navbar_2 = null;

    #[ORM\Column(length: 255)]
    private ?string $navbar_3 = null;

    #[ORM\Column(length: 255)]
    private ?string $navbar_4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $navbar_5 = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_header = null;

    #[ORM\Column(type: "text")]
    private ?string $paragraph_header = null;

    #[ORM\Column(length: 255)]
    private ?string $placeholder_search = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_1 = null;

    #[ORM\Column(type: "text")]
    private ?string $paragraph_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_2 = null;

    #[ORM\Column(type: "text")]
    private ?string $paragraph_2 = null;

    #[ORM\Column(length: 255)]
    private ?string $bouton_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_3 = null;

    #[ORM\Column(type: "text")]
    private ?string $paragraph_3 = null;

    #[ORM\Column(length: 255)]
    private ?string $sous_titre_1 = null;

    #[ORM\Column(type: "text")]
    private ?string $paragraph_4 = null;

    #[ORM\Column(length: 255)]
    private ?string $sous_titre_2 = null;

    #[ORM\Column(type: "text")]
    private ?string $paragraph_5 = null;

    #[ORM\Column(length: 255)]
    private ?string $sous_titre_3 = null;

    #[ORM\Column(type: "text")]
    private ?string $paragraph_6 = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_recommandation = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_4 = null;

    #[ORM\Column(type: "text")]
    private ?string $paragraph_7 = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_new_recommandation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $instagram_link = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $tiktok_link = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $facebook_link = null;

    #[ORM\Column(type: "text")]
    private ?string $meta = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_header2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_header3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_header4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_1_no_border = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_description = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_subject = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_category = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_og_description = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_og_title = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_author = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $meta_canonical = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_image = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getImageHeader(): ?string
    {
        return $this->image_header;
    }

    public function setImageHeader(string $image_header): static
    {
        $this->image_header = $image_header;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getNavbar1(): ?string
    {
        return $this->navbar_1;
    }

    public function setNavbar1(string $navbar_1): static
    {
        $this->navbar_1 = $navbar_1;

        return $this;
    }

    public function getNavbar2(): ?string
    {
        return $this->navbar_2;
    }

    public function setNavbar2(string $navbar_2): static
    {
        $this->navbar_2 = $navbar_2;

        return $this;
    }

    public function getNavbar3(): ?string
    {
        return $this->navbar_3;
    }

    public function setNavbar3(string $navbar_3): static
    {
        $this->navbar_3 = $navbar_3;

        return $this;
    }

    public function getNavbar4(): ?string
    {
        return $this->navbar_4;
    }

    public function setNavbar4(string $navbar_4): static
    {
        $this->navbar_4 = $navbar_4;

        return $this;
    }

    public function getNavbar5(): ?string
    {
        return $this->navbar_5;
    }

    public function setNavbar5(?string $navbar_5): static
    {
        $this->navbar_5 = $navbar_5;

        return $this;
    }

    public function getTitreHeader(): ?string
    {
        return $this->titre_header;
    }

    public function setTitreHeader(string $titre_header): static
    {
        $this->titre_header = $titre_header;

        return $this;
    }

    public function getParagraphHeader(): ?string
    {
        return $this->paragraph_header;
    }

    public function setParagraphHeader(string $paragraph_header): static
    {
        $this->paragraph_header = $paragraph_header;

        return $this;
    }

    public function getPlaceholderSearch(): ?string
    {
        return $this->placeholder_search;
    }

    public function setPlaceholderSearch(string $placeholder_search): static
    {
        $this->placeholder_search = $placeholder_search;

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

    public function getBouton1(): ?string
    {
        return $this->bouton_1;
    }

    public function setBouton1(string $bouton_1): static
    {
        $this->bouton_1 = $bouton_1;

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

    public function getSousTitre1(): ?string
    {
        return $this->sous_titre_1;
    }

    public function setSousTitre1(string $sous_titre_1): static
    {
        $this->sous_titre_1 = $sous_titre_1;

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

    public function getSousTitre2(): ?string
    {
        return $this->sous_titre_2;
    }

    public function setSousTitre2(string $sous_titre_2): static
    {
        $this->sous_titre_2 = $sous_titre_2;

        return $this;
    }

    public function getParagraph5(): ?string
    {
        return $this->paragraph_5;
    }

    public function setParagraph5(string $paragraph_5): static
    {
        $this->paragraph_5 = $paragraph_5;

        return $this;
    }

    public function getSousTitre3(): ?string
    {
        return $this->sous_titre_3;
    }

    public function setSousTitre3(string $sous_titre_3): static
    {
        $this->sous_titre_3 = $sous_titre_3;

        return $this;
    }

    public function getParagraph6(): ?string
    {
        return $this->paragraph_6;
    }

    public function setParagraph6(string $paragraph_6): static
    {
        $this->paragraph_6 = $paragraph_6;

        return $this;
    }

    public function getTitreRecommandation(): ?string
    {
        return $this->titre_recommandation;
    }

    public function setTitreRecommandation(string $titre_recommandation): static
    {
        $this->titre_recommandation = $titre_recommandation;

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

    public function getParagraph7(): ?string
    {
        return $this->paragraph_7;
    }

    public function setParagraph7(string $paragraph_7): static
    {
        $this->paragraph_7 = $paragraph_7;

        return $this;
    }

    public function getTitreNewRecommandation(): ?string
    {
        return $this->titre_new_recommandation;
    }

    public function setTitreNewRecommandation(string $titre_new_recommandation): static
    {
        $this->titre_new_recommandation = $titre_new_recommandation;

        return $this;
    }

    public function getInstagramLink(): ?string
    {
        return $this->instagram_link;
    }

    public function setInstagramLink(?string $instagram_link): static
    {
        $this->instagram_link = $instagram_link;

        return $this;
    }

    public function getTiktokLink(): ?string
    {
        return $this->tiktok_link;
    }

    public function setTiktokLink(?string $tiktok_link): static
    {
        $this->tiktok_link = $tiktok_link;

        return $this;
    }

    public function getFacebookLink(): ?string
    {
        return $this->facebook_link;
    }

    public function setFacebookLink(?string $facebook_link): static
    {
        $this->facebook_link = $facebook_link;

        return $this;
    }

    public function getMeta(): ?string
    {
        return $this->meta;
    }

    public function setMeta(string $meta): static
    {
        $this->meta = $meta;

        return $this;
    }

    public function getImageHeader2(): ?string
    {
        return $this->image_header2;
    }

    public function setImageHeader2(string $image_header2): static
    {
        $this->image_header2 = $image_header2;

        return $this;
    }

    public function getImageHeader3(): ?string
    {
        return $this->image_header3;
    }

    public function setImageHeader3(string $image_header3): static
    {
        $this->image_header3 = $image_header3;

        return $this;
    }

    public function getImageHeader4(): ?string
    {
        return $this->image_header4;
    }

    public function setImageHeader4(string $image_header4): static
    {
        $this->image_header4 = $image_header4;

        return $this;
    }

    public function getImage1NoBorder(): ?string
    {
        return $this->image_1_no_border;
    }

    public function setImage1NoBorder(string $image_1_no_border): static
    {
        $this->image_1_no_border = $image_1_no_border;

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

    public function getMetaSubject(): ?string
    {
        return $this->meta_subject;
    }

    public function setMetaSubject(string $meta_subject): static
    {
        $this->meta_subject = $meta_subject;

        return $this;
    }

    public function getMetaCategory(): ?string
    {
        return $this->meta_category;
    }

    public function setMetaCategory(string $meta_category): static
    {
        $this->meta_category = $meta_category;

        return $this;
    }

    public function getMetaOgDescription(): ?string
    {
        return $this->meta_og_description;
    }

    public function setMetaOgDescription(string $meta_og_description): static
    {
        $this->meta_og_description = $meta_og_description;

        return $this;
    }

    public function getMetaOgTitle(): ?string
    {
        return $this->meta_og_title;
    }

    public function setMetaOgTitle(string $meta_og_title): static
    {
        $this->meta_og_title = $meta_og_title;

        return $this;
    }

    public function getMetaAuthor(): ?string
    {
        return $this->meta_author;
    }

    public function setMetaAuthor(string $meta_author): static
    {
        $this->meta_author = $meta_author;

        return $this;
    }

    public function getMetaCanonical(): ?string
    {
        return $this->meta_canonical;
    }

    public function setMetaCanonical(?string $meta_canonical): static
    {
        $this->meta_canonical = $meta_canonical;

        return $this;
    }

    public function getMetaImage(): ?string
    {
        return $this->meta_image;
    }

    public function setMetaImage(string $meta_image): static
    {
        $this->meta_image = $meta_image;

        return $this;
    }

}

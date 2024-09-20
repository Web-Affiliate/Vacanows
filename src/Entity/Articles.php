<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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

    #[ORM\Column(type: 'datetime')]
    #[Gedmo\Timestampable(on: 'create')]
    private ?\DateTimeInterface $created_date = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $temps_lecture = null;

    #[ORM\Column(type: "text")]
    private ?string $paragraph_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $image_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_2 = null;

    #[ORM\Column(type: "text")]
    private ?string $paragraph_2 = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_3 = null;

    #[ORM\Column(type: "text")]
    private ?string $paragraph_3 = null;

    #[ORM\Column(length: 255)]
    private ?string $titre_4 = null;

    #[ORM\Column(type: "text")]
    private ?string $paragraph_4 = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle_bouton_tab = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Sites $sites = null;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Guides $guides = null;

    #[ORM\Column(length: 255)]
    private ?string $meta = null;

    #[ORM\Column(nullable: true)]
    private ?bool $tab_libelle_1 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $tab_libelle_2 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $tab_libelle_3 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $tab_libelle_4 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $tab_libelle_5 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $tab_libelle_6 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $tab_libelle_7 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $tab_libelle_8 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $tab_libelle_9 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $tab_libelle_10 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $tab_libelle_11 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $tab_libelle_12 = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_description = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_subject = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $meta_canonical = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_author = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_og_description = null;

    #[ORM\Column(length: 255)]
    private ?string $meta_og_title = null;

    #[ORM\Column(type: 'datetime')]
    #[Gedmo\Timestampable(on: 'update')]
    private ?\DateTimeInterface $modif_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $meta_image = null;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'article')]
    private Collection $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }


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

    public function getLibelleBoutonTab(): ?string
    {
        return $this->libelle_bouton_tab;
    }

    public function setLibelleBoutonTab(string $libelle_bouton_tab): static
    {
        $this->libelle_bouton_tab = $libelle_bouton_tab;

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

    public function getMeta(): ?string
    {
        return $this->meta;
    }

    public function setMeta(string $meta): static
    {
        $this->meta = $meta;

        return $this;
    }

    public function isTabLibelle1(): ?bool
    {
        return $this->tab_libelle_1;
    }

    public function setTabLibelle1(?bool $tab_libelle_1): static
    {
        $this->tab_libelle_1 = $tab_libelle_1;

        return $this;
    }

    public function isTabLibelle2(): ?bool
    {
        return $this->tab_libelle_2;
    }

    public function setTabLibelle2(?bool $tab_libelle_2): static
    {
        $this->tab_libelle_2 = $tab_libelle_2;

        return $this;
    }

    public function isTabLibelle3(): ?bool
    {
        return $this->tab_libelle_3;
    }

    public function setTabLibelle3(?bool $tab_libelle_3): static
    {
        $this->tab_libelle_3 = $tab_libelle_3;

        return $this;
    }

    public function isTabLibelle4(): ?bool
    {
        return $this->tab_libelle_4;
    }

    public function setTabLibelle4(?bool $tab_libelle_4): static
    {
        $this->tab_libelle_4 = $tab_libelle_4;

        return $this;
    }

    public function isTabLibelle5(): ?bool
    {
        return $this->tab_libelle_5;
    }

    public function setTabLibelle5(?bool $tab_libelle_5): static
    {
        $this->tab_libelle_5 = $tab_libelle_5;

        return $this;
    }

    public function isTabLibelle6(): ?bool
    {
        return $this->tab_libelle_6;
    }

    public function setTabLibelle6(?bool $tab_libelle_6): static
    {
        $this->tab_libelle_6 = $tab_libelle_6;

        return $this;
    }

    public function isTabLibelle7(): ?bool
    {
        return $this->tab_libelle_7;
    }

    public function setTabLibelle7(?bool $tab_libelle_7): static
    {
        $this->tab_libelle_7 = $tab_libelle_7;

        return $this;
    }

    public function isTabLibelle8(): ?bool
    {
        return $this->tab_libelle_8;
    }

    public function setTabLibelle8(?bool $tab_libelle_8): static
    {
        $this->tab_libelle_8 = $tab_libelle_8;

        return $this;
    }

    public function isTabLibelle9(): ?bool
    {
        return $this->tab_libelle_9;
    }

    public function setTabLibelle9(?bool $tab_libelle_9): static
    {
        $this->tab_libelle_9 = $tab_libelle_9;

        return $this;
    }

    public function isTabLibelle10(): ?bool
    {
        return $this->tab_libelle_10;
    }

    public function setTabLibelle10(?bool $tab_libelle_10): static
    {
        $this->tab_libelle_10 = $tab_libelle_10;

        return $this;
    }

    public function isTabLibelle11(): ?bool
    {
        return $this->tab_libelle_11;
    }

    public function setTabLibelle11(?bool $tab_libelle_11): static
    {
        $this->tab_libelle_11 = $tab_libelle_11;

        return $this;
    }

    public function isTabLibelle12(): ?bool
    {
        return $this->tab_libelle_12;
    }

    public function setTabLibelle12(?bool $tab_libelle_12): static
    {
        $this->tab_libelle_12 = $tab_libelle_12;

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

    public function getMetaCanonical(): ?string
    {
        return $this->meta_canonical;
    }

    public function setMetaCanonical(?string $meta_canonical): static
    {
        $this->meta_canonical = $meta_canonical;

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

    public function getModifDate(): ?\DateTimeInterface
    {
        return $this->modif_date;
    }

    public function setModifDate(\DateTimeInterface $modif_date): static
    {
        $this->modif_date = $modif_date;

        return $this;
    }

    public function getMetaImage(): ?string
    {
        return $this->meta_image;
    }

    public function setMetaImage(?string $meta_image): static
    {
        $this->meta_image = $meta_image;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

        return $this;
    }

}

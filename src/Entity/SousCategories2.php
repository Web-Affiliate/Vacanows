<?php

namespace App\Entity;

use App\Repository\SousCategories2Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SousCategories2Repository::class)]
class SousCategories2
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'sousCategories2s')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SousCategories1 $sous_categorie_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $note_tab_item_1 = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $note_tab_item_2 = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $note_tab_item_3 = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $note_tab_item_4 = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $note_tab_item_5 = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $note_tab_item_6 = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $note_tab_item_7 = null;

    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $note_tab_item_8 = null;

    #[ORM\OneToMany(mappedBy: 'sous_categories_2', targetEntity: Articles::class)]
    private Collection $articles;

    #[ORM\Column(nullable: true)]
    private ?float $note_tab_item_9 = null;

    #[ORM\Column(nullable: true)]
    private ?float $note_tab_item_10 = null;

    #[ORM\Column(nullable: true)]
    private ?float $note_tab_item_11 = null;

    #[ORM\Column(nullable: true)]
    private ?float $note_tab_item_12 = null;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSousCategorie1(): ?SousCategories1
    {
        return $this->sous_categorie_1;
    }

    public function setSousCategorie1(?SousCategories1 $sous_categorie_1): static
    {
        $this->sous_categorie_1 = $sous_categorie_1;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getNoteTabItem1(): ?float
    {
        return $this->note_tab_item_1;
    }

    public function setNoteTabItem1(?float $note_tab_item_1): static
    {
        $this->note_tab_item_1 = $note_tab_item_1;

        return $this;
    }

    public function getNoteTabItem2(): ?float
    {
        return $this->note_tab_item_2;
    }

    public function setNoteTabItem2(?float $note_tab_item_2): static
    {
        $this->note_tab_item_2 = $note_tab_item_2;

        return $this;
    }

    public function getNoteTabItem3(): ?float
    {
        return $this->note_tab_item_3;
    }

    public function setNoteTabItem3(?float $note_tab_item_3): static
    {
        $this->note_tab_item_3 = $note_tab_item_3;

        return $this;
    }

    public function getNoteTabItem4(): ?float
    {
        return $this->note_tab_item_4;
    }

    public function setNoteTabItem4(?float $note_tab_item_4): static
    {
        $this->note_tab_item_4 = $note_tab_item_4;

        return $this;
    }

    public function getNoteTabItem5(): ?float
    {
        return $this->note_tab_item_5;
    }

    public function setNoteTabItem5(?float $note_tab_item_5): static
    {
        $this->note_tab_item_5 = $note_tab_item_5;

        return $this;
    }

    public function getNoteTabItem6(): ?float
    {
        return $this->note_tab_item_6;
    }

    public function setNoteTabItem6(?float $note_tab_item_6): static
    {
        $this->note_tab_item_6 = $note_tab_item_6;

        return $this;
    }

    public function getNoteTabItem7(): ?float
    {
        return $this->note_tab_item_7;
    }

    public function setNoteTabItem7(?float $note_tab_item_7): static
    {
        $this->note_tab_item_7 = $note_tab_item_7;

        return $this;
    }

    public function getNoteTabItem8(): ?float
    {
        return $this->note_tab_item_8;
    }

    public function setNoteTabItem8(?float $note_tab_item_8): static
    {
        $this->note_tab_item_8 = $note_tab_item_8;

        return $this;
    }


    /**
     * @return Collection<int, Articles>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Articles $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setSousCategories2($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getSousCategories2() === $this) {
                $article->setSousCategories2(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }

    public function getNoteTabItem9(): ?float
    {
        return $this->note_tab_item_9;
    }

    public function setNoteTabItem9(?float $note_tab_item_9): static
    {
        $this->note_tab_item_9 = $note_tab_item_9;

        return $this;
    }

    public function getNoteTabItem10(): ?float
    {
        return $this->note_tab_item_10;
    }

    public function setNoteTabItem10(?float $note_tab_item_10): static
    {
        $this->note_tab_item_10 = $note_tab_item_10;

        return $this;
    }

    public function getNoteTabItem11(): ?float
    {
        return $this->note_tab_item_11;
    }

    public function setNoteTabItem11(?float $note_tab_item_11): static
    {
        $this->note_tab_item_11 = $note_tab_item_11;

        return $this;
    }

    public function getNoteTabItem12(): ?float
    {
        return $this->note_tab_item_12;
    }

    public function setNoteTabItem12(?float $note_tab_item_12): static
    {
        $this->note_tab_item_12 = $note_tab_item_12;

        return $this;
    }
}

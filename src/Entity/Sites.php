<?php

namespace App\Entity;

use App\Repository\SitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SitesRepository::class)]
class Sites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'sites', targetEntity: Content::class)]
    private Collection $contents;

    #[ORM\OneToMany(mappedBy: 'sites', targetEntity: Articles::class)]
    private Collection $articles;

    #[ORM\OneToMany(mappedBy: 'site', targetEntity: Todo::class)]
    private Collection $todos;

    #[ORM\OneToMany(mappedBy: 'sites', targetEntity: About::class)]
    private Collection $abouts;

    public function __construct()
    {
        $this->contents = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->todos = new ArrayCollection();
        $this->abouts = new ArrayCollection();
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

    /**
     * @return Collection<int, Content>
     */
    public function getContents(): Collection
    {
        return $this->contents;
    }

    public function addContent(Content $content): static
    {
        if (!$this->contents->contains($content)) {
            $this->contents->add($content);
            $content->setSites($this);
        }

        return $this;
    }

    public function removeContent(Content $content): static
    {
        if ($this->contents->removeElement($content)) {
            // set the owning side to null (unless already changed)
            if ($content->getSites() === $this) {
                $content->setSites(null);
            }
        }

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
            $article->setSites($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getSites() === $this) {
                $article->setSites(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    /**
     * @return Collection<int, Todo>
     */
    public function getTodos(): Collection
    {
        return $this->todos;
    }

    public function addTodo(Todo $todo): static
    {
        if (!$this->todos->contains($todo)) {
            $this->todos->add($todo);
            $todo->setSite($this);
        }

        return $this;
    }

    public function removeTodo(Todo $todo): static
    {
        if ($this->todos->removeElement($todo)) {
            // set the owning side to null (unless already changed)
            if ($todo->getSite() === $this) {
                $todo->setSite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, About>
     */
    public function getAbouts(): Collection
    {
        return $this->abouts;
    }

    public function addAbout(About $about): static
    {
        if (!$this->abouts->contains($about)) {
            $this->abouts->add($about);
            $about->setSites($this);
        }

        return $this;
    }

    public function removeAbout(About $about): static
    {
        if ($this->abouts->removeElement($about)) {
            // set the owning side to null (unless already changed)
            if ($about->getSites() === $this) {
                $about->setSites(null);
            }
        }

        return $this;
    }
}

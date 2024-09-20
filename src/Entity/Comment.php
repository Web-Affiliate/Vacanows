<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?User $user = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $comment = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_creation = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    private ?Articles $article = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getArticle(): ?Articles
    {
        return $this->article;
    }

    public function setArticle(?Articles $article): static
    {
        $this->article = $article;

        return $this;
    }


    public function getElapsedTime(string $userTimezone): string
    {
        $userDateTime = $this->date_creation->setTimezone(new \DateTimeZone($userTimezone));
        $now = new \DateTime('now', new \DateTimeZone($userTimezone));

        $interval = $userDateTime->diff($now);

        if ($interval->y > 0) {
            return $interval->y === 1 ? '1 an' : $interval->y . ' ans';
        } elseif ($interval->m > 0) {
            return $interval->m === 1 ? '1 mois' : $interval->m . ' mois';
        } elseif ($interval->d > 0) {
            return $interval->d === 1 ? '1 jour' : $interval->d . ' jours';
        } elseif ($interval->h > 0) {
            return $interval->h === 1 ? '1 heure' : $interval->h . ' heures';
        } elseif ($interval->i > 0) {
            return $interval->i === 1 ? '1 minute' : $interval->i . ' minutes';
        } else {
            return $interval->s === 1 ? '1 seconde' : $interval->s . ' secondes';
        }
    }


}

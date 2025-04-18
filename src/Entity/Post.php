<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post {
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\Column(length: 100)]
	private ?string $titre = null;

	#[ORM\Column(length: 255)]
	private ?string $content = null;

	#[ORM\Column(type: Types::DATETIME_MUTABLE)]
	private ?\DateTimeInterface $date_create = null;

	#[ORM\Column(length: 255)]
	private ?string $author = null;

	public function getId(): ?int {
		return $this->id;
	}

	public function getTitre(): ?string {
		return $this->titre;
	}

	public function setTitre(string $titre): static {
		$this->titre = $titre;

		return $this;
	}

	public function getContent(): ?string {
		return $this->content;
	}

	public function setContent(string $content): static {
		$this->content = $content;

		return $this;
	}

	public function getDateCreate(): ?\DateTimeInterface {
		return $this->date_create;
	}

	public function setDateCreate(\DateTimeInterface $date_create): static {
		$this->date_create = $date_create;

		return $this;
	}

	public function getAuthor(): ?string {
		return $this->author;
	}

	public function setAuthor(string $author): static {
		$this->author = $author;

		return $this;
	}
}

<?php

namespace App\Entity;

use App\Entity\Type;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProgramRepository")
 */
class Program
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $picture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="programs")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Artist", mappedBy="program_id")
     */
    private $artist_id;


    public function __construct()
    {
        $this->type = new ArrayCollection();
        $this->artist_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }


    /**
     * @return Collection|Artist[]
     */
    public function getArtistId(): Collection
    {
        return $this->artist_id;
    }

    public function addArtistId(Artist $artistId): self
    {
        if (!$this->artist_id->contains($artistId)) {
            $this->artist_id[] = $artistId;
            $artistId->addProgramId($this);
        }

        return $this;
    }

    public function removeArtistId(Artist $artistId): self
    {
        if ($this->artist_id->contains($artistId)) {
            $this->artist_id->removeElement($artistId);
            $artistId->removeProgramId($this);
        }

        return $this;
    }
}

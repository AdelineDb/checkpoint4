<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArtistRepository")
 */
class Artist
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
    private $biography;

    /**
     * @ORM\Column(type="text")
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\program", inversedBy="artist_id")
     */
    private $program_id;


    public function __construct()
    {
        $this->program_id = new ArrayCollection();
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

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

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
     * @return Collection|program[]
     */
    public function getProgramId(): Collection
    {
        return $this->program_id;
    }

    public function addProgramId(program $programId): self
    {
        if (!$this->program_id->contains($programId)) {
            $this->program_id[] = $programId;
        }

        return $this;
    }

    public function removeProgramId(program $programId): self
    {
        if ($this->program_id->contains($programId)) {
            $this->program_id->removeElement($programId);
        }

        return $this;
    }
}

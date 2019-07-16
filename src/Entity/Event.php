<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
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
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $eventdate;

    /**
     * @ORM\Column(type="time")
     * @return int|null
     */
    private $eventTime;

    /**
     * @return mixed
     */
    public function getEventTime()
    {
        return $this->eventTime;
    }

    /**
     * @param mixed $eventTime
     */
    public function setEventTime($eventTime): void
    {
        $this->eventTime = $eventTime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getEventdate(): ?\DateTimeInterface
    {
        return $this->eventdate;
    }

    public function setEventdate(?\DateTimeInterface $eventdate): self
    {
        $this->eventdate = $eventdate;

        return $this;
    }
}

<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EventTypesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

/** Event Types */
#[ORM\Entity(repositoryClass: EventTypesRepository::class)]
#[ApiResource()]
class EventTypes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[NotBlank]
    /** Title/Name of an Event Type */
    private ?string $title = '';

    #[ORM\Column]
    #[NotNull]
    /** Active status of an Event Type */
    private ?bool $isActive = true;

    #[ORM\Column]
    #[NotNull]
    /** Creation date & time of an Event Type */
    private ?\DateTime $createdAt;

    #[ORM\Column]
    #[NotNull]
    /** Last update date & time of an Event Type */
    private ?\DateTime $updatedAt;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Events::class)]
    /** Collection of events */
    private Collection $events;

    public function __construct()
    {
        $this->events = new ArrayCollection();
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
        $this->isActive = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(): self
    {
        $this->updatedAt = new \DateTime('now');

        return $this;
    }

    /**
     * @return Collection<int, Events>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }
}
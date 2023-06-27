<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Odm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\State\EventCollectionProvider;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use http\Params;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[
    ApiResource(
        operations: [
            new Get(),
            new GetCollection(),
            new Post(),
            new Delete(),
            new Put(openapi: false),
            new Patch(openapi: false)
        ]
    )
]
class Events
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    /** Type of Event */
    private ?EventTypes $type = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    /** Details log of an Event */
    private ?string $details = null;

    #[ORM\Column]
    /** Creation date & time of an Event */
    private ?\DateTime $createdAt = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?EventTypes
    {
        return $this->type;
    }

    public function setType(?EventTypes $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }
}
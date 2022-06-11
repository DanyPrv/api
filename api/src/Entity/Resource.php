<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ResourceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResourceRepository::class)]
#[ApiResource]
class Resource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ip;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'resources')]
    private $owner;

    #[ORM\ManyToOne(targetEntity: HardwareRequest::class, inversedBy: 'resource')]
    private $hardwareRequest;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $creationDate;

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): self
    {
        $this->ip = $ip;

        return $this;
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

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getHardwareRequest(): ?HardwareRequest
    {
        return $this->hardwareRequest;
    }

    public function setHardwareRequest(?HardwareRequest $hardwareRequest): self
    {
        $this->hardwareRequest = $hardwareRequest;

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

    public function getCreationDate(): ?\DateTimeInterface
    {
        if( null === $this->creationDate) {
            $this->setCreationDate();
        }

        return $this->creationDate;
    }

    public function setCreationDate(?\DateTimeInterface $creationDate = null): self
    {
        if( null === $creationDate ){
            $this->creationDate = new \DateTime('now');
        } else {
            $this->creationDate = $creationDate;
        }

        return $this;
    }
}

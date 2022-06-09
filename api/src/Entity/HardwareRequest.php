<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\HardwareRequestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: HardwareRequestRepository::class)]
#[ApiResource]
class HardwareRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $description;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\Choice(['NEW', 'APPROVED', 'CANCELLED', 'DECLINED'])]
    private $status;

    #[ORM\OneToMany(mappedBy: 'hardwareRequest', targetEntity: Resource::class)]
    private $resource;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'hardwareRequests')]
    private $owner;


    public function __construct()
    {
        $this->resource = new ArrayCollection();
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Resource[]
     */
    public function getResource(): Collection
    {
        return $this->resource;
    }

    public function addResource(Resource $resource): self
    {
        if (!$this->resource->contains($resource)) {
            $this->resource[] = $resource;
            $resource->setHardwareRequest($this);
        }

        return $this;
    }

    public function removeResource(Resource $resource): self
    {
        if ($this->resource->removeElement($resource)) {
            // set the owning side to null (unless already changed)
            if ($resource->getHardwareRequest() === $this) {
                $resource->setHardwareRequest(null);
            }
        }

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
}

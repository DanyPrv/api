<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FurnitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FurnitureRepository::class)]
#[ApiResource]
class Furniture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $furnitureType;

    #[ORM\OneToMany(mappedBy: 'furniturePoints', targetEntity: Point::class, cascade: ['persist', 'remove'])]
    private $points;

    #[ORM\OneToMany(mappedBy: 'furnitureClearance', targetEntity: Point::class, cascade: ['persist', 'remove'])]
    private $nonClearanceSide;

    #[ORM\OneToMany(mappedBy: 'furnitureOpenSide', targetEntity: Point::class, cascade: ['persist', 'remove'])]
    private $openToSide;

    #[ORM\ManyToOne(targetEntity: Room::class, inversedBy: 'furnitures')]
    private $room;

    public function __construct()
    {
        $this->points = new ArrayCollection();
        $this->nonClearanceSide = new ArrayCollection();
        $this->openToSide = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFurnitureType(): ?string
    {
        return $this->furnitureType;
    }

    public function setFurnitureType(?string $furnitureType): self
    {
        $this->furnitureType = $furnitureType;

        return $this;
    }

    /**
     * @return Collection|Point[]
     */
    public function getPoints(): Collection
    {
        return $this->points;
    }

    public function addPoint(Point $point): self
    {
        if (!$this->points->contains($point)) {
            $this->points[] = $point;
            $point->setFurniturePoints($this);
        }

        return $this;
    }

    public function removePoint(Point $point): self
    {
        if ($this->points->removeElement($point)) {
            // set the owning side to null (unless already changed)
            if ($point->getFurniturePoints() === $this) {
                $point->setFurniturePoints(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Point[]
     */
    public function getNonClearanceSide(): Collection
    {
        return $this->nonClearanceSide;
    }

    public function addNonClearanceSide(Point $nonClearanceSide): self
    {
        if (!$this->nonClearanceSide->contains($nonClearanceSide)) {
            $this->nonClearanceSide[] = $nonClearanceSide;
            $nonClearanceSide->setFurnitureClearance($this);
        }

        return $this;
    }

    public function removeNonClearanceSide(Point $nonClearanceSide): self
    {
        if ($this->nonClearanceSide->removeElement($nonClearanceSide)) {
            // set the owning side to null (unless already changed)
            if ($nonClearanceSide->getFurnitureClearance() === $this) {
                $nonClearanceSide->setFurnitureClearance(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Point[]
     */
    public function getOpenToSide(): Collection
    {
        return $this->openToSide;
    }

    public function addOpenToSide(Point $openToSide): self
    {
        if (!$this->openToSide->contains($openToSide)) {
            $this->openToSide[] = $openToSide;
            $openToSide->setFurnitureOpenSide($this);
        }

        return $this;
    }

    public function removeOpenToSide(Point $openToSide): self
    {
        if ($this->openToSide->removeElement($openToSide)) {
            // set the owning side to null (unless already changed)
            if ($openToSide->getFurnitureOpenSide() === $this) {
                $openToSide->setFurnitureOpenSide(null);
            }
        }

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }
}

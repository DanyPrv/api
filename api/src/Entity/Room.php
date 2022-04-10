<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
#[ApiResource]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $type;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $category;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $intractable;

    #[ORM\OneToMany(mappedBy: 'roomPoints', targetEntity: Point::class, cascade: ['persist', 'remove'])]
    private $points;

    #[ORM\OneToMany(mappedBy: 'roomInnerPoint', targetEntity: Point::class, cascade: ['persist', 'remove'])]
    private $innerPoints;

    #[ORM\OneToMany(mappedBy: 'roomRevitPoints', targetEntity: Point::class, cascade: ['persist', 'remove'])]
    private $revitPoints;

    #[ORM\OneToMany(mappedBy: 'room', targetEntity: Furniture::class, cascade: ['persist', 'remove'])]
    private $furnitures;

    #[ORM\ManyToOne(targetEntity: Floor::class, inversedBy: 'rooms')]
    private $floor;

    public function __construct()
    {
        $this->points = new ArrayCollection();
        $this->innerPoints = new ArrayCollection();
        $this->revitPoints = new ArrayCollection();
        $this->furnitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getIntractable(): ?bool
    {
        return $this->intractable;
    }

    public function setIntractable(?bool $intractable): self
    {
        $this->intractable = $intractable;

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
            $point->setRoomPoints($this);
        }

        return $this;
    }

    public function removePoint(Point $point): self
    {
        if ($this->points->removeElement($point)) {
            // set the owning side to null (unless already changed)
            if ($point->getRoomPoints() === $this) {
                $point->setRoomPoints(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Point[]
     */
    public function getInnerPoints(): Collection
    {
        return $this->innerPoints;
    }

    public function addInnerPoint(Point $innerPoint): self
    {
        if (!$this->innerPoints->contains($innerPoint)) {
            $this->innerPoints[] = $innerPoint;
            $innerPoint->setRoomInnerPoint($this);
        }

        return $this;
    }

    public function removeInnerPoint(Point $innerPoint): self
    {
        if ($this->innerPoints->removeElement($innerPoint)) {
            // set the owning side to null (unless already changed)
            if ($innerPoint->getRoomInnerPoint() === $this) {
                $innerPoint->setRoomInnerPoint(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Point[]
     */
    public function getRevitPoints(): Collection
    {
        return $this->revitPoints;
    }

    public function addRevitPoint(Point $revitPoint): self
    {
        if (!$this->revitPoints->contains($revitPoint)) {
            $this->revitPoints[] = $revitPoint;
            $revitPoint->setRoomRevitPoints($this);
        }

        return $this;
    }

    public function removeRevitPoint(Point $revitPoint): self
    {
        if ($this->revitPoints->removeElement($revitPoint)) {
            // set the owning side to null (unless already changed)
            if ($revitPoint->getRoomRevitPoints() === $this) {
                $revitPoint->setRoomRevitPoints(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Furniture[]
     */
    public function getFurnitures(): Collection
    {
        return $this->furnitures;
    }

    public function addFurniture(Furniture $furniture): self
    {
        if (!$this->furnitures->contains($furniture)) {
            $this->furnitures[] = $furniture;
            $furniture->setRoom($this);
        }

        return $this;
    }

    public function removeFurniture(Furniture $furniture): self
    {
        if ($this->furnitures->removeElement($furniture)) {
            // set the owning side to null (unless already changed)
            if ($furniture->getRoom() === $this) {
                $furniture->setRoom(null);
            }
        }

        return $this;
    }

    public function getFloor(): ?Floor
    {
        return $this->floor;
    }

    public function setFloor(?Floor $floor): self
    {
        $this->floor = $floor;

        return $this;
    }
}

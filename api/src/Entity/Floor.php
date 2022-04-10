<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FloorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FloorRepository::class)]
#[ApiResource]
class Floor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'floorPoint', targetEntity: Point::class, cascade: ['persist', 'remove'])]
    private $boundaryPoints;

    #[ORM\OneToMany(mappedBy: 'floor', targetEntity: Mullion::class, cascade: ['persist', 'remove'])]
    private $mullions;

    #[ORM\OneToMany(mappedBy: 'floor', targetEntity: CorridorPolygon::class, cascade: ['persist', 'remove'])]
    private $corridorPolygons;

    #[ORM\OneToMany(mappedBy: 'floor', targetEntity: Room::class, cascade: ['persist', 'remove'])]
    private $rooms;

    #[ORM\OneToMany(mappedBy: 'floor', targetEntity: Structure::class, cascade: ['persist', 'remove'])]
    private $structures;

    public function __construct()
    {
        $this->boundaryPoints = new ArrayCollection();
        $this->mullions = new ArrayCollection();
        $this->corridorPolygons = new ArrayCollection();
        $this->rooms = new ArrayCollection();
        $this->structures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Point[]
     */
    public function getBoundaryPoints(): Collection
    {
        return $this->boundaryPoints;
    }

    public function addBoundaryPoint(Point $boundaryPoint): self
    {
        if (!$this->boundaryPoints->contains($boundaryPoint)) {
            $this->boundaryPoints[] = $boundaryPoint;
            $boundaryPoint->setFloorPoint($this);
        }

        return $this;
    }

    public function removeBoundaryPoint(Point $boundaryPoint): self
    {
        if ($this->boundaryPoints->removeElement($boundaryPoint)) {
            // set the owning side to null (unless already changed)
            if ($boundaryPoint->getFloorPoint() === $this) {
                $boundaryPoint->setFloorPoint(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Mullion[]
     */
    public function getMullions(): Collection
    {
        return $this->mullions;
    }

    public function addMullion(Mullion $mullion): self
    {
        if (!$this->mullions->contains($mullion)) {
            $this->mullions[] = $mullion;
            $mullion->setFloor($this);
        }

        return $this;
    }

    public function removeMullion(Mullion $mullion): self
    {
        if ($this->mullions->removeElement($mullion)) {
            // set the owning side to null (unless already changed)
            if ($mullion->getFloor() === $this) {
                $mullion->setFloor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CorridorPolygon[]
     */
    public function getCorridorPolygons(): Collection
    {
        return $this->corridorPolygons;
    }

    public function addCorridorPolygon(CorridorPolygon $corridorPolygon): self
    {
        if (!$this->corridorPolygons->contains($corridorPolygon)) {
            $this->corridorPolygons[] = $corridorPolygon;
            $corridorPolygon->setFloor($this);
        }

        return $this;
    }

    public function removeCorridorPolygon(CorridorPolygon $corridorPolygon): self
    {
        if ($this->corridorPolygons->removeElement($corridorPolygon)) {
            // set the owning side to null (unless already changed)
            if ($corridorPolygon->getFloor() === $this) {
                $corridorPolygon->setFloor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Room[]
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setFloor($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getFloor() === $this) {
                $room->setFloor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Structure[]
     */
    public function getStructures(): Collection
    {
        return $this->structures;
    }

    public function addStructure(Structure $structure): self
    {
        if (!$this->structures->contains($structure)) {
            $this->structures[] = $structure;
            $structure->setFloor($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getFloor() === $this) {
                $structure->setFloor(null);
            }
        }

        return $this;
    }
}

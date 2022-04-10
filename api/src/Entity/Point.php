<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PointRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PointRepository::class)]
#[ApiResource]
class Point
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $x;

    #[ORM\Column(type: 'float')]
    private $y;

    #[ORM\ManyToOne(targetEntity: Mullion::class, inversedBy: 'points')]
    private $mullion;

    #[ORM\ManyToOne(targetEntity: Structure::class, inversedBy: 'points')]
    private $structure;

    #[ORM\ManyToOne(targetEntity: CorridorPolygon::class, inversedBy: 'boundaries')]
    private $corridorBoundaries;

    #[ORM\ManyToOne(targetEntity: CorridorPolygon::class, inversedBy: 'holes')]
    private $corridorHoles;

    #[ORM\ManyToOne(targetEntity: Furniture::class, inversedBy: 'points')]
    private $furniturePoints;

    #[ORM\ManyToOne(targetEntity: Furniture::class, inversedBy: 'nonClearanceSide')]
    private $furnitureClearance;

    #[ORM\ManyToOne(targetEntity: Furniture::class, inversedBy: 'openToSide')]
    private $furnitureOpenSide;

    #[ORM\ManyToOne(targetEntity: Room::class, inversedBy: 'points')]
    private $roomPoints;

    #[ORM\ManyToOne(targetEntity: Room::class, inversedBy: 'innerPoints')]
    private $roomInnerPoint;

    #[ORM\ManyToOne(targetEntity: Room::class, inversedBy: 'revitPoints')]
    private $roomRevitPoints;

    #[ORM\ManyToOne(targetEntity: Floor::class, inversedBy: 'boundaryPoints')]
    private $floorPoint;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getX(): ?float
    {
        return $this->x;
    }

    public function setX(float $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?float
    {
        return $this->y;
    }

    public function setY(float $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function getMullion(): ?Mullion
    {
        return $this->mullion;
    }

    public function setMullion(?Mullion $mullion): self
    {
        $this->mullion = $mullion;

        return $this;
    }

    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): self
    {
        $this->structure = $structure;

        return $this;
    }

    public function getCorridorBoundaries(): ?CorridorPolygon
    {
        return $this->corridorBoundaries;
    }

    public function setCorridorBoundaries(?CorridorPolygon $corridorBoundaries): self
    {
        $this->corridorBoundaries = $corridorBoundaries;

        return $this;
    }

    public function getCorridorHoles(): ?CorridorPolygon
    {
        return $this->corridorHoles;
    }

    public function setCorridorHoles(?CorridorPolygon $corridorHoles): self
    {
        $this->corridorHoles = $corridorHoles;

        return $this;
    }

    public function getFurniturePoints(): ?Furniture
    {
        return $this->furniturePoints;
    }

    public function setFurniturePoints(?Furniture $furniturePoints): self
    {
        $this->furniturePoints = $furniturePoints;

        return $this;
    }

    public function getFurnitureClearance(): ?Furniture
    {
        return $this->furnitureClearance;
    }

    public function setFurnitureClearance(?Furniture $furnitureClearance): self
    {
        $this->furnitureClearance = $furnitureClearance;

        return $this;
    }

    public function getFurnitureOpenSide(): ?Furniture
    {
        return $this->furnitureOpenSide;
    }

    public function setFurnitureOpenSide(?Furniture $furnitureOpenSide): self
    {
        $this->furnitureOpenSide = $furnitureOpenSide;

        return $this;
    }

    public function getRoomPoints(): ?Room
    {
        return $this->roomPoints;
    }

    public function setRoomPoints(?Room $roomPoints): self
    {
        $this->roomPoints = $roomPoints;

        return $this;
    }

    public function getRoomInnerPoint(): ?Room
    {
        return $this->roomInnerPoint;
    }

    public function setRoomInnerPoint(?Room $roomInnerPoint): self
    {
        $this->roomInnerPoint = $roomInnerPoint;

        return $this;
    }

    public function getRoomRevitPoints(): ?Room
    {
        return $this->roomRevitPoints;
    }

    public function setRoomRevitPoints(?Room $roomRevitPoints): self
    {
        $this->roomRevitPoints = $roomRevitPoints;

        return $this;
    }

    public function getFloorPoint(): ?Floor
    {
        return $this->floorPoint;
    }

    public function setFloorPoint(?Floor $floorPoint): self
    {
        $this->floorPoint = $floorPoint;

        return $this;
    }
}

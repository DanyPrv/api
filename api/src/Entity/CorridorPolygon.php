<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CorridorPolygonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CorridorPolygonRepository::class)]
#[ApiResource]
class CorridorPolygon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'corridorBoundaries', targetEntity: Point::class, cascade: ['persist', 'remove'])]
    private $boundaries;

    #[ORM\OneToMany(mappedBy: 'corridorHoles', targetEntity: Point::class, cascade: ['persist', 'remove'])]
    private $holes;

    #[ORM\ManyToOne(targetEntity: Floor::class, inversedBy: 'corridorPolygons')]
    private $floor;

    public function __construct()
    {
        $this->boundaries = new ArrayCollection();
        $this->holes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Point[]
     */
    public function getBoundaries(): Collection
    {
        return $this->boundaries;
    }

    public function addBoundary(Point $boundary): self
    {
        if (!$this->boundaries->contains($boundary)) {
            $this->boundaries[] = $boundary;
            $boundary->setCorridorBoundaries($this);
        }

        return $this;
    }

    public function removeBoundary(Point $boundary): self
    {
        if ($this->boundaries->removeElement($boundary)) {
            // set the owning side to null (unless already changed)
            if ($boundary->getCorridorBoundaries() === $this) {
                $boundary->setCorridorBoundaries(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Point[]
     */
    public function getHoles(): Collection
    {
        return $this->holes;
    }

    public function addHole(Point $hole): self
    {
        if (!$this->holes->contains($hole)) {
            $this->holes[] = $hole;
            $hole->setCorridorHoles($this);
        }

        return $this;
    }

    public function removeHole(Point $hole): self
    {
        if ($this->holes->removeElement($hole)) {
            // set the owning side to null (unless already changed)
            if ($hole->getCorridorHoles() === $this) {
                $hole->setCorridorHoles(null);
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

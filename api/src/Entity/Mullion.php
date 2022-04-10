<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MullionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MullionRepository::class)]
#[ApiResource]
class Mullion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'mullion', targetEntity: Point::class, cascade: ['persist', 'remove'])]
    private $points;

    #[ORM\ManyToOne(targetEntity: Floor::class, inversedBy: 'mullions')]
    private $floor;

    public function __construct()
    {
        $this->points = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $point->setMullion($this);
        }

        return $this;
    }

    public function removePoint(Point $point): self
    {
        if ($this->points->removeElement($point)) {
            // set the owning side to null (unless already changed)
            if ($point->getMullion() === $this) {
                $point->setMullion(null);
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

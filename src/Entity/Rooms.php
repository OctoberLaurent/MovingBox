<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomsRepository")
 */
class Rooms
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Boxes", mappedBy="origin")
     */
    private $boxes;

    public function __construct()
    {
        $this->boxes = new ArrayCollection();
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

    /**
     * @return Collection|Boxes[]
     */
    public function getBoxes(): Collection
    {
        return $this->boxes;
    }

    public function addBox(Boxes $box): self
    {
        if (!$this->boxes->contains($box)) {
            $this->boxes[] = $box;
            $box->setOrigin($this);
        }

        return $this;
    }

    public function removeBox(Boxes $box): self
    {
        if ($this->boxes->contains($box)) {
            $this->boxes->removeElement($box);
            // set the owning side to null (unless already changed)
            if ($box->getOrigin() === $this) {
                $box->setOrigin(null);
            }
        }

        return $this;
    }
}

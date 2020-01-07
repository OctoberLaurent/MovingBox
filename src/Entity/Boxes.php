<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BoxesRepository")
 */
class Boxes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="boxes")
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rooms", inversedBy="boxes")
     */
    private $origin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rooms", inversedBy="boxes")
     */
    private $destination;

    /**
     * @ORM\Column(type="string", length=255 )
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Content", mappedBy="boxes", cascade="persist")
     */
    private $content;

    public function __construct()
    {
        $this->content = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

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

    public function getOrigin(): ?Rooms
    {
        return $this->origin;
    }

    public function setOrigin(?Rooms $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getDestination(): ?Rooms
    {
        return $this->destination;
    }

    public function setDestination(?Rooms $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Content[]
     */
    public function getContent(): Collection
    {
        return $this->content;
    }

    public function addContent(Content $content): self
    {
        if (!$this->content->contains($content)) {
            $this->content[] = $content;
            $content->setBoxes($this);
        }

        return $this;
    }

    public function removeContent(Content $content): self
    {
        if ($this->content->contains($content)) {
            $this->content->removeElement($content);
            // set the owning side to null (unless already changed)
            if ($content->getBoxes() === $this) {
                $content->setBoxes(null);
            }
        }

        return $this;
    }
}

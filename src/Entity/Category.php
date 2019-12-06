<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{

    static $CATEGORY = ["tout","peinture","dessin","sculpture"];


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArtWork", mappedBy="category")
     */
    private $artWorks;

    public function __construct()
    {
        $this->artWorks = new ArrayCollection();
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
     * @return Collection|ArtWork[]
     */
    public function getArtWorks(): Collection
    {
        return $this->artWorks;
    }

    public function addArtWork(ArtWork $artWork): self
    {
        if (!$this->artWorks->contains($artWork)) {
            $this->artWorks[] = $artWork;
            $artWork->setCategory($this);
        }

        return $this;
    }

    public function removeArtWork(ArtWork $artWork): self
    {
        if ($this->artWorks->contains($artWork)) {
            $this->artWorks->removeElement($artWork);
            // set the owning side to null (unless already changed)
            if ($artWork->getCategory() === $this) {
                $artWork->setCategory(null);
            }
        }

        return $this;
    }
}

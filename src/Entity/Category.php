<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Post::class, mappedBy="category")
     */
    private $catgory;

    public function __construct()
    {
        $this->catgory = new ArrayCollection();
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
     * @return Collection|Post[]
     */
    public function getCatgory(): Collection
    {
        return $this->catgory;
    }

    public function addCatgory(Post $catgory): self
    {
        if (!$this->catgory->contains($catgory)) {
            $this->catgory[] = $catgory;
            $catgory->addCategory($this);
        }

        return $this;
    }

    public function removeCatgory(Post $catgory): self
    {
        if ($this->catgory->removeElement($catgory)) {
            $catgory->removeCategory($this);
        }

        return $this;
    }
}

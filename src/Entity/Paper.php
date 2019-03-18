<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PaperRepository")
 */
class Paper
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $density;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PaperType", inversedBy="papers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Coat", inversedBy="papers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coats;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", mappedBy="papers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $products;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->coats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDensity(): ?int
    {
        return $this->density;
    }

    public function setDensity(int $density): self
    {
        $this->density = $density;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return PaperType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }
    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addPaper($this);
        }
        return $this;
    }
    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            $product->removePaper($this);
        }
        return $this;
    }

    /**
     * @return Collection|Coat[]
     */
    public function getCoats(): Collection
    {
        return $this->coats;
    }

    public function addCoat(Coat $coat): self
    {
        if (!$this->coats->contains($coat)) {
            $this->coats[] = $coat;
        }
        return $this;
    }

    public function removeCoat(Coat $coat): self
    {
        if ($this->coats->contains($coat)) {
            $this->coats->removeElement($coat);
        }
        return $this;
    }
}

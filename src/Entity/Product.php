<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Model as ORMBehaviors;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    use ORMBehaviors\Translatable\Translatable;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Valid
     */
    protected $translations;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Image", inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $manufactureMethods;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Paper", inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     */
    private $papers;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $defaultCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $defaultWidth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $defaultHeight;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PrintType", inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     */
    private $printTypes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PostPrint", inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     */
    private $postPrints;

    public function __construct()
    {
        $this->papers = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->printTypes = new ArrayCollection();
        $this->postPrints = new ArrayCollection();
    }

    public function __call($method, $arguments)
    {

        return PropertyAccess::createPropertyAccessor()->getValue($this->translate(), $method);
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getManufactureMethods(): ?string
    {
        return $this->manufactureMethods;
    }

    public function setManufactureMethods(?string $manufactureMethods): self
    {
        $this->manufactureMethods = $manufactureMethods;

        return $this;
    }

    /**
     * @return Collection|Paper[]
     */
    public function getPapers(): Collection
    {
        return $this->papers;
    }

    public function addPaper(Paper $paper): self
    {
        if (!$this->papers->contains($paper)) {
            $this->papers[] = $paper;
        }
        return $this;
    }

    public function removePaper(Paper $paper): self
    {
        if ($this->papers->contains($paper)) {
            $this->papers->removeElement($paper);
        }
        return $this;
    }

    /**
     * @return Collection|PrintType[]
     */
    public function getPrintTypes(): Collection
    {
        return $this->printTypes;
    }

    public function addPrintType(PrintType $printType): self
    {
        if (!$this->printTypes->contains($printType)) {
            $this->printTypes[] = $printType;
        }
        return $this;
    }

    public function removePrintType(PrintType $printType): self
    {
        if ($this->papers->contains($printType)) {
            $this->papers->removeElement($printType);
        }
        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
        }
        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDefaultCount(): ?int
    {
        return $this->defaultCount;
    }

    public function setDefaultCount(?int $defaultCount): self
    {
        $this->defaultCount = $defaultCount;

        return $this;
    }

    public function getDefaultWidth(): ?int
    {
        return $this->defaultWidth;
    }

    public function setDefaultWidth(?int $defaultWidth): self
    {
        $this->defaultWidth = $defaultWidth;

        return $this;
    }

    public function getDefaultHeight(): ?int
    {
        return $this->defaultHeight;
    }

    public function setDefaultHeight(?int $defaultHeight): self
    {
        $this->defaultHeight = $defaultHeight;

        return $this;
    }

    /**
     * @return Collection|PostPrint[]
     */
    public function getPostPrints(): Collection
    {
        return $this->postPrints;
    }

    public function addPostPrint(PostPrint $postPrint): self
    {
        if (!$this->postPrints->contains($postPrint)) {
            $this->postPrints[] = $postPrint;
        }
        return $this;
    }

    public function removePostPrint(PostPrint $postPrint): self
    {
        if ($this->postPrints->contains($postPrint)) {
            $this->postPrints->removeElement($postPrint);
        }
        return $this;
    }

}

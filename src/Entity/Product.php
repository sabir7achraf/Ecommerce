<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    public ?string $nameProduct = null;

    #[ORM\Column(length: 255)]
    private ?string $typeProduct = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantiteProduct = null;

    #[ORM\ManyToMany(targetEntity: Ordres::class, inversedBy: 'products')]
    private Collection $fk_product;

    #[ORM\OneToMany(targetEntity: Images::class, mappedBy: 'img_fk')]
    private Collection $images;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\OneToMany(targetEntity: Ordres::class, mappedBy: 'Product_id')]
    private Collection $ordres;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image3 = null;

    public function __construct()
    {
        $this->fk_product = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->ordres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNameProduct(): ?string
    {
        return $this->nameProduct;
    }

    public function setNameProduct(string $nameProduct): static
    {
        $this->nameProduct = $nameProduct;

        return $this;
    }

    public function getTypeProduct(): ?string
    {
        return $this->typeProduct;
    }

    public function setTypeProduct(string $typeProduct): static
    {
        $this->typeProduct = $typeProduct;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getQuantiteProduct(): ?int
    {
        return $this->quantiteProduct;
    }

    public function setQuantiteProduct(?int $quantiteProduct): static
    {
        $this->quantiteProduct = $quantiteProduct;

        return $this;
    }

    /**
     * @return Collection<int, Ordres>
     */
    public function getFkProduct(): Collection
    {
        return $this->fk_product;
    }

    public function addFkProduct(Ordres $fkProduct): static
    {
        if (!$this->fk_product->contains($fkProduct)) {
            $this->fk_product->add($fkProduct);
        }

        return $this;
    }

    public function removeFkProduct(Ordres $fkProduct): static
    {
        $this->fk_product->removeElement($fkProduct);

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setImgFk($this);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getImgFk() === $this) {
                $image->setImgFk(null);
            }
        }

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Ordres>
     */
    public function getOrdres(): Collection
    {
        return $this->ordres;
    }

    public function addOrdre(Ordres $ordre): static
    {
        if (!$this->ordres->contains($ordre)) {
            $this->ordres->add($ordre);
            $ordre->setProductId($this);
        }

        return $this;
    }

    public function removeOrdre(Ordres $ordre): static
    {
        if ($this->ordres->removeElement($ordre)) {
            // set the owning side to null (unless already changed)
            if ($ordre->getProductId() === $this) {
                $ordre->setProductId(null);
            }
        }

        return $this;
    }

    public function getImage2(): ?string
    {
        return $this->image2;
    }

    public function setImage2(?string $image2): static
    {
        $this->image2 = $image2;

        return $this;
    }

    public function getImage3(): ?string
    {
        return $this->image3;
    }

    public function setImage3(?string $image3): static
    {
        $this->image3 = $image3;

        return $this;
    }
}

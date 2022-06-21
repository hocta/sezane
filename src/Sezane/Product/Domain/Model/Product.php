<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Sezane\Shop\Infrastructure\Persistence\Entity\Shop;

class Product
{
    private int $id;
    private string $name;
    private ?string $imageUrl = null;

    private ArrayCollection $productShop;

    public function __construct()
    {
        $this->productShop = new ArrayCollection();
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getProductShop(): ArrayCollection
    {
        return $this->productShop;
    }

    public function addProductShop(Shop $shop): self
    {
        $this->productShop->add($shop);
        return $this;
    }

    public function removeProductShop(Shop $shop): void
    {
        if($this->productShop->contains($shop)) {
            $this->productShop->removeElement($shop);
        }
    }
}
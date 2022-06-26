<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Sezane\Shop\Domain\Model\Shop;

class Product
{
    public const MAX_DISPLAY_RESULT = 2;

    private ?int $id = null;
    private string $name;
    private ?string $imageUrl = null;

    private ArrayCollection $shops;

    public function __construct()
    {
        $this->shops = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
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

    public function getShops(): ArrayCollection
    {
        return $this->shops;
    }

    public function addShop(Shop $shop): self
    {
        if(!$this->shops->contains($shop)){
            $this->shops->add($shop);
        }

        return $this;
    }

    public function removeShop(Shop $shop): self
    {
        $this->shops->removeElement($shop);
        return $this;
    }
}
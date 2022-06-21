<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\Persistence\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\PersistentCollection;
use Sezane\Shop\Infrastructure\Persistence\Entity\Shop;

class Product
{
    private int $id;
    private string $name;
    private ?string $imageUrl = null;

    private PersistentCollection $productShops;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->productShops = new PersistentCollection(
            $entityManager,
            $entityManager->getClassMetadata(ProductShop::class),
            new ArrayCollection()
        );
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

    public function getProductShops(): PersistentCollection
    {
        return $this->productShops;
    }

    public function addProductShop(ProductShop $productShop): self
    {
        $this->productShops->add($productShop);
        return $this;
    }

    public function removeProductShops(ProductShop $productShop): void
    {
        if($this->productShops->contains($productShop)) {
            $this->productShops->removeElement($productShop);
        }
    }
}
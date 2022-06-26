<?php

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\Persistence\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\PersistentCollection;

class Manager
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private PersistentCollection $shops;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->shops = new PersistentCollection(
            $entityManager,
            $entityManager->getClassMetadata(Shop::class),
            new ArrayCollection()
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getShops(): PersistentCollection
    {
        return $this->shops;
    }

    public function addShop(Shop $shop): self
    {
        if(!$this->shops->contains($shop)) {
            $this->shops->add($shop);
        }

        return $this;
    }

    public function removeShop(Shop $shop): self
    {
        if($this->shops->contains($shop)) {
            $this->shops->removeElement($shop);
        }

        return $this;
    }
}
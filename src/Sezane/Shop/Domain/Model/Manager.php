<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;

class Manager
{
    private ?int $id = null;
    private string $firstName;
    private string $lastName;
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

    /**
     * @return ArrayCollection
     */
    public function getShops(): ArrayCollection
    {
        return $this->shops;
    }

    /**
     * @param ArrayCollection $shops
     */
    public function setShops(ArrayCollection $shops): self
    {
        $this->shops = $shops;
        return $this;
    }
}
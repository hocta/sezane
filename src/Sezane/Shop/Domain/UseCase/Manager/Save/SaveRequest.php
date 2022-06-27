<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Manager\Save;

class SaveRequest
{
    private ?int $managerId = null;
    private ?string $firstName = null;
    private ?string $lastName = null;
    private ?array $shopsId = null;

    public function getManagerId(): ?int
    {
        return $this->managerId;
    }

    public function setManagerId(?int $managerId): self
    {
        $this->managerId = $managerId;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getShopsId(): ?array
    {
        return $this->shopsId;
    }

    public function setShopsId(?array $shopsId): self
    {
        $this->shopsId = $shopsId;
        return $this;
    }
}
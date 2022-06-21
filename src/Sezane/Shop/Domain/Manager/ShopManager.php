<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\Manager;

use Sezane\Shop\Domain\Model\Shop;
use Sezane\Shop\Domain\Repository\ShopRepositoryInterface;

class ShopManager
{
    public function __construct(
        private ShopRepositoryInterface $shopRepository
    )
    {
    }

    public function save(Shop $shop): void
    {
        $this->shopRepository->save($shop);
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): ?Shop
    {
        return $this->shopRepository->findOneBy($criteria, $orderBy);
    }

    public function search(array $criteria, int $page = 1, array $orderBy = []): array
    {
        return $this->shopRepository->search($criteria, $page, $orderBy);
    }
}
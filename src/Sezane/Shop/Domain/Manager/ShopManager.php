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

    public function save(Shop $shop): ?Shop
    {
        return $this->shopRepository->save($shop);
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): ?Shop
    {
        return $this->shopRepository->findOneBy($criteria, $orderBy);
    }

    public function searchByName(array $criteria, int $page = 1, array $orderBy = [], ?int $limit = null): array
    {
        return $this->shopRepository->searchByName($criteria, $page, $orderBy, $limit);
    }
}
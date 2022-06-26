<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\Manager;

use Sezane\Product\Domain\Model\ProductShop;
use Sezane\Product\Domain\Repository\ProductShopRepositoryInterface;

class ProductShopManager
{
    public function __construct(
        private ProductShopRepositoryInterface $productShopRepository
    )
    {
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): ?ProductShop
    {
        return $this->productShopRepository->findOneBy($criteria, $orderBy);
    }

    public function save(ProductShop $productShop): ?int
    {
        return $this->productShopRepository->save($productShop);
    }

    public function list(int $shopId, int $page, ?array $orderBy = null, ?int $limit = null): array
    {
        return $this->productShopRepository->list($shopId, $page, $orderBy, $limit);
    }

    public function getProductStockByShop(int $productId, array $shopsId): ?array
    {
        return $this->productShopRepository->getProductStockByShop($productId, $shopsId);
    }
}
<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\Repository;

use Sezane\Product\Domain\Model\ProductShop;

interface ProductShopRepositoryInterface
{
    public function findOneBy(array $criteria, ?array $orderBy = null): ?ProductShop;

    public function save(ProductShop $productShop): ?int;

    public function list(int $shopId, int $page, ?array $orderBy = null, ?int $limit = null): array;

    public function getProductStockByShop(int $productId, array $shopsId): ?array;
}
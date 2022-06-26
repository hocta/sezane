<?php

declare(strict_types=1);

namespace Sezane\Product\Domain\Manager;

use Sezane\Product\Domain\Model\Product;
use Sezane\Product\Domain\Repository\ProductRepositoryInterface;

class ProductManager
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    )
    {
    }

    public function list(int $page, ?array $orderBy = null, ?int $limit = null): array
    {
        return $this->productRepository->list($page, $orderBy, $limit);
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): ?Product
    {
        return $this->productRepository->findOneBy($criteria, $orderBy);
    }
}
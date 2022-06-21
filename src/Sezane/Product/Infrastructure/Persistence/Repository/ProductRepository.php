<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\Persistence\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sezane\Product\Domain\Repository\ProductRepositoryInterface;
use Sezane\Product\Infrastructure\Persistence\Entity\Product;
use Sezane\Product\Domain\Model\Product as ProductModel;

class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry
    )
    {
        parent::__construct($registry, Product::class);
    }

    public function list(?int $shopId, int $page = 1, array $orderBy = []): array
    {
        $limit = 2;
        $result = parent::findBy(
            [],
            [],
            $limit,
            ($limit * ($page - 1))
        );

        dd($result[0]->getProductShops());
    }

    public function save(ProductModel $product): void
    {
        // TODO: Implement save() method.
    }
}
<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\Persistence\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Sezane\Product\Domain\Repository\ProductRepositoryInterface;
use Sezane\Product\Infrastructure\Persistence\Entity\Product as ProductEntity;
use Sezane\Product\Domain\Model\Product;

class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductEntity::class);
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): ?Product
    {
        try {
            $productEntity = parent::findOneBy($criteria, $orderBy);
            if ($productEntity === null) {
                return null;
            }

            $product = new Product();
            $product
                ->setId($productEntity->getId())
                ->setName($productEntity->getName())
                ->setImageUrl($productEntity->getImageUrl());

            return $product;
        } catch (\Exception $e) {
            throw new ORMException($e->getMessage());
        }
    }

    public function list(int $page, ?array $orderBy = null, ?int $limit = null): array
    {
        $limit = $limit ?? Product::MAX_DISPLAY_RESULT;
        $first = ($page - 1) * $limit;

        return parent::findBy([], $orderBy, $limit, $first);
    }
}
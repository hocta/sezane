<?php

declare(strict_types=1);

namespace Sezane\Product\Infrastructure\Persistence\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\Persistence\ManagerRegistry;
use Sezane\Product\Domain\Model\ProductShop;
use Sezane\Product\Domain\Repository\ProductShopRepositoryInterface;
use Sezane\Product\Infrastructure\Persistence\Entity\ProductShop as ProductShopEntity;
use Sezane\Shop\Infrastructure\Persistence\Repository\ShopRepository;

class ProductShopRepository extends ServiceEntityRepository implements ProductShopRepositoryInterface
{
    public function __construct(
        private ProductRepository $productRepository,
        private ShopRepository    $shopRepository,
        ManagerRegistry           $registry
    )
    {
        parent::__construct($registry, ProductShopEntity::class);
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): ?ProductShop
    {
        try {
            $productShopEntity = parent::findOneBy($criteria, $orderBy);
            if ($productShopEntity === null) {
                return null;
            }

            $productShop = new ProductShop();
            $productShop
                ->setId($productShopEntity->getId())
                ->setNumberStock($productShopEntity->getNumberStock())
                ->setShop($productShopEntity->getShop())
                ->setProduct($productShopEntity->getProduct());

            return $productShop;
        } catch (\Exception $e) {
            throw new($e->getMessage());
        }
    }

    public function save(ProductShop $productShop): ?int
    {
        try {
            if ($productShop->getId()) {
                $productShopEntity = parent::findOneBy(['id' => $productShop->getId()]);
            } else {
                $productShopEntity = new ProductShopEntity();
            }

            $productEntity = $this->productRepository->find(
                ['id' => $productShop->getProduct()->getId()]
            );

            $shopEntity = $this->shopRepository->find(
                ['id' => $productShop->getShop()->getId()]
            );

            $productShopEntity
                ->setProduct($productEntity)
                ->setShop($shopEntity)
                ->setNumberStock($productShop->getNumberStock());

            $this->getEntityManager()->persist($productShopEntity);
            $this->getEntityManager()->flush();

            return $productShopEntity->getId();

        } catch (UniqueConstraintViolationException $e) {
            return 0;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function list(int $shopId, int $page, ?array $orderBy = null, ?int $limit = null): array
    {
        $limit = $limit ?? ProductShop::TOTAL_RESULT;
        $first = ($page - 1) * $limit;

        $qb = $this->createQueryBuilder('ps')
            ->select('ps')
            ->leftJoin('ps.shop', 's')
            ->leftJoin('ps.product', 'p')
            ->where('s.id = :shopId')
            ->setParameter('shopId', $shopId)
            ->orderBy(
                'p.name', $orderBy['name']
            )
            ->setFirstResult($first)
            ->setMaxResults($limit);

        return $qb->getQuery()->execute();
    }

    public function getProductStockByShop(int $productId, array $shopsId): ?array
    {
        $qb = $this->createQueryBuilder('ps')
            ->select(
                'ps.numberStock quantity, s.id as shopId, s.name as shopName'
            )
            ->leftJoin('ps.shop', 's')
            ->leftJoin('ps.product', 'p')
            ->where('ps.product = :productId')
            ->addCriteria(
                Criteria::create()->where(
                    Criteria::expr()->in('s.id', $shopsId)
                )
            )
            ->setParameter('productId', $productId);

        return $qb->getQuery()->execute();
    }
}
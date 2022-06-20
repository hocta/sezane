<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\Persistence\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Sezane\Shop\Domain\Model\Shop;
use Sezane\Shop\Infrastructure\Persistence\Entity\Shop as ShopEntity;
use Sezane\Shop\Domain\Repository\ShopRepositoryInterface;
use Sezane\Util\Traits\FunctionsTrait;

class ShopRepository extends ServiceEntityRepository implements ShopRepositoryInterface
{
    use FunctionsTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShopEntity::class);
    }

    public function save(Shop $shop): void
    {
        if ($shop->getId() !== null) {
            $shopEntity = parent::findOneBy(['id' => $shop->getId()]);
        } else {
            $shopEntity = new ShopEntity();
        }

        $shopEntity
            ->setName($shop->getName())
            ->setLatitude($shop->getLatitude())
            ->setLongitude($shop->getLongitude())
            ->setAddress($shop->getAddress());

        $this->getEntityManager()->persist($shopEntity);
        $this->getEntityManager()->flush();
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): ?Shop
    {
        try {
            $shopEntity = parent::findOneBy($criteria, $orderBy);
            if ($shopEntity === null) return null;

            $shop = new Shop();
            $shop
                ->setName($shopEntity->getName())
                ->setLatitude($shopEntity->getLatitude())
                ->setLongitude($shopEntity->getLongitude())
                ->setAddress($shopEntity->getAddress());

            return $shop;

        } catch (\Exception $e) {
            throw new ORMException($e->getMessage());
        }
    }

    public function search(array $criteria, int $page = 1, array $orderBy = []): array
    {
        $pageSize = 2;
        $firstResult = ($page - 1) * $pageSize;

        $sqlDistance = '
            ROUND((6353 * 2 * asin(sqrt( power(SIN((s.latitude - :latitude) * pi()/180 / 2), 2) + cos(s.latitude * pi()/180) * 
            cos(:latitude * pi()/180) * power(sin((s.longitude - :longitude) * pi()/180 / 2), 2) ))),2) as distance
        ';

        $qb = $this
            ->createQueryBuilder('s')
            ->leftJoin('s.manager', 'm')
            ->select('s.name, s.latitude, s.longitude, s.address')
            ->addSelect($sqlDistance)
            ->addSelect('m.id as manager_id, m.firstName')
            ->addCriteria(
                Criteria::create()->where(
                    Criteria::expr()->contains('name', $criteria['name'])
                )
            )
            ->having('distance <= :distance')
            ->setParameter('latitude', $criteria['latitude'])
            ->setParameter('longitude', $criteria['longitude'])
            ->setParameter('distance', $criteria['distance'])
            ->setFirstResult($firstResult)
            ->setMaxResults($pageSize);

        if ($orderBy) {
            foreach ($orderBy as $key => $value) {
                $qb->addOrderBy($key, $value);
            }
        }

        return $qb->getQuery()->getResult();
    }
}
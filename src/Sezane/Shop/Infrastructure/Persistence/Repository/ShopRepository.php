<?php

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\Persistence\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Sezane\Shop\Domain\Model\Manager;
use Sezane\Shop\Domain\Model\Shop;
use Sezane\Shop\Infrastructure\Persistence\Entity\Shop as ShopEntity;
use Sezane\Shop\Domain\Repository\ShopRepositoryInterface;

class ShopRepository extends ServiceEntityRepository implements ShopRepositoryInterface
{
    public function __construct(
        private ManagerRepository $managerRepository,
        ManagerRegistry           $registry
    )
    {
        parent::__construct($registry, ShopEntity::class);
    }

    public function save(Shop $shop): ?Shop
    {
        if ($shop->getId()) {
            $shopEntity = parent::findOneBy(['id' => $shop->getId()]);
            if ($shopEntity === null) return null;
        } else {
            $shopEntity = new ShopEntity();
        }

        $shopEntity
            ->setName($shop->getName())
            ->setLatitude($shop->getLatitude())
            ->setLongitude($shop->getLongitude())
            ->setAddress($shop->getAddress());

        if ($shop->getManager()) {
            $shopEntity->setManager(
                $this->managerRepository->find($shop->getManager()->getId())
            );
        }

        $this->getEntityManager()->persist($shopEntity);
        $this->getEntityManager()->flush();

        return $this->convertShopEntityToModel($shopEntity);
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): ?Shop
    {
        try {
            $shopEntity = parent::findOneBy($criteria, $orderBy);
            if ($shopEntity === null) return null;

            return $this->convertShopEntityToModel($shopEntity);

        } catch (\Exception $e) {
            throw new ORMException($e->getMessage());
        }
    }

    public function searchByName(array $criteria, int $page = 1, ?array $orderBy = null, ?int $limit = null): array
    {
        $contains = Criteria::create()->where(
            Criteria::expr()->contains('name', $criteria['name'])
        );

        $limit = $limit ?? Shop::TOTAL_RESULT;
        $first = ($page - 1) * $limit;

        $qb = $this
            ->createQueryBuilder('s')
            ->leftJoin('s.manager', 'm')
            ->select('s.id, s.name, s.latitude, s.longitude, s.address')
            ->addSelect('m.id as manager_id, m.firstName')
            ->setFirstResult($first)
            ->setMaxResults($limit);

        if (!empty($criteria['name'])) {
            $qb->addCriteria($contains);
        }

        if (
            !empty($criteria['latitude']) &&
            !empty($criteria['longitude']) &&
            !empty($criteria['distance'])
        ) {
            $sqlDistance = '
                ROUND((6353 * 2 * asin(sqrt( power(SIN((s.latitude - :latitude) * pi()/180 / 2), 2) + cos(s.latitude * pi()/180) * 
                cos(:latitude * pi()/180) * power(sin((s.longitude - :longitude) * pi()/180 / 2), 2) ))),2) as distance
            ';

            $qb
                ->addSelect($sqlDistance)
                ->having('distance <= :distance')
                ->setParameter('latitude', $criteria['latitude'])
                ->setParameter('longitude', $criteria['longitude'])
                ->setParameter('distance', $criteria['distance']);

            if ($orderBy) {
                foreach ($orderBy as $key => $value) {
                    if ($value == null) continue;
                    if ($key == 'distance') $qb->addOrderBy($key, $value);
                }
            }
        }

        if ($orderBy) {
            foreach ($orderBy as $key => $value) {
                if ($value == null) continue;
                if ($key == 'distance') continue;
                $qb->addOrderBy('s.' . $key, $value);
            }
        }

        return $qb->getQuery()->getResult();
    }

    public function searchByIds(array $shopsId): array
    {
        if ($shopsId) {
            return parent::findBy(['id' => $shopsId]);
        } else {
            return parent::findAll();
        }


    }

    private function convertShopEntityToModel(ShopEntity $shopEntity): Shop
    {
        $manager = new Manager();

        if ($shopEntity->getManager() !== null) {
            $manager
                ->setId($shopEntity->getManager()->getId())
                ->setFirstName($shopEntity->getManager()->getFirstName())
                ->setLastName($shopEntity->getManager()->getLastName());
        }

        $shop = new Shop();
        $shop
            ->setId($shopEntity->getId())
            ->setName($shopEntity->getName())
            ->setLatitude($shopEntity->getLatitude())
            ->setLongitude($shopEntity->getLongitude())
            ->setAddress($shopEntity->getAddress())
            ->setManager($manager);

        return $shop;
    }
}
<?php

declare(strict_types=1);

namespace Sezane\Shop\Infrastructure\Persistence\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Sezane\Shop\Domain\Model\Manager;
use Sezane\Shop\Domain\Repository\ManagerRepositoryInterface;
use Sezane\Shop\Infrastructure\Persistence\Entity\Manager as ManagerEntity;

class ManagerRepository extends ServiceEntityRepository implements ManagerRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        ManagerRegistry $registry
    )
    {
        parent::__construct($registry, ManagerEntity::class);
    }

    public function save(Manager $manager): ?Manager
    {
        if ($manager->getId()) {
            $managerEntity = parent::findOneBy(['id' => $manager->getId()]);
            if(!$managerEntity) return null;
        } else {
            $managerEntity = new ManagerEntity($this->entityManager);
        }

        $managerEntity
            ->setFirstName($manager->getFirstName())
            ->setLastName($manager->getLastName());

        $this->getEntityManager()->persist($managerEntity);
        $this->getEntityManager()->flush();

        return $this->convertManagerEntityToModel($managerEntity);
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): ?Manager
    {
        try {
            $managerEntity = parent::findOneBy($criteria, $orderBy);
            if ($managerEntity === null) return null;

            return $this->convertManagerEntityToModel($managerEntity);

        } catch (\Exception $e) {
            throw new ORMException($e->getMessage());
        }
    }

    private function convertManagerEntityToModel(ManagerEntity $managerEntity): Manager
    {
        $manager = new Manager();
        $manager
                ->setId($managerEntity->getId())
                ->setFirstName($managerEntity->getFirstName())
                ->setLastName($managerEntity->getLastName());

        return $manager;
    }
}
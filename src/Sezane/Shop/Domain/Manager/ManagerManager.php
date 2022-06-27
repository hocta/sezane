<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\Manager;

use Sezane\Shop\Domain\Model\Manager;
use Sezane\Shop\Infrastructure\Persistence\Repository\ManagerRepository;

class ManagerManager
{
    public function __construct(private ManagerRepository $managerRepository)
    {
    }

    public function save(Manager $manager): ?Manager
    {
        return $this->managerRepository->save($manager);
    }

    public function findOneBy(array $criteria, ?array $orderBy = null): ?Manager
    {
        return $this->managerRepository->findOneBy($criteria, $orderBy);
    }
}
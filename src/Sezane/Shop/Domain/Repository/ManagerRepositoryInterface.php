<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\Repository;

use Sezane\Shop\Domain\Model\Manager;

interface ManagerRepositoryInterface
{
    public function save(Manager $manager): ?Manager;

    public function findOneBy(array $criteria, ?array $orderBy = null): ?Manager;
}
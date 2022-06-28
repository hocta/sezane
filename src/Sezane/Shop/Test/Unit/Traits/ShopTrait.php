<?php

declare(strict_types=1);

namespace Sezane\Shop\Test\Unit\Traits;

use Sezane\Shop\Domain\Model\Manager;
use Sezane\Shop\Domain\Model\Shop;

trait ShopTrait
{
    private function getShop(): Shop
    {
        $manager = new Manager();
        $manager
            ->setId(1)
            ->setFirstName('firstname1')
            ->setLastName('lastname1');

        return (new Shop())
            ->setId(1)
            ->setName('shop 1')
            ->setLatitude(48.0)
            ->setLongitude(2.5)
            ->setAddress('address test')
            ->setManager($manager);
    }

    private function getShops(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'shop 1',
                'latitude' => 48.0,
                'longitude' => 2.5,
                'address' => 'address test'
            ],
            [
                'id' => 2,
                'name' => 'shop 2',
                'latitude' => 48.0,
                'longitude' => 2.5,
                'address' => 'address test'
            ]
        ];
    }
}
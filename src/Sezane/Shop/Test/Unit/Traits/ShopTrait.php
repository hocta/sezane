<?php

declare(strict_types=1);

namespace Sezane\Shop\Test\Unit\Traits;

trait ShopTrait
{
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
<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Util\Traits;

trait FunctionsTrait
{
    public function getCalculationLatLon(float $latitude, float $longitude, int $distance): ?array
    {
        if(!$distance || !$latitude || !$longitude) return null;

        return [
            'latitude' => [
                $latitude - ($distance / 111),
                $latitude + ($distance / 111)
            ],
            'longitude' => [
                $longitude - ($distance / 76),
                $longitude + ($distance / 76)
            ],
        ];
    }
}
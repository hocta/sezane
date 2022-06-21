<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Product\Domain\UseCase\Product\Get;

interface GetPresenterInterface
{
    public function present(GetResponse $response): void;
}
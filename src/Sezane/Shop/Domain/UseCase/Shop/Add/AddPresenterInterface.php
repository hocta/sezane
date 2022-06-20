<?php

/**
 * @copyright Photo-Me France. All rights reserved.
 */

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Shop\Add;

interface AddPresenterInterface
{
    public function present(AddResponse $response): void;
}
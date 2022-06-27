<?php

declare(strict_types=1);

namespace Sezane\Shop\Domain\UseCase\Manager\Save;

use Sezane\Shop\Domain\UseCase\Manager\Save\SaveResponse;

interface SavePresenterInterface
{
    public function present(SaveResponse $response): void;
}